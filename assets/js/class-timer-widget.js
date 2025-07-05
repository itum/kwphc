/**
 * جاوااسکریپت برای ویجت زمان‌بندی کلاس‌ها
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // تابع آپدیت ساعت
        function updateClock() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            
            $('#hours').text(hours);
            $('#minutes').text(minutes);
            $('#seconds').text(seconds);
            
            setTimeout(updateClock, 1000);
        }
        
        // شروع ساعت
        updateClock();
        
        // تنظیم moment.js برای استفاده از تقویم جلالی
        if (typeof moment !== 'undefined' && typeof moment.locale === 'function') {
            moment.locale('fa');
            
            // نمایش تاریخ امروز
            var today = moment();
            $('#currentDate').text(today.format('jYYYY/jMM/jDD'));
            
            // نمایش هفته جاری
            var currentWeekStart = moment().startOf('week');
            showWeek(currentWeekStart);
            
            // کلیک روی دکمه هفته قبل
            $('#prevWeek').click(function() {
                currentWeekStart.subtract(7, 'days');
                showWeek(currentWeekStart);
            });
            
            // کلیک روی دکمه هفته بعد
            $('#nextWeek').click(function() {
                currentWeekStart.add(7, 'days');
                showWeek(currentWeekStart);
            });
        }
        
        // نمایش روزهای هفته
        function showWeek(startDate) {
            var weekDays = $('#weekDays');
            weekDays.empty();
            
            for (var i = 0; i < 7; i++) {
                var day = moment(startDate).add(i, 'days');
                var dayElement = $('<div class="day" data-date="' + day.format('YYYY-MM-DD') + '">' + 
                                  '<span>' + day.format('jD') + '</span>' +
                                  '<span>' + day.format('ddd') + '</span>' +
                                  '</div>');
                
                // روز امروز را هایلایت کنیم
                if (day.isSame(moment(), 'day')) {
                    dayElement.addClass('today');
                    dayElement.addClass('active');
                    showClassesForDate(day.format('YYYY-MM-DD'));
                }
                
                weekDays.append(dayElement);
            }
            
            // اضافه کردن رویداد کلیک به روزها
            $('.day').click(function() {
                $('.day').removeClass('active');
                $(this).addClass('active');
                
                var date = $(this).data('date');
                showClassesForDate(date);
            });
            
            // اگر هیچ روزی انتخاب نشده، روز اول هفته را انتخاب کنیم
            if ($('.day.active').length === 0) {
                $('.day:first').addClass('active');
                showClassesForDate($('.day:first').data('date'));
            }
        }
        
        // نمایش کلاس‌های مربوط به یک تاریخ
        function showClassesForDate(date) {
            var classList = $('#classList');
            
            // اگر کلاس‌ها از قبل وارد شده‌اند (توسط ویجت)
            if (typeof classes !== 'undefined') {
                classList.empty();
                
                var filteredClasses = classes.filter(function(cls) {
                    return moment(cls.date).format('YYYY-MM-DD') === date;
                });
                
                if (filteredClasses.length > 0) {
                    filteredClasses.forEach(function(cls) {
                        var classTime = moment(cls.date).format('HH:mm');
                        var classEndTime = moment(cls.date).add(cls.duration, 'minutes').format('HH:mm');
                        
                        var classCard = $('<div class="class-card">' +
                            '<img src="' + cls.image + '" alt="' + cls.name + '">' +
                            '<div class="class-info">' +
                                '<div class="name-info-wrapper">' +
                                    '<h4>' + cls.name + '</h4>' +
                                    '<div class="info-wrapper">' +
                                        '<p><strong>استاد:</strong> ' + cls.teacher + '</p>' +
                                        '<p><strong>ساعت:</strong> ' + classTime + ' - ' + classEndTime + '</p>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="start-btn">' +
                                    '<button>' +
                                        '<span>شروع کلاس</span>' +
                                        '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                            '<path d="M14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99998 14.6667C4.31808 14.6667 1.33331 11.6819 1.33331 8.00004C1.33331 4.31814 4.31808 1.33337 7.99998 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>' +
                                            '<path d="M10.3333 8.00004L7.33331 6.00004V10.0001L10.3333 8.00004Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>' +
                                        '</svg>' +
                                    '</button>' +
                                '</div>' +
                            '</div>' +
                        '</div>');
                        
                        classList.append(classCard);
                    });
                    
                    // اضافه کردن رویداد کلیک به دکمه شروع کلاس
                    $('.start-btn button').click(function() {
                        // در اینجا می‌توان اکشن‌های مربوط به شروع کلاس را اضافه کرد
                        alert('کلاس در حال شروع شدن است...');
                    });
                } else {
                    // نمایش پیام عدم وجود کلاس
                    classList.html('<div class="no-result"><p>کلاسی در این روز وجود ندارد.</p></div>');
                }
            } else {
                // در صورتی که کلاس‌ها به صورت پویا بارگذاری می‌شوند
                // می‌توان از AJAX برای دریافت آن‌ها استفاده کرد
                classList.html('<div class="university-management-loading"></div>');
                
                // مثال AJAX (غیرفعال)
                /*
                $.ajax({
                    url: um_class_timer_vars.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'get_classes_for_date',
                        date: date,
                        nonce: um_class_timer_vars.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            // نمایش کلاس‌ها
                            classList.empty();
                            
                            if (response.data.length > 0) {
                                // نمایش کلاس‌ها
                            } else {
                                classList.html('<div class="no-result"><p>کلاسی در این روز وجود ندارد.</p></div>');
                            }
                        } else {
                            classList.html('<div class="university-management-error">' + response.data + '</div>');
                        }
                    },
                    error: function() {
                        classList.html('<div class="university-management-error">خطا در دریافت اطلاعات</div>');
                    }
                });
                */
            }
        }
    });
})(jQuery); 