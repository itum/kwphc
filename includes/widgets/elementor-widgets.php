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
        
        // بارگذاری فوری ویجت‌ها (راه‌حل موقت)
        add_action('wp_loaded', array($this, 'force_register_widgets'), 5);
    }
    
    /**
     * ثبت اجباری ویجت‌ها (راه‌حل موقت)
     */
    public function force_register_widgets() {
        if (class_exists('\Elementor\Plugin')) {
            $this->register_widgets();
        }
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
        // بارگذاری فایل‌های ویجت‌ها
        $this->load_widget_files_conditionally();
        
        // ثبت ویجت‌ها
        $this->register_widget_instances();
    }
    
    /**
     * بارگذاری شرطی فایل‌های ویجت‌ها
     */
    private function load_widget_files_conditionally() {
        // همیشه فایل‌های اصلی را بارگذاری کن
        require_once UM_PLUGIN_DIR . 'includes/widgets/calendar-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/class-timer-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/video-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/seminar-slider-widget.php';
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/staff-carousel-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/staff-carousel-widget.php';
        }
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/staff-subordinates-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/staff-subordinates-widget.php';
        }
        require_once UM_PLUGIN_DIR . 'includes/widgets/azmoon-widget.php';
        require_once UM_PLUGIN_DIR . 'includes/widgets/employment-exams-widget.php';
        
        // بارگذاری فایل‌های اختیاری فقط در صورت نیاز
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/suggestion-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/suggestion-widget.php';
        }
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/slides-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/slides-widget.php';
        }
        if (file_exists(UM_PLUGIN_DIR . 'includes/widgets/hall-booking-widget.php')) {
            require_once UM_PLUGIN_DIR . 'includes/widgets/hall-booking-widget.php';
        }
    }
    
    /**
     * ثبت نمونه‌های ویجت‌ها
     */
    private function register_widget_instances() {
        // دیباگ: بررسی وجود کلاس‌ها
        if (defined('WP_DEBUG') && WP_DEBUG) {
            um_log('Starting widget registration...');
        }
        
        try {
            // ثبت ویجت‌های اصلی
            if (class_exists('UM_Calendar_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Calendar_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Calendar widget registered');
                }
            }
            
            if (class_exists('UM_Class_Timer_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Class_Timer_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Class Timer widget registered');
                }
            }
            
            if (class_exists('UM_Video_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Video_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Video widget registered');
                }
            }
            
            if (class_exists('UM_Seminar_Slider_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Seminar_Slider_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Seminar Slider widget registered');
                }
            }
            if (class_exists('UM_Staff_Carousel_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Staff_Carousel_Widget());
            }
            if (class_exists('UM_Staff_Subordinates_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Staff_Subordinates_Widget());
            }
            
            if (class_exists('UM_Azmoon_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Azmoon_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Azmoon widget registered');
                }
            }
            
            if (class_exists('UM_Employment_Exams_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Employment_Exams_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Employment Exams widget registered');
                }
            }
            
            // ثبت ویجت‌های اختیاری
            if (class_exists('UM_Hall_Booking_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Hall_Booking_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Hall Booking widget registered');
                }
            }
            if (class_exists('UM_Slides_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Slides_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Slides widget registered');
                }
            }
            if (class_exists('UM_Suggestion_Widget')) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new UM_Suggestion_Widget());
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    um_log('Suggestion widget registered');
                }
            }
            
            if (defined('WP_DEBUG') && WP_DEBUG) {
                um_log('All widgets registered successfully');
            }
            
        } catch (Exception $e) {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                um_error_log('Widget registration error', $e->getMessage());
            }
        }
    }

    /**
     * اضافه کردن استایل‌های ویجت‌ها
     */
    public function widget_styles() {
        // استایل عمومی ویجت‌ها (همیشه بارگذاری شود)
        wp_enqueue_style('um-elementor-widgets', UM_PLUGIN_URL . 'assets/css/elementor-widgets.css', array(), UM_VERSION);
        
        // همیشه همه استایل‌ها را بارگذاری کن (برای اطمینان)
        $this->enqueue_all_widget_styles();
    }
    
    /**
     * بارگذاری همه استایل‌های ویجت‌ها (برای حالت ویرایش)
     */
    private function enqueue_all_widget_styles() {
        wp_enqueue_style('um-calendar-widget', UM_PLUGIN_URL . 'assets/css/calendar-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-class-timer-widget', UM_PLUGIN_URL . 'assets/css/class-timer-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-video-widget', UM_PLUGIN_URL . 'assets/css/video-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-seminar-slider-widget', UM_PLUGIN_URL . 'assets/css/seminar-slider-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-employment-exams-widget', UM_PLUGIN_URL . 'assets/css/employment-exams-widget.css', array(), UM_VERSION);
        wp_enqueue_style('um-azmoon-widget', UM_PLUGIN_URL . 'assets/css/azmoon-widget.css', array(), UM_VERSION);
        wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11');
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/staff-carousel-widget.css')) {
            wp_enqueue_style('um-staff-carousel-widget', UM_PLUGIN_URL . 'assets/css/staff-carousel-widget.css', array(), UM_VERSION);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/staff-subordinates-widget.css')) {
            wp_enqueue_style('um-staff-subordinates-widget', UM_PLUGIN_URL . 'assets/css/staff-subordinates-widget.css', array(), UM_VERSION);
        }
        
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/elementor-slides-widget.css')) {
            wp_enqueue_style('um-slides-widget', UM_PLUGIN_URL . 'assets/css/elementor-slides-widget.css', array(), UM_VERSION);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/hall-booking-widget.css')) {
            wp_enqueue_style('um-hall-booking-widget', UM_PLUGIN_URL . 'assets/css/hall-booking-widget.css', array(), UM_VERSION);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/css/suggestion-widget.css')) {
            wp_enqueue_style('um-suggestion-widget', UM_PLUGIN_URL . 'assets/css/suggestion-widget.css', array(), UM_VERSION);
        }
    }
    
    /**
     * بارگذاری شرطی استایل‌های ویجت‌ها (غیرفعال - همیشه بارگذاری می‌شود)
     */
    private function enqueue_widget_styles_conditionally() {
        // این تابع دیگر استفاده نمی‌شود - همه استایل‌ها در enqueue_all_widget_styles بارگذاری می‌شوند
    }
    
    /**
     * تشخیص ویجت‌های استفاده شده در صفحه فعلی
     */
    private function get_widgets_in_current_page() {
        $widgets = array();
        
        // بررسی در المنتور (اولویت بالا)
        if (class_exists('\Elementor\Plugin')) {
            $elementor = \Elementor\Plugin::instance();
            if ($elementor->editor->is_edit_mode() || $elementor->preview->is_preview_mode()) {
                // در حالت ویرایش، همه ویجت‌ها را بارگذاری کن
                return array('um_calendar', 'um_class_timer', 'um_video', 'um_seminar_slider', 'um_employment_exams', 'um_azmoon', 'um_slides', 'um_hall_booking');
            }
            
            // بررسی وجود ویجت‌ها در المنتور
            if (method_exists($elementor, 'frontend')) {
                $frontend = $elementor->frontend;
                if (method_exists($frontend, 'get_builder_content_for_display')) {
                    // اگر صفحه با المنتور ساخته شده، همه ویجت‌ها را بارگذاری کن
                    $widgets = array('um_calendar', 'um_class_timer', 'um_video', 'um_seminar_slider', 'um_employment_exams', 'um_azmoon', 'um_slides', 'um_hall_booking');
                }
            }
        }
        
        // بررسی در پست‌ها و صفحات
        if (is_singular()) {
            global $post;
            if ($post && isset($post->post_content)) {
                // بررسی shortcode ها
                if (has_shortcode($post->post_content, 'um_calendar')) {
                    $widgets[] = 'um_calendar';
                }
                if (has_shortcode($post->post_content, 'um_class_timer')) {
                    $widgets[] = 'um_class_timer';
                }
                if (has_shortcode($post->post_content, 'um_video')) {
                    $widgets[] = 'um_video';
                }
                if (has_shortcode($post->post_content, 'um_seminar_slider')) {
                    $widgets[] = 'um_seminar_slider';
                }
                if (has_shortcode($post->post_content, 'um_employment_exams')) {
                    $widgets[] = 'um_employment_exams';
                }
                if (has_shortcode($post->post_content, 'um_azmoon')) {
                    $widgets[] = 'um_azmoon';
                }
                if (has_shortcode($post->post_content, 'um_slides')) {
                    $widgets[] = 'um_slides';
                }
                if (has_shortcode($post->post_content, 'um_hall_booking')) {
                    $widgets[] = 'um_hall_booking';
                }
            }
        }
        
        // اگر هیچ ویجتی تشخیص داده نشد، همه را بارگذاری کن (برای اطمینان)
        if (empty($widgets)) {
            $widgets = array('um_calendar', 'um_class_timer', 'um_video', 'um_seminar_slider', 'um_employment_exams', 'um_azmoon', 'um_slides', 'um_hall_booking');
        }
        
        return array_unique($widgets);
    }

    /**
     * اضافه کردن اسکریپت‌های ویجت‌ها
     */
    public function widget_scripts() {
        // همیشه همه اسکریپت‌ها را بارگذاری کن (برای اطمینان)
        $this->enqueue_all_widget_scripts();
    }
    
    /**
     * بارگذاری همه اسکریپت‌های ویجت‌ها (برای حالت ویرایش)
     */
    private function enqueue_all_widget_scripts() {
        // بارگذاری کتابخانه‌های خارجی
        wp_register_script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', array(), '2.29.1', true);
        wp_register_script('moment-jalaali', 'https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', array('moment'), '0.9.2', true);
        wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);
        wp_register_script('lucide', 'https://unpkg.com/lucide@latest', array(), null, true);

        // بارگذاری همه اسکریپت‌های ویجت‌ها
        wp_register_script('um-calendar-widget', UM_PLUGIN_URL . 'assets/js/calendar-widget.js', array('jquery', 'moment', 'moment-jalaali'), UM_VERSION, true);
        wp_register_script('um-class-timer-widget', UM_PLUGIN_URL . 'assets/js/class-timer-widget.js', array('jquery', 'moment', 'moment-jalaali'), UM_VERSION, true);
        wp_register_script('um-video-widget', UM_PLUGIN_URL . 'assets/js/video-widget.js', array('jquery'), UM_VERSION, true);
        wp_register_script('um-seminar-slider-widget', UM_PLUGIN_URL . 'assets/js/seminar-slider-widget.js', array('jquery', 'swiper', 'lucide'), UM_VERSION, true);
        wp_register_script('um-azmoon-widget', UM_PLUGIN_URL . 'assets/js/azmoon-widget.js', array('jquery'), UM_VERSION, true);
        wp_register_script('um-employment-exams-widget', UM_PLUGIN_URL . 'assets/js/employment-exams-widget.js', array('jquery'), UM_VERSION, true);
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/staff-carousel-widget.js')) {
            wp_register_script('um-staff-carousel-widget', UM_PLUGIN_URL . 'assets/js/staff-carousel-widget.js', array('jquery','swiper'), UM_VERSION, true);
        }
        
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/hall-booking-widget.js')) {
            wp_register_script('um-hall-booking-widget', UM_PLUGIN_URL . 'assets/js/hall-booking-widget.js', array('jquery'), UM_VERSION, true);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/suggestion-widget.js')) {
            wp_register_script('um-suggestion-widget', UM_PLUGIN_URL . 'assets/js/suggestion-widget.js', array('jquery'), UM_VERSION, true);
            wp_enqueue_script('um-suggestion-widget');
            wp_localize_script('um-suggestion-widget', 'um_suggestion_vars', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('university-management-nonce')
            ));
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
    }
    
    /**
     * بارگذاری شرطی اسکریپت‌های ویجت‌ها
     */
    private function enqueue_widget_scripts_conditionally() {
        // برای اطمینان، همیشه کتابخانه‌های خارجی را بارگذاری کن
        wp_register_script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', array(), '2.29.1', true);
        wp_register_script('moment-jalaali', 'https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', array('moment'), '0.9.2', true);
        wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);
        wp_register_script('lucide', 'https://unpkg.com/lucide@latest', array(), null, true);

        // بارگذاری همه اسکریپت‌های اصلی
        wp_register_script('um-calendar-widget', UM_PLUGIN_URL . 'assets/js/calendar-widget.js', array('jquery', 'moment', 'moment-jalaali'), UM_VERSION, true);
        wp_register_script('um-class-timer-widget', UM_PLUGIN_URL . 'assets/js/class-timer-widget.js', array('jquery', 'moment', 'moment-jalaali'), UM_VERSION, true);
        wp_register_script('um-video-widget', UM_PLUGIN_URL . 'assets/js/video-widget.js', array('jquery'), UM_VERSION, true);
        wp_register_script('um-seminar-slider-widget', UM_PLUGIN_URL . 'assets/js/seminar-slider-widget.js', array('jquery', 'swiper', 'lucide'), UM_VERSION, true);
        wp_register_script('um-azmoon-widget', UM_PLUGIN_URL . 'assets/js/azmoon-widget.js', array('jquery'), UM_VERSION, true);
        wp_register_script('um-employment-exams-widget', UM_PLUGIN_URL . 'assets/js/employment-exams-widget.js', array('jquery'), UM_VERSION, true);
        
        // بارگذاری فایل‌های اختیاری
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/hall-booking-widget.js')) {
            wp_register_script('um-hall-booking-widget', UM_PLUGIN_URL . 'assets/js/hall-booking-widget.js', array('jquery'), UM_VERSION, true);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/suggestion-widget.js')) {
            wp_register_script('um-suggestion-widget', UM_PLUGIN_URL . 'assets/js/suggestion-widget.js', array('jquery'), UM_VERSION, true);
        }
        if (file_exists(UM_PLUGIN_DIR . 'assets/js/slides-widget.js')) {
            wp_register_script('um-slides-widget', UM_PLUGIN_URL . 'assets/js/slides-widget.js', array('jquery','swiper'), UM_VERSION, true);
        }
        
        // لوکالایز اسکریپت‌های اصلی
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
        
        // لوکالایز اسکریپت‌های اختیاری
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
        
        if (wp_script_is('um-suggestion-widget', 'registered')) {
            wp_localize_script('um-suggestion-widget', 'um_suggestion_vars', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('university-management-nonce')
            ));
        }
    }
}

// راه‌اندازی ویجت‌های المنتور
function um_elementor_widgets_init() {
    return UM_Elementor_Widgets::get_instance();
}

// راه‌اندازی فوری ویجت‌ها
add_action('elementor/loaded', 'um_elementor_widgets_init');
add_action('init', 'um_elementor_widgets_init', 20);
add_action('wp_loaded', 'um_elementor_widgets_init', 5); 