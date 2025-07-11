<?php
/**
 * Plugin Name: مدیریت دانشگاه آب و برق خوزستان
 * Plugin URI: https://farazec.com
 * Description: افزونه مدیریت دانشگاه شامل سه ویجت اختصاصی المنتور: تقویم، زمان‌بندی کلاس‌ها و مدیریت ویدیوها + پشتیبانی کامل از تصاویر شاخص
 * Version: 1.3.0
 * Author: منصور شوکت
 * Author URI: https://farazec.com
 * Text Domain: university-management
 * Domain Path: /languages
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

// تعریف ثابت‌های افزونه
define('UM_VERSION', '1.3.0');
define('UM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('UM_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * کلاس اصلی افزونه مدیریت دانشگاه
 */
class University_Management {

    /**
     * نمونه کلاس
     * @var University_Management
     */
    private static $instance = null;

    /**
     * دریافت نمونه کلاس
     * @return University_Management
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
        // بارگذاری متن‌های قابل ترجمه
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        
        // بررسی وجود المنتور
        add_action('plugins_loaded', array($this, 'check_elementor'));
        
        // افزودن منوی مدیریت
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // اضافه کردن CSS و JS
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        
        // ثبت پست‌تایپ‌ها
        add_action('init', array($this, 'register_post_types'));
        
        // افزودن متاباکس‌ها
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        
        // ذخیره متاباکس‌ها
        add_action('save_post_um_videos', array($this, 'save_video_meta'));
        add_action('save_post_um_seminars', array($this, 'save_seminar_meta'));
        
        // اضافه کردن اکشن‌های AJAX
        add_action('wp_ajax_um_get_videos_by_category', array($this, 'ajax_get_videos_by_category'));
        add_action('wp_ajax_nopriv_um_get_videos_by_category', array($this, 'ajax_get_videos_by_category'));
        
        // اکشن‌های AJAX برای پایگاه داده
        add_action('wp_ajax_um_import_database', array($this, 'ajax_import_database'));
        add_action('wp_ajax_um_delete_imported_data', array($this, 'ajax_delete_imported_data'));
        add_action('wp_ajax_um_get_import_status', array($this, 'ajax_get_import_status'));
        add_action('wp_ajax_um_get_import_logs', array($this, 'ajax_get_import_logs'));
        add_action('wp_ajax_um_clear_import_logs', array($this, 'ajax_clear_import_logs'));
        

    }

    /**
     * بارگذاری فایل‌های ترجمه
     */
    public function load_textdomain() {
        load_plugin_textdomain('university-management', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * بررسی وجود المنتور
     */
    public function check_elementor() {
        // بررسی نصب و فعال بودن المنتور
        if (did_action('elementor/loaded')) {
            // بارگذاری ویجت‌های المنتور
            $elementor_widgets_file = UM_PLUGIN_DIR . 'includes/widgets/elementor-widgets.php';
            if (file_exists($elementor_widgets_file)) {
                require_once $elementor_widgets_file;
                add_action('elementor/widgets/widgets_registered', array($this, 'register_elementor_widgets'));
            } else {
                add_action('admin_notices', array($this, 'elementor_widgets_missing_notice'));
            }
        } else {
            // نمایش پیغام خطا اگر المنتور نصب نباشد
            add_action('admin_notices', array($this, 'elementor_missing_notice'));
        }
    }

    /**
     * نمایش پیغام خطای عدم نصب المنتور
     */
    public function elementor_missing_notice() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            esc_html__('برای استفاده از افزونه مدیریت دانشگاه، لطفاً المنتور را نصب و فعال کنید.', 'university-management')
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
    
    /**
     * نمایش پیغام خطای عدم وجود فایل‌های ویجت
     */
    public function elementor_widgets_missing_notice() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            esc_html__('فایل‌های ویجت افزونه مدیریت دانشگاه یافت نشد. لطفاً افزونه را دوباره نصب کنید.', 'university-management')
        );

        printf('<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * ثبت ویجت‌های المنتور
     */
    public function register_elementor_widgets() {
        // ثبت ویجت‌ها
        if (class_exists('UM_Elementor_Widgets')) {
            try {
                UM_Elementor_Widgets::get_instance();
            } catch (Exception $e) {
                // لاگ خطا
                error_log('UM Plugin Error: ' . $e->getMessage());
                
                // نمایش پیغام خطا در مدیریت
                add_action('admin_notices', function() use ($e) {
                    printf('<div class="notice notice-error is-dismissible"><p>خطا در بارگذاری ویجت‌های المنتور: %s</p></div>', 
                        esc_html($e->getMessage()));
                });
            }
        }
    }

    /**
     * افزودن منوی مدیریت
     */
    public function add_admin_menu() {
        // منوی اصلی
        add_menu_page(
            __('مدیریت دانشگاه', 'university-management'),
            __('مدیریت دانشگاه', 'university-management'),
            'manage_options',
            'university-management',
            array($this, 'admin_page'),
            'dashicons-welcome-learn-more',
            25
        );
        
        // زیرمنوها
        add_submenu_page(
            'university-management',
            __('تقویم دانشگاه', 'university-management'),
            __('تقویم دانشگاه', 'university-management'),
            'manage_options',
            'university-calendar',
            array($this, 'calendar_admin_page')
        );
        
        add_submenu_page(
            'university-management',
            __('زمان‌بندی کلاس‌ها', 'university-management'),
            __('زمان‌بندی کلاس‌ها', 'university-management'),
            'manage_options',
            'university-class-timing',
            array($this, 'class_timing_admin_page')
        );
        
        add_submenu_page(
            'university-management',
            __('مدیریت ویدیوها', 'university-management'),
            __('مدیریت ویدیوها', 'university-management'),
            'manage_options',
            'university-videos',
            array($this, 'videos_admin_page')
        );
        
        add_submenu_page(
            'university-management',
            __('ورود اطلاعات پایگاه داده', 'university-management'),
            __('ورود اطلاعات پایگاه داده', 'university-management'),
            'manage_options',
            'university-database-import',
            array($this, 'database_import_admin_page')
        );
        
        add_submenu_page(
            'university-management',
            __('کارگاه و سمینارها', 'university-management'),
            __('کارگاه و سمینارها', 'university-management'),
            'manage_options',
            'edit.php?post_type=um_seminars'
        );
    }

    /**
     * صفحه اصلی مدیریت
     */
    public function admin_page() {
        $admin_file = UM_PLUGIN_DIR . 'admin/admin-page.php';
        if (file_exists($admin_file)) {
            require_once $admin_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل admin-page.php یافت نشد.</p></div>';
        }
    }

    /**
     * صفحه مدیریت تقویم
     */
    public function calendar_admin_page() {
        $calendar_file = UM_PLUGIN_DIR . 'admin/calendar-page.php';
        if (file_exists($calendar_file)) {
            require_once $calendar_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل calendar-page.php یافت نشد.</p></div>';
        }
    }

    /**
     * صفحه مدیریت زمان‌بندی کلاس‌ها
     */
    public function class_timing_admin_page() {
        $timing_file = UM_PLUGIN_DIR . 'admin/class-timing-page.php';
        if (file_exists($timing_file)) {
            require_once $timing_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل class-timing-page.php یافت نشد.</p></div>';
        }
    }

    /**
     * صفحه مدیریت ویدیوها
     */
    public function videos_admin_page() {
        $videos_file = UM_PLUGIN_DIR . 'admin/videos-page.php';
        if (file_exists($videos_file)) {
            require_once $videos_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل videos-page.php یافت نشد.</p></div>';
        }
    }
    
    /**
     * صفحه ورود اطلاعات پایگاه داده
     */
    public function database_import_admin_page() {
        $import_file = UM_PLUGIN_DIR . 'admin/database-import-page.php';
        if (file_exists($import_file)) {
            require_once $import_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل database-import-page.php یافت نشد.</p></div>';
        }
    }
    
    /**
     * افزودن متاباکس‌ها
     */
    public function add_meta_boxes() {
        add_meta_box(
            'um_video_link',
            __('اطلاعات اضافی ویدیو', 'university-management'),
            array($this, 'video_link_meta_box'),
            'um_videos',
            'normal',
            'high'
        );
        add_meta_box(
            'um_seminar_details',
            __('جزئیات سمینار', 'university-management'),
            array($this, 'seminar_details_meta_box'),
            'um_seminars',
            'normal',
            'high'
        );
    }
    
    /**
     * نمایش متاباکس لینک ویدیو
     */
    public function video_link_meta_box($post) {
        // دریافت مقادیر ذخیره شده
        $video_link = get_post_meta($post->ID, '_um_video_link', true);
        $video_type = get_post_meta($post->ID, '_um_video_type', true) ?: 'external';
        $video_file_id = get_post_meta($post->ID, '_um_video_file_id', true);
        
        // تولید نانس برای امنیت
        wp_nonce_field('um_video_link_nonce', 'um_video_link_nonce');
        
        // اضافه کردن فایل‌های مدیا وردپرس
        wp_enqueue_media();
        
        // نمایش فیلدها
        ?>
        <div class="um-video-options">
            <p>
                <label><input type="radio" name="um_video_type" value="external" <?php checked($video_type, 'external'); ?>> <?php _e('لینک خارجی (YouTube، Vimeo، آپارات و غیره)', 'university-management'); ?></label><br>
                <label><input type="radio" name="um_video_type" value="direct" <?php checked($video_type, 'direct'); ?>> <?php _e('لینک مستقیم (MP4، WebM و غیره)', 'university-management'); ?></label><br>
                <label><input type="radio" name="um_video_type" value="upload" <?php checked($video_type, 'upload'); ?>> <?php _e('آپلود ویدیو', 'university-management'); ?></label>
            </p>
            
            <div id="um-external-link" class="um-video-field" style="<?php echo ($video_type != 'external') ? 'display:none;' : ''; ?>">
                <p>
                    <label for="um_video_link"><?php _e('آدرس لینک ویدیو را وارد کنید:', 'university-management'); ?></label>
                    <input type="url" id="um_video_link" name="um_video_link" value="<?php echo esc_url($video_link); ?>" style="width: 100%;" placeholder="<?php _e('مثال: https://www.youtube.com/watch?v=abcdef', 'university-management'); ?>" />
                </p>
                <p class="description">
                    <?php _e('لینک ویدیو از سرویس‌هایی مانند YouTube، Vimeo، آپارات و یا هر سرویس دیگری را وارد کنید.', 'university-management'); ?>
                </p>
            </div>
            
            <div id="um-direct-link" class="um-video-field" style="<?php echo ($video_type != 'direct') ? 'display:none;' : ''; ?>">
                <p>
                    <label for="um_video_direct_link"><?php _e('آدرس مستقیم فایل ویدیو را وارد کنید:', 'university-management'); ?></label>
                    <input type="url" id="um_video_direct_link" name="um_video_direct_link" value="<?php echo ($video_type == 'direct') ? esc_url($video_link) : ''; ?>" style="width: 100%;" placeholder="<?php _e('مثال: https://example.com/videos/sample.mp4', 'university-management'); ?>" />
                </p>
                <p class="description">
                    <?php _e('آدرس مستقیم فایل ویدیو با فرمت MP4، WebM یا OGV را وارد کنید.', 'university-management'); ?>
                </p>
            </div>
            
            <div id="um-upload-video" class="um-video-field" style="<?php echo ($video_type != 'upload') ? 'display:none;' : ''; ?>">
                <p>
                    <label for="um_video_file"><?php _e('فایل ویدیو:', 'university-management'); ?></label>
                    <input type="hidden" id="um_video_file_id" name="um_video_file_id" value="<?php echo esc_attr($video_file_id); ?>" />
                    <input type="text" id="um_video_file_url" value="<?php echo ($video_type == 'upload' && $video_file_id) ? esc_url($video_link) : ''; ?>" readonly style="width: 80%;" placeholder="<?php _e('فایل ویدیو انتخاب نشده است', 'university-management'); ?>" />
                    <button type="button" id="um_upload_video_button" class="button"><?php _e('انتخاب ویدیو', 'university-management'); ?></button>
                    <button type="button" id="um_remove_video_button" class="button" <?php echo empty($video_file_id) ? 'style="display:none;"' : ''; ?>><?php _e('حذف', 'university-management'); ?></button>
                </p>
                <div id="um_video_preview" style="<?php echo ($video_type == 'upload' && $video_file_id) ? '' : 'display:none;'; ?> margin-top: 10px;">
                    <video width="320" height="240" controls>
                        <source src="<?php echo ($video_type == 'upload' && $video_file_id) ? esc_url($video_link) : ''; ?>" type="video/mp4">
                        <?php _e('مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.', 'university-management'); ?>
                    </video>
                </div>
                <p class="description">
                    <?php _e('فایل ویدیو را از کتابخانه رسانه وردپرس انتخاب کنید یا آپلود نمایید.', 'university-management'); ?>
                </p>
            </div>
        </div>
        
        <script>
            jQuery(document).ready(function($) {
                // تغییر نوع ویدیو
                $('input[name="um_video_type"]').on('change', function() {
                    var type = $(this).val();
                    $('.um-video-field').hide();
                    $('#um-' + type + (type === 'upload' ? '-video' : '-link')).show();
                });
                
                // آپلود ویدیو
                $('#um_upload_video_button').on('click', function(e) {
                    e.preventDefault();
                    
                    var mediaUploader = wp.media({
                        title: '<?php _e('انتخاب ویدیو', 'university-management'); ?>',
                        button: {
                            text: '<?php _e('انتخاب', 'university-management'); ?>'
                        },
                        library: {
                            type: 'video'
                        },
                        multiple: false
                    });
                    
                    mediaUploader.on('select', function() {
                        var attachment = mediaUploader.state().get('selection').first().toJSON();
                        $('#um_video_file_id').val(attachment.id);
                        $('#um_video_file_url').val(attachment.url);
                        $('#um_video_preview source').attr('src', attachment.url);
                        $('#um_video_preview').show();
                        $('#um_video_preview video')[0].load();
                        $('#um_remove_video_button').show();
                    });
                    
                    mediaUploader.open();
                });
                
                // حذف ویدیو
                $('#um_remove_video_button').on('click', function(e) {
                    e.preventDefault();
                    $('#um_video_file_id').val('');
                    $('#um_video_file_url').val('');
                    $('#um_video_preview').hide();
                    $(this).hide();
                });
            });
        </script>
        <style>
            .um-video-options {
                margin-bottom: 15px;
            }
            .um-video-field {
                margin-top: 10px;
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #e5e5e5;
                border-radius: 3px;
            }
        </style>
        <?php
    }
    
    /**
     * ذخیره متاباکس لینک ویدیو
     */
    public function save_video_meta($post_id) {
        // بررسی نانس
        if (!isset($_POST['um_video_link_nonce']) || !wp_verify_nonce($_POST['um_video_link_nonce'], 'um_video_link_nonce')) {
            return;
        }
        
        // بررسی دسترسی کاربر
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // بررسی اتوسیو
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        // ذخیره نوع ویدیو
        if (isset($_POST['um_video_type'])) {
            update_post_meta($post_id, '_um_video_type', sanitize_text_field($_POST['um_video_type']));
            
            // ذخیره مقدار بر اساس نوع ویدیو
            switch ($_POST['um_video_type']) {
                case 'external':
                    if (isset($_POST['um_video_link'])) {
                        update_post_meta($post_id, '_um_video_link', esc_url_raw($_POST['um_video_link']));
                    }
                    break;
                    
                case 'direct':
                    if (isset($_POST['um_video_direct_link'])) {
                        update_post_meta($post_id, '_um_video_link', esc_url_raw($_POST['um_video_direct_link']));
                    }
                    break;
                    
                case 'upload':
                    if (isset($_POST['um_video_file_id']) && !empty($_POST['um_video_file_id'])) {
                        $video_id = intval($_POST['um_video_file_id']);
                        $video_url = wp_get_attachment_url($video_id);
                        update_post_meta($post_id, '_um_video_file_id', $video_id);
                        update_post_meta($post_id, '_um_video_link', $video_url);
                    }
                    break;
            }
        }
    }

    /**
     * بارگذاری فایل‌های CSS و JS در سمت کاربر
     */
    public function enqueue_frontend_assets() {
        // استایل‌های عمومی
        wp_enqueue_style(
            'university-management-style',
            UM_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            UM_VERSION
        );
        
        // استایل‌های ویجت ویدیو
        wp_enqueue_style(
            'um-video-widget',
            UM_PLUGIN_URL . 'assets/css/video-widget.css',
            array(),
            UM_VERSION
        );
        
        // جاوااسکریپت‌های عمومی
        wp_enqueue_script(
            'university-management-script',
            UM_PLUGIN_URL . 'assets/js/frontend.js',
            array('jquery'),
            UM_VERSION,
            true
        );
        
        // جاوااسکریپت ویجت ویدیو
        wp_enqueue_script(
            'um-video-widget',
            UM_PLUGIN_URL . 'assets/js/video-widget.js',
            array('jquery'),
            UM_VERSION,
            true
        );
        
        // لوکالایز اسکریپت برای مقادیر داینامیک
        wp_localize_script(
            'university-management-script',
            'um_vars',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('university-management-nonce')
            )
        );
        
        // لوکالایز اسکریپت برای ویجت ویدیو
        wp_localize_script(
            'um-video-widget',
            'um_video_vars',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('um_video_nonce')
            )
        );
    }

