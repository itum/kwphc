<?php
/**
 * ویجت اسلایدها (هماهنگ با المنتور پیشفرض) اما خواندن خودکار از پست‌تایپ um_slides
 */

if (!defined('ABSPATH')) { exit; }

class UM_Slides_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'um_slides';
    }

    public function get_title() {
        return um_translate('اسلایدهای سایت', __('اسلایدهای سایت', 'university-management'));
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['university-management'];
    }

    public function get_script_depends() {
        return ['swiper', 'um-slides-widget'];
    }

    public function get_style_depends() {
        return ['swiper', 'um-slides-widget'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => um_translate('محتوا', __('محتوا', 'university-management')),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('source', [
            'label' => um_translate('منبع اسلایدها', __('منبع اسلایدها', 'university-management')),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'auto',
            'options' => [
                'auto' => um_translate('خودکار (از پست‌تایپ)', __('خودکار (از پست‌تایپ)', 'university-management')),
                'manual' => um_translate('دستی', __('دستی', 'university-management')),
            ],
        ]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('image', [
            'label' => __('تصویر', 'university-management'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);
        $repeater->add_control('title', [
            'label' => __('عنوان', 'university-management'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('عنوان اسلاید', 'university-management'),
        ]);
        $repeater->add_control('description', [
            'label' => __('توضیحات', 'university-management'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 3,
        ]);
        $repeater->add_control('button_text', [
            'label' => __('متن دکمه', 'university-management'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('بیشتر', 'university-management'),
        ]);
        $repeater->add_control('link', [
            'label' => __('لینک', 'university-management'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => 'https://',
        ]);

        $this->add_control('slides', [
            'label' => __('اسلایدها', 'university-management'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
            'condition' => [ 'source' => 'manual' ],
        ]);

        $this->add_control('posts_per_page', [
            'label' => __('تعداد نمایش', 'university-management'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5,
            'min' => 1,
            'max' => 20,
            'condition' => [ 'source' => 'auto' ],
        ]);

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
				'selector' => '{{WRAPPER}} .um-slides-widget',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'label' => um_translate('حاشیه کانتینر', __('حاشیه کانتینر', 'university-management')),
				'selector' => '{{WRAPPER}} .um-slides-widget',
			]
		);

		$this->add_control(
			'container_border_radius',
			[
				'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slides-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'container_box_shadow',
				'label' => um_translate('سایه کانتینر', __('سایه کانتینر', 'university-management')),
				'selector' => '{{WRAPPER}} .um-slides-widget',
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label' => um_translate('فاصله داخلی', __('فاصله داخلی', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slides-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .um-slides-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Slide Content
		$this->start_controls_section(
			'section_style_slide_content',
			[
				'label' => um_translate('استایل محتوای اسلاید', __('استایل محتوای اسلاید', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slide_content_background',
				'label' => um_translate('پس‌زمینه محتوا', __('پس‌زمینه محتوا', 'university-management')),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .um-slide-content',
			]
		);

		$this->add_responsive_control(
			'slide_content_padding',
			[
				'label' => um_translate('فاصله داخلی محتوا', __('فاصله داخلی محتوا', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slide_content_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های محتوا', __('گردی گوشه‌های محتوا', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Slide Title
		$this->start_controls_section(
			'section_style_slide_title',
			[
				'label' => um_translate('استایل عنوان اسلاید', __('استایل عنوان اسلاید', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_title_typography',
				'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
				'selector' => '{{WRAPPER}} .um-slide-content h3',
			]
		);

		$this->add_control(
			'slide_title_text_color',
			[
				'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-slide-content h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slide_title_background',
				'label' => um_translate('پس‌زمینه عنوان', __('پس‌زمینه عنوان', 'university-management')),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .um-slide-content h3',
			]
		);

		$this->add_responsive_control(
			'slide_title_padding',
			[
				'label' => um_translate('فاصله داخلی عنوان', __('فاصله داخلی عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_title_margin',
			[
				'label' => um_translate('فاصله خارجی عنوان', __('فاصله خارجی عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slide_title_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های عنوان', __('گردی گوشه‌های عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-content h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Slide Description
		$this->start_controls_section(
			'section_style_slide_description',
			[
				'label' => um_translate('استایل توضیحات اسلاید', __('استایل توضیحات اسلاید', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_description_typography',
				'label' => um_translate('تایپوگرافی توضیحات', __('تایپوگرافی توضیحات', 'university-management')),
				'selector' => '{{WRAPPER}} .um-slide-content p',
			]
		);

		$this->add_control(
			'slide_description_text_color',
			[
				'label' => um_translate('رنگ توضیحات', __('رنگ توضیحات', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-slide-content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_description_margin',
			[
				'label' => um_translate('فاصله توضیحات', __('فاصله توضیحات', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Slide Button
		$this->start_controls_section(
			'section_style_slide_button',
			[
				'label' => um_translate('استایل دکمه اسلاید', __('استایل دکمه اسلاید', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_button_typography',
				'label' => um_translate('تایپوگرافی دکمه', __('تایپوگرافی دکمه', 'university-management')),
				'selector' => '{{WRAPPER}} .um-slide-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slide_button_background',
				'label' => um_translate('پس‌زمینه دکمه', __('پس‌زمینه دکمه', 'university-management')),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .um-slide-btn',
			]
		);

		$this->add_control(
			'slide_button_text_color',
			[
				'label' => um_translate('رنگ متن دکمه', __('رنگ متن دکمه', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-slide-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'slide_button_border',
				'label' => um_translate('حاشیه دکمه', __('حاشیه دکمه', 'university-management')),
				'selector' => '{{WRAPPER}} .um-slide-btn',
			]
		);

		$this->add_control(
			'slide_button_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های دکمه', __('گردی گوشه‌های دکمه', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_button_padding',
			[
				'label' => um_translate('فاصله داخلی دکمه', __('فاصله داخلی دکمه', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_button_margin',
			[
				'label' => um_translate('فاصله خارجی دکمه', __('فاصله خارجی دکمه', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-slide-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Hover state
		$this->add_control(
			'slide_button_hover_heading',
			[
				'label' => um_translate('حالت هاور', __('حالت هاور', 'university-management')),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slide_button_hover_text_color',
			[
				'label' => um_translate('رنگ متن دکمه (هاور)', __('رنگ متن دکمه (هاور)', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-slide-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slide_button_hover_background',
				'label' => um_translate('پس‌زمینه دکمه (هاور)', __('پس‌زمینه دکمه (هاور)', 'university-management')),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .um-slide-btn:hover',
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
				'label' => um_translate('اندازه فلش‌ها', __('اندازه فلش‌ها', 'university-management')),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'navigation_arrow_color',
			[
				'label' => um_translate('رنگ فلش‌ها', __('رنگ فلش‌ها', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_arrow_background',
			[
				'label' => um_translate('پس‌زمینه فلش‌ها', __('پس‌زمینه فلش‌ها', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'navigation_arrow_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های فلش‌ها', __('گردی گوشه‌های فلش‌ها', 'university-management')),
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
				'label' => um_translate('استایل نقاط صفحه‌بندی', __('استایل نقاط صفحه‌بندی', 'university-management')),
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
						'min' => 5,
						'max' => 30,
						'step' => 1,
					],
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
				'label' => um_translate('فاصله بین نقاط', __('فاصله بین نقاط', 'university-management')),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
    }

    private function get_cpt_slides($limit = 5) {
        $args = array(
            'post_type' => 'um_slides',
            'posts_per_page' => $limit,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_status' => 'publish',
        );
        if (function_exists('pll_current_language')) {
            $args['lang'] = pll_current_language();
        }
        $query = new WP_Query($args);
        $items = [];
        while ($query->have_posts()) { $query->the_post();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $items[] = [
                'image' => $image,
                'title' => get_post_meta(get_the_ID(), '_slide_caption', true),
                'description' => get_post_meta(get_the_ID(), '_slide_caption', true),
                'button_text' => get_post_meta(get_the_ID(), '_slide_button_text', true),
                'link' => [ 'url' => get_post_meta(get_the_ID(), '_slide_link_url', true), 'is_external' => (bool)get_post_meta(get_the_ID(), '_slide_open_new', true) ],
            ];
        }
        wp_reset_postdata();
        return $items;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $slides = [];
        if ($settings['source'] === 'auto') {
            $slides = $this->get_cpt_slides(!empty($settings['posts_per_page']) ? intval($settings['posts_per_page']) : 5);
        } else {
            $slides = $settings['slides'];
        }

        if (empty($slides)) {
            echo '<div class="um-slides-empty">' . esc_html__('اسلایدی یافت نشد.', 'university-management') . '</div>';
            return;
        }

        echo '<div class="um-slides-widget swiper">';
        echo '<div class="swiper-wrapper">';
        foreach ($slides as $slide) {
            $image = is_array($slide) && isset($slide['image']['url']) ? $slide['image']['url'] : (isset($slide['image']) ? $slide['image'] : '');
            $title = isset($slide['title']) ? $slide['title'] : '';
            $desc = isset($slide['description']) ? $slide['description'] : '';
            $btn = isset($slide['button_text']) ? $slide['button_text'] : '';
            $link = isset($slide['link']['url']) ? $slide['link']['url'] : (isset($slide['link']) ? $slide['link'] : '');
            $ext = isset($slide['link']['is_external']) ? (bool)$slide['link']['is_external'] : false;

            echo '<div class="swiper-slide um-slide-item" style="background-image:url(' . esc_url($image) . ');">';
            echo '<div class="um-slide-content">';
            if ($title) echo '<h3>' . esc_html($title) . '</h3>';
            if ($desc) echo '<p>' . esc_html($desc) . '</p>';
            if ($btn && $link) {
                $target = $ext ? ' target="_blank" rel="noopener"' : '';
                echo '<a class="um-slide-btn" href="' . esc_url($link) . '"' . $target . '>' . esc_html($btn) . '</a>';
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="swiper-pagination"></div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
        echo '</div>';

        ?>
        <script>
        (function(){
            if (window.Swiper) {
                new Swiper('.um-slides-widget', { loop: true, pagination: { el: '.swiper-pagination', clickable: true }, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' } });
            }
        })();
        </script>
        <?php
    }
}


