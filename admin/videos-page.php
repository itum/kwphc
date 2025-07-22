<?php
/**
 * صفحه مدیریت ویدیوها
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

// عنوان صفحه
$page_title = __('مدیریت ویدیوها', 'university-management');

?>

<div class="wrap">
    <h1><?php echo esc_html($page_title); ?></h1>
    
    <div class="um-admin-content">
        <div class="um-admin-section">
            <h2><?php _e('راهنمای استفاده از بخش ویدیوها', 'university-management'); ?></h2>
            
            <div class="um-admin-card">
                <h3><?php _e('افزودن ویدیو جدید', 'university-management'); ?></h3>
                <p><?php _e('برای افزودن ویدیو جدید، به بخش "ویدیوها" در منوی کناری رفته و روی "افزودن ویدیو جدید" کلیک کنید.', 'university-management'); ?></p>
                <p><?php _e('در صفحه افزودن ویدیو، عنوان ویدیو را وارد کنید، توضیحات مربوط به ویدیو را در بخش محتوا وارد کنید، و لینک ویدیو را در فیلد مربوطه قرار دهید.', 'university-management'); ?></p>
                <p><?php _e('همچنین می‌توانید یک تصویر شاخص برای ویدیو انتخاب کنید که به عنوان پیش‌نمایش ویدیو نمایش داده می‌شود.', 'university-management'); ?></p>
                
                <a href="<?php echo admin_url('post-new.php?post_type=um_videos'); ?>" class="button button-primary"><?php _e('افزودن ویدیو جدید', 'university-management'); ?></a>
            </div>
            
            <div class="um-admin-card">
                <h3><?php _e('مدیریت ویدیوها', 'university-management'); ?></h3>
                <p><?php _e('برای مشاهده لیست تمام ویدیوها، ویرایش یا حذف آنها، به بخش "ویدیوها" در منوی کناری مراجعه کنید.', 'university-management'); ?></p>
                <p><?php _e('شما می‌توانید ویدیوها را بر اساس دسته‌بندی فیلتر کنید یا با استفاده از جستجو، ویدیوی مورد نظر خود را پیدا کنید.', 'university-management'); ?></p>
                
                <a href="<?php echo admin_url('edit.php?post_type=um_videos'); ?>" class="button button-primary"><?php _e('مدیریت ویدیوها', 'university-management'); ?></a>
            </div>
            
            <div class="um-admin-card">
                <h3><?php _e('دسته‌بندی ویدیوها', 'university-management'); ?></h3>
                <p><?php _e('برای مدیریت دسته‌بندی‌های ویدیوها، به بخش "دسته‌بندی" در زیرمجموعه "ویدیوها" در منوی کناری مراجعه کنید.', 'university-management'); ?></p>
                <p><?php _e('شما می‌توانید دسته‌بندی‌های جدید ایجاد کنید، دسته‌بندی‌های موجود را ویرایش یا حذف کنید.', 'university-management'); ?></p>
                
                <a href="<?php echo admin_url('edit-tags.php?taxonomy=um_video_category&post_type=um_videos'); ?>" class="button button-primary"><?php _e('مدیریت دسته‌بندی‌ها', 'university-management'); ?></a>
            </div>
            
            <div class="um-admin-card">
                <h3><?php _e('زمینه‌های دلخواه ویدیوها', 'university-management'); ?></h3>
                <p><?php _e('برای هر ویدیو، زمینه‌های دلخواه شامل عنوان، لینک، دسته‌بندی و توضیحات به‌طور خودکار ایجاد می‌شوند.', 'university-management'); ?></p>
                <p><?php _e('اگر برای ویدیوهای قدیمی این زمینه‌ها ایجاد نشده‌اند، می‌توانید با کلیک روی دکمه زیر همه آنها را به‌روزرسانی کنید.', 'university-management'); ?></p>
                
                <button id="update-all-video-fields" class="button button-primary"><?php _e('به‌روزرسانی زمینه‌های دلخواه همه ویدیوها', 'university-management'); ?></button>
                <span id="update-status" style="margin-right: 10px;"></span>
            </div>
        </div>
    </div>
</div>

<style>
.um-admin-content {
    margin-top: 20px;
}
.um-admin-section {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.um-admin-card {
    margin-bottom: 25px;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 3px;
    border-left: 4px solid #0073aa;
}
.um-admin-card h3 {
    margin-top: 0;
    color: #0073aa;
}
</style>

<script>
jQuery(document).ready(function($) {
    $('#update-all-video-fields').on('click', function() {
        var button = $(this);
        var status = $('#update-status');
        
        button.prop('disabled', true).text('در حال به‌روزرسانی...');
        status.html('<span style="color: #0073aa;">لطفاً صبر کنید...</span>');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_update_all_video_custom_fields',
                nonce: '<?php echo wp_create_nonce('um_update_video_fields_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    status.html('<span style="color: #46b450;">' + response.data.message + '</span>');
                } else {
                    status.html('<span style="color: #dc3232;">خطا: ' + response.data + '</span>');
                }
                button.prop('disabled', false).text('به‌روزرسانی زمینه‌های دلخواه همه ویدیوها');
            },
            error: function() {
                status.html('<span style="color: #dc3232;">خطا در اتصال به سرور</span>');
                button.prop('disabled', false).text('به‌روزرسانی زمینه‌های دلخواه همه ویدیوها');
            }
        });
    });
});
</script> 