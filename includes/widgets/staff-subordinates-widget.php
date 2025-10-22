<?php
// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

class UM_Staff_Subordinates_Widget extends \Elementor\Widget_Base {

    public function get_name() { 
        return 'um_staff_subordinates'; 
    }
    
    public function get_title() { 
        return um_translate('زیر مجموعه پرسنل', __('زیر مجموعه پرسنل', 'university-management')); 
    }
    
    public function get_icon() { 
        return 'eicon-person'; 
    }
    
    public function get_categories() { 
        return ['university-management']; 
    }
    
    public function get_script_depends() { 
        return []; 
    }
    
    public function get_style_depends() { 
        return ['um-staff-subordinates-widget']; 
    }

    protected function _register_controls() {
        $this->start_controls_section('content', [
            'label' => um_translate('محتوا', __('محتوا', 'university-management'))
        ]);

        $this->add_control('title', [
            'label' => um_translate('عنوان', __('عنوان', 'university-management')),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
        ]);

        $this->add_control('staff_id', [
            'label' => um_translate('ID پرسنل (اختیاری برای صفحات غیر تکی)', __('ID پرسنل (اختیاری برای صفحات غیر تکی)', 'university-management')),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 0,
            'description' => um_translate('برای نمایش در صفحات غیر تکی پرسنل، ID پرسنل مورد نظر را وارد کنید', __('برای نمایش در صفحات غیر تکی پرسنل، ID پرسنل مورد نظر را وارد کنید', 'university-management')),
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
				'selector' => '{{WRAPPER}} .um-staff-subordinates',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'label' => um_translate('حاشیه کانتینر', __('حاشیه کانتینر', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-subordinates',
			]
		);

		$this->add_control(
			'container_border_radius',
			[
				'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-subordinates' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'container_box_shadow',
				'label' => um_translate('سایه کانتینر', __('سایه کانتینر', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-subordinates',
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label' => um_translate('فاصله داخلی', __('فاصله داخلی', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-subordinates' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .um-staff-subordinates' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Title
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => um_translate('استایل عنوان', __('استایل عنوان', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-subordinates-title',
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-staff-subordinates-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'label' => um_translate('پس‌زمینه عنوان', __('پس‌زمینه عنوان', 'university-management')),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .um-staff-subordinates-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => um_translate('فاصله داخلی عنوان', __('فاصله داخلی عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-subordinates-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => um_translate('فاصله خارجی عنوان', __('فاصله خارجی عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-subordinates-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های عنوان', __('گردی گوشه‌های عنوان', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-subordinates-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Staff Cards
		$this->start_controls_section(
			'section_style_staff_cards',
			[
				'label' => um_translate('استایل کارت‌های پرسنل', __('استایل کارت‌های پرسنل', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'card_background',
				'label' => um_translate('پس‌زمینه کارت', __('پس‌زمینه کارت', 'university-management')),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .um-staff-sub-card',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'label' => um_translate('حاشیه کارت', __('حاشیه کارت', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-card',
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های کارت', __('گردی گوشه‌های کارت', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'label' => um_translate('سایه کارت', __('سایه کارت', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-card',
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label' => um_translate('فاصله داخلی کارت', __('فاصله داخلی کارت', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_margin',
			[
				'label' => um_translate('فاصله خارجی کارت', __('فاصله خارجی کارت', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Staff Name
		$this->start_controls_section(
			'section_style_staff_name',
			[
				'label' => um_translate('استایل نام پرسنل', __('استایل نام پرسنل', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'staff_name_typography',
				'label' => um_translate('تایپوگرافی نام', __('تایپوگرافی نام', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-name',
			]
		);

		$this->add_control(
			'staff_name_text_color',
			[
				'label' => um_translate('رنگ نام', __('رنگ نام', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'staff_name_margin',
			[
				'label' => um_translate('فاصله نام', __('فاصله نام', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Staff Position
		$this->start_controls_section(
			'section_style_staff_position',
			[
				'label' => um_translate('استایل سمت پرسنل', __('استایل سمت پرسنل', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'staff_position_typography',
				'label' => um_translate('تایپوگرافی سمت', __('تایپوگرافی سمت', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-pos',
			]
		);

		$this->add_control(
			'staff_position_text_color',
			[
				'label' => um_translate('رنگ سمت', __('رنگ سمت', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-pos' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'staff_position_margin',
			[
				'label' => um_translate('فاصله سمت', __('فاصله سمت', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-pos' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Staff Contact
		$this->start_controls_section(
			'section_style_staff_contact',
			[
				'label' => um_translate('استایل اطلاعات تماس', __('استایل اطلاعات تماس', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'staff_contact_typography',
				'label' => um_translate('تایپوگرافی تماس', __('تایپوگرافی تماس', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-contact',
			]
		);

		$this->add_control(
			'staff_contact_text_color',
			[
				'label' => um_translate('رنگ تماس', __('رنگ تماس', 'university-management')),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-contact' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'staff_contact_margin',
			[
				'label' => um_translate('فاصله تماس', __('فاصله تماس', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-contact' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// بخش استایل - Staff Image
		$this->start_controls_section(
			'section_style_staff_image',
			[
				'label' => um_translate('استایل تصویر پرسنل', __('استایل تصویر پرسنل', 'university-management')),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'staff_image_border_radius',
			[
				'label' => um_translate('گردی گوشه‌های تصویر', __('گردی گوشه‌های تصویر', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'staff_image_border',
				'label' => um_translate('حاشیه تصویر', __('حاشیه تصویر', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-img',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'staff_image_box_shadow',
				'label' => um_translate('سایه تصویر', __('سایه تصویر', 'university-management')),
				'selector' => '{{WRAPPER}} .um-staff-sub-img',
			]
		);

		$this->add_responsive_control(
			'staff_image_margin',
			[
				'label' => um_translate('فاصله تصویر', __('فاصله تصویر', 'university-management')),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .um-staff-sub-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title = isset($settings['title']) ? $settings['title'] : '';
        $post_id = 0;
        
        if (is_singular('um_staff')) {
            $post_id = get_queried_object_id();
        } elseif (!empty($settings['staff_id'])) {
            $post_id = intval($settings['staff_id']);
        }

        $rows = $post_id ? get_post_meta($post_id, '_um_staff_subordinates', true) : [];
        
        // Debug output (remove in production)
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<!-- Debug: Post ID = ' . $post_id . ' -->';
            echo '<!-- Debug: Rows = ' . print_r($rows, true) . ' -->';
        }
        
        if (!is_array($rows) || empty($rows)) {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                echo '<!-- Debug: No rows found or empty array -->';
            }
            return;
        }

        if ($title) {
            echo '<h3 class="um-staff-subordinates-title">' . esc_html($title) . '</h3>';
        }
        
        echo '<div class="um-staff-subordinates">';
        
        foreach($rows as $r) {
            $first_name = isset($r['first_name']) ? $r['first_name'] : '';
            $last_name = isset($r['last_name']) ? $r['last_name'] : '';
            $alt_text = trim($first_name . ' ' . $last_name);
            
            $img = !empty($r['image_id']) ? wp_get_attachment_image(intval($r['image_id']), 'thumbnail', false, array(
                'class' => 'um-staff-sub-img',
                'alt' => esc_attr($alt_text)
            )) : '';
            
            $full = trim(esc_html($first_name . ' ' . $last_name));
            $pos  = esc_html(isset($r['position']) ? $r['position'] : '');
            $phone = esc_html(isset($r['phone']) ? $r['phone'] : '');
            $int  = esc_html(isset($r['internal']) ? $r['internal'] : '');
            
            $card = '<div class="um-staff-sub-card">';
            $card .= '<div class="um-staff-sub-photo">' . ($img ?: '<span class="um-staff-sub-noimg"></span>') . '</div>';
            $card .= '<div class="um-staff-sub-body">';
            $card .= $full ? '<div class="um-staff-sub-name">' . $full . '</div>' : '';
            $card .= $pos  ? '<div class="um-staff-sub-pos">' . $pos . '</div>' : '';
            $card .= ($phone || $int) ? '<div class="um-staff-sub-contact">' . 
                ($phone ? '<span class="tel">' . $phone . '</span>' : '') . 
                ($int ? ' • <span class="ext">' . $int . '</span>' : '') . 
                '</div>' : '';
            $card .= '</div></div>';
            
            echo apply_filters('um_staff_subordinates_card_html', $card, $r, $post_id);
        }
        
        echo '</div>';
    }
}
