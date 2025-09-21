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
    }
    
    /**
     * بهینه‌سازی کوئری‌های دیتابیس
     */
    public function optimize_queries($query) {
        if (!is_admin() && $query->is_main_query()) {
            // محدود کردن نتایج جستجو
            if ($query->is_search()) {
                $query->set('posts_per_page', 20);
            }
            
            // بهینه‌سازی کوئری‌های آرشیو
            if ($query->is_archive()) {
                $query->set('posts_per_page', 12);
            }
        }
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
            );
            set_transient('um_plugin_settings_cache', $settings, HOUR_IN_SECONDS);
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
        
        // پاک کردن کش تنظیمات
        delete_transient('um_plugin_settings_cache');
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
