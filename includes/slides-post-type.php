<?php
// بستن مستقیم PHP برای جلوگیری از خروجی ناخواسته
if (!defined('ABSPATH')) {
    exit;
}

// ثبت پست تایپ اسلایدها
function kw_register_slides_post_type() {
    $labels = array(
        'name'               => 'اسلایدها',
        'singular_name'      => 'اسلاید',
        'menu_name'          => 'اسلایدها',
        'name_admin_bar'     => 'اسلاید',
        'add_new'            => 'افزودن جدید',
        'add_new_item'       => 'افزودن اسلاید جدید',
        'new_item'           => 'اسلاید جدید',
        'edit_item'          => 'ویرایش اسلاید',
        'view_item'          => 'مشاهده اسلاید',
        'all_items'          => 'همه اسلایدها',
        'search_items'       => 'جستجوی اسلایدها',
        'not_found'          => 'اسلایدی یافت نشد',
        'not_found_in_trash' => 'اسلایدی در زباله‌دان یافت نشد'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,  // تغییر به true
        'publicly_queryable' => true,  // تغییر به true
        'show_ui'            => true,
        'show_in_menu'       => 'university-management',
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'university-slides',
            'with_front' => false  // جلوگیری از اضافه شدن پیشوند پیش‌فرض
        ),
        'capability_type'    => 'post',
        'has_archive'        => true,  // تغییر به true
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'thumbnail', 'editor')
    );

    register_post_type('university_slide', $args);
}
add_action('init', 'kw_register_slides_post_type', 0);  // اضافه کردن اولویت 0

// افزودن ستون‌های سفارشی به صفحه لیست اسلایدها
function kw_slides_columns($columns) {
    $new_columns = array(
        'cb'            => $columns['cb'],
        'title'         => $columns['title'],
        'thumbnail'     => 'تصویر',
        'caption'       => 'زیرنویس',
        'date'          => $columns['date']
    );
    return $new_columns;
}
add_filter('manage_university_slide_posts_columns', 'kw_slides_columns');

// پر کردن ستون‌های سفارشی
function kw_slides_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(100, 100));
            } else {
                echo 'بدون تصویر';
            }
            break;
        case 'caption':
            $caption = get_post_meta($post_id, '_university_slide_caption', true);
            echo $caption ? esc_html($caption) : 'بدون زیرنویس';
            break;
    }
}
add_action('manage_university_slide_posts_custom_column', 'kw_slides_column_content', 10, 2);

// تابع برای flush rewrite rules
function kw_flush_rewrite_rules_for_slides() {
    kw_register_slides_post_type();
    flush_rewrite_rules();
}
register_activation_hook(UM_PLUGIN_DIR . 'university-management.php', 'kw_flush_rewrite_rules_for_slides'); 