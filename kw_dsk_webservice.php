<?php
// تنظیمات خطا
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/error.log'); // مسیر فایل لاگ خطاها

// محافظت از اجرای مستقیم اسکریپت
if (!defined('KWPHC_WEBSERVICE_AUTHORIZED')) {
    header('HTTP/1.1 403 Forbidden');
    die(json_encode([
        'status' => 'error',
        'message' => 'دسترسی غیرمجاز',
        'details' => 'شما مجاز به اجرای مستقیم این اسکریپت نیستید.'
    ]));
}

class TokenManager {
    private $secretKey;
    private $refreshSecretKey;
    private $tokenExpiration = 3600; // 1 ساعت
    private $refreshTokenExpiration = 86400 * 7; // 7 روز

    public function __construct() {
        $this->secretKey = hash('sha256', 'KW_DSK_ACCESS_TOKEN_SECRET_' . date('Y-m-d'));
        $this->refreshSecretKey = hash('sha256', 'KW_DSK_REFRESH_TOKEN_SECRET_' . date('Y-m-d'));
    }

    public function generateAccessToken($userId) {
        $payload = [
            'user_id' => $userId,
            'exp' => time() + $this->tokenExpiration,
            'iat' => time(),
            'jti' => bin2hex(random_bytes(16)) // شناسه یکتای توکن
        ];
        return $this->encode($payload, $this->secretKey);
    }

    public function generateRefreshToken($userId) {
        $payload = [
            'user_id' => $userId,
            'exp' => time() + $this->refreshTokenExpiration,
            'iat' => time()
        ];
        return $this->encode($payload, $this->refreshSecretKey);
    }

    public function validateAccessToken($token) {
        if (empty($token)) {
            return false;
        }

        try {
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                return false;
            }

            $payload = $this->decode($token, $this->secretKey);
            return $payload['user_id'] ?? false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function validateRefreshToken($token) {
        try {
            $payload = $this->decode($token, $this->refreshSecretKey);
            return $payload['user_id'] ?? false;
        } catch (Exception $e) {
            return false;
        }
    }

    private function encode($payload, $key) {
        $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', "$header.$payload", $key, true);
        $signature = base64_encode($signature);
        return "$header.$payload.$signature";
    }

    private function decode($token, $key) {
        $parts = explode('.', $token);
        
        // محافظت از حملات با بررسی تعداد بخش‌ها
        if (count($parts) !== 3) {
            throw new Exception('Invalid token format');
        }

        list($header, $payload, $signature) = $parts;

        // بررسی امضا
        $validSignature = base64_encode(hash_hmac('sha256', "$header.$payload", $key, true));
        
        if (!hash_equals($validSignature, $signature)) {
            throw new Exception('Invalid token signature');
        }

        $payload = json_decode(base64_decode($payload), true);
        
        // بررسی انقضای توکن
        if ($payload['exp'] < time()) {
            throw new Exception('Token expired');
        }

        return $payload;
    }
}

// کلاس مدیریت دیتابیس
class KwDskDatabase {
    private $pdo;
    private $server_ip = "185.128.81.210";
    private $port = "2033";
    private $username = "kwphc.ir_mainuesr";
    private $password = "AS*35Rt%@-l5f";
    private $dbName = "kwphc.ir_main";

    public function __construct() {
        $dsn = "sqlsrv:Server={$this->server_ip},{$this->port};Database={$this->dbName}";
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->sendErrorResponse("Database connection failed", 500);
        }
    }

    // دریافت اطلاعات با صفحه‌بندی
    public function getKwDskData($page = 1, $pageSize = 10, $filters = []) {
        $offset = ($page - 1) * $pageSize;
        
        // ساخت شرط فیلترها
        $whereConditions = [];
        $params = [];
        foreach ($filters as $column => $value) {
            $whereConditions[] = "[$column] LIKE :$column";
            $params[":$column"] = "%$value%";
        }
        $whereClause = $whereConditions ? "WHERE " . implode(" AND ", $whereConditions) : "";

        // محاسبه تعداد کل رکوردها
        $countQuery = "SELECT COUNT(*) as total FROM Kw_DSK $whereClause";
        $countStmt = $this->pdo->prepare($countQuery);
        $countStmt->execute($params);
        $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        // دریافت داده‌ها
        $query = "SELECT * FROM (
                    SELECT *, ROW_NUMBER() OVER (ORDER BY co_c) as RowNum 
                    FROM Kw_DSK $whereClause
                  ) as SubQuery 
                  WHERE RowNum BETWEEN :offset AND :limit";
        
