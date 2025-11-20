<?php
/**
 * درگاه پرداخت و اندپوینت‌های رزرو سالن
 */

if (!defined('ABSPATH')) {
    exit;
}

class UM_Hall_Gateway {

    public function __construct() {
        // AJAX عمومی برای ایجاد رزرو و شروع پرداخت
        add_action('wp_ajax_nopriv_um_hall_create_and_pay', array($this, 'ajax_create_and_pay'));
        add_action('wp_ajax_um_hall_create_and_pay', array($this, 'ajax_create_and_pay'));

        // کال‌بک پرداخت از درگاه (نمایش پیام مناسب به کاربر)
        add_action('template_redirect', array($this, 'maybe_handle_callback'));
        // نمایش پیش‌فاکتور
        add_action('template_redirect', array($this, 'maybe_render_invoice'));
    }

    /**
     * AJAX: ایجاد رزرو و شروع پرداخت
     */
    public function ajax_create_and_pay() {
        // لاگ درخواست
        um_log('Hall Booking AJAX: Request received', array(
            'action' => $_POST['action'] ?? '',
            'has_nonce' => !empty($_POST['nonce']),
            'post_data_keys' => array_keys($_POST ?? array())
        ));
        
        // ضد اسپم ساده
        if (!empty($_POST['website'])) {
            um_error_log('Hall Booking AJAX: Bot detected');
            wp_send_json_error(array('message' => __('شناسایی ربات!', 'university-management')));
        }

        // بررسی نانس
        $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
        if (!$nonce || !wp_verify_nonce($nonce, 'university-management-nonce')) {
            um_error_log('Hall Booking AJAX: Invalid nonce', array('nonce' => $nonce));
            wp_send_json_error(array('message' => __('خطای امنیتی. صفحه را نوسازی کنید.', 'university-management')));
        }

        // دریافت و اعتبارسنجی فیلدها
        $event_title   = sanitize_text_field($_POST['event_title'] ?? '');
        $date          = sanitize_text_field($_POST['date'] ?? '');
        $start_time    = sanitize_text_field($_POST['start_time'] ?? '');
        $end_time      = sanitize_text_field($_POST['end_time'] ?? '');
        $equipment_ids = isset($_POST['equipments']) && is_array($_POST['equipments']) ? array_map('sanitize_text_field', $_POST['equipments']) : array();
        $name          = sanitize_text_field($_POST['name'] ?? '');
        $phone         = sanitize_text_field($_POST['phone'] ?? '');
        $email         = sanitize_email($_POST['email'] ?? '');
        $national_code = sanitize_text_field($_POST['national_code'] ?? '');
        $description   = sanitize_textarea_field($_POST['description'] ?? '');
        $usage_type    = sanitize_text_field($_POST['usage_type'] ?? '');
        $layout        = sanitize_text_field($_POST['layout'] ?? '');
        $catering      = isset($_POST['catering']) && is_array($_POST['catering']) ? array_map('sanitize_text_field', $_POST['catering']) : array();
        $need_operator = isset($_POST['need_operator']) ? '1' : '';
        $org_unit      = sanitize_text_field($_POST['org_unit'] ?? '');
        $position      = sanitize_text_field($_POST['position'] ?? '');
        $payment_method= sanitize_text_field($_POST['payment_method'] ?? '');

        // الزام پذیرش قوانین در صورت فعال بودن در تنظیمات
        $require_terms = get_option('um_hall_require_terms', '0') === '1';
        if ($require_terms && empty($_POST['accept_terms'])) {
            wp_send_json_error(array('message' => __('برای ادامه لازم است قوانین را بپذیرید.', 'university-management')));
        }

        if (!$event_title || !$date || !$start_time || !$end_time || !$name || !$phone) {
            um_error_log('Hall Booking AJAX: Required fields missing', array(
                'event_title' => !empty($event_title),
                'date' => !empty($date),
                'start_time' => !empty($start_time),
                'end_time' => !empty($end_time),
                'name' => !empty($name),
                'phone' => !empty($phone)
            ));
            wp_send_json_error(array('message' => __('لطفاً فیلدهای الزامی را تکمیل کنید.', 'university-management')));
        }

        // بررسی تداخل زمانی
        if (UM_Hall_Booking_Manager::has_time_conflict($date, $start_time, $end_time)) {
            um_error_log('Hall Booking AJAX: Time conflict detected', array(
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time
            ));
            wp_send_json_error(array('message' => __('بازه زمانی انتخابی قبلاً رزرو شده است.', 'university-management')));
        }

        // محاسبه مبلغ
        $amount = $this->calculate_amount($start_time, $end_time, $equipment_ids, $catering);
        um_log('Hall Booking AJAX: Amount calculated', array('amount' => $amount));
        if ($amount <= 0) {
            um_error_log('Hall Booking AJAX: Invalid amount', array('amount' => $amount));
            wp_send_json_error(array('message' => __('مبلغ معتبر نیست.', 'university-management')));
        }

        // ایجاد رزرو در حالت pending
        $post_id = wp_insert_post(array(
            'post_type'   => UM_Hall_Booking_Manager::POST_TYPE,
            'post_status' => 'pending',
            'post_title'  => wp_strip_all_tags($event_title . ' - ' . $date),
        ));
        if (is_wp_error($post_id) || !$post_id) {
            $error_msg = is_wp_error($post_id) ? $post_id->get_error_message() : 'Unknown error';
            um_error_log('Hall Booking AJAX: Failed to create booking', array('error' => $error_msg));
            wp_send_json_error(array('message' => __('خطا در ایجاد رزرو.', 'university-management')));
        }
        
        um_log('Hall Booking AJAX: Booking created', array('post_id' => $post_id));

        // ذخیره متاها
        update_post_meta($post_id, '_um_hall_event_title', $event_title);
        update_post_meta($post_id, '_um_hall_date', $date);
        update_post_meta($post_id, '_um_hall_start_time', $start_time);
        update_post_meta($post_id, '_um_hall_end_time', $end_time);
        update_post_meta($post_id, '_um_hall_equipment', wp_json_encode($equipment_ids));
        update_post_meta($post_id, '_um_hall_reserver_name', $name);
        update_post_meta($post_id, '_um_hall_phone', $phone);
        update_post_meta($post_id, '_um_hall_email', $email);
        update_post_meta($post_id, '_um_hall_national_code', $national_code);
        update_post_meta($post_id, '_um_hall_description', $description);
        update_post_meta($post_id, '_um_hall_usage_type', $usage_type);
        update_post_meta($post_id, '_um_hall_layout', $layout);
        update_post_meta($post_id, '_um_hall_catering', wp_json_encode($catering));
        update_post_meta($post_id, '_um_hall_need_operator', $need_operator);
        update_post_meta($post_id, '_um_hall_org_unit', $org_unit);
        update_post_meta($post_id, '_um_hall_position', $position);
        update_post_meta($post_id, '_um_hall_payment_method', $payment_method);
        update_post_meta($post_id, '_um_hall_total_amount', $amount);
        update_post_meta($post_id, '_um_hall_payment_status', 'pending');
        update_post_meta($post_id, '_um_hall_created_at', current_time('mysql'));

        // شروع فرآیند پرداخت یا ثبت پیش‌فاکتور بر اساس روش پرداخت
        $gateway = get_option('um_hall_gateway', 'fcp');
        if (!$payment_method || $payment_method === 'online') {
            if ($gateway === 'fcp') {
                um_log('Hall Booking AJAX: Initiating FCP payment', array(
                    'post_id' => $post_id,
                    'amount' => $amount,
                    'credentials_set' => !empty(get_option('um_fcp_user_id', '')) && !empty(get_option('um_fcp_password', '')) && !empty(get_option('um_fcp_merchant_id', ''))
                ));
                if (!class_exists('UM_FCP_Gateway_Hall')) {
                    require_once UM_PLUGIN_DIR . 'includes/hall-booking/class-um-fcp-gateway.php';
                }
                $fcp_gateway = new UM_FCP_Gateway_Hall();
                $result = $fcp_gateway->create_payment($post_id, $amount, $email, $phone, $event_title);
            } elseif ($gateway === 'zarinpal') {
                um_log('Hall Booking AJAX: Initiating Zarinpal payment', array(
                    'post_id' => $post_id,
                    'amount' => $amount,
                    'merchant_id_set' => !empty(get_option('um_hall_zarinpal_merchant_id', ''))
                ));
                $result = $this->zarinpal_request($post_id, $amount, $email, $phone, $event_title);
            } else {
                $result = new WP_Error('gateway_not_supported', __('درگاه پشتیبانی نمی‌شود', 'university-management'));
            }
        } else {
            // پیش‌فاکتور/ثبت رزرو بدون پرداخت آنلاین
            um_log('Hall Booking AJAX: Creating invoice (non-online payment)', array('post_id' => $post_id));
            update_post_meta($post_id, '_um_hall_payment_status', 'pending');
            wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
            $invoice_url = add_query_arg(array('um_hall_invoice' => 1, 'booking_id' => $post_id), home_url('/'));
            $result = $invoice_url;
        }

        if (is_wp_error($result)) {
            um_error_log('Hall Booking AJAX: Payment gateway error', array(
                'error' => $result->get_error_message(),
                'code' => $result->get_error_code()
            ));
            wp_send_json_error(array('message' => $result->get_error_message()));
        }

        um_log('Hall Booking AJAX: Success, redirecting', array('redirect_url' => $result));
        wp_send_json_success(array('redirect_url' => $result));
    }

    private function calculate_amount($start_time, $end_time, array $equipment_ids, array $catering_ids = array()) {
        $hourly_rate = floatval(get_option('um_hall_hourly_rate', 0));
        $equipments_enabled = get_option('um_hall_enable_equipment', '1') === '1';
        $equipments_json = (string) get_option('um_hall_equipment', '[]');
        $equipments = json_decode($equipments_json, true);
        if (!is_array($equipments) || !$equipments_enabled) {
            $equipments = array();
        }
        $caterings_json = (string) get_option('um_hall_catering', '[]');
        $caterings = json_decode($caterings_json, true);
        if (!is_array($caterings)) { $caterings = array(); }

        $start = strtotime($start_time);
        $end = strtotime($end_time);
        if (!$start || !$end || $end <= $start) {
            return 0;
        }
        $hours = max(1, ceil(($end - $start) / 3600));
        $amount = $hours * $hourly_rate;

        if ($equipments_enabled) {
            $selected_map = array_fill_keys($equipment_ids, true);
            foreach ($equipments as $eq) {
                $id = $eq['id'] ?? '';
                if (!$id || !isset($selected_map[$id])) { continue; }
                $price = floatval($eq['price'] ?? 0);
                $unit  = isset($eq['unit']) ? (string) $eq['unit'] : 'fixed';
                if ($unit === 'per_hour') {
                    $amount += $price * $hours;
                } else {
                    $amount += $price;
                }
            }
        }
        // محاسبه هزینه پذیرایی
        if (!empty($catering_ids)) {
            $selected_cat = array_fill_keys($catering_ids, true);
            foreach ($caterings as $ct) {
                $id = $ct['id'] ?? '';
                if (!$id || !isset($selected_cat[$id])) { continue; }
                $price = floatval($ct['price'] ?? 0);
                $unit  = isset($ct['unit']) ? (string) $ct['unit'] : 'fixed';
                if ($unit === 'per_hour') {
                    $amount += $price * $hours;
                } else {
                    $amount += $price;
                }
            }
        }
        return (float) $amount;
    }

    private function zarinpal_request($booking_id, $amount, $email, $mobile, $description) {
        $merchant_id = trim((string) get_option('um_hall_zarinpal_merchant_id', ''));
        if (!$merchant_id) {
            um_error_log('Zarinpal Request: Merchant ID not set', array('booking_id' => $booking_id));
            return new WP_Error('zarinpal_merchant_missing', __('مرچنت آیدی زرین‌پال تنظیم نشده است. لطفاً در تنظیمات سالن، مرچنت آیدی را وارد کنید.', 'university-management'));
        }
        
        // ساخت callback URL
        $callback = add_query_arg(array(
            'um_hall_callback' => 1,
            'booking_id' => $booking_id,
        ), home_url('/'));
        
        // اطمینان از اینکه callback URL کامل است
        if (!filter_var($callback, FILTER_VALIDATE_URL)) {
            um_error_log('Zarinpal Request: Invalid callback URL', array('callback' => $callback));
            return new WP_Error('invalid_callback_url', __('آدرس بازگشت معتبر نیست.', 'university-management'));
        }

        $payload = array(
            'merchant_id' => $merchant_id,
            'amount' => intval($amount),
            'callback_url' => $callback,
            'description' => wp_strip_all_tags($description ?: __('رزرو سالن', 'university-management')),
            'metadata' => array(
                'email' => $email,
                'mobile' => $mobile,
            ),
        );
        $sandbox = get_option('um_hall_zarinpal_sandbox', '0') === '1';
        $base = $sandbox ? 'https://sandbox.zarinpal.com/pg/v4' : 'https://api.zarinpal.com/pg/v4';
        um_log('Zarinpal Request: Sending request', array(
            'base' => $base,
            'merchant_id' => $merchant_id,
            'amount' => $amount,
            'booking_id' => $booking_id
        ));
        
        $response = wp_remote_post($base . '/payment/request.json', array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => wp_json_encode($payload),
            'timeout' => 30,
        ));
        if (is_wp_error($response)) {
            um_error_log('Zarinpal Request: WP_Error', array(
                'error' => $response->get_error_message(),
                'code' => $response->get_error_code()
            ));
            return $response;
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        um_log('Zarinpal Request: Response received', array(
            'response_code' => $response_code,
            'body' => $body
        ));
        
        if (!empty($body['data']['authority'])) {
            $authority = sanitize_text_field($body['data']['authority']);
            update_post_meta($booking_id, '_um_hall_authority', $authority);
            // لینک هدایت
            $redirect_url = ($sandbox ? 'https://sandbox.zarinpal.com/pg/StartPay/' : 'https://www.zarinpal.com/pg/StartPay/') . $authority;
            um_log('Zarinpal Request: Success', array('authority' => $authority, 'redirect_url' => $redirect_url));
            return $redirect_url;
        }

        // دریافت پیام خطا از زرین‌پال
        $message = $body['errors']['message'] ?? __('خطا در ارتباط با درگاه پرداخت', 'university-management');
        
        // ترجمه و بهبود پیام‌های خطای رایج زرین‌پال
        $message_lower = strtolower($message);
        if (strpos($message_lower, 'too many') !== false || strpos($message_lower, 'to many') !== false || strpos($message_lower, 'attempts') !== false) {
            $message = __('تعداد درخواست‌های شما بیش از حد مجاز است. لطفاً چند دقیقه صبر کنید و دوباره تلاش کنید.', 'university-management');
            um_error_log('Zarinpal Request: Rate limit exceeded', array(
                'original_message' => $body['errors']['message'] ?? '',
                'body' => $body,
                'booking_id' => $booking_id
            ));
        } else {
            um_error_log('Zarinpal Request: Failed', array('message' => $message, 'body' => $body));
        }
        
        return new WP_Error('zarinpal_request_failed', $message);
    }

    private function zarinpal_verify($authority, $amount) {
        $merchant_id = trim((string) get_option('um_hall_zarinpal_merchant_id', ''));
        $payload = array(
            'merchant_id' => $merchant_id,
            'amount' => intval($amount),
            'authority' => $authority,
        );
        $sandbox = get_option('um_hall_zarinpal_sandbox', '0') === '1';
        $base = $sandbox ? 'https://sandbox.zarinpal.com/pg/v4' : 'https://api.zarinpal.com/pg/v4';
        $response = wp_remote_post($base . '/payment/verify.json', array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => wp_json_encode($payload),
            'timeout' => 30,
        ));
        if (is_wp_error($response)) {
            return $response;
        }
        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (!empty($body['data']['code'])) {
            $code = intval($body['data']['code']);
            // 100: موفق | 101: قبلاً تایید شده (موفق تلقی شود)
            if ($code === 100 || $code === 101) {
                return array(
                    'ref_id' => $body['data']['ref_id'] ?? '',
                    'card_hash' => $body['data']['card_hash'] ?? '',
                    'code' => $code,
                );
            }
        }
        $message = $body['errors']['message'] ?? __('تایید پرداخت ناموفق بود', 'university-management');
        return new WP_Error('zarinpal_verify_failed', $message);
    }

    public function maybe_handle_callback() {
        if (!isset($_GET['um_hall_callback'])) {
            return;
        }
        // لاگ کامل ورودی برای دیباگ
        $raw_input = file_get_contents('php://input');
        um_log('Hall Gateway Callback $_POST', array('post' => $_POST));
        error_log('UM_Hall_Gateway Callback raw body: ' . $raw_input);
        $booking_id = isset($_GET['booking_id']) ? absint($_GET['booking_id']) : 0;
        
        if (!$booking_id) {
            $this->render_message(__('درخواست نامعتبر است.', 'university-management'), false);
            return;
        }

        $gateway = get_option('um_hall_gateway', 'fcp');
        $amount = floatval(get_post_meta($booking_id, '_um_hall_total_amount', true));

        // پردازش callback فناوا
        if ($gateway === 'fcp') {
            // دریافت پارامترها از POST (فناوا از POST استفاده می‌کند)
            // همچنین ممکن است از GET هم بیاید (برای سازگاری)
            $mid = isset($_POST['MID']) ? sanitize_text_field($_POST['MID']) : (isset($_GET['MID']) ? sanitize_text_field($_GET['MID']) : '');
            $shaparak_terminal_id = isset($_POST['shaparakTerminalId']) ? sanitize_text_field($_POST['shaparakTerminalId']) : (isset($_GET['shaparakTerminalId']) ? sanitize_text_field($_GET['shaparakTerminalId']) : '');
            $customer_ref_num = isset($_POST['CustomerRefNum']) ? sanitize_text_field($_POST['CustomerRefNum']) : (isset($_GET['CustomerRefNum']) ? sanitize_text_field($_GET['CustomerRefNum']) : '');
            $mobile_no = isset($_POST['mobileNo']) ? sanitize_text_field($_POST['mobileNo']) : (isset($_GET['mobileNo']) ? sanitize_text_field($_GET['mobileNo']) : '');
            $state = isset($_POST['State']) ? sanitize_text_field($_POST['State']) : (isset($_GET['State']) ? sanitize_text_field($_GET['State']) : '');
            // دریافت RefNum و token با پشتیبانی از نام‌های مختلف
            $ref_num = '';
            $token = '';
            if (isset($_POST['RefNum'])) { $ref_num = sanitize_text_field($_POST['RefNum']); }
            elseif (isset($_POST['refNum'])) { $ref_num = sanitize_text_field($_POST['refNum']); }
            elseif (isset($_GET['RefNum'])) { $ref_num = sanitize_text_field($_GET['RefNum']); }
            elseif (isset($_GET['refNum'])) { $ref_num = sanitize_text_field($_GET['refNum']); }

            if (isset($_POST['token'])) { $token = sanitize_text_field($_POST['token']); }
            elseif (isset($_POST['Token'])) { $token = sanitize_text_field($_POST['Token']); }
            elseif (isset($_GET['token'])) { $token = sanitize_text_field($_GET['token']); }
            elseif (isset($_GET['Token'])) { $token = sanitize_text_field($_GET['Token']); }

            if (empty($ref_num) || empty($token)) {
                update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
                wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
                $this->notify($booking_id, false, '');
                $this->render_payment_status(__('تراکنش ناموفق یا پارامترهای ورودی نادرست است.', 'university-management'), false, array(
                    'mid' => $mid,
                    'shaparak_terminal_id' => $shaparak_terminal_id,
                    'ref_num' => $ref_num,
                    'mobile_no' => $mobile_no,
                    'state' => $state
                ));
                return;
            }

            // بررسی Token ذخیره شده
            $stored_token = get_post_meta($booking_id, '_um_hall_fcp_token', true);
            if (empty($stored_token) || $stored_token !== $token) {
                update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
                wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
                $this->notify($booking_id, false, '');
                um_error_log('Hall Gateway Callback: token mismatch', array('booking_id'=>$booking_id,'stored_token'=>$stored_token,'incoming_token'=>$token));
                $this->render_message(__('شناسه تراکنش معتبر نیست.', 'university-management'), false);
                return;
            }

            // تایید پرداخت
            if (!class_exists('UM_FCP_Gateway_Hall')) {
                require_once UM_PLUGIN_DIR . 'includes/hall-booking/class-um-fcp-gateway.php';
            }
            $fcp_gateway = new UM_FCP_Gateway_Hall();
            $verify = $fcp_gateway->verify_payment($ref_num, $token);
            um_log('Hall Gateway Callback: verify result', array('result' => $verify));
            error_log('UM_Hall_Gateway verify result: ' . (is_wp_error($verify) ? $verify->get_error_message() : print_r($verify, true)));

            if (is_wp_error($verify)) {
                update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
                wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
                $this->notify($booking_id, false, '');
                $this->render_payment_status($verify->get_error_message(), false, array(
                    'mid' => $mid,
                    'shaparak_terminal_id' => $shaparak_terminal_id,
                    'ref_num' => $ref_num,
                    'mobile_no' => $mobile_no,
                    'state' => $state
                ));
                return;
            }

            // پرداخت موفق
            update_post_meta($booking_id, '_um_hall_payment_status', 'success');
            update_post_meta($booking_id, '_um_hall_ref_id', $ref_num);
            wp_update_post(array('ID' => $booking_id, 'post_status' => 'publish'));
            $this->notify($booking_id, true, $ref_num);
            $this->render_payment_status(__('پرداخت شما با موفقیت انجام شد', 'university-management'), true, array(
                'mid' => $mid,
                'shaparak_terminal_id' => $shaparak_terminal_id,
                'ref_num' => $ref_num,
                'mobile_no' => $mobile_no,
                'state' => $state
            ));
            return;
        }

        // پردازش callback زرین‌پال (کد قبلی)
        $status     = isset($_GET['Status']) ? sanitize_text_field(wp_unslash($_GET['Status'])) : '';
        $authority  = isset($_GET['Authority']) ? sanitize_text_field(wp_unslash($_GET['Authority'])) : '';

        if (!$authority) {
            $this->render_message(__('درخواست نامعتبر است.', 'university-management'), false);
            return;
        }

        $stored_authority = get_post_meta($booking_id, '_um_hall_authority', true);

        if (!$stored_authority || $stored_authority !== $authority) {
            $this->render_message(__('شناسه تراکنش معتبر نیست.', 'university-management'), false);
            return;
        }

        if ($status !== 'OK') {
            update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
            wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
            $this->notify($booking_id, false, '');
            $this->render_message(__('پرداخت لغو شد یا ناموفق بود.', 'university-management'), false);
            return;
        }

        $verify = $this->zarinpal_verify($authority, $amount);
        if (is_wp_error($verify)) {
            update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
            wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
            $this->notify($booking_id, false, '');
            $this->render_message($verify->get_error_message(), false);
            return;
        }

        update_post_meta($booking_id, '_um_hall_payment_status', 'success');
        update_post_meta($booking_id, '_um_hall_ref_id', sanitize_text_field($verify['ref_id']));
        wp_update_post(array('ID' => $booking_id, 'post_status' => 'publish'));
        $this->notify($booking_id, true, $verify['ref_id']);
        $this->render_message(__('پرداخت با موفقیت انجام شد. کد پیگیری: ', 'university-management') . esc_html($verify['ref_id']), true);
    }

    private function render_message($message, $success) {
        status_header(200);
        nocache_headers();
        echo '<!DOCTYPE html><html lang="fa"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . esc_html(get_bloginfo('name')) . '</title>';
        echo '<style>body{font-family:tahoma,iransans,system-ui;padding:32px;background:' . ($success ? '#f0fff4' : '#fff5f5') . ';direction:rtl} .card{max-width:680px;margin:auto;background:#fff;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,.08);padding:24px} .ok{color:#0a7} .fail{color:#c00}</style></head><body>';
        echo '<div class="card"><h2 class="' . ($success ? 'ok' : 'fail') . '">' . ($success ? __('موفق', 'university-management') : __('ناموفق', 'university-management')) . '</h2>';
        echo '<p>' . esc_html($message) . '</p>';
        echo '<p><a href="' . esc_url(home_url('/')) . '">' . esc_html__('بازگشت به سایت', 'university-management') . '</a></p>';
        echo '</div></body></html>';
        exit;
    }

    /**
     * نمایش صفحه وضعیت تراکنش (برای فناوا)
     */
    private function render_payment_status($message, $success, $payment_data = array()) {
        status_header(200);
        nocache_headers();
        echo '<!DOCTYPE html><html lang="fa"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . esc_html(get_bloginfo('name')) . ' - وضعیت پرداخت</title>';
        echo '<style>body{font-family:tahoma,iransans,system-ui;padding:32px;background:' . ($success ? '#c4faf8' : '#fff5f5') . ';direction:rtl} .card{max-width:680px;margin:auto;background:#fff;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,.08);padding:24px;text-align:center;border:1px solid gray} .ok{color:#0a7;font-weight:bold} .fail{color:#c00;font-weight:bold} .info{margin-top:15px;text-align:right} .info-item{margin:8px 0}</style></head><body>';
        echo '<div class="card">';
        echo '<h2 class="' . ($success ? 'ok' : 'fail') . '">' . esc_html($message) . '</h2>';
        
        if (!empty($payment_data)) {
            echo '<div class="info">';
            if (!empty($payment_data['mid'])) {
                echo '<div class="info-item"><strong>' . __('شماره پذیرنده', 'university-management') . ':</strong> ' . esc_html($payment_data['mid']) . '</div>';
            }
            if (!empty($payment_data['shaparak_terminal_id'])) {
                echo '<div class="info-item"><strong>' . __('کد درگاه پرداخت', 'university-management') . ':</strong> ' . esc_html($payment_data['shaparak_terminal_id']) . '</div>';
            }
            if (!empty($payment_data['ref_num'])) {
                echo '<div class="info-item"><strong>' . __('شماره مرجع تراکنش', 'university-management') . ':</strong> ' . esc_html($payment_data['ref_num']) . '</div>';
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
        echo '</div>';
        echo '</div></body></html>';
        exit;
    }

    private function notify($booking_id, $success, $ref_id) {
        $admin_email = get_option('um_hall_admin_email', get_option('admin_email'));
        $user_email  = get_post_meta($booking_id, '_um_hall_email', true);
        $subject     = $success ? __('تایید رزرو سالن', 'university-management') : __('خطا در پرداخت رزرو سالن', 'university-management');

        $fields = array(
            'عنوان رویداد' => get_post_meta($booking_id, '_um_hall_event_title', true),
            'تاریخ' => get_post_meta($booking_id, '_um_hall_date', true),
            'ساعت' => get_post_meta($booking_id, '_um_hall_start_time', true) . ' - ' . get_post_meta($booking_id, '_um_hall_end_time', true),
            'مبلغ' => number_format_i18n(floatval(get_post_meta($booking_id, '_um_hall_total_amount', true))) . ' تومان',
            'کد پیگیری' => $ref_id,
            'وضعیت' => $success ? 'موفق' : 'ناموفق',
        );
        $html = '<div style="direction:rtl;text-align:right">';
        $html .= '<h3>' . esc_html($subject) . '</h3><ul>';
        foreach ($fields as $k => $v) {
            $html .= '<li><strong>' . esc_html($k) . ':</strong> ' . esc_html($v) . '</li>';
        }
        $html .= '</ul></div>';

        add_filter('wp_mail_content_type', function () {return 'text/html; charset=UTF-8';});
        if ($user_email) {
            wp_mail($user_email, $subject, $html);
        }
        if ($admin_email) {
            wp_mail($admin_email, 'ADMIN: ' . $subject, $html);
        }
        remove_filter('wp_mail_content_type', '__return_false');
    }

    public function maybe_render_invoice() {
        if (!isset($_GET['um_hall_invoice'])) {
            return;
        }
        $booking_id = isset($_GET['booking_id']) ? absint($_GET['booking_id']) : 0;
        if (!$booking_id) {
            wp_die(__('شناسه رزرو نامعتبر است', 'university-management'));
        }
        $amount = floatval(get_post_meta($booking_id, '_um_hall_total_amount', true));
        $date = get_post_meta($booking_id, '_um_hall_date', true);
        $s = get_post_meta($booking_id, '_um_hall_start_time', true);
        $e = get_post_meta($booking_id, '_um_hall_end_time', true);
        $title = get_post_meta($booking_id, '_um_hall_event_title', true);
        $name = get_post_meta($booking_id, '_um_hall_reserver_name', true);
        status_header(200);
        nocache_headers();
        echo '<!DOCTYPE html><html lang="fa"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . esc_html__('پیش‌فاکتور رزرو سالن', 'university-management') . '</title>';
        echo '<style>body{font-family:tahoma,iransans,system-ui;padding:32px;direction:rtl}.card{max-width:680px;margin:auto;background:#fff;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,.08);padding:24px}</style></head><body>';
        echo '<div class="card">';
        echo '<h2>' . esc_html__('پیش‌فاکتور رزرو سالن', 'university-management') . '</h2>';
        echo '<ul>';
        echo '<li><strong>' . esc_html__('عنوان رویداد', 'university-management') . ':</strong> ' . esc_html($title) . '</li>';
        echo '<li><strong>' . esc_html__('تاریخ و ساعت', 'university-management') . ':</strong> ' . esc_html($date . ' | ' . $s . '-' . $e) . '</li>';
        echo '<li><strong>' . esc_html__('رزروکننده', 'university-management') . ':</strong> ' . esc_html($name) . '</li>';
        echo '<li><strong>' . esc_html__('مبلغ کل', 'university-management') . ':</strong> ' . esc_html(number_format_i18n($amount)) . ' ' . esc_html__('تومان', 'university-management') . '</li>';
        echo '</ul>';
        echo '<p>' . esc_html__('برای پرداخت غیرآنلاین، این پیش‌فاکتور را به واحد مالی ارائه دهید.', 'university-management') . '</p>';
        echo '<p><a href="' . esc_url(home_url('/')) . '">' . esc_html__('بازگشت به سایت', 'university-management') . '</a></p>';
        echo '</div></body></html>';
        exit;
    }
}


