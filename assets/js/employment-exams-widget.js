/**
 * اسکریپت ویجت آزمون‌های استخدامی
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // انیمیشن برای کارت‌ها
        $('.um-exam-card').on('mouseenter', function() {
            $(this).addClass('card-hover');
        }).on('mouseleave', function() {
            $(this).removeClass('card-hover');
        });

        // فیلتر آزمون‌ها بر اساس وضعیت (اگر نیاز باشد)
        $('.um-exam-status-filter').on('change', function() {
            var selectedStatus = $(this).val();
            var $container = $(this).closest('.um-employment-exams-widget');
            
            if (selectedStatus === 'all') {
                $container.find('.um-exam-card, .um-exam-item').show();
            } else {
                $container.find('.um-exam-card, .um-exam-item').hide();
                $container.find('.status-' + selectedStatus).show();
            }
        });

        // انیمیشن fade-in برای عناصر
        $('.um-exam-card, .um-exam-item').each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            });
            
            $(this).delay(index * 100).animate({
                'opacity': '1'
            }, 500).css('transform', 'translateY(0)');
        });

        // tooltip برای وضعیت آزمون‌ها
        $('.exam-status').each(function() {
            var status = $(this).text();
            var tooltipText = '';
            
            switch($(this).attr('class').split(' ')[1]) {
                case 'status-upcoming':
                    tooltipText = 'این آزمون هنوز برگزار نشده است';
                    break;
                case 'status-registration':
                    tooltipText = 'ثبت‌نام برای این آزمون باز است';
                    break;
                case 'status-closed':
                    tooltipText = 'ثبت‌نام برای این آزمون بسته شده است';
                    break;
                case 'status-completed':
                    tooltipText = 'این آزمون برگزار شده است';
                    break;
            }
            
            if (tooltipText) {
                $(this).attr('title', tooltipText);
            }
        });

        // responsive table برای موبایل
        function makeTableResponsive() {
            if ($(window).width() <= 768) {
                $('.um-exams-table').each(function() {
                    if (!$(this).hasClass('responsive-table')) {
                        $(this).addClass('responsive-table');
                        
                        var $table = $(this);
                        var $headers = $table.find('thead th');
                        
                        $table.find('tbody tr').each(function() {
                            var $row = $(this);
                            $row.find('td').each(function(index) {
                                var headerText = $headers.eq(index).text();
                                $(this).attr('data-label', headerText);
                            });
                        });
                    }
                });
            } else {
                $('.um-exams-table').removeClass('responsive-table');
            }
        }

        // اجرای تابع responsive در لود صفحه و تغییر سایز
        makeTableResponsive();
        $(window).on('resize', makeTableResponsive);

        // اضافه کردن استایل responsive table
        if (!$('#responsive-table-style').length) {
            $('<style id="responsive-table-style">')
                .text(`
                    @media (max-width: 768px) {
                        .responsive-table thead {
                            display: none;
                        }
                        
                        .responsive-table tbody,
                        .responsive-table tbody tr,
                        .responsive-table tbody td {
                            display: block;
                            width: 100%;
                        }
                        
                        .responsive-table tbody tr {
                            border: 1px solid #e1e5e9;
                            border-radius: 8px;
                            margin-bottom: 10px;
                            padding: 10px;
                        }
                        
                        .responsive-table tbody td {
                            text-align: right;
                            padding: 5px 0;
                            border: none;
                            position: relative;
                            padding-right: 50%;
                        }
                        
                        .responsive-table tbody td:before {
                            content: attr(data-label) ": ";
                            position: absolute;
                            right: 6px;
                            width: 45%;
                            font-weight: bold;
                            color: #333;
                        }
                    }
                `)
                .appendTo('head');
        }

        // countdown timer برای آزمون‌های در انتظار
        $('.um-exam-card, .um-exam-item').each(function() {
            var $examElement = $(this);
            var examDateStr = $examElement.find('.exam-date').text();
            
            // استخراج تاریخ از متن (فرمت: Y/m/d H:i)
            var dateMatch = examDateStr.match(/(\d{4})\/(\d{2})\/(\d{2})\s+(\d{2}):(\d{2})/);
            
            if (dateMatch && $examElement.hasClass('status-upcoming')) {
                var examDate = new Date(dateMatch[1], dateMatch[2] - 1, dateMatch[3], dateMatch[4], dateMatch[5]);
                var now = new Date();
                
                if (examDate > now) {
                    var timeDiff = examDate - now;
                    var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                    
                    if (days > 0) {
                        var $countdown = $('<div class="exam-countdown">باقی‌مانده: ' + days + ' روز</div>');
                        $countdown.css({
                            'font-size': '12px',
                            'color': '#ff9800',
                            'font-weight': 'bold',
                            'margin-top': '5px'
                        });
                        $examElement.find('.exam-date').after($countdown);
                    }
                }
            }
        });

        // عملکرد مودال تصویر
        window.umOpenImageModal = function(imageSrc, imageAlt) {
            var modal = document.getElementById('um-image-modal');
            var modalImg = document.getElementById('um-modal-image');
            
            if (modal && modalImg) {
                modalImg.src = imageSrc;
                modalImg.alt = imageAlt || 'تصویر آزمون';
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden'; // جلوگیری از اسکرول صفحه
            }
        };

        // بستن مودال با کلیک روی دکمه ضربدر
        $(document).on('click', '.um-modal-close', function() {
            $('#um-image-modal').hide();
            document.body.style.overflow = 'auto';
        });

        // بستن مودال با کلیک روی پس‌زمینه
        $(document).on('click', '.um-modal-overlay', function() {
            $('#um-image-modal').hide();
            document.body.style.overflow = 'auto';
        });

        // بستن مودال با کلید ESC
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#um-image-modal').is(':visible')) {
                $('#um-image-modal').hide();
                document.body.style.overflow = 'auto';
            }
        });

        // جلوگیری از بستن مودال با کلیک روی تصویر
        $(document).on('click', '.um-modal-content img', function(e) {
            e.stopPropagation();
        });

        // عملکرد لمسی برای موبایل
        if ('ontouchstart' in window) {
            // اضافه کردن کلاس لمسی برای استایل‌های بهتر در موبایل
            $('.exam-thumbnail, .exam-thumbnail-small, .exam-thumbnail-list').addClass('touch-device');
            
            // نمایش آیکون زوم در موبایل بدون نیاز به hover
            $('.exam-thumbnail, .exam-thumbnail-small, .exam-thumbnail-list').on('touchstart', function() {
                $(this).find('.zoom-overlay, .zoom-overlay-small, .zoom-overlay-list').css('opacity', '1');
            });
        }
    });

})(jQuery); 