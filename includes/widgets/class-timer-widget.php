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

        // بخش استایل - Container
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => um_translate('استایل کانتینر', __('استایل کانتینر', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => um_translate('پس‌زمینه کانتینر', __('پس‌زمینه کانتینر', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .class-timer-container',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => um_translate('حاشیه کانتینر', __('حاشیه کانتینر', 'university-management')),
                'selector' => '{{WRAPPER}} .class-timer-container',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-timer-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => um_translate('سایه کانتینر', __('سایه کانتینر', 'university-management')),
                'selector' => '{{WRAPPER}} .class-timer-container',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => um_translate('فاصله داخلی', __('فاصله داخلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-timer-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => um_translate('فاصله خارجی', __('فاصله خارجی', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-timer-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Calendar Header
        $this->start_controls_section(
            'section_style_calendar_header',
            [
                'label' => um_translate('استایل هدر تقویم', __('استایل هدر تقویم', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'calendar_header_background',
                'label' => um_translate('پس‌زمینه هدر', __('پس‌زمینه هدر', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .calendar-header',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'calendar_header_typography',
                'label' => um_translate('تایپوگرافی هدر', __('تایپوگرافی هدر', 'university-management')),
                'selector' => '{{WRAPPER}} .calendar-header',
            ]
        );

        $this->add_control(
            'calendar_header_text_color',
            [
                'label' => um_translate('رنگ متن هدر', __('رنگ متن هدر', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calendar-header' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'calendar_header_padding',
            [
                'label' => um_translate('فاصله داخلی هدر', __('فاصله داخلی هدر', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .calendar-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Calendar Days
        $this->start_controls_section(
            'section_style_calendar_days',
            [
                'label' => um_translate('استایل روزهای تقویم', __('استایل روزهای تقویم', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'calendar_days_typography',
                'label' => um_translate('تایپوگرافی روزها', __('تایپوگرافی روزها', 'university-management')),
                'selector' => '{{WRAPPER}} .calendar-day',
            ]
        );

        $this->add_control(
            'calendar_days_text_color',
            [
                'label' => um_translate('رنگ متن روزها', __('رنگ متن روزها', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calendar-day' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'calendar_days_background_color',
            [
                'label' => um_translate('رنگ پس‌زمینه روزها', __('رنگ پس‌زمینه روزها', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calendar-day' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'calendar_days_active_text_color',
            [
                'label' => um_translate('رنگ متن روز فعال', __('رنگ متن روز فعال', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calendar-day.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'calendar_days_active_background_color',
            [
                'label' => um_translate('رنگ پس‌زمینه روز فعال', __('رنگ پس‌زمینه روز فعال', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calendar-day.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'calendar_days_padding',
            [
                'label' => um_translate('فاصله داخلی روزها', __('فاصله داخلی روزها', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .calendar-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'calendar_days_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های روزها', __('گردی گوشه‌های روزها', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .calendar-day' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Class Cards
        $this->start_controls_section(
            'section_style_class_cards',
            [
                'label' => um_translate('استایل کارت‌های کلاس', __('استایل کارت‌های کلاس', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'class_card_background',
                'label' => um_translate('پس‌زمینه کارت', __('پس‌زمینه کارت', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .class-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'class_card_border',
                'label' => um_translate('حاشیه کارت', __('حاشیه کارت', 'university-management')),
                'selector' => '{{WRAPPER}} .class-card',
            ]
        );

        $this->add_control(
            'class_card_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های کارت', __('گردی گوشه‌های کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'class_card_box_shadow',
                'label' => um_translate('سایه کارت', __('سایه کارت', 'university-management')),
                'selector' => '{{WRAPPER}} .class-card',
            ]
        );

        $this->add_responsive_control(
            'class_card_padding',
            [
                'label' => um_translate('فاصله داخلی کارت', __('فاصله داخلی کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'class_card_margin',
            [
                'label' => um_translate('فاصله خارجی کارت', __('فاصله خارجی کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Class Title
        $this->start_controls_section(
            'section_style_class_title',
            [
                'label' => um_translate('استایل عنوان کلاس', __('استایل عنوان کلاس', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'class_title_typography',
                'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
                'selector' => '{{WRAPPER}} .class-title',
            ]
        );

        $this->add_control(
            'class_title_text_color',
            [
                'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .class-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'class_title_margin',
            [
                'label' => um_translate('فاصله عنوان', __('فاصله عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Class Details
        $this->start_controls_section(
            'section_style_class_details',
            [
                'label' => um_translate('استایل جزئیات کلاس', __('استایل جزئیات کلاس', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'class_details_typography',
                'label' => um_translate('تایپوگرافی جزئیات', __('تایپوگرافی جزئیات', 'university-management')),
                'selector' => '{{WRAPPER}} .class-details',
            ]
        );

        $this->add_control(
            'class_details_text_color',
            [
                'label' => um_translate('رنگ جزئیات', __('رنگ جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .class-details' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'class_details_margin',
            [
                'label' => um_translate('فاصله جزئیات', __('فاصله جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .class-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Start Button
        $this->start_controls_section(
            'section_style_start_button',
            [
                'label' => um_translate('استایل دکمه شروع', __('استایل دکمه شروع', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'start_button_typography',
                'label' => um_translate('تایپوگرافی دکمه', __('تایپوگرافی دکمه', 'university-management')),
                'selector' => '{{WRAPPER}} .start-class-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'start_button_background',
                'label' => um_translate('پس‌زمینه دکمه', __('پس‌زمینه دکمه', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .start-class-btn',
            ]
        );

        $this->add_control(
            'start_button_text_color',
            [
                'label' => um_translate('رنگ متن دکمه', __('رنگ متن دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .start-class-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'start_button_border',
                'label' => um_translate('حاشیه دکمه', __('حاشیه دکمه', 'university-management')),
                'selector' => '{{WRAPPER}} .start-class-btn',
            ]
        );

        $this->add_control(
            'start_button_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های دکمه', __('گردی گوشه‌های دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .start-class-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'start_button_padding',
            [
                'label' => um_translate('فاصله داخلی دکمه', __('فاصله داخلی دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .start-class-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'start_button_margin',
            [
                'label' => um_translate('فاصله خارجی دکمه', __('فاصله خارجی دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .start-class-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Hover state
        $this->add_control(
            'start_button_hover_heading',
            [
                'label' => um_translate('حالت هاور', __('حالت هاور', 'university-management')),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'start_button_hover_text_color',
            [
                'label' => um_translate('رنگ متن دکمه (هاور)', __('رنگ متن دکمه (هاور)', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .start-class-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'start_button_hover_background',
                'label' => um_translate('پس‌زمینه دکمه (هاور)', __('پس‌زمینه دکمه (هاور)', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .start-class-btn:hover',
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
                // همه کلاس‌ها را بگیر تا در هفته‌های بعد/قبل نیز نمایش داده شوند
                // محدود کردن به 10 مورد باعث می‌شد کلاس‌های جدید در ویجت دیده نشوند
                'posts_per_page' => -1,
                'orderby' => 'meta_value',
                'meta_key' => '_class_date',
                'order' => 'ASC',
                'post_status' => 'publish',
                'meta_type' => 'DATETIME',
            );
            
            $query = new \WP_Query($args);
            
            // دیباگ برای بررسی پست‌ها
            um_log('Class Timer Widget Debug:');
            um_log('Found posts: ' . $query->found_posts);
            um_log('Post type exists: ' . (post_type_exists('um_classes') ? 'Yes' : 'No'));
            
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                    $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                    $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                    $class_status = get_post_meta(get_the_ID(), '_class_status', true) ?: 'scheduled';
                    
                    um_log('Class found - ID: ' . get_the_ID() . ', Title: ' . get_the_title() . ', Date: ' . $class_date);
                    
                    // تبدیل تاریخ به فرمت استاندارد
                    $formatted_date = date('Y-m-d H:i:s', strtotime($class_date));
                    
                    $classes[] = array(
                        'id' => get_the_ID(),
                        'name' => get_the_title(),
                        'date' => $formatted_date,
                        'duration' => intval($class_duration),
                        'teacher' => $class_teacher,
                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'status' => $class_status,
                    );
                }
                
                wp_reset_postdata();
            } else {
                um_log('No classes found in query');
            }
        } else {
            // استفاده از کلاس‌های دستی
            foreach ($settings['manual_classes'] as $class) {
                $classes[] = array(
                    'id' => 0,
                    'name' => $class['class_name'],
                    'date' => $class['class_date'],
                    'duration' => intval($class['class_duration']),
                    'teacher' => $class['class_teacher'],
                    'image' => $class['class_image']['url'] ?: plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                    'status' => isset($class['class_status']) ? $class['class_status'] : 'scheduled',
                );
            }
        }
        
        // تبدیل کلاس‌ها به فرمت مورد نیاز برای JavaScript
        $classData = array();
        foreach ($classes as $class) {
            $date = date('Y-m-d', strtotime($class['date']));
            $start_time = date('H:i', strtotime($class['date']));
            $end_time = date('H:i', strtotime($class['date'] . ' + ' . $class['duration'] . ' minutes'));
            
            if (!isset($classData[$date])) {
                $classData[$date] = array();
            }
            
            $classData[$date][] = array(
                'id' => isset($class['id']) ? $class['id'] : 0,
                'name' => $class['name'],
                'teacher' => $class['teacher'],
                'time' => $start_time . ' - ' . $end_time,
                'image' => $class['image'],
                'link' => '#',
                'status' => isset($class['status']) ? $class['status'] : 'scheduled',
            );
        }
        
        um_log('Final classData', $classData);
        
        // اگر هیچ کلاسی وجود ندارد، داده‌های نمونه اضافه کن
        if (empty($classData)) {
            $classData = array(
                "2025-04-28" => array(
                    array(
                        'name' => "ریاضی پایه",
                        'teacher' => "خانم احمدی",
                        'time' => "10:00 - 11:00",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    ),
                    array(
                        'name' => "علوم تجربی",
                        'teacher' => "آقای کریمی",
                        'time' => "13:00 - 14:00",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    ),
                    array(
                        'name' => "ادبیات فارسی",
                        'teacher' => "خانم حسینی",
                        'time' => "15:00 - 16:00",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    )
                ),
                "2025-04-29" => array(
                    array(
                        'name' => "زبان انگلیسی",
                        'teacher' => "آقای عباسی",
                        'time' => "09:00 - 10:00",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    ),
                    array(
                        'name' => "فیزیک",
                        'teacher' => "خانم مرادی",
                        'time' => "11:00 - 12:00",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    )
                ),
                "2025-04-30" => array(
                    array(
                        'name' => "کامپیوتر مقدماتی",
                        'teacher' => "آقای رضایی",
                        'time' => "14:00 - 15:30",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    ),
                    array(
                        'name' => "زبان انگلیسی",
                        'teacher' => "آقای عباسی",
                        'time' => "16:00 - 17:00",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    )
                ),
                "2025-05-01" => array(
                    array(
                        'name' => "کامپیوتر مقدماتی",
                        'teacher' => "آقای رضایی",
                        'time' => "14:00 - 15:30",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    ),
                    array(
                        'name' => "زبان انگلیسی",
                        'teacher' => "آقای عباسی",
                        'time' => "12:30 - 13:30",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    )
                ),
                "2025-06-11" => array(
                    array(
                        'name' => "کامپیوتر مقدماتی",
                        'teacher' => "آقای رضایی",
                        'time' => "14:00 - 15:30",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    ),
                    array(
                        'name' => "زبان انگلیسی",
                        'teacher' => "آقای عباسی",
                        'time' => "12:30 - 13:30",
                        'image' => plugin_dir_url(__FILE__) . '../../assets/images/class-timer-default.png',
                        'link' => "#"
                    )
                )
            );
        }
        
        // ایجاد کلاس‌های استایل
        $this->add_render_attribute('wrapper', 'class', 'calendar-container');
        
        // رندر HTML
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="calendar-details">
                <div class="today-text" id="goToToday"></div>
                <div id="liveClassInfo" style="font-size: 14px; color: #555;">دوره در حال برگزاری: 0 / 0</div>
            </div>
            <div class="calendar-header">
                <button id="prevWeek">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
  <path fill="#000000" d="M15.41 7.41L10.83 12l4.58 4.59L14 18l-6-6 6-6z"/>
</svg>

                </button>
                <div class="week-days" id="weekDays"></div>
                <button id="nextWeek">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
  <path fill="#000000" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/>
</svg>

                </button>
            </div>
            <div id="classList"></div>
        </div>
        
        <script>
            // تعریف داده‌های کلاس‌ها به صورت جهانی
            window.classesData = <?php echo json_encode($classData); ?>;
            console.log('Classes Data:', window.classesData);
        </script>
        <?php
    }
}

