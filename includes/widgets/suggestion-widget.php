<?php
/**
 * ویجت پیشنهادات و انتقادات برای المنتور
 */

if (!defined('ABSPATH')) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class UM_Suggestion_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'um_suggestion_widget'; }
    public function get_title() { return __('فرم پیشنهادات و انتقادات', 'university-management'); }
    public function get_icon() { return 'fa fa-comment'; }
    public function get_categories() { return array('university-management'); }

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('تنظیمات فرم', 'university-management')
        ]);

        // recipient dropdown (comma separated options)
        $this->add_control('recipients', [
            'label' => __('گزارش گیرندگان (هر خط یک گزینه)', 'university-management'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => "-\nریاست\nمعاونت آموزشی و فرهنگی\nمعاونت مالی و پشتیبانی",
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
            'label' => __('متن فیلد پیام', 'university-management'),
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
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $recipients = array_filter(array_map('trim', explode("\n", $settings['recipients'])));
        $recipients_options = array();
        foreach ($recipients as $r) { $recipients_options[] = esc_html($r); }

        // output simple form (frontend JS will handle submission)
        ?>
        <form class="um-suggestion-form" method="post">
            <div class="um-row">
                <label><?php echo esc_html($settings['name_label']); ?><?php if ($settings['name_required']) echo ' *'; ?></label>
                <input type="text" name="um_sugg_name" <?php echo $settings['name_required'] ? 'required' : ''; ?> />
                <label><?php echo esc_html($settings['title_label']); ?><?php if ($settings['title_required']) echo ' *'; ?></label>
                <input type="text" name="um_sugg_title" <?php echo $settings['title_required'] ? 'required' : ''; ?> />
            </div>
            <div class="um-row">
                <label><?php echo esc_html($settings['phone_label']); ?><?php if ($settings['phone_required']) echo ' *'; ?></label>
                <input type="text" name="um_sugg_phone" <?php echo $settings['phone_required'] ? 'required' : ''; ?> />
                <label><?php echo esc_html($settings['message_label']); ?><?php if ($settings['message_required']) echo ' *'; ?></label>
            </div>
            <div class="um-row">
                <select name="um_sugg_recipient">
                    <?php foreach ($recipients_options as $opt) : ?>
                        <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="um-row">
                <textarea name="um_sugg_message" <?php echo $settings['message_required'] ? 'required' : ''; ?>></textarea>
            </div>
            <input type="hidden" name="action" value="um_submit_suggestion" />
            <?php wp_nonce_field('um_submit_suggestion_nonce','um_suggestion_nonce'); ?>
            <button type="submit">ارسال</button>
        </form>
        <?php
    }
}


