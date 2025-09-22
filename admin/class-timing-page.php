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

// حذف کلاس (ایمن با نانس)
if (
    isset($_GET['page']) && $_GET['page'] === 'university-class-timing' &&
    isset($_GET['action']) && $_GET['action'] === 'um_delete_class' &&
    isset($_GET['class_id'])
) {
    $class_id = absint($_GET['class_id']);
    if ($class_id) {
        if (!current_user_can('delete_post', $class_id)) {
            add_settings_error('um_class_timing', 'um_class_delete_cap', __('اجازه حذف این کلاس را ندارید.', 'university-management'), 'error');
        } elseif (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'um_delete_class_' . $class_id)) {
            add_settings_error('um_class_timing', 'um_class_delete_nonce', __('اعتبار لینک حذف به پایان رسیده است.', 'university-management'), 'error');
        } else {
            $result = wp_trash_post($class_id);
            if ($result) {
                add_settings_error('um_class_timing', 'um_class_deleted', __('کلاس با موفقیت حذف شد.', 'university-management'), 'success');
            } else {
                add_settings_error('um_class_timing', 'um_class_delete_error', __('خطا در حذف کلاس.', 'university-management'), 'error');
            }
        }
    }
}

// وضعیت ویرایش (لود داده‌های کلاس برای فرم)
$editing_class = null;
$editing_id = 0;
$editing_name = '';
$editing_date_greg = '';
$editing_time = '';
$editing_duration = 90;
$editing_teacher = '';
$editing_description = '';
$editing_status = 'scheduled';

if (
    isset($_GET['page']) && $_GET['page'] === 'university-class-timing' &&
    isset($_GET['action']) && $_GET['action'] === 'um_edit_class' &&
    isset($_GET['class_id'])
) {
    $editing_id = absint($_GET['class_id']);
    if ($editing_id) {
        if (!current_user_can('edit_post', $editing_id)) {
            add_settings_error('um_class_timing', 'um_class_edit_cap', __('اجازه ویرایش این کلاس را ندارید.', 'university-management'), 'error');
        } else {
            $editing_class = get_post($editing_id);
            if ($editing_class && $editing_class->post_type === 'um_classes') {
                $editing_name = $editing_class->post_title;
                $editing_description = $editing_class->post_content;
                $full_dt = get_post_meta($editing_id, '_class_date', true); // YYYY-MM-DD HH:MM:SS
                if ($full_dt) {
                    $editing_date_greg = date('Y-m-d', strtotime($full_dt));
                    $editing_time = date('H:i', strtotime($full_dt));
                }
                $editing_duration = get_post_meta($editing_id, '_class_duration', true);
                $editing_teacher = get_post_meta($editing_id, '_class_teacher', true);
                $editing_status = get_post_meta($editing_id, '_class_status', true) ?: 'scheduled';
            }
        }
    }
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
        $class_status = isset($_POST['class_status']) ? sanitize_text_field($_POST['class_status']) : 'scheduled';
        
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
                    $meta_saved[] = update_post_meta($post_id, '_class_status', in_array($class_status, array('scheduled','canceled','postponed','finished'), true) ? $class_status : 'scheduled');
                    // ذخیره روز هفته برای فیلترهای آتی (0=Sunday ... 6=Saturday در PHP)
                    $weekday_php = (int) date('w', $class_timestamp);
                    update_post_meta($post_id, '_class_weekday', $weekday_php);
                    
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
                    add_settings_error('um_class_timing', 'um_class_added', sprintf(__('کلاس "%s" با موفقیت اضافه شد. شناسه پست: %d (وضعیت: %s)', 'university-management'), $class_name, $post_id, esc_html($class_status)), 'success');
                    
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

// پردازش به‌روزرسانی کلاس
if (isset($_POST['um_update_class_nonce']) && wp_verify_nonce($_POST['um_update_class_nonce'], 'um_update_class')) {
    $class_id = isset($_POST['class_id']) ? absint($_POST['class_id']) : 0;
    if ($class_id && current_user_can('edit_post', $class_id)) {
        $class_name = sanitize_text_field($_POST['class_name']);
        $class_date = sanitize_text_field($_POST['class_date']); // YYYY-MM-DD (از فیلد مخفی)
        $class_time = sanitize_text_field($_POST['class_time']); // HH:MM
        $class_duration = absint($_POST['class_duration']);
        $class_teacher = sanitize_text_field($_POST['class_teacher']);
        $class_description = wp_kses_post($_POST['class_description']);
        $class_status = isset($_POST['class_status']) ? sanitize_text_field($_POST['class_status']) : 'scheduled';

        if (!empty($class_name) && !empty($class_date) && !empty($class_time)) {
            $class_datetime = $class_date . ' ' . $class_time . ':00';
            $class_timestamp = strtotime($class_datetime);
            if ($class_timestamp === false) {
                add_settings_error('um_class_timing', 'um_date_error', __('تاریخ یا زمان وارد شده معتبر نیست.', 'university-management'), 'error');
            } else {
                // به‌روزرسانی پست
                wp_update_post(array(
                    'ID' => $class_id,
                    'post_title' => $class_name,
                    'post_content' => $class_description,
                ));

                update_post_meta($class_id, '_class_date', $class_datetime);
                update_post_meta($class_id, '_class_timestamp', $class_timestamp);
                update_post_meta($class_id, '_class_duration', $class_duration ?: 90);
                update_post_meta($class_id, '_class_teacher', $class_teacher);
                update_post_meta($class_id, '_class_status', in_array($class_status, array('scheduled','canceled','postponed','finished'), true) ? $class_status : 'scheduled');
                // به‌روزرسانی روز هفته
                $weekday_php = (int) date('w', $class_timestamp);
                update_post_meta($class_id, '_class_weekday', $weekday_php);

                // تصویر (اختیاری)
                if (isset($_FILES['class_image']) && !empty($_FILES['class_image']['name'])) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/media.php');
                    $attachment_id = media_handle_upload('class_image', $class_id);
                    if (!is_wp_error($attachment_id)) {
                        set_post_thumbnail($class_id, $attachment_id);
                    }
                }

                add_settings_error('um_class_timing', 'um_class_updated', sprintf(__('کلاس با موفقیت به‌روزرسانی شد. (وضعیت: %s)', 'university-management'), esc_html($class_status)), 'success');

                // خروج از حالت ویرایش پس از موفقیت
                $editing_class = null;
                $editing_id = 0;
                $editing_name = $editing_description = $editing_date_greg = $editing_time = '';
                $editing_duration = 90;
                $editing_teacher = '';
                $editing_status = 'scheduled';
            }
        } else {
            add_settings_error('um_class_timing', 'um_class_update_required', __('نام کلاس، تاریخ و زمان الزامی هستند.', 'university-management'), 'error');
        }
    } else {
        add_settings_error('um_class_timing', 'um_class_update_cap', __('اجازه ویرایش این کلاس را ندارید.', 'university-management'), 'error');
    }
}

