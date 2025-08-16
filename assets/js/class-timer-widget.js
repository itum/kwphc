/**
 * جاوااسکریپت برای ویجت زمان‌بندی کلاس‌ها
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // بررسی وجود کتابخانه moment
        if (typeof moment === 'undefined') {
            console.error('Moment.js library is not loaded');
            return;
        }

        // بارگذاری تقویم فارسی و تنظیم شروع هفته از شنبه
        if (typeof moment.loadPersian === 'function') {
            moment.loadPersian({ usePersianDigits: false });
        }
        if (typeof moment.updateLocale === 'function') {
            moment.updateLocale('fa', { week: { dow: 6, doy: 12 } }); // شنبه = 0
            moment.locale('fa');
        }

        // نگاشت نام روزها بر اساس اندیس day() در moment (0=یکشنبه ... 6=شنبه)
        const weekDaysByMomentIndex = [
            "یکشنبه",
            "دوشنبه",
            "سه‌شنبه",
            "چهارشنبه",
            "پنجشنبه",
            "جمعه",
            "شنبه"
        ];
        const weekDaysEl = document.getElementById('weekDays');
        const goToTodayText = document.getElementById('goToToday');
        const liveInfo = document.getElementById("liveClassInfo");

        if (!weekDaysEl || !goToTodayText || !liveInfo) {
            console.error('Required elements not found');
            return;
        }

        const today = moment().startOf('day');
        let current = moment(today);
        let selectedDate = moment(today);
        
        // اطمینان از اینکه امروز همیشه انتخاب شده باشد
        function ensureTodayIsSelected() {
            selectedDate = moment(today);
            current = moment(today);
            console.log('Today is:', today.format('dddd YYYY-MM-DD'), 'Persian:', today.jDate(), today.format('jMMMM'));
        }

        // دریافت داده‌های کلاس از PHP
        const classData = window.classesData || {};

        function wrapDigit(num) {
            return [...num].map(d => `<span class="digit-box">${d}</span>`).join('');
        }

        function renderClassesFor(dateMoment) {
            const container = document.getElementById("classList");
            if (!container) return;
            
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
                let stateId = "state-" + Math.random().toString(36).substr(2, 9);
                let timerId = "";

                const [start, end] = cls.time.split(" - ");
                const startTime = moment(start, "HH:mm");
                const endTime = moment(end, "HH:mm");

                startTime.set({ year: dateMoment.year(), month: dateMoment.month(), date: dateMoment.date() });
                endTime.set({ year: dateMoment.year(), month: dateMoment.month(), date: dateMoment.date() });

                const isToday = dateMoment.isSame(today, 'day');
                const nowTime = moment();

                // وضعیت صریح از بک‌اند (canceled, postponed, finished, scheduled)
                const explicitStatus = cls.status || 'scheduled';

                if (explicitStatus === 'canceled') {
                    contentHTML = getStatusPill('لغو شد', 'canceled');
                } else if (explicitStatus === 'postponed') {
                    contentHTML = getStatusPill('به زمان دیگری موکول شد', 'postponed');
                } else if (explicitStatus === 'finished') {
                    contentHTML = getStatusPill('برگزار شد', 'finished');
                } else if (isToday && nowTime.isBefore(startTime)) {
                    timerId = "timer-" + Math.random().toString(36).substr(2, 9);
                    contentHTML = `<p id="${timerId}" style="color: black; font-size: 12px;">در حال بارگذاری تایمر...</p>`;
                } else if (isToday && nowTime.isBetween(startTime, endTime)) {
                    liveCount++;
                    contentHTML = getButtonHTML(cls.link);
                } else {
                    // بعد از پایان زمان کلاس در روز انتخاب‌شده یا روزهای گذشته
                    if (nowTime.isAfter(endTime) || dateMoment.isBefore(today, 'day')) {
                        contentHTML = getStatusPill('برگزار شد', 'finished');
                    } else {
                        contentHTML = getButtonHTML(cls.link);
                    }
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
                        <div id="${stateId}" class="state-box">${contentHTML}</div>
                    </div>
                `;

                container.appendChild(card);

                // زمان‌بندی تغییر وضعیت‌ها برای امروز - فقط اگر وضعیت دستی نباشد
                const scheduleFinishSwap = () => {
                    if (!isToday || explicitStatus !== 'scheduled') return false;
                    const nowTime2 = moment();
                    if (nowTime2.isAfter(endTime)) {
                        const box = document.getElementById(stateId);
                        // اگر وضعیت سرور برای این پست هنوز "scheduled" است، تبدیل کن؛ در غیر اینصورت به تصمیم دستی احترام بگذار
                        if (box) box.innerHTML = getStatusPill('برگزار شد', 'finished');
                        return true;
                    }
                    return false;
                };

                if (timerId) {
                    const el = () => document.getElementById(timerId);
                    const intervalFunction = () => {
                        const nowTime = moment();
                        const diff = startTime.diff(nowTime);
                        if (!el()) return;
                        if (diff > 0) {
                            const duration = moment.duration(diff);
                            const hours = String(duration.hours()).padStart(2, '0');
                            const minutes = String(duration.minutes()).padStart(2, '0');
                            const seconds = String(duration.seconds()).padStart(2, '0');

                            el().innerHTML = `
                                <div class='timer-wrapper'>
                                    ${wrapDigit(hours)} : ${wrapDigit(minutes)} : ${wrapDigit(seconds)}<br>
                                </div>
                                <div>تا شروع کلاس</div>`;
                        } else {
                            clearInterval(intervalId);
                            // کلاس شروع شد → دکمه نمایش داده شود
                            el().outerHTML = getButtonHTML(cls.link);
                            // و انتظار تا پایان کلاس برای نمایش «برگزار شد» - فقط اگر وضعیت دستی نباشد
                            if (explicitStatus === 'scheduled') {
                                const endWatcher = setInterval(() => {
                                    if (scheduleFinishSwap()) clearInterval(endWatcher);
                                }, 1000);
                            }
                        }
                    };
                    intervalFunction();
                    const intervalId = setInterval(intervalFunction, 1000);
                } else if (isToday && nowTime.isBetween(startTime, endTime) && explicitStatus === 'scheduled') {
                    const endWatcher = setInterval(() => {
                        if (scheduleFinishSwap()) clearInterval(endWatcher);
                    }, 1000);
                } else if (isToday && explicitStatus === 'scheduled') {
                    // امروز و قبل از پایان نیست → اگر لازم شد بعدا به «برگزار شد» تبدیل شود
                    scheduleFinishSwap();
                }
            });

            // نمایش تدریجی آیتم‌ها: ابتدا ۳ مورد، سپس «نمایش کلاس‌های بیشتر» با انیمیشن
            (function addLoadMoreUI() {
                const MAX_INITIAL = 3;
                const CHUNK = 3;
                const cards = container.querySelectorAll('.class-card');
                if (cards.length <= MAX_INITIAL) return;

                for (let i = MAX_INITIAL; i < cards.length; i++) {
                    cards[i].classList.add('is-hidden');
                }

                const loadMoreContainer = document.createElement('div');
                loadMoreContainer.className = 'load-more-container';
                const btn = document.createElement('button');
                btn.className = 'load-more-btn';
                const setBtnText = (remain) => { btn.innerHTML = `نمایش کلاس‌های بیشتر (${remain})`; };
                let shown = MAX_INITIAL;
                setBtnText(cards.length - shown);
                loadMoreContainer.appendChild(btn);
                container.appendChild(loadMoreContainer);

                btn.addEventListener('click', () => {
                    if (shown >= cards.length) return;
                    btn.classList.add('loading');
                    btn.innerHTML = `<span class="spinner"></span><span>در حال بارگذاری...</span>`;
                    setTimeout(() => {
                        const next = Math.min(shown + CHUNK, cards.length);
                        for (let i = shown; i < next; i++) {
                            cards[i].classList.remove('is-hidden');
                            cards[i].classList.add('fade-in-up');
                        }
                        shown = next;
                        if (shown < cards.length) {
                            btn.classList.remove('loading');
                            setBtnText(cards.length - shown);
                        } else {
                            loadMoreContainer.remove();
                        }
                    }, 450);
                });
            })();

            liveInfo.textContent = `دوره‌های در حال برگزاری: ${liveCount} / ${classes.length}`;
        }

        function getButtonHTML(link) {
            return `<a href="${link}" class="start-btn"><button>
                شروع یادگیری
                <svg width="38" height="22" viewBox="0 0 38 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M27.25 0.75H10.25C4.58908 0.75 0 5.33908 0 11C0 16.6609 4.58908 21.25 10.25 21.25H27.25C32.9109 21.25 37.5 16.6609 37.5 11C37.5 5.33908 32.9109 0.75 27.25 0.75Z" fill="white"/>
                    <path d="M25 10.75H13.5M13.5 10.75L18 6.25M13.5 10.75L18 15.75" stroke="black" stroke-linecap="round"/>
                </svg>
            </button></a>`;
        }

        function getStatusPill(text, type) {
            const icon = type === 'canceled'
                ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 6L18 18M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>`
                : type === 'postponed'
                ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 8V12L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/></svg>`
                : `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
            return `<div class="status-pill ${type}"><span class="icon">${icon}</span><span class="text">${text}</span></div>`;
        }

        function renderWeek(centerDate) {
            weekDaysEl.innerHTML = "";
            // محاسبه دستی: از تاریخ ورودی به عقب می‌رویم تا به شنبه برسیم
            const startOfWeek = moment(centerDate).clone().startOf('day');
            while (startOfWeek.day() !== 6) {
                startOfWeek.subtract(1, 'day');
            }
            
            for (let i = 0; i < 7; i++) {
                const m = moment(startOfWeek).add(i, 'days');
                const isToday = m.isSame(today, 'day');
                const isSelected = m.isSame(selectedDate, 'day');

                const dayDiv = document.createElement('div');
                // اگر امروز است، همیشه فعال باشد
                const shouldBeActive = isToday || isSelected;
                dayDiv.className = 'day' + (isToday ? ' today' : '') + (shouldBeActive ? ' active' : '');
                const weekDay = weekDaysByMomentIndex[m.day()];
                // تغییر فرمت ماه از امرداد به مرداد
                const monthName = m.format('jMMMM').replace('امرداد', 'مرداد');
                const jDateStr = `${weekDay}<br>${m.jDate()} ${monthName}`;
                dayDiv.innerHTML = jDateStr;
                
                // دیباگ برای بررسی روزها
                if (isToday) {
                    console.log('Today found:', weekDay, m.jDate(), monthName, 'should be active:', shouldBeActive);
                }

                dayDiv.addEventListener('click', () => {
                    selectedDate = m;
                    document.querySelectorAll('.day').forEach(el => el.classList.remove('active'));
                    dayDiv.classList.add('active');
                    renderClassesFor(m);
                });

                weekDaysEl.appendChild(dayDiv);
            }
        }

        // رویدادهای دکمه‌های هفته قبل و بعد - اصلاح شده
        const prevWeekBtn = document.getElementById('prevWeek');
        const nextWeekBtn = document.getElementById('nextWeek');

        if (prevWeekBtn) {
            prevWeekBtn.addEventListener('click', () => {
                current = current.subtract(7, 'days'); // تغییر به subtract
                renderWeek(current);
            });
        }

        if (nextWeekBtn) {
            nextWeekBtn.addEventListener('click', () => {
                current = current.add(7, 'days'); // تغییر به add
                renderWeek(current);
            });
        }

        // تنظیم متن امروز
            const monthName = moment(today).format("jMMMM").replace('امرداد', 'مرداد');
        goToTodayText.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 5.75C7.59 5.75 7.25 5.41 7.25 5V2C7.25 1.59 7.59 1.25 8 1.25C8.41 1.25 8.75 1.59 8.75 2V5C8.75 5.41 8.41 5.75 8 5.75Z" fill="#222222"/>
                <path d="M16 5.75C15.59 5.75 15.25 5.41 15.25 5V2C15.25 1.59 15.59 1.25 16 1.25C16.41 1.25 16.75 1.59 16.75 2V5C16.75 5.41 16.41 5.75 16 5.75Z" fill="#222222"/>
                <path d="M15 22.75H9C3.38 22.75 2.25 20.1 2.25 15.82V9.65C2.25 4.91 3.85 2.98 7.96 2.75H16C16.01 2.75 16.03 2.75 16.04 2.75C20.15 2.98 21.75 4.91 21.75 9.65V15.82C21.75 20.1 20.62 22.75 15 22.75ZM8 4.25C5.2 4.41 3.75 5.29 3.75 9.65V15.82C3.75 19.65 4.48 21.25 9 21.25H15C19.52 21.25 20.25 19.65 20.25 15.82V9.65C20.25 5.3 18.81 4.41 15.98 4.25H8Z" fill="#222222"/>
                <path d="M20.75 18.3501H3.25C2.84 18.3501 2.5 18.0101 2.5 17.6001C2.5 17.1901 2.84 16.8501 3.25 16.8501H20.75C21.16 16.8501 21.5 17.1901 21.5 17.6001C21.5 18.0101 21.16 18.3501 20.75 18.3501Z" fill="#222222"/>
                <path d="M12 8.25C10.77 8.25 9.73 8.92 9.73 10.22C9.73 10.84 10.02 11.31 10.46 11.61C9.85 11.97 9.5 12.55 9.5 13.23C9.5 14.47 10.45 15.24 12 15.24C13.54 15.24 14.5 14.47 14.5 13.23C14.5 12.55 14.15 11.96 13.53 11.61C13.98 11.3 14.26 10.84 14.26 10.22C14.26 8.92 13.23 8.25 12 8.25ZM12 11.09C11.48 11.09 11.1 10.78 11.1 10.29C11.1 9.79 11.48 9.5 12 9.5C12.52 9.5 12.9 9.79 12.9 10.29C12.9 10.78 12.52 11.09 12 11.09ZM12 14C11.34 14 10.86 13.67 10.86 13.07C10.86 12.47 11.34 12.15 12 12.15C12.66 12.15 13.14 12.48 13.14 13.07C13.14 13.67 12.66 14 12 14Z" fill="#222222"/>
            </svg>
            امروز ${today.jDate()} ${monthName} ${today.jYear()}`;

        goToTodayText.addEventListener('click', () => {
            current = moment();
            selectedDate = moment(today);
            renderWeek(current);
            renderClassesFor(today);
        });

        // شروع رندر: امروز را انتخاب و نمایش بده
        selectedDate = moment(today);
        current = moment(today);
        renderWeek(today);
        renderClassesFor(today);
    });
})(jQuery); 