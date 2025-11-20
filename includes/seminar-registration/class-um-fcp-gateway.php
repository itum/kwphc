<?php
/**
 * درگاه پرداخت فناوا برای ثبت نام سمینارها
 *
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

/**
 * کلاس درگاه پرداخت فناوا
 */
class UM_FCP_Gateway {
    
    private $user_id;
    private $password;
    private $merchant_id;
    private $gateway_url = 'https://fcp.shaparak.ir/_ipgw_/payment/?lang=fa&token=';
    private $callback_url;
    
    public function __construct() {
        $this->user_id = trim((string) get_option('um_fcp_user_id', ''));
        $this->password = trim((string) get_option('um_fcp_password', ''));
        $this->merchant_id = trim((string) get_option('um_fcp_merchant_id', ''));
        $this->callback_url = home_url('/um-payment-callback/');
        
        // اضافه کردن endpoint برای callback
        add_action('init', array($this, 'add_payment_endpoints'));
        add_action('template_redirect', array($this, 'handle_payment_callback'));
    }
    
    /**
     * اضافه کردن endpoint برای callback
     */
    public function add_payment_endpoints() {
        add_rewrite_rule('^um-payment-callback/?$', 'index.php?um_payment_callback=1', 'top');
        // Flush rewrite rules در اولین بار (فقط یک بار)
        if (!get_option('um_fcp_rewrite_flushed')) {
            flush_rewrite_rules(false);
            update_option('um_fcp_rewrite_flushed', '1');
        }
    }
    
    /**
     * مدیریت callback پرداخت
     */
    public function handle_payment_callback() {
        if (get_query_var('um_payment_callback')) {
            $this->process_payment_callback();
            exit;
        }

        // پشتیبانی از درخواست re-verify ساده از طریق پارامتر GET (مثال: ?um_reverify=1&token=...&RefNum=...)
        if (!empty($_GET['um_reverify'])) {
            $this->process_reverify_request();
            exit;
        }
    }
    
    /**
     * ایجاد درخواست پرداخت
     */
    public function create_payment($registration_id, $amount, $description = '') {
        if (empty($this->user_id) || empty($this->password) || empty($this->merchant_id)) {
            return array('success' => false, 'message' => 'تنظیمات درگاه فناوا کامل نیست. لطفاً در تنظیمات عمومی افزونه، اطلاعات درگاه فناوا را وارد کنید.');
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'um_seminar_registrations';
        $registration = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $registration_id
        ));
        
        if (!$registration) {
            return array('success' => false, 'message' => 'ثبت نام یافت نشد.');
        }
        
        $email = $registration->email;
        $phone = $registration->phone;
        
        // تبدیل شماره تماس به فرمت موبایل استاندارد
        $mobile = $this->normalize_mobile_number($phone);
        
        // اعتبارسنجی شماره موبایل
        if (!$mobile || !preg_match('/^09\d{9}$/', $mobile)) {
            return array('success' => false, 'message' => 'شماره موبایل نامعتبر است. لطفاً شماره موبایل را به فرمت 09123456789 وارد کنید.');
        }
        
        // اعتبارسنجی ایمیل
        if (!is_email($email)) {
            return array('success' => false, 'message' => 'ایمیل نامعتبر است.');
        }
        
        // تولید شماره رزرو
        $reserve_num = mt_rand(1000000000, 1999999999);
        
        // ذخیره ReserveNum
        $wpdb->update(
            $table_name,
            array('payment_reference' => (string) $reserve_num),
            array('id' => $registration_id)
        );
        
        // ساخت callback URL (بدون query parameter چون فناوا از POST استفاده می‌کند)
        // registration_id را در gateway_response ذخیره می‌کنیم تا در callback استفاده کنیم
        $callback = $this->callback_url;
        
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
        