// نمایش پیام‌های خطا/موفقیت
settings_errors('um_class_timing');

// بررسی پیام موفقیت از redirect
if (isset($_GET['added']) && $_GET['added'] == '1') {
    echo '<div class="notice notice-success is-dismissible"><p>' . __('کلاس با موفقیت اضافه شد!', 'university-management') . '</p></div>';
}

// دریافت کلاس‌های موجود
// ساخت فیلترهای تاریخ و روز هفته از ورودی
$from = isset($_GET['um_from']) ? sanitize_text_field($_GET['um_from']) : '';
$to = isset($_GET['um_to']) ? sanitize_text_field($_GET['um_to']) : '';
$fullweek = isset($_GET['um_fullweek']) && $_GET['um_fullweek'] == '1';
$weekdays = isset($_GET['um_weekdays']) && is_array($_GET['um_weekdays']) ? array_map('intval', $_GET['um_weekdays']) : array();

$meta_query = array();
// بازه تاریخ
if ($from && $to) {
    $meta_query[] = array(
        'key' => '_class_date',
        'value' => array($from . ' 00:00:00', $to . ' 23:59:59'),
        'compare' => 'BETWEEN',
        'type' => 'DATETIME',
    );
} elseif ($from) {
    $meta_query[] = array(
        'key' => '_class_date',
        'value' => $from . ' 00:00:00',
        'compare' => '>=',
        'type' => 'DATETIME',
    );
} else {
    // پیش‌فرض آینده
    $meta_query[] = array(
        'key' => '_class_date',
        'value' => date('Y-m-d 00:00:00'),
        'compare' => '>=',
        'type' => 'DATETIME',
    );
}

// روزهای هفته: اگر fullweek فعال نیست و آرایه‌ای انتخاب شده
if (!$fullweek && !empty($weekdays)) {
    // استفاده از compare IN روی متای `_class_weekday`
    $meta_query[] = array(
        'key' => '_class_weekday',
        'value' => $weekdays,
        'compare' => 'IN',
        'type' => 'NUMERIC',
    );
}

