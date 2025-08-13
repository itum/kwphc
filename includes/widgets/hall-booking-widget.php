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
		// کنترل‌های نمایش/برچسب فیلدها
		$this->add_control('label_event_title', [ 'label' => 'برچسب عنوان رویداد', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'عنوان رویداد' ]);
		$this->add_control('enable_event_title', [ 'label' => 'نمایش عنوان رویداد', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_date', [ 'label' => 'برچسب تاریخ', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'تاریخ' ]);
		$this->add_control('enable_date', [ 'label' => 'نمایش تاریخ', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_start_time', [ 'label' => 'برچسب ساعت شروع', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ساعت شروع' ]);
		$this->add_control('enable_start_time', [ 'label' => 'نمایش ساعت شروع', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_end_time', [ 'label' => 'برچسب ساعت پایان', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ساعت پایان' ]);
		$this->add_control('enable_end_time', [ 'label' => 'نمایش ساعت پایان', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('enable_usage_type', [ 'label' => 'نمایش نوع استفاده', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_usage_type', [ 'label' => 'برچسب نوع استفاده', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'نوع استفاده' ]);
		$this->add_control('enable_layout', [ 'label' => 'نمایش چیدمان سالن', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_layout', [ 'label' => 'برچسب چیدمان سالن', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'چیدمان سالن' ]);
		$this->add_control('enable_catering', [ 'label' => 'نمایش پذیرایی', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_catering', [ 'label' => 'برچسب پذیرایی', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'پذیرایی' ]);
		$this->add_control('enable_operator', [ 'label' => 'نمایش نیاز به اپراتور فنی', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_operator', [ 'label' => 'برچسب نیاز به اپراتور فنی', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'نیاز به اپراتور فنی' ]);
		$this->add_control('label_name', [ 'label' => 'برچسب نام و نام خانوادگی', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'نام و نام خانوادگی' ]);
		$this->add_control('enable_name', [ 'label' => 'نمایش نام و نام خانوادگی', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_phone', [ 'label' => 'برچسب شماره تماس', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'شماره تماس' ]);
		$this->add_control('enable_phone', [ 'label' => 'نمایش شماره تماس', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_email', [ 'label' => 'برچسب ایمیل', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ایمیل' ]);
		$this->add_control('enable_email', [ 'label' => 'نمایش ایمیل', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_national_code', [ 'label' => 'برچسب کد/شناسه ملی', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'کد/شناسه ملی' ]);
		$this->add_control('enable_national_code', [ 'label' => 'نمایش کد/شناسه ملی', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_org_unit', [ 'label' => 'برچسب واحد/سازمان', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'واحد/سازمان' ]);
		$this->add_control('enable_org_unit', [ 'label' => 'نمایش واحد/سازمان', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '' ]);
		$this->add_control('label_position', [ 'label' => 'برچسب سمت', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'سمت' ]);
		$this->add_control('enable_position', [ 'label' => 'نمایش سمت', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '' ]);
		$this->add_control('label_description', [ 'label' => 'برچسب توضیحات', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'توضیحات' ]);
		$this->add_control('enable_description', [ 'label' => 'نمایش توضیحات', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('enable_terms', [ 'label' => 'نمایش قوانین و تیک تایید', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->add_control('label_terms', [ 'label' => 'متن کنار تیک قوانین', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'قوانین رزرو و لغو را خوانده‌ام و می‌پذیرم' ]);
		$this->add_control('enable_payment_method', [ 'label' => 'نمایش انتخاب روش پرداخت', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ]);
		$this->end_controls_section();
    }

    protected function render() {
		$equipments = json_decode((string) get_option('um_hall_equipment', '[]'), true);
        if (!is_array($equipments)) { $equipments = array(); }
		$equipments_enabled = get_option('um_hall_enable_equipment', '1') === '1';
		$usage_enabled = get_option('um_hall_enable_usage_type', '1') === '1';
		$layouts_enabled = get_option('um_hall_enable_layouts', '1') === '1';
		$catering_enabled = get_option('um_hall_enable_catering', '1') === '1';
		$terms_required = get_option('um_hall_require_terms', '0') === '1';
		$terms_text = (string) get_option('um_hall_terms_text', '');
		$pm_enabled = get_option('um_hall_enable_payment_method', '1') === '1';
		$pmethods = json_decode((string) get_option('um_hall_payment_methods', '[{"id":"online","label":"پرداخت آنلاین"}]'), true);
		if (!is_array($pmethods)) { $pmethods = array(); }
		$usage_types = json_decode((string) get_option('um_hall_usage_types', '[]'), true); if (!is_array($usage_types)) { $usage_types = array(); }
		$layouts = json_decode((string) get_option('um_hall_layouts', '[]'), true); if (!is_array($layouts)) { $layouts = array(); }
		$caterings = json_decode((string) get_option('um_hall_catering', '[]'), true); if (!is_array($caterings)) { $caterings = array(); }

        wp_enqueue_script('um-hall-booking-widget');
        wp_enqueue_style('um-hall-booking-widget');
        $nonce = wp_create_nonce('university-management-nonce');
        ?>
        <form class="um-hall-form" method="post" onsubmit="return UM_Hall_Form.submit(event)">
            <input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>" />
            <input type="text" name="website" value="" style="display:none" />
			<div class="row">
				<?php $s=$this->get_settings_for_display(); if(!isset($s['enable_event_title']) || $s['enable_event_title']==='yes'): ?>
				<label><?php echo esc_html($s['label_event_title'] ?? 'عنوان رویداد'); ?></label>
				<input type="text" name="event_title" required />
				<?php endif; ?>
			</div>
            <div class="row two">
				<?php $dp = get_option('um_hall_date_picker', 'gregorian'); ?>
				<?php if(!isset($s['enable_date']) || $s['enable_date']==='yes'): ?><div>
					<label><?php echo esc_html($s['label_date'] ?? 'تاریخ'); ?></label>
					<?php if ($dp === 'gregorian'): ?>
						<input type="date" name="date" required />
					<?php else: ?>
						<input type="text" name="date" placeholder="مثلاً 1403-01-01" required />
					<?php endif; ?>
				</div><?php endif; ?>
				<?php if(!isset($s['enable_start_time']) || $s['enable_start_time']==='yes'): ?><div>
					<label><?php echo esc_html($s['label_start_time'] ?? 'ساعت شروع'); ?></label>
					<input type="time" name="start_time" required />
				</div><?php endif; ?>
				<?php if(!isset($s['enable_end_time']) || $s['enable_end_time']==='yes'): ?><div>
					<label><?php echo esc_html($s['label_end_time'] ?? 'ساعت پایان'); ?></label>
					<input type="time" name="end_time" required />
				</div><?php endif; ?>
            </div>
			<?php if ($usage_enabled && (!isset($s['enable_usage_type']) || $s['enable_usage_type']==='yes') && !empty($usage_types)) : ?>
			<div class="row">
				<label><?php echo esc_html($s['label_usage_type'] ?? 'نوع استفاده'); ?></label>
				<select name="usage_type">
					<option value="">انتخاب کنید</option>
					<?php foreach ($usage_types as $ut): $ut=(string)$ut; ?>
						<option value="<?php echo esc_attr($ut); ?>"><?php echo esc_html($ut); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>
            <?php if ($equipments_enabled && !empty($equipments)) : ?>
            <div class="row">
                <label>تجهیزات مورد نیاز</label>
                <div class="equipments">
                    <?php foreach ($equipments as $eq) : $id = esc_attr($eq['id']); ?>
                    <label class="equipment-item">
                        <input type="checkbox" name="equipments[]" value="<?php echo $id; ?>" />
						<span><?php echo esc_html($eq['label'] ?? $id); ?><?php if (!empty($eq['price']) && ($this->get_settings_for_display()['show_equipment_prices'] === 'yes')) echo ' - ' . number_format_i18n($eq['price']) . ' تومان'; ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
			<?php if ($layouts_enabled && (!isset($s['enable_layout']) || $s['enable_layout']==='yes') && !empty($layouts)) : ?>
			<div class="row">
				<label><?php echo esc_html($s['label_layout'] ?? 'چیدمان سالن'); ?></label>
				<select name="layout">
					<option value="">انتخاب کنید</option>
					<?php foreach ($layouts as $lt): $lt=(string)$lt; ?>
						<option value="<?php echo esc_attr($lt); ?>"><?php echo esc_html($lt); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>
			<?php if ($catering_enabled && (!isset($s['enable_catering']) || $s['enable_catering']==='yes') && !empty($caterings)) : ?>
			<div class="row">
				<label><?php echo esc_html($s['label_catering'] ?? 'پذیرایی'); ?></label>
				<div class="equipments">
					<?php foreach ($caterings as $ct) : $cid = esc_attr($ct['id'] ?? ''); if(!$cid) continue; ?>
					<label class="equipment-item">
						<input type="checkbox" name="catering[]" value="<?php echo $cid; ?>" />
						<span><?php echo esc_html($ct['label'] ?? $cid); ?><?php if (!empty($ct['price']) && ($this->get_settings_for_display()['show_equipment_prices'] === 'yes')) echo ' - ' . number_format_i18n($ct['price']) . ' تومان'; ?></span>
					</label>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
            <div class="row two">
				<?php if(!isset($s['enable_name']) || $s['enable_name']==='yes'): ?><div>
					<label><?php echo esc_html($s['label_name'] ?? 'نام و نام خانوادگی'); ?></label>
					<input type="text" name="name" required />
				</div><?php endif; ?>
				<?php if(!isset($s['enable_phone']) || $s['enable_phone']==='yes'): ?><div>
					<label><?php echo esc_html($s['label_phone'] ?? 'شماره تماس'); ?></label>
					<input type="tel" name="phone" required />
				</div><?php endif; ?>
				<?php if(!isset($s['enable_email']) || $s['enable_email']==='yes'): ?><div>
					<label><?php echo esc_html($s['label_email'] ?? 'ایمیل'); ?></label>
					<input type="email" name="email" />
				</div><?php endif; ?>
            </div>
			<?php if(!isset($s['enable_national_code']) || $s['enable_national_code']==='yes'): ?><div class="row">
				<label><?php echo esc_html($s['label_national_code'] ?? 'کد/شناسه ملی'); ?></label>
				<input type="text" name="national_code" />
			</div><?php endif; ?>
			<?php if(isset($s['enable_org_unit']) && $s['enable_org_unit']==='yes'): ?><div class="row">
				<label><?php echo esc_html($s['label_org_unit'] ?? 'واحد/سازمان'); ?></label>
				<input type="text" name="org_unit" />
			</div><?php endif; ?>
			<?php if(isset($s['enable_position']) && $s['enable_position']==='yes'): ?><div class="row">
				<label><?php echo esc_html($s['label_position'] ?? 'سمت'); ?></label>
				<input type="text" name="position" />
			</div><?php endif; ?>
			<?php if(!isset($s['enable_operator']) || $s['enable_operator']==='yes'): ?><div class="row">
				<label><input type="checkbox" name="need_operator" value="1" /> <?php echo esc_html($s['label_operator'] ?? 'نیاز به اپراتور فنی'); ?></label>
			</div><?php endif; ?>
			<?php if(!isset($s['enable_description']) || $s['enable_description']==='yes'): ?><div class="row">
				<label><?php echo esc_html($s['label_description'] ?? 'توضیحات'); ?></label>
				<textarea name="description" rows="3"></textarea>
			</div><?php endif; ?>
			<?php if ($pm_enabled && (!isset($s['enable_payment_method']) || $s['enable_payment_method']==='yes') && !empty($pmethods)) : ?><div class="row">
				<label>روش پرداخت</label>
				<select name="payment_method">
					<?php foreach ($pmethods as $pm): $pid = (string) ($pm['id'] ?? ''); if(!$pid) continue; $pl = (string) ($pm['label'] ?? $pid); ?>
						<option value="<?php echo esc_attr($pid); ?>"><?php echo esc_html($pl); ?></option>
					<?php endforeach; ?>
				</select>
			</div><?php endif; ?>
            <div class="row">
                <button type="submit" class="btn-primary">پرداخت و نهایی‌سازی</button>
                <span class="total" id="um-hall-total"></span>
            </div>
			<?php if((!empty($terms_text) || $terms_required) && (!isset($s['enable_terms']) || $s['enable_terms']==='yes')): ?>
			<div class="row">
				<div style="background:#f7f7f7;padding:10px;border-radius:6px">
					<?php if($terms_text): ?><div class="terms-text" style="font-size:13px;line-height:1.8;margin-bottom:8px"><?php echo wp_kses_post(nl2br(esc_html($terms_text))); ?></div><?php endif; ?>
					<label><input type="checkbox" name="accept_terms" value="1" <?php echo $terms_required ? 'required' : ''; ?> /> <?php echo esc_html(($s['label_terms'] ?? '') ?: 'قوانین رزرو و لغو را خوانده‌ام و می‌پذیرم'); ?></label>
				</div>
			</div>
			<?php endif; ?>
            <div class="row"><div class="um-hall-msg" id="um-hall-msg"></div></div>
        </form>
        <?php
    }
}


