<?php
/**
 * صفحه اصلی مدیریت افزونه مدیریت دانشگاه
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1><?php _e('مدیریت دانشگاه', 'university-management'); ?></h1>
    
    <div class="notice notice-info">
        <p><?php _e('به افزونه مدیریت دانشگاه خوش آمدید. از طریق این پنل می‌توانید تمام جنبه‌های مدیریت دانشگاه را کنترل کنید.', 'university-management'); ?></p>
    </div>
    
    <div class="um-admin-cards" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <!-- کارت تقویم -->
        <div class="um-admin-card" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(33.33% - 20px); min-width: 250px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('تقویم دانشگاه', 'university-management'); ?></h2>
            <p><?php _e('مدیریت رویدادهای تقویم دانشگاه شامل: شروع کلاس‌ها، امتحانات، مهلت‌های ثبت‌نام و غیره.', 'university-management'); ?></p>
            <a href="<?php echo admin_url('admin.php?page=university-calendar'); ?>" class="button button-primary"><?php _e('مدیریت تقویم', 'university-management'); ?></a>
        </div>
        
        <!-- کارت زمان‌بندی کلاس‌ها -->
        <div class="um-admin-card" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(33.33% - 20px); min-width: 250px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('زمان‌بندی کلاس‌ها', 'university-management'); ?></h2>
            <p><?php _e('مدیریت زمان‌بندی کلاس‌ها شامل: ساعت برگزاری، استاد، تاریخ و سایر مشخصات کلاس‌ها.', 'university-management'); ?></p>
            <a href="<?php echo admin_url('admin.php?page=university-class-timing'); ?>" class="button button-primary"><?php _e('مدیریت کلاس‌ها', 'university-management'); ?></a>
        </div>
        
        <!-- کارت مدیریت ویدیوها -->
        <div class="um-admin-card" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(33.33% - 20px); min-width: 250px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('مدیریت ویدیوها', 'university-management'); ?></h2>
            <p><?php _e('مدیریت ویدیوهای آموزشی شامل: آپلود، دسته‌بندی و نمایش ویدیوهای آموزشی.', 'university-management'); ?></p>
            <a href="<?php echo admin_url('admin.php?page=university-videos'); ?>" class="button button-primary"><?php _e('مدیریت ویدیوها', 'university-management'); ?></a>
        </div>
    </div>
    
    <div class="um-admin-help" style="margin-top: 30px;">
        <h2><?php _e('راهنما', 'university-management'); ?></h2>
        <p><?php _e('برای استفاده از ویجت‌های افزونه مدیریت دانشگاه، کافیست در صفحه‌ساز المنتور، از دسته "مدیریت دانشگاه" ویجت مورد نظر خود را انتخاب و به صفحه اضافه کنید.', 'university-management'); ?></p>
        <p><?php _e('سه ویجت اصلی قابل استفاده عبارتند از:', 'university-management'); ?></p>
        <ul style="list-style-type: disc; padding-right: 20px;">
            <li><?php _e('ویجت تقویم دانشگاه: نمایش رویدادهای تقویم به صورت گرافیکی', 'university-management'); ?></li>
            <li><?php _e('ویجت زمان‌بندی کلاس‌ها: نمایش کلاس‌های روزانه یا هفتگی با قابلیت فیلتر کردن', 'university-management'); ?></li>
            <li><?php _e('ویجت مدیریت ویدیوها: نمایش ویدیوهای آموزشی با قابلیت دسته‌بندی و پخش', 'university-management'); ?></li>
        </ul>
    </div>
</div> 