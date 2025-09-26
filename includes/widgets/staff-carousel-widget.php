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

        echo '<div class="um-staff-carousel-widget">';
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
                $position = get_post_meta($id, 'staff_position', true);
                $internal = get_post_meta($id, 'staff_internal', true);
                $phone = get_post_meta($id, 'staff_phone', true);
                $name = trim($first . ' ' . $last);
                $img = get_the_post_thumbnail_url($id, 'medium_large');
                if (!$img) { $img = plugins_url('assets/images/video-placeholder.jpg', dirname(__FILE__,2)); }
                $link = get_permalink($id);
                $terms = wp_get_post_terms($id, 'um_staff_category', ['fields'=>'slugs']);
                $term_attr = !is_wp_error($terms) ? implode(' ', $terms) : '';

                echo '<div class="swiper-slide" data-terms="' . esc_attr($term_attr) . '">';
                echo '<div class="card">';
                echo '<div class="image"><img src="' . esc_url($img) . '" alt="' . esc_attr($name) . '"></div>';
                echo '<div class="content">';
                echo '<h3 class="name">' . esc_html($name ?: get_the_title()) . '</h3>';
                if (!empty($position)) {
                    echo '<div class="position">' . esc_html($position) . '</div>';
                }
                echo '<div class="meta">';
                if (!empty($internal)) {
                    echo '<div class="row"><span>داخلی:</span><span>' . esc_html($internal) . '</span></div>';
                }
                if (!empty($phone)) {
                    echo '<div class="row"><span>تلفن:</span><a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a></div>';
                }
                echo '</div>';
                echo '<a class="btn" href="' . esc_url($link) . '">' . esc_html__('اطلاعات بیشتر', 'university-management') . '</a>';
                echo '</div></div>';
                echo '</div>';
            }
            wp_reset_postdata();
        }
        echo '</div><div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
        echo '</div>';
    }
}


