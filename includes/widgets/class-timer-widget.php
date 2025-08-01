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
        return um_translate('زمان‌بندی کلاس‌ها', __('زمان‌بندی کلاس‌ها', 'university-management'));
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
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_polylang_strings() {
        if (function_exists('pll_register_string')) {
            // رشته‌های بخش تنظیمات عمومی
            pll_register_string('um_class_timer_widget_general_settings', 'تنظیمات عمومی', 'University Management');
            pll_register_string('um_class_timer_widget_class_source', 'منبع کلاس‌ها', 'University Management');
            pll_register_string('um_class_timer_widget_class_source_auto', 'خودکار (از پست‌تایپ)', 'University Management');
            pll_register_string('um_class_timer_widget_class_source_manual', 'دستی', 'University Management');
            pll_register_string('um_class_timer_widget_classes_count', 'تعداد کلاس‌ها', 'University Management');

            // رشته‌های بخش کلاس‌های دستی
            pll_register_string('um_class_timer_widget_manual_classes', 'کلاس‌های دستی', 'University Management');
            pll_register_string('um_class_timer_widget_class_name', 'نام کلاس', 'University Management');
            pll_register_string('um_class_timer_widget_class_date', 'تاریخ کلاس', 'University Management');
            pll_register_string('um_class_timer_widget_class_duration', 'مدت زمان کلاس (دقیقه)', 'University Management');
            pll_register_string('um_class_timer_widget_class_teacher', 'نام استاد', 'University Management');
            pll_register_string('um_class_timer_widget_class_image', 'تصویر کلاس', 'University Management');
            pll_register_string('um_class_timer_widget_classes', 'کلاس‌ها', 'University Management');
            pll_register_string('um_class_timer_widget_default_class_name_1', 'کلاس برنامه‌نویسی پایتون', 'University Management');
            pll_register_string('um_class_timer_widget_default_teacher_1', 'دکتر محمدی', 'University Management');
            pll_register_string('um_class_timer_widget_default_class_name_2', 'کلاس مبانی هوش مصنوعی', 'University Management');
            pll_register_string('um_class_timer_widget_default_teacher_2', 'دکتر علوی', 'University Management');

            // رشته‌های بخش استایل
            pll_register_string('um_class_timer_widget_style_section', 'استایل', 'University Management');
            pll_register_string('um_class_timer_widget_calendar_bg_color', 'رنگ پس‌زمینه هدر تقویم', 'University Management');
            pll_register_string('um_class_timer_widget_active_day_color', 'رنگ متن روز فعال', 'University Management');
            pll_register_string('um_class_timer_widget_active_day_bg_color', 'رنگ پس‌زمینه روز فعال', 'University Management');
            pll_register_string('um_class_timer_widget_start_btn_color', 'رنگ دکمه شروع کلاس', 'University Management');
            pll_register_string('um_class_timer_widget_start_btn_text_color', 'رنگ متن دکمه شروع کلاس', 'University Management');
            pll_register_string('um_class_timer_widget_card_bg_color', 'رنگ پس‌زمینه کارت کلاس', 'University Management');
        }
    }

    /**
     * ثبت کنترل‌های ویجت
     */
    protected function _register_controls() {
        $this->register_polylang_strings();
        // بخش تنظیمات عمومی
        $this->start_controls_section(
            'section_general',
            [
                'label' => um_translate('تنظیمات عمومی', __('تنظیمات عمومی', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // انتخاب نمایش خودکار یا دستی کلاس‌ها
        $this->add_control(
            'class_source',
            [
                'label' => um_translate('منبع کلاس‌ها', __('منبع کلاس‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => um_translate('خودکار (از پست‌تایپ)', __('خودکار (از پست‌تایپ)', 'university-management')),
                    'manual' => um_translate('دستی', __('دستی', 'university-management')),
                ],
            ]
        );

        // تعداد کلاس‌ها برای نمایش
        $this->add_control(
            'classes_count',
            [
                'label' => um_translate('تعداد کلاس‌ها', __('تعداد کلاس‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 10,
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
                'label' => um_translate('کلاس‌های دستی', __('کلاس‌های دستی', 'university-management')),
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
                'label' => um_translate('نام کلاس', __('نام کلاس', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('نام کلاس', __('نام کلاس', 'university-management')),
            ]
        );

        $repeater->add_control(
            'class_date',
            [
                'label' => um_translate('تاریخ کلاس', __('تاریخ کلاس', 'university-management')),
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
                'label' => um_translate('مدت زمان کلاس (دقیقه)', __('مدت زمان کلاس (دقیقه)', 'university-management')),
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
                'label' => um_translate('نام استاد', __('نام استاد', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('نام استاد', __('نام استاد', 'university-management')),
            ]
        );

        $repeater->add_control(
            'class_image',
            [
                'label' => um_translate('تصویر کلاس', __('تصویر کلاس', 'university-management')),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'manual_classes',
            [
                'label' => um_translate('کلاس‌ها', __('کلاس‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'class_name' => um_translate('کلاس برنامه‌نویسی پایتون', __('کلاس برنامه‌نویسی پایتون', 'university-management')),
                        'class_date' => date('Y-m-d H:i', strtotime('+1 day')),
                        'class_duration' => 90,
                        'class_teacher' => um_translate('دکتر محمدی', __('دکتر محمدی', 'university-management')),
                    ],
                    [
                        'class_name' => um_translate('کلاس مبانی هوش مصنوعی', __('کلاس مبانی هوش مصنوعی', 'university-management')),
                        'class_date' => date('Y-m-d H:i', strtotime('+2 day')),
                        'class_duration' => 120,
                        'class_teacher' => um_translate('دکتر علوی', __('دکتر علوی', 'university-management')),
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
                'label' => um_translate('استایل', __('استایل', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ پس‌زمینه تقویم
        $this->add_control(
            'calendar_bg_color',
            [
                'label' => um_translate('رنگ پس‌زمینه هدر تقویم', __('رنگ پس‌زمینه هدر تقویم', 'university-management')),
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
                'label' => um_translate('رنگ متن روز فعال', __('رنگ متن روز فعال', 'university-management')),
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
                'label' => um_translate('رنگ پس‌زمینه روز فعال', __('رنگ پس‌زمینه روز فعال', 'university-management')),
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
                'label' => um_translate('رنگ دکمه شروع کلاس', __('رنگ دکمه شروع کلاس', 'university-management')),
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
                'label' => um_translate('رنگ متن دکمه شروع کلاس', __('رنگ متن دکمه شروع کلاس', 'university-management')),
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
                'label' => um_translate('رنگ پس‌زمینه کارت کلاس', __('رنگ پس‌زمینه کارت کلاس', 'university-management')),
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
        
        // لاگ تنظیمات برای دیباگ
        error_log('Widget Settings: ' . print_r($settings, true));
        
        if ($settings['class_source'] === 'auto') {
            // دریافت کلاس‌ها از پست‌تایپ
            $args = array(
                'post_type' => 'um_classes',
                'posts_per_page' => $settings['classes_count'], // استفاده از تعداد تنظیم شده
                'orderby' => 'meta_value',
                'meta_key' => '_class_date',
                'order' => 'ASC',
            );
            
            $query = new \WP_Query($args);
            
            // لاگ تعداد کل کلاس‌ها
            error_log('Total Classes Found (Auto): ' . $query->found_posts);
            
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                    $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                    $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                    
                    // اضافه کردن چاپ اطلاعات برای دیباگ
                    error_log('Auto Class Details: ' . 
                        'ID: ' . get_the_ID() . 
                        ', Title: ' . get_the_title() . 
                        ', Date: ' . $class_date . 
                        ', Duration: ' . $class_duration . 
                        ', Teacher: ' . $class_teacher
                    );
                    
                    // تبدیل تاریخ به فرمت استاندارد اگر نیاز باشد
                    $formatted_date = date('Y-m-d H:i:s', strtotime($class_date));
                    
                    $classes[] = array(
                        'name' => get_the_title(),
                        'date' => $formatted_date, // استفاده از تاریخ فرمت‌بندی شده
                        'duration' => intval($class_duration), // تبدیل به عدد صحیح
                        'teacher' => $class_teacher,
                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: \Elementor\Utils::get_placeholder_image_src(),
                    );
                }
                
                wp_reset_postdata();
            } else {
                // اضافه کردن چاپ پیغام برای دیباگ
                error_log('No classes found in the auto query');
            }
        } else {
            // استفاده از کلاس‌های دستی
            error_log('Manual Classes Count: ' . count($settings['manual_classes']));
            
            foreach ($settings['manual_classes'] as $index => $class) {
                error_log('Manual Class ' . $index . ' Details: ' . print_r($class, true));
                
                $classes[] = array(
                    'name' => $class['class_name'],
                    'date' => $class['class_date'],
                    'duration' => intval($class['class_duration']),
                    'teacher' => $class['class_teacher'],
                    'image' => $class['class_image']['url'] ?: \Elementor\Utils::get_placeholder_image_src(),
                );
            }
        }
        
        // لاگ نهایی کلاس‌ها
        error_log('Final Classes Array: ' . print_r($classes, true));
        error_log('Classes Count: ' . count($classes));
        
        // بررسی اینکه آیا کلاس‌ها وجود دارند
        if (empty($classes)) {
            error_log('WARNING: No classes found to render');
        }
        
        // اضافه کردن لاگ برای تشخیص مشکل
        error_log('Current Date (Server): ' . date('Y-m-d H:i:s'));
        error_log('Current Date (Moment.js): ' . date('Y-m-d'));
        
        // ایجاد کلاس‌های استایل
        $this->add_render_attribute('wrapper', 'class', 'calendar-container');
        
        // رندر HTML
        ?>
        <script>
            // لاگ کنسول برای بررسی دقیق کلاس‌ها
            console.log('PHP Classes Count:', <?php echo count($classes); ?>);
            console.log('PHP Classes:', <?php echo json_encode($classes); ?>);
            
            // تعریف داده‌های کلاس‌ها به صورت جهانی
            window.classesData = <?php echo json_encode($classes); ?>;
            
            // لاگ کنسول برای تأیید انتقال داده‌ها
            console.log('Window Classes Data:', window.classesData);
        </script>
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
        
        <?php
    }
}

class KWPRC_Class_Timer_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'kwprc_class_timer';
    }

    public function get_title() {
        return 'تقویم کلاسی KWPRC';
    }

    public function get_icon() {
        return 'eicon-calendar';
    }

    public function get_categories() {
        return ['general'];
    }

    /**
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_kwprc_polylang_strings() {
        if (function_exists('pll_register_string')) {
            pll_register_string('kwprc_class_timer_widget_title', 'تقویم کلاسی KWPRC', 'University Management');
            pll_register_string('kwprc_class_timer_widget_settings', 'تنظیمات', 'University Management');
            pll_register_string('kwprc_class_timer_widget_title_control', 'عنوان', 'University Management');
            pll_register_string('kwprc_class_timer_widget_default_title', 'برنامه کلاسی', 'University Management');
            pll_register_string('kwprc_class_timer_widget_live_class_info', 'دوره در حال برگزاری: 0 / 0', 'University Management');
        }
    }

    protected function register_controls() {
        $this->register_kwprc_polylang_strings();
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'تنظیمات',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'عنوان',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'برنامه کلاسی',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="kwprc-class-timer-widget">
            <div class="calendar-container">
                <div class="calendar-details">
                    <div class="today-text" id="goToToday"></div>
                    <div id="liveClassInfo" style="font-size: 14px; color: #555;">دوره در حال برگزاری: 0 / 0</div>
                </div>
                <div class="calendar-header">
                    <button id="prevWeek">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.43 18.8201C14.24 18.8201 14.05 18.7501 13.9 18.6001C13.61 18.3101 13.61 17.8301 13.9 17.5401L19.44 12.0001L13.9 6.46012C13.61 6.17012 13.61 5.69012 13.9 5.40012C14.19 5.11012 14.67 5.11012 14.96 5.40012L21.03 11.4701C21.32 11.7601 21.32 12.2401 21.03 12.5301L14.96 18.6001C14.81 18.7501 14.62 18.8201 14.43 18.8201Z" fill="#212179"/>
                            <path d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z" fill="#212179"/>
                        </svg>
                    </button>
                    <div class="week-days" id="weekDays"></div>
                    <button id="nextWeek">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.57 18.8201C9.76 18.8201 9.95 18.7501 10.1 18.6001C10.39 18.3101 10.39 17.8301 10.1 17.5401L4.56 12.0001L10.1 6.46012C10.39 6.17012 10.39 5.69012 10.1 5.40012C9.81 5.11012 9.33 5.11012 9.04 5.40012L2.97 11.4701C2.68 11.7601 2.68 12.2401 2.97 12.5301L9.04 18.6001C9.19 18.7501 9.38 18.8201 9.57 18.8201Z" fill="#212179"/>
                            <path d="M3.67 12.75H20.5C20.91 12.75 21.25 12.41 21.25 12C21.25 11.59 20.91 11.25 20.5 11.25H3.67C3.26 11.25 2.92 11.59 2.92 12C2.92 12.41 3.26 12.75 3.67 12.75Z" fill="#212179"/>
                        </svg>
                    </button>
                </div>
                <div id="classList"></div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const classData = <?php echo json_encode($this->get_class_data()); ?>;
                initializeClassTimer(classData);
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

                // Rest of the JavaScript code from the original implementation
                // (Same as the previous implementation, but wrapped in a function)
                // ... [rest of the script would be the same as in the original index.html] ...
            }
        </script>
        <style>
            /* CSS styles from the original implementation */
            .calendar-container {
                background: white;
                border-radius: 10px;
                padding: 15px;
                max-width: 100%;
                margin: 20px auto;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            /* ... [rest of the CSS would be the same as in the original index.html] ... */
        </style>
        <?php
    }

    protected function get_class_data() {
        // در اینجا می‌توانید داده‌های کلاس را از پایگاه داده یا تنظیمات وردپرس دریافت کنید
        return [
            "2025-04-28" => [
                [
                    "name" => um_translate('ریاضی پایه', __('ریاضی پایه', 'university-management')), 
                    "teacher" => um_translate('خانم احمدی', __('خانم احمدی', 'university-management')), 
                    "time" => "10:00 - 11:00", 
                    "image" => plugin_dir_url(__FILE__) . "../../assets/images/Rectangle 5468.png", 
                    "link" => "#"
                ],
                // سایر کلاس‌ها
            ],
            // سایر تاریخ‌ها
        ];
    }
}

// ثبت ویجت در المنتور
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new KWPRC_Class_Timer_Widget());