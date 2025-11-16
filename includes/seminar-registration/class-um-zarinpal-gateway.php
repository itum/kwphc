<?php
/**
 * درگاه پرداخت زرین‌پال برای ثبت نام سمینارها
 *
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

/**
 * کلاس درگاه پرداخت زرین‌پال
 */
class UM_Zarinpal_Gateway {
    
    private $merchant_id;
    private $sandbox_mode;
    private $callback_url;
    
    public function __construct() {
        $this->merchant_id = get_option('um_zarinpal_merchant_id', '');
        $this->sandbox_mode = get_option('um_zarinpal_sandbox', '1');
        $this->callback_url = home_url('/um-payment-callback/');
        
        // اضافه کردن اکشن‌های AJAX
        add_action('wp_ajax_um_create_payment', array($this, 'create_payment'));
        add_action('wp_ajax_nopriv_um_create_payment', array($this, 'create_payment'));
        add_action('wp_ajax_um_verify_payment', array($this, 'verify_payment'));
        add_action('wp_ajax_nopriv_um_verify_payment', array($this, 'verify_payment'));
        
        // اضافه کردن endpoint برای callback
        add_action('init', array($this, 'add_payment_endpoints'));
        add_action('template_redirect', array($this, 'handle_payment_callback'));
    }
    
    /**
     * اضافه کردن endpoint برای callback
     */
    public function add_payment_endpoints() {
        add_rewrite_rule('^um-payment-callback/?$', 'index.php?um_payment_callback=1', 'top');
    }
    
    /**
     * مدیریت callback پرداخت
     */
    public function handle_payment_callback() {
        if (get_query_var('um_payment_callback')) {
            $this->process_payment_callback();
            exit;
        }
    }
    
    /**
     * ایجاد درخواست پرداخت
     */
    public function create_payment($registration_id, $amount, $description = '') {
        if (empty($this->merchant_id)) {
            return array('success' => false, 'message' => 'کلید درگاه تنظیم نشده است.');
        }
        
        $data = array(
            'merchant_id' => $this->merchant_id,
            'amount' => $amount,
            'callback_url' => $this->callback_url . '?registration_id=' . $registration_id,
            'description' => $description ?: 'پرداخت ثبت نام سمینار',
            'metadata' => array(
                'registration_id' => $registration_id
            )
        );
        
        $url = $this->sandbox_mode ? 'https://sandbox.zarinpal.com/pg/v4/payment/request.json' : 'https://api.zarinpal.com/pg/v4/payment/request.json';
        
        $response = wp_remote_post($url, array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ),
            'body' => json_encode($data),
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array('success' => false, 'message' => 'خطا در ارتباط با درگاه پرداخت.');
        }
        
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
        
        // بررسی معتبر بودن نتیجه
        if (!is_array($result)) {
            um_error_log('Zarinpal API: Invalid JSON response', array('body' => $body));
            return array('success' => false, 'message' => 'خطا در ارتباط با درگاه پرداخت: پاسخ نامعتبر');
        }
        
