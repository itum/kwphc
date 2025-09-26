<?php
// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) { exit; }

class UM_Staff_Carousel_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'um_staff_carousel'; }
    public function get_title() { return um_translate('اسلایدر پرسنل', __('اسلایدر پرسنل', 'university-management')); }
    public function get_icon() { return 'eicon-person'; }
    public function get_categories() { return ['university-management']; }
    public function get_script_depends() { return ['swiper', 'um-staff-carousel-widget']; }
    public function get_style_depends() { return ['swiper', 'um-staff-carousel-widget']; }

    protected function _register_controls() {
        $this->start_controls_section('content', ['label' => um_translate('محتوا', __('محتوا','university-management'))]);

        $this->add_control('categories', [
            'label' => um_translate('دسته‌بندی پرسنل', __('دسته‌بندی پرسنل','university-management')),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $this->get_staff_categories(),
        ]);

        $this->add_control('posts_per_page', [
            'label' => um_translate('تعداد نمایش', __('تعداد نمایش','university-management')),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 12,
            'min' => 1,
            'max' => 48,
        ]);

        $this->add_control('show_filter', [
            'label' => um_translate('نمایش فیلتر دسته‌بندی', __('نمایش فیلتر دسته‌بندی','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('show_internal', [
            'label' => um_translate('نمایش داخلی', __('نمایش داخلی','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('show_phone', [
            'label' => um_translate('نمایش شماره تماس', __('نمایش شماره تماس','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('show_name', [
            'label' => um_translate('نمایش نام', __('نمایش نام','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('show_position', [
            'label' => um_translate('نمایش سمت', __('نمایش سمت','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('show_button', [
            'label' => um_translate('نمایش دکمه', __('نمایش دکمه','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('autoplay', [
            'label' => um_translate('پخش خودکار', __('پخش خودکار','university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'no',
        ]);

        $this->add_control('autoplay_delay', [
            'label' => um_translate('تاخیر پخش خودکار (میلی‌ثانیه)', __('تاخیر پخش خودکار (میلی‌ثانیه)','university-management')),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 3000,
            'min' => 1000,
            'max' => 10000,
            'step' => 500,
            'condition' => ['autoplay' => 'yes'],
        ]);

        $this->add_control('button_text', [
            'label' => um_translate('متن دکمه', __('متن دکمه','university-management')),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'اطلاعات بیشتر',
            'placeholder' => 'اطلاعات بیشتر',
        ]);

        $this->add_control('button_icon', [
            'label' => um_translate('آیکون دکمه', __('آیکون دکمه','university-management')),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => '',
                'library' => 'solid',
            ],
        ]);

        $this->end_controls_section();

        // Style: Card
        $this->start_controls_section('style_card', [
            'label' => um_translate('استایل کارت', __('استایل کارت','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('card_background', [
            'label' => um_translate('پس‌زمینه کارت', __('پس‌زمینه کارت','university-management')),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .card' => 'background: {{VALUE}};'
            ],
        ]);

        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'card_border',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .card',
        ]);

        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'card_shadow',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .card',
        ]);

        $this->add_control('card_radius', [
            'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 40]],
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .card' => 'border-radius: {{SIZE}}{{UNIT}};'
            ],
        ]);

        $this->end_controls_section();

        // Style: Name
        $this->start_controls_section('style_name', [
            'label' => um_translate('نام', __('نام','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name' => 'name_typo',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .name',
        ]);

        $this->add_control('name_color', [
            'label' => um_translate('رنگ نام', __('رنگ نام','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .name' => 'color: {{VALUE}};'
            ],
        ]);

        $this->end_controls_section();

        // Style: Position & Meta
        $this->start_controls_section('style_meta', [
            'label' => um_translate('متن جزئیات', __('متن جزئیات','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name' => 'position_typo',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .position, {{WRAPPER}} .um-staff-carousel-widget .meta, {{WRAPPER}} .um-staff-carousel-widget .row',
        ]);

        $this->add_control('position_color', [
            'label' => um_translate('رنگ متن', __('رنگ متن','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .position' => 'color: {{VALUE}};',
                '{{WRAPPER}} .um-staff-carousel-widget .row' => 'color: {{VALUE}};'
            ],
        ]);

        $this->end_controls_section();

        // Style: Button
        $this->start_controls_section('style_button', [
            'label' => um_translate('دکمه', __('دکمه','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name' => 'button_typo',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .btn',
        ]);

        $this->start_controls_tabs('tabs_button_styles');
        $this->start_controls_tab('tab_button_normal', [ 'label' => um_translate('عادی', __('عادی','university-management')) ]);
        $this->add_control('button_color', [
            'label' => um_translate('رنگ متن', __('رنگ متن','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('button_bg', [
            'label' => um_translate('رنگ پس‌زمینه', __('رنگ پس‌زمینه','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn' => 'background: {{VALUE}}; border-color: {{VALUE}};' ],
        ]);
        $this->end_controls_tab();

        $this->start_controls_tab('tab_button_hover', [ 'label' => um_translate('هاور', __('هاور','university-management')) ]);
        $this->add_control('button_color_hover', [
            'label' => um_translate('رنگ متن', __('رنگ متن','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn:hover' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('button_bg_hover', [
            'label' => um_translate('رنگ پس‌زمینه', __('رنگ پس‌زمینه','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn:hover' => 'background: {{VALUE}}; border-color: {{VALUE}};' ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control('button_radius', [
            'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 40]],
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ]);

        $this->add_control('button_icon_size', [
            'label' => um_translate('اندازه آیکون', __('اندازه آیکون','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 10, 'max' => 30]],
            'default' => ['size' => 14, 'unit' => 'px'],
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ]);

        $this->add_control('button_icon_spacing', [
            'label' => um_translate('فاصله آیکون از متن', __('فاصله آیکون از متن','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 20]],
            'default' => ['size' => 6, 'unit' => 'px'],
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .btn' => 'gap: {{SIZE}}{{UNIT}};' ],
        ]);

        $this->end_controls_section();

        // Style: Image
        $this->start_controls_section('style_image', [
            'label' => um_translate('تصویر پرسنل', __('تصویر پرسنل','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('image_height', [
            'label' => um_translate('ارتفاع تصویر', __('ارتفاع تصویر','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 100, 'max' => 400]],
            'default' => ['size' => 220, 'unit' => 'px'],
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .image img' => 'height: {{SIZE}}{{UNIT}};'
            ],
        ]);

        $this->add_control('image_radius', [
            'label' => um_translate('گردی گوشه‌های تصویر', __('گردی گوشه‌های تصویر','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 50]],
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .image img' => 'border-radius: {{SIZE}}{{UNIT}};'
            ],
        ]);

        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'image_border',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .image img',
        ]);

        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'image_shadow',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .image img',
        ]);

        $this->end_controls_section();

        // Style: Filter Buttons
        $this->start_controls_section('style_filter', [
            'label' => um_translate('دکمه‌های فیلتر', __('دکمه‌های فیلتر','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name' => 'filter_typo',
            'selector' => '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button',
        ]);

        $this->start_controls_tabs('tabs_filter_styles');
        $this->start_controls_tab('tab_filter_normal', [ 'label' => um_translate('عادی', __('عادی','university-management')) ]);
        $this->add_control('filter_color', [
            'label' => um_translate('رنگ متن', __('رنگ متن','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('filter_bg', [
            'label' => um_translate('رنگ پس‌زمینه', __('رنگ پس‌زمینه','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button' => 'background: {{VALUE}};' ],
        ]);
        $this->add_control('filter_border_color', [
            'label' => um_translate('رنگ حاشیه', __('رنگ حاشیه','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button' => 'border-color: {{VALUE}};' ],
        ]);
        $this->end_controls_tab();

        $this->start_controls_tab('tab_filter_active', [ 'label' => um_translate('فعال', __('فعال','university-management')) ]);
        $this->add_control('filter_color_active', [
            'label' => um_translate('رنگ متن', __('رنگ متن','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button.active' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('filter_bg_active', [
            'label' => um_translate('رنگ پس‌زمینه', __('رنگ پس‌زمینه','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button.active' => 'background: {{VALUE}};' ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control('filter_radius', [
            'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 40]],
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ]);

        $this->add_control('filter_padding', [
            'label' => um_translate('فاصله داخلی', __('فاصله داخلی','university-management')),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors' => [ '{{WRAPPER}} .um-staff-carousel-widget .um-staff-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        $this->end_controls_section();

        // Style: Navigation Arrows
        $this->start_controls_section('style_arrows', [
            'label' => um_translate('فلش‌های ناوبری', __('فلش‌های ناوبری','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('arrow_size', [
            'label' => um_translate('اندازه فلش', __('اندازه فلش','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 20, 'max' => 60]],
            'default' => ['size' => 32, 'unit' => 'px'],
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-button-next, {{WRAPPER}} .um-staff-carousel-widget .swiper-button-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; margin-top: calc(-{{SIZE}}{{UNIT}} / 2);'
            ],
        ]);

        $this->add_control('arrow_color', [
            'label' => um_translate('رنگ فلش', __('رنگ فلش','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-button-next, {{WRAPPER}} .um-staff-carousel-widget .swiper-button-prev' => 'color: {{VALUE}};'
            ],
        ]);

        $this->add_control('arrow_bg', [
            'label' => um_translate('رنگ پس‌زمینه فلش', __('رنگ پس‌زمینه فلش','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-button-next, {{WRAPPER}} .um-staff-carousel-widget .swiper-button-prev' => 'background: {{VALUE}};'
            ],
        ]);

        $this->add_control('arrow_bg_hover', [
            'label' => um_translate('رنگ پس‌زمینه فلش (هاور)', __('رنگ پس‌زمینه فلش (هاور)','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-button-next:hover, {{WRAPPER}} .um-staff-carousel-widget .swiper-button-prev:hover' => 'background: {{VALUE}};'
            ],
        ]);

        $this->end_controls_section();

        // Style: Pagination Dots
        $this->start_controls_section('style_pagination', [
            'label' => um_translate('نقاط pagination', __('نقاط pagination','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('pagination_spacing', [
            'label' => um_translate('فاصله از کارت‌ها', __('فاصله از کارت‌ها','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 50]],
            'default' => ['size' => 20, 'unit' => 'px'],
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};'
            ],
        ]);

        $this->add_control('pagination_size', [
            'label' => um_translate('اندازه نقاط', __('اندازه نقاط','university-management')),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 4, 'max' => 20]],
            'default' => ['size' => 8, 'unit' => 'px'],
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
            ],
        ]);

        $this->add_control('pagination_color', [
            'label' => um_translate('رنگ نقاط', __('رنگ نقاط','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-pagination-bullet' => 'background: {{VALUE}};'
            ],
        ]);

        $this->add_control('pagination_color_active', [
            'label' => um_translate('رنگ نقطه فعال', __('رنگ نقطه فعال','university-management')),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-staff-carousel-widget .swiper-pagination-bullet-active' => 'background: {{VALUE}};'
            ],
        ]);

        $this->end_controls_section();

        // Import/Export Section
        $this->start_controls_section('import_export', [
            'label' => um_translate('کپی تنظیمات', __('کپی تنظیمات','university-management')),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('export_settings', [
            'label' => um_translate('کپی تنظیمات فعلی', __('کپی تنظیمات فعلی','university-management')),
            'type' => \Elementor\Controls_Manager::RAW_HTML,
            'raw' => '<button type="button" class="elementor-button elementor-button-success" onclick="umExportStaffCarouselSettings(this)">کپی تنظیمات</button>',
        ]);

        $this->add_control('import_settings', [
            'label' => um_translate('وارد کردن تنظیمات', __('وارد کردن تنظیمات','university-management')),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => 'تنظیمات کپی شده را اینجا قرار دهید...',
            'rows' => 4,
        ]);

        $this->add_control('import_button', [
            'label' => um_translate('اعمال تنظیمات', __('اعمال تنظیمات','university-management')),
            'type' => \Elementor\Controls_Manager::RAW_HTML,
            'raw' => '<button type="button" class="elementor-button elementor-button-default" onclick="umImportStaffCarouselSettings(this)">اعمال تنظیمات</button>',
        ]);

        $this->add_control('import_help', [
            'type' => \Elementor\Controls_Manager::RAW_HTML,
            'raw' => '<div style="background: #f0f0f1; padding: 10px; border-radius: 4px; margin-top: 10px;">
                <strong>راهنمای استفاده:</strong><br>
                1. تنظیمات ویجت را کپی کنید<br>
                2. در ویجت جدید، تنظیمات کپی شده را در فیلد بالا قرار دهید<br>
                3. روی "اعمال تنظیمات" کلیک کنید
            </div>',
        ]);

        $this->end_controls_section();
    }

    private function get_staff_categories() {
        $terms = get_terms(['taxonomy' => 'um_staff_category', 'hide_empty' => false]);
        if (is_wp_error($terms)) { return []; }
        $opts = [];
        foreach ($terms as $t) { $opts[$t->slug] = $t->name; }
        return $opts;
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $args = [
            'post_type' => 'um_staff',
            'posts_per_page' => !empty($s['posts_per_page']) ? intval($s['posts_per_page']) : 12,
            'post_status' => 'publish',
        ];
        if (!empty($s['categories'])) {
            $args['tax_query'] = [[
                'taxonomy' => 'um_staff_category',
                'field' => 'slug',
                'terms' => (array)$s['categories'],
            ]];
        }

        $q = new WP_Query($args);

        $all_terms = get_terms(['taxonomy'=>'um_staff_category','hide_empty'=>true]);

        echo '<div class="um-staff-carousel-widget" data-settings=\'' . json_encode([
            'autoplay' => $s['autoplay'] ?? 'no',
            'autoplay_delay' => $s['autoplay_delay'] ?? 3000,
        ]) . '\'>';
        if ('yes' === $s['show_filter'] && !is_wp_error($all_terms)) {
            echo '<div class="um-staff-filter">';
            echo '<button class="active" data-term="all">' . esc_html__('همه', 'university-management') . '</button>';
            foreach ($all_terms as $t) {
                echo '<button data-term="' . esc_attr($t->slug) . '">' . esc_html($t->name) . '</button>';
            }
            echo '</div>';
        }

        echo '<div class="swiper"><div class="swiper-wrapper">';
        if ($q->have_posts()) {
            while ($q->have_posts()) { $q->the_post();
                $id = get_the_ID();
                $first = get_post_meta($id, 'staff_first_name', true);
                $last = get_post_meta($id, 'staff_last_name', true);
                // Get position from first assigned category name
                $position = '';
                $internal = get_post_meta($id, 'staff_internal', true);
                $phone = get_post_meta($id, 'staff_phone', true);
                $name = trim($first . ' ' . $last);
                $img = get_the_post_thumbnail_url($id, 'medium_large');
                if (!$img) { $img = plugins_url('assets/images/video-placeholder.jpg', dirname(__FILE__,2)); }
                $link = get_permalink($id);
                $terms = wp_get_post_terms($id, 'um_staff_category');
                $term_attr = '';
                if (!is_wp_error($terms) && !empty($terms)) {
                    $term_attr = implode(' ', wp_list_pluck($terms, 'slug'));
                    $position = $terms[0]->name; // first category as position
                }

                echo '<div class="swiper-slide" data-terms="' . esc_attr($term_attr) . '">';
                echo '<div class="card">';
                echo '<div class="image"><img src="' . esc_url($img) . '" alt="' . esc_attr($name) . '"></div>';
                echo '<div class="content">';
                if ('yes' === $s['show_name']) {
                    echo '<h3 class="name">' . esc_html($name ?: get_the_title()) . '</h3>';
                }
                if ('yes' === $s['show_position'] && !empty($position)) { 
                    echo '<div class="position">' . esc_html($position) . '</div>'; 
                }
                echo '<div class="meta">';
                if ('yes' === $s['show_phone'] && !empty($phone)) {
                    echo '<div class="row"><span>تلفن:</span><a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a></div>';
                }
                if ('yes' === $s['show_internal'] && !empty($internal)) {
                    echo '<div class="row"><span>داخلی:</span><span>' . esc_html($internal) . '</span></div>';
                }
                echo '</div>';
                if ('yes' === $s['show_button']) {
                    $button_text = !empty($s['button_text']) ? $s['button_text'] : 'اطلاعات بیشتر';
                    $button_icon = !empty($s['button_icon']['value']) ? \Elementor\Icons_Manager::render_icon($s['button_icon'], ['aria-hidden' => 'true']) : '';
                    echo '<a class="btn" href="' . esc_url($link) . '">';
                    if ($button_icon) {
                        echo '<span class="btn-icon">' . $button_icon . '</span>';
                    }
                    echo '<span class="btn-text">' . esc_html($button_text) . '</span>';
                    echo '</a>';
                }
                echo '</div></div>';
                echo '</div>';
            }
            wp_reset_postdata();
        }
        echo '</div><div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
        echo '</div>';
    }
}