    /**
     * بارگذاری فایل‌های CSS و JS در سمت مدیریت
     */
    public function enqueue_admin_assets($hook) {
        // بررسی صفحات مدیریت افزونه
        if (strpos($hook, 'university-management') === false) {
            return;
        }
        
        // استایل‌های مدیریت
        wp_enqueue_style(
            'university-management-admin-style',
            UM_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            UM_VERSION
        );
        
        // جاوااسکریپت‌های مدیریت
        wp_enqueue_script(
            'university-management-admin-script',
            UM_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            UM_VERSION,
            true
        );
    }

    /**
     * ثبت پست‌تایپ‌ها
     */
    public function register_post_types() {
        // ثبت پست تایپ تقویم دانشگاه
        register_post_type('um_calendar_events', array(
            'labels' => array(
                'name'               => __('رویدادهای تقویم', 'university-management'),
                'singular_name'      => __('رویداد تقویم', 'university-management'),
                'add_new'            => __('افزودن رویداد جدید', 'university-management'),
                'add_new_item'       => __('افزودن رویداد جدید', 'university-management'),
                'edit_item'          => __('ویرایش رویداد', 'university-management'),
                'new_item'           => __('رویداد جدید', 'university-management'),
                'view_item'          => __('مشاهده رویداد', 'university-management'),
                'search_items'       => __('جستجوی رویدادها', 'university-management'),
                'not_found'          => __('رویدادی یافت نشد', 'university-management'),
                'not_found_in_trash' => __('رویدادی در سطل زباله یافت نشد', 'university-management'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => 'university-management',
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon'           => 'dashicons-calendar-alt',
            'show_in_rest'        => true,
        ));

        // ثبت پست تایپ کلاس‌ها
        register_post_type('um_classes', array(
            'labels' => array(
                'name'               => __('کلاس‌ها', 'university-management'),
                'singular_name'      => __('کلاس', 'university-management'),
                'add_new'            => __('افزودن کلاس جدید', 'university-management'),
                'add_new_item'       => __('افزودن کلاس جدید', 'university-management'),
                'edit_item'          => __('ویرایش کلاس', 'university-management'),
                'new_item'           => __('کلاس جدید', 'university-management'),
                'view_item'          => __('مشاهده کلاس', 'university-management'),
                'search_items'       => __('جستجوی کلاس‌ها', 'university-management'),
                'not_found'          => __('کلاسی یافت نشد', 'university-management'),
                'not_found_in_trash' => __('کلاسی در سطل زباله یافت نشد', 'university-management'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => 'university-management',
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon'           => 'dashicons-clock',
            'show_in_rest'        => true,
        ));

        // ثبت پست تایپ ویدیوها
        $video_labels = array(
            'name'                  => _x( 'ویدیوها', 'Post Type General Name', 'university-management' ),
            'singular_name'         => _x( 'ویدیو', 'Post Type Singular Name', 'university-management' ),
            'menu_name'             => __( 'ویدیوها', 'university-management' ),
            'name_admin_bar'        => __( 'ویدیو', 'university-management' ),
            'archives'              => __( 'آرشیو ویدیوها', 'university-management' ),
            'attributes'            => __( 'ویژگی‌های ویدیو', 'university-management' ),
            'parent_item_colon'     => __( 'والد ویدیو:', 'university-management' ),
            'all_items'             => __( 'همه ویدیوها', 'university-management' ),
            'add_new_item'          => __( 'افزودن ویدیوی جدید', 'university-management' ),
            'add_new'               => __( 'افزودن جدید', 'university-management' ),
            'new_item'              => __( 'ویدیوی جدید', 'university-management' ),
            'edit_item'             => __( 'ویرایش ویدیو', 'university-management' ),
            'update_item'           => __( 'به‌روزرسانی ویدیو', 'university-management' ),
            'view_item'             => __( 'مشاهده ویدیو', 'university-management' ),
            'view_items'            => __( 'مشاهده ویدیوها', 'university-management' ),
            'search_items'          => __( 'جستجوی ویدیو', 'university-management' ),
            'not_found'             => __( 'یافت نشد', 'university-management' ),
            'not_found_in_trash'    => __( 'در زباله‌دان یافت نشد', 'university-management' ),
            'featured_image'        => __( 'تصویر شاخص', 'university-management' ),
            'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'university-management' ),
            'remove_featured_image' => __( 'حذف تصویر شاخص', 'university-management' ),
            'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'university-management' ),
            'insert_into_item'      => __( 'درج در ویدیو', 'university-management' ),
            'uploaded_to_this_item' => __( 'در این ویدیو بارگذاری شد', 'university-management' ),
            'items_list'            => __( 'لیست ویدیوها', 'university-management' ),
            'items_list_navigation' => __( 'ناوبری لیست ویدیوها', 'university-management' ),
            'filter_items_list'     => __( 'فیلتر لیست ویدیوها', 'university-management' ),
        );
        $video_args = array(
            'label'                 => __( 'ویدیو', 'university-management' ),
            'description'           => __( 'برای مدیریت ویدیوهای آموزشی', 'university-management' ),
            'labels'                => $video_labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'taxonomies'            => array( 'um_video_category' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'university-management',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'menu_icon'             => 'dashicons-video-alt3',
        );
        register_post_type( 'um_videos', $video_args );
        
        // ثبت تاکسونومی دسته‌بندی ویدیوها
        register_taxonomy('um_video_category', 'um_videos', array(
            'labels' => array(
                'name'              => _x( 'دسته‌بندی‌های ویدیو', 'taxonomy general name', 'university-management' ),
                'singular_name'     => _x( 'دسته‌بندی ویدیو', 'taxonomy singular name', 'university-management' ),
                'search_items'      => __( 'جستجوی دسته‌بندی‌ها', 'university-management' ),
                'all_items'         => __( 'همه دسته‌بندی‌ها', 'university-management' ),
                'parent_item'       => __( 'والد دسته‌بندی', 'university-management' ),
                'parent_item_colon' => __( 'والد دسته‌بندی:', 'university-management' ),
                'edit_item'         => __( 'ویرایش دسته‌بندی', 'university-management' ),
                'update_item'       => __( 'به‌روزرسانی دسته‌بندی', 'university-management' ),
                'add_new_item'      => __( 'افزودن دسته‌بندی جدید', 'university-management' ),
                'new_item_name'     => __( 'نام دسته‌بندی جدید', 'university-management' ),
                'menu_name'         => __( 'دسته‌بندی‌ها', 'university-management' ),
            ),
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'video-category' ),
            'show_in_rest'      => true,
        ));

        // ثبت فیلد لینک در REST API
        register_post_meta('um_videos', '_video_link', array(
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string',
        ));
        
        // ثبت فیلد بازدید در REST API
        register_post_meta('um_videos', '_video_views', array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'integer',
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ));

        // ثبت فیلد تاریخ فارسی در REST API
        register_post_meta('um_videos', '_persian_date', array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
        ));

        // پست‌تایپ کارگاه و سمینار
        $seminar_labels = array(
            'name'                  => _x( 'کارگاه و سمینارها', 'Post Type General Name', 'university-management' ),
            'singular_name'         => _x( 'کارگاه و سمینار', 'Post Type Singular Name', 'university-management' ),
            'menu_name'             => __( 'کارگاه و سمینارها', 'university-management' ),
            'name_admin_bar'        => __( 'کارگاه و سمینار', 'university-management' ),
            'archives'              => __( 'آرشیو کارگاه و سمینارها', 'university-management' ),
            'attributes'            => __( 'ویژگی‌های کارگاه و سمینار', 'university-management' ),
            'parent_item_colon'     => __( 'والد:', 'university-management' ),
            'all_items'             => __( 'همه کارگاه و سمینارها', 'university-management' ),
            'add_new_item'          => __( 'افزودن کارگاه/سمینار جدید', 'university-management' ),
            'add_new'               => __( 'افزودن جدید', 'university-management' ),
            'new_item'              => __( 'کارگاه/سمینار جدید', 'university-management' ),
            'edit_item'             => __( 'ویرایش کارگاه/سمینار', 'university-management' ),
            'update_item'           => __( 'به‌روزرسانی کارگاه/سمینار', 'university-management' ),
            'view_item'             => __( 'مشاهده کارگاه/سمینار', 'university-management' ),
            'view_items'            => __( 'مشاهده کارگاه و سمینارها', 'university-management' ),
            'search_items'          => __( 'جستجوی کارگاه/سمینار', 'university-management' ),
            'not_found'             => __( 'یافت نشد', 'university-management' ),
            'not_found_in_trash'    => __( 'در زباله‌دان یافت نشد', 'university-management' ),
            'featured_image'        => __( 'تصویر شاخص', 'university-management' ),
            'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'university-management' ),
            'remove_featured_image' => __( 'حذف تصویر شاخص', 'university-management' ),
            'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'university-management' ),
            'insert_into_item'      => __( 'درج در کارگاه/سمینار', 'university-management' ),
            'uploaded_to_this_item' => __( 'در این کارگاه/سمینار بارگذاری شد', 'university-management' ),
            'items_list'            => __( 'لیست کارگاه و سمینارها', 'university-management' ),
            'items_list_navigation' => __( 'ناوبری لیست کارگاه و سمینارها', 'university-management' ),
            'filter_items_list'     => __( 'فیلتر لیست کارگاه و سمینارها', 'university-management' ),
        );
        $seminar_args = array(
            'label'                 => __( 'کارگاه و سمینار', 'university-management' ),
            'description'           => __( 'برای مدیریت کارگاه و سمینارها', 'university-management' ),
            'labels'                => $seminar_labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'taxonomies'            => array( 'um_seminar_category' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'university-management',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'menu_icon'             => 'dashicons-groups',
            'show_in_rest'          => true,
        );
        register_post_type( 'um_seminars', $seminar_args );

        // دسته‌بندی برای کارگاه و سمینارها
        $seminar_cat_labels = array(
            'name'              => _x( 'دسته‌بندی‌های سمینار', 'taxonomy general name', 'university-management' ),
            'singular_name'     => _x( 'دسته‌بندی سمینار', 'taxonomy singular name', 'university-management' ),
            'search_items'      => __( 'جستجوی دسته‌بندی‌ها', 'university-management' ),
            'all_items'         => __( 'همه دسته‌بندی‌ها', 'university-management' ),
            'parent_item'       => __( 'والد دسته‌بندی', 'university-management' ),
            'parent_item_colon' => __( 'والد دسته‌بندی:', 'university-management' ),
            'edit_item'         => __( 'ویرایش دسته‌بندی', 'university-management' ),
            'update_item'       => __( 'به‌روزرسانی دسته‌بندی', 'university-management' ),
            'add_new_item'      => __( 'افزودن دسته‌بندی جدید', 'university-management' ),
            'new_item_name'     => __( 'نام دسته‌بندی جدید', 'university-management' ),
            'menu_name'         => __( 'دسته‌بندی‌ها', 'university-management' ),
        );
        $seminar_cat_args = array(
            'hierarchical'      => true,
            'labels'            => $seminar_cat_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'seminar-category' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'um_seminar_category', array( 'um_seminars' ), $seminar_cat_args );
    }

    /**
     * دریافت ویدیوها بر اساس دسته‌بندی با AJAX
     */
    public function ajax_get_videos_by_category() {
        // بررسی نانس
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'um_video_nonce')) {
            wp_send_json_error('خطای امنیتی');
            return;
        }
        
        // دریافت شناسه دسته‌بندی
        $category_id = isset($_POST['category_id']) ? sanitize_text_field($_POST['category_id']) : '';
        
        // آرگومان‌های کوئری
        $args = array(
            'post_type' => 'um_videos',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        
        // اضافه کردن فیلتر دسته‌بندی اگر انتخاب شده باشد
        if (!empty($category_id) && $category_id !== 'default') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'um_video_category',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            );
        }
        
        // اجرای کوئری
        $query = new WP_Query($args);
        $videos = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                $video_link = get_post_meta(get_the_ID(), '_um_video_link', true);
                $video_type = get_post_meta(get_the_ID(), '_um_video_type', true) ?: 'external';
                
                $videos[] = array(
                    'title' => get_the_title(),
                    'src' => $video_link,
                    'type' => $video_type,
                    'thumb' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: plugins_url('assets/images/video-placeholder.jpg', __FILE__),
                );
            }
            
