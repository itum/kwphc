<?php
/**
 * صفحه مدیریت تقویم دانشگاه
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// حذف رویداد (ایمن با نانس و بدون اتکا به post.php)
if (
    isset($_GET['page']) && $_GET['page'] === 'university-calendar' &&
    isset($_GET['action']) && $_GET['action'] === 'um_delete' &&
    isset($_GET['event_id'])
){
    $event_id = absint($_GET['event_id']);
    if ($event_id) {
        // بررسی دسترسی
        if (!current_user_can('delete_post', $event_id)) {
            add_settings_error('um_calendar', 'um_event_delete_cap', __('اجازه حذف این رویداد را ندارید.', 'university-management'), 'error');
        } elseif (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'um_delete_event_' . $event_id)) {
            add_settings_error('um_calendar', 'um_event_delete_nonce', __('اعتبار لینک حذف به پایان رسیده است.', 'university-management'), 'error');
        } else {
            // انتقال به زباله‌دان؛ برای حذف دائمی از پارامتر دوم true استفاده کنید
            $result = wp_trash_post($event_id);
            if ($result) {
                add_settings_error('um_calendar', 'um_event_deleted', __('رویداد با موفقیت حذف شد.', 'university-management'), 'success');
            } else {
                add_settings_error('um_calendar', 'um_event_delete_error', __('خطا در حذف رویداد.', 'university-management'), 'error');
            }
        }
    }
}

// تعیین حالت ویرایش و بارگذاری اطلاعات رویداد برای فرم
$editing_event = null;
$editing_event_id = 0;
$editing_title = '';
$editing_description = '';
$editing_date = '';
$editing_is_important = '';
$editing_lang = '';

if (
    isset($_GET['page']) && $_GET['page'] === 'university-calendar' &&
    isset($_GET['action']) && $_GET['action'] === 'um_edit' &&
    isset($_GET['event_id'])
) {
    $editing_event_id = absint($_GET['event_id']);
    if ($editing_event_id) {
        if (!current_user_can('edit_post', $editing_event_id)) {
            add_settings_error('um_calendar', 'um_event_edit_cap', __('اجازه ویرایش این رویداد را ندارید.', 'university-management'), 'error');
        } else {
            $editing_event = get_post($editing_event_id);
            if ($editing_event && $editing_event->post_type === 'um_calendar_events') {
                $editing_title = $editing_event->post_title;
                $editing_description = $editing_event->post_content;
                $editing_date = get_post_meta($editing_event_id, '_event_date', true);
                $editing_is_important = get_post_meta($editing_event_id, '_is_important', true);
                if (function_exists('pll_get_post_language')) {
                    $editing_lang = pll_get_post_language($editing_event_id);
                }
            }
        }
    }
}

// پردازش فرم ارسالی
if (isset($_POST['um_add_event_nonce']) && wp_verify_nonce($_POST['um_add_event_nonce'], 'um_add_event')) {
    // دریافت مقادیر فرم
    $event_title = sanitize_text_field($_POST['event_title']);
    $event_date = sanitize_text_field($_POST['event_date']);
    $event_description = wp_kses_post($_POST['event_description']);
    $is_important = isset($_POST['is_important']) ? 'yes' : '';
    $event_language = isset($_POST['event_language']) ? sanitize_text_field($_POST['event_language']) : '';
    
    // بررسی داده‌های الزامی
    if (!empty($event_title) && !empty($event_date) && !empty($event_language)) {
        // ایجاد پست جدید
        $post_data = array(
            'post_title'    => $event_title,
            'post_content'  => $event_description,
            'post_status'   => 'publish',
            'post_type'     => 'um_calendar_events',
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id)) {
            // ذخیره متادیتا
            update_post_meta($post_id, '_event_date', $event_date);
            update_post_meta($post_id, '_is_important', $is_important);
            
            // تنظیم زبان برای Polylang
            if (!empty($event_language) && function_exists('pll_set_post_language')) {
                pll_set_post_language($post_id, $event_language);
            }
            
            // نمایش پیام موفقیت
            add_settings_error('um_calendar', 'um_event_added', __('رویداد با موفقیت اضافه شد.', 'university-management'), 'success');
        } else {
            // نمایش پیام خطا
            add_settings_error('um_calendar', 'um_event_error', __('خطا در افزودن رویداد.', 'university-management'), 'error');
        }
    } else {
        // نمایش پیام خطا برای فیلدهای الزامی
        add_settings_error('um_calendar', 'um_event_required', __('عنوان، تاریخ و زبان رویداد الزامی هستند.', 'university-management'), 'error');
    }
}

// پردازش ویرایش رویداد
if (isset($_POST['um_update_event_nonce']) && wp_verify_nonce($_POST['um_update_event_nonce'], 'um_update_event')) {
    $event_id = isset($_POST['event_id']) ? absint($_POST['event_id']) : 0;
    if ($event_id && current_user_can('edit_post', $event_id)) {
        $event_title = sanitize_text_field($_POST['event_title']);
        $event_date  = sanitize_text_field($_POST['event_date']);
        $event_description = wp_kses_post($_POST['event_description']);
        $is_important = isset($_POST['is_important']) ? 'yes' : '';
        $event_language = isset($_POST['event_language']) ? sanitize_text_field($_POST['event_language']) : '';

        if (!empty($event_title) && !empty($event_date)) {
            wp_update_post(array(
                'ID' => $event_id,
                'post_title' => $event_title,
                'post_content' => $event_description,
            ));
            update_post_meta($event_id, '_event_date', $event_date);
            update_post_meta($event_id, '_is_important', $is_important);

            if (!empty($event_language) && function_exists('pll_set_post_language')) {
                pll_set_post_language($event_id, $event_language);
            }

            add_settings_error('um_calendar', 'um_event_updated', __('رویداد با موفقیت به‌روزرسانی شد.', 'university-management'), 'success');
            // پس از ذخیره موفق، خروج از حالت ویرایش
            $editing_event = null;
            $editing_event_id = 0;
            $editing_title = $editing_description = $editing_date = $editing_is_important = $editing_lang = '';
        } else {
            add_settings_error('um_calendar', 'um_event_update_required', __('عنوان و تاریخ الزامی هستند.', 'university-management'), 'error');
        }
    } else {
        add_settings_error('um_calendar', 'um_event_update_cap', __('اجازه ویرایش این رویداد را ندارید.', 'university-management'), 'error');
    }
}

// نمایش پیام‌های خطا/موفقیت
settings_errors('um_calendar');

// دریافت رویدادهای موجود
$args = array(
    'post_type'      => 'um_calendar_events',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value',
    'meta_key'       => '_event_date',
    'order'          => 'ASC',
);

// فیلتر بر اساس زبان (اگر Polylang فعال باشد)
if (function_exists('pll_current_language') && isset($_GET['lang_filter'])) {
    $current_lang = sanitize_text_field($_GET['lang_filter']);
    if (!empty($current_lang)) {
        // لاگ برای دیباگ
        um_log('=== CALENDAR LANGUAGE FILTER DEBUG ===');
        um_log('Selected Language: ' . $current_lang);
        
        // ابتدا همه پست‌ها را دریافت کن
        $all_events = new WP_Query(array(
            'post_type' => 'um_calendar_events',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'meta_key' => '_event_date',
            'order' => 'ASC',
        ));
        
        // فیلتر بر اساس زبان
        $filtered_posts = array();
        if ($all_events->have_posts()) {
            while ($all_events->have_posts()) {
                $all_events->the_post();
                $post_lang = pll_get_post_language(get_the_ID());
                error_log('Post ID: ' . get_the_ID() . ', Title: ' . get_the_title() . ', Language: ' . $post_lang);
                
                if ($post_lang === $current_lang) {
                    $filtered_posts[] = get_the_ID();
                }
            }
            wp_reset_postdata();
        }
        
        // کوئری جدید با پست‌های فیلتر شده
        if (!empty($filtered_posts)) {
            $args = array(
                'post_type' => 'um_calendar_events',
                'posts_per_page' => -1,
                'orderby' => 'meta_value',
                'meta_key' => '_event_date',
                'order' => 'ASC',
                'post__in' => $filtered_posts,
            );
        } else {
            // اگر هیچ پستی با زبان انتخاب شده نباشد، کوئری خالی
            $args = array(
                'post_type' => 'um_calendar_events',
                'posts_per_page' => -1,
                'post__in' => array(0), // هیچ پستی
            );
        }
        
        error_log('Filtered Posts: ' . print_r($filtered_posts, true));
        error_log('Final Query Args: ' . print_r($args, true));
    }
}

$events = new WP_Query($args);
error_log('Found Posts: ' . $events->found_posts);
?>

<div class="wrap">
    <h1><?php _e('مدیریت تقویم دانشگاه', 'university-management'); ?></h1>
    
    <div class="um-admin-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <!-- فرم افزودن رویداد جدید -->
        <div class="um-admin-form" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 40%; min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php echo $editing_event ? __('ویرایش رویداد', 'university-management') : __('افزودن رویداد جدید', 'university-management'); ?></h2>
            
            <form method="post" action="">
                <?php if ($editing_event): ?>
                    <input type="hidden" name="event_id" value="<?php echo esc_attr($editing_event_id); ?>">
                    <?php wp_nonce_field('um_update_event', 'um_update_event_nonce'); ?>
                <?php else: ?>
                    <?php wp_nonce_field('um_add_event', 'um_add_event_nonce'); ?>
                <?php endif; ?>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_title" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('عنوان رویداد', 'university-management'); ?> *</label>
                    <input type="text" id="event_title" name="event_title" class="regular-text" required style="width: 100%;" value="<?php echo esc_attr($editing_event ? $editing_title : ''); ?>">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_date_display" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ رویداد', 'university-management'); ?> *</label>
                    <!-- فیلد نمایش جلالی -->
                    <input type="text" id="event_date_display" class="regular-text" required style="width: 100%;" placeholder="مثال: ۱۴۰۴/۰۵/۲۰">
                    <!-- فیلد مخفی برای ذخیره تاریخ میلادی (ISO: YYYY-MM-DD) -->
                    <input type="hidden" id="event_date" name="event_date" value="<?php echo esc_attr($editing_event ? $editing_date : ''); ?>">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_description" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('توضیحات رویداد', 'university-management'); ?></label>
                    <textarea id="event_description" name="event_description" rows="5" class="regular-text" style="width: 100%;"><?php echo esc_textarea($editing_event ? $editing_description : ''); ?></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label style="font-weight: bold;">
                        <input type="checkbox" name="is_important" value="yes" <?php echo ($editing_event && $editing_is_important === 'yes') ? 'checked' : ''; ?>>
                        <?php _e('رویداد مهم (هایلایت)', 'university-management'); ?>
                    </label>
                </div>
                
                <?php if (function_exists('pll_the_languages')) : ?>
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_language" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('زبان رویداد', 'university-management'); ?></label>
                    <select id="event_language" name="event_language" class="regular-text" style="width: 100%;" required>
                        <option value=""><?php _e('انتخاب زبان', 'university-management'); ?></option>
                        <?php
                        $languages = pll_the_languages(array('raw' => 1));
                        foreach ($languages as $lang) {
                            $selected = '';
                            if ($editing_event) {
                                $selected = ($editing_lang === $lang['slug']) ? 'selected' : '';
                            } else {
                                $selected = ($lang['current_lang'] ? 'selected' : '');
                            }
                            echo '<option value="' . esc_attr($lang['slug']) . '" ' . $selected . '>' . esc_html($lang['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <?php endif; ?>
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php echo $editing_event ? esc_attr__('به‌روزرسانی رویداد', 'university-management') : esc_attr__('افزودن رویداد', 'university-management'); ?>">
                    <?php if ($editing_event): ?>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=university-calendar')); ?>" class="button" style="margin-right:10px;"><?php _e('لغو ویرایش', 'university-management'); ?></a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <!-- لیست رویدادهای موجود -->
        <div class="um-admin-list" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(60% - 20px); min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('رویدادهای موجود', 'university-management'); ?></h2>
            
            <?php if (function_exists('pll_the_languages')) : ?>
            <div class="um-language-filter" style="margin-bottom: 20px;">
                <form method="get" action="">
                    <input type="hidden" name="page" value="university-calendar">
                    <label for="lang_filter" style="font-weight: bold; margin-right: 10px;"><?php _e('فیلتر بر اساس زبان:', 'university-management'); ?></label>
                    <select id="lang_filter" name="lang_filter" onchange="this.form.submit()">
                        <option value=""><?php _e('همه زبان‌ها', 'university-management'); ?></option>
                        <?php
                        $languages = pll_the_languages(array('raw' => 1));
                        $current_filter = isset($_GET['lang_filter']) ? $_GET['lang_filter'] : '';
                        
                        // بررسی اینکه کدام زبان‌ها رویداد دارند
                        $languages_with_events = array();
                        foreach ($languages as $lang) {
                            $lang_args = array(
                                'post_type' => 'um_calendar_events',
                                'posts_per_page' => 1,
                                'lang' => $lang['slug']
                            );
                            $lang_query = new WP_Query($lang_args);
                            if ($lang_query->have_posts()) {
                                $languages_with_events[] = $lang['slug'];
                            }
                            wp_reset_postdata();
                        }
                        
                        foreach ($languages as $lang) {
                            $selected = ($current_filter === $lang['slug']) ? 'selected' : '';
                            $disabled = !in_array($lang['slug'], $languages_with_events) ? 'disabled' : '';
                            echo '<option value="' . esc_attr($lang['slug']) . '" ' . $selected . ' ' . $disabled . '>' . esc_html($lang['name']) . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>
            <?php endif; ?>
            
            <?php if ($events->have_posts()) : ?>
                <table class="wp-list-table widefat fixed striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php _e('عنوان', 'university-management'); ?></th>
                            <th><?php _e('تاریخ', 'university-management'); ?></th>
                            <th><?php _e('رویداد مهم', 'university-management'); ?></th>
                            <?php if (function_exists('pll_get_post_language')) : ?>
                            <th><?php _e('زبان', 'university-management'); ?></th>
                            <?php endif; ?>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($events->have_posts()) : $events->the_post(); 
                            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                            $is_important = get_post_meta(get_the_ID(), '_is_important', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = date_i18n(get_option('date_format'), strtotime($event_date));
                            
                            // دریافت زبان رویداد
                            $event_language = '';
                            if (function_exists('pll_get_post_language')) {
                                $lang_slug = pll_get_post_language(get_the_ID());
                                if ($lang_slug) {
                                    $languages = pll_the_languages(array('raw' => 1));
                                    $event_language = isset($languages[$lang_slug]) ? $languages[$lang_slug]['name'] : $lang_slug;
                                }
                            }
                        ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php echo $is_important === 'yes' ? __('بله', 'university-management') : __('خیر', 'university-management'); ?></td>
                                <?php if (function_exists('pll_get_post_language')) : ?>
                                <td><?php echo esc_html($event_language); ?></td>
                                <?php endif; ?>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-calendar',
                                                'action' => 'um_edit',
                                                'event_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <?php
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-calendar',
                                                    'action' => 'um_delete',
                                                    'event_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_event_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این رویداد اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="um-no-events">
                    <p><?php _e('هنوز هیچ رویدادی ثبت نشده است.', 'university-management'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="um-admin-help" style="margin-top: 30px;">
        <h2><?php _e('راهنما', 'university-management'); ?></h2>
        <p><?php _e('برای استفاده از ویجت تقویم دانشگاه، پس از افزودن رویدادها در این قسمت، کافیست ویجت "تقویم دانشگاه" را در صفحه‌ساز المنتور به صفحه مورد نظر خود اضافه کنید.', 'university-management'); ?></p>
        <p><?php _e('نکات مهم:', 'university-management'); ?></p>
        <ul style="list-style-type: disc; padding-right: 20px;">
            <li><?php _e('رویدادهای مهم با رنگ متفاوت (آبی) نمایش داده می‌شوند.', 'university-management'); ?></li>
            <li><?php _e('ترتیب نمایش رویدادها بر اساس تاریخ آنها از قدیم به جدید است.', 'university-management'); ?></li>
            <li><?php _e('می‌توانید با کلیک روی دکمه ویرایش، جزئیات هر رویداد را تغییر دهید.', 'university-management'); ?></li>
        </ul>
    </div>
</div> 

<script>
(function(){
  // اطمینان از بارگذاری moment و moment-jalaali
  function ensureMoment(cb){
    function loadScript(src, dep, onload){
      var s=document.createElement('script');
      s.src=src; s.async=true; if (dep) s.setAttribute('data-dep', dep);
      s.onload=onload; document.head.appendChild(s);
    }
    if (typeof moment === 'undefined'){
      loadScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', '', function(){
        loadScript('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', 'moment', cb);
      });
    } else if (typeof moment.loadPersian === 'undefined'){
      loadScript('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', 'moment', cb);
    } else {
      cb();
    }
  }

  function initJDate(){
    try {
      if (typeof moment.loadPersian === 'function') {
        moment.loadPersian({usePersianDigits:false});
      }
      var display = document.getElementById('event_date_display');
      var hidden = document.getElementById('event_date');
      if (!display || !hidden) return;

      // اگر مقدار قبلی موجود است، تبدیل و نمایش بده
      if (hidden.value){
        var m = moment(hidden.value, 'YYYY-MM-DD');
        if (m.isValid()) display.value = m.format('jYYYY/jMM/jDD');
      }

      // هنگام تغییر ورودی شمسی، مقدار میلادی را در فیلد مخفی ذخیره کن
      display.addEventListener('input', function(){
        var v = (display.value || '').replace(/[-.]/g,'/');
        var m = moment(v, 'jYYYY/jMM/jDD', true);
        if (m.isValid()){
          hidden.value = m.format('YYYY-MM-DD');
          display.setCustomValidity('');
        } else {
          display.setCustomValidity('تاریخ نامعتبر است. مثال: 1404/05/20');
          hidden.value = '';
        }
      });

      // اعتبارسنجی قبل از ارسال فرم
      var form = display.form;
      if (form){
        form.addEventListener('submit', function(e){
          if (!hidden.value){
            e.preventDefault();
            display.reportValidity();
          }
        });
      }
    } catch(e) { console.warn('JDate init error', e); }
  }

  if (document.readyState === 'loading'){
    document.addEventListener('DOMContentLoaded', function(){ ensureMoment(initJDate); });
  } else {
    ensureMoment(initJDate);
  }
})();
</script>