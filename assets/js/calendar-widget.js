/**
 * جاوااسکریپت برای ویجت تقویم دانشگاه
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // در صورت نیاز به افزودن کد جاوااسکریپت تعاملی برای ویجت تقویم
        
        // افزودن کلاس هنگام هاور روی رویدادها
        $('.event-cal').hover(function() {
            // هنگام ورود ماوس
            $(this).addClass('hover');
        }, function() {
            // هنگام خروج ماوس
            $(this).removeClass('hover');
        });
        
        // کلیک روی رویدادها
        $('.event-cal').click(function() {
            // اگر لینکی وجود دارد به آن هدایت شود
            var link = $(this).data('link');
            if (link && link.length > 0) {
                window.location.href = link;
            }
        });
    });
})(jQuery); 