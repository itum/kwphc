<?php
/**
 * مدیریت پست‌تایپ و منطق «رزرو سالن جلسات»
 */

if (!defined('ABSPATH')) {
    exit;
}

class UM_Hall_Booking_Manager {

    const POST_TYPE = 'hall_booking';

    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
        add_action('admin_init', array($this, 'register_settings'));

        // متاباکس‌ها
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post_' . self::POST_TYPE, array($this, 'save_meta_boxes'));

        // ستون‌های ادمین
        add_filter('manage_edit-' . self::POST_TYPE . '_columns', array($this, 'columns'));
        add_action('manage_' . self::POST_TYPE . '_posts_custom_column', array($this, 'render_columns'), 10, 2);
        add_filter('manage_edit-' . self::POST_TYPE . '_sortable_columns', array($this, 'sortable_columns'));
        add_action('pre_get_posts', array($this, 'handle_sorting_and_filters'));
        add_action('restrict_manage_posts', array($this, 'add_admin_filters'));
        add_filter('views_edit-' . self::POST_TYPE, array($this, 'add_scope_views'));

        // شورتکد تقویم رزرو
        add_shortcode('um_hall_calendar', array($this, 'calendar_shortcode'));
    }

    public function register_post_type() {
        $labels = array(
            'name'               => __('رزروهای سالن', 'university-management'),
            'singular_name'      => __('رزرو سالن', 'university-management'),
            'add_new'            => __('افزودن رزرو جدید', 'university-management'),
            'add_new_item'       => __('افزودن رزرو جدید', 'university-management'),
            'edit_item'          => __('ویرایش رزرو', 'university-management'),
            'new_item'           => __('رزرو جدید', 'university-management'),
            'view_item'          => __('مشاهده رزرو', 'university-management'),
            'search_items'       => __('جستجوی رزروها', 'university-management'),
            'not_found'          => __('رزروی یافت نشد', 'university-management'),
            'not_found_in_trash' => __('رزروی در سطل زباله یافت نشد', 'university-management'),
            'menu_name'          => __('رزروهای سالن', 'university-management'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'show_ui'            => true,
            'show_in_menu'       => 'university-hall-root',
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'supports'           => array('title'),
            'menu_icon'          => 'dashicons-groups',
            'show_in_rest'       => true,
        );
        register_post_type(self::POST_TYPE, $args);

        // متاهای مورد نیاز در REST
        $meta_keys = array(
            '_um_hall_event_title' => 'string',
            '_um_hall_date' => 'string',
            '_um_hall_start_time' => 'string',
            '_um_hall_end_time' => 'string',
            '_um_hall_equipment' => 'array',
            '_um_hall_reserver_name' => 'string',
            '_um_hall_phone' => 'string',
            '_um_hall_email' => 'string',
            '_um_hall_national_code' => 'string',
            '_um_hall_description' => 'string',
            '_um_hall_total_amount' => 'number',
            '_um_hall_payment_status' => 'string',
            '_um_hall_created_at' => 'string',
            '_um_hall_authority' => 'string',
        );
        foreach ($meta_keys as $key => $type) {
            register_post_meta(self::POST_TYPE, $key, array(
                'show_in_rest' => true,
                'single' => true,
                'type' => $type === 'array' ? 'string' : $type, // ذخیره JSON برای آرایه
            ));
        }
        if (function_exists('pll_register_post_type')) { pll_register_post_type(self::POST_TYPE); }
    }

    public function register_settings() {
        register_setting('um_hall_settings_group', 'um_hall_capacity');
        register_setting('um_hall_settings_group', 'um_hall_hourly_rate');
        register_setting('um_hall_settings_group', 'um_hall_equipment'); // JSON: [{"id":"projector","label":"ویدئو پروژکتور","price":200000}]
        register_setting('um_hall_settings_group', 'um_hall_enable_equipment'); // on/off
        register_setting('um_hall_settings_group', 'um_hall_gateway'); // zarinpal
        register_setting('um_hall_settings_group', 'um_hall_zarinpal_merchant_id');
        register_setting('um_hall_settings_group', 'um_hall_payment_callback_url');
        register_setting('um_hall_settings_group', 'um_hall_admin_email');
        register_setting('um_hall_settings_group', 'um_hall_zarinpal_sandbox');
    }

    public function add_meta_boxes() {
        add_meta_box(
            'um_hall_booking_details',
            __('جزئیات رزرو سالن', 'university-management'),
            array($this, 'render_booking_meta_box'),
            self::POST_TYPE,
            'normal',
            'high'
        );
    }

    public function render_booking_meta_box($post) {
        wp_nonce_field('um_hall_booking_nonce', 'um_hall_booking_nonce');

        $fields = array(
            'event_title' => get_post_meta($post->ID, '_um_hall_event_title', true),
            'date' => get_post_meta($post->ID, '_um_hall_date', true),
            'start_time' => get_post_meta($post->ID, '_um_hall_start_time', true),
            'end_time' => get_post_meta($post->ID, '_um_hall_end_time', true),
            'equipment' => json_decode((string) get_post_meta($post->ID, '_um_hall_equipment', true), true) ?: array(),
            'reserver_name' => get_post_meta($post->ID, '_um_hall_reserver_name', true),
            'phone' => get_post_meta($post->ID, '_um_hall_phone', true),
            'email' => get_post_meta($post->ID, '_um_hall_email', true),
            'national_code' => get_post_meta($post->ID, '_um_hall_national_code', true),
            'description' => get_post_meta($post->ID, '_um_hall_description', true),
            'total_amount' => get_post_meta($post->ID, '_um_hall_total_amount', true),
            'payment_status' => get_post_meta($post->ID, '_um_hall_payment_status', true),
        );

        ?>
        <style>
            .um-hall-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}.um-hall-grid label{display:block;font-weight:600;margin-bottom:6px}.um-hall-grid input[type=text],.um-hall-grid input[type=email],.um-hall-grid textarea{width:100%}
        </style>
        <div class="um-hall-grid">
            <div>
                <label><?php _e('عنوان رویداد', 'university-management'); ?></label>
                <input type="text" name="um_hall_event_title" value="<?php echo esc_attr($fields['event_title']); ?>" />
            </div>
            <div>
                <label><?php _e('تاریخ', 'university-management'); ?></label>
                <input type="text" name="um_hall_date" value="<?php echo esc_attr($fields['date']); ?>" placeholder="1403-01-01" />
            </div>
            <div>
                <label><?php _e('ساعت شروع', 'university-management'); ?></label>
                <input type="text" name="um_hall_start_time" value="<?php echo esc_attr($fields['start_time']); ?>" placeholder="09:00" />
            </div>
            <div>
                <label><?php _e('ساعت پایان', 'university-management'); ?></label>
                <input type="text" name="um_hall_end_time" value="<?php echo esc_attr($fields['end_time']); ?>" placeholder="11:00" />
            </div>
            <div>
                <label><?php _e('نام رزروکننده', 'university-management'); ?></label>
                <input type="text" name="um_hall_reserver_name" value="<?php echo esc_attr($fields['reserver_name']); ?>" />
            </div>
            <div>
                <label><?php _e('شماره تماس', 'university-management'); ?></label>
                <input type="text" name="um_hall_phone" value="<?php echo esc_attr($fields['phone']); ?>" />
            </div>
            <div>
                <label><?php _e('ایمیل', 'university-management'); ?></label>
                <input type="email" name="um_hall_email" value="<?php echo esc_attr($fields['email']); ?>" />
            </div>
            <div>
                <label><?php _e('کد/شناسه ملی', 'university-management'); ?></label>
                <input type="text" name="um_hall_national_code" value="<?php echo esc_attr($fields['national_code']); ?>" />
            </div>
            <div style="grid-column:1/3">
                <label><?php _e('توضیحات', 'university-management'); ?></label>
                <textarea name="um_hall_description" rows="3"><?php echo esc_textarea($fields['description']); ?></textarea>
            </div>
            <div>
                <label><?php _e('مبلغ کل (تومان)', 'university-management'); ?></label>
                <input type="text" name="um_hall_total_amount" value="<?php echo esc_attr($fields['total_amount']); ?>" />
            </div>
            <div>
                <label><?php _e('وضعیت پرداخت', 'university-management'); ?></label>
                <select name="um_hall_payment_status">
                    <?php $status = $fields['payment_status'] ?: 'pending'; ?>
                    <option value="pending" <?php selected($status, 'pending'); ?>><?php _e('در انتظار', 'university-management'); ?></option>
                    <option value="success" <?php selected($status, 'success'); ?>><?php _e('موفق', 'university-management'); ?></option>
                    <option value="failed" <?php selected($status, 'failed'); ?>><?php _e('ناموفق', 'university-management'); ?></option>
                </select>
            </div>
        </div>
        <?php
    }

    public function save_meta_boxes($post_id) {
        if (!isset($_POST['um_hall_booking_nonce']) || !wp_verify_nonce($_POST['um_hall_booking_nonce'], 'um_hall_booking_nonce')) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        $map = array(
            '_um_hall_event_title' => 'um_hall_event_title',
            '_um_hall_date' => 'um_hall_date',
            '_um_hall_start_time' => 'um_hall_start_time',
            '_um_hall_end_time' => 'um_hall_end_time',
            '_um_hall_reserver_name' => 'um_hall_reserver_name',
            '_um_hall_phone' => 'um_hall_phone',
            '_um_hall_email' => 'um_hall_email',
            '_um_hall_national_code' => 'um_hall_national_code',
            '_um_hall_description' => 'um_hall_description',
            '_um_hall_total_amount' => 'um_hall_total_amount',
            '_um_hall_payment_status' => 'um_hall_payment_status',
        );
        foreach ($map as $meta_key => $field_key) {
            if (isset($_POST[$field_key])) {
                $value = $_POST[$field_key];
                if ($meta_key === '_um_hall_total_amount') {
                    $value = floatval(str_replace(',', '', $value));
                } else {
                    $value = is_string($value) ? sanitize_text_field($value) : $value;
                }
                update_post_meta($post_id, $meta_key, $value);
            }
        }
        // عنوان پست = عنوان رویداد + تاریخ
        $event_title = get_post_meta($post_id, '_um_hall_event_title', true);
        $date = get_post_meta($post_id, '_um_hall_date', true);
        if ($event_title || $date) {
            $new_title = trim($event_title . ' - ' . $date);
            wp_update_post(array('ID' => $post_id, 'post_title' => $new_title));
        }
    }

    public function columns($columns) {
        $new = array();
        foreach ($columns as $key => $label) {
            $new[$key] = $label;
            if ($key === 'title') {
                $new['um_hall_date'] = __('تاریخ', 'university-management');
                $new['um_hall_time'] = __('ساعت', 'university-management');
                $new['um_hall_reserver'] = __('رزروکننده', 'university-management');
                $new['um_hall_amount'] = __('مبلغ (تومان)', 'university-management');
                $new['um_hall_payment_status'] = __('وضعیت پرداخت', 'university-management');
            }
        }
        return $new;
    }

    public function render_columns($column, $post_id) {
        switch ($column) {
            case 'um_hall_date':
                echo esc_html(get_post_meta($post_id, '_um_hall_date', true));
                break;
            case 'um_hall_time':
                $s = get_post_meta($post_id, '_um_hall_start_time', true);
                $e = get_post_meta($post_id, '_um_hall_end_time', true);
                echo esc_html($s . ' - ' . $e);
                break;
            case 'um_hall_reserver':
                $name = get_post_meta($post_id, '_um_hall_reserver_name', true);
                $phone = get_post_meta($post_id, '_um_hall_phone', true);
                echo esc_html($name . ($phone ? ' (' . $phone . ')' : ''));
                break;
            case 'um_hall_amount':
                $amount = floatval(get_post_meta($post_id, '_um_hall_total_amount', true));
                echo esc_html(number_format_i18n($amount));
                break;
            case 'um_hall_payment_status':
                $status = get_post_meta($post_id, '_um_hall_payment_status', true) ?: 'pending';
                $label = array(
                    'pending' => __('در انتظار', 'university-management'),
                    'success' => __('موفق', 'university-management'),
                    'failed' => __('ناموفق', 'university-management'),
                );
                echo esc_html($label[$status] ?? $status);
                break;
        }
    }

    public function sortable_columns($columns) {
        $columns['um_hall_date'] = 'um_hall_date';
        $columns['um_hall_amount'] = 'um_hall_amount';
        return $columns;
    }

    public function handle_sorting_and_filters($query) {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }
        if ($query->get('post_type') !== self::POST_TYPE) {
            return;
        }
        // مرتب‌سازی
        $orderby = $query->get('orderby');
        if ($orderby === 'um_hall_date') {
            $query->set('meta_key', '_um_hall_date');
            $query->set('orderby', 'meta_value');
        } elseif ($orderby === 'um_hall_amount') {
            $query->set('meta_key', '_um_hall_total_amount');
            $query->set('orderby', 'meta_value_num');
        }
        // فیلترها
        $meta_query = array();
        $meta_query['relation'] = 'AND';

        if (isset($_GET['um_hall_payment_status']) && $_GET['um_hall_payment_status'] !== '') {
            $meta_query[] = array(
                'key' => '_um_hall_payment_status',
                'value' => sanitize_text_field(wp_unslash($_GET['um_hall_payment_status'])),
            );
        }

        $scope = isset($_GET['um_hall_scope']) ? sanitize_text_field(wp_unslash($_GET['um_hall_scope'])) : '';
        if ($scope === 'future' || $scope === 'past') {
            $today = current_time('Y-m-d');
            $meta_query[] = array(
                'key' => '_um_hall_date',
                'value' => $today,
                'compare' => $scope === 'future' ? '>=' : '<',
                'type' => 'DATE',
            );
            $query->set('meta_key', '_um_hall_date');
            $query->set('orderby', 'meta_value');
            $query->set('order', $scope === 'future' ? 'ASC' : 'DESC');
        }

        if (count($meta_query) > 1) {
            $query->set('meta_query', $meta_query);
        }
    }

    public function add_admin_filters($post_type) {
        if ($post_type !== self::POST_TYPE) {
            return;
        }
        $current = isset($_GET['um_hall_payment_status']) ? sanitize_text_field(wp_unslash($_GET['um_hall_payment_status'])) : '';
        ?>
        <select name="um_hall_payment_status">
            <option value=""><?php _e('همه وضعیت‌ها', 'university-management'); ?></option>
            <option value="pending" <?php selected($current, 'pending'); ?>><?php _e('در انتظار', 'university-management'); ?></option>
            <option value="success" <?php selected($current, 'success'); ?>><?php _e('موفق', 'university-management'); ?></option>
            <option value="failed" <?php selected($current, 'failed'); ?>><?php _e('ناموفق', 'university-management'); ?></option>
        </select>
        <?php
    }

    public function add_scope_views($views) {
        global $wpdb;
        $today = current_time('Y-m-d');
        $base_url = remove_query_arg(array('um_hall_scope'), $_SERVER['REQUEST_URI']);
        $current = isset($_GET['um_hall_scope']) ? sanitize_text_field(wp_unslash($_GET['um_hall_scope'])) : '';

        $future_count = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(p.ID) FROM {$wpdb->posts} p INNER JOIN {$wpdb->postmeta} m ON p.ID=m.post_id WHERE p.post_type=%s AND p.post_status IN ('publish','pending','draft') AND m.meta_key='_um_hall_date' AND m.meta_value >= %s",
            self::POST_TYPE, $today
        ));
        $past_count = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(p.ID) FROM {$wpdb->posts} p INNER JOIN {$wpdb->postmeta} m ON p.ID=m.post_id WHERE p.post_type=%s AND p.post_status IN ('publish','pending','draft') AND m.meta_key='_um_hall_date' AND m.meta_value < %s",
            self::POST_TYPE, $today
        ));

        $views['um_hb_future'] = '<a href="' . esc_url(add_query_arg('um_hall_scope', 'future', $base_url)) . '"' . ($current==='future'?' class="current"':'') . '>' . __('آینده', 'university-management') . ' <span class="count">(' . number_format_i18n($future_count) . ')</span></a>';
        $views['um_hb_past'] = '<a href="' . esc_url(add_query_arg('um_hall_scope', 'past', $base_url)) . '"' . ($current==='past'?' class="current"':'') . '>' . __('گذشته', 'university-management') . ' <span class="count">(' . number_format_i18n($past_count) . ')</span></a>';
        return $views;
    }

    public function calendar_shortcode($atts) {
        $atts = shortcode_atts(array(
            'days' => 30,
        ), $atts, 'um_hall_calendar');

        $days = intval($atts['days']);
        $today = current_time('Y-m-d');
        $end = date('Y-m-d', strtotime("+{$days} days", strtotime($today)));

        $bookings = get_posts(array(
            'post_type' => self::POST_TYPE,
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => '_um_hall_date',
                    'value' => array($today, $end),
                    'compare' => 'BETWEEN',
                    'type' => 'DATE',
                ),
            ),
            'orderby' => 'meta_value',
            'meta_key' => '_um_hall_date',
            'order' => 'ASC',
        ));

        ob_start();
        echo '<div class="um-hall-calendar">';
        echo '<h3>' . esc_html__('رزروهای آتی', 'university-management') . '</h3>';
        if (!$bookings) {
            echo '<p>' . esc_html__('رزروی ثبت نشده است.', 'university-management') . '</p>';
        } else {
            echo '<ul class="um-hall-bookings-list">';
            foreach ($bookings as $b) {
                $date = get_post_meta($b->ID, '_um_hall_date', true);
                $s = get_post_meta($b->ID, '_um_hall_start_time', true);
                $e = get_post_meta($b->ID, '_um_hall_end_time', true);
                $title = get_post_meta($b->ID, '_um_hall_event_title', true);
                echo '<li>' . esc_html($date . ' | ' . $s . '-' . $e . ' | ' . $title) . '</li>';
            }
            echo '</ul>';
        }
        echo '</div>';
        return ob_get_clean();
    }

    public static function has_time_conflict($date, $start_time, $end_time, $exclude_post_id = 0) {
        $args = array(
            'post_type' => self::POST_TYPE,
            'post_status' => array('publish', 'pending', 'draft'),
            'posts_per_page' => -1,
            'post__not_in' => $exclude_post_id ? array($exclude_post_id) : array(),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_um_hall_date',
                    'value' => $date,
                    'type' => 'DATE',
                ),
                array(
                    'key' => '_um_hall_payment_status',
                    'value' => array('pending', 'success'),
                    'compare' => 'IN',
                ),
                // همپوشانی زمانی: شروع موجود < پایان درخواستی AND پایان موجود > شروع درخواستی
                array(
                    'relation' => 'AND',
                    array(
                        'key' => '_um_hall_start_time',
                        'value' => $end_time,
                        'compare' => '<',
                        'type' => 'TIME',
                    ),
                    array(
                        'key' => '_um_hall_end_time',
                        'value' => $start_time,
                        'compare' => '>',
                        'type' => 'TIME',
                    ),
                ),
            ),
        );
        $conflicts = get_posts($args);
        return !empty($conflicts);
    }
}


