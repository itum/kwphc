<?php
/**
 * SQL Server Database Connection for Plesk
 * اتصال به دیتابیس SQL Server برای محیط Plesk
 */

class SQLServerConnection {
    private $serverName;
    private $database;
    private $username;
    private $password;
    private $connection;
    
    public function __construct() {
        // تنظیمات اتصال به دیتابیس
        $this->serverName = "185.128.81.210:2033"; // آدرس سرور و پورت
        $this->database = "kwphc.ir_english"; // نام دیتابیس
        $this->username = "kwphc.ir_englishuser"; // نام کاربری
        $this->password = "YOUR_PASSWORD_HERE"; // پسورد خود را اینجا وارد کنید
    }
    
    /**
     * اتصال به دیتابیس SQL Server
     */
    public function connect() {
        // بررسی اکستنشن‌های مورد نیاز
        if (!extension_loaded('pdo')) {
            $error = "خطا: اکستنشن PDO نصب نیست";
            error_log($error);
            echo $error . "<br>";
            return false;
        }
        
        if (!extension_loaded('pdo_sqlsrv')) {
            $error = "خطا: اکستنشن PDO_SQLSRV نصب نیست";
            error_log($error);
            echo $error . "<br>";
            return false;
        }
        
        // بررسی اطلاعات اتصال
        if (empty($this->password) || $this->password === 'YOUR_PASSWORD_HERE') {
            $error = "خطا: پسورد تنظیم نشده است. لطفاً در فایل database-connection.php پسورد را وارد کنید";
            error_log($error);
            echo $error . "<br>";
            return false;
        }
        
        // نمایش اطلاعات اتصال برای دیباگ
        echo "<strong>تلاش برای اتصال با اطلاعات:</strong><br>";
        echo "سرور: " . $this->serverName . "<br>";
        echo "دیتابیس: " . $this->database . "<br>";
        echo "کاربر: " . $this->username . "<br>";
        echo "پسورد: " . (empty($this->password) ? 'خالی' : '***تنظیم شده***') . "<br><br>";
        
        try {
            // تست فرمت‌های مختلف DSN
            // SQL Server فرمت‌های مختلف برای server و port دارد
            $server_ip = "185.128.81.210";
            $port = "2033";
            
            $dsnFormats = [
                // فرمت استاندارد با کاما (اصلی)
                "sqlsrv:Server={$server_ip},{$port};Database={$this->database}",
                
                // فرمت ساده بدون پورت (پورت پیش‌فرض 1433)
                "sqlsrv:Server={$server_ip};Database={$this->database}",
                
                // فرمت با named instance (اگر سرور instance دارد)
                "sqlsrv:Server={$server_ip}\\SQLEXPRESS;Database={$this->database}"
            ];
            
            $lastError = '';
            
            foreach ($dsnFormats as $index => $dsn) {
                try {
                    echo "تلاش " . ($index + 1) . ": " . $dsn . "<br>";
                    
                                         // ایجاد اتصال بدون تنظیمات پیچیده
                     $this->connection = new PDO($dsn, $this->username, $this->password);
                     
                     // تنظیم error mode بعد از اتصال
                     $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // تست اتصال
                    $this->connection->query("SELECT 1");
                    
                    echo "<span style='color: green;'>✅ اتصال موفق با DSN شماره " . ($index + 1) . "</span><br>";
                    error_log("اتصال موفق به دیتابیس با DSN: " . $dsn);
                    return true;
                    
                } catch (PDOException $e) {
                    $lastError = $e->getMessage();
                    echo "<span style='color: red;'>❌ خطا: " . $lastError . "</span><br>";
                    error_log("خطا در DSN " . ($index + 1) . ": " . $lastError);
                    continue;
                }
            }
            
            // اگر هیچ کدام کار نکرد
            throw new PDOException("تمام تلاش‌ها ناموفق. آخرین خطا: " . $lastError);
            
        } catch (PDOException $e) {
            $fullError = "خطا در اتصال به دیتابیس: " . $e->getMessage();
            $fullError .= "\nکد خطا: " . $e->getCode();
            $fullError .= "\nفایل: " . $e->getFile();
            $fullError .= "\nخط: " . $e->getLine();
            
            error_log($fullError);
            echo "<div style='background: #fadbd8; padding: 10px; border-radius: 4px; margin: 10px 0;'>";
            echo "<strong>خطای کامل:</strong><br>";
            echo nl2br(htmlspecialchars($fullError));
            echo "</div>";
            
            // راهنمایی‌های رفع مشکل
            echo "<div style='background: #e8f4fd; padding: 15px; border-radius: 4px; margin: 10px 0;'>";
            echo "<strong>راهنمایی‌های رفع مشکل:</strong><br>";
            
            if (strpos($e->getMessage(), 'could not find driver') !== false) {
                echo "• اکستنشن PDO_SQLSRV نصب نیست<br>";
                echo "• در Plesk باید اکستنشن SQL Server را فعال کنید<br>";
            }
            
            if (strpos($e->getMessage(), 'Login failed') !== false) {
                echo "• نام کاربری یا پسورد اشتباه است<br>";
                echo "• احتمالاً اطلاعات اتصال درست نیست<br>";
            }
            
            if (strpos($e->getMessage(), 'server was not found') !== false) {
                echo "• آدرس سرور یا پورت اشتباه است<br>";
                echo "• احتمالاً سرور در دسترس نیست<br>";
                echo "• فایروال اتصال را مسدود کرده<br>";
            }
            
            if (strpos($e->getMessage(), 'database') !== false) {
                echo "• نام دیتابیس اشتباه است<br>";
                echo "• کاربر دسترسی به این دیتابیس ندارد<br>";
            }
            
            echo "</div>";
            
            return false;
        }
    }
    
