<?php
if (!defined('ABSPATH')) {
    exit;
}

// تابع مهاجرت اسلایدهای المنتور به پست تایپ جدید
function kw_migrate_elementor_slides() {
    // بررسی اینکه آیا المنتور نصب است
    if (!defined('ELEMENTOR_VERSION')) {
        return;
    }

    // دریافت تنظیمات المنتور
    $elementor_settings = get_option('elementor_general_settings', []);
    
    // بررسی وجود اسلایدها
    if (!isset($elementor_settings['slides']) || empty($elementor_settings['slides'])) {
        return;
    }

    // حلقه برای مهاجرت هر اسلاید
    foreach ($elementor_settings['slides'] as $slide) {
        // ایجاد پست جدید برای اسلاید
        $slide_post = [
            'post_type'     => 'university_slide',
            'post_title'    => $slide['title'] ?? 'اسلاید بدون عنوان',
            'post_status'   => 'publish'
        ];

        // ایجاد پست
        $post_id = wp_insert_post($slide_post);

        // افزودن تصویر شاخص
        if (!empty($slide['image']['url'])) {
            // دانلود و افزودن تصویر
            $image_id = kw_upload_image_from_url($slide['image']['url']);
            if ($image_id) {
                set_post_thumbnail($post_id, $image_id);
            }
        }

        // افزودن زیرنویس
        if (!empty($slide['subtitle'])) {
            update_post_meta($post_id, '_university_slide_caption', $slide['subtitle']);
        }
    }
}

// تابع کمکی برای آپلود تصویر از URL
function kw_upload_image_from_url($image_url) {
    // بارگذاری فایل‌های وردپرس
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // آپلود تصویر
    $upload = media_sideload_image($image_url, 0);

    // بررسی خطا
    if (is_wp_error($upload)) {
        return false;
    }

    // دریافت شناسه تصویر
    $image_id = attachment_url_to_postid($upload);
    return $image_id;
}

// هوک برای اجرای مهاجرت
function kw_trigger_slides_migration() {
    // فقط برای مدیران
    if (!current_user_can('manage_options')) {
        return;
    }

    // بررسی اینکه آیا مهاجرت قبلاً انجام شده
    $migration_done = get_option('kw_slides_migration_done', false);
    if ($migration_done) {
        return;
    }

    // اجرای مهاجرت
    kw_migrate_elementor_slides();

    // علامت‌گذاری مهاجرت به عنوان تکمیل شده
    update_option('kw_slides_migration_done', true);
}
add_action('admin_init', 'kw_trigger_slides_migration'); 