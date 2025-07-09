<?php
/**
 * صفحه مدیریت زمان‌بندی کلاس‌ها
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
if (isset($_POST['um_add_class_nonce']) && wp_verify_nonce($_POST['um_add_class_nonce'], 'um_add_class')) {
    
    // بررسی وجود پست تایپ
    if (!post_type_exists('um_classes')) {
        add_settings_error('um_class_timing', 'um_post_type_error', __('خطا: پست تایپ "um_classes" ثبت نشده است. لطفاً افزونه را غیرفعال و مجدداً فعال کنید.', 'university-management'), 'error');
    } else {
        // دریافت مقادیر فرم
        $class_name = sanitize_text_field($_POST['class_name']);
        $class_date = sanitize_text_field($_POST['class_date']);
        $class_time = sanitize_text_field($_POST['class_time']);
        $class_duration = absint($_POST['class_duration']);
        $class_teacher = sanitize_text_field($_POST['class_teacher']);
        $class_description = wp_kses_post($_POST['class_description']);
        
        // بررسی داده‌های الزامی
        if (!empty($class_name) && !empty($class_date) && !empty($class_time)) {
            // تبدیل تاریخ به فرمت مناسب
            $class_datetime = $class_date . ' ' . $class_time . ':00';
            
            // تبدیل به timestamp برای بهتر کار کردن
            $class_timestamp = strtotime($class_datetime);
            if ($class_timestamp === false) {
                add_settings_error('um_class_timing', 'um_date_error', __('تاریخ یا زمان وارد شده معتبر نیست.', 'university-management'), 'error');
            } else {
                // ایجاد پست جدید
                $post_data = array(
                    'post_title'    => $class_name,
                    'post_content'  => $class_description,
                    'post_status'   => 'publish',
                    'post_type'     => 'um_classes',
                    'post_author'   => get_current_user_id(),
                );
                
                $post_id = wp_insert_post($post_data);
                
                // Debug: چک کردن نتیجه wp_insert_post
                error_log('UM Debug: wp_insert_post result: ' . print_r($post_id, true));
                error_log('UM Debug: post_data: ' . print_r($post_data, true));
                
                if (!is_wp_error($post_id) && $post_id > 0) {
                    // ذخیره متادیتا
                    $meta_saved = array();
                    $meta_saved[] = update_post_meta($post_id, '_class_date', $class_datetime);
                    $meta_saved[] = update_post_meta($post_id, '_class_timestamp', $class_timestamp);
                    $meta_saved[] = update_post_meta($post_id, '_class_duration', $class_duration ?: 90);
                    $meta_saved[] = update_post_meta($post_id, '_class_teacher', $class_teacher);
                    
                    // اضافه کردن تصویر شاخص (اگر آپلود شده باشد)
                    if (isset($_FILES['class_image']) && !empty($_FILES['class_image']['name'])) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                        
                        $attachment_id = media_handle_upload('class_image', $post_id);
                        
                        if (!is_wp_error($attachment_id)) {
                            set_post_thumbnail($post_id, $attachment_id);
                        }
                    }
                    
                    // نمایش پیام موفقیت
                    add_settings_error('um_class_timing', 'um_class_added', sprintf(__('کلاس "%s" با موفقیت اضافه شد. شناسه پست: %d', 'university-management'), $class_name, $post_id), 'success');
                    
                    // بازنشانی فرم برای جلوگیری از ارسال مجدد
                    // wp_redirect(add_query_arg(array('page' => 'university-class-timing', 'added' => '1'), admin_url('admin.php')));
                    // exit;
                } else {
                    // نمایش پیام خطا با جزئیات بیشتر
                    $error_message = is_wp_error($post_id) ? $post_id->get_error_message() : 'خطای نامشخص در ایجاد پست';
                    add_settings_error('um_class_timing', 'um_class_error', sprintf(__('خطا در افزودن کلاس: %s', 'university-management'), $error_message), 'error');
                }
            }
        } else {
            // نمایش پیام خطا برای فیلدهای الزامی
            add_settings_error('um_class_timing', 'um_class_required', __('نام کلاس، تاریخ و زمان الزامی هستند.', 'university-management'), 'error');
        }
    }
} elseif (isset($_POST['um_add_class_nonce'])) {
    // اگر nonce معتبر نباشد
    add_settings_error('um_class_timing', 'um_nonce_error', __('خطای امنیتی. لطفاً دوباره تلاش کنید.', 'university-management'), 'error');
}

// نمایش پیام‌های خطا/موفقیت
settings_errors('um_class_timing');

// بررسی پیام موفقیت از redirect
if (isset($_GET['added']) && $_GET['added'] == '1') {
    echo '<div class="notice notice-success is-dismissible"><p>' . __('کلاس با موفقیت اضافه شد!', 'university-management') . '</p></div>';
}

// دریافت کلاس‌های موجود
$args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'meta_value',
    'meta_key'       => '_class_date',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => '_class_date',
            'value'   => date('Y-m-d 00:00:00'), // شروع روز جاری
            'compare' => '>=',
            'type'    => 'DATETIME'
        )
    )
);

$classes = new WP_Query($args);

// برای debugging - بیایید تمام کلاس‌ها را هم چک کنیم
$all_classes_args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);
$all_classes = new WP_Query($all_classes_args);

// Query ساده برای تست
$simple_classes_args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => array('publish', 'draft', 'private'),
);
$simple_classes = new WP_Query($simple_classes_args);
?>

<div class="wrap">
    <h1><?php _e('مدیریت زمان‌بندی کلاس‌ها', 'university-management'); ?></h1>
    
    <div class="um-admin-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <!-- فرم افزودن کلاس جدید -->
        <div class="um-admin-form" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 40%; min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('افزودن کلاس جدید', 'university-management'); ?></h2>
            
            <form method="post" action="" enctype="multipart/form-data">
                <?php wp_nonce_field('um_add_class', 'um_add_class_nonce'); ?>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_name" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام کلاس', 'university-management'); ?> *</label>
                    <input type="text" id="class_name" name="class_name" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_date" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ کلاس', 'university-management'); ?> *</label>
                    <input type="date" id="class_date" name="class_date" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_time" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('زمان شروع کلاس', 'university-management'); ?> *</label>
                    <input type="time" id="class_time" name="class_time" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_duration" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('مدت زمان کلاس (دقیقه)', 'university-management'); ?></label>
                    <input type="number" id="class_duration" name="class_duration" class="regular-text" min="30" step="5" value="90" style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_teacher" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام استاد', 'university-management'); ?></label>
                    <input type="text" id="class_teacher" name="class_teacher" class="regular-text" style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_description" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('توضیحات کلاس', 'university-management'); ?></label>
                    <textarea id="class_description" name="class_description" rows="5" class="regular-text" style="width: 100%;"></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_image" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تصویر کلاس', 'university-management'); ?></label>
                    <input type="file" id="class_image" name="class_image" accept="image/*">
                </div>
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php _e('افزودن کلاس', 'university-management'); ?>">
                </div>
            </form>
        </div>
        
        <!-- لیست کلاس‌های آینده -->
        <div class="um-admin-list" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(60% - 20px); min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('کلاس‌های آینده', 'university-management'); ?></h2>
            
            <!-- اطلاعات debugging -->
            <div style="background: #f0f8ff; padding: 10px; margin-bottom: 15px; border-left: 3px solid #0073aa;">
                <strong>اطلاعات سیستم:</strong><br>
                - تعداد کل کلاس‌ها (Query ساده): <?php echo $simple_classes->found_posts; ?><br>
                - تعداد کل کلاس‌ها (Query عادی): <?php echo $all_classes->found_posts; ?><br>
                - تعداد کلاس‌های آینده: <?php echo $classes->found_posts; ?><br>
                - زمان فعلی سرور: <?php echo current_time('Y-m-d H:i:s'); ?><br>
                - تاریخ شروع روز: <?php echo date('Y-m-d 00:00:00'); ?><br>
                - پست تایپ موجود: <?php echo post_type_exists('um_classes') ? 'بله' : 'خیر'; ?>
            </div>
            
            <?php if ($simple_classes->have_posts()) : ?>
                <h3>تمام کلاس‌ها (Query ساده):</h3>
                <table class="wp-list-table widefat fixed striped" style="width: 100%; margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th><?php _e('نام کلاس', 'university-management'); ?></th>
                            <th><?php _e('استاد', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('مدت (دقیقه)', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($simple_classes->have_posts()) : $simple_classes->the_post(); 
                            $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                            $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                            $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = $class_date ? date_i18n('Y/m/d H:i', strtotime($class_date)) : 'تاریخ نامعلوم';
                        ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($class_teacher); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" class="button button-small"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo get_delete_post_link(get_the_ID()); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            
            <?php if ($all_classes->have_posts()) : ?>
                <h3>تمام کلاس‌ها (Query عادی):</h3>
                <table class="wp-list-table widefat fixed striped" style="width: 100%; margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th><?php _e('نام کلاس', 'university-management'); ?></th>
                            <th><?php _e('استاد', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('مدت (دقیقه)', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($all_classes->have_posts()) : $all_classes->the_post(); 
                            $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                            $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                            $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = $class_date ? date_i18n('Y/m/d H:i', strtotime($class_date)) : 'تاریخ نامعلوم';
                        ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($class_teacher); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" class="button button-small"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo get_delete_post_link(get_the_ID()); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            
            <?php if ($classes->have_posts()) : ?>
                <h3>کلاس‌های آینده:</h3>
                <table class="wp-list-table widefat fixed striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php _e('نام کلاس', 'university-management'); ?></th>
                            <th><?php _e('استاد', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('مدت (دقیقه)', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($classes->have_posts()) : $classes->the_post(); 
                            $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                            $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                            $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = $class_date ? date_i18n('Y/m/d H:i', strtotime($class_date)) : 'تاریخ نامعلوم';
                        ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($class_teacher); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" class="button button-small"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo get_delete_post_link(get_the_ID()); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php _e('هیچ کلاس آینده‌ای ثبت نشده است.', 'university-management'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="um-admin-help" style="margin-top: 30px;">
        <h2><?php _e('راهنما', 'university-management'); ?></h2>
        <p><?php _e('برای استفاده از ویجت زمان‌بندی کلاس‌ها، پس از افزودن کلاس‌ها در این قسمت، کافیست ویجت "زمان‌بندی کلاس‌ها" را در صفحه‌ساز المنتور به صفحه مورد نظر خود اضافه کنید.', 'university-management'); ?></p>
        <p><?php _e('نکات مهم:', 'university-management'); ?></p>
        <ul style="list-style-type: disc; padding-right: 20px;">
            <li><?php _e('در این صفحه فقط کلاس‌های آینده نمایش داده می‌شوند.', 'university-management'); ?></li>
            <li><?php _e('در صورت نیاز به تغییر زمان یا مشخصات یک کلاس، روی دکمه ویرایش کلیک کنید.', 'university-management'); ?></li>
            <li><?php _e('اضافه کردن تصویر برای کلاس اختیاری است اما برای بهبود ظاهر ویجت توصیه می‌شود.', 'university-management'); ?></li>
        </ul>
    </div>
</div> 