    /**
     * خواندن لیست جداول موجود در دیتابیس
     */
    public function getTables() {
        try {
            $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("خطا در خواندن جداول: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * خواندن ساختار یک جدول خاص
     */
    public function getTableStructure($tableName) {
        try {
            $query = "SELECT 
                        COLUMN_NAME,
                        DATA_TYPE,
                        IS_NULLABLE,
                        CHARACTER_MAXIMUM_LENGTH,
                        COLUMN_DEFAULT
                      FROM INFORMATION_SCHEMA.COLUMNS 
                      WHERE TABLE_NAME = :tableName";
            
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':tableName', $tableName);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("خطا در خواندن ساختار جدول: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * خواندن داده‌های یک جدول
     */
    public function getTableData($tableName, $limit = 100) {
        try {
            // برای امنیت، نام جدول را چک می‌کنیم
            $allowedTables = $this->getTables();
            $tableExists = false;
            
            foreach ($allowedTables as $table) {
                if ($table['TABLE_NAME'] === $tableName) {
                    $tableExists = true;
                    break;
                }
            }
            
            if (!$tableExists) {
                throw new Exception("جدول مورد نظر وجود ندارد");
            }
            
            $query = "SELECT TOP :limit * FROM " . $tableName;
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("خطا در خواندن داده‌های جدول: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * اجرای کوئری سفارشی برای خواندن داده‌ها
     */
    public function executeQuery($query, $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }
            }
            
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("خطا در اجرای کوئری: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * بستن اتصال
     */
    public function disconnect() {
        $this->connection = null;
    }
    
    /**
     * دریافت اطلاعات دیتابیس
     */
    public function getDatabaseInfo() {
        try {
            $info = [];
            
            // نام دیتابیس
            $info['database_name'] = $this->database;
            
            // ورژن SQL Server
            $stmt = $this->connection->query("SELECT @@VERSION as version");
            $result = $stmt->fetch();
            $info['server_version'] = $result['version'];
            
            // تعداد جداول
            $tables = $this->getTables();
            $info['table_count'] = count($tables);
            
            // اندازه دیتابیس
            $query = "SELECT 
                        SUM(size) * 8 / 1024 AS database_size_mb
                      FROM sys.database_files";
            $stmt = $this->connection->query($query);
            $result = $stmt->fetch();
            $info['database_size_mb'] = $result['database_size_mb'];
            
            return $info;
        } catch (PDOException $e) {
            error_log("خطا در دریافت اطلاعات دیتابیس: " . $e->getMessage());
            return false;
        }
    }
}

// مثال استفاده از کلاس
/*
// ایجاد اتصال
$db = new SQLServerConnection();

if ($db->connect()) {
    echo "اتصال به دیتابیس برقرار شد!" . PHP_EOL;
    
    // دریافت اطلاعات دیتابیس
    $info = $db->getDatabaseInfo();
    if ($info) {
        print_r($info);
    }
    
    // دریافت لیست جداول
    $tables = $db->getTables();
    if ($tables) {
        echo "جداول موجود:" . PHP_EOL;
        foreach ($tables as $table) {
            echo "- " . $table['TABLE_NAME'] . PHP_EOL;
        }
    }
    
    // بستن اتصال
    $db->disconnect();
} else {
    echo "خطا در اتصال به دیتابیس!";
}
*/
?> 