        $response = wp_remote_post('https://fcp.shaparak.ir/ref-payment/RestServices/mts/generateTokenWithNoSign/', array(
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'body' => $body,
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array('success' => false, 'message' => 'خطا در ارتباط با درگاه پرداخت.');
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);
        
        if ($response_code != 200) {
            return array('success' => false, 'message' => 'خطا در ارتباط با درگاه پرداخت. کد وضعیت: ' . $response_code);
        }
        
        $data = json_decode($response_body, true);
        
        if (!empty($data) && isset($data['Result']) && $data['Result'] == 'erSucceed' && !empty($data['Token'])) {
            $token = sanitize_text_field($data['Token']);
            
            // ذخیره Token و registration_id برای استفاده در callback
            $wpdb->update(
                $table_name,
                array('gateway_response' => json_encode(array('token' => $token, 'reserve_num' => $reserve_num, 'registration_id' => $registration_id))),
                array('id' => $registration_id)
            );
            
            $payment_url = $this->gateway_url . $token;
            
            return array(
                'success' => true,
                'token' => $token,
                'payment_url' => $payment_url
            );
        } else {
            $error_message = 'خطا در ایجاد درخواست پرداخت';
            if (isset($data['Result'])) {
                $error_message .= ': ' . $data['Result'];
            }
            return array('success' => false, 'message' => $error_message);
        }
    }
    
    /**
     * تایید پرداخت
     */
    public function verify_payment($ref_num, $token) {
        if (empty($this->user_id) || empty($this->password)) {
            return array('success' => false, 'message' => 'تنظیمات درگاه فناوا کامل نیست.');
        }
        
        if (empty($ref_num) || empty($token)) {
            return array('success' => false, 'message' => 'پارامترهای تایید ناقص است.');
        }
        
        $body = json_encode(array(
            'WSContext' => array(
                'UserId' => $this->user_id,
                'Password' => $this->password
            ),
            'Token' => $token,
            'RefNum' => $ref_num
        ));
        
        $response = wp_remote_post('https://fcp.shaparak.ir/ref-payment/RestServices/mts/verifyMerchantTrans/', array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($body)
            ),
            'body' => $body,
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array('success' => false, 'message' => 'خطا در ارتباط با درگاه پرداخت.');
        }
        
        $response_body = wp_remote_retrieve_body($response);
        $data = json_decode($response_body, true);
        
