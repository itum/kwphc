<?php
/**
 * صفحه مدیریت آزمون‌های استخدامی
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// بررسی دسترسی کاربر
if (!current_user_can('manage_options')) {
    wp_die(__('شما دسترسی به این صفحه را ندارید.', 'university-management'));
}

// پردازش فرم ارسالی
if (isset($_POST['um_add_exam_nonce']) && wp_verify_nonce($_POST['um_add_exam_nonce'], 'um_add_exam')) {
    
    // بررسی وجود پست تایپ
    if (!post_type_exists('um_employment_exams')) {
        add_settings_error('um_employment_exams', 'um_post_type_error', __('خطا: پست تایپ "um_employment_exams" ثبت نشده است. لطفاً افزونه را غیرفعال و مجدداً فعال کنید.', 'university-management'), 'error');
    } else {
        // دریافت مقادیر فرم
        $exam_title = sanitize_text_field($_POST['exam_title']);
        $exam_date = sanitize_text_field($_POST['exam_date']);
        $exam_time = sanitize_text_field($_POST['exam_time']);
        $exam_duration = absint($_POST['exam_duration']);
        $exam_position = sanitize_text_field($_POST['exam_position']);
        $exam_department = sanitize_text_field($_POST['exam_department']);
        $exam_location = sanitize_text_field($_POST['exam_location']);
        $exam_application_deadline = sanitize_text_field($_POST['exam_application_deadline']);
        $exam_status = sanitize_text_field($_POST['exam_status']);
        $exam_requirements = wp_kses_post($_POST['exam_requirements']);
        $exam_description = wp_kses_post($_POST['exam_description']);
        
        // دریافت فیلدهای سفارشی جدید
        $city = sanitize_text_field($_POST['city']);
        $contact_number = sanitize_text_field($_POST['contact_number']);
        $job_title = sanitize_text_field($_POST['job_title']);
        $education_level = sanitize_text_field($_POST['education_level']);
        $exam_type = sanitize_text_field($_POST['exam_type']);
        $registration_start_date = sanitize_text_field($_POST['registration_start_date']);
        $registration_end_date = sanitize_text_field($_POST['registration_end_date']);
        $employment_link = esc_url_raw($_POST['employment_link']);
        $employment_link_enabled = isset($_POST['employment_link_enabled']) ? 1 : 0;
        $exam_time_custom = sanitize_text_field($_POST['exam_time_custom']);
        $exam_date_custom = sanitize_text_field($_POST['exam_date_custom']);
        $exam_status_custom = sanitize_text_field($_POST['exam_status_custom']);
        $exam_results_link = esc_url_raw($_POST['exam_results_link']);
        
        // بررسی داده‌های الزامی
        if (!empty($exam_title) && !empty($exam_date) && !empty($exam_time)) {
            // تبدیل تاریخ به فرمت مناسب
            $exam_datetime = $exam_date . ' ' . $exam_time . ':00';
            
            // تبدیل به timestamp برای بهتر کار کردن
            $exam_timestamp = strtotime($exam_datetime);
            if ($exam_timestamp === false) {
                add_settings_error('um_employment_exams', 'um_date_error', __('تاریخ یا زمان وارد شده معتبر نیست.', 'university-management'), 'error');
            } else {
                // ایجاد پست جدید
                $post_data = array(
                    'post_title'    => $exam_title,
                    'post_content'  => $exam_description,
                    'post_status'   => 'publish',
                    'post_type'     => 'um_employment_exams',
                    'post_author'   => get_current_user_id(),
                );
                
                $post_id = wp_insert_post($post_data);
                
                if (!is_wp_error($post_id) && $post_id > 0) {
                    // ذخیره متادیتا
                    update_post_meta($post_id, '_exam_date', $exam_date);
                    update_post_meta($post_id, '_exam_time', $exam_time);
                    update_post_meta($post_id, '_exam_duration', $exam_duration ?: 120);
                    update_post_meta($post_id, '_exam_position', $exam_position);
                    update_post_meta($post_id, '_exam_department', $exam_department);
                    update_post_meta($post_id, '_exam_location', $exam_location);
                    update_post_meta($post_id, '_exam_application_deadline', $exam_application_deadline);
                    update_post_meta($post_id, '_exam_status', $exam_status ?: 'upcoming');
                    update_post_meta($post_id, '_exam_requirements', $exam_requirements);
                    
                    // ذخیره فیلدهای سفارشی جدید
                    update_post_meta($post_id, 'city', $city);
                    update_post_meta($post_id, 'contact_number', $contact_number);
                    update_post_meta($post_id, 'job_title', $job_title);
                    update_post_meta($post_id, 'education_level', $education_level);
                    update_post_meta($post_id, 'exam_type', $exam_type);
                    update_post_meta($post_id, 'registration_start_date', $registration_start_date);
                    update_post_meta($post_id, 'registration_end_date', $registration_end_date);
                    update_post_meta($post_id, 'employment_link', $employment_link);
                    update_post_meta($post_id, 'employment_link_enabled', $employment_link_enabled);
                    update_post_meta($post_id, 'exam_time', $exam_time_custom);
                    update_post_meta($post_id, 'exam_date_custom', $exam_date_custom);
                    update_post_meta($post_id, 'exam_status_custom', $exam_status_custom);
                    update_post_meta($post_id, 'exam_results_link', $exam_results_link);
                    
                    update_post_meta($post_id, 'end_date', $exam_application_deadline); // برای سازگاری با فیلدهای موجود
                    update_post_meta($post_id, 'exam_date', $exam_date); // برای سازگاری با فیلدهای موجود
                    
                    // اضافه کردن تصویر شاخص (اگر آپلود شده باشد)
                    if (isset($_FILES['exam_image']) && !empty($_FILES['exam_image']['name'])) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                        
                        $attachment_id = media_handle_upload('exam_image', $post_id);
                        
                        if (!is_wp_error($attachment_id)) {
                            set_post_thumbnail($post_id, $attachment_id);
                        }
                    }
                    
                    // نمایش پیام موفقیت
                    add_settings_error('um_employment_exams', 'um_exam_added', sprintf(__('آزمون استخدامی "%s" با موفقیت اضافه شد. شناسه پست: %d', 'university-management'), $exam_title, $post_id), 'success');
                    
                } else {
                    // نمایش پیام خطا با جزئیات بیشتر
                    $error_message = is_wp_error($post_id) ? $post_id->get_error_message() : 'خطای نامشخص در ایجاد پست';
                    add_settings_error('um_employment_exams', 'um_exam_error', sprintf(__('خطا در افزودن آزمون استخدامی: %s', 'university-management'), $error_message), 'error');
                }
            }
        } else {
            // نمایش پیام خطا برای فیلدهای الزامی
            add_settings_error('um_employment_exams', 'um_exam_required', __('عنوان آزمون، تاریخ و زمان الزامی هستند.', 'university-management'), 'error');
        }
    }
} elseif (isset($_POST['um_add_exam_nonce'])) {
    // اگر nonce معتبر نباشد
    add_settings_error('um_employment_exams', 'um_nonce_error', __('خطای امنیتی. لطفاً دوباره تلاش کنید.', 'university-management'), 'error');
}

// نمایش پیام‌های خطا/موفقیت
settings_errors('um_employment_exams');

// دریافت آزمون‌های موجود
$args = array(
    'post_type'      => 'um_employment_exams',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'meta_value',
    'meta_key'       => '_exam_date',
    'order'          => 'ASC',
);

$exams = new WP_Query($args);

?>

<div class="wrap">
    <h1><?php _e('مدیریت آزمون‌های استخدامی', 'university-management'); ?></h1>
    
    <div class="um-admin-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <!-- فرم افزودن آزمون جدید -->
        <div class="um-admin-form" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 40%; min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('افزودن آزمون استخدامی جدید', 'university-management'); ?></h2>
            
            <form method="post" action="" enctype="multipart/form-data">
                <?php wp_nonce_field('um_add_exam', 'um_add_exam_nonce'); ?>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_title" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('عنوان آزمون', 'university-management'); ?> *</label>
                    <input type="text" id="exam_title" name="exam_title" class="regular-text" required style="width: 100%;" placeholder="مثال: آزمون استخدامی مهندس نرم‌افزار">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_position" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('موقعیت شغلی', 'university-management'); ?></label>
                    <input type="text" id="exam_position" name="exam_position" class="regular-text" style="width: 100%;" placeholder="مثال: مهندس نرم‌افزار">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_department" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('دپارتمان', 'university-management'); ?></label>
                    <input type="text" id="exam_department" name="exam_department" class="regular-text" style="width: 100%;" placeholder="مثال: فناوری اطلاعات">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_date" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ آزمون', 'university-management'); ?> *</label>
                    <input type="date" id="exam_date" name="exam_date" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_time" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('زمان شروع آزمون', 'university-management'); ?> *</label>
                    <input type="time" id="exam_time" name="exam_time" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_duration" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('مدت زمان آزمون (دقیقه)', 'university-management'); ?></label>
                    <input type="number" id="exam_duration" name="exam_duration" class="regular-text" min="30" step="15" value="120" style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_location" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('محل برگزاری', 'university-management'); ?></label>
                    <input type="text" id="exam_location" name="exam_location" class="regular-text" style="width: 100%;" placeholder="مثال: سالن اجتماعات دانشگاه">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_application_deadline" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('مهلت ثبت‌نام', 'university-management'); ?></label>
                    <input type="date" id="exam_application_deadline" name="exam_application_deadline" class="regular-text" style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_status" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('وضعیت آزمون', 'university-management'); ?></label>
                    <select id="exam_status" name="exam_status" class="regular-text" style="width: 100%;">
                        <option value="upcoming"><?php _e('در انتظار برگزاری', 'university-management'); ?></option>
                        <option value="registration"><?php _e('در حال ثبت‌نام', 'university-management'); ?></option>
                        <option value="closed"><?php _e('بسته', 'university-management'); ?></option>
                        <option value="completed"><?php _e('برگزار شده', 'university-management'); ?></option>
                        <option value="results_announced"><?php _e('اعلام نتایج', 'university-management'); ?></option>
                    </select>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_requirements" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('شرایط و الزامات', 'university-management'); ?></label>
                    <textarea id="exam_requirements" name="exam_requirements" rows="4" class="regular-text" style="width: 100%;" placeholder="شرایط و الزامات مورد نیاز برای شرکت در آزمون..."></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_description" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('توضیحات آزمون', 'university-management'); ?></label>
                    <textarea id="exam_description" name="exam_description" rows="5" class="regular-text" style="width: 100%;" placeholder="توضیحات کامل در مورد آزمون..."></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="exam_image" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تصویر آزمون', 'university-management'); ?></label>
                    <input type="file" id="exam_image" name="exam_image" accept="image/*">
                </div>
                
                <!-- فیلدهای سفارشی جدید -->
                <div style="border-top: 2px solid #e1e5e9; margin: 20px 0; padding-top: 20px;">
                    <h3 style="color: #1e2a78; margin-bottom: 15px;"><?php _e('اطلاعات تکمیلی', 'university-management'); ?></h3>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="city" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام شهر خدمت', 'university-management'); ?></label>
                        <input type="text" id="city" name="city" class="regular-text" style="width: 100%;" placeholder="مثال: اهواز">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="contact_number" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('شماره تماس', 'university-management'); ?></label>
                        <input type="tel" id="contact_number" name="contact_number" class="regular-text" style="width: 100%;" placeholder="مثال: 0999184394">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="job_title" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('عنوان شغلی مورد نیاز', 'university-management'); ?></label>
                        <input type="text" id="job_title" name="job_title" class="regular-text" style="width: 100%;" placeholder="مثال: سیمبان، سیمبان خط گرم">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="education_level" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('مقطع تحصیلی مورد نیاز', 'university-management'); ?></label>
                        <input type="text" id="education_level" name="education_level" class="regular-text" style="width: 100%;" placeholder="مثال: دیپلم، فوق دیپلم برق">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="exam_type" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نوع آزمون', 'university-management'); ?></label>
                        <select id="exam_type" name="exam_type" class="regular-text" style="width: 100%;">
                            <option value=""><?php _e('انتخاب کنید...', 'university-management'); ?></option>
                            <option value="آزمون بکارگیری نیروی انسانی"><?php _e('آزمون بکارگیری نیروی انسانی', 'university-management'); ?></option>
                            <option value="آگهی جذب نیروی حجمی"><?php _e('آگهی جذب نیروی حجمی', 'university-management'); ?></option>
                            <option value="آزمون استخدامی عمومی"><?php _e('آزمون استخدامی عمومی', 'university-management'); ?></option>
                        </select>
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="registration_start_date" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('شروع ثبت نام', 'university-management'); ?></label>
                        <input type="text" id="registration_start_date" name="registration_start_date" class="regular-text" style="width: 100%;" placeholder="مثال: 1404/07/27">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="registration_end_date" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('پایان ثبت نام', 'university-management'); ?></label>
                        <input type="text" id="registration_end_date" name="registration_end_date" class="regular-text" style="width: 100%;" placeholder="مثال: 1404/08/06">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="exam_date_custom" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ آزمون', 'university-management'); ?></label>
                        <input type="text" id="exam_date_custom" name="exam_date_custom" class="regular-text" style="width: 100%;" placeholder="مثال: 1404/08/22">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="exam_time_custom" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('زمان آزمون', 'university-management'); ?></label>
                        <input type="text" id="exam_time_custom" name="exam_time_custom" class="regular-text" style="width: 100%;" placeholder="مثال: 08:00">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="employment_link" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('لینک استخدام', 'university-management'); ?></label>
                        <input type="url" id="employment_link" name="employment_link" class="regular-text" style="width: 100%;" placeholder="مثال: https://example.com/employment">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="exam_results_link" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('لینک نتایج آزمون', 'university-management'); ?></label>
                        <input type="url" id="exam_results_link" name="exam_results_link" class="regular-text" style="width: 100%;" placeholder="مثال: https://example.com/results">
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('وضعیت لینک استخدام', 'university-management'); ?></label>
                        <label style="display: flex; align-items: center; gap: 8px;">
                            <input type="checkbox" id="employment_link_enabled" name="employment_link_enabled" value="1" checked>
                            <span><?php _e('لینک استخدام فعال باشد', 'university-management'); ?></span>
                        </label>
                        <small style="color: #666; margin-top: 5px; display: block;"><?php _e('اگر این گزینه فعال باشد، لینک استخدام در ویجت نمایش داده می‌شود', 'university-management'); ?></small>
                    </div>
                    
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="exam_status_custom" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('وضعیت آزمون', 'university-management'); ?></label>
                        <select id="exam_status_custom" name="exam_status_custom" class="regular-text" style="width: 100%;">
                            <option value="در انتظار برگزاری"><?php _e('در انتظار برگزاری', 'university-management'); ?></option>
                            <option value="در حال ثبت نام"><?php _e('در حال ثبت نام', 'university-management'); ?></option>
                            <option value="بسته"><?php _e('بسته', 'university-management'); ?></option>
                            <option value="برگزار شده"><?php _e('برگزار شده', 'university-management'); ?></option>
                            <option value="اعلام نتایج"><?php _e('اعلام نتایج', 'university-management'); ?></option>
                        </select>
                    </div>
                </div>
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php _e('افزودن آزمون استخدامی', 'university-management'); ?>">
                </div>
            </form>
            
            <script>
            // فرمت کردن تاریخ‌ها به صورت خودکار
            document.addEventListener('DOMContentLoaded', function() {
                const startDateInput = document.getElementById('registration_start_date');
                const endDateInput = document.getElementById('registration_end_date');
                
                // فرمت کردن تاریخ هنگام تایپ
                function formatDate(input) {
                    let value = input.value.replace(/\D/g, ''); // حذف تمام کاراکترهای غیر عددی
                    
                    if (value.length >= 4) {
                        value = value.substring(0, 4) + '/' + value.substring(4);
                    }
                    if (value.length >= 7) {
                        value = value.substring(0, 7) + '/' + value.substring(7, 9);
                    }
                    
                    input.value = value;
                }
                
                startDateInput.addEventListener('input', function() {
                    formatDate(this);
                });
                
                endDateInput.addEventListener('input', function() {
                    formatDate(this);
                });
                
                // اعتبارسنجی فرمت تاریخ
                function validateDate(dateString) {
                    const regex = /^\d{4}\/\d{2}\/\d{2}$/;
                    return regex.test(dateString);
                }
                
                // اعتبارسنجی هنگام ارسال فرم
                const form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    const startDate = startDateInput.value.trim();
                    const endDate = endDateInput.value.trim();
                    
                    if (startDate && !validateDate(startDate)) {
                        alert('فرمت تاریخ شروع ثبت نام صحیح نیست. لطفاً از فرمت YYYY/MM/DD استفاده کنید.');
                        e.preventDefault();
                        return false;
                    }
                    
                    if (endDate && !validateDate(endDate)) {
                        alert('فرمت تاریخ پایان ثبت نام صحیح نیست. لطفاً از فرمت YYYY/MM/DD استفاده کنید.');
                        e.preventDefault();
                        return false;
                    }
                });
            });
            </script>
        </div>
        
        <!-- لیست آزمون‌های موجود -->
        <div class="um-admin-list" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(60% - 20px); min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('آزمون‌های استخدامی', 'university-management'); ?></h2>
            
            <!-- اطلاعات سیستم -->
            <div style="background: #f0f8ff; padding: 10px; margin-bottom: 15px; border-left: 3px solid #0073aa;">
                <strong>اطلاعات سیستم:</strong><br>
                - تعداد کل آزمون‌ها: <?php echo $exams->found_posts; ?><br>
                - زمان فعلی سرور: <?php echo current_time('Y-m-d H:i:s'); ?><br>
                - پست تایپ موجود: <?php echo post_type_exists('um_employment_exams') ? 'بله' : 'خیر'; ?>
            </div>
            
            <?php if ($exams->have_posts()) : ?>
                <table class="wp-list-table widefat fixed striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php _e('عنوان آزمون', 'university-management'); ?></th>
                            <th><?php _e('موقعیت شغلی', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($exams->have_posts()) : $exams->the_post(); 
                            $exam_date = get_post_meta(get_the_ID(), '_exam_date', true);
                            $exam_time = get_post_meta(get_the_ID(), '_exam_time', true);
                            $exam_position = get_post_meta(get_the_ID(), '_exam_position', true);
                            $exam_status = get_post_meta(get_the_ID(), '_exam_status', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : __('تاریخ نامعلوم', 'university-management');
                            
                            // تبدیل وضعیت به متن فارسی
                            $status_labels = array(
                                'upcoming' => __('در انتظار برگزاری', 'university-management'),
                                'registration' => __('در حال ثبت‌نام', 'university-management'),
                                'closed' => __('بسته', 'university-management'),
                                'completed' => __('برگزار شده', 'university-management'),
                                'results_announced' => __('اعلام نتایج', 'university-management')
                            );
                            $status_display = isset($status_labels[$exam_status]) ? $status_labels[$exam_status] : $exam_status;
                        ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($exam_position); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php echo esc_html($status_display); ?></td>
                                <td>
                                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" class="button button-small"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo get_delete_post_link(get_the_ID()); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این آزمون اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php _e('هیچ آزمون استخدامی یافت نشد. برای شروع، اولین آزمون استخدامی خود را از فرم سمت چپ اضافه کنید.', 'university-management'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="um-admin-help" style="margin-top: 30px;">
        <h2><?php _e('راهنما', 'university-management'); ?></h2>
        <p><?php _e('برای استفاده از ویجت آزمون‌های استخدامی، پس از افزودن آزمون‌ها در این قسمت، کافیست ویجت "آزمون‌های استخدامی" را در صفحه‌ساز المنتور به صفحه مورد نظر خود اضافه کنید.', 'university-management'); ?></p>
        <p><?php _e('نکات مهم:', 'university-management'); ?></p>
        <ul style="list-style-type: disc; padding-right: 20px;">
            <li><?php _e('تمام آزمون‌های اضافه شده در این صفحه نمایش داده می‌شوند.', 'university-management'); ?></li>
            <li><?php _e('در صورت نیاز به تغییر زمان یا مشخصات یک آزمون، روی دکمه ویرایش کلیک کنید.', 'university-management'); ?></li>
            <li><?php _e('اضافه کردن تصویر برای آزمون اختیاری است اما برای بهبود ظاهر ویجت توصیه می‌شود.', 'university-management'); ?></li>
            <li><?php _e('وضعیت آزمون را بر اساس مرحله جاری آزمون تنظیم کنید.', 'university-management'); ?></li>
        </ul>
    </div>
</div> 