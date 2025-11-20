<?php
/**
 * مدیریت ثبت نام سمینارها
 *
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

/**
 * کلاس مدیریت ثبت نام سمینارها
 */
class UM_Seminar_Registration {
    
    private $payment_gateway;
    
    public function __construct() {
        // اضافه کردن اکشن‌های AJAX (قبل از بررسی درگاه تا همیشه ثبت شوند)
        add_action('wp_ajax_um_seminar_register', array($this, 'handle_registration'));
        add_action('wp_ajax_nopriv_um_seminar_register', array($this, 'handle_registration'));
        
        // تعیین درگاه پرداخت (پیش‌فرض: فناوا)
        $gateway = get_option('um_seminar_gateway', 'fcp');
        
        if ($gateway === 'fcp') {
            if (!class_exists('UM_FCP_Gateway')) {
                require_once UM_PLUGIN_DIR . 'includes/seminar-registration/class-um-fcp-gateway.php';
            }
            if (class_exists('UM_FCP_Gateway')) {
                $this->payment_gateway = new UM_FCP_Gateway();
            } else {
                um_warning_log('UM_FCP_Gateway class not found after require');
            }
        } elseif ($gateway === 'zarinpal') {
            if (!class_exists('UM_Zarinpal_Gateway')) {
                um_warning_log('UM_Zarinpal_Gateway class not found');
            } else {
                $this->payment_gateway = new UM_Zarinpal_Gateway();
            }
        } else {
            um_warning_log('Unknown payment gateway: ' . $gateway);
        }
        
        // اضافه کردن shortcode
        add_shortcode('um_seminar_registration', array($this, 'registration_shortcode'));
        
        // اضافه کردن فیلتر برای نمایش دکمه ثبت نام
        add_filter('um_seminar_registration_button', array($this, 'show_registration_button'), 10, 2);
    }
    
