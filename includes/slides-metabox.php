<?php
if (!defined('ABSPATH')) {
    exit;
}

// افزودن متابکس برای زیرنویس اسلایدها
function kw_slides_metabox() {
    add_meta_box(
        'university_slide_caption',           // شناسه متابکس
        'زیرنویس اسلاید',                    // عنوان متابکس
        'kw_slides_caption_metabox_callback', // تابع نمایش محتوا
        'university_slide',                   // نوع پست
        'normal',                             // محل نمایش
        'default'                             // اولویت
    );
}
add_action('add_meta_boxes_university_slide', 'kw_slides_metabox');

// محتوای متابکس زیرنویس
function kw_slides_caption_metabox_callback($post) {
    // ایجاد نامه امنیتی
    wp_nonce_field('university_slide_caption_nonce', 'university_slide_caption_nonce');

    // دریافت مقدار فعلی زیرنویس
    $caption = get_post_meta($post->ID, '_university_slide_caption', true);

    // فیلد ورودی زیرنویس
    ?>
    <label for="university_slide_caption">زیرنویس اسلاید:</label>
    <input type="text" id="university_slide_caption" name="university_slide_caption" 
           value="<?php echo esc_attr($caption); ?>" 
           style="width: 100%; margin-top: 10px;" 
           placeholder="توضیح کوتاه برای اسلاید">
    <?php
}

// ذخیره‌سازی متابکس
function kw_save_slides_metabox($post_id) {
    // بررسی نامه امنیتی
    if (!isset($_POST['university_slide_caption_nonce']) || 
        !wp_verify_nonce($_POST['university_slide_caption_nonce'], 'university_slide_caption_nonce')) {
        return;
    }

    // بررسی مجوزهای کاربری
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // ذخیره زیرنویس
    if (isset($_POST['university_slide_caption'])) {
        $caption = sanitize_text_field($_POST['university_slide_caption']);
        update_post_meta($post_id, '_university_slide_caption', $caption);
    }
}
add_action('save_post_university_slide', 'kw_save_slides_metabox'); 