$args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'meta_value',
    'meta_key'       => '_class_date',
    'order'          => 'ASC',
    'meta_query'     => $meta_query,
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
        <!-- فرم افزودن/ویرایش کلاس -->
        <div class="um-admin-form" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 40%; min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php echo $editing_class ? __('ویرایش کلاس', 'university-management') : __('افزودن کلاس جدید', 'university-management'); ?></h2>
            
            <form method="post" action="" enctype="multipart/form-data">
                <?php if ($editing_class): ?>
                    <input type="hidden" name="class_id" value="<?php echo esc_attr($editing_id); ?>">
                    <?php wp_nonce_field('um_update_class', 'um_update_class_nonce'); ?>
                <?php else: ?>
                    <?php wp_nonce_field('um_add_class', 'um_add_class_nonce'); ?>
                <?php endif; ?>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_name" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام کلاس', 'university-management'); ?> *</label>
                    <input type="text" id="class_name" name="class_name" class="regular-text" required style="width: 100%;" value="<?php echo esc_attr($editing_class ? $editing_name : ''); ?>">
                </div>
                
<script>
(function(){
  // جلوگیری از رفتن به ویرایشگر پست‌تایپ؛ ویرایش باید در همین صفحه انجام شود
  document.addEventListener('click', function(e){
    var a = e.target.closest('a.um-edit-class');
    if (a){
      // اگر href به post.php باشد، مسیر را به edit داخلی تغییر بده
      try {
        var href = a.getAttribute('href') || '';
        if (href.indexOf('post.php') !== -1){
          e.preventDefault();
          var id = a.getAttribute('data-class-id');
          var url = new URL(window.location.href);
          url.searchParams.set('page','university-class-timing');
          url.searchParams.set('action','um_edit_class');
          url.searchParams.set('class_id', id);
          window.location.assign(url.toString());
          return false;
        }
      } catch(err) {}
    }
  }, true);

  function ensureMoment(cb){
    function loadScript(src, onload){ var s=document.createElement('script'); s.src=src; s.async=true; s.onload=onload; document.head.appendChild(s); }
    if (typeof moment === 'undefined'){
      loadScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', function(){
        loadScript('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', cb);
      });
    } else if (typeof moment.loadPersian === 'undefined'){
      loadScript('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', cb);
    } else { cb(); }
  }

  function initJDate(){
    try {
      if (typeof moment.loadPersian === 'function') moment.loadPersian({usePersianDigits:false});

      var display = document.getElementById('class_date_display');
      var hidden = document.getElementById('class_date');
      if (!display || !hidden) return;

      // اگر مقدار اولیه میلادی داریم، در ورودی شمسی نشان دهیم
      if (hidden.value){
        var m = moment(hidden.value, 'YYYY-MM-DD');
        if (m.isValid()) display.value = m.format('jYYYY/jMM/jDD');
      }

      display.addEventListener('input', function(){
        var v = (display.value || '').replace(/[-.]/g,'/');
        var m = moment(v, 'jYYYY/jMM/jDD', true);
        if (m.isValid()){
          hidden.value = m.format('YYYY-MM-DD');
          display.setCustomValidity('');
        } else {
          hidden.value = '';
          display.setCustomValidity('تاریخ نامعتبر است. مثال: 1404/05/20');
        }
      });

      var form = display.form; 
      if (form){
        form.addEventListener('submit', function(e){
          if (!hidden.value){ e.preventDefault(); display.reportValidity(); }
        });
      }
    } catch(e){ console.warn('Class timing JDate init error', e); }
  }

  if (document.readyState === 'loading'){
    document.addEventListener('DOMContentLoaded', function(){ ensureMoment(initJDate); });
  } else { ensureMoment(initJDate); }
})();
</script>
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_date_display" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ کلاس', 'university-management'); ?> *</label>
                    <input type="text" id="class_date_display" class="regular-text" required style="width: 100%;" placeholder="مثال: ۱۴۰۴/۰۵/۲۰">
                    <input type="hidden" id="class_date" name="class_date" value="<?php echo esc_attr($editing_class ? $editing_date_greg : ''); ?>">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_time" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('زمان شروع کلاس', 'university-management'); ?> *</label>
                    <input type="time" id="class_time" name="class_time" class="regular-text" required style="width: 100%;" value="<?php echo esc_attr($editing_class ? $editing_time : ''); ?>">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_duration" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('مدت زمان کلاس (دقیقه)', 'university-management'); ?></label>
                    <input type="number" id="class_duration" name="class_duration" class="regular-text" min="30" step="5" value="<?php echo esc_attr($editing_class ? ($editing_duration ?: 90) : 90); ?>" style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_teacher" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام استاد', 'university-management'); ?></label>
                    <input type="text" id="class_teacher" name="class_teacher" class="regular-text" style="width: 100%;" value="<?php echo esc_attr($editing_class ? $editing_teacher : ''); ?>">
                </div>

                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_status" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('وضعیت کلاس', 'university-management'); ?></label>
                    <select id="class_status" name="class_status" style="width: 100%;">
                        <?php $status_current = $editing_class ? $editing_status : 'scheduled'; ?>
                        <option value="scheduled" <?php selected($status_current, 'scheduled'); ?>><?php _e('زمان‌بندی‌شده', 'university-management'); ?></option>
                        <option value="canceled" <?php selected($status_current, 'canceled'); ?>><?php _e('لغو شد', 'university-management'); ?></option>
                        <option value="postponed" <?php selected($status_current, 'postponed'); ?>><?php _e('به زمان دیگری موکول شد', 'university-management'); ?></option>
                        <option value="finished" <?php selected($status_current, 'finished'); ?>><?php _e('برگزار شد', 'university-management'); ?></option>
                    </select>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_description" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('توضیحات کلاس', 'university-management'); ?></label>
                    <textarea id="class_description" name="class_description" rows="5" class="regular-text" style="width: 100%;"><?php echo esc_textarea($editing_class ? $editing_description : ''); ?></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_image" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تصویر کلاس', 'university-management'); ?></label>
                    <input type="file" id="class_image" name="class_image" accept="image/*">
                </div>
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php echo $editing_class ? esc_attr__('به‌روزرسانی کلاس', 'university-management') : esc_attr__('افزودن کلاس', 'university-management'); ?>">
                    <?php if ($editing_class): ?>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=university-class-timing')); ?>" class="button" style="margin-right:10px;"><?php _e('لغو ویرایش', 'university-management'); ?></a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <!-- لیست کلاس‌های آینده -->
        <div class="um-admin-list" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(60% - 20px); min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('کلاس‌های آینده', 'university-management'); ?></h2>
            <form method="get" style="margin:10px 0 20px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
                <input type="hidden" name="page" value="university-class-timing">
                <div>
                    <label style="display:block;font-weight:bold;">از تاریخ (شمسی)</label>
                    <input type="text" name="um_from_jdate" id="um_from_jdate" value="<?php echo isset($_GET['um_from_jdate'])? esc_attr($_GET['um_from_jdate']) : ''; ?>" placeholder="1404/01/01" style="width:140px;">
                    <input type="hidden" name="um_from" id="um_from" value="<?php echo isset($_GET['um_from'])? esc_attr($_GET['um_from']) : ''; ?>">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;">تا تاریخ (شمسی)</label>
                    <input type="text" name="um_to_jdate" id="um_to_jdate" value="<?php echo isset($_GET['um_to_jdate'])? esc_attr($_GET['um_to_jdate']) : ''; ?>" placeholder="1404/01/30" style="width:140px;">
                    <input type="hidden" name="um_to" id="um_to" value="<?php echo isset($_GET['um_to'])? esc_attr($_GET['um_to']) : ''; ?>">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;">حالت نمایش</label>
                    <select name="um_mode" style="width:140px;">
                        <option value="single" <?php selected(isset($_GET['um_mode'])?$_GET['um_mode']:'' , 'single'); ?>>single</option>
                        <option value="range" <?php selected(isset($_GET['um_mode'])?$_GET['um_mode']:'' , 'range'); ?>>range</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:bold;">نمایش کل هفته</label>
                    <label style="display:flex;gap:6px;align-items:center;">
                        <input type="checkbox" name="um_fullweek" value="1" <?php checked(isset($_GET['um_fullweek']) && $_GET['um_fullweek']=='1'); ?>> بله
                    </label>
                </div>
                <div>
                    <label style="display:block;font-weight:bold;">روزهای هفته</label>
                    <?php $weekdays = isset($_GET['um_weekdays']) && is_array($_GET['um_weekdays']) ? array_map('intval', $_GET['um_weekdays']) : array(); ?>
                    <select multiple name="um_weekdays[]" style="min-width:180px;height:84px;">
                        <?php
                        $labels = array(
                            6 => 'شنبه', 0 => 'یکشنبه', 1 => 'دوشنبه', 2 => 'سه‌شنبه', 3 => 'چهارشنبه', 4 => 'پنجشنبه', 5 => 'جمعه'
                        );
                        foreach ($labels as $phpW => $label) {
                            echo '<option value="' . esc_attr($phpW) . '"' . (in_array($phpW, $weekdays, true) ? ' selected' : '') . '>' . esc_html($label) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button class="button button-primary" type="submit">اعمال فیلتر</button>
                    <a class="button" href="<?php echo esc_url(admin_url('admin.php?page=university-class-timing')); ?>">ریست</a>
                </div>
            </form>
            <script>
            (function(){
                function ensure(cb){
                    function ls(src, cb2){ var s=document.createElement('script'); s.src=src; s.async=true; s.onload=cb2; document.head.appendChild(s); }
                    if (typeof moment==='undefined'){ ls('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', function(){ ls('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', cb); }); }
                    else if (typeof moment.loadPersian==='undefined'){ ls('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', cb); }
                    else cb();
                }
                function init(){
                    try{ if (typeof moment.loadPersian==='function') moment.loadPersian({usePersianDigits:false}); }catch(e){}
                    var fromDisp=document.getElementById('um_from_jdate');
                    var toDisp=document.getElementById('um_to_jdate');
                    var fromH=document.getElementById('um_from');
                    var toH=document.getElementById('um_to');
                    function bind(disp, hidden){
                        if (!disp || !hidden) return;
                        if (hidden.value){
                            var m = moment(hidden.value, 'YYYY-MM-DD');
                            if (m.isValid()) disp.value = m.format('jYYYY/jMM/jDD');
                        }
                        disp.addEventListener('input', function(){
                            var v = (disp.value||'').replace(/[-.]/g,'/');
                            var m = moment(v, 'jYYYY/jMM/jDD', true);
                            if (m.isValid()) hidden.value = m.format('YYYY-MM-DD'); else hidden.value='';
                        });
                    }
                    bind(fromDisp, fromH); bind(toDisp, toH);
                }
                if (document.readyState==='loading') document.addEventListener('DOMContentLoaded', function(){ ensure(init); }); else ensure(init);
            })();
            </script>
            
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
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
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
                                <td><?php 
                                    $status = get_post_meta(get_the_ID(), '_class_status', true);
                                    $status_text = '';
                                    switch($status) {
                                        case 'canceled': $status_text = 'لغو شد'; break;
                                        case 'postponed': $status_text = 'موکول شد'; break;
                                        case 'finished': $status_text = 'برگزار شد'; break;
                                        default: $status_text = 'زمان‌بندی‌شده'; break;
                                    }
                                    echo esc_html($status_text) . ' (' . esc_html($status ?: 'scheduled') . ')';
                                ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-class-timing',
                                                'action' => 'um_edit_class',
                                                'class_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-class-timing',
                                                    'action' => 'um_delete_class',
                                                    'class_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_class_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small um-edit-class" data-class-id="<?php echo get_the_ID(); ?>"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
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
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
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
                                <td><?php 
                                    $status = get_post_meta(get_the_ID(), '_class_status', true);
                                    $status_text = '';
                                    switch($status) {
                                        case 'canceled': $status_text = 'لغو شد'; break;
                                        case 'postponed': $status_text = 'موکول شد'; break;
                                        case 'finished': $status_text = 'برگزار شد'; break;
                                        default: $status_text = 'زمان‌بندی‌شده'; break;
                                    }
                                    echo esc_html($status_text) . ' (' . esc_html($status ?: 'scheduled') . ')';
                                ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-class-timing',
                                                'action' => 'um_edit_class',
                                                'class_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-class-timing',
                                                    'action' => 'um_delete_class',
                                                    'class_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_class_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small um-edit-class" data-class-id="<?php echo get_the_ID(); ?>"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
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
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
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
                                <td><?php 
                                    $status = get_post_meta(get_the_ID(), '_class_status', true);
                                    $status_text = '';
                                    switch($status) {
                                        case 'canceled': $status_text = 'لغو شد'; break;
                                        case 'postponed': $status_text = 'موکول شد'; break;
                                        case 'finished': $status_text = 'برگزار شد'; break;
                                        default: $status_text = 'زمان‌بندی‌شده'; break;
                                    }
                                    echo esc_html($status_text) . ' (' . esc_html($status ?: 'scheduled') . ')';
                                ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-class-timing',
                                                'action' => 'um_edit_class',
                                                'class_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-class-timing',
                                                    'action' => 'um_delete_class',
                                                    'class_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_class_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small um-edit-class" data-class-id="<?php echo get_the_ID(); ?>"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
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