        // بررسی وجود data و code
        if (isset($result['data']) && isset($result['data']['code']) && $result['data']['code'] == 100) {
            if (!isset($result['data']['authority'])) {
                um_error_log('Zarinpal API: Authority missing in response', array('result' => $result));
                return array('success' => false, 'message' => 'خطا در ایجاد درخواست پرداخت: اطلاعات ناقص');
            }
            
            $payment_url = $this->sandbox_mode ? 
                'https://sandbox.zarinpal.com/pg/StartPay/' . $result['data']['authority'] :
                'https://www.zarinpal.com/pg/StartPay/' . $result['data']['authority'];
                
            return array(
                'success' => true,
                'authority' => $result['data']['authority'],
                'payment_url' => $payment_url
            );
        } else {
            // مدیریت خطاها
            $error_message = 'خطا در ایجاد درخواست پرداخت';
            
            if (isset($result['errors']) && is_array($result['errors'])) {
                if (isset($result['errors']['code'])) {
                    $error_message .= ': ' . $result['errors']['code'];
                } elseif (isset($result['errors']['message'])) {
                    $error_message .= ': ' . $result['errors']['message'];
                }
            } elseif (isset($result['data']['code'])) {
                $error_message .= ': کد خطا ' . $result['data']['code'];
            }
            
            um_error_log('Zarinpal API: Payment request failed', array(
                'result' => $result,
                'error_message' => $error_message
            ));
            
            return array('success' => false, 'message' => $error_message);
        }
    }
    
    /**
     * تایید پرداخت
     */
    public function verify_payment($authority, $amount) {
        if (empty($this->merchant_id)) {
            return array('success' => false, 'message' => 'کلید درگاه تنظیم نشده است.');
        }
        
        $data = array(
            'merchant_id' => $this->merchant_id,
            'amount' => $amount,
            'authority' => $authority
        );
        
        $url = $this->sandbox_mode ? 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json' : 'https://api.zarinpal.com/pg/v4/payment/verify.json';
        
        $response = wp_remote_post($url, array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ),
            'body' => json_encode($data),
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array('success' => false, 'message' => 'خطا در ارتباط با درگاه پرداخت.');
        }
        
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
        
        if ($result['data']['code'] == 100) {
            return array(
                'success' => true,
                'ref_id' => $result['data']['ref_id'],
                'card_pan' => $result['data']['card_pan'] ?? ''
            );
        } else {
            return array('success' => false, 'message' => 'پرداخت ناموفق: ' . $result['errors']['code']);
        }
    }
    
    /**
     * پردازش callback پرداخت
     */
    private function process_payment_callback() {
        $registration_id = intval($_GET['registration_id'] ?? 0);
        $authority = sanitize_text_field($_GET['Authority'] ?? '');
        $status = sanitize_text_field($_GET['Status'] ?? '');
        
        if (!$registration_id || !$authority) {
            wp_redirect(home_url('/?payment_error=1'));
            exit;
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'um_seminar_registrations';
        
        // دریافت اطلاعات ثبت نام
        $registration = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $registration_id
        ));
        
        if (!$registration) {
            wp_redirect(home_url('/?payment_error=2'));
            exit;
        }
        
        if ($status == 'OK') {
            // تایید پرداخت
            $verify_result = $this->verify_payment($authority, $registration->price);
            
            if ($verify_result['success']) {
                // به‌روزرسانی وضعیت ثبت نام
                $wpdb->update(
                    $table_name,
                    array(
                        'payment_status' => 'completed',
                        'payment_reference' => $verify_result['ref_id']
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
                        'payment_method' => 'zarinpal',
                        'payment_reference' => $verify_result['ref_id'],
                        'payment_status' => 'completed',
                        'gateway_response' => json_encode($verify_result)
                    )
                );
                
                wp_redirect(home_url('/?payment_success=1&ref_id=' . $verify_result['ref_id']));
            } else {
                // به‌روزرسانی وضعیت به ناموفق
                $wpdb->update(
                    $table_name,
                    array('payment_status' => 'failed'),
                    array('id' => $registration_id)
                );
                
                wp_redirect(home_url('/?payment_error=3&message=' . urlencode($verify_result['message'])));
            }
        } else {
            // لغو پرداخت
            $wpdb->update(
                $table_name,
                array('payment_status' => 'cancelled'),
                array('id' => $registration_id)
            );
            
            wp_redirect(home_url('/?payment_cancelled=1'));
        }
        
        exit;
    }
    
    /**
     * AJAX: ایجاد پرداخت
     */
    public function ajax_create_payment() {
        check_ajax_referer('um_seminar_registration', 'nonce');
        
        $registration_id = intval($_POST['registration_id'] ?? 0);
        $amount = intval($_POST['amount'] ?? 0);
        $description = sanitize_text_field($_POST['description'] ?? '');
        
        if (!$registration_id || !$amount) {
            wp_send_json_error('اطلاعات ناقص است.');
        }
        
        $result = $this->create_payment($registration_id, $amount, $description);
        
        if ($result['success']) {
            wp_send_json_success($result);
        } else {
            wp_send_json_error($result['message']);
        }
    }
    
    /**
     * AJAX: تایید پرداخت
     */
    public function ajax_verify_payment() {
        check_ajax_referer('um_seminar_registration', 'nonce');
        
        $authority = sanitize_text_field($_POST['authority'] ?? '');
        $amount = intval($_POST['amount'] ?? 0);
        
        if (!$authority || !$amount) {
            wp_send_json_error('اطلاعات ناقص است.');
        }
        
        $result = $this->verify_payment($authority, $amount);
        
        if ($result['success']) {
            wp_send_json_success($result);
        } else {
            wp_send_json_error($result['message']);
        }
    }
}