            wp_reset_postdata();
        }
        
        wp_send_json_success($videos);
    }
    
    /**
     * AJAX: ورود اطلاعات پایگاه داده
     */
    public function ajax_import_database() {
        // شروع لاگ گیری
        $this->log_import_process('شروع AJAX import', array(
            'user_id' => get_current_user_id(),
            'files' => $_FILES,
            'post_data' => $_POST
        ));
        
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['um_import_nonce'], 'um_import_nonce')) {
            $this->log_import_process('خطای امنیتی', array(
                'user_can_manage' => current_user_can('manage_options'),
                'nonce_verify' => wp_verify_nonce($_POST['um_import_nonce'], 'um_import_nonce'),
                'nonce_value' => isset($_POST['um_import_nonce']) ? $_POST['um_import_nonce'] : 'not_set'
            ));
            wp_send_json_error('خطای امنیتی');
        }

        // بررسی وجود فایل
        if (!isset($_FILES['sql_file']) || $_FILES['sql_file']['error'] !== UPLOAD_ERR_OK) {
            $this->log_import_process('خطای آپلود فایل', array(
                'file_exists' => isset($_FILES['sql_file']),
                'file_error' => isset($_FILES['sql_file']) ? $_FILES['sql_file']['error'] : 'not_set'
            ));
            wp_send_json_error('فایل آپلود نشده است.');
        }

        $file = $_FILES['sql_file'];
        
        $this->log_import_process('اطلاعات فایل', array(
            'name' => $file['name'],
            'size' => $file['size'],
            'type' => $file['type'],
            'tmp_name' => $file['tmp_name'],
            'error' => $file['error']
        ));
        
        // بررسی پسوند فایل
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (strtolower($file_extension) !== 'sql') {
            $this->log_import_process('خطای پسوند فایل', array(
                'extension' => $file_extension,
                'filename' => $file['name']
            ));
            wp_send_json_error('فقط فایل‌های SQL مجاز هستند.');
        }

        // بررسی سایز فایل (حداکثر 50 مگابایت)
        if ($file['size'] > 50 * 1024 * 1024) {
            $this->log_import_process('خطای سایز فایل', array(
                'size' => $file['size'],
                'max_size' => 50 * 1024 * 1024
            ));
            wp_send_json_error('سایز فایل باید کمتر از 50 مگابایت باشد.');
        }

        // خواندن محتوای فایل
        $sql_content = file_get_contents($file['tmp_name']);
        if ($sql_content === false) {
            $this->log_import_process('خطا در خواندن فایل', array(
                'tmp_name' => $file['tmp_name'],
                'file_exists' => file_exists($file['tmp_name'])
            ));
            wp_send_json_error('خطا در خواندن فایل.');
        }

        $this->log_import_process('فایل خوانده شد', array(
            'content_length' => strlen($sql_content),
            'content_preview' => substr($sql_content, 0, 500)
        ));

        // پردازش و ورود اطلاعات
        $result = $this->process_sql_import($sql_content);
        
        $this->log_import_process('نتیجه نهایی', array(
            'result' => $result
        ));
        
        if ($result['success']) {
            wp_send_json_success($result);
        } else {
            wp_send_json_error($result['message']);
        }
    }
    
    /**
     * AJAX: حذف اطلاعات وارد شده
     */
    public function ajax_delete_imported_data() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_delete_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $result = $this->delete_imported_news_data();
        
        if ($result['success']) {
            wp_send_json_success($result);
        } else {
            wp_send_json_error($result['message']);
        }
    }
    
    /**
     * AJAX: دریافت وضعیت ورود اطلاعات
     */
    public function ajax_get_import_status() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_status_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $status = $this->get_import_status();
        wp_send_json_success($status);
    }
    
    /**
     * AJAX: دریافت لاگ‌های import
     */
    public function ajax_get_import_logs() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_logs_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $logs = get_option('_um_import_logs', array());
        $logs = array_reverse($logs); // نمایش آخرین لاگ‌ها در بالا
        
        wp_send_json_success($logs);
    }
    
    /**
     * AJAX: پاک کردن لاگ‌ها
     */
    public function ajax_clear_import_logs() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_clear_logs_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        delete_option('_um_import_logs');
        
        // پاک کردن فایل لاگ
        $log_file = WP_CONTENT_DIR . '/um-import-log.txt';
        if (file_exists($log_file)) {
            unlink($log_file);
        }
        
        wp_send_json_success('لاگ‌ها پاک شدند');
    }
    
    /**
     * پردازش و ورود اطلاعات SQL
     */
    private function process_sql_import($sql_content) {
        global $wpdb;
        
        try {
            // لاگ شروع عملیات
            $this->log_import_process('شروع عملیات import', array(
                'file_size' => strlen($sql_content),
                'preview' => substr($sql_content, 0, 500) . '...'
            ));
            
            // استخراج اخبار از محتوای SQL
            $news_data = $this->extract_news_from_sql($sql_content);
            $comments_data = $this->extract_comments_from_sql($sql_content);
            
            $this->log_import_process('نتایج استخراج اطلاعات', array(
                'news_count' => count($news_data),
                'comments_count' => count($comments_data),
                'first_news' => !empty($news_data) ? $news_data[0] : null,
                'first_comment' => !empty($comments_data) ? $comments_data[0] : null
            ));
            
            if (empty($news_data)) {
                $this->log_import_process('خطا: هیچ خبری یافت نشد', array(
                    'sql_preview' => substr($sql_content, 0, 1000)
                ));
                return array('success' => false, 'message' => 'هیچ خبری در فایل یافت نشد.');
            }
            
            $imported_news = 0;
            $imported_comments = 0;
            $imported_images = 0;
            
            // ایجاد دسته‌بندی برای اخبار
            $news_category = wp_create_category('اخبار دانشگاه');
            
            // ورود اخبار
            foreach ($news_data as $news) {
                // ایجاد پست جدید
                $post_data = array(
                    'post_title'    => sanitize_text_field($news['subject']),
                    'post_content'  => wp_kses_post($news['content']),
                    'post_excerpt'  => wp_kses_post($news['summary']),
                    'post_status'   => 'publish',
                    'post_type'     => 'post',
                    'post_category' => array($news_category),
                    'meta_input'    => array(
                        '_um_imported_news' => true,
                        '_um_original_id'   => $news['id'],
                        '_um_news_hits'     => $news['hits'],
                        '_um_news_date'     => $news['news_date'],
                        '_um_news_time'     => $news['news_time'],
                        '_um_year'          => $news['year'],
                        '_um_month'         => $news['month'],
                        '_um_num_month'     => $news['num_month'],
                        '_um_day'           => $news['day']
                    )
                );
                
                $post_id = wp_insert_post($post_data);
                
                if ($post_id && !is_wp_error($post_id)) {
                    $imported_news++;
                    
                    // پردازش تصاویر و تنظیم Featured Image
                    $processed_images = $this->process_news_images($post_id, $news['content'], $news['image_url']);
                    if ($processed_images > 0) {
                        $imported_images += $processed_images;
                    }
                    
                    // ذخیره نقشه ID برای کامنت‌ها
                    update_option('_um_news_id_map_' . $news['id'], $post_id);
                }
            }
            
            // ورود کامنت‌ها
            foreach ($comments_data as $comment) {
                // یافتن پست مربوطه
                $post_id = get_option('_um_news_id_map_' . $comment['news_id']);
                if ($post_id) {
                    $comment_data = array(
                        'comment_post_ID'      => $post_id,
                        'comment_author'       => sanitize_text_field($comment['name']),
                        'comment_author_email' => sanitize_email($comment['email']),
                        'comment_content'      => sanitize_textarea_field($comment['message']),
                        'comment_approved'     => $comment['approved'] ? 1 : 0,
                        'comment_date'         => $this->convert_persian_date($comment['comment_date'], $comment['comment_time']),
                        'comment_meta'         => array(
                            '_um_imported_comment' => true,
                            '_um_original_id'      => $comment['id']
                        )
                    );
                    
                    $comment_id = wp_insert_comment($comment_data);
                    if ($comment_id) {
                        $imported_comments++;
                    }
                }
            }
            
            // ذخیره آمار ورود
            update_option('_um_import_stats', array(
                'news_count'     => $imported_news,
                'comments_count' => $imported_comments,
                'images_count'   => $imported_images,
                'import_date'    => current_time('mysql')
            ));
            
            return array(
                'success' => true,
                'message' => sprintf(
                    '%d خبر، %d کامنت و %d تصویر با موفقیت وارد شد.',
                    $imported_news,
                    $imported_comments,
                    $imported_images
                )
            );
            
        } catch (Exception $e) {
            return array('success' => false, 'message' => 'خطا در پردازش: ' . $e->getMessage());
        }
    }
    
    /**
     * استخراج اخبار از محتوای SQL
     */
    private function extract_news_from_sql($sql_content) {
        $news_data = array();
        
        // الگوهای مختلف regex برای یافتن INSERT statements اخبار
        $patterns = array(
            // Pattern با lookahead - بهترین برای محتوای پیچیده HTML/CSS
            '/INSERT\s+INTO\s+kw_news\s*\([^)]+\)\s*VALUES\s*\(.*?\);(?=\s*(?:INSERT|$))/si',
            // Pattern کامل با تشخیص پایان statement
            '/INSERT\s+INTO\s+kw_news\s*\([^)]+\)\s*VALUES\s*\(.*?\);/s',
            // Pattern برای حالت پیچیده با nested parentheses
            '/INSERT\s+INTO\s+kw_news\s*\([^)]+\)\s*VALUES\s*\([^;]*(?:\([^)]*\)[^;]*)*\);/si',
            // Pattern های عمومی‌تر
            '/INSERT\s+INTO\s+`?kw_news`?\s*\([^)]+\)\s*VALUES\s*\([^;]*\);/si',
            '/INSERT\s+INTO\s+`?(?:kw_)?news`?\s*\([^)]*\)\s*VALUES[^;]*;/si',
            '/INSERT\s+INTO\s+[`\'"]?(?:kw_)?news[`\'"]?[^;]+;/si',
            '/INSERT\s+INTO\s+news\s*\([^)]+\)\s*VALUES[^;]+;/si'
        );
        
        $this->log_import_process('شروع استخراج اخبار', array(
            'patterns' => $patterns,
            'sql_length' => strlen($sql_content),
            'sql_preview' => substr($sql_content, 0, 500)
        ));
        
        $found_matches = false;
        
        foreach ($patterns as $pattern_index => $pattern) {
            $this->log_import_process("تست pattern {$pattern_index}", array('pattern' => $pattern));
            
            if (preg_match_all($pattern, $sql_content, $matches)) {
                $found_matches = true;
                $this->log_import_process("Pattern {$pattern_index} موفق - INSERT statements یافت شد", array(
                    'pattern' => $pattern,
                    'count' => count($matches[0]),
                    'first_match' => isset($matches[0][0]) ? substr($matches[0][0], 0, 300) . '...' : null
                ));
                
                foreach ($matches[0] as $index => $insert_statement) {
                    // استخراج VALUES با پشتیبانی از nested parentheses
                    if (preg_match('/VALUES\s*\((.*)\);?$/s', $insert_statement, $values_match)) {
                        // بررسی اینکه آیا columns مشخص شده یا نه
                        $has_columns = preg_match('/INSERT\s+INTO\s+\w+\s*\(([^)]+)\)/i', $insert_statement, $columns_match);
                        
                        $values = $this->parse_sql_values($values_match[1]);
                        
                        $this->log_import_process("پردازش INSERT {$index}", array(
                            'has_columns' => $has_columns,
                            'values_count' => count($values),
                            'values_preview' => array_slice($values, 0, 5),
                            'statement_preview' => substr($insert_statement, 0, 200)
                        ));
                        
                        $news_item = null;
                        
                        if ($has_columns && isset($columns_match[1])) {
                            // Column-based INSERT - نقشه‌برداری columns به values
                            $columns = array_map('trim', explode(',', $columns_match[1]));
                            $news_item = $this->map_columns_to_news($columns, $values);
                        } elseif (count($values) >= 14) {
                            // Values-only INSERT - روش قدیمی
                            $news_item = array(
                                'id'         => intval(trim($values[0], "'")),
                                'group_id'   => intval(trim($values[1], "'")),
                                'sender_id'  => trim($values[2], "'"),
                                'subject'    => trim($values[3], "'"),
                                'summary'    => trim($values[4], "'"),
                                'content'    => trim($values[5], "'"),
                                'image_url'  => trim($values[6], "'"),
                                'hits'       => intval(trim($values[7], "'")),
                                'news_date'  => trim($values[8], "'"),
                                'news_time'  => trim($values[9], "'"),
                                'year'       => intval(trim($values[10], "'")),
                                'month'      => trim($values[11], "'"),
                                'num_month'  => intval(trim($values[12], "'")),
                                'day'        => intval(trim($values[13], "'"))
                            );
                        }
                        
                        if ($news_item && isset($news_item['id'])) {
                            $news_data[] = $news_item;
                            
                            $this->log_import_process("خبر {$index} پردازش شد", array(
                                'id' => $news_item['id'],
                                'subject' => isset($news_item['subject']) ? $news_item['subject'] : 'N/A'
                            ));
                        } else {
                            $this->log_import_process("خبر {$index} رد شد - VALUES کافی نیست یا mapping ناموفق", array(
                                'values_count' => count($values),
                                'has_columns' => $has_columns,
                                'columns_raw' => isset($columns_match[1]) ? $columns_match[1] : 'N/A'
                            ));
                        }
                    } else {
                        $this->log_import_process("خبر {$index} رد شد - VALUES یافت نشد", array(
                            'statement' => substr($insert_statement, 0, 200)
                        ));
                    }
                }
                break; // اگر pattern موفق بود، دیگر pattern های بعدی را امتحان نکن
            }
        }
        
        if (!$found_matches) {
            $this->log_import_process('هیچ INSERT statement یافت نشد', array(
                'tried_patterns' => count($patterns),
                'sql_sample' => substr($sql_content, 0, 1000)
            ));
        }
        
        $this->log_import_process('نتیجه استخراج اخبار', array(
            'total_news' => count($news_data)
        ));
        
        return $news_data;
    }
    
    /**
     * استخراج کامنت‌ها از محتوای SQL
     */
    private function extract_comments_from_sql($sql_content) {
        $comments_data = array();
        
        // الگوهای مختلف regex برای یافتن INSERT statements کامنت‌ها
        $patterns = array(
            // Pattern برای فایل اصلی با column names
            '/INSERT\s+INTO\s+kw_news_comments\s*\([^)]+\)\s*VALUES\s*\([^;]+\);/si',
            // Pattern های عمومی
            '/INSERT INTO `?kw_news_comments`?[^;]+;/si',
            '/INSERT INTO `?news_comments`?[^;]+;/si',
            '/INSERT INTO `?comments`?[^;]+;/si',
            '/INSERT\s+INTO\s+`?(?:kw_)?news_comments`?[^;]+;/si'
        );
        
        $this->log_import_process('شروع استخراج کامنت‌ها', array(
            'patterns' => $patterns,
            'sql_length' => strlen($sql_content)
        ));
        
        $found_matches = false;
        
        foreach ($patterns as $pattern_index => $pattern) {
            if (preg_match_all($pattern, $sql_content, $matches)) {
                $found_matches = true;
                $this->log_import_process("Pattern {$pattern_index} موفق - comment statements یافت شد", array(
                    'pattern' => $pattern,
                    'count' => count($matches[0])
                ));
                foreach ($matches[0] as $insert_statement) {
                    // استخراج VALUES
                    if (preg_match('/VALUES\s*\((.*)\);?$/s', $insert_statement, $values_match)) {
                        // بررسی اینکه آیا columns مشخص شده یا نه
                        $has_columns = preg_match('/INSERT\s+INTO\s+\w+\s*\(([^)]+)\)/i', $insert_statement, $columns_match);
                        
                        $values = $this->parse_sql_values($values_match[1]);
                        
                        $comment_item = null;
                        
                        if ($has_columns && isset($columns_match[1])) {
                            // Column-based INSERT
                            $columns = array_map('trim', explode(',', $columns_match[1]));
                            $comment_item = $this->map_columns_to_comment($columns, $values);
                        } elseif (count($values) >= 8) {
                            // Values-only INSERT - روش قدیمی
                            $comment_item = array(
                                'id'           => intval(trim($values[0], "'")),
                                'news_id'      => intval(trim($values[1], "'")),
                                'name'         => trim($values[2], "'"),
                                'message'      => trim($values[3], "'"),
                                'approved'     => intval(trim($values[4], "'")),
                                'comment_date' => trim($values[5], "'"),
                                'comment_time' => trim($values[6], "'"),
                                'email'        => trim($values[7], "'")
                            );
                        }
                        
                        if ($comment_item) {
                            $comments_data[] = $comment_item;
                        }
                    }
                }
                break; // اگر pattern موفق بود، ادامه نده
            }
        }
        
        if (!$found_matches) {
            $this->log_import_process('هیچ comment statement یافت نشد', array(
                'tried_patterns' => count($patterns)
            ));
        }
        
        return $comments_data;
    }
    
    /**
     * نقشه‌برداری columns به values برای اخبار
     */
    private function map_columns_to_news($columns, $values) {
        if (count($columns) !== count($values)) {
            $this->log_import_process('تعداد columns و values برابر نیست', array(
                'columns_count' => count($columns),
                'values_count' => count($values)
            ));
            return null;
        }
        
        $news_item = array();
        $field_mapping = array(
            'id' => 'id',
            'group_id' => 'group_id', 
            'sender_id' => 'sender_id',
            'subject' => 'subject',
            'summary' => 'summary',
            'content' => 'content',
            'image_url' => 'image_url',
            'hits' => 'hits',
            'news_date' => 'news_date',
            'news_time' => 'news_time',
            'year' => 'year',
            'month' => 'month',
            'num_month' => 'num_month',
            'day' => 'day'
        );
        
        for ($i = 0; $i < count($columns); $i++) {
            $column = trim($columns[$i]);
            $value = trim($values[$i], "'\"");
            
            if (isset($field_mapping[$column])) {
                $field = $field_mapping[$column];
                
                // تبدیل نوع داده
                if (in_array($field, array('id', 'group_id', 'hits', 'year', 'num_month', 'day'))) {
                    $news_item[$field] = intval($value);
                } else {
                    $news_item[$field] = $value;
                }
            }
        }
        
        $this->log_import_process('Column mapping انجام شد', array(
            'mapped_fields' => array_keys($news_item),
            'required_fields' => array_keys($field_mapping)
        ));
        
        // بررسی حداقل فیلدهای مورد نیاز
        $required_fields = array('id', 'subject');
        foreach ($required_fields as $field) {
            if (!isset($news_item[$field])) {
                $this->log_import_process('فیلد ضروری وجود ندارد: ' . $field, array(
                    'available_fields' => array_keys($news_item)
                ));
                return null;
            }
        }
        
        return $news_item;
    }
    
    /**
     * نقشه‌برداری columns به values برای کامنت‌ها
     */
    private function map_columns_to_comment($columns, $values) {
        if (count($columns) !== count($values)) {
            return null;
        }
        
        $comment_item = array();
        $field_mapping = array(
            'id' => 'id',
            'news_id' => 'news_id',
            'name' => 'name',
            'message' => 'message',
            'approved' => 'approved',
            'comment_date' => 'comment_date',
            'comment_time' => 'comment_time',
            'email' => 'email'
        );
        
        for ($i = 0; $i < count($columns); $i++) {
            $column = trim($columns[$i]);
            $value = trim($values[$i], "'\"");
            
            if (isset($field_mapping[$column])) {
                $field = $field_mapping[$column];
                
                // تبدیل نوع داده
                if (in_array($field, array('id', 'news_id', 'approved'))) {
                    $comment_item[$field] = intval($value);
                } else {
                    $comment_item[$field] = $value;
                }
            }
        }
        
        // بررسی حداقل فیلدهای مورد نیاز
        if (!isset($comment_item['id']) || !isset($comment_item['news_id'])) {
            return null;
        }
        
        return $comment_item;
    }
    
    /**
     * پارس کردن مقادیر SQL VALUES
     */
    private function parse_sql_values($values_string) {
        $values = array();
        $current_value = '';
        $in_quotes = false;
        $quote_char = '';
        $paren_count = 0;
        $bracket_count = 0;
        
        // Pre-process: تمیز کردن ابتدا و انتهای string
        $values_string = trim($values_string);
        
        $this->log_import_process('شروع پارس VALUES', array(
            'input_length' => strlen($values_string),
            'input_preview' => substr($values_string, 0, 300)
        ));
        
        for ($i = 0; $i < strlen($values_string); $i++) {
            $char = $values_string[$i];
            
            if (!$in_quotes && $char === '(') {
                $paren_count++;
                $current_value .= $char;
            } elseif (!$in_quotes && $char === ')') {
                $paren_count--;
                $current_value .= $char;
            } elseif (!$in_quotes && $char === '[') {
                $bracket_count++;
                $current_value .= $char;
            } elseif (!$in_quotes && $char === ']') {
                $bracket_count--;
                $current_value .= $char;
            } elseif (!$in_quotes && ($char === "'" || $char === '"')) {
                $in_quotes = true;
                $quote_char = $char;
                $current_value .= $char;
            } elseif ($in_quotes && $char === $quote_char) {
                // بررسی اسکیپ شدن
                if ($i < strlen($values_string) - 1 && $values_string[$i + 1] === $quote_char) {
                    $current_value .= $char . $char;
                    $i++; // رد کردن کاراکتر بعدی
                } elseif ($i > 0 && $values_string[$i - 1] === '\\') {
                    // اسکیپ شده با backslash
                    $current_value .= $char;
                } else {
                    $in_quotes = false;
                    $quote_char = '';
                    $current_value .= $char;
                }
            } elseif (!$in_quotes && $char === ',' && $paren_count === 0 && $bracket_count === 0) {
                // پایان یک value
                $values[] = trim($current_value);
                $current_value = '';
            } else {
                $current_value .= $char;
            }
        }
        
        // اضافه کردن آخرین مقدار
        if (trim($current_value) !== '') {
            $values[] = trim($current_value);
        }
        
        // پاک کردن quote های اضافی از ابتدا و انتهای هر value
        $cleaned_values = array();
        foreach ($values as $value) {
            $value = trim($value);
            // اگر با quote شروع و تمام شود، حذف کن
            if ((substr($value, 0, 1) === "'" && substr($value, -1) === "'") ||
                (substr($value, 0, 1) === '"' && substr($value, -1) === '"')) {
                $value = substr($value, 1, -1);
            }
            $cleaned_values[] = $value;
        }
        
        $this->log_import_process('نتیجه پارس VALUES', array(
            'parsed_count' => count($cleaned_values),
            'first_5' => array_slice($cleaned_values, 0, 5)
        ));
        
        return $cleaned_values;
    }
    
    /**
     * پردازش تصاویر اخبار و تنظیم Featured Image
     */
    private function process_news_images($post_id, $content, $thumbnail_filename = '') {
        $processed_images = 0;
        $featured_image_set = false;
        
        // ابتدا سعی می‌کنیم تصویر thumbnail را به عنوان Featured Image تنظیم کنیم
        if (!empty($thumbnail_filename)) {
            $upload_dir = wp_upload_dir();
            $thumbnail_path = $upload_dir['basedir'] . '/news-images/' . $thumbnail_filename;
            
            if (file_exists($thumbnail_path)) {
                $featured_attachment_id = $this->import_news_image($post_id, 'wp-content/uploads/news-images/' . $thumbnail_filename, true);
                if ($featured_attachment_id) {
                    set_post_thumbnail($post_id, $featured_attachment_id);
                    $featured_image_set = true;
                    $processed_images++;
                    
                    $this->log_import_process('تصویر شاخص تنظیم شد', array(
                        'post_id' => $post_id,
                        'thumbnail' => $thumbnail_filename,
                        'attachment_id' => $featured_attachment_id
                    ));
                }
            } else {
                $this->log_import_process('فایل تصویر شاخص یافت نشد', array(
                    'post_id' => $post_id,
                    'thumbnail' => $thumbnail_filename,
                    'expected_path' => $thumbnail_path
                ));
            }
        }
        
        // استخراج تصاویر از محتوا
        $pattern = '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i';
        
        if (preg_match_all($pattern, $content, $matches)) {
            $first_content_image_processed = false;
            
            foreach ($matches[1] as $src) {
                if (strpos($src, 'wp-content/uploads/news-images/') !== false) {
                    // تصویر از پوشه news-images
                    $attachment_id = $this->import_news_image($post_id, $src, false);
                    if ($attachment_id) {
                        $processed_images++;
                        
                        // اگر هنوز Featured Image تنظیم نشده، اولین تصویر محتوا را استفاده کن
                        if (!$featured_image_set && !$first_content_image_processed) {
                            set_post_thumbnail($post_id, $attachment_id);
                            $featured_image_set = true;
                            $first_content_image_processed = true;
                            
                            $this->log_import_process('اولین تصویر محتوا به عنوان تصویر شاخص تنظیم شد', array(
                                'post_id' => $post_id,
                                'image_src' => $src,
                                'attachment_id' => $attachment_id
                            ));
                        }
                    }
                }
            }
        }
        
        $this->log_import_process('پردازش تصاویر تکمیل شد', array(
            'post_id' => $post_id,
            'processed_images' => $processed_images,
            'featured_image_set' => $featured_image_set,
            'thumbnail_file' => $thumbnail_filename
        ));
        
        return $processed_images;
    }
    
    /**
     * ورود تصویر از پوشه news-images و ایجاد attachment
     */
    private function import_news_image($post_id, $image_src, $is_featured = false) {
        // استخراج نام فایل
        $filename = basename($image_src);
        $upload_dir = wp_upload_dir();
        
        // مسیرهای مختلف برای جستجو
        $possible_paths = array(
            // مسیر جدید در news-images
            $upload_dir['basedir'] . '/news-images/' . $filename,
            // مسیر قدیمی در extracted_images
            UM_PLUGIN_DIR . 'extracted_images/' . $filename,
            // مسیر مستقیم در upload directory
            $upload_dir['basedir'] . '/' . $filename
        );
        
        $source_path = null;
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                $source_path = $path;
                break;
            }
        }
        
        if (!$source_path) {
            $this->log_import_process('فایل تصویر یافت نشد', array(
                'filename' => $filename,
                'searched_paths' => $possible_paths,
                'is_featured' => $is_featured
            ));
            return false;
        }
        
        // بررسی اینکه آیا attachment از قبل وجود دارد
        $existing_attachment = $this->find_attachment_by_filename($filename, $post_id);
        if ($existing_attachment) {
            $this->log_import_process('Attachment موجود استفاده شد', array(
                'filename' => $filename,
                'attachment_id' => $existing_attachment,
                'is_featured' => $is_featured
            ));
            return $existing_attachment;
        }
        
        // کپی فایل به پوشه uploads (اگر قبلاً کپی نشده)
        $destination_path = $upload_dir['path'] . '/' . $filename;
        
        if (!file_exists($destination_path)) {
            if (!copy($source_path, $destination_path)) {
                $this->log_import_process('خطا در کپی فایل', array(
                    'source' => $source_path,
                    'destination' => $destination_path,
                    'is_featured' => $is_featured
                ));
                return false;
            }
        }
        
        // ایجاد attachment
        $file_type = wp_check_filetype($filename);
        $attachment = array(
            'post_mime_type' => $file_type['type'],
            'post_title'     => $is_featured ? 'تصویر شاخص - ' . pathinfo($filename, PATHINFO_FILENAME) : pathinfo($filename, PATHINFO_FILENAME),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        
        $attachment_id = wp_insert_attachment($attachment, $destination_path, $post_id);
        
        if ($attachment_id) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $destination_path);
            wp_update_attachment_metadata($attachment_id, $attachment_data);
            
            // نشان‌گذاری به عنوان تصویر وارد شده
            update_post_meta($attachment_id, '_um_imported_image', true);
            if ($is_featured) {
                update_post_meta($attachment_id, '_um_featured_image', true);
            }
            
            $this->log_import_process('Attachment ایجاد شد', array(
                'filename' => $filename,
                'attachment_id' => $attachment_id,
                'is_featured' => $is_featured,
                'post_id' => $post_id
            ));
            
            return $attachment_id;
        }
        
        $this->log_import_process('خطا در ایجاد attachment', array(
            'filename' => $filename,
            'is_featured' => $is_featured,
            'post_id' => $post_id
        ));
        
        return false;
    }
    
    /**
     * یافتن attachment موجود بر اساس نام فایل
     */
    private function find_attachment_by_filename($filename, $post_id = null) {
        global $wpdb;
        
        $query = "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_title = %s";
        $params = array(pathinfo($filename, PATHINFO_FILENAME));
        
        if ($post_id) {
            $query .= " AND post_parent = %d";
            $params[] = $post_id;
        }
        
        $attachment_id = $wpdb->get_var($wpdb->prepare($query, $params));
        
        return $attachment_id ? intval($attachment_id) : false;
    }
    
    /**
     * تبدیل تاریخ فارسی به میلادی
     */
    private function convert_persian_date($persian_date, $time) {
        // فعلاً همان تاریخ شمسی را برمی‌گردانیم
        return current_time('mysql');
    }
    
    /**
     * حذف اطلاعات وارد شده
     */
    private function delete_imported_news_data() {
        global $wpdb;
        
        try {
            // یافتن پست‌های وارد شده
            $imported_posts = get_posts(array(
                'post_type'      => 'any',
                'posts_per_page' => -1,
                'meta_key'       => '_um_imported_news',
                'meta_value'     => true,
                'post_status'    => 'any'
            ));
            
            $deleted_posts = 0;
            $deleted_comments = 0;
            $deleted_images = 0;
            
            foreach ($imported_posts as $post) {
                // حذف کامنت‌های وارد شده
                $comments = get_comments(array(
                    'post_id'    => $post->ID,
                    'meta_key'   => '_um_imported_comment',
                    'meta_value' => true
                ));
                
                foreach ($comments as $comment) {
                    wp_delete_comment($comment->comment_ID, true);
                    $deleted_comments++;
                }
                
                // حذف تصاویر وارد شده
                $attachments = get_posts(array(
                    'post_type'      => 'attachment',
                    'posts_per_page' => -1,
                    'post_parent'    => $post->ID,
                    'meta_key'       => '_um_imported_image',
                    'meta_value'     => true
                ));
                
                foreach ($attachments as $attachment) {
                    wp_delete_attachment($attachment->ID, true);
                    $deleted_images++;
                }
                
                // حذف پست
                wp_delete_post($post->ID, true);
                $deleted_posts++;
            }
            
            // حذف گزینه‌های مربوطه
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_um_news_id_map_%'");
            delete_option('_um_import_stats');
            
            return array(
                'success' => true,
                'message' => sprintf(
                    '%d پست، %d کامنت و %d تصویر حذف شد.',
                    $deleted_posts,
                    $deleted_comments,
                    $deleted_images
                )
            );
            
        } catch (Exception $e) {
            return array('success' => false, 'message' => 'خطا در حذف: ' . $e->getMessage());
        }
    }
    
    /**
     * دریافت وضعیت ورود اطلاعات
     */
    private function get_import_status() {
        $stats = get_option('_um_import_stats', array());
        
        if (empty($stats)) {
            return array(
                'has_data' => false,
                'message'  => 'هیچ اطلاعاتی وارد نشده است.'
            );
        }
        
        return array(
            'has_data'       => true,
            'news_count'     => $stats['news_count'],
            'comments_count' => $stats['comments_count'],
            'images_count'   => $stats['images_count'],
            'import_date'    => $stats['import_date']
        );
    }
    
    /**
     * لاگ گیری فرآیند import
     */
    private function log_import_process($message, $data = array()) {
        $log_entry = array(
            'timestamp' => current_time('mysql'),
            'message' => $message,
            'data' => $data
        );
        
        // لاگ در فایل
        $log_file = WP_CONTENT_DIR . '/um-import-log.txt';
        $log_line = date('Y-m-d H:i:s') . " - " . $message . "\n";
        
        if (!empty($data)) {
            $log_line .= "Data: " . print_r($data, true) . "\n";
        }
        
        $log_line .= str_repeat('-', 50) . "\n";
        
        file_put_contents($log_file, $log_line, FILE_APPEND | LOCK_EX);
        
        // لاگ در دیتابیس برای نمایش در مدیریت
        $logs = get_option('_um_import_logs', array());
        $logs[] = $log_entry;
        
        // نگهداری فقط 50 لاگ آخر
        if (count($logs) > 50) {
            $logs = array_slice($logs, -50);
        }
        
        update_option('_um_import_logs', $logs);
        
        // لاگ در error_log PHP اگر WP_DEBUG فعال باشد
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log("UM Import: " . $message . " - " . print_r($data, true));
        }
    }
    
    /**
     * فعال‌سازی افزونه
     */
    public function on_activation() {
        // بررسی نسخه PHP
        if (version_compare(PHP_VERSION, '7.0', '<')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die('این افزونه نیاز به PHP نسخه 7.0 یا بالاتر دارد.');
        }
        
        // بررسی نسخه وردپرس
        if (version_compare(get_bloginfo('version'), '5.0', '<')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die('این افزونه نیاز به وردپرس نسخه 5.0 یا بالاتر دارد.');
        }
        
        // ثبت پست‌تایپ‌ها
        $this->register_post_types();
        
        // بروزرسانی rewrite rules
        flush_rewrite_rules();
        
        // ایجاد پوشه‌های مورد نیاز
        $upload_dir = wp_upload_dir();
        $university_dir = $upload_dir['basedir'] . '/university-news';
        
        if (!file_exists($university_dir)) {
            wp_mkdir_p($university_dir);
        }
        
        // ثبت زمان نصب
        if (!get_option('um_installed_time')) {
            add_option('um_installed_time', current_time('mysql'));
        }
        
        // تنظیم گزینه‌های پیش‌فرض
        if (!get_option('um_plugin_version')) {
            add_option('um_plugin_version', UM_VERSION);
        }
    }

    /**
     * متاباکس جزئیات سمینار
     */
    public function seminar_details_meta_box($post) {
        wp_nonce_field('um_save_seminar_meta', 'um_seminar_meta_nonce');

        $teacher = get_post_meta($post->ID, '_seminar_teacher', true);
        $time = get_post_meta($post->ID, '_seminar_time', true);
        $button_text = get_post_meta($post->ID, '_seminar_button_text', true);
        $button_link = get_post_meta($post->ID, '_seminar_button_link', true);

        echo '<p><label for="seminar_teacher">' . __('مدرس', 'university-management') . '</label>';
        echo '<input type="text" id="seminar_teacher" name="seminar_teacher" value="' . esc_attr($teacher) . '" class="widefat"></p>';

        echo '<p><label for="seminar_time">' . __('زمان برگزاری', 'university-management') . '</label>';
        echo '<input type="text" id="seminar_time" name="seminar_time" value="' . esc_attr($time) . '" class="widefat" placeholder="مثال: ۱۴۰۳/۰۵/۲۰"></p>';

        echo '<p><label for="seminar_button_text">' . __('عنوان دکمه', 'university-management') . '</label>';
        echo '<input type="text" id="seminar_button_text" name="seminar_button_text" value="' . esc_attr($button_text) . '" class="widefat" placeholder="مثال: شروع یادگیری"></p>';

        echo '<p><label for="seminar_button_link">' . __('لینک دکمه', 'university-management') . '</label>';
        echo '<input type="url" id="seminar_button_link" name="seminar_button_link" value="' . esc_url($button_link) . '" class="widefat" placeholder="https://example.com"></p>';
    }

    /**
     * ذخیره متاباکس جزئیات سمینار
     */
    public function save_seminar_meta($post_id) {
        if (!isset($_POST['um_seminar_meta_nonce']) || !wp_verify_nonce($_POST['um_seminar_meta_nonce'], 'um_save_seminar_meta')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['seminar_teacher'])) {
            update_post_meta($post_id, '_seminar_teacher', sanitize_text_field($_POST['seminar_teacher']));
        }

        if (isset($_POST['seminar_time'])) {
            update_post_meta($post_id, '_seminar_time', sanitize_text_field($_POST['seminar_time']));
        }
        
        if (isset($_POST['seminar_button_text'])) {
            update_post_meta($post_id, '_seminar_button_text', sanitize_text_field($_POST['seminar_button_text']));
        }

        if (isset($_POST['seminar_button_link'])) {
            update_post_meta($post_id, '_seminar_button_link', esc_url_raw($_POST['seminar_button_link']));
        }
    }
}

