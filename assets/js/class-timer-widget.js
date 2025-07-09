/**
 * جاوااسکریپت برای ویجت زمان‌بندی کلاس‌ها
 */
jQuery(document).ready(function($) {
    // تنظیم moment.js برای استفاده از تقویم جلالی
    moment.locale('fa');
    
    // متغیر برای نگهداری کلاس‌ها
    var classes = window.classesData || []; 
    var allClasses = []; 
    
    // تابع بارگذاری و آماده‌سازی کلاس‌ها
    function initializeClasses() {
        console.log('Window ClassesData:', window.classesData);
        console.log('Local Classes:', classes);
        
        // بررسی دقیق‌تر وضعیت کلاس‌ها
        if (!window.classesData) {
            console.error('window.classesData is undefined');
        }
        
        // اطمینان از وجود کلاس‌ها
        if (!classes || classes.length === 0) {
            console.error('No classes found');
            $('#classList').html('<div class="no-classes">هیچ کلاسی تعریف نشده است</div>');
            return;
        }
        
        // کپی کردن کلاس‌ها برای جلوگیری از تغییرات احتمالی
        allClasses = JSON.parse(JSON.stringify(classes));
        
        // نمایش کلاس‌های روز جاری به صورت پیش‌فرض
        var today = moment().format('YYYY-MM-DD');
        showClassesForDate(today);
    }
    
    // نمایش تاریخ امروز
    var today = moment();
    $('#currentDate').text(today.format('jYYYY/jMM/jDD'));
    
    // آپدیت تایمر هر ثانیه
    function updateTimer() {
        var now = moment();
        $('#hours').text(now.format('HH'));
        $('#minutes').text(now.format('mm'));
        $('#seconds').text(now.format('ss'));
    }
    updateTimer();
    setInterval(updateTimer, 1000);
    
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
        
        // اگر هیچ روزی انتخاب نشده، روز امروز را انتخاب کنیم
        if ($('.day.active').length === 0) {
            $('.day.today').addClass('active');
        }
        
        // نمایش کلاس‌های روز جاری
        var today = moment().format('YYYY-MM-DD');
        showClassesForDate(today);
    }
    
    // نمایش کلاس‌های مربوط به یک تاریخ
    function showClassesForDate(date) {
        var classList = $('#classList');
        classList.empty();
        
        console.log('Filtering classes for date:', date);
        console.log('All Classes:', allClasses);
        
        // فیلتر کلاس‌ها با دقت بیشتر
        var filteredClasses = allClasses.filter(function(cls) {
            // تبدیل تاریخ کلاس به فرمت YYYY-MM-DD با استفاده از moment
            var classDate = moment(cls.date).format('YYYY-MM-DD');
            var targetDate = moment(date).format('YYYY-MM-DD');
            
            console.log('Comparing Class Date:', classDate, 'with Target Date:', targetDate);
            console.log('Class Details:', cls);
            
            // مقایسه دقیق تاریخ
            return classDate === targetDate;
        });
        
        console.log('Filtered Classes:', filteredClasses);
        console.log('Filtered Classes Count:', filteredClasses.length);
        
        // نمایش کلاس‌ها
        if (filteredClasses.length > 0) {
            filteredClasses.forEach(function(cls) {
                console.log('Rendering Class:', cls);
                // محاسبه زمان شروع و پایان کلاس
                var classStartMoment = moment(cls.date);
                var classEndMoment = moment(cls.date).add(cls.duration, 'minutes');
                
                // اطمینان از وجود تصویر
                var classImage = cls.image || 'https://appwordpress.ir/wp-content/plugins/elementor/assets/images/placeholder.png';
                
                var classCard = $('<div class="class-card">' +
                    '<img src="' + classImage + '" alt="' + (cls.name || 'کلاس') + '">' +
                    '<div class="class-info">' +
                        '<div class="name-info-wrapper">' +
                            '<h4>' + (cls.name || 'بدون نام') + '</h4>' +
                            '<div class="info-wrapper">' +
                                '<p><strong>استاد:</strong> ' + (cls.teacher || 'نامشخص') + '</p>' +
                                '<p><strong>ساعت:</strong> ' + 
                                    classStartMoment.format('HH:mm') + 
                                    ' - ' + 
                                    classEndMoment.format('HH:mm') + 
                                '</p>' +
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
        } else {
            console.log('No classes found for date:', date);
            // نمایش پیغام در صورت نبود کلاس
            classList.append('<div class="no-classes">کلاسی در این تاریخ (' + date + ') وجود ندارد.</div>');
        }
        
        // اضافه کردن کلاس برای نمایش
        classList.addClass('show-classes');
        
        // لاگ برای بررسی نمایش
        console.log('classList HTML:', classList.html());
    }
    
    // فراخوانی تابع مقداردهی اولیه
    initializeClasses();
    
    // اضافه کردن استایل برای نمایش کلاس‌ها
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .calendar-container #classList.show-classes {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }
        `)
        .appendTo('head');
}); 