/**
 * جاوااسکریپت برای ویجت تقویم دانشگاه
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        const modal = document.getElementById('eventModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalTime = document.getElementById('modalTime');
        const modalDescription = document.getElementById('modalDescription');

        // کلیک روی رویدادها برای نمایش مودال
        $('.event-cal').click(function() {
            const title = $(this).data('title');
            const time = $(this).data('time');
            const description = $(this).data('description');
            
            modalTitle.textContent = title;
            modalTime.textContent = `زمان: ${time}`;
            modalDescription.textContent = description || "توضیحی موجود نیست.";
            modal.style.display = 'flex';
        });

        // بستن مودال با کلیک روی دکمه بستن
        $('.close-btn').click(function() {
            closeModal();
        });

        // بستن مودال با کلیک روی overlay
        $('.modal-overlay').click(function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // بستن مودال با کلید ESC
        $(document).keydown(function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });

        // تابع بستن مودال
        window.closeModal = function() {
            modal.style.display = 'none';
        };

        // افزودن کلاس هنگام هاور روی رویدادها
        $('.event-cal').hover(function() {
            // هنگام ورود ماوس
            $(this).addClass('hover');
        }, function() {
            // هنگام خروج ماوس
            $(this).removeClass('hover');
        });
    });
})(jQuery); 