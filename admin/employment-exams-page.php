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
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php _e('افزودن آزمون استخدامی', 'university-management'); ?>">
                </div>
            </form>
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
                                'completed' => __('برگزار شده', 'university-management')
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