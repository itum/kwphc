<?php
/**
 * کلاس‌های ویجت‌های المنتور
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

// اطمینان از وجود تابع um_translate
if (!function_exists('um_translate')) {
    function um_translate($string, $fallback = null) {
        return $fallback ?: $string;
    }
}

/**
 * کلاس اصلی ویجت‌های المنتور
 */
class UM_Elementor_Widgets {

    /**
     * نمونه کلاس
     * @var UM_Elementor_Widgets
     */
    private static $instance = null;

    /**
     * سازنده
     */
    public function __construct() {
        // اضافه کردن دسته‌بندی جدید ویجت‌ها
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));
        
        // ثبت ویجت‌ها
        add_action('elementor/widgets/widgets_registered', array($this, 'register_widgets'));
        
        // اضافه کردن فایل‌های JS و CSS برای ویجت‌ها
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'widget_styles'));
        add_action('elementor/frontend/after_register_scripts', array($this, 'widget_scripts'));
    }

    /**
     * دریافت نمونه کلاس
     * @return UM_Elementor_Widgets
     */
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * اضافه کردن دسته‌بندی جدید به المنتور
     * @param \Elementor\Elements_Manager $elements_manager
     */
    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'university-management',
            [
                'title' => esc_html(um_translate('مدیریت دانشگاه', __('مدیریت دانشگاه', 'university-management'))),
                'icon' => 'fa fa-university',
            ]
        );
    }

    /**
     * ثبت ویجت‌های المنتور
     */
    public function register_widgets() {
        // الزامات: فایل‌های کلاس‌های ویجت
        require_once UM_PLUGIN_DIR . 'includes/widgets/calendar-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/class-timer-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/video-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/seminar-slider-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/azmoon-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/employment-exams-widget.php';
        // ویجت اسلایدها
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/slides-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/slides-widget.php';
        }
        // فرم رزرو سالن
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/hall-booking-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/hall-booking-widget.php';
        }
        
        // ثبت ویجت‌ها
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Calendar_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Class_Timer_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Video_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Seminar_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Azmoon_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Employment_Exams_Widget());
        if (class_exists('UM_Hall_Booking_Widget')) {
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Hall_Booking_Widget());
        }
        if (class_exists('UM_Slides_Widget')) {
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Slides_Widget());
        }
    }

    /**
     * اضافه کردن استایل‌های ویجت‌ها
     */
    public function widget_styles() {
        // استایل عمومی ویجت‌ها
        wp_enqueue_style('um-elementor-widgets', UM_PLUGIN_URL . 'assets/css/elementor-widgets.css', array(), UM_VERSION);
        
        // استایل‌های اختصاصی هر ویجت
        wp_enqueue_style('um-calendar-widget', UM_PLUGIN_URL . 'assets/css/calendar-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-class-timer-widget', UM_PLUGIN_URL . 'assets/css/class-timer-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-video-widget', UM_PLUGIN_URL . 'assets/css/video-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-seminar-slider-widget', UM_PLUGIN_URL . 'assets/css/seminar-slider-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-employment-exams-widget', UM_PLUGIN_URL . 'assets/css/employment-exams-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-azmoon-widget', UM_PLUGIN_URL . 'assets/css/azmoon-widget.css', array(), UM_VERSION);
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/elementor-slides-widget.css')) {
            wp_enqueue_style('um-slides-widget', UM_PLUGIN_URL . 'assets/css/elementor-slides-widget.css', array(), UM_VERSION);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/hall-booking-widget.css')) {
            wp_enqueue_style('um-hall-booking-widget', UM_PLUGIN_URL . 'assets/css/hall-booking-widget.css', array(), UM_VERSION);
        }

        // کتابخانه‌های خارجی
        wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11');
    }

    /**
     * اضافه کردن اسکریپت‌های ویجت‌ها
     */
    public function widget_scripts() {
        // اضافه کردن moment.js برای تقویم جلالی
        wp_register_script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', array(), '2.29.1', true);
        wp_register_script('moment-jalaali', 'https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', array('moment'), '0.9.2', true);
        
        // کتابخانه‌های خارجی برای اسلایدر
        wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);
        wp_register_script('lucide', 'https://unpkg.com/lucide@latest', array(), null, true);

        // اسکریپت‌های اختصاصی هر ویجت
        wp_register_script('um-calendar-widget', UM_PLUGIN_URL . 'assets/js/calendar-widget.js', array('jquery', 'moment', 'moment-jalaali'), UM_VERSION, true);
        wp_register_script('um-class-timer-widget', UM_PLUGIN_URL . 'assets/js/class-timer-widget.js', array('jquery', 'moment', 'moment-jalaali'), UM_VERSION, true);
        wp_register_script('um-video-widget', UM_PLUGIN_URL . 'assets/js/video-widget.js', array('jquery'), UM_VERSION, true);
        wp_register_script('um-seminar-slider-widget', UM_PLUGIN_URL . 'assets/js/seminar-slider-widget.js', array('jquery', 'swiper', 'lucide'), UM_VERSION, true);
        wp_register_script('um-azmoon-widget', UM_PLUGIN_URL . 'assets/js/azmoon-widget.js', array('jquery'), UM_VERSION, true);
        wp_register_script('um-employment-exams-widget', UM_PLUGIN_URL . 'assets/js/employment-exams-widget.js', array('jquery'), UM_VERSION, true);
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/hall-booking-widget.js')) {
            wp_register_script('um-hall-booking-widget', UM_PLUGIN_URL . 'assets/js/hall-booking-widget.js', array('jquery'), UM_VERSION, true);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/slides-widget.js')) {
            wp_register_script('um-slides-widget', UM_PLUGIN_URL . 'assets/js/slides-widget.js', array('jquery','swiper'), UM_VERSION, true);
        }

        // لوکالایز اسکریپت‌ها
        wp_localize_script('um-calendar-widget', 'um_calendar_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('university-management-nonce')
        ));
        
        wp_localize_script('um-class-timer-widget', 'um_class_timer_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('university-management-nonce')
        ));
        
        wp_localize_script('um-video-widget', 'um_video_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('university-management-nonce')
        ));
        
        wp_localize_script('um-azmoon-widget', 'um_azmoon_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('university-management-nonce')
        ));
        if (wp_script_is('um-hall-booking-widget', 'registered')) {
            $equipments = json_decode((string) get_option('um_hall_equipment', '[]'), true);
            if (!is_array($equipments)) { $equipments = array(); }
            $equipments_enabled = get_option('um_hall_enable_equipment', '1') === '1';
            $caterings = json_decode((string) get_option('um_hall_catering', '[]'), true);
            if (!is_array($caterings)) { $caterings = array(); }
            wp_localize_script('um-hall-booking-widget', 'um_hall_widget_vars', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('university-management-nonce'),
                'hourly_rate' => (float) get_option('um_hall_hourly_rate', 0),
                'equipments' => $equipments,
                'equipments_enabled' => $equipments_enabled,
                'caterings' => $caterings,
            ));
        }
    }
}

// راه‌اندازی ویجت‌های المنتور
function um_elementor_widgets_init() {
    return UM_Elementor_Widgets::get_instance();
}

// فقط اگر المنتور فعال باشد
if (did_action('elementor/loaded')) {
    um_elementor_widgets_init();
} 