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

// تابع نمایش جداول مرتبط با Kw_Azmoon
function display_azmoon_tables($pdo, $dbName) {
    echo "<h2>جداول مرتبط با آزمون در دیتابیس " . htmlspecialchars($dbName) . "</h2>";
    
    try {
        // جستجوی جداول مرتبط با آزمون
        $azmoonTablesQuery = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES 
                              WHERE TABLE_TYPE = 'BASE TABLE' 
                              AND (TABLE_NAME LIKE '%azmoon%' OR TABLE_NAME LIKE '%Azmoon%' OR TABLE_NAME LIKE '%AZMOON%' 
                                  OR TABLE_NAME LIKE '%kw_azmoon%' OR TABLE_NAME LIKE '%Kw_Azmoon%')";
        $azmoonTablesStmt = $pdo->query($azmoonTablesQuery);
        $azmoonTables = $azmoonTablesStmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (empty($azmoonTables)) {
            echo "<p>هیچ جدول مرتبط با آزمون یافت نشد.</p>";
            return;
        }
        
        echo "<p>تعداد جداول مرتبط با آزمون: " . count($azmoonTables) . "</p>";
        
        foreach ($azmoonTables as $table) {
            echo "<div style='border: 1px solid #ddd; margin: 15px 0; padding: 15px; border-radius: 5px;'>";
            echo "<h3>جدول: " . htmlspecialchars($table) . "</h3>";
            
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
                
                // نمایش تمام رکوردها (یا حداکثر 50 رکورد)
                $limit = min(50, $totalRecords);
                $dataQuery = "SELECT TOP $limit * FROM [" . $table . "]";
                $dataStmt = $pdo->query($dataQuery);
                $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if ($data) {
                    echo "<h4>نمایش " . count($data) . " رکورد اول</h4>";
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
                    
                    if ($totalRecords > 50) {
                        echo "<p><em>فقط 50 رکورد اول نمایش داده شد. کل رکوردها: " . number_format($totalRecords) . "</em></p>";
                    }
                } else {
                    echo "<p>داده‌ای یافت نشد.</p>";
                }
                
            } catch (PDOException $e) {
                echo "<p class='error'>❌ خطا در تحلیل جدول " . htmlspecialchars($table) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            
            echo "</div>";
        }
        
    } catch (PDOException $e) {
        echo "<p class='error'>❌ خطا در جستجوی جداول آزمون: " . htmlspecialchars($e->getMessage()) . "</p>";
        logError("Azmoon tables search error: " . $e->getMessage());
    }
}

// تنظیمات اصلی
$server_ip = "185.128.81.210";
$port = "2033";
$username = "kwphc.ir_mainuesr";
$password = "AS*35Rt%@-l5f";

// محافظت کامل از اجرای اسکریپت
try {
    // اتصال به دیتابیس
    $dsn = "sqlsrv:Server=$server_ip,$port;Database=kwphc.ir_main";
    $pdo_azmoon = new PDO($dsn, $username, $password);
    $pdo_azmoon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // اجرای تابع نمایش جداول آزمون
    display_azmoon_tables($pdo_azmoon, 'kwphc.ir_main');

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
    <title>مدیریت آزمون‌ها - دیتابیس kwphc.ir_main</title>
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
    <h1>مدیریت آزمون‌ها - دیتابیس kwphc.ir_main</h1>

    <div class="tab-container">
        <button class="tab-links active" onclick="openDatabase(event, 'azmoon_tab')">جداول آزمون</button>
    </div>

    <div id="azmoon_tab" class="tab-content">
        <div class="azmoon-section">
            <h2>جداول مرتبط با آزمون در دیتابیس kwphc.ir_main</h2>
            <?php
            // تنظیمات اصلی
            $server_ip = "185.128.81.210";
            $port = "2033";
            $username = "kwphc.ir_mainuesr";
            $password = "AS*35Rt%@-l5f";

            if (empty($password) || $password === 'YOUR_PASSWORD_HERE') {
                echo "<p class='error'>⚠️ پسورد در اسکریپت تنظیم نشده است!</p>";
            } else {
                try {
                    $dsn = "sqlsrv:Server=$server_ip,$port;Database=kwphc.ir_main";
                    $pdo_azmoon = new PDO($dsn, $username, $password);
                    $pdo_azmoon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // اجرای تابع نمایش جداول آزمون
                    display_azmoon_tables($pdo_azmoon, 'kwphc.ir_main');
                    
                } catch (PDOException $e) {
                    echo "<p class='error'>❌ خطا در اتصال به دیتابیس: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
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