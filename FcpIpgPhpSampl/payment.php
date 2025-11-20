<?php  
/**  
 * Template Name: payment  
 */  

// دریافت داده‌های فرم  
if (isset($_POST['MobileNo']) && isset($_POST['Amount']) && isset($_POST['Email'])) {  
    // دریافت اطلاعات از فرم  
    $MobileNo = trim($_POST['MobileNo']);  
    $Amount = intval($_POST['Amount']);  
    $Email = trim($_POST['Email']);  

    // اعتبارسنجی ایمیل  
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {  
        die("ایمیل وارد شده نامعتبر است.");  
    }  

    // اعتبارسنجی شماره موبایل  
    if (!preg_match('/^09\d{9}$/', $MobileNo)) {  
        die("شماره موبایل وارد شده نامعتبر است.");  
    }  

    // متغیرهای ثابت  
    $UserId = "نام کاربری";  
    $Password = "رمز عبور";  
    $MerchantId = "شماره پذیرنده";  
    $ReserveNum = mt_rand(1000000000, 1999999999);  
    $gateway_url = 'https://fcp.shaparak.ir/_ipgw_/payment/?lang=fa&token=';  

    // ساخت بدنه درخواست به صورت JSON  
    $body = json_encode([  
        "WSContext" => [  
            "UserId" => $UserId,  
            "Password" => $Password  
        ],  
        "TransType" => "EN_GOODS",  
        "ReserveNum" => $ReserveNum,  
        "MerchantId" => $MerchantId,  
        // در این نمونه مقدار Amount برحسب تومان وارد می‌شود؛ برای ارسال به فناوا به ریال تبدیل می‌کنیم
        // هر تومان = 10 ریال
        "Amount" => intval($Amount) * 10,
        "RedirectUrl" => "آدرس برگشتی",  
        "MobileNo" => $MobileNo,  
        "Email" => $Email // اضافه کردن ایمیل به بدنه  
    ]);  

    // تنظیم درخواست cURL  
    $curl = curl_init();  
    curl_setopt_array($curl, [  
        CURLOPT_URL => 'https://fcp.shaparak.ir/ref-payment/RestServices/mts/generateTokenWithNoSign/',  
        CURLOPT_RETURNTRANSFER => true,  
        CURLOPT_ENCODING => '',  
        CURLOPT_MAXREDIRS => 10,  
        CURLOPT_TIMEOUT => 0,  
        CURLOPT_FOLLOWLOCATION => true,  
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,  
        CURLOPT_CUSTOMREQUEST => 'POST',  
        CURLOPT_POSTFIELDS => $body,  
        CURLOPT_HTTPHEADER => [  
            'Content-Type: application/json'  
        ],  
    ]);  

    // ارسال درخواست  
    $response = curl_exec($curl);  
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); // دریافت کد وضعیت  

    // بسته شدن cURL  
    curl_close($curl);  

    // بررسی پاسخ  
    if ($status_code == 200) {  
        $response = json_decode($response);  

        if (!empty($response) && isset($response->Result) && $response->Result == 'erSucceed') {  
            // دریافت توکن از پاسخ  
            $token = $response->Token;  
            // ایجاد URL نهایی برای هدایت کاربر  
            $finalURL = $gateway_url . $token;  
            // هدایت کاربر  
            header('Location: ' . $finalURL);  
            exit;  
        } else {  
            echo json_encode($response);  
        }  
    } else {  
        echo '<br>خطا: کد وضعیت غیر 200: ' . $status_code;  
    }  
} else {  
    echo "اطلاعات ورودی ناقص است.";  
}  
  
?>