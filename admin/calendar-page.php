<?php
/**
 * صفحه مدیریت تقویم دانشگاه
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
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
        error_log('=== CALENDAR LANGUAGE FILTER DEBUG ===');
        error_log('Selected Language: ' . $current_lang);
        
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
            <h2><?php _e('افزودن رویداد جدید', 'university-management'); ?></h2>
            
            <form method="post" action="">
                <?php wp_nonce_field('um_add_event', 'um_add_event_nonce'); ?>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_title" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('عنوان رویداد', 'university-management'); ?> *</label>
                    <input type="text" id="event_title" name="event_title" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_date" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ رویداد', 'university-management'); ?> *</label>
                    <input type="date" id="event_date" name="event_date" class="regular-text" required style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="event_description" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('توضیحات رویداد', 'university-management'); ?></label>
                    <textarea id="event_description" name="event_description" rows="5" class="regular-text" style="width: 100%;"></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label style="font-weight: bold;">
                        <input type="checkbox" name="is_important" value="yes">
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
                            $selected = ($lang['current_lang'] ? 'selected' : '');
                            echo '<option value="' . esc_attr($lang['slug']) . '" ' . $selected . '>' . esc_html($lang['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <?php endif; ?>
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php _e('افزودن رویداد', 'university-management'); ?>">
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
                                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" class="button button-small"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo get_delete_post_link(get_the_ID()); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این رویداد اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
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