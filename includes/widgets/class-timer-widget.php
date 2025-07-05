<?php
/**
 * ویجت زمان‌بندی کلاس‌ها برای المنتور
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت زمان‌بندی کلاس‌ها برای المنتور
 */
class UM_Class_Timer_Widget extends \Elementor\Widget_Base {

    /**
     * نام ویجت
     * @return string
     */
    public function get_name() {
        return 'um_class_timer';
    }

    /**
     * عنوان ویجت
     * @return string
     */
    public function get_title() {
        return __('زمان‌بندی کلاس‌ها', 'university-management');
    }

    /**
     * آیکون ویجت
     * @return string
     */
    public function get_icon() {
        return 'eicon-clock-o';
    }

    /**
     * دسته‌بندی ویجت
     * @return array
     */
    public function get_categories() {
        return ['university-management'];
    }

    /**
     * اسکریپت‌های وابسته
     * @return array
     */
    public function get_script_depends() {
        return ['um-class-timer-widget', 'moment', 'moment-jalaali'];
    }

    /**
     * استایل‌های وابسته
     * @return array
     */
    public function get_style_depends() {
        return ['um-class-timer-widget'];
    }

    /**
     * ثبت کنترل‌های ویجت
     */
    protected function _register_controls() {
        // بخش تنظیمات عمومی
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('تنظیمات عمومی', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // انتخاب نمایش خودکار یا دستی کلاس‌ها
        $this->add_control(
            'class_source',
            [
                'label' => __('منبع کلاس‌ها', 'university-management'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => __('خودکار (از پست‌تایپ)', 'university-management'),
                    'manual' => __('دستی', 'university-management'),
                ],
            ]
        );

        // تعداد کلاس‌ها برای نمایش
        $this->add_control(
            'classes_count',
            [
                'label' => __('تعداد کلاس‌ها', 'university-management'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 5,
                'condition' => [
                    'class_source' => 'auto',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش کلاس‌های دستی
        $this->start_controls_section(
            'section_manual_classes',
            [
                'label' => __('کلاس‌های دستی', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'class_source' => 'manual',
                ],
            ]
        );

        // تکرارکننده برای اضافه کردن کلاس‌ها
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'class_name',
            [
                'label' => __('نام کلاس', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('نام کلاس', 'university-management'),
            ]
        );

        $repeater->add_control(
            'class_date',
            [
                'label' => __('تاریخ کلاس', 'university-management'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => date('Y-m-d H:i'),
                'picker_options' => [
                    'enableTime' => true,
                    'dateFormat' => 'Y-m-d H:i',
                ],
            ]
        );

        $repeater->add_control(
            'class_duration',
            [
                'label' => __('مدت زمان کلاس (دقیقه)', 'university-management'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 30,
                'max' => 180,
                'step' => 5,
                'default' => 90,
            ]
        );

        $repeater->add_control(
            'class_teacher',
            [
                'label' => __('نام استاد', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('نام استاد', 'university-management'),
            ]
        );

        $repeater->add_control(
            'class_image',
            [
                'label' => __('تصویر کلاس', 'university-management'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'manual_classes',
            [
                'label' => __('کلاس‌ها', 'university-management'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'class_name' => __('کلاس برنامه‌نویسی پایتون', 'university-management'),
                        'class_date' => date('Y-m-d H:i', strtotime('+1 day')),
                        'class_duration' => 90,
                        'class_teacher' => __('دکتر محمدی', 'university-management'),
                    ],
                    [
                        'class_name' => __('کلاس مبانی هوش مصنوعی', 'university-management'),
                        'class_date' => date('Y-m-d H:i', strtotime('+2 day')),
                        'class_duration' => 120,
                        'class_teacher' => __('دکتر علوی', 'university-management'),
                    ],
                ],
                'title_field' => '{{{ class_name }}}',
            ]
        );

        $this->end_controls_section();

        // بخش استایل
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('استایل', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ پس‌زمینه تقویم
        $this->add_control(
            'calendar_bg_color',
            [
                'label' => __('رنگ پس‌زمینه هدر تقویم', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212179',
                'selectors' => [
                    '{{WRAPPER}} .calendar-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // رنگ متن روز فعال
        $this->add_control(
            'active_day_color',
            [
                'label' => __('رنگ متن روز فعال', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#181818',
                'selectors' => [
                    '{{WRAPPER}} .day.active' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        // رنگ پس‌زمینه روز فعال
        $this->add_control(
            'active_day_bg_color',
            [
                'label' => __('رنگ پس‌زمینه روز فعال', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .day.active' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        // رنگ دکمه شروع کلاس
        $this->add_control(
            'start_btn_color',
            [
                'label' => __('رنگ دکمه شروع کلاس', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212179',
                'selectors' => [
                    '{{WRAPPER}} .class-card .start-btn button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // رنگ متن دکمه شروع کلاس
        $this->add_control(
            'start_btn_text_color',
            [
                'label' => __('رنگ متن دکمه شروع کلاس', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .class-card .start-btn button' => 'color: {{VALUE}};',
                ],
            ]
        );

        // رنگ کارت کلاس
        $this->add_control(
            'card_bg_color',
            [
                'label' => __('رنگ پس‌زمینه کارت کلاس', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .class-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * رندر کردن خروجی ویجت
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // تعیین منبع کلاس‌ها
        $classes = array();
        
        if ($settings['class_source'] === 'auto') {
            // دریافت کلاس‌ها از پست‌تایپ
            $args = array(
                'post_type' => 'um_classes',
                'posts_per_page' => $settings['classes_count'],
                'orderby' => 'meta_value',
                'meta_key' => '_class_date',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => '_class_date',
                        'value' => date('Y-m-d H:i:s'),
                        'compare' => '>=',
                        'type' => 'DATETIME'
                    )
                )
            );
            
            $query = new \WP_Query($args);
            
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                    $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                    $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                    
                    $classes[] = array(
                        'name' => get_the_title(),
                        'date' => $class_date,
                        'duration' => $class_duration,
                        'teacher' => $class_teacher,
                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: \Elementor\Utils::get_placeholder_image_src(),
                    );
                }
                
                wp_reset_postdata();
            }
        } else {
            // استفاده از کلاس‌های دستی
            foreach ($settings['manual_classes'] as $class) {
                $classes[] = array(
                    'name' => $class['class_name'],
                    'date' => $class['class_date'],
                    'duration' => $class['class_duration'],
                    'teacher' => $class['class_teacher'],
                    'image' => $class['class_image']['url'],
                );
            }
        }
        
        // ایجاد کلاس‌های استایل
        $this->add_render_attribute('wrapper', 'class', 'calendar-container');
        
        // رندر HTML
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="today-text">
                <span id="currentDate"></span>
                <div class="timer-wrapper">
                    <span class="digit-box" id="hours">00</span>:
                    <span class="digit-box" id="minutes">00</span>:
                    <span class="digit-box" id="seconds">00</span>
                </div>
            </div>
            
            <div class="calendar-header">
                <button id="prevWeek">
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 13L1 7L7 1" stroke="#212179" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                
                <div class="week-days" id="weekDays">
                    <!-- روزهای هفته اینجا نمایش داده می‌شوند -->
                </div>
                
                <button id="nextWeek">
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#212179" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            
            <div id="classList">
                <!-- لیست کلاس‌ها اینجا نمایش داده می‌شوند -->
            </div>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            // تنظیم moment.js برای استفاده از تقویم جلالی
            moment.locale('fa');
            
            // تعریف کلاس‌ها
            var classes = <?php echo json_encode($classes); ?>;
            
            // نمایش تاریخ امروز
            var today = moment();
            $('#currentDate').text(today.format('jYYYY/jMM/jDD'));
            
            // آپدیت تایمر هر ثانیه
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
                } else {
                    // نمایش پیام عدم وجود کلاس
                    classList.html('<div class="no-result"><p>کلاسی در این روز وجود ندارد.</p></div>');
                }
            }
            
            // آپدیت تایمر
            function updateTimer() {
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0');
                var minutes = now.getMinutes().toString().padStart(2, '0');
                var seconds = now.getSeconds().toString().padStart(2, '0');
                
                $('#hours').text(hours);
                $('#minutes').text(minutes);
                $('#seconds').text(seconds);
            }
        });
        </script>
        <?php
    }
}