        $params[':offset'] = $offset + 1;
        $params[':limit'] = $offset + $pageSize;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total_records' => $totalRecords,
            'page' => $page,
            'page_size' => $pageSize,
            'total_pages' => ceil($totalRecords / $pageSize),
            'data' => $results
        ];
    }

    // درج رکورد جدید
    public function insertKwDskRecord($data) {
        $columns = array_keys($data);
        $placeholders = array_map(function($col) { return ":$col"; }, $columns);

        $query = "INSERT INTO Kw_DSK (" . implode(", ", $columns) . ") 
                  VALUES (" . implode(", ", $placeholders) . ")";
        
        $stmt = $this->pdo->prepare($query);
        
        try {
            $stmt->execute($data);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            $this->sendErrorResponse("Insert failed: " . $e->getMessage(), 400);
        }
    }

    // به‌روزرسانی رکورد
    public function updateKwDskRecord($co_c, $data) {
        $updateFields = array_map(function($col) { return "[$col] = :$col"; }, array_keys($data));
        $query = "UPDATE Kw_DSK SET " . implode(", ", $updateFields) . " WHERE co_c = :co_c";
        
        $data['co_c'] = $co_c;
        $stmt = $this->pdo->prepare($query);
        
        try {
            $stmt->execute($data);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->sendErrorResponse("Update failed: " . $e->getMessage(), 400);
        }
    }

    // حذف رکورد
    public function deleteKwDskRecord($co_c) {
        $query = "DELETE FROM Kw_DSK WHERE co_c = :co_c";
        $stmt = $this->pdo->prepare($query);
        
        try {
            $stmt->execute(['co_c' => $co_c]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->sendErrorResponse("Delete failed: " . $e->getMessage(), 400);
        }
    }

    // ارسال پاسخ خطا
    private function sendErrorResponse($message, $statusCode = 400) {
        http_response_code($statusCode);
        echo json_encode([
            'status' => 'error',
            'message' => $message
        ]);
        exit;
    }
}

// مدیریت درخواست‌ها
class KwDskWebService {
    private $database;
    private $tokenManager;

    public function __construct() {
        try {
            // ایجاد اتصال به پایگاه داده
            $this->database = new KwDskDatabase();
            
            // مدیریت توکن
            $this->tokenManager = new TokenManager();
        } catch (Exception $e) {
            // ثبت خطای اتصال
            $this->logError('Constructor Error', $e);
            $this->sendErrorResponse('خطای اتصال به سرویس', 500);
        }
    }

    public function handleRequest() {
        try {
            // بررسی متد درخواست
            $method = $_SERVER['REQUEST_METHOD'];
            
            // دریافت توکن از هدر
            $headers = getallheaders();
            $token = $headers['Authorization'] ?? $headers['authorization'] ?? '';
            $token = str_replace('Bearer ', '', $token);

            // احراز هویت
            if (!$this->tokenManager->validateAccessToken($token)) {
                $this->sendErrorResponse('احراز هویت ناموفق', 401);
            }

            // پردازش درخواست‌ها
            switch ($method) {
                case 'GET':
                    $this->handleGetRequest();
                    break;
                case 'POST':
                    $this->handlePostRequest();
                    break;
                case 'PUT':
                    $this->handlePutRequest();
                    break;
                case 'DELETE':
                    $this->handleDeleteRequest();
                    break;
                default:
                    $this->sendErrorResponse('متد درخواستی نامعتبر', 405);
            }
        } catch (Exception $e) {
            // ثبت و گزارش خطای کلی
            $this->logError('Handle Request Error', $e);
            $this->sendErrorResponse('خطای داخلی سرور', 500);
        }
    }

