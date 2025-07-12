/**
 * جاوا اسکریپت مدیریت عمومی افزونه مدیریت دانشگاه
 */

(function($) {
    'use strict';

    // آماده شدن DOM
    $(document).ready(function() {
        // اضافه کردن کلاس برای استایل‌دهی
        $('.wrap').addClass('university-management-admin');
        
        // بهبود نمایش پیام‌های مدیریت
        $('.notice').each(function() {
            var $notice = $(this);
            if ($notice.hasClass('notice-success')) {
                $notice.addClass('notice-success');
            } else if ($notice.hasClass('notice-warning')) {
                $notice.addClass('notice-warning');
            } else if ($notice.hasClass('notice-error')) {
                $notice.addClass('notice-error');
            }
        });
        
        // مدیریت اسپینرها
        $('.spinner').each(function() {
            var $spinner = $(this);
            if ($spinner.hasClass('is-active')) {
                $spinner.show();
            } else {
                $spinner.hide();
            }
        });
        
        console.log('University Management Admin JS loaded');
    });

})(jQuery); 