// راه‌اندازی افزونه
function university_management_init() {
    return University_Management::get_instance();
}

// نمونه‌سازی افزونه
university_management_init();

// هوک فعال‌سازی
register_activation_hook(__FILE__, 'university_management_activate');

// هوک غیرفعال‌سازی
register_deactivation_hook(__FILE__, 'university_management_deactivate');

/**
 * فعال‌سازی افزونه
 */
function university_management_activate() {
    // فراخوانی متد activation کلاس اصلی
    $plugin = University_Management::get_instance();
    $plugin->on_activation();
}

/**
 * غیرفعال‌سازی افزونه
 */
function university_management_deactivate() {
    // پاکسازی دیتابیس یا سایر عملیات مورد نیاز هنگام غیرفعال‌سازی
    flush_rewrite_rules();
}

function kwprc_enqueue_class_timer_scripts() {
    // اضافه کردن moment.js و moment-jalaali
    wp_enqueue_script('moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', [], '2.29.1', true);
    wp_enqueue_script('moment-jalaali', 'https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', ['moment-js'], '0.9.2', true);

    // اضافه کردن استایل و اسکریپت اختصاصی
    wp_enqueue_style('kwprc-class-timer-style', plugin_dir_url(__FILE__) . 'assets/css/class-timer-widget.css', [], '1.0.0');
    wp_enqueue_script('kwprc-class-timer-script', plugin_dir_url(__FILE__) . 'assets/js/class-timer-widget.js', ['moment-js', 'moment-jalaali'], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'kwprc_enqueue_class_timer_scripts'); 

function kwprc_localize_class_timer_script() {
    wp_localize_script('kwprc-class-timer-script', 'kwprcClassTimerData', [
        'pluginUrl' => plugin_dir_url(__FILE__),
    ]);
}
add_action('wp_enqueue_scripts', 'kwprc_localize_class_timer_script', 20);