    private function handleGetRequest() {
        try {
            // اگر درخواست آخرین رکوردها باشد
            if (isset($_GET['action']) && $_GET['action'] === 'latest_records') {
                $limit = $_GET['limit'] ?? 10;
                $result = $this->getLatestRecords($limit);
            } else {
                // دریافت داده‌های صفحه‌بندی شده
                $page = $_GET['page'] ?? 1;
                $pageSize = $_GET['page_size'] ?? 10;
                
                // جمع‌آوری فیلترها
                $filters = [];
                foreach ($_GET as $key => $value) {
                    if (strpos($key, 'filters[') === 0) {
                        $filterKey = str_replace(['filters[', ']'], '', $key);
                        $filters[$filterKey] = $value;
                    }
                }

                $result = $this->database->getKwDskData($page, $pageSize, $filters);
            }

            $this->sendResponse($result);
        } catch (Exception $e) {
            $this->logError('Get Request Error', $e);
            $this->sendErrorResponse('خطا در دریافت اطلاعات', 500);
        }
    }

    private function handlePostRequest() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            // بررسی صحت داده‌های ورودی
            if (empty($data)) {
                $this->sendErrorResponse('داده‌های ارسالی نامعتبر', 400);
            }

            $result = $this->database->insertKwDskRecord($data);
            $this->sendResponse(['id' => $result]);
        } catch (Exception $e) {
            $this->logError('Post Request Error', $e);
            $this->sendErrorResponse('خطا در ایجاد رکورد', 500);
        }
    }

    private function handlePutRequest() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            // بررسی صحت داده‌های ورودی
            if (empty($data) || !isset($data['co_c'])) {
                $this->sendErrorResponse('داده‌های به‌روزرسانی نامعتبر', 400);
            }

            $result = $this->database->updateKwDskRecord($data['co_c'], $data);
            $this->sendResponse(['updated' => $result]);
        } catch (Exception $e) {
            $this->logError('Put Request Error', $e);
            $this->sendErrorResponse('خطا در به‌روزرسانی رکورد', 500);
        }
    }

    private function handleDeleteRequest() {
        try {
            $coC = $_GET['co_c'] ?? null;
            
            if (empty($coC)) {
                $this->sendErrorResponse('شناسه رکورد برای حذف مشخص نشده', 400);
            }

            $result = $this->database->deleteKwDskRecord($coC);
            $this->sendResponse(['deleted' => $result]);
        } catch (Exception $e) {
            $this->logError('Delete Request Error', $e);
            $this->sendErrorResponse('خطا در حذف رکورد', 500);
        }
    }

    private function getLatestRecords($limit = 10) {
        try {
            // اطمینان از صحت پارامتر محدودیت
            $limit = max(1, min(intval($limit), 100));

            // کوئری دریافت آخرین رکوردها
            $query = "SELECT TOP :limit * FROM Kw_DSK ORDER BY DSK_ID DESC";

            $stmt = $this->database->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'count' => count($records),
                'records' => $records
            ];
        } catch (Exception $e) {
            $this->logError('Get Latest Records Error', $e);
            $this->sendErrorResponse('خطا در دریافت آخرین رکوردها', 500);
        }
    }

    private function sendResponse($data, $statusCode = 200) {
        // تنظیمات امنیتی هدر
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        
        // تنظیم کد وضعیت
        http_response_code($statusCode);
        
        // ارسال پاسخ JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    private function sendErrorResponse($message, $statusCode = 500) {
        $errorResponse = [
            'status' => 'error',
            'message' => $message
        ];

        // تنظیمات امنیتی هدر
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        
        // تنظیم کد وضعیت
        http_response_code($statusCode);
        
        // ارسال پاسخ خطا
        echo json_encode($errorResponse, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    private function logError($context, $exception) {
        // ثبت خطا در فایل لاگ
        $errorMessage = date('[Y-m-d H:i:s] ') . 
                        "Context: $context\n" . 
                        "Error: " . $exception->getMessage() . "\n" . 
                        "Trace: " . $exception->getTraceAsString() . "\n\n";
        
        error_log($errorMessage, 3, '/path/to/error.log');
    }
}

// اجرای وب سرویس
$service = new KwDskWebService();

// مسیریابی
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, '/login') !== false) {
    $service->login();
} elseif (strpos($requestUri, '/refresh-token') !== false) {
    $service->refreshToken();
} else {
    $service->handleRequest();
} 