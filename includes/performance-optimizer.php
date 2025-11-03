<?php
/**
 * بهینه‌ساز عملکرد افزونه مدیریت دانشگاه
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

/**
 * کلاس بهینه‌ساز عملکرد
 */
class UM_Performance_Optimizer {
    
    /**
     * نمونه کلاس
     */
    private static $instance = null;
    
    /**
     * حداکثر تعداد پست‌ها در کوئری‌ها
     */
    const MAX_POSTS_PER_PAGE = 100;
    
    /**
     * مدت زمان کش (به ثانیه)
     */
    const CACHE_DURATION = 300; // 5 دقیقه
    
    /**
     * دریافت نمونه کلاس
     */
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * سازنده
     */
    public function __construct() {
        add_action('init', array($this, 'init_optimizations'));
    }
    
    /**
     * راه‌اندازی بهینه‌سازی‌ها
     */
    public function init_optimizations() {
        // بهینه‌سازی کوئری‌های دیتابیس
        add_action('pre_get_posts', array($this, 'optimize_queries'));
        
        // کش کردن نتایج پرتکرار
        add_action('wp_loaded', array($this, 'setup_caching'));
        
        // بهینه‌سازی بارگذاری فایل‌ها
        add_action('wp_enqueue_scripts', array($this, 'optimize_asset_loading'), 1);
        
        // محدود کردن کوئری‌های بدون limit
        add_filter('query', array($this, 'limit_unlimited_queries'));
    }
    
    /**
     * بهینه‌سازی کوئری‌های دیتابیس
     */
    public function optimize_queries($query) {
        // فقط برای کوئری‌های اصلی
        if ($query->is_main_query()) {
            // محدود کردن نتایج جستجو
            if ($query->is_search() && !is_admin()) {
                $query->set('posts_per_page', 20);
            }
            
            // بهینه‌سازی کوئری‌های آرشیو
            if ($query->is_archive() && !is_admin()) {
                $query->set('posts_per_page', 12);
            }
            
            // محدود کردن کوئری‌های افزونه
            $post_type = $query->get('post_type');
            if (in_array($post_type, array('um_seminars', 'um_videos', 'um_calendar_events', 'um_classes'))) {
                $posts_per_page = $query->get('posts_per_page');
                if ($posts_per_page == -1 && !is_admin()) {
                    // محدود به حداکثر 100 پست
                    $query->set('posts_per_page', self::MAX_POSTS_PER_PAGE);
                    um_log('Query limited to ' . self::MAX_POSTS_PER_PAGE . ' posts for performance');
                }
            }
        }
    }
    
    /**
     * محدود کردن کوئری‌های بدون limit
     */
    public function limit_unlimited_queries($query) {
        global $wpdb;
        
        // فقط در حالت دیباگ این کار را انجام دهیم
        $debug_mode = get_option('um_debug_mode', '0');
        if ($debug_mode === '1') {
            // بررسی کوئری‌های بدون LIMIT
            if (stripos($query, 'LIMIT') === false && (stripos($query, 'SELECT') !== false)) {
                um_warning_log('Unlimited query detected', substr($query, 0, 200));
            }
        }
        
        return $query;
    }
    
    /**
     * راه‌اندازی سیستم کش
     */
    public function setup_caching() {
        // کش کردن تنظیمات افزونه
        if (!get_transient('um_plugin_settings_cache')) {
            $settings = array(
                'um_hall_hourly_rate' => get_option('um_hall_hourly_rate', 0),
                'um_hall_equipment' => get_option('um_hall_equipment', '[]'),
                'um_hall_catering' => get_option('um_hall_catering', '[]'),
                'um_debug_mode' => get_option('um_debug_mode', '0'),
            );
            set_transient('um_plugin_settings_cache', $settings, HOUR_IN_SECONDS);
        }
        
        // کش کردن تعداد پست‌های مهم
        if (!get_transient('um_posts_count_cache')) {
            $counts = array(
                'seminars' => wp_count_posts('um_seminars'),
                'videos' => wp_count_posts('um_videos'),
                'events' => wp_count_posts('um_calendar_events'),
                'classes' => wp_count_posts('um_classes'),
            );
            set_transient('um_posts_count_cache', $counts, self::CACHE_DURATION);
        }
    }
    
    /**
     * بهینه‌سازی بارگذاری فایل‌ها
     */
    public function optimize_asset_loading() {
        // حذف فایل‌های غیرضروری در صفحات غیرمرتبط
        if (!is_admin() && !is_singular()) {
            // حذف فایل‌های اضافی در صفحات آرشیو
            wp_dequeue_style('um-video-widget');
            wp_dequeue_script('um-video-widget');
        }
    }
    
    /**
     * پاک کردن کش‌های افزونه
     */
    public function clear_plugin_cache() {
        global $wpdb;
        
        // پاک کردن کش‌های عمومی
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_um_%'");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_um_%'");
        
        // پاک کردن کش‌های خاص
        delete_transient('um_plugin_settings_cache');
        delete_transient('um_posts_count_cache');
        
        um_log('All plugin caches cleared');
    }
    
    /**
     * کش کردن نتیجه کوئری
     */
    public function cache_query_result($query_key, $callback, $duration = null) {
        if ($duration === null) {
            $duration = self::CACHE_DURATION;
        }
        
        $cached = get_transient($query_key);
        if ($cached !== false) {
            um_log('Using cached query result: ' . $query_key);
            return $cached;
        }
        
        $result = call_user_func($callback);
        set_transient($query_key, $result, $duration);
        um_log('Cached query result: ' . $query_key);
        
        return $result;
    }
    
    /**
     * دریافت آمار عملکرد
     */
    public function get_performance_stats() {
        global $wpdb;
        
        $stats = array(
            'cached_queries' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE '_transient_um_%'"),
            'memory_usage' => memory_get_usage(true),
            'peak_memory' => memory_get_peak_usage(true),
            'query_count' => $wpdb->num_queries,
        );
        
        return $stats;
    }
}

// راه‌اندازی بهینه‌ساز
UM_Performance_Optimizer::get_instance();