    /**
     * بررسی امکان ثبت نام
     */
    public function can_register($seminar_id) {
        $active_date = get_post_meta($seminar_id, '_seminar_active_date', true);
        $registration_active = get_post_meta($seminar_id, '_seminar_registration_active', true);
        $capacity = intval(get_post_meta($seminar_id, '_seminar_capacity', true));
        
        // بررسی فعال بودن ثبت نام
        if ($registration_active !== '1') {
            // اگر تیک زده نشده، بررسی کن که آیا تاریخ فعال رسیده است یا نه
            if (!empty($active_date)) {
                $active_timestamp = strtotime($active_date);
                $current_timestamp = time();
                
                // اگر تاریخ فعال در آینده است، ثبت نام غیرفعال است
                if ($active_timestamp > $current_timestamp) {
                    return array('can_register' => false, 'message' => 'زمان ثبت نام هنوز فرا نرسیده است.');
                }
            } else {
                // اگر تیک زده نشده و تاریخ فعال هم تنظیم نشده، ثبت نام غیرفعال است
                return array('can_register' => false, 'message' => 'ثبت نام برای این سمینار فعال نیست.');
            }
        }
        // اگر تیک زده شده باشد، ثبت نام فعال است (تاریخ فعال را نادیده بگیر)
        
        // بررسی ظرفیت
        if ($capacity > 0) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'um_seminar_registrations';
            $registered_count = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM $table_name WHERE seminar_id = %d AND payment_status IN ('completed', 'pending')",
                $seminar_id
            ));
            
            if ($registered_count >= $capacity) {
                return array('can_register' => false, 'message' => 'ظرفیت سمینار تکمیل شده است.');
            }
        }
        
        return array('can_register' => true);
    }
    
    /**
     * پردازش ثبت نام
     */
    public function handle_registration() {
        check_ajax_referer('um_seminar_registration', 'nonce');
        
        $seminar_id = intval($_POST['seminar_id'] ?? 0);
        
        if (!$seminar_id) {
            wp_send_json_error('شناسه سمینار نامعتبر است.');
        }
        
        // بررسی امکان ثبت نام
        $can_register = $this->can_register($seminar_id);
        if (!$can_register['can_register']) {
            wp_send_json_error($can_register['message']);
        }
        
        // اعتبارسنجی فیلدها
        $validation = $this->validate_registration_data($_POST);
        if (!$validation['valid']) {
            wp_send_json_error($validation['message']);
        }
        
        // دریافت اطلاعات سمینار
        $seminar_price = intval(get_post_meta($seminar_id, '_seminar_price', true));
        
        // ذخیره ثبت نام
        global $wpdb;
        $table_name = $wpdb->prefix . 'um_seminar_registrations';
        
        $registration_data = array(
            'seminar_id' => $seminar_id,
            'user_id' => get_current_user_id(),
            'first_name' => sanitize_text_field($_POST['first_name']),
            'last_name' => sanitize_text_field($_POST['last_name']),
            'father_name' => sanitize_text_field($_POST['father_name']),
            'occupation' => sanitize_text_field($_POST['occupation']),
            'id_number' => sanitize_text_field($_POST['id_number']),
            'national_id' => sanitize_text_field($_POST['national_id']),
            'birth_place' => sanitize_text_field($_POST['birth_place']),
            'issue_place' => sanitize_text_field($_POST['issue_place']),
            'email' => sanitize_email($_POST['email']),
            'phone' => sanitize_text_field($_POST['phone']),
            'education_level' => sanitize_text_field($_POST['education_level']),
            'field_of_study' => sanitize_text_field($_POST['field_of_study']),
            'price' => $seminar_price,
            'payment_status' => $seminar_price > 0 ? 'pending' : 'completed',
            'documents' => json_encode($this->handle_file_uploads())
        );
        
        $result = $wpdb->insert($table_name, $registration_data);
        
        if ($result === false) {
            wp_send_json_error('خطا در ذخیره اطلاعات ثبت نام.');
        }
        
        $registration_id = $wpdb->insert_id;
        
        // اگر رایگان است، ثبت نام تکمیل شده
        if ($seminar_price == 0) {
            wp_send_json_success(array(
                'message' => 'ثبت نام شما با موفقیت انجام شد.',
                'registration_id' => $registration_id,
                'free' => true
            ));
        }
        
        // بررسی وجود درگاه پرداخت
        if (!$this->payment_gateway) {
            wp_send_json_error('درگاه پرداخت تنظیم نشده است. لطفاً با مدیر سایت تماس بگیرید.');
        }
        
        // ایجاد درخواست پرداخت
        $payment_result = $this->payment_gateway->create_payment(
            $registration_id,
            $seminar_price,
            'پرداخت ثبت نام سمینار: ' . get_the_title($seminar_id)
        );
        
        if (isset($payment_result['success']) && $payment_result['success']) {
            wp_send_json_success(array(
                'message' => 'درخواست پرداخت ایجاد شد.',
                'registration_id' => $registration_id,
                'payment_url' => $payment_result['payment_url'],
                'authority' => $payment_result['authority']
            ));
        } else {
            wp_send_json_error($payment_result['message']);
        }
    }
    
    /**
     * اعتبارسنجی اطلاعات ثبت نام
     */
    private function validate_registration_data($data) {
        $required_fields = array(
            'first_name' => 'نام',
            'last_name' => 'نام خانوادگی',
            'father_name' => 'نام پدر',
            'occupation' => 'شغل',
            'id_number' => 'شماره شناسنامه',
            'national_id' => 'کد ملی',
            'birth_place' => 'محل تولد',
            'issue_place' => 'محل صدور',
            'email' => 'ایمیل',
            'phone' => 'شماره تماس',
            'education_level' => 'مقطع تحصیلی',
            'field_of_study' => 'رشته تحصیلی'
        );
        
        foreach ($required_fields as $field => $label) {
            if (empty($data[$field])) {
                return array('valid' => false, 'message' => "فیلد {$label} الزامی است.");
            }
        }
        
        // اعتبارسنجی ایمیل
        if (!is_email($data['email'])) {
            return array('valid' => false, 'message' => 'ایمیل وارد شده معتبر نیست.');
        }
        
        // اعتبارسنجی کد ملی
        if (!$this->validate_national_id($data['national_id'])) {
            return array('valid' => false, 'message' => 'کد ملی وارد شده معتبر نیست.');
        }
        
        return array('valid' => true);
    }
    
    /**
     * اعتبارسنجی کد ملی
     */
    private function validate_national_id($national_id) {
        if (strlen($national_id) != 10) {
            return false;
        }
        
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($national_id[$i]) * (10 - $i);
        }
        
        $remainder = $sum % 11;
        $check_digit = $remainder < 2 ? $remainder : 11 - $remainder;
        
        return $check_digit == intval($national_id[9]);
    }
    
    /**
     * مدیریت آپلود فایل‌ها
     */
    private function handle_file_uploads() {
        $uploaded_files = array();
        $allowed_types = array('jpg', 'jpeg', 'png');
        $max_size = 200 * 1024; // 200KB
        
        $file_fields = array(
            'last_certificate' => 'آخرین مدرک تحصیلی',
            'national_card' => 'کارت ملی',
            'id_card_first_page' => 'صفحه اول شناسنامه',
            'personal_photo' => 'عکس پرسنلی'
        );
        
        foreach ($file_fields as $field => $label) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
                $file = $_FILES[$field];
                $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                
                if (in_array($file_extension, $allowed_types) && $file['size'] <= $max_size) {
                    $upload_dir = wp_upload_dir();
                    $seminar_uploads_dir = $upload_dir['basedir'] . '/seminar-documents';
                    
                    if (!file_exists($seminar_uploads_dir)) {
                        wp_mkdir_p($seminar_uploads_dir);
                    }
                    
                    $file_name = sanitize_file_name($file['name']);
                    $file_name = substr($file_name, 0, 20) . '_' . time() . '.' . $file_extension;
                    $file_path = $seminar_uploads_dir . '/' . $file_name;
                    
                    if (move_uploaded_file($file['tmp_name'], $file_path)) {
                        $uploaded_files[$field] = $upload_dir['baseurl'] . '/seminar-documents/' . $file_name;
                    }
                }
            }
        }
        
        return $uploaded_files;
    }
    
    /**
     * Shortcode برای فرم ثبت نام
     */
    public function registration_shortcode($atts) {
        $atts = shortcode_atts(array(
            'seminar_id' => 0,
            'show_title' => 'true'
        ), $atts);
        
        $seminar_id = intval($atts['seminar_id']);
        
        if (!$seminar_id) {
            return '<p>شناسه سمینار مشخص نشده است.</p>';
        }
        
        $can_register = $this->can_register($seminar_id);
        if (!$can_register['can_register']) {
            return '<div class="um-seminar-registration-error">' . esc_html($can_register['message']) . '</div>';
        }
        
        $seminar = get_post($seminar_id);
        $seminar_price = intval(get_post_meta($seminar_id, '_seminar_price', true));
        
        ob_start();
        ?>
        <div class="um-seminar-registration-form" data-seminar-id="<?php echo $seminar_id; ?>">
            <?php if ($atts['show_title'] === 'true'): ?>
                <h3><?php echo esc_html($seminar->post_title); ?></h3>
            <?php endif; ?>
            
            <form id="um-seminar-registration-form">
                <?php wp_nonce_field('um_seminar_registration', 'nonce'); ?>
                <input type="hidden" name="seminar_id" value="<?php echo $seminar_id; ?>">
                
                <div class="um-form-row">
                    <label for="first_name">نام *</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                
                <div class="um-form-row">
                    <label for="last_name">نام خانوادگی *</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                
                <div class="um-form-row">
                    <label for="father_name">نام پدر *</label>
                    <input type="text" id="father_name" name="father_name" required>
                </div>
                
                <div class="um-form-row">
                    <label for="occupation">شغل *</label>
                    <input type="text" id="occupation" name="occupation" required>
                </div>
                
                <div class="um-form-row">
                    <label for="id_number">شماره شناسنامه *</label>
                    <input type="text" id="id_number" name="id_number" required>
                </div>
                
                <div class="um-form-row">
                    <label for="national_id">کد ملی *</label>
                    <input type="text" id="national_id" name="national_id" required maxlength="10">
                </div>
                
                <div class="um-form-row">
                    <label for="birth_place">محل تولد *</label>
                    <input type="text" id="birth_place" name="birth_place" required>
                </div>
                
                <div class="um-form-row">
                    <label for="issue_place">محل صدور *</label>
                    <input type="text" id="issue_place" name="issue_place" required>
                </div>
                
                <div class="um-form-row">
                    <label for="email">آدرس ایمیل *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="um-form-row">
                    <label for="phone">شماره تماس *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <div class="um-form-row">
                    <label for="education_level">مقطع تحصیلی *</label>
                    <select id="education_level" name="education_level" required>
                        <option value="">انتخاب کنید</option>
                        <option value="زیر دیپلم">زیر دیپلم</option>
                        <option value="دیپلم">دیپلم</option>
                        <option value="فوق دیپلم">فوق دیپلم</option>
                        <option value="لیسانس">لیسانس</option>
                        <option value="فوق لیسانس">فوق لیسانس</option>
                        <option value="دکتری">دکتری</option>
                    </select>
                </div>
                
                <div class="um-form-row">
                    <label for="field_of_study">رشته تحصیلی *</label>
                    <input type="text" id="field_of_study" name="field_of_study" required>
                </div>
                
                <?php if ($seminar_price > 0): ?>
                    <div class="um-form-row">
                        <label>هزینه: <?php echo number_format($seminar_price); ?> تومان</label>
                    </div>
                <?php else: ?>
                    <div class="um-form-row">
                        <label>رایگان</label>
                    </div>
                <?php endif; ?>
                
                <div class="um-form-row">
                    <label>بارگذاری مدارک:</label>
                    <p>کلیه مدارک خود را می‌توانید در قالب jpg, jpeg, png بارگذاری نمایید.</p>
                    <p>نام فایل حتماً لاتین باشد و حداکثر ۲۰ کاراکتر باشد.</p>
                    <p>حجم فایل حداکثر ۲۰۰ کیلوبایت باشد.</p>
                </div>
                
                <div class="um-form-row">
                    <label for="last_certificate">آخرین مدرک تحصیلی</label>
                    <input type="file" id="last_certificate" name="last_certificate" accept=".jpg,.jpeg,.png">
                </div>
                
                <div class="um-form-row">
                    <label for="national_card">کارت ملی</label>
                    <input type="file" id="national_card" name="national_card" accept=".jpg,.jpeg,.png">
                </div>
                
                <div class="um-form-row">
                    <label for="id_card_first_page">صفحه اول شناسنامه</label>
                    <input type="file" id="id_card_first_page" name="id_card_first_page" accept=".jpg,.jpeg,.png">
                </div>
                
                <div class="um-form-row">
                    <label for="personal_photo">عکس پرسنلی</label>
                    <input type="file" id="personal_photo" name="personal_photo" accept=".jpg,.jpeg,.png">
                </div>
                
                <div class="um-form-row">
                    <button type="submit" class="um-register-button">
                        <?php echo $seminar_price > 0 ? 'ثبت نام و پرداخت' : 'ثبت نام'; ?>
                    </button>
                </div>
            </form>
            
            <div id="um-registration-message" style="display: none;"></div>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            $('#um-seminar-registration-form').on('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData(this);
                formData.append('action', 'um_seminar_register');
                formData.append('nonce', '<?php echo wp_create_nonce('um_seminar_registration'); ?>');
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.um-register-button').prop('disabled', true).text('در حال پردازش...');
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.data.free) {
                                $('#um-registration-message').html('<div class="um-success">' + response.data.message + '</div>').show();
                                $('#um-seminar-registration-form')[0].reset();
                            } else {
                                window.location.href = response.data.payment_url;
                            }
                        } else {
                            $('#um-registration-message').html('<div class="um-error">' + response.data + '</div>').show();
                        }
                    },
                    error: function() {
                        $('#um-registration-message').html('<div class="um-error">خطا در ارتباط با سرور</div>').show();
                    },
                    complete: function() {
                        $('.um-register-button').prop('disabled', false).text('<?php echo esc_js($seminar_price > 0 ? 'ثبت نام و پرداخت' : 'ثبت نام'); ?>');
                    }
                });
            });
        });
        </script>
        
        <style>
        .um-seminar-registration-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .um-form-row {
            margin-bottom: 15px;
        }
        .um-form-row label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .um-form-row input,
        .um-form-row select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .um-register-button {
            background: #0073aa;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .um-register-button:hover {
            background: #005a87;
        }
        .um-success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }
        .um-error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }
        </style>
        <?php
        
        return ob_get_clean();
    }
    
    /**
     * نمایش دکمه ثبت نام در ویجت
     */
    public function show_registration_button($button_html, $seminar_id) {
        $can_register = $this->can_register($seminar_id);
        
        if ($can_register['can_register']) {
            $seminar_price = intval(get_post_meta($seminar_id, '_seminar_price', true));
            $button_text = $seminar_price > 0 ? 'ثبت نام و پرداخت' : 'ثبت نام رایگان';
            
            return '<a href="#" class="um-seminar-register-btn" data-seminar-id="' . $seminar_id . '">' . $button_text . '</a>';
        }
        
        return $button_html;
    }
}
