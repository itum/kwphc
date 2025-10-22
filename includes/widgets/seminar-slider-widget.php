<?php
/**
 * ویجت اسلایدر کارگاه و سمینار برای المنتور
 *
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت اسلایدر کارگاه و سمینار
 */
class UM_Seminar_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'um_seminar_slider';
    }

    public function get_title() {
        return um_translate('اسلایدر کارگاه و سمینار', __('اسلایدر کارگاه و سمینار', 'university-management'));
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['university-management'];
    }

    public function get_script_depends() {
        return ['um-seminar-slider-widget', 'swiper', 'lucide'];
    }

    public function get_style_depends() {
        return ['um-seminar-slider-widget', 'swiper'];
    }

    /**
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_polylang_strings() {
        if (function_exists('pll_register_string')) {
            // رشته‌های بخش محتوا
            pll_register_string('um_seminar_slider_widget_content_section', 'محتوا', 'University Management');
            pll_register_string('um_seminar_slider_widget_main_title', 'عنوان اصلی', 'University Management');
            pll_register_string('um_seminar_slider_widget_default_main_title', "دوره سمینار و\nکارگاه‌های\nبرگزاری شده", 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_source', 'منبع کارگاه‌ها', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_source_manual', 'دستی', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_source_auto', 'خودکار (از پست‌تایپ)', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_category', 'دسته‌بندی کارگاه‌ها', 'University Management');
            pll_register_string('um_seminar_slider_widget_posts_per_page', 'تعداد برای نمایش', 'University Management');

            // رشته‌های تکرارکننده
            pll_register_string('um_seminar_slider_widget_seminar_image', 'تصویر', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_title', 'عنوان کارگاه', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_time', 'زمان برگزاری', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_teacher', 'مدرس', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_link', 'لینک دکمه', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_button_text', 'عنوان دکمه', 'University Management');
            pll_register_string('um_seminar_slider_widget_seminar_list', 'لیست کارگاه‌ها', 'University Management');
            pll_register_string('um_seminar_slider_widget_default_seminar_button_text', 'شروع یادگیری', 'University Management');
            pll_register_string('um_seminar_slider_widget_default_seminar_time', '۱۴۰۳/۰۵/۲۰', 'University Management');
            
            // رشته‌های خروجی
            pll_register_string('um_seminar_slider_widget_all_categories', 'همه دسته‌بندی‌ها', 'University Management');
            pll_register_string('um_seminar_slider_widget_time_label', 'زمان برگزاری:', 'University Management');
            pll_register_string('um_seminar_slider_widget_teacher_label', 'مدرس:', 'University Management');
        }
    }

    protected function _register_controls() {
        $this->register_polylang_strings();
        $this->start_controls_section(
            'section_content',
            [
                'label' => um_translate('محتوا', __('محتوا', 'university-management')),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => um_translate('عنوان اصلی', __('عنوان اصلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => um_translate("دوره سمینار و\nکارگاه‌های\nبرگزاری شده", __("دوره سمینار و\nکارگاه‌های\nبرگزاری شده", 'university-management')),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'seminar_source',
            [
                'label' => um_translate('منبع کارگاه‌ها', __('منبع کارگاه‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => [
                    'manual' => um_translate('دستی', __('دستی', 'university-management')),
                    'auto' => um_translate('خودکار (از پست‌تایپ)', __('خودکار (از پست‌تایپ)', 'university-management')),
                ],
            ]
        );

        $this->add_control(
            'seminar_category',
            [
                'label' => um_translate('دسته‌بندی کارگاه‌ها', __('دسته‌بندی کارگاه‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_seminar_categories(),
                'multiple' => false,
                'condition' => [
                    'seminar_source' => 'auto',
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => um_translate('تعداد برای نمایش', __('تعداد برای نمایش', 'university-management')),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 20,
                'condition' => [
                    'seminar_source' => 'auto',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'seminar_image',
            [
                'label' => um_translate('تصویر', __('تصویر', 'university-management')),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/63297photoqoran.jpg',
                ],
            ]
        );

        $repeater->add_control(
            'seminar_title',
            [
                'label' => um_translate('عنوان کارگاه', __('عنوان کارگاه', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('عنوان کارگاه', __('عنوان کارگاه', 'university-management')),
            ]
        );

        $repeater->add_control(
            'seminar_time',
            [
                'label' => um_translate('زمان برگزاری', __('زمان برگزاری', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('۱۴۰۳/۰۵/۲۰', __('۱۴۰۳/۰۵/۲۰', 'university-management')),
            ]
        );

        $repeater->add_control(
            'seminar_teacher',
            [
                'label' => um_translate('مدرس', __('مدرس', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('نام مدرس', __('نام مدرس', 'university-management')),
            ]
        );

        $repeater->add_control(
            'seminar_link',
            [
                'label' => um_translate('لینک دکمه', __('لینک دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => um_translate('https://your-link.com', __('https://your-link.com', 'university-management')),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'seminar_button_text',
            [
                'label' => um_translate('عنوان دکمه', __('عنوان دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('شروع یادگیری', __('شروع یادگیری', 'university-management')),
            ]
        );

        $this->add_control(
            'seminars',
            [
                'label' => um_translate('لیست کارگاه‌ها', __('لیست کارگاه‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/63297photoqoran.jpg'],
                        'seminar_title' => um_translate('فرانت‌اند', __('فرانت‌اند', 'university-management')),
                        'seminar_time' => um_translate('۱۴۰۳/۰۵/۲۰', __('۱۴۰۳/۰۵/۲۰', 'university-management')),
                        'seminar_teacher' => um_translate('مهدی بیگدلی', __('مهدی بیگدلی', 'university-management')),
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_220.jpeg'],
                        'seminar_title' => um_translate('Node.js', __('Node.js', 'university-management')),
                        'seminar_time' => um_translate('۱۴۰۳/۰۶/۱۰', __('۱۴۰۳/۰۶/۱۰', 'university-management')),
                        'seminar_teacher' => um_translate('سارا سلیمانی', __('سارا سلیمانی', 'university-management')),
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_219.jpeg'],
                        'seminar_title' => um_translate('UI/UX', __('UI/UX', 'university-management')),
                        'seminar_time' => um_translate('۱۴۰۳/۰۷/۰۵', __('۱۴۰۳/۰۷/۰۵', 'university-management')),
                        'seminar_teacher' => um_translate('محمد خانی', __('محمد خانی', 'university-management')),
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_218.jpeg'],
                        'seminar_title' => um_translate('React.js', __('React.js', 'university-management')),
                        'seminar_time' => um_translate('۱۴۰۳/۰۷/۱۵', __('۱۴۰۳/۰۷/۱۵', 'university-management')),
                        'seminar_teacher' => um_translate('لیلا نادری', __('لیلا نادری', 'university-management')),
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/61270phototamdid.jpg'],
                        'seminar_title' => um_translate('Python', __('Python', 'university-management')),
                        'seminar_time' => um_translate('۱۴۰۳/۰۸/۰۱', __('۱۴۰۳/۰۸/۰۱', 'university-management')),
                        'seminar_teacher' => um_translate('یاسر کرمی', __('یاسر کرمی', 'university-management')),
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/60261savadabi.jpg'],
                        'seminar_title' => um_translate('DevOps', __('DevOps', 'university-management')),
                        'seminar_time' => um_translate('۱۴۰۳/۰۸/۱۵', __('۱۴۰۳/۰۸/۱۵', 'university-management')),
                        'seminar_teacher' => um_translate('نگین مرادی', __('نگین مرادی', 'university-management')),
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_206.jpeg'],
                        'seminar_title' => 'Docker',
                        'seminar_time' => '۱۴۰۳/۰۹/۰۱',
                        'seminar_teacher' => 'حمیدرضا تهرانی',
                    ]
                ],
                'title_field' => '{{{ seminar_title }}}',
                'condition' => [
                    'seminar_source' => 'manual',
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
                'selector' => '{{WRAPPER}} .um-seminar-slider-widget',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => um_translate('حاشیه کانتینر', __('حاشیه کانتینر', 'university-management')),
                'selector' => '{{WRAPPER}} .um-seminar-slider-widget',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-seminar-slider-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => um_translate('سایه کانتینر', __('سایه کانتینر', 'university-management')),
                'selector' => '{{WRAPPER}} .um-seminar-slider-widget',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => um_translate('فاصله داخلی', __('فاصله داخلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-seminar-slider-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .um-seminar-slider-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Main Title
        $this->start_controls_section(
            'section_style_main_title',
            [
                'label' => um_translate('استایل عنوان اصلی', __('استایل عنوان اصلی', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'main_title_typography',
                'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
                'selector' => '{{WRAPPER}} .main-title',
            ]
        );

        $this->add_control(
            'main_title_text_color',
            [
                'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'main_title_background',
                'label' => um_translate('پس‌زمینه عنوان', __('پس‌زمینه عنوان', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .main-title',
            ]
        );

        $this->add_responsive_control(
            'main_title_padding',
            [
                'label' => um_translate('فاصله داخلی عنوان', __('فاصله داخلی عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_title_margin',
            [
                'label' => um_translate('فاصله خارجی عنوان', __('فاصله خارجی عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'main_title_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های عنوان', __('گردی گوشه‌های عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Seminar Cards
        $this->start_controls_section(
            'section_style_seminar_cards',
            [
                'label' => um_translate('استایل کارت‌های سمینار', __('استایل کارت‌های سمینار', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'seminar_card_background',
                'label' => um_translate('پس‌زمینه کارت', __('پس‌زمینه کارت', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .seminar-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'seminar_card_border',
                'label' => um_translate('حاشیه کارت', __('حاشیه کارت', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-card',
            ]
        );

        $this->add_control(
            'seminar_card_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های کارت', __('گردی گوشه‌های کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'seminar_card_box_shadow',
                'label' => um_translate('سایه کارت', __('سایه کارت', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-card',
            ]
        );

        $this->add_responsive_control(
            'seminar_card_padding',
            [
                'label' => um_translate('فاصله داخلی کارت', __('فاصله داخلی کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'seminar_card_margin',
            [
                'label' => um_translate('فاصله خارجی کارت', __('فاصله خارجی کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Seminar Image
        $this->start_controls_section(
            'section_style_seminar_image',
            [
                'label' => um_translate('استایل تصویر سمینار', __('استایل تصویر سمینار', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'seminar_image_height',
            [
                'label' => um_translate('ارتفاع تصویر', __('ارتفاع تصویر', 'university-management')),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .seminar-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'seminar_image_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های تصویر', __('گردی گوشه‌های تصویر', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'seminar_image_border',
                'label' => um_translate('حاشیه تصویر', __('حاشیه تصویر', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-image img',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'seminar_image_box_shadow',
                'label' => um_translate('سایه تصویر', __('سایه تصویر', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-image img',
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Seminar Title
        $this->start_controls_section(
            'section_style_seminar_title',
            [
                'label' => um_translate('استایل عنوان سمینار', __('استایل عنوان سمینار', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'seminar_title_typography',
                'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-title',
            ]
        );

        $this->add_control(
            'seminar_title_text_color',
            [
                'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seminar-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'seminar_title_margin',
            [
                'label' => um_translate('فاصله عنوان', __('فاصله عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Seminar Details
        $this->start_controls_section(
            'section_style_seminar_details',
            [
                'label' => um_translate('استایل جزئیات سمینار', __('استایل جزئیات سمینار', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'seminar_details_typography',
                'label' => um_translate('تایپوگرافی جزئیات', __('تایپوگرافی جزئیات', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-details',
            ]
        );

        $this->add_control(
            'seminar_details_text_color',
            [
                'label' => um_translate('رنگ جزئیات', __('رنگ جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seminar-details' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'seminar_details_margin',
            [
                'label' => um_translate('فاصله جزئیات', __('فاصله جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Seminar Button
        $this->start_controls_section(
            'section_style_seminar_button',
            [
                'label' => um_translate('استایل دکمه سمینار', __('استایل دکمه سمینار', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'seminar_button_typography',
                'label' => um_translate('تایپوگرافی دکمه', __('تایپوگرافی دکمه', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'seminar_button_background',
                'label' => um_translate('پس‌زمینه دکمه', __('پس‌زمینه دکمه', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .seminar-button',
            ]
        );

        $this->add_control(
            'seminar_button_text_color',
            [
                'label' => um_translate('رنگ متن دکمه', __('رنگ متن دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seminar-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'seminar_button_border',
                'label' => um_translate('حاشیه دکمه', __('حاشیه دکمه', 'university-management')),
                'selector' => '{{WRAPPER}} .seminar-button',
            ]
        );

        $this->add_control(
            'seminar_button_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های دکمه', __('گردی گوشه‌های دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'seminar_button_padding',
            [
                'label' => um_translate('فاصله داخلی دکمه', __('فاصله داخلی دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'seminar_button_margin',
            [
                'label' => um_translate('فاصله خارجی دکمه', __('فاصله خارجی دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .seminar-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Hover state
        $this->add_control(
            'seminar_button_hover_heading',
            [
                'label' => um_translate('حالت هاور', __('حالت هاور', 'university-management')),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'seminar_button_hover_text_color',
            [
                'label' => um_translate('رنگ متن دکمه (هاور)', __('رنگ متن دکمه (هاور)', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seminar-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'seminar_button_hover_background',
                'label' => um_translate('پس‌زمینه دکمه (هاور)', __('پس‌زمینه دکمه (هاور)', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .seminar-button:hover',
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Navigation Arrows
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => um_translate('استایل ناوبری', __('استایل ناوبری', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'navigation_arrow_size',
            [
                'label' => um_translate('اندازه فلش', __('اندازه فلش', 'university-management')),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 2,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 32,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_arrow_color',
            [
                'label' => um_translate('رنگ فلش', __('رنگ فلش', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => um_translate('پس‌زمینه فلش', __('پس‌زمینه فلش', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_arrow_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های فلش', __('گردی گوشه‌های فلش', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Pagination Dots
        $this->start_controls_section(
            'section_style_pagination',
            [
                'label' => um_translate('استایل نقاط pagination', __('استایل نقاط pagination', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pagination_dot_size',
            [
                'label' => um_translate('اندازه نقاط', __('اندازه نقاط', 'university-management')),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 4,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_dot_color',
            [
                'label' => um_translate('رنگ نقاط', __('رنگ نقاط', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_dot_active_color',
            [
                'label' => um_translate('رنگ نقطه فعال', __('رنگ نقطه فعال', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_dot_spacing',
            [
                'label' => um_translate('فاصله نقاط', __('فاصله نقاط', 'university-management')),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_seminar_categories() {
        $categories = get_terms([
            'taxonomy' => 'um_seminar_category',
            'hide_empty' => false,
        ]);

        if (is_wp_error($categories)) {
            return [];
        }

        $options = ['all' => um_translate('همه دسته‌بندی‌ها', __('همه دسته‌بندی‌ها', 'university-management'))];
        foreach ($categories as $category) {
            $options[$category->slug] = $category->name;
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'um-seminar-slider-widget');
        
        $seminars = [];
        if ($settings['seminar_source'] === 'auto') {
            $args = [
                'post_type' => 'um_seminars',
                'posts_per_page' => $settings['posts_per_page'],
                'post_status' => 'publish',
            ];

            if (!empty($settings['seminar_category']) && $settings['seminar_category'] !== 'all') {
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'um_seminar_category',
                        'field' => 'slug',
                        'terms' => $settings['seminar_category'],
                    ],
                ];
            }

            $query = new \WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $seminars[] = [
                        'seminar_image' => ['url' => get_the_post_thumbnail_url(get_the_ID(), 'full')],
                        'seminar_title' => get_the_title(),
                        'seminar_time' => get_post_meta(get_the_ID(), '_seminar_time', true),
                        'seminar_teacher' => get_post_meta(get_the_ID(), '_seminar_teacher', true),
                        'seminar_link' => ['url' => get_post_meta(get_the_ID(), '_seminar_button_link', true) ?: '#'],
                        'seminar_button_text' => get_post_meta(get_the_ID(), '_seminar_button_text', true) ?: 'شروع یادگیری',
                    ];
                }
                wp_reset_postdata();
            }
        } else {
            $seminars = $settings['seminars'];
        }

        if (count($seminars) === 1) {
            $this->add_render_attribute('wrapper', 'class', 'single-seminar');
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="container">
                <div class="header">
                    <h2>
                        <svg width="4" height="34" viewBox="0 0 4 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 2L2 18.9231" stroke="#01ADED" stroke-width="3" stroke-linecap="round"/>
                            <path d="M2 22L2 32" stroke="#9BE4FF" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <div><?php echo nl2br(esc_html($settings['main_title'])); ?></div>
                    </h2>
                    <div class="nav-buttons">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($seminars as $item) :
                        ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($item['seminar_image']['url']); ?>" alt="<?php echo esc_attr($item['seminar_title']); ?>" />
                                <div class="content-wrapper">
                                    <div class="content-info">
                                        <h3><?php echo esc_html($item['seminar_title']); ?></h3>
                                        <div class="info-row">
                                            <svg width="12" height="12" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 2.38379V5.63379H7.9375M10.375 5.63379C10.375 6.27398 10.2489 6.90791 10.0039 7.49937C9.75892 8.09083 9.39983 8.62825 8.94715 9.08093C8.49446 9.53362 7.95704 9.89271 7.36558 10.1377C6.77412 10.3827 6.14019 10.5088 5.5 10.5088C4.85981 10.5088 4.22588 10.3827 3.63442 10.1377C3.04296 9.89271 2.50554 9.53362 2.05285 9.08093C1.60017 8.62825 1.24108 8.09083 0.996087 7.49937C0.751096 6.90791 0.625 6.27398 0.625 5.63379C0.625 4.34086 1.13861 3.10088 2.05285 2.18664C2.96709 1.2724 4.20707 0.758789 5.5 0.758789C6.79293 0.758789 8.03291 1.2724 8.94715 2.18664C9.86139 3.10088 10.375 4.34086 10.375 5.63379Z" stroke="#212179" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span><?php echo esc_html(um_translate('زمان برگزاری:', __('زمان برگزاری:', 'university-management'))); ?></span>
                                            <span style="color:#1e2a78;"><?php echo esc_html($item['seminar_time']); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.87499 3C7.87499 3.49728 7.67744 3.97419 7.32581 4.32583C6.97418 4.67746 6.49727 4.875 5.99999 4.875C5.50271 4.875 5.02579 4.67746 4.67416 4.32583C4.32253 3.97419 4.12499 3.49728 4.12499 3C4.12499 2.50272 4.32253 2.02581 4.67416 1.67417C5.02579 1.32254 5.50271 1.125 5.99999 1.125C6.49727 1.125 6.97418 1.32254 7.32581 1.67417C7.67744 2.02581 7.87499 2.50272 7.87499 3ZM2.25049 10.059C2.26656 9.07518 2.66866 8.13708 3.37008 7.44702C4.0715 6.75696 5.01603 6.37023 5.99999 6.37023C6.98394 6.37023 7.92848 6.75696 8.6299 7.44702C9.33132 8.13708 9.73342 9.07518 9.74949 10.059C8.57318 10.5984 7.29406 10.8768 5.99999 10.875C4.66199 10.875 3.39199 10.583 2.25049 10.059Z" stroke="#212179" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span><?php echo esc_html(um_translate('مدرس:', __('مدرس:', 'university-management'))); ?></span>
                                            <span style="color:#1e2a78;"><?php echo esc_html($item['seminar_teacher']); ?></span>
                                        </div>
                                    </div>
                                    <?php
                                    // بررسی امکان ثبت نام
                                    $seminar_id = 0;
                                    if ($settings['seminar_source'] === 'auto') {
                                        $seminar_id = get_the_ID();
                                    } else {
                                        // برای سمینارهای دستی، از عنوان سمینار برای پیدا کردن ID استفاده کن
                                        if (!empty($item['seminar_title'])) {
                                            $seminar_post = get_page_by_title($item['seminar_title'], OBJECT, 'um_seminars');
                                            if ($seminar_post) {
                                                $seminar_id = $seminar_post->ID;
                                            }
                                        }
                                    }
                                    
                                    // بررسی امکان ثبت نام
                                    if ($seminar_id && function_exists('UM_Seminar_Registration')) {
                                        $registration_manager = new UM_Seminar_Registration();
                                        $can_register = $registration_manager->can_register($seminar_id);
                                        
                                        if ($can_register['can_register']) {
                                            $seminar_price = intval(get_post_meta($seminar_id, '_seminar_price', true));
                                            $button_text = $seminar_price > 0 ? 'اطلاعات بیشتر و ثبت‌نام' : 'اطلاعات بیشتر و ثبت‌نام';
                                            $uid = get_post_meta($seminar_id, '_seminar_uid', true) ?: ('KW-' . $seminar_id);
                                            $detail_url = home_url('/course-detail?Code=' . urlencode($uid));
                                            ?>
                                            <a href="<?php echo esc_url($detail_url); ?>" class="btn-start">
                                                <span><?php echo esc_html($button_text); ?></span>
                                                <i data-lucide="arrow-left"></i>
                                            </a>
                                            <?php
                                        } else {
                                            // نمایش دکمه شروع یادگیری عادی
                                            $button_text = 'شروع یادگیری';
                                            $link_url = get_post_meta($seminar_id, '_seminar_button_link', true);
                                            if (empty($link_url) || $link_url === '#') {
                                                $link_url = !empty($item['seminar_link']['url']) ? esc_url($item['seminar_link']['url']) : '#';
                                            }
                                            
                                            if (empty($link_url) || $link_url === '#') {
                                                // اگر لینک خالی است، دکمه را غیرفعال کن
                                                $button_text = 'به زودی';
                                                ?>
                                                <span class="btn-start" style="background: #ccc; cursor: not-allowed;">
                                                    <span><?php echo esc_html($button_text); ?></span>
                                                    <i data-lucide="arrow-left"></i>
                                                </span>
                                                <?php
                                            } else {
                                                $target = ' target="_blank"';
                                                $nofollow = ' rel="nofollow"';
                                                ?>
                                                <a href="<?php echo esc_url($link_url); ?>" class="btn-start"<?php echo $target; ?><?php echo $nofollow; ?>>
                                                    <span><?php echo esc_html($button_text); ?></span>
                                                    <i data-lucide="arrow-left"></i>
                                                </a>
                                                <?php
                                            }
                                        }
                                    } else {
                                        // برای سمینارهای دستی، همیشه دکمه ثبت نام رایگان نمایش بده
                                        $button_text = 'اطلاعات بیشتر و ثبت‌نام';
                                        $detail_url = '#';
                                        if (!empty($item['seminar_title'])) {
                                            $seminar_post = get_page_by_title($item['seminar_title'], OBJECT, 'um_seminars');
                                            if ($seminar_post) {
                                                $uid = get_post_meta($seminar_post->ID, '_seminar_uid', true) ?: ('KW-' . $seminar_post->ID);
                                                $detail_url = home_url('/course-detail?Code=' . urlencode($uid));
                                            }
                                        }
                                        ?>
                                        <a href="<?php echo esc_url($detail_url); ?>" class="btn-start">
                                            <span><?php echo esc_html($button_text); ?></span>
                                            <i data-lucide="arrow-left"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} 