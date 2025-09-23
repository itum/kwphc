<?php
// تنظیمات گزارش خطا برای دیباگ
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
* تست اتصال به دیتابیس SQL Server و نمایش جداول/ویوهای مرتبط با دوره‌ها
*/

// تابع لاگ خطا
function logError($message) {
    $logFile = '/tmp/database_error_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// هندلر دانلود اکسل (قبل از هر خروجی باید اجرا شود)
if (isset($_GET['export'])) {
    $server_ip = "185.128.81.210";
    $port = "2033";
    $username = "kwphc.ir_englishuser";
    $password = "654DSF#@F0k";
    $database = 'kwphc.ir_english';

    $object = preg_replace('/[^A-Za-z0-9_]/', '', $_GET['export']);
    if (!$object) {
        http_response_code(400);
        echo 'Invalid export target';
        exit;
    }

    try {
        $dsn = "sqlsrv:Server=$server_ip,$port;Database=$database";
        $pdo_export = new PDO($dsn, $username, $password);
        $pdo_export->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // بررسی وجود جدول/ویو
        $exists = false;
        $chk = $pdo_export->prepare("SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = ? UNION ALL SELECT 1 FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_NAME = ?");
        $chk->execute([$object, $object]);
        $exists = (bool)$chk->fetchColumn();
        if (!$exists) {
            http_response_code(404);
            echo 'Object not found';
            exit;
        }

        // دریافت ستون‌ها به ترتیب صحیح
        $colsStmt = $pdo_export->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? ORDER BY ORDINAL_POSITION");
        $colsStmt->execute([$object]);
        $columns = $colsStmt->fetchAll(PDO::FETCH_COLUMN);
        if (empty($columns)) {
            http_response_code(500);
            echo 'No columns found';
            exit;
        }

        // هدرهای اکسل و استریم UTF-16LE (سازگار با فارسی)
        $filename = $object . '-' . date('Ymd-His') . '.xls';
        header('Content-Type: application/vnd.ms-excel; charset=UTF-16LE');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // BOM برای UTF-16LE
        echo "\xFF\xFE";

        $out = function($row) {
            $line = [];
            foreach ($row as $value) {
                if ($value === null) { $value = ''; }
                $value = str_replace(["\t", "\r", "\n"], ' ', (string)$value);
                $line[] = $value;
            }
            $tsv = implode("\t", $line) . "\r\n";
            echo mb_convert_encoding($tsv, 'UTF-16LE', 'UTF-8');
        };

        // ردیف هدر
        $out($columns);

        // استریم رکوردها در قطعات (با حذف رکوردهای تکراری بر اساس کلید منطقی)
        set_time_limit(0);

        // تعیین ستون کلید برای حذف رکوردهای تکراری
        $keyColumn = null;
        $preferredSortColumn = null;
        $dateTypes = ['date','datetime','smalldatetime','datetime2','datetimeoffset','time'];
        $numericTypes = ['bigint','int','smallint','tinyint','decimal','numeric','float','real'];

        // دریافت انواع ستون‌ها برای تشخیص بهتر
        $colsMetaStmt = $pdo_export->prepare("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? ORDER BY ORDINAL_POSITION");
        $colsMetaStmt->execute([$object]);
        $columnsMeta = $colsMetaStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($columnsMeta as $column) {
            $colName = $column['COLUMN_NAME'];
            $dataType = strtolower($column['DATA_TYPE']);
            if ($preferredSortColumn === null && (in_array($dataType, $dateTypes) && preg_match('/date|time|tarikh|exam/i', $colName))) {
                $preferredSortColumn = $colName;
            }
            if ($keyColumn === null && preg_match('/^(co_c|.*course.*code|.*class.*code|.*doreh.*code|.*code|.*id)$/i', $colName)) {
                $keyColumn = $colName;
            }
        }
        if ($preferredSortColumn === null) {
            foreach ($columnsMeta as $column) {
                $colName = $column['COLUMN_NAME'];
                $dataType = strtolower($column['DATA_TYPE']);
                if (in_array($dataType, $numericTypes) && preg_match('/id|code|noe|num|counter|count|co_c/i', $colName)) {
                    $preferredSortColumn = $colName;
                    break;
                }
            }
        }

        // ساخت کوئری نهایی با حذف تکراریها
        if ($keyColumn) {
            $orderCol = $preferredSortColumn ? $preferredSortColumn : $keyColumn;
            $sql = "WITH cte AS (SELECT *, ROW_NUMBER() OVER (PARTITION BY [" . $keyColumn . "] ORDER BY [" . $orderCol . "] DESC) rn FROM [" . $object . "]) SELECT * FROM cte WHERE rn = 1";
        } else {
            // اگر کلید پیدا نشد، تلاش برای DISTINCT روی همه ستونها
            $colsList = '[' . implode('],[', $columns) . ']';
            $sql = "SELECT DISTINCT " . $colsList . " FROM [" . $object . "]";
        }

        $stmt = $pdo_export->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // مرتب‌سازی ستونها طبق ترتیب هدر
            $ordered = [];
            foreach ($columns as $c) { $ordered[] = array_key_exists($c, $row) ? $row[$c] : null; }
            $out($ordered);
        }
    } catch (Throwable $e) {
        logError('Export error: ' . $e->getMessage());
        if (!headers_sent()) {
            http_response_code(500);
        }
        echo 'Export failed';
    }
    exit;
}

// تابع نمایش جداول و ویوهای مرتبط با دوره‌ها
function display_doreh_objects($pdo, $dbName) {
    echo "<h2>آیتم‌های مرتبط با دوره‌ها در دیتابیس " . htmlspecialchars($dbName) . "</h2>";

    // جداول و ویو هدف
    $targetTables = [
        'Nwcoding_Doreh',
        'Nwcoding_Masold',
        'Nwcoding_Noe_Doreh',
        'NwDoreh_Ejra'
    ];
    $targetView = 'VNWDoreh_Ejra';

    try {
        // فیلتر جداولی که واقعا وجود دارند
        $existingTables = [];
        $tableExistStmt = $pdo->prepare("SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = ?");
        foreach ($targetTables as $tbl) {
            try {
                $tableExistStmt->execute([$tbl]);
                if ($tableExistStmt->fetchColumn()) {
                    $existingTables[] = $tbl;
                }
            } catch (PDOException $e) {
                // نادیده گرفتن خطای بررسی وجود جدول، صرفا لاگ
                logError("Table existence check failed for {$tbl}: " . $e->getMessage());
            }
        }

        if (empty($existingTables)) {
            echo "<p>هیچ یک از جداول هدف یافت نشد.</p>";
        } else {
            echo "<p>تعداد جداول یافت شده: " . count($existingTables) . "</p>";
        }

        foreach ($existingTables as $table) {
            echo "<div style='border: 1px solid #ddd; margin: 15px 0; padding: 15px; border-radius: 5px;'>";
            echo "<h3>جدول: " . htmlspecialchars($table) . "</h3>";
            echo "<div><a href='?export=" . urlencode($table) . "' style='display:inline-block;margin:6px 0;padding:6px 10px;background:#2f7d32;color:#fff;border-radius:4px;text-decoration:none'>دانلود اکسل این جدول</a></div>";
            
            try {
                // نمایش ساختار جدول
                $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE 
                                FROM INFORMATION_SCHEMA.COLUMNS 
                                WHERE TABLE_NAME = ?";
                $columnsStmt = $pdo->prepare($columnsQuery);
                $columnsStmt->execute([$table]);
                $columns = $columnsStmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo "<h4>ساختار جدول</h4>";
                echo "<table style='width: 100%; border-collapse: collapse; font-size: 12px;'>";
                echo "<thead><tr><th>نام ستون</th><th>نوع داده</th><th>حداکثر طول</th><th>می‌تواند خالی باشد</th></tr></thead><tbody>";
                foreach ($columns as $column) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($column['COLUMN_NAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($column['DATA_TYPE']) . "</td>";
                    echo "<td>" . ($column['CHARACTER_MAXIMUM_LENGTH'] ?? 'نامحدود') . "</td>";
                    echo "<td>" . ($column['IS_NULLABLE'] == 'YES' ? 'بله' : 'خیر') . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                
                // شمارش کل رکوردها
                $countQuery = "SELECT COUNT(*) as total_records FROM [" . $table . "]";
                $countStmt = $pdo->query($countQuery);
                $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total_records'];
                echo "<h4>تعداد کل رکوردها: " . number_format($totalRecords) . "</h4>";

                // تعیین ستون مرتب‌سازی براساس نوع تاریخ/عددی و نام‌های متداول
                $preferredSortColumn = null;
                $dateTypes = ['date','datetime','smalldatetime','datetime2','datetimeoffset','time'];
                $numericTypes = ['bigint','int','smallint','tinyint','decimal','numeric','float','real'];
                foreach ($columns as $column) {
                    $colName = $column['COLUMN_NAME'];
                    $dataType = strtolower($column['DATA_TYPE']);
                    if (in_array($dataType, $dateTypes) && preg_match('/date|time|tarikh|exam/i', $colName)) {
                        $preferredSortColumn = $colName;
                        break;
                    }
                }
                if ($preferredSortColumn === null) {
                    foreach ($columns as $column) {
                        $colName = $column['COLUMN_NAME'];
                        $dataType = strtolower($column['DATA_TYPE']);
                        if (in_array($dataType, $numericTypes) && preg_match('/id|code|noe|num|counter|count|co_c/i', $colName)) {
                            $preferredSortColumn = $colName;
                            break;
                        }
                    }
                }
                // نمایش تمام رکوردها (یا حداکثر 100 رکورد)
                $limit = min(100, $totalRecords);
                $dataQuery = "SELECT TOP $limit * FROM [" . $table . "]";
                if ($preferredSortColumn) {
                    $dataQuery .= " ORDER BY [" . $preferredSortColumn . "] DESC";
                }
                $dataStmt = $pdo->query($dataQuery);
                $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if ($data) {
                    echo "<h4>نمایش " . count($data) . " رکورد آخر (مرتب‌شده نزولی)</h4>";
                    echo "<div style='max-height: 400px; overflow-y: auto;'>";
                    echo "<table style='width: 100%; border-collapse: collapse; font-size: 11px;'>";
                    echo "<thead><tr>";
                    foreach (array_keys($data[0]) as $columnName) {
                        echo "<th>" . htmlspecialchars($columnName) . "</th>";
                    }
                    echo "</tr></thead><tbody>";
                    
                    foreach ($data as $row) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            $displayValue = htmlspecialchars($value ?? 'NULL');
                            if (mb_strlen($displayValue) > 30) $displayValue = mb_substr($displayValue, 0, 30) . '...';
                            echo "<td>" . $displayValue . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "</div>";
                    
                    if ($totalRecords > 100) {
                        echo "<p><em>فقط 100 رکورد آخر نمایش داده شد. کل رکوردها: " . number_format($totalRecords) . "</em></p>";
                    }
                } else {
                    echo "<p>داده‌ای یافت نشد.</p>";
                }
                
            } catch (PDOException $e) {
                echo "<p class='error'>❌ خطا در تحلیل جدول " . htmlspecialchars($table) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            
            echo "</div>";
        }

        // نمایش ویو در صورت وجود
        try {
            $viewExistStmt = $pdo->prepare("SELECT 1 FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_NAME = ?");
            $viewExistStmt->execute([$targetView]);
            if ($viewExistStmt->fetchColumn()) {
                echo "<div style='border: 2px solid #aaa; margin: 15px 0; padding: 15px; border-radius: 5px;'>";
                echo "<h3>ویو: " . htmlspecialchars($targetView) . "</h3>";
                echo "<div><a href='?export=" . urlencode($targetView) . "' style='display:inline-block;margin:6px 0;padding:6px 10px;background:#2f7d32;color:#fff;border-radius:4px;text-decoration:none'>دانلود اکسل این ویو</a></div>";
                // تعیین ستون مرتب‌سازی برای ویو
                $viewColumnsStmt = $pdo->prepare("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? ORDER BY ORDINAL_POSITION");
                $viewColumnsStmt->execute([$targetView]);
                $viewColumns = $viewColumnsStmt->fetchAll(PDO::FETCH_ASSOC);
                $preferredSortColumn = null;
                $dateTypes = ['date','datetime','smalldatetime','datetime2','datetimeoffset','time'];
                $numericTypes = ['bigint','int','smallint','tinyint','decimal','numeric','float','real'];
                foreach ($viewColumns as $column) {
                    $colName = $column['COLUMN_NAME'];
                    $dataType = strtolower($column['DATA_TYPE']);
                    if (in_array($dataType, $dateTypes) && preg_match('/date|time|tarikh|exam/i', $colName)) {
                        $preferredSortColumn = $colName;
                        break;
                    }
                }
                if ($preferredSortColumn === null) {
                    foreach ($viewColumns as $column) {
                        $colName = $column['COLUMN_NAME'];
                        $dataType = strtolower($column['DATA_TYPE']);
                        if (in_array($dataType, $numericTypes) && preg_match('/id|code|noe|num|counter|count|co_c/i', $colName)) {
                            $preferredSortColumn = $colName;
                            break;
                        }
                    }
                }
                // پیش‌نمایش 100 رکورد آخر
                $viewQuery = "SELECT TOP 100 * FROM [" . $targetView . "]";
                if ($preferredSortColumn) {
                    $viewQuery .= " ORDER BY [" . $preferredSortColumn . "] DESC";
                }
                $viewStmt = $pdo->query($viewQuery);
                $viewData = $viewStmt->fetchAll(PDO::FETCH_ASSOC);
                if ($viewData) {
                    echo "<div style='max-height: 400px; overflow-y: auto;'>";
                    echo "<table style='width: 100%; border-collapse: collapse; font-size: 11px;'>";
                    echo "<thead><tr>";
                    foreach (array_keys($viewData[0]) as $columnName) {
                        echo "<th>" . htmlspecialchars($columnName) . "</th>";
                    }
                    echo "</tr></thead><tbody>";
                    foreach ($viewData as $row) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            $displayValue = htmlspecialchars($value ?? 'NULL');
                            if (mb_strlen($displayValue) > 30) $displayValue = mb_substr($displayValue, 0, 30) . '...';
                            echo "<td>" . $displayValue . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "</div>";
                } else {
                    echo "<p>اطلاعاتی برای نمایش در ویو یافت نشد.</p>";
                }
                echo "</div>";
            } else {
                echo "<p>ویو مشخص‌شده یافت نشد: " . htmlspecialchars($targetView) . "</p>";
            }
        } catch (PDOException $e) {
            echo "<p class='error'>❌ خطا در بررسی/نمایش ویو: " . htmlspecialchars($e->getMessage()) . "</p>";
            logError("View display error: " . $e->getMessage());
        }

    } catch (PDOException $e) {
        echo "<p class='error'>❌ خطا در پردازش آیتم‌های دوره: " . htmlspecialchars($e->getMessage()) . "</p>";
        logError("Doreh items processing error: " . $e->getMessage());
    }
}

// تابع نمایش همه جداول و ویوها به‌همراه فیلدها
function display_all_db_objects($pdo, $dbName) {
    echo "<h2>همه جداول و ویوها در دیتابیس " . htmlspecialchars($dbName) . "</h2>";

    try {
        // دریافت لیست جداول
        $tablesStmt = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE' ORDER BY TABLE_NAME");
        $tables = $tablesStmt->fetchAll(PDO::FETCH_COLUMN);

        // دریافت لیست ویوها
        $viewsStmt = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.VIEWS ORDER BY TABLE_NAME");
        $views = $viewsStmt->fetchAll(PDO::FETCH_COLUMN);

        echo "<h3>جداول (" . count($tables) . ")</h3>";
        if (empty($tables)) {
            echo "<p>جدولی یافت نشد.</p>";
        }
        foreach ($tables as $table) {
            echo "<div style='border: 1px solid #ddd; margin: 15px 0; padding: 15px; border-radius: 5px;'>";
            echo "<h4>جدول: " . htmlspecialchars($table) . "</h4>";
            echo "<div><a href='?export=" . urlencode($table) . "' style='display:inline-block;margin:6px 0;padding:6px 10px;background:#2f7d32;color:#fff;border-radius:4px;text-decoration:none'>دانلود اکسل این جدول</a></div>";

            try {
                $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE 
                                 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? ORDER BY ORDINAL_POSITION";
                $columnsStmt = $pdo->prepare($columnsQuery);
                $columnsStmt->execute([$table]);
                $columns = $columnsStmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<table style='width: 100%; border-collapse: collapse; font-size: 12px;'>";
                echo "<thead><tr><th>نام ستون</th><th>نوع داده</th><th>حداکثر طول</th><th>Nullable</th></tr></thead><tbody>";
                foreach ($columns as $column) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($column['COLUMN_NAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($column['DATA_TYPE']) . "</td>";
                    echo "<td>" . ($column['CHARACTER_MAXIMUM_LENGTH'] ?? 'نامحدود') . "</td>";
                    echo "<td>" . ($column['IS_NULLABLE'] === 'YES' ? 'بله' : 'خیر') . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                // شمارش کل رکوردها و پیشنمایش دادهها
                try {
                    $countQuery = "SELECT COUNT(*) as total_records FROM [" . $table . "]";
                    $countStmt = $pdo->query($countQuery);
                    $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total_records'];
                    echo "<h4>تعداد کل رکوردها: " . number_format($totalRecords) . "</h4>";

                    // تعیین ستون مرتبسازی
                    $preferredSortColumn = null;
                    $dateTypes = ['date','datetime','smalldatetime','datetime2','datetimeoffset','time'];
                    $numericTypes = ['bigint','int','smallint','tinyint','decimal','numeric','float','real'];
                    foreach ($columns as $column) {
                        $colName = $column['COLUMN_NAME'];
                        $dataType = strtolower($column['DATA_TYPE']);
                        if (in_array($dataType, $dateTypes) && preg_match('/date|time|tarikh|exam/i', $colName)) {
                            $preferredSortColumn = $colName;
                            break;
                        }
                    }
                    if ($preferredSortColumn === null) {
                        foreach ($columns as $column) {
                            $colName = $column['COLUMN_NAME'];
                            $dataType = strtolower($column['DATA_TYPE']);
                            if (in_array($dataType, $numericTypes) && preg_match('/id|code|noe|num|counter|count|co_c/i', $colName)) {
                                $preferredSortColumn = $colName;
                                break;
                            }
                        }
                    }

                    $limit = (int) min(100, (int) $totalRecords);
                    if ($limit > 0) {
                        $dataQuery = "SELECT TOP $limit * FROM [" . $table . "]";
                        if ($preferredSortColumn) {
                            $dataQuery .= " ORDER BY [" . $preferredSortColumn . "] DESC";
                        }
                        $dataStmt = $pdo->query($dataQuery);
                        $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($data) {
                            echo "<h4>نمایش " . count($data) . " رکورد آخر (مرتبشده نزولی)</h4>";
                            echo "<div style='max-height: 400px; overflow-y: auto;'>";
                            echo "<table style='width: 100%; border-collapse: collapse; font-size: 11px;'>";
                            echo "<thead><tr>";
                            foreach (array_keys($data[0]) as $columnName) {
                                echo "<th>" . htmlspecialchars($columnName) . "</th>";
                            }
                            echo "</tr></thead><tbody>";
                            foreach ($data as $row) {
                                echo "<tr>";
                                foreach ($row as $value) {
                                    $displayValue = htmlspecialchars($value ?? 'NULL');
                                    if (mb_strlen($displayValue) > 30) $displayValue = mb_substr($displayValue, 0, 30) . '...';
                                    echo "<td>" . $displayValue . "</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            echo "</div>";
                            if ($totalRecords > 100) {
                                echo "<p><em>فقط 100 رکورد آخر نمایش داده شد. کل رکوردها: " . number_format($totalRecords) . "</em></p>";
                            }
                        }
                    }
                } catch (PDOException $e) {
                    echo "<p class='error'>❌ خطا در دریافت دادههای جدول " . htmlspecialchars($table) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            } catch (PDOException $e) {
                echo "<p class='error'>❌ خطا در دریافت ستون‌های جدول " . htmlspecialchars($table) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
            }

            echo "</div>";
        }

        echo "<h3>ویوها (" . count($views) . ")</h3>";
        if (empty($views)) {
            echo "<p>ویویی یافت نشد.</p>";
        }
        foreach ($views as $view) {
            echo "<div style='border: 1px dashed #bbb; margin: 15px 0; padding: 15px; border-radius: 5px; background:#fafafa'>";
            echo "<h4>ویو: " . htmlspecialchars($view) . "</h4>";
            echo "<div><a href='?export=" . urlencode($view) . "' style='display:inline-block;margin:6px 0;padding:6px 10px;background:#2f7d32;color:#fff;border-radius:4px;text-decoration:none'>دانلود اکسل این ویو</a></div>";

            try {
                $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE 
                                 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? ORDER BY ORDINAL_POSITION";
                $columnsStmt = $pdo->prepare($columnsQuery);
                $columnsStmt->execute([$view]);
                $columns = $columnsStmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<table style='width: 100%; border-collapse: collapse; font-size: 12px;'>";
                echo "<thead><tr><th>نام ستون</th><th>نوع داده</th><th>حداکثر طول</th><th>Nullable</th></tr></thead><tbody>";
                foreach ($columns as $column) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($column['COLUMN_NAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($column['DATA_TYPE']) . "</td>";
                    echo "<td>" . ($column['CHARACTER_MAXIMUM_LENGTH'] ?? 'نامحدود') . "</td>";
                    echo "<td>" . ($column['IS_NULLABLE'] === 'YES' ? 'بله' : 'خیر') . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                // پیشنمایش دادههای ویو (TOP 100) بههمراه مرتبسازی هوشمند
                try {
                    // تعیین ستون مرتبسازی براساس نوع تاریخ/عددی و نامهای متداول
                    $preferredSortColumn = null;
                    $dateTypes = ['date','datetime','smalldatetime','datetime2','datetimeoffset','time'];
                    $numericTypes = ['bigint','int','smallint','tinyint','decimal','numeric','float','real'];
                    foreach ($columns as $column) {
                        $colName = $column['COLUMN_NAME'];
                        $dataType = strtolower($column['DATA_TYPE']);
                        if (in_array($dataType, $dateTypes) && preg_match('/date|time|tarikh|exam/i', $colName)) {
                            $preferredSortColumn = $colName;
                            break;
                        }
                    }
                    if ($preferredSortColumn === null) {
                        foreach ($columns as $column) {
                            $colName = $column['COLUMN_NAME'];
                            $dataType = strtolower($column['DATA_TYPE']);
                            if (in_array($dataType, $numericTypes) && preg_match('/id|code|noe|num|counter|count|co_c/i', $colName)) {
                                $preferredSortColumn = $colName;
                                break;
                            }
                        }
                    }

                    $viewQuery = "SELECT TOP 100 * FROM [" . $view . "]";
                    if ($preferredSortColumn) {
                        $viewQuery .= " ORDER BY [" . $preferredSortColumn . "] DESC";
                    }
                    $viewStmt = $pdo->query($viewQuery);
                    $viewData = $viewStmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($viewData) {
                        echo "<div style='max-height: 400px; overflow-y: auto;'>";
                        echo "<table style='width: 100%; border-collapse: collapse; font-size: 11px;'>";
                        echo "<thead><tr>";
                        foreach (array_keys($viewData[0]) as $columnName) {
                            echo "<th>" . htmlspecialchars($columnName) . "</th>";
                        }
                        echo "</tr></thead><tbody>";
                        foreach ($viewData as $row) {
                            echo "<tr>";
                            foreach ($row as $value) {
                                $displayValue = htmlspecialchars($value ?? 'NULL');
                                if (mb_strlen($displayValue) > 30) $displayValue = mb_substr($displayValue, 0, 30) . '...';
                                echo "<td>" . $displayValue . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                        echo "</div>";
                    } else {
                        echo "<p>اطلاعاتی برای نمایش در ویو یافت نشد.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='error'>❌ خطا در دریافت دادههای ویو " . htmlspecialchars($view) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            } catch (PDOException $e) {
                echo "<p class='error'>❌ خطا در دریافت ستون‌های ویو " . htmlspecialchars($view) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
            }

            echo "</div>";
        }

    } catch (PDOException $e) {
        echo "<p class='error'>❌ خطا در فهرست‌کردن جداول/ویوها: " . htmlspecialchars($e->getMessage()) . "</p>";
        logError("List tables/views error: " . $e->getMessage());
    }
}

// تنظیمات اصلی
$server_ip = "185.128.81.210";
$port = "2033";
$username = "kwphc.ir_englishuser";
$password = "654DSF#@F0k";

// محافظت کامل از اجرای اسکریپت
try {
    // اتصال به دیتابیس (در صورت نیاز نام دیتابیس را اصلاح کنید)
    $dsn = "sqlsrv:Server=$server_ip,$port;Database=kwphc.ir_english";
    $pdo_azmoon = new PDO($dsn, $username, $password);
    $pdo_azmoon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // اجرای تابع نمایش آیتم‌های دوره
    display_doreh_objects($pdo_azmoon, 'kwphc.ir_english');

} catch (PDOException $mainError) {
    echo "<p class='error'>❌ خطای اصلی در اتصال به دیتابیس: " . htmlspecialchars($mainError->getMessage()) . "</p>";
    logError("Main database connection error: " . $mainError->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دوره‌ها - دیتابیس kwphc.ir_english</title>
    <style>
        body { font-family: Tahoma, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1400px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1, h2 { text-align: center; color: #333; }
        .tab-container { overflow: hidden; border: 1px solid #ccc; background-color: #f1f1f1; border-radius: 5px 5px 0 0; }
        .tab-container button { background-color: inherit; float: right; border: none; outline: none; cursor: pointer; padding: 14px 16px; transition: 0.3s; font-size: 17px; font-family: Tahoma; }
        .tab-container button:hover { background-color: #ddd; }
        .tab-container button.active { background-color: #ccc; font-weight: bold; }
        .tab-content { display: none; padding: 20px; border: 1px solid #ccc; border-top: none; border-radius: 0 0 5px 5px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; margin-top: 10px; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: right; }
        thead { background: #f2f2f2; }
        .success { color: green; }
        .error { color: red; }
        .azmoon-section { background: #f9f9f9; padding: 15px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h1>مدیریت دوره‌ها - دیتابیس kwphc.ir_english</h1>

    <div class="tab-container">
        <button class="tab-links active" onclick="openDatabase(event, 'doreh_tab')">دوره‌ها</button>
        <button class="tab-links" onclick="openDatabase(event, 'all_objects_tab')">همه جداول و ویوها</button>
    </div>

    <div id="doreh_tab" class="tab-content">
        <div class="azmoon-section">
            <h2>جداول/ویوهای مرتبط با دوره در دیتابیس kwphc.ir_english</h2>
            <div style="margin:10px 0">
                <a href="?export=VNWDoreh_Ejra" class="download-btn" style="display:inline-block;padding:8px 12px;background:#2f7d32;color:#fff;border-radius:4px;text-decoration:none">دانلود اکسل (تمام رکوردهای ویو VNWDoreh_Ejra)</a>
            </div>
            <?php
            // تنظیمات اصلی
            $server_ip = "185.128.81.210";
            $port = "2033";
            $username = "kwphc.ir_englishuser";
            $password = "654DSF#@F0k";

            if (empty($password) || $password === 'YOUR_PASSWORD_HERE') {
                echo "<p class='error'>⚠️ پسورد در اسکریپت تنظیم نشده است!</p>";
            } else {
                try {
                    $dsn = "sqlsrv:Server=$server_ip,$port;Database=kwphc.ir_english";
                    $pdo_azmoon = new PDO($dsn, $username, $password);
                    $pdo_azmoon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // اجرای تابع نمایش جداول/ویوهای دوره
                    display_doreh_objects($pdo_azmoon, 'kwphc.ir_english');
                    
                } catch (PDOException $e) {
                    echo "<p class='error'>❌ خطا در اتصال به دیتابیس: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
            ?>
        </div>
    </div>

    <div id="all_objects_tab" class="tab-content">
        <div class="azmoon-section">
            <h2>فهرست کامل جداول و ویوها در دیتابیس kwphc.ir_english</h2>
            <?php
            // اتصال مجدد یا استفاده از همان اتصال
            try {
                $dsn = "sqlsrv:Server=$server_ip,$port;Database=kwphc.ir_english";
                $pdo_all = new PDO($dsn, $username, $password);
                $pdo_all->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                display_all_db_objects($pdo_all, 'kwphc.ir_english');
            } catch (PDOException $e) {
                echo "<p class='error'>❌ خطا در اتصال/نمایش فهرست کامل: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </div>

</div>

<script>
    function openDatabase(evt, dbName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tab-links");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(dbName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Open the first tab by default
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementsByClassName('tab-links')[0].click();
    });
</script>

</body>
</html> 