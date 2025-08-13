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
        // ضد اسپم ساده
        if (!empty($_POST['website'])) {
            wp_send_json_error(array('message' => __('شناسایی ربات!', 'university-management')));
        }

        // بررسی نانس
        $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
        if (!$nonce || !wp_verify_nonce($nonce, 'university-management-nonce')) {
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
            wp_send_json_error(array('message' => __('لطفاً فیلدهای الزامی را تکمیل کنید.', 'university-management')));
        }

        // بررسی تداخل زمانی
        if (UM_Hall_Booking_Manager::has_time_conflict($date, $start_time, $end_time)) {
            wp_send_json_error(array('message' => __('بازه زمانی انتخابی قبلاً رزرو شده است.', 'university-management')));
        }

        // محاسبه مبلغ
        $amount = $this->calculate_amount($start_time, $end_time, $equipment_ids, $catering);
        if ($amount <= 0) {
            wp_send_json_error(array('message' => __('مبلغ معتبر نیست.', 'university-management')));
        }

        // ایجاد رزرو در حالت pending
        $post_id = wp_insert_post(array(
            'post_type'   => UM_Hall_Booking_Manager::POST_TYPE,
            'post_status' => 'pending',
            'post_title'  => wp_strip_all_tags($event_title . ' - ' . $date),
        ));
        if (is_wp_error($post_id) || !$post_id) {
            wp_send_json_error(array('message' => __('خطا در ایجاد رزرو.', 'university-management')));
        }

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
        $gateway = get_option('um_hall_gateway', 'zarinpal');
        if (!$payment_method || $payment_method === 'online') {
            if ($gateway === 'zarinpal') {
                $result = $this->zarinpal_request($post_id, $amount, $email, $phone, $event_title);
            } else {
                $result = new WP_Error('gateway_not_supported', __('درگاه پشتیبانی نمی‌شود', 'university-management'));
            }
        } else {
            // پیش‌فاکتور/ثبت رزرو بدون پرداخت آنلاین
            update_post_meta($post_id, '_um_hall_payment_status', 'pending');
            wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
            $invoice_url = add_query_arg(array('um_hall_invoice' => 1, 'booking_id' => $post_id), home_url('/'));
            $result = $invoice_url;
        }

        if (is_wp_error($result)) {
            wp_send_json_error(array('message' => $result->get_error_message()));
        }

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
            return new WP_Error('zarinpal_merchant_missing', __('مرچنت آیدی زرین‌پال تنظیم نشده است.', 'university-management'));
        }
        $callback = add_query_arg(array(
            'um_hall_callback' => 1,
            'booking_id' => $booking_id,
        ), home_url('/'));

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
        $response = wp_remote_post($base . '/payment/request.json', array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => wp_json_encode($payload),
            'timeout' => 30,
        ));
        if (is_wp_error($response)) {
            return $response;
        }
        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (!empty($body['data']['authority'])) {
            $authority = sanitize_text_field($body['data']['authority']);
            update_post_meta($booking_id, '_um_hall_authority', $authority);
            // لینک هدایت
            $redirect_url = ($sandbox ? 'https://sandbox.zarinpal.com/pg/StartPay/' : 'https://www.zarinpal.com/pg/StartPay/') . $authority;
            return $redirect_url;
        }

        $message = $body['errors']['message'] ?? __('خطا در ارتباط با درگاه پرداخت', 'university-management');
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
        if (!empty($body['data']['code']) && intval($body['data']['code']) === 100) {
            return array(
                'ref_id' => $body['data']['ref_id'] ?? '',
                'card_hash' => $body['data']['card_hash'] ?? '',
            );
        }
        $message = $body['errors']['message'] ?? __('تایید پرداخت ناموفق بود', 'university-management');
        return new WP_Error('zarinpal_verify_failed', $message);
    }

    public function maybe_handle_callback() {
        if (!isset($_GET['um_hall_callback'])) {
            return;
        }
        $booking_id = isset($_GET['booking_id']) ? absint($_GET['booking_id']) : 0;
        $status     = isset($_GET['Status']) ? sanitize_text_field(wp_unslash($_GET['Status'])) : '';
        $authority  = isset($_GET['Authority']) ? sanitize_text_field(wp_unslash($_GET['Authority'])) : '';

        if (!$booking_id || !$authority) {
            $this->render_message(__('درخواست نامعتبر است.', 'university-management'), false);
        }

        $stored_authority = get_post_meta($booking_id, '_um_hall_authority', true);
        $amount = floatval(get_post_meta($booking_id, '_um_hall_total_amount', true));

        if (!$stored_authority || $stored_authority !== $authority) {
            $this->render_message(__('شناسه تراکنش معتبر نیست.', 'university-management'), false);
        }

        if ($status !== 'OK') {
            update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
            wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
            $this->notify($booking_id, false, '');
            $this->render_message(__('پرداخت لغو شد یا ناموفق بود.', 'university-management'), false);
        }

        $verify = $this->zarinpal_verify($authority, $amount);
        if (is_wp_error($verify)) {
            update_post_meta($booking_id, '_um_hall_payment_status', 'failed');
            wp_update_post(array('ID' => $booking_id, 'post_status' => 'draft'));
            $this->notify($booking_id, false, '');
            $this->render_message($verify->get_error_message(), false);
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


