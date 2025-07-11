<?php
// تنظیمات گزارش خطا برای دیباگ
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * تست اتصال به چند دیتابیس SQL Server با رابط کاربری تب‌بندی شده
 */

// تابع لاگ خطا
function logError($message) {
    $logFile = '/tmp/database_error_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// تابع اصلی جستجو با گزارش خطای کامل
function search_database_main($pdo, $dbName, $searchTerm) {
    try {
        echo "<h3>نتایج جستجو برای کلمه '<code>" . htmlspecialchars($searchTerm) . "</code>' در دیتابیس " . htmlspecialchars($dbName) . "</h3>";
        
        // 1. دریافت تمام جداول
        $tablesQuery = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_NAME != 'SalahiyatInfo'";
        $tables = $pdo->query($tablesQuery)->fetchAll(PDO::FETCH_COLUMN);
        $foundResults = [];
        
        echo "<p>درحال جستجو در " . count($tables) . " جدول...</p>";

        foreach ($tables as $table) {
            try {
                // 2. دریافت ستون‌های متنی برای هر جدول
                $columnsQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND DATA_TYPE IN ('varchar', 'nvarchar', 'char', 'nchar', 'text', 'ntext')";
                $colStmt = $pdo->prepare($columnsQuery);
                $colStmt->execute([$table]);
                $textColumns = $colStmt->fetchAll(PDO::FETCH_COLUMN);

                foreach ($textColumns as $column) {
                    // 3. جستجو در هر ستون متنی
                    $searchQuery = "SELECT COUNT(*) as count FROM [" . $table . "] WHERE [" . $column . "] LIKE ?";
                    $searchStmt = $pdo->prepare($searchQuery);
                    $searchStmt->execute(['%' . $searchTerm . '%']);
                    $result = $searchStmt->fetch(PDO::FETCH_ASSOC);

                    if ($result && $result['count'] > 0) {
                        $foundResults[] = [
                            'table' => $table,
                            'column' => $column,
                            'count' => $result['count']
                        ];
                    }
                }
            } catch (PDOException $tableError) {
                echo "<p class='error'>❌ خطا در جدول " . htmlspecialchars($table) . ": " . htmlspecialchars($tableError->getMessage()) . "</p>";
                logError("Error in table $table: " . $tableError->getMessage());
            }
        }
        
        // 4. نمایش نتایج
        if (!empty($foundResults)) {
            echo "<table style='width: 60%;'><thead><tr><th>جدول</th><th>ستون</th><th>تعداد یافت شده</th></tr></thead><tbody>";
            foreach ($foundResults as $found) {
                echo "<tr><td>" . htmlspecialchars($found['table']) . "</td><td>" . htmlspecialchars($found['column']) . "</td><td>" . $found['count'] . "</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>هیچ نتیجه‌ای یافت نشد.</p>";
        }

    } catch (PDOException $e) {
        echo "<p class='error'>❌ خطای کلی در جستجو: " . htmlspecialchars($e->getMessage()) . "</p>";
        logError("General search error: " . $e->getMessage());
    }
}

// تابع تحلیل جدول Kw_DSK با گزارش خطای کامل
function analyze_kw_dsk_table($pdo, $dbName) {
    echo "<div style='margin-top: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 5px;'>";
    echo "<h2>تحلیل جدول Kw_DSK در دیتابیس " . htmlspecialchars($dbName) . "</h2>";

    try {
        // 1. بررسی ساختار جدول
        $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE 
                         FROM INFORMATION_SCHEMA.COLUMNS 
                         WHERE TABLE_NAME = 'Kw_DSK'";
        $columnsStmt = $pdo->query($columnsQuery);
        $columns = $columnsStmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3>ساختار جدول</h3>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
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

        // 2. شمارش کل رکوردها
        $countQuery = "SELECT COUNT(*) as total_records FROM Kw_DSK";
        $countStmt = $pdo->query($countQuery);
        $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total_records'];
        echo "<h3>تعداد کل رکوردها: " . number_format($totalRecords) . "</h3>";

        // 3. نمایش 10 رکورد اول
        $dataQuery = "SELECT TOP 10 * FROM Kw_DSK";
        $dataStmt = $pdo->query($dataQuery);
        $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3>10 رکورد اول</h3>";
        echo "<div style='max-height: 400px; overflow-y: auto;'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<thead><tr>";
        foreach (array_keys($data[0]) as $columnName) {
            echo "<th>" . htmlspecialchars($columnName) . "</th>";
        }
        echo "</tr></thead><tbody>";
        
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                $displayValue = htmlspecialchars($value ?? 'NULL');
                if (mb_strlen($displayValue) > 50) $displayValue = mb_substr($displayValue, 0, 50) . '...';
                echo "<td>" . $displayValue . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div>";

        // تابع تحلیل تفصیلی ستون‌های Kw_DSK
        function detailed_column_analysis($columns) {
            $columnDescriptions = [
                'co_c' => [
                    'توضیح' => 'کد شناسایی منحصر به فرد دوره یا کلاس',
                    'نوع' => 'رشته ثابت 8 کاراکتری',
                    'مثال' => 'KW-1402'
                ],
                'co_doreh' => [
                    'توضیح' => 'کد دوره آموزشی',
                    'نوع' => 'رشته 12 کاراکتری',
                    'می‌تواند خالی باشد' => 'بله'
                ],
                'Date_Start' => [
                    'توضیح' => 'تاریخ شروع دوره',
                    'نوع' => 'تاریخ شمسی 10 کاراکتری',
                    'فرمت' => 'YYYY/MM/DD'
                ],
                'Date_Final' => [
                    'توضیح' => 'تاریخ پایان دوره',
                    'نوع' => 'تاریخ شمسی 10 کاراکتری',
                    'فرمت' => 'YYYY/MM/DD'
                ],
                'Day1' => [
                    'توضیح' => 'روز اول برگزاری کلاس',
                    'نوع' => 'نام روز فارسی',
                    'می‌تواند خالی باشد' => 'بله',
                    'مثال' => 'شنبه، یکشنبه'
                ],
                'T_S1' => [
                    'توضیح' => 'ساعت شروع جلسه اول',
                    'نوع' => 'ساعت 10 کاراکتری',
                    'فرمت' => 'HH:MM'
                ],
                'T_F1' => [
                    'توضیح' => 'ساعت پایان جلسه اول',
                    'نوع' => 'ساعت 10 کاراکتری',
                    'فرمت' => 'HH:MM'
                ],
                'Title' => [
                    'توضیح' => 'عنوان دوره یا کلاس',
                    'نوع' => 'متن فارسی 300 کاراکتری',
                    'می‌تواند خالی باشد' => 'بله'
                ],
                'Kind' => [
                    'توضیح' => 'نوع دوره',
                    'نوع' => 'کد 1 کاراکتری',
                    'مثال' => 'آنلاین، حضوری'
                ],
                'Time_Nazari' => [
                    'توضیح' => 'ساعات تئوری',
                    'نوع' => 'عدد 3 رقمی'
                ],
                'Time_Amali' => [
                    'توضیح' => 'ساعات عملی',
                    'نوع' => 'عدد 3 رقمی'
                ],
                'Name_Ostad' => [
                    'توضیح' => 'نام مدرس',
                    'نوع' => 'نام فارسی 50 کاراکتری'
                ],
                'Reshteh_Ostad' => [
                    'توضیح' => 'رشته تحصیلی مدرس',
                    'نوع' => 'رشته تحصیلی 50 کاراکتری'
                ],
                'Mokhatabin' => [
                    'توضیح' => 'مخاطبان دوره',
                    'نوع' => 'متن فارسی 500 کاراکتری',
                    'می‌تواند خالی باشد' => 'بله'
                ],
                'Mohtava' => [
                    'توضیح' => 'محتوای آموزشی دوره',
                    'نوع' => 'متن بلند نامحدود',
                    'می‌تواند خالی باشد' => 'بله'
                ],
                'H_Amoozeshi' => [
                    'توضیح' => 'ساعات آموزشی',
                    'نوع' => 'عدد صحیح'
                ],
                'Mahal' => [
                    'توضیح' => 'محل برگزاری دوره',
                    'نوع' => 'آدرس 200 کاراکتری',
                    'می‌تواند خالی باشد' => 'بله'
                ],
                'PostibaniTel' => [
                    'توضیح' => 'شماره تماس پشتیبانی',
                    'نوع' => 'شماره تلفن 30 کاراکتری',
                    'می‌تواند خالی باشد' => 'بله'
                ]
            ];

            echo "<div style='background-color: #f9f9f9; padding: 20px; border-radius: 10px; direction: rtl;'>";
            echo "<h2>تحلیل تفصیلی ستون‌های جدول Kw_DSK</h2>";
            
            echo "<table style='width: 100%; border-collapse: collapse;'>";
            echo "<thead style='background-color: #e0e0e0;'><tr>
                    <th>نام ستون</th>
                    <th>توضیح</th>
                    <th>نوع داده</th>
                    <th>قابلیت خالی بودن</th>
                  </tr></thead><tbody>";
            
            foreach ($columns as $column) {
                $name = $column['COLUMN_NAME'];
                $desc = $columnDescriptions[$name] ?? ['توضیح' => 'توضیح موجود نیست'];
                
                echo "<tr style='border-bottom: 1px solid #ddd;'>";
                echo "<td style='font-weight: bold;'>" . htmlspecialchars($name) . "</td>";
                echo "<td>" . htmlspecialchars($desc['توضیح']) . "</td>";
                echo "<td>" . htmlspecialchars($column['DATA_TYPE'] . " (" . ($column['CHARACTER_MAXIMUM_LENGTH'] ?? 'نامحدود') . ")") . "</td>";
                echo "<td>" . ($column['IS_NULLABLE'] == 'YES' ? 'می‌تواند خالی باشد' : 'نمی‌تواند خالی باشد') . "</td>";
                echo "</tr>";
            }
            
            echo "</tbody></table>";
            echo "</div>";
        }
        detailed_column_analysis($columns);

    } catch (PDOException $e) {
        echo "<p class='error'>❌ خطا در تحلیل جدول: " . htmlspecialchars($e->getMessage()) . "</p>";
        logError("Kw_DSK table analysis error: " . $e->getMessage());
    }

    echo "</div>";
}

// تنظیمات اصلی
$server_ip = "185.128.81.210";
$port = "2033";
$username = "kwphc.ir_mainuesr";
$password = "AS*35Rt%@-l5f";

// لیست جداول برای نمایش
$selectedTablesMain = []; // اگر خالی باشد، لیست تمام جداول را می‌گیرد

// محدود کردن جستجو به دیتابیس kwphc.ir_main
$databasesToSearch = ['kwphc.ir_main'];
$searchTerm = 'composit.jpg';

// محافظت کامل از اجرای اسکریپت
try {
    // اتصال به دیتابیس
    $dsn = "sqlsrv:Server=$server_ip,$port;Database={$databasesToSearch[0]}";
    $pdo_search = new PDO($dsn, $username, $password);
    $pdo_search->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // اجرای توابع
    search_database_main($pdo_search, $databasesToSearch[0], $searchTerm);
    analyze_kw_dsk_table($pdo_search, $databasesToSearch[0]);

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
    <title>تست اتصال به چند دیتابیس SQL Server</title>
    <style>
        body { font-family: Tahoma, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1400px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1, h2 { text-align: center; color: #333; }
        .tab-container { overflow: hidden; border: 1px solid #ccc; background-color: #f1f1f1; border-radius: 5px 5px 0 0; }
        .tab-container button { background-color: inherit; float: right; border: none; outline: none; cursor: pointer; padding: 14px 16px; transition: 0.3s; font-size: 17px; font-family: Tahoma; }
        .tab-container button:hover { background-color: #ddd; }
        .tab-container button.active { background-color: #ccc; font-weight: bold; }
        .tab-content { display: none; padding: 20px; border: 1px solid #ccc; border-top: none; border-radius: 0 0 5px 5px; }
        details { margin-bottom: 15px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #fafafa; }
        summary { font-size: 16px; font-weight: bold; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; margin-top: 10px; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: right; }
        thead { background: #f2f2f2; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="container">
    <h1>تست اتصال به دیتابیس‌های SQL Server</h1>

    <div class="tab-container">
        <button class="tab-links active" onclick="openDatabase(event, 'english_db')">kwphc.ir_english</button>
        <button class="tab-links" onclick="openDatabase(event, 'main_db')">kwphc.ir_main</button>
        <button class="tab-links" onclick="openDatabase(event, 'search_tab')" style="background-color: #d4edda; color: #155724;">جستجوی سراسری</button>
    </div>

    <?php
    // --- تنظیمات اصلی ---
    $server_ip = "185.128.81.210";
    $port = "2033";
    $username = "kwphc.ir_mainuesr";
    $password = "AS*35Rt%@-l5f"; // !!! پسورد را اینجا وارد کنید !!!

    // --- لیست جداول برای نمایش ---
    $selectedTablesEnglish = [
        'Coding_Doreh', 'Coding_Sath', 'En_Contact', 'En_DayWeek', 'En_Doreh', 'En_News', 
        'En_ProFile', 'En_RecepTeacher', 'En_Register', 'Na_Articles', 
        'Na_Nashriyeh', 'NWCoding_Doreh', 'NWCoding_Masold', 
        'NWCoding_Noe_Doreh', 'NWDoreh_Ejra'
    ];
    // برای دیتابیس main می‌توانید لیست جداول متفاوتی تعریف کنید
    $selectedTablesMain = []; // اگر خالی باشد، لیست تمام جداول را می‌گیرد

    /**
     * تابع برای جستجوی یک کلمه در تمام جداول یک دیتابیس
     */
    function search_database($pdo, $dbName, $searchTerm) {
        echo "<h3>نتایج جستجو برای کلمه '<code>" . htmlspecialchars($searchTerm) . "</code>' در دیتابیس " . htmlspecialchars($dbName) . "</h3>";
        
        try {
            // 1. دریافت تمام جداول
            $tablesQuery = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'";
            $tables = $pdo->query($tablesQuery)->fetchAll(PDO::FETCH_COLUMN);
            $foundResults = [];
            
            echo "<p>درحال جستجو در " . count($tables) . " جدول...</p>";

            foreach ($tables as $table) {
                // 2. دریافت ستون‌های متنی برای هر جدول
                $columnsQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND DATA_TYPE IN ('varchar', 'nvarchar', 'char', 'nchar', 'text', 'ntext')";
                $colStmt = $pdo->prepare($columnsQuery);
                $colStmt->execute([$table]);
                $textColumns = $colStmt->fetchAll(PDO::FETCH_COLUMN);

                foreach ($textColumns as $column) {
                    // 3. جستجو در هر ستون متنی
                    $searchQuery = "SELECT COUNT(*) as count FROM [" . $table . "] WHERE [" . $column . "] LIKE ?";
                    $searchStmt = $pdo->prepare($searchQuery);
                    // Use N prefix for Unicode search in SQL Server
                    $searchStmt->execute(['%' . $searchTerm . '%']);
                    $result = $searchStmt->fetch(PDO::FETCH_ASSOC);

                    if ($result && $result['count'] > 0) {
                        $foundResults[] = [
                            'table' => $table,
                            'column' => $column,
                            'count' => $result['count']
                        ];
                    }
                }
            }
            
            // 4. نمایش نتایج
            if (!empty($foundResults)) {
                echo "<table style='width: 60%;'><thead><tr><th>جدول</th><th>ستون</th><th>تعداد یافت شده</th></tr></thead><tbody>";
                foreach ($foundResults as $found) {
                    echo "<tr><td>" . htmlspecialchars($found['table']) . "</td><td>" . htmlspecialchars($found['column']) . "</td><td>" . $found['count'] . "</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>هیچ نتیجه‌ای یافت نشد.</p>";
            }

        } catch (PDOException $e) {
            echo "<p class='error'>❌ خطا در حین جستجو: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    /**
     * تابع اصلی برای اتصال و نمایش اطلاعات یک دیتابیس
     */
    function display_db_info($dbName, $server, $port, $user, $pass, $tablesToShow) {
        echo "<h2>بررسی دیتابیس: $dbName</h2>";

        // 1. تست اتصال شبکه
        $socket = @fsockopen($server, $port, $errno, $errstr, 5);
        if (!$socket) {
            echo "<p class='error'>❌ اتصال شبکه به $server:$port ناموفق بود. سرور در دسترس نیست یا پورت مسدود است.</p>";
            return; // ادامه نمی‌دهیم
        }
        echo "<p class='success'>✅ اتصال شبکه موفق.</p>";
        fclose($socket);

        if (empty($pass) || $pass === 'YOUR_PASSWORD_HERE') {
            echo "<p class='error'>⚠️ پسورد در اسکریپت تنظیم نشده است!</p>";
            return;
        }

        // 2. اتصال به دیتابیس
        $dsn = "sqlsrv:Server=$server,$port;Database=$dbName";
        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p class='success'>✅ اتصال PDO به دیتابیس $dbName موفق بود.</p>";
        } catch (PDOException $e) {
            echo "<p class='error'>❌ خطا در اتصال PDO به دیتابیس $dbName: " . htmlspecialchars($e->getMessage()) . "</p>";
            return;
        }

        // 3. نمایش لیست تمام جداول
        try {
            $allTablesQuery = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' ORDER BY TABLE_NAME";
            $allTablesStmt = $pdo->query($allTablesQuery);
            $allTables = $allTablesStmt->fetchAll(PDO::FETCH_COLUMN);

            if (empty($tablesToShow)) {
                $tablesToShow = $allTables; // اگر لیست خالی بود، همه را نشان بده
            }
            
            echo "<details><summary>لیست تمام جداول یافت شده (" . count($allTables) . ")</summary>";
            echo "<ul style='columns: 4; padding-right: 20px;'>";
            foreach ($allTables as $table) {
                echo "<li>" . htmlspecialchars($table) . "</li>";
            }
            echo "</ul></details>";
        } catch (PDOException $e) {
             echo "<p class='error'>❌ خطا در خواندن لیست جداول: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

        // 4. نمایش ۵ رکورد از جداول منتخب
        echo "<h3>نمایش 5 رکورد از جداول منتخب</h3>";
        foreach ($tablesToShow as $table) {
            $safeTableName = str_replace(['[', ']'], '', $table);
            echo "<details><summary>جدول: " . htmlspecialchars($safeTableName) . "</summary>";
            try {
                $query = "SELECT TOP 5 * FROM [" . $safeTableName . "]";
                $stmt = $pdo->query($query);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($data) {
                    echo "<div style='overflow-x: auto; margin-top: 10px;'><table>";
                    echo "<thead><tr>";
                    foreach (array_keys($data[0]) as $column) echo "<th>" . htmlspecialchars($column) . "</th>";
                    echo "</tr></thead><tbody>";
                    foreach ($data as $row) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            $displayValue = htmlspecialchars($value ?? 'NULL');
                            if (mb_strlen($displayValue) > 75) $displayValue = mb_substr($displayValue, 0, 75) . '...';
                            echo "<td>" . $displayValue . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table></div>";
                } else {
                    echo "<p>داده‌ای یافت نشد.</p>";
                }
            } catch (PDOException $e) {
                echo "<p class='error'>❌ خطا: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            echo "</details>";
        }

        $pdo = null; // بستن اتصال
    }
    ?>

    <!-- Tab Content -->
    <div id="english_db" class="tab-content">
        <?php display_db_info('kwphc.ir_english', $server_ip, $port, $username, $password, $selectedTablesEnglish); ?>
    </div>

    <div id="main_db" class="tab-content">
        <?php display_db_info('kwphc.ir_main', $server_ip, $port, $username, $password, $selectedTablesMain); ?>
    </div>

    <div id="search_tab" class="tab-content">
        <h2>جستجوی کلمه "حفاظت کاتدي پيشرفته" در تمام دیتابیس‌ها</h2>
        <?php
        if (empty($password) || $password === 'YOUR_PASSWORD_HERE') {
            echo "<p class='error'>⚠️ برای جستجو، ابتدا پسورد را در اسکریپت تنظیم کنید!</p>";
        } else {
            $databasesToSearch = ['kwphc.ir_main'];
            $searchTerm = 'composit.jpg';

            // تابع جدید برای تحلیل جدول Kw_DSK
            function analyze_kw_dsk_table($pdo, $dbName) {
                echo "<div style='margin-top: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 5px;'>";
                echo "<h2>تحلیل جدول Kw_DSK در دیتابیس " . htmlspecialchars($dbName) . "</h2>";

                try {
                    // 1. بررسی ساختار جدول
                    $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE 
                                     FROM INFORMATION_SCHEMA.COLUMNS 
                                     WHERE TABLE_NAME = 'Kw_DSK'";
                    $columnsStmt = $pdo->query($columnsQuery);
                    $columns = $columnsStmt->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h3>ساختار جدول</h3>";
                    echo "<table style='width: 100%; border-collapse: collapse;'>";
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

                    // 2. شمارش کل رکوردها
                    $countQuery = "SELECT COUNT(*) as total_records FROM Kw_DSK";
                    $countStmt = $pdo->query($countQuery);
                    $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total_records'];
                    echo "<h3>تعداد کل رکوردها: " . number_format($totalRecords) . "</h3>";

                    // 3. نمایش 10 رکورد اول
                    $dataQuery = "SELECT TOP 10 * FROM Kw_DSK";
                    $dataStmt = $pdo->query($dataQuery);
                    $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h3>10 رکورد اول</h3>";
                    echo "<div style='max-height: 400px; overflow-y: auto;'>";
                    echo "<table style='width: 100%; border-collapse: collapse;'>";
                    echo "<thead><tr>";
                    foreach (array_keys($data[0]) as $columnName) {
                        echo "<th>" . htmlspecialchars($columnName) . "</th>";
                    }
                    echo "</tr></thead><tbody>";
                    
                    foreach ($data as $row) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            $displayValue = htmlspecialchars($value ?? 'NULL');
                            if (mb_strlen($displayValue) > 50) $displayValue = mb_substr($displayValue, 0, 50) . '...';
                            echo "<td>" . $displayValue . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "</div>";

                } catch (PDOException $e) {
                    echo "<p class='error'>❌ خطا در تحلیل جدول: " . htmlspecialchars($e->getMessage()) . "</p>";
                }

                echo "</div>";
            }

            foreach ($databasesToSearch as $dbName) {
                echo "<div style='border: 1px solid #eee; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>";
                // اتصال جدید برای هر دیتابیس
                $dsn = "sqlsrv:Server=$server_ip,$port;Database=$dbName";
                try {
                    $pdo_search = new PDO($dsn, $username, $password);
                    $pdo_search->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // اجرای تابع جستجو
                    search_database_main($pdo_search, $dbName, $searchTerm);
                    
                    // اجرای تابع تحلیل جدول Kw_DSK
                    analyze_kw_dsk_table($pdo_search, $dbName);

                } catch (PDOException $e) {
                    echo "<h3>" . htmlspecialchars($dbName) . "</h3>";
                    echo "<p class='error'>❌ امکان اتصال به این دیتابیس برای جستجو وجود ندارد.</p>";
                }
                $pdo_search = null;
                echo "</div>";
            }
        }
        ?>
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