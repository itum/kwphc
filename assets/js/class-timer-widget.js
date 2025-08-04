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

function initializeClassTimer(classData) {
    moment.loadPersian({ usePersianDigits: false });

    const weekDays = ["شنبه", "یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنجشنبه", "جمعه"];
    const weekDaysEl = document.getElementById('weekDays');
    const goToTodayText = document.getElementById('goToToday');
    const liveInfo = document.getElementById("liveClassInfo");

    const today = moment();
    let current = moment();
    let selectedDate = moment(today);

    function wrapDigit(num) {
        return [...num].map(d => `<span class="digit-box">${d}</span>`).join('');
    }

    function renderClassesFor(dateMoment) {
        const container = document.getElementById("classList");
        container.innerHTML = "";

        const isoDate = dateMoment.format("YYYY-MM-DD");
        const classes = classData[isoDate] || [];
        let liveCount = 0;

        if (classes.length === 0) {
            container.innerHTML = `<div class="no-result"><p>متاسفانه نتیجه ای یافت نشد</p></div>`;
            liveInfo.textContent = "دوره در حال برگزاری: 0 / 0";
            return;
        }

        const now = moment();

        classes.forEach(cls => {
            const card = document.createElement("div");
            card.className = "class-card";

            let contentHTML = "";
            let timerId = "";

            const [start, end] = cls.time.split(" - ");
            const startTime = moment(start, "HH:mm");
            const endTime = moment(end, "HH:mm");

            startTime.set({ year: dateMoment.year(), month: dateMoment.month(), date: dateMoment.date() });
            endTime.set({ year: dateMoment.year(), month: dateMoment.month(), date: dateMoment.date() });

            const isToday = dateMoment.isSame(today, 'day');
            const nowTime = moment();

            if (isToday && nowTime.isBefore(startTime)) {
                timerId = "timer-" + Math.random().toString(36).substr(2, 9);
                contentHTML = `<p id="${timerId}" style="color: black; font-size: 12px;">در حال بارگذاری تایمر...</p>`;
            } else if (isToday && nowTime.isBetween(startTime, endTime)) {
                liveCount++;
                contentHTML = getButtonHTML(cls.link);
            } else {
                contentHTML = getButtonHTML(cls.link);
            }

            card.innerHTML = `
                <img src="${cls.image}" alt="${cls.name}">
                <div class="class-info">
                    <div class="name-info-wrapper">
                        <h4>${cls.name}</h4>
                        <div class="info-wrapper">
                            <p>مدرس دوره: ${cls.teacher}</p>
                            <p>زمان برگزاری: ${cls.time}</p>
                        </div>
                    </div>
                    ${contentHTML}
                </div>
            `;

            container.appendChild(card);

            if (timerId) {
                const el = () => document.getElementById(timerId);
                const intervalFunction = () => {
                    const nowTime = moment();
                    const diff = startTime.diff(nowTime);
                    const element = el();
                    if (!element) return;
                    if (diff > 0) {
                        const duration = moment.duration(diff);
                        const hours = String(duration.hours()).padStart(2, '0');
                        const minutes = String(duration.minutes()).padStart(2, '0');
                        const seconds = String(duration.seconds()).padStart(2, '0');

                        element.innerHTML = `
                            <div class='timer-wrapper'>
                                ${wrapDigit(hours)} : ${wrapDigit(minutes)} : ${wrapDigit(seconds)}<br> 
                            </div>
                            <div>تا شروع کلاس</div>
                        `;
                    } else {
                        clearInterval(intervalId);
                        element.outerHTML = getButtonHTML(cls.link);
                    }
                };
                intervalFunction();
                const intervalId = setInterval(intervalFunction, 1000);
            }
        });

        liveInfo.textContent = `دوره‌های در حال برگزاری: ${liveCount} / ${classes.length}`;
    }

    function getButtonHTML(link) {
        return `
            <a href="${link}" class="start-btn">
                <button>
                    شروع یادگیری
                    <svg width="38" height="22" viewBox="0 0 38 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.25 0.75H10.25C4.58908 0.75 0 5.33908 0 11C0 16.6609 4.58908 21.25 10.25 21.25H27.25C32.9109 21.25 37.5 16.6609 37.5 11C37.5 5.33908 32.9109 0.75 27.25 0.75Z" fill="white"/>
                        <path d="M25 10.75H13.5M13.5 10.75L18 6.25M13.5 10.75L18 15.75" stroke="black" stroke-linecap="round"/>
                    </svg>
                </button>
            </a>
        `;
    }

    function renderWeek(centerDate) {
        weekDaysEl.innerHTML = "";
        const startOfWeek = moment(centerDate).startOf('week').add(1, 'days');
        for (let i = 0; i < 7; i++) {
            const m = moment(startOfWeek).add(i, 'days');
            const isToday = m.isSame(today, 'day');
            const isSelected = m.isSame(selectedDate, 'day');

            const dayDiv = document.createElement('div');
            dayDiv.className = 'day' + (isToday ? ' today' : '') + (isSelected ? ' active' : '');
            const weekDay = weekDays[i];
            const jDateStr = `${weekDay} <br>${m.jDate()} ${m.format('jMMMM')} `;
            dayDiv.innerHTML = jDateStr;

            dayDiv.addEventListener('click', () => {
                selectedDate = m;
                document.querySelectorAll('.day').forEach(el => el.classList.remove('active'));
                dayDiv.classList.add('active');
                renderClassesFor(m);
            });

            weekDaysEl.appendChild(dayDiv);
        }
    }

    document.getElementById('prevWeek').addEventListener('click', () => {
        current = current.subtract(7, 'days');
        renderWeek(current);
    });

    document.getElementById('nextWeek').addEventListener('click', () => {
        current = current.add(7, 'days');
        renderWeek(current);
    });

    goToTodayText.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 5.75C7.59 5.75 7.25 5.41 7.25 5V2C7.25 1.59 7.59 1.25 8 1.25C8.41 1.25 8.75 1.59 8.75 2V5C8.75 5.41 8.41 5.75 8 5.75Z" fill="#222222"/>
            <path d="M16 5.75C15.59 5.75 15.25 5.41 15.25 5V2C15.25 1.59 15.59 1.25 16 1.25C16.41 1.25 16.75 1.59 16.75 2V5C16.75 5.41 16.41 5.75 16 5.75Z" fill="#222222"/>
            <path d="M15 22.75H9C3.38 22.75 2.25 20.1 2.25 15.82V9.65C2.25 4.91 3.85 2.98 7.96 2.75H16C16.01 2.75 16.03 2.75 16.04 2.75C20.15 2.98 21.75 4.91 21.75 9.65V15.82C21.75 20.1 20.62 22.75 15 22.75ZM8 4.25C5.2 4.41 3.75 5.29 3.75 9.65V15.82C3.75 19.65 4.48 21.25 9 21.25H15C19.52 21.25 20.25 19.65 20.25 15.82V9.65C20.25 5.3 18.81 4.41 15.98 4.25H8Z" fill="#222222"/>
            <path d="M20.75 18.3501H3.25C2.84 18.3501 2.5 18.0101 2.5 17.6001C2.5 17.1901 2.84 16.8501 3.25 16.8501H20.75C21.16 16.8501 21.5 17.1901 21.5 17.6001C21.5 18.0101 21.16 18.3501 20.75 18.3501Z" fill="#222222"/>
            <path d="M12 8.25C10.77 8.25 9.73 8.92 9.73 10.22C9.73 10.84 10.02 11.31 10.46 11.61C9.85 11.97 9.5 12.55 9.5 13.23C9.5 14.47 10.45 15.24 12 15.24C13.54 15.24 14.5 14.47 14.5 13.23C14.5 12.55 14.15 11.96 13.53 11.61C13.98 11.3 14.26 10.84 14.26 10.22C14.26 8.92 13.23 8.25 12 8.25ZM12 11.09C11.48 11.09 11.1 10.78 11.1 10.29C11.1 9.79 11.48 9.5 12 9.5C12.52 9.5 12.9 9.79 12.9 10.29C12.9 10.78 12.52 11.09 12 11.09ZM12 14C11.34 14 10.86 13.67 10.86 13.07C10.86 12.47 11.34 12.15 12 12.15C12.66 12.15 13.14 12.48 13.14 13.07C13.14 13.67 12.66 14 12 14Z" fill="#222222"/>
        </svg>
        امروز ${today.jDate()} ${today.format("jMMMM")} ${today.jYear()}
    `;

    goToTodayText.addEventListener('click', () => {
        current = moment();
        selectedDate = moment(today);
        renderWeek(current);
        renderClassesFor(today);
    });

    renderWeek(current);
    renderClassesFor(today);
}

// اجرای تابع با داده‌های کلاس
document.addEventListener('DOMContentLoaded', function() {
    const classData = {
        "2025-04-28": [
            { 
                name: "ریاضی پایه", 
                teacher: "خانم احمدی", 
                time: "10:00 - 11:00", 
                image: kwprcClassTimerData.pluginUrl + "assets/images/Rectangle 5468.png", 
                link: "#" 
            },
            // سایر کلاس‌ها
        ],
        // سایر تاریخ‌ها
    };

    initializeClassTimer(classData);
}); 