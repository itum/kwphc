<?php
/**
 * درگاه پرداخت فناوا برای رزرو سالن
 */

if (!defined('ABSPATH')) {
    exit;
}

class UM_FCP_Gateway_Hall {

    private $user_id;
    private $password;
    private $merchant_id;
    private $gateway_url = 'https://fcp.shaparak.ir/_ipgw_/payment/?lang=fa&token=';

    public function __construct() {
        $this->user_id = trim((string) get_option('um_fcp_user_id', ''));
        $this->password = trim((string) get_option('um_fcp_password', ''));
        $this->merchant_id = trim((string) get_option('um_fcp_merchant_id', ''));
    }

    /**
     * ایجاد درخواست پرداخت
     */
    public function create_payment($booking_id, $amount, $email, $mobile, $description = '') {
        if (empty($this->user_id) || empty($this->password) || empty($this->merchant_id)) {
            um_error_log('FCP Request: Credentials not set', array('booking_id' => $booking_id));
            return new WP_Error('fcp_credentials_missing', __('تنظیمات درگاه فناوا کامل نیست. لطفاً در تنظیمات عمومی افزونه، اطلاعات درگاه فناوا را وارد کنید.', 'university-management'));
        }

        // تبدیل شماره تماس به فرمت موبایل استاندارد
        $mobile = $this->normalize_mobile_number($mobile);
        
        // اعتبارسنجی شماره موبایل
        if (!$mobile || !preg_match('/^09\d{9}$/', $mobile)) {
            return new WP_Error('invalid_mobile', __('شماره موبایل نامعتبر است. لطفاً شماره موبایل را به فرمت 09123456789 وارد کنید.', 'university-management'));
        }

        // اعتبارسنجی ایمیل
        if (!is_email($email)) {
            return new WP_Error('invalid_email', __('ایمیل نامعتبر است.', 'university-management'));
        }

        // ساخت callback URL
        $callback = add_query_arg(array(
            'um_hall_callback' => 1,
            'booking_id' => $booking_id,
        ), home_url('/'));

        if (!filter_var($callback, FILTER_VALIDATE_URL)) {
            um_error_log('FCP Request: Invalid callback URL', array('callback' => $callback));
            return new WP_Error('invalid_callback_url', __('آدرس بازگشت معتبر نیست.', 'university-management'));
        }

        // تولید شماره رزرو
        $reserve_num = mt_rand(1000000000, 1999999999);
        
        // ذخیره ReserveNum برای verify
        update_post_meta($booking_id, '_um_hall_reserve_num', $reserve_num);

        // ساخت بدنه درخواست
        $body = json_encode(array(
            'WSContext' => array(
                'UserId' => $this->user_id,
                'Password' => $this->password
            ),
            'TransType' => 'EN_GOODS',
            'ReserveNum' => (string) $reserve_num,
            'MerchantId' => $this->merchant_id,
            'Amount' => intval($amount),
            'RedirectUrl' => $callback,
            'MobileNo' => $mobile,
            'Email' => $email
        ));

        um_log('FCP Request: Sending request', array(
            'booking_id' => $booking_id,
            'amount' => $amount,
            'reserve_num' => $reserve_num,
            'merchant_id' => $this->merchant_id
        ));

        // لاگ ساده برای اطمینان از ثبت درخواست (برای دیباگ)
        error_log('UM_FCP_Gateway_Hall create_payment body: ' . $body);

        $response = wp_remote_post('https://fcp.shaparak.ir/ref-payment/RestServices/mts/generateTokenWithNoSign/', array(
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'body' => $body,
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            um_error_log('FCP Request: WP_Error', array(
                'error' => $response->get_error_message(),
                'code' => $response->get_error_code()
            ));
            return $response;
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);

        um_log('FCP Request: Response received', array(
            'response_code' => $response_code,
            'body' => $response_body
        ));

        error_log('UM_FCP_Gateway_Hall create_payment response: ' . $response_code . ' body: ' . $response_body);

        if ($response_code != 200) {
            um_error_log('FCP Request: Non-200 status code', array(
                'code' => $response_code,
                'body' => $response_body
            ));
            return new WP_Error('fcp_request_failed', __('خطا در ارتباط با درگاه پرداخت. کد وضعیت: ', 'university-management') . $response_code);
        }

        $data = json_decode($response_body, true);

        if (!empty($data) && isset($data['Result']) && $data['Result'] == 'erSucceed' && !empty($data['Token'])) {
            $token = sanitize_text_field($data['Token']);
            
            // ذخیره Token برای verify
            update_post_meta($booking_id, '_um_hall_fcp_token', $token);
            
            $final_url = $this->gateway_url . $token;
            
            um_log('FCP Request: Success', array(
                'token' => $token,
                'redirect_url' => $final_url
            ));
            
            return $final_url;
        } else {
            $error_message = __('خطا در ایجاد درخواست پرداخت', 'university-management');
            if (isset($data['Result'])) {
                $error_message .= ': ' . $data['Result'];
            }
            um_error_log('FCP Request: Failed', array(
                'data' => $data,
                'response_body' => $response_body
            ));
            return new WP_Error('fcp_request_failed', $error_message);
        }
    }

    /**
     * تبدیل شماره تماس به فرمت موبایل استاندارد
     */
    private function normalize_mobile_number($phone) {
        if (empty($phone)) {
            return false;
        }
        
        // حذف فاصله‌ها، خط تیره و کاراکترهای غیر عددی
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // اگر شماره با 0 شروع می‌شود، 0 را حذف کن
        if (substr($phone, 0, 1) === '0') {
            $phone = substr($phone, 1);
        }
        
        // اگر شماره با 98 شروع می‌شود (کد کشور ایران)، 98 را حذف کن
        if (substr($phone, 0, 2) === '98') {
            $phone = substr($phone, 2);
        }
        
        // اگر شماره با 9 شروع می‌شود (بدون 0)، 0 را اضافه کن
        if (substr($phone, 0, 1) === '9' && strlen($phone) === 10) {
            $phone = '0' . $phone;
        }
        
        // بررسی نهایی: باید با 09 شروع شود و 11 رقم داشته باشد
        if (preg_match('/^09\d{9}$/', $phone)) {
            return $phone;
        }
        
        return false;
    }
    
    /**
     * تایید پرداخت
     */
    public function verify_payment($ref_num, $token) {
        if (empty($this->user_id) || empty($this->password)) {
            um_error_log('FCP Verify: Credentials not set');
            return new WP_Error('fcp_credentials_missing', __('تنظیمات درگاه فناوا کامل نیست.', 'university-management'));
        }

        if (empty($ref_num) || empty($token)) {
            return new WP_Error('fcp_verify_missing_params', __('پارامترهای تایید ناقص است.', 'university-management'));
        }

        $body = json_encode(array(
            'WSContext' => array(
                'UserId' => $this->user_id,
                'Password' => $this->password
            ),
            'Token' => $token,
            'RefNum' => $ref_num
        ));

        um_log('FCP Verify: Sending request', array(
            'ref_num' => $ref_num,
            'token' => $token
        ));

        $response = wp_remote_post('https://fcp.shaparak.ir/ref-payment/RestServices/mts/verifyMerchantTrans/', array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($body)
            ),
            'body' => $body,
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            um_error_log('FCP Verify: WP_Error', array(
                'error' => $response->get_error_message(),
                'code' => $response->get_error_code()
            ));
            return $response;
        }

        $response_body = wp_remote_retrieve_body($response);
        $data = json_decode($response_body, true);

        // لاگ کامل پاسخ برای دیباگ
        um_log('FCP Verify: Response received (detailed)', array(
            'body' => $response_body,
            'data' => $data
        ));
        error_log('UM_FCP_Gateway_Hall verify response: ' . $response_body);

        um_log('FCP Verify: Response received', array(
            'body' => $response_body,
            'data' => $data
        ));

        if (!empty($data) && isset($data['Result']) && $data['Result'] == 'erSucceed') {
            return array(
                'success' => true,
                'ref_num' => $ref_num,
                'data' => $data
            );
        } else {
            $error_message = __('تایید پرداخت ناموفق بود', 'university-management');
            if (isset($data['Result'])) {
                $error_message .= ': ' . $data['Result'];
            }
            um_error_log('FCP Verify: Failed', array(
                'data' => $data,
                'response_body' => $response_body
            ));
            return new WP_Error('fcp_verify_failed', $error_message);
        }
    }
}

