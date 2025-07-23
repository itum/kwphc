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
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => false, // موقتاً مخفی می‌کنیم تا از منوی اصلی اضافه شود
        'query_var'          => true,
        'rewrite'            => array('slug' => 'university-slide'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'thumbnail', 'editor')
    );

    register_post_type('university_slide', $args);
}
add_action('init', 'kw_register_slides_post_type');

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