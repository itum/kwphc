<?php
if (!defined('ABSPATH')) { exit; }

class UM_Hall_Booking_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'um_hall_booking_form'; }
    public function get_title() { return um_translate('فرم رزرو سالن', __('فرم رزرو سالن', 'university-management')); }
    public function get_icon() { return 'eicon-form-horizontal'; }
    public function get_categories() { return ['university-management']; }
    public function get_script_depends() { return ['um-hall-booking-widget']; }
    public function get_style_depends() { return ['um-hall-booking-widget']; }

    protected function _register_controls() {
        $this->start_controls_section('section_content', [ 'label' => um_translate('محتوا', __('محتوا', 'university-management')) ]);
        $this->add_control('show_equipment_prices', [
            'label' => um_translate('نمایش قیمت تجهیزات', __('نمایش قیمت تجهیزات', 'university-management')),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $equipments = json_decode((string) get_option('um_hall_equipment', '[]'), true);
        if (!is_array($equipments)) { $equipments = array(); }
        $equipments_enabled = get_option('um_hall_enable_equipment', '1') === '1';

        wp_enqueue_script('um-hall-booking-widget');
        wp_enqueue_style('um-hall-booking-widget');
        $nonce = wp_create_nonce('university-management-nonce');
        ?>
        <form class="um-hall-form" method="post" onsubmit="return UM_Hall_Form.submit(event)">
            <input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>" />
            <input type="text" name="website" value="" style="display:none" />
            <div class="row">
                <label>عنوان رویداد</label>
                <input type="text" name="event_title" required />
            </div>
            <div class="row two">
                <div>
                    <label>تاریخ</label>
                    <input type="date" name="date" required />
                </div>
                <div>
                    <label>ساعت شروع</label>
                    <input type="time" name="start_time" required />
                </div>
                <div>
                    <label>ساعت پایان</label>
                    <input type="time" name="end_time" required />
                </div>
            </div>
            <?php if ($equipments_enabled && !empty($equipments)) : ?>
            <div class="row">
                <label>تجهیزات مورد نیاز</label>
                <div class="equipments">
                    <?php foreach ($equipments as $eq) : $id = esc_attr($eq['id']); ?>
                    <label class="equipment-item">
                        <input type="checkbox" name="equipments[]" value="<?php echo $id; ?>" />
                        <span><?php echo esc_html($eq['label'] ?? $id); ?><?php if (!empty($eq['price'])) echo ' - ' . number_format_i18n($eq['price']) . ' تومان'; ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="row two">
                <div>
                    <label>نام و نام خانوادگی</label>
                    <input type="text" name="name" required />
                </div>
                <div>
                    <label>شماره تماس</label>
                    <input type="tel" name="phone" required />
                </div>
                <div>
                    <label>ایمیل</label>
                    <input type="email" name="email" />
                </div>
            </div>
            <div class="row">
                <label>کد/شناسه ملی</label>
                <input type="text" name="national_code" />
            </div>
            <div class="row">
                <label>توضیحات</label>
                <textarea name="description" rows="3"></textarea>
            </div>
            <div class="row">
                <button type="submit" class="btn-primary">پرداخت و نهایی‌سازی</button>
                <span class="total" id="um-hall-total"></span>
            </div>
            <div class="row"><div class="um-hall-msg" id="um-hall-msg"></div></div>
        </form>
        <?php
    }
}


