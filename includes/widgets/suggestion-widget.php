<?php
/**
 * ویجت پیشنهادات و انتقادات برای المنتور
 */

if (!defined('ABSPATH')) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class UM_Suggestion_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'um_suggestion_widget'; }
    public function get_title() { return __('فرم پیشنهادات و انتقادات', 'university-management'); }
    public function get_icon() { return 'eicon-comments'; }
    public function get_categories() { return array('university-management'); }

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('تنظیمات فرم', 'university-management')
        ]);

        // recipient dropdown (comma separated options)
        $this->add_control('recipients', [
            'label' => __('گزارش گیرندگان (هر خط یک گزینه)', 'university-management'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => "-\nریاست\nمعاونت آموزشی و فرهنگی\nمعاونت مالی و پشتیبانی\nمدیر دفتر پژوهش و فناوری\nحراست و امور محرمانه",
        ]);

        // recipient label
        $this->add_control('recipient_label', [
            'label' => __('متن فیلد انتخاب گیرنده', 'university-management'),
            'type' => Controls_Manager::TEXT,
            'default' => __('انتخاب گیرنده', 'university-management'),
        ]);

        // name field label and required
        $this->add_control('name_label', [
            'label' => __('متن فیلد نام', 'university-management'),
            'type' => Controls_Manager::TEXT,
            'default' => __('نام و نام خانوادگی', 'university-management'),
        ]);
        $this->add_control('name_required', [
            'label' => __('الزامی بودن فیلد نام', 'university-management'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('بله','university-management'),
            'label_off' => __('خیر','university-management'),
            'return_value' => '1',
            'default' => '1'
        ]);

        // title field
        $this->add_control('title_label', [
            'label' => __('متن فیلد عنوان', 'university-management'),
            'type' => Controls_Manager::TEXT,
            'default' => __('عنوان', 'university-management'),
        ]);
        $this->add_control('title_required', [
            'label' => __('الزامی بودن فیلد عنوان', 'university-management'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => '1',
            'default' => '1'
        ]);

        // phone field
        $this->add_control('phone_label', [
            'label' => __('متن فیلد شماره تماس', 'university-management'),
            'type' => Controls_Manager::TEXT,
            'default' => __('شماره تماس', 'university-management'),
        ]);
        $this->add_control('phone_required', [
            'label' => __('الزامی بودن فیلد شماره تماس', 'university-management'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => '1',
            'default' => '1'
        ]);

        // message field
        $this->add_control('message_label', [
            'label' => __('متن فیلد توضیحات', 'university-management'),
            'type' => Controls_Manager::TEXT,
            'default' => __('پیام شما', 'university-management'),
        ]);
        $this->add_control('message_required', [
            'label' => __('الزامی بودن فیلد پیام', 'university-management'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => '1',
            'default' => '1'
        ]);

        $this->end_controls_section();

        // Style controls
        $this->start_controls_section('style_section', [
            'label' => __('استایل', 'university-management'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        // Labels
        $this->add_control('labels_heading', [
            'label' => __('برچسب‌ها', 'university-management'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control('label_color', [
            'label' => __('رنگ برچسب', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form label' => 'color: {{VALUE}};',
            ],
            'default' => '',
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'label_typography',
            'selector' => '{{WRAPPER}} .um-suggestion-form label',
            'fields_options' => [
                'font_family' => [
                    'default' => 'peyda',
                ],
            ],
        ]);

        // Inputs
        $this->add_control('inputs_heading', [
            'label' => __('فیلدها', 'university-management'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'input_typography',
            'selector' => '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea, {{WRAPPER}} .um-suggestion-form button',
            'fields_options' => [
                'font_family' => [
                    'default' => 'peyda',
                ],
            ],
        ]);
        $this->add_control('input_text_color', [
            'label' => __('رنگ متن فیلد', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'color: {{VALUE}};',
            ],
        ]);
        $this->add_control('input_bg_color', [
            'label' => __('رنگ پس‌زمینه فیلد', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'background-color: {{VALUE}};',
            ],
        ]);
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'input_border',
            'selector' => '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea',
        ]);
        $this->add_control('input_border_radius', [
            'label' => __('گوشه‌ها', 'university-management'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_control('input_padding', [
            'label' => __('پدینگ فیلد', 'university-management'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'input_shadow',
            'selector' => '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea',
        ]);

        // Layout
        $this->add_control('fields_gap', [
            'label' => __('فاصله بین فیلدها', 'university-management'),
            'type' => Controls_Manager::SLIDER,
            'range' => [ 'px' => [ 'min' => 0, 'max' => 48 ] ],
            'default' => [ 'size' => 16, 'unit' => 'px' ],
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form .um-fields' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Button
        $this->add_control('button_heading', [
            'label' => __('دکمه ارسال', 'university-management'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->start_controls_tabs('button_tabs');
        $this->start_controls_tab('button_normal', [ 'label' => __('عادی', 'university-management') ]);
        $this->add_control('button_text_color', [
            'label' => __('رنگ متن', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('button_bg_color', [
            'label' => __('پس‌زمینه', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'background-color: {{VALUE}};' ],
        ]);
        $this->end_controls_tab();
        $this->start_controls_tab('button_hover', [ 'label' => __('هاور', 'university-management') ]);
        $this->add_control('button_text_color_hover', [
            'label' => __('رنگ متن', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-suggestion-form button[type="submit"]:hover' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('button_bg_color_hover', [
            'label' => __('پس‌زمینه', 'university-management'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .um-suggestion-form button[type="submit"]:hover' => 'background-color: {{VALUE}};' ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'button_border',
            'selector' => '{{WRAPPER}} .um-suggestion-form button[type="submit"]',
        ]);
        $this->add_control('button_border_radius', [
            'label' => __('گوشه‌های دکمه', 'university-management'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_control('button_padding', [
            'label' => __('پدینگ دکمه', 'university-management'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // بخش استایل - Container
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => __('استایل کانتینر', 'university-management'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => __('پس‌زمینه کانتینر', 'university-management'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .um-suggestion-form',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => __('حاشیه کانتینر', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => __('گردی گوشه‌ها', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => __('سایه کانتینر', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __('فاصله داخلی', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => __('فاصله خارجی', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Form Fields
        $this->start_controls_section(
            'section_style_form_fields',
            [
                'label' => __('استایل فیلدهای فرم', 'university-management'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'form_fields_typography',
                'label' => __('تایپوگرافی فیلدها', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea',
            ]
        );

        $this->add_control(
            'form_fields_text_color',
            [
                'label' => __('رنگ متن فیلدها', 'university-management'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'form_fields_background_color',
            [
                'label' => __('رنگ پس‌زمینه فیلدها', 'university-management'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'form_fields_border',
                'label' => __('حاشیه فیلدها', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea',
            ]
        );

        $this->add_control(
            'form_fields_border_radius',
            [
                'label' => __('گردی گوشه‌های فیلدها', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_fields_padding',
            [
                'label' => __('فاصله داخلی فیلدها', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form input, {{WRAPPER}} .um-suggestion-form select, {{WRAPPER}} .um-suggestion-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_fields_margin',
            [
                'label' => __('فاصله خارجی فیلدها', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form .form-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Form Labels
        $this->start_controls_section(
            'section_style_form_labels',
            [
                'label' => __('استایل برچسب‌های فرم', 'university-management'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'form_labels_typography',
                'label' => __('تایپوگرافی برچسب‌ها', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form label',
            ]
        );

        $this->add_control(
            'form_labels_text_color',
            [
                'label' => __('رنگ برچسب‌ها', 'university-management'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_labels_margin',
            [
                'label' => __('فاصله برچسب‌ها', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Submit Button
        $this->start_controls_section(
            'section_style_submit_button',
            [
                'label' => __('استایل دکمه ارسال', 'university-management'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'submit_button_typography',
                'label' => __('تایپوگرافی دکمه', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form button[type="submit"]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'submit_button_background',
                'label' => __('پس‌زمینه دکمه', 'university-management'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .um-suggestion-form button[type="submit"]',
            ]
        );

        $this->add_control(
            'submit_button_text_color',
            [
                'label' => __('رنگ متن دکمه', 'university-management'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submit_button_border',
                'label' => __('حاشیه دکمه', 'university-management'),
                'selector' => '{{WRAPPER}} .um-suggestion-form button[type="submit"]',
            ]
        );

        $this->add_control(
            'submit_button_border_radius',
            [
                'label' => __('گردی گوشه‌های دکمه', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_button_padding',
            [
                'label' => __('فاصله داخلی دکمه', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_button_margin',
            [
                'label' => __('فاصله خارجی دکمه', 'university-management'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form button[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Hover state
        $this->add_control(
            'submit_button_hover_heading',
            [
                'label' => __('حالت هاور', 'university-management'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submit_button_hover_text_color',
            [
                'label' => __('رنگ متن دکمه (هاور)', 'university-management'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-suggestion-form button[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'submit_button_hover_background',
                'label' => __('پس‌زمینه دکمه (هاور)', 'university-management'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .um-suggestion-form button[type="submit"]:hover',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $recipients = array_filter(array_map('trim', explode("\n", $settings['recipients'])));
        $recipients_options = array();
        foreach ($recipients as $r) { $recipients_options[] = esc_html($r); }

        // output simple form (frontend JS will handle submission)
        ?>
        <form class="um-suggestion-form" method="post">
            <div class="um-fields">
                <div class="um-field">
                    <label><?php echo esc_html($settings['recipient_label']); ?><?php if ($settings['message_required']) echo ' *'; ?></label>
                    <select name="um_sugg_recipient">
                        <?php foreach ($recipients_options as $opt) : ?>
                            <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="um-field">
                    <label><?php echo esc_html($settings['name_label']); ?><?php if ($settings['name_required']) echo ' *'; ?></label>
                    <input type="text" name="um_sugg_name" <?php echo $settings['name_required'] ? 'required' : ''; ?> />
                </div>
                <div class="um-field">
                    <label><?php echo esc_html($settings['phone_label']); ?><?php if ($settings['phone_required']) echo ' *'; ?></label>
                    <input type="text" name="um_sugg_phone" <?php echo $settings['phone_required'] ? 'required' : ''; ?> />
                </div>
                <div class="um-field">
                    <label><?php echo esc_html($settings['title_label']); ?><?php if ($settings['title_required']) echo ' *'; ?></label>
                    <input type="text" name="um_sugg_title" <?php echo $settings['title_required'] ? 'required' : ''; ?> />
                </div>
                <div class="um-field um-field--full">
                    <label><?php echo esc_html($settings['message_label']); ?><?php if ($settings['message_required']) echo ' *'; ?></label>
                    <textarea name="um_sugg_message" <?php echo $settings['message_required'] ? 'required' : ''; ?>></textarea>
                </div>
            </div>
            <input type="hidden" name="action" value="um_submit_suggestion" />
            <?php wp_nonce_field('um_submit_suggestion_nonce','um_suggestion_nonce'); ?>
            <button type="submit">ارسال</button>
        </form>
        <?php
    }
}