        if (!empty($data) && isset($data['Result']) && $data['Result'] == 'erSucceed') {
            return array(
                'success' => true,
                'ref_id' => $ref_num,
                'data' => $data
            );
        } else {
            $error_message = 'تایید پرداخت ناموفق بود';
            if (isset($data['Result'])) {
                $error_message .= ': ' . $data['Result'];
            }
            return array('success' => false, 'message' => $error_message);
        }
    }
    
    /**
     * پردازش callback پرداخت
     */
    private function process_payment_callback() {
        // لاگ کامل ورودی برای دیباگ
        $raw_input = file_get_contents('php://input');
        error_log('UM_FCP_Gateway Callback $_POST: ' . print_r($_POST, true));
        error_log('UM_FCP_Gateway Callback raw body: ' . $raw_input);

        // دریافت پارامترها از POST/GET با پشتیبانی از نام‌های مختلف (حساسیت به حروف حذف شده)
        $ref_num = $this->get_request_value(array('RefNum', 'refNum', 'Refnum'));
        $token = $this->get_request_value(array('token', 'Token'));

        if (empty($ref_num) || empty($token)) {
            error_log('UM_FCP_Gateway Callback: missing ref_num or token. RefNum=' . $ref_num . ' token=' . $token);
            wp_redirect(home_url('/?payment_error=1'));
            exit;
        }

        // پیدا کردن registration_id از طریق token یا RefNum در دیتابیس
        global $wpdb;
        $table_name = $wpdb->prefix . 'um_seminar_registrations';

        $registration_id = 0;
        if (!empty($token)) {
            $found = $wpdb->get_row($wpdb->prepare(
                "SELECT id, gateway_response FROM $table_name WHERE gateway_response LIKE %s LIMIT 1",
                '%' . $wpdb->esc_like($token) . '%'
            ));
            if ($found) {
                $registration_id = intval($found->id);
            }
        }

        // اگر یافت نشد، تلاش برای پیدا کردن با استفاده از RefNum یا payment_reference/reserve_num
        if (!$registration_id && !empty($ref_num)) {
            $found_ref = $wpdb->get_row($wpdb->prepare(
                "SELECT id FROM $table_name WHERE payment_reference = %s OR gateway_response LIKE %s LIMIT 1",
                $ref_num,
                '%' . $wpdb->esc_like($ref_num) . '%'
            ));
            if ($found_ref) {
                $registration_id = intval($found_ref->id);
            }
        }

        if (!$registration_id) {
            error_log('UM_FCP_Gateway Callback: registration not found for token/ref. token=' . $token . ' ref=' . $ref_num);
            wp_redirect(home_url('/?payment_error=2'));
            exit;
        }

        // دریافت اطلاعات ثبت نام
        $registration = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $registration_id
        ));

        if (!$registration) {
            wp_redirect(home_url('/?payment_error=2'));
            exit;
        }

        // بررسی Token ذخیره شده (در gateway_response)
        $gateway_response = json_decode($registration->gateway_response ?? '{}', true);
        $stored_token = isset($gateway_response['token']) ? $gateway_response['token'] : ($gateway_response['Token'] ?? '');

        if (empty($stored_token) || $stored_token !== $token) {
            error_log('UM_FCP_Gateway Callback: token mismatch. stored=' . print_r($stored_token, true) . ' incoming=' . $token);
            $wpdb->update(
                $table_name,
                array('payment_status' => 'failed'),
                array('id' => $registration_id)
            );
            wp_redirect(home_url('/?payment_error=3'));
            exit;
        }

        // دریافت سایر پارامترها از POST/GET (فناوا از POST استفاده می‌کند)
        $mid = $this->get_request_value(array('MID', 'mid'));
        $shaparak_terminal_id = $this->get_request_value(array('shaparakTerminalId', 'shaparakterminalid'));
        $customer_ref_num = $this->get_request_value(array('CustomerRefNum', 'customerrefnum'));
        $mobile_no = $this->get_request_value(array('mobileNo', 'mobileno'));
        $state = $this->get_request_value(array('State', 'state'));

        // تایید پرداخت (و لاگ پاسخ)
        $verify_result = $this->verify_payment($ref_num, $token);
        error_log('UM_FCP_Gateway verify_result: ' . print_r($verify_result, true));

        if ($verify_result['success']) {
            // به‌روزرسانی وضعیت ثبت نام
            $wpdb->update(
                $table_name,
                array(
                    'payment_status' => 'completed',
                    'payment_reference' => $ref_num
                ),
                array('id' => $registration_id)
            );

            // ثبت اطلاعات پرداخت
            $payments_table = $wpdb->prefix . 'um_seminar_payments';
            $wpdb->insert(
                $payments_table,
                array(
                    'registration_id' => $registration_id,
                    'seminar_id' => $registration->seminar_id,
                    'amount' => $registration->price,
                    'payment_method' => 'fcp',
                    'payment_reference' => $ref_num,
                    'payment_status' => 'completed',
                    'gateway_response' => json_encode($verify_result)
                )
            );

            // نمایش صفحه وضعیت تراکنش
            $this->render_payment_status(true, array(
                'ref_id' => $ref_num,
                'mid' => $mid,
                'shaparak_terminal_id' => $shaparak_terminal_id,
                'mobile_no' => $mobile_no,
                'state' => $state
            ));
        } else {
            // به‌روزرسانی وضعیت به ناموفق
            $wpdb->update(
                $table_name,
                array('payment_status' => 'failed'),
                array('id' => $registration_id)
            );

            // اضافه کردن راهنمای re-verify در پیام ناموفق
            $message = $verify_result['message'] ?? 'تایید پرداخت ناموفق بود';
            $message .= ' — در صورت تکرار مشکل روی دکمه بازبینی کلیک کنید.';

            $this->render_payment_status(false, array(
                'message' => $message,
                'mid' => $mid,
                'shaparak_terminal_id' => $shaparak_terminal_id,
                'ref_num' => $ref_num,
                'mobile_no' => $mobile_no,
                'state' => $state,
                'token' => $token
            ));
        }

        exit;
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
     * دریافت مقدار از درخواست با پشتیبانی از نام‌های مختلف و هر دو متد POST/GET
     */
    private function get_request_value($names = array()) {
        foreach ($names as $name) {
            if (isset($_POST[$name])) {
                return sanitize_text_field(wp_unslash($_POST[$name]));
            }
            if (isset($_GET[$name])) {
                return sanitize_text_field(wp_unslash($_GET[$name]));
            }
            // چک نام‌های با تغییر حروف بزرگ/کوچک
            foreach ($_POST as $k => $v) {
                if (strcasecmp($k, $name) === 0) {
                    return sanitize_text_field(wp_unslash($v));
                }
            }
            foreach ($_GET as $k => $v) {
                if (strcasecmp($k, $name) === 0) {
                    return sanitize_text_field(wp_unslash($v));
                }
            }
        }
        return '';
    }

    /**
     * پردازش درخواست re-verify (بازبینی تایید) از طریق پارامتر ساده GET/POST
     */
    public function process_reverify_request() {
        // لاگ درخواست re-verify
        error_log('UM_FCP_Gateway reverify request: ' . print_r($_REQUEST, true));
        $ref_num = $this->get_request_value(array('RefNum', 'refNum'));
        $token = $this->get_request_value(array('token', 'Token'));

        if (empty($ref_num) || empty($token)) {
            wp_send_json_error(array('message' => 'پارامترهای تایید ناقص است.'));
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'um_seminar_registrations';
        $registration_id = 0;

        // تلاش برای یافتن بر اساس token
        if (!empty($token)) {
            $found = $wpdb->get_row($wpdb->prepare(
                "SELECT id, gateway_response FROM $table_name WHERE gateway_response LIKE %s LIMIT 1",
                '%' . $wpdb->esc_like($token) . '%'
            ));
            if ($found) {
                $registration_id = intval($found->id);
            }
        }

        if (!$registration_id && !empty($ref_num)) {
            $found_ref = $wpdb->get_row($wpdb->prepare(
                "SELECT id FROM $table_name WHERE payment_reference = %s OR gateway_response LIKE %s LIMIT 1",
                $ref_num,
                '%' . $wpdb->esc_like($ref_num) . '%'
            ));
            if ($found_ref) {
                $registration_id = intval($found_ref->id);
            }
        }

        if (!$registration_id) {
            wp_send_json_error(array('message' => 'ثبت نام مرتبط پیدا نشد.'));
        }

        $verify_result = $this->verify_payment($ref_num, $token);
        if ($verify_result['success']) {
            $wpdb->update(
                $table_name,
                array(
                    'payment_status' => 'completed',
                    'payment_reference' => $ref_num
                ),
                array('id' => $registration_id)
            );
            wp_send_json_success(array('message' => 'تایید پرداخت موفق بود.'));
        } else {
            wp_send_json_error(array('message' => $verify_result['message'] ?? 'تایید ناموفق.'));
        }
    }
    
    /**
     * نمایش صفحه وضعیت تراکنش
     */
    private function render_payment_status($success, $payment_data = array()) {
        status_header(200);
        nocache_headers();
        echo '<!DOCTYPE html><html lang="fa"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . esc_html(get_bloginfo('name')) . ' - وضعیت پرداخت</title>';
        echo '<style>body{font-family:tahoma,iransans,system-ui;padding:32px;background:' . ($success ? '#c4faf8' : '#fff5f5') . ';direction:rtl} .card{max-width:680px;margin:auto;background:#fff;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,.08);padding:24px;text-align:center;border:1px solid gray} .ok{color:#0a7;font-weight:bold} .fail{color:#c00;font-weight:bold} .info{margin-top:15px;text-align:right} .info-item{margin:8px 0}</style></head><body>';
        echo '<div class="card">';
        
        if ($success) {
            echo '<h2 class="ok">' . __('پرداخت شما با موفقیت انجام شد', 'university-management') . '</h2>';
        } else {
            $message = isset($payment_data['message']) ? $payment_data['message'] : __('تراکنش ناموفق بود', 'university-management');
            echo '<h2 class="fail">' . esc_html($message) . '</h2>';
        }
        
        if (!empty($payment_data)) {
            echo '<div class="info">';
            if (!empty($payment_data['ref_id'])) {
                echo '<div class="info-item"><strong>' . __('شماره مرجع تراکنش', 'university-management') . ':</strong> ' . esc_html($payment_data['ref_id']) . '</div>';
            }
            if (!empty($payment_data['mid'])) {
                echo '<div class="info-item"><strong>' . __('شماره پذیرنده', 'university-management') . ':</strong> ' . esc_html($payment_data['mid']) . '</div>';
            }
            if (!empty($payment_data['shaparak_terminal_id'])) {
                echo '<div class="info-item"><strong>' . __('کد درگاه پرداخت', 'university-management') . ':</strong> ' . esc_html($payment_data['shaparak_terminal_id']) . '</div>';
            }
            if (!empty($payment_data['mobile_no'])) {
                echo '<div class="info-item"><strong>' . __('شماره همراه', 'university-management') . ':</strong> ' . esc_html($payment_data['mobile_no']) . '</div>';
            }
            if (!empty($payment_data['state'])) {
                echo '<div class="info-item"><strong>' . __('وضعیت انجام تراکنش', 'university-management') . ':</strong> ' . esc_html($payment_data['state']) . '</div>';
            }
            echo '</div>';
        }
        
        echo '<div style="text-align:center;padding-top:15px;margin-top:20px;">';
        echo '<a href="' . esc_url(home_url('/')) . '" style="display:inline-block;padding:10px 30px;background-color:#7fff00;color:black;text-decoration:none;border-radius:7px;font-weight:bold;">' . esc_html__('بازگشت به سایت', 'university-management') . '</a>';
        // اگر تایید ناموفق بوده، دکمه بررسی مجدد را نمایش بده
        if (!$success) {
            $token_js = !empty($payment_data['token']) ? esc_js($payment_data['token']) : '';
            $ref_js = !empty($payment_data['ref_num']) ? esc_js($payment_data['ref_num']) : (!empty($payment_data['ref_id']) ? esc_js($payment_data['ref_id']) : '');
            echo '<div style="margin-top:12px;">';
            echo '<button id="um-reverify-btn" style="display:inline-block;padding:10px 20px;background:#ff9800;color:#fff;border:none;border-radius:6px;cursor:pointer;font-weight:bold;">' . esc_html__('بررسی مجدد تایید پرداخت', 'university-management') . '</button>';
            echo '<div id="um-reverify-result" style="margin-top:10px;"></div>';
            echo '</div>';
            echo '<script>document.getElementById("um-reverify-btn").addEventListener("click", function(){var btn=this;btn.disabled=true;var url="' . esc_url_raw(add_query_arg(array('um_reverify'=>1), home_url('/'))) . '&token="+encodeURIComponent("' . $token_js . '")+"&RefNum="+encodeURIComponent("' . $ref_js . '");fetch(url,{credentials:"same-origin"}).then(function(r){return r.json() }).then(function(j){document.getElementById("um-reverify-result").innerText = j.data ? (j.data.message || JSON.stringify(j.data)) : (j.data===false?JSON.stringify(j):JSON.stringify(j));btn.disabled=false}).catch(function(e){document.getElementById("um-reverify-result").innerText = "خطا در ارسال درخواست";btn.disabled=false});});</script>';
        }
        echo '</div>';
        echo '</div></body></html>';
    }
}

