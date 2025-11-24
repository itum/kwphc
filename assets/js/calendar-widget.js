/**
 * جاوااسکریپت برای ویجت تقویم دانشگاه
 * بهبود یافته برای موبایل و تجربه کاربری بهتر
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        const modal = document.getElementById('eventModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalTime = document.getElementById('modalTime');
        const modalDescription = document.getElementById('modalDescription');

        // بررسی وجود مودال
        if (!modal) {
            return;
        }

        // تشخیص دستگاه لمسی
        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        
        // جلوگیری از double-tap zoom در موبایل
        let lastTap = 0;
        const preventDoubleTap = function(e) {
            const currentTime = new Date().getTime();
            const tapLength = currentTime - lastTap;
            if (tapLength < 300 && tapLength > 0) {
                e.preventDefault();
                return false;
            }
            lastTap = currentTime;
        };

        // تابع نمایش مودال
        const showModal = function(title, time, description) {
            if (modalTitle) modalTitle.textContent = title || '';
            if (modalTime) modalTime.textContent = `زمان: ${time || ''}`;
            if (modalDescription) modalDescription.textContent = description || "توضیحی موجود نیست.";
            modal.style.display = 'flex';
            
            // جلوگیری از scroll صفحه پس زمینه در موبایل
            if (isTouchDevice) {
                document.body.style.overflow = 'hidden';
            }
        };

        // تابع بستن مودال
        const closeModal = function() {
            modal.style.display = 'none';
            
            // بازگرداندن scroll صفحه
            if (isTouchDevice) {
                document.body.style.overflow = '';
            }
        };

        // ذخیره تابع closeModal به صورت global
        window.closeModal = closeModal;

        // تابع نمایش مودال از یک رویداد
        const handleEventClick = function($element) {
            // جلوگیری از اجرای چندباره
            if ($element.hasClass('processing')) {
                return false;
            }
            $element.addClass('processing');

            const title = $element.data('title');
            const time = $element.data('time');
            const description = $element.data('description');
            
            // استفاده از setTimeout برای جلوگیری از double-tap
            setTimeout(function() {
                showModal(title, time, description);
                $element.removeClass('processing');
            }, isTouchDevice ? 100 : 0);
        };

        // مدیریت کلیک/لمس روی رویدادها
        $('.event-cal').on('click touchstart', function(e) {
            // جلوگیری از double-tap zoom
            if (isTouchDevice && e.type === 'touchstart') {
                preventDoubleTap(e);
            }

            handleEventClick($(this));

            // جلوگیری از propagation در touch
            if (e.type === 'touchstart') {
                e.preventDefault();
            }
        });

        // پشتیبانی از Enter key برای accessibility
        $('.event-cal').on('keydown', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                handleEventClick($(this));
            }
        });

        // بستن مودال با کلیک روی دکمه بستن
        $('.close-btn').on('click touchstart', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeModal();
        });

        // بستن مودال با کلیک روی overlay
        $('.modal-overlay').on('click touchstart', function(e) {
            if (e.target === this || $(e.target).hasClass('modal-overlay')) {
                closeModal();
            }
        });

        // بستن مودال با کلید ESC
        $(document).on('keydown', function(e) {
            if ((e.key === 'Escape' || e.keyCode === 27) && modal.style.display === 'flex') {
                closeModal();
            }
        });

        // بهبود hover برای دستگاه‌های غیر لمسی
        if (!isTouchDevice) {
            $('.event-cal').hover(
                function() {
                    $(this).addClass('hover');
                },
                function() {
                    $(this).removeClass('hover');
                }
            );
        }

        // جلوگیری از scroll در مودال (برای موبایل)
        if (isTouchDevice) {
            $('.modal-content').on('touchmove', function(e) {
                e.stopPropagation();
            });

            // مدیریت swipe برای بستن مودال (اختیاری)
            let touchStartY = 0;
            let touchEndY = 0;

            $('.modal-content').on('touchstart', function(e) {
                touchStartY = e.originalEvent.touches[0].clientY;
            });

            $('.modal-content').on('touchmove', function(e) {
                touchEndY = e.originalEvent.touches[0].clientY;
            });

            $('.modal-content').on('touchend', function(e) {
                const swipeDistance = touchEndY - touchStartY;
                // اگر swipe به پایین بیشتر از 100px باشد، مودال را ببند
                if (swipeDistance > 100 && modal.style.display === 'flex') {
                    closeModal();
                }
                touchStartY = 0;
                touchEndY = 0;
            });
        }

        // Cleanup هنگام unload
        $(window).on('beforeunload', function() {
            $('.event-cal').off('click touchstart');
            $('.close-btn').off('click touchstart');
            $('.modal-overlay').off('click touchstart');
            $(document).off('keydown');
        });
    });
})(jQuery); 