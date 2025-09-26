<?php
if (!defined('ABSPATH')) { exit; }

add_action('wp_ajax_nopriv_um_submit_suggestion', 'um_handle_submit_suggestion');
add_action('wp_ajax_um_submit_suggestion', 'um_handle_submit_suggestion');

function um_handle_submit_suggestion() {
    if (!isset($_POST['um_suggestion_nonce']) || !wp_verify_nonce($_POST['um_suggestion_nonce'], 'um_submit_suggestion_nonce')) {
        wp_send_json_error('invalid_nonce');
    }
    $name = sanitize_text_field($_POST['um_sugg_name'] ?? '');
    $title = sanitize_text_field($_POST['um_sugg_title'] ?? '');
    $phone = sanitize_text_field($_POST['um_sugg_phone'] ?? '');
    $recipient = sanitize_text_field($_POST['um_sugg_recipient'] ?? '');
    $message = wp_kses_post($_POST['um_sugg_message'] ?? '');

    $post_id = wp_insert_post(array(
        'post_type' => 'um_suggestions',
        'post_title' => $title ?: wp_trim_words($message, 6, '...'),
        'post_content' => $message,
        'post_status' => 'publish'
    ));
    if (is_wp_error($post_id) || !$post_id) {
        wp_send_json_error('db_error');
    }

    update_post_meta($post_id, 'um_sugg_name', $name);
    update_post_meta($post_id, 'um_sugg_phone', $phone);
    update_post_meta($post_id, 'um_sugg_recipient', $recipient);

    wp_send_json_success(array('id' => $post_id));
}


/**
 * مدیریت درخواست‌های ادمین: نشانه‌گذاری خوانده/خوانده‌نشده
 */
add_action('admin_post_um_suggestion_mark_read', 'um_admin_mark_read');
function um_admin_mark_read() {
    if (!current_user_can('manage_options')) { wp_die('Forbidden'); }
    if (!isset($_REQUEST['um_sugg_admin_nonce']) || !wp_verify_nonce($_REQUEST['um_sugg_admin_nonce'], 'um_suggestions_action')) {
        wp_die('Invalid nonce');
    }
    $post_id = intval($_REQUEST['post_id'] ?? 0);
    $set = isset($_REQUEST['set']) ? intval($_REQUEST['set']) : 1;
    if ($post_id) {
        update_post_meta($post_id, 'um_sugg_read', $set ? '1' : '0');
    }
    $redirect = wp_get_referer() ?: admin_url('admin.php?page=university-suggestions');
    wp_safe_redirect($redirect);
    exit;
}


/**
 * حذف پیشنهاد
 */
add_action('admin_post_um_suggestion_delete', 'um_admin_delete_suggestion');
function um_admin_delete_suggestion() {
    if (!current_user_can('manage_options')) { wp_die('Forbidden'); }
    if (!isset($_REQUEST['um_sugg_admin_nonce']) || !wp_verify_nonce($_REQUEST['um_sugg_admin_nonce'], 'um_suggestions_action')) {
        wp_die('Invalid nonce');
    }
    $post_id = intval($_REQUEST['post_id'] ?? 0);
    if ($post_id) {
        wp_delete_post($post_id, true);
    }
    $redirect = wp_get_referer() ?: admin_url('admin.php?page=university-suggestions');
    wp_safe_redirect($redirect);
    exit;
}


/**
 * خروجی CSV برای پیشنهادات (با فیلترهای فعلی)
 */
add_action('admin_post_um_suggestions_export_csv', 'um_admin_export_suggestions_csv');
function um_admin_export_suggestions_csv() {
    if (!current_user_can('manage_options')) { wp_die('Forbidden'); }
    if (!isset($_REQUEST['um_sugg_admin_nonce']) || !wp_verify_nonce($_REQUEST['um_sugg_admin_nonce'], 'um_suggestions_action')) {
        wp_die('Invalid nonce');
    }

    $query_args = array('post_type' => 'um_suggestions', 'posts_per_page' => -1);
    if (!empty($_REQUEST['s'])) { $query_args['s'] = sanitize_text_field($_REQUEST['s']); }
    if (!empty($_REQUEST['recipient'])) { $query_args['meta_query'] = array(array('key'=>'um_sugg_recipient','value'=>sanitize_text_field($_REQUEST['recipient']), 'compare'=>'=')); }
    if (!empty($_REQUEST['from']) || !empty($_REQUEST['to'])) {
        $from = !empty($_REQUEST['from']) ? date('Y-m-d 00:00:00', strtotime($_REQUEST['from'])) : null;
        $to = !empty($_REQUEST['to']) ? date('Y-m-d 23:59:59', strtotime($_REQUEST['to'])) : null;
        $dq = array();
        if ($from) $dq['after'] = $from;
        if ($to) $dq['before'] = $to;
        $dq['inclusive'] = true;
        $query_args['date_query'] = $dq;
    }

    $posts = get_posts($query_args);

    $filename = 'suggestions-' . date('Ymd') . '.csv';
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo "\xEF\xBB\xBF"; // BOM
    $out = fopen('php://output', 'w');
    fputcsv($out, array('ID','Title','Recipient','Name','Phone','Date','Message'));
    foreach ($posts as $p) {
        $name = get_post_meta($p->ID, 'um_sugg_name', true);
        $phone = get_post_meta($p->ID, 'um_sugg_phone', true);
        $recipient = get_post_meta($p->ID, 'um_sugg_recipient', true);
        $message = get_post_field('post_content', $p->ID);
        fputcsv($out, array($p->ID, $p->post_title, $recipient, $name, $phone, get_the_date('', $p->ID), $message));
    }
    fclose($out);
    exit;
}

/**
 * AJAX handler for getting sub-member row HTML
 */
add_action('wp_ajax_um_get_sub_member_row', 'um_handle_get_sub_member_row');
function um_handle_get_sub_member_row() {
    // بررسی nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'um_admin_nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // بررسی دسترسی
    if (!current_user_can('edit_posts')) {
        wp_send_json_error('Insufficient permissions');
    }
    
    $index = intval($_POST['index'] ?? 0);
    
    // ایجاد instance از کلاس اصلی برای دسترسی به متد render_sub_member_row
    $university_management = new University_Management();
    
    // استفاده از reflection برای دسترسی به متد private
    $reflection = new ReflectionClass($university_management);
    $method = $reflection->getMethod('render_sub_member_row');
    $method->setAccessible(true);
    
    // گرفتن HTML ردیف
    ob_start();
    $method->invoke($university_management, $index, []);
    $html = ob_get_clean();
    
    wp_send_json_success($html);
}


