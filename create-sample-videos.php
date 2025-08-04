<?php
/**
 * ایجاد ویدیوهای نمونه برای تست
 * این فایل باید فقط یک بار اجرا شود
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    require_once('../../../wp-config.php');
}

// بررسی امنیت
if (!current_user_can('manage_options')) {
    wp_die('دسترسی غیرمجاز');
}

// تابع ایجاد ویدیوهای نمونه
function create_sample_videos() {
    
    // ایجاد دسته‌بندی‌های نمونه
    $categories = array(
        'آموزشی' => 'آموزشی',
        'سمینار' => 'سمینار',
        'کارگاه' => 'کارگاه',
        'عمومی' => 'عمومی'
    );
    
    foreach ($categories as $slug => $name) {
        $term = term_exists($slug, 'um_video_category');
        if (!$term) {
            wp_insert_term($name, 'um_video_category', array('slug' => $slug));
        }
    }
    
    // ویدیوهای نمونه
    $sample_videos = array(
        array(
            'title' => 'آموزش برنامه‌نویسی پایتون - جلسه اول',
            'content' => 'در این جلسه با مفاهیم اولیه برنامه‌نویسی پایتون آشنا می‌شوید.',
            'category' => 'آموزشی',
            'video_url' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4',
            'thumbnail' => 'https://via.placeholder.com/300x200/0073aa/ffffff?text=پایتون'
        ),
        array(
            'title' => 'سمینار هوش مصنوعی در صنعت آب و برق',
            'content' => 'بررسی کاربردهای هوش مصنوعی در صنعت آب و برق و چالش‌های پیش رو.',
            'category' => 'سمینار',
            'video_url' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_2mb.mp4',
            'thumbnail' => 'https://via.placeholder.com/300x200/28a745/ffffff?text=هوش+مصنوعی'
        ),
        array(
            'title' => 'کارگاه امنیت سایبری',
            'content' => 'آموزش مفاهیم امنیت سایبری و روش‌های محافظت از سیستم‌ها.',
            'category' => 'کارگاه',
            'video_url' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_5mb.mp4',
            'thumbnail' => 'https://via.placeholder.com/300x200/dc3545/ffffff?text=امنیت'
        ),
        array(
            'title' => 'معرفی مرکز آموزش علمی - کاربردی',
            'content' => 'معرفی کامل مرکز آموزش علمی - کاربردی مجتمع عالی آموزشی و پژوهشی صنعت آب و برق خوزستان.',
            'category' => 'عمومی',
            'video_url' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4',
            'thumbnail' => 'https://via.placeholder.com/300x200/ffc107/000000?text=معرفی+مرکز'
        ),
        array(
            'title' => 'آموزش نرم‌افزار MATLAB',
            'content' => 'آموزش جامع نرم‌افزار MATLAB برای مهندسان و دانشجویان.',
            'category' => 'آموزشی',
            'video_url' => 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_2mb.mp4',
            'thumbnail' => 'https://via.placeholder.com/300x200/6f42c1/ffffff?text=MATLAB'
        )
    );
    
    $created_count = 0;
    
    foreach ($sample_videos as $video_data) {
        // بررسی وجود ویدیو
        $existing_posts = get_posts(array(
            'post_type' => 'um_videos',
            'title' => $video_data['title'],
            'post_status' => 'publish',
            'numberposts' => 1
        ));
        
        if (!empty($existing_posts)) {
            continue; // ویدیو قبلاً وجود دارد
        }
        
        // ایجاد پست جدید
        $post_data = array(
            'post_title' => $video_data['title'],
            'post_content' => $video_data['content'],
            'post_status' => 'publish',
            'post_type' => 'um_videos',
            'post_author' => 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id && !is_wp_error($post_id)) {
            // تنظیم دسته‌بندی
            $term = get_term_by('name', $video_data['category'], 'um_video_category');
            if ($term) {
                wp_set_object_terms($post_id, $term->term_id, 'um_video_category');
            }
            
            // تنظیم لینک ویدیو
            update_post_meta($post_id, '_um_video_link', $video_data['video_url']);
            
            // تنظیم تصویر شاخص
            $thumbnail_url = $video_data['thumbnail'];
            $upload_dir = wp_upload_dir();
            $image_data = file_get_contents($thumbnail_url);
            
            if ($image_data) {
                $filename = sanitize_title($video_data['title']) . '.jpg';
                $file_path = $upload_dir['path'] . '/' . $filename;
                
                if (file_put_contents($file_path, $image_data)) {
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($filename),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );
                    
                    $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
                    if (!is_wp_error($attach_id)) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
                        wp_update_attachment_metadata($attach_id, $attach_data);
                        set_post_thumbnail($post_id, $attach_id);
                    }
                }
            }
            
            $created_count++;
        }
    }
    
    return $created_count;
}

// اجرای تابع
$result = create_sample_videos();

echo "تعداد ویدیوهای ایجاد شده: " . $result;
echo "<br><a href='" . admin_url('edit.php?post_type=um_videos') . "'>مشاهده ویدیوها</a>";
?> 