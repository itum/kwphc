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
        add_action('save_post_um_employment_exams', array($this, 'save_employment_exam_meta'));
        
        // اضافه کردن اکشن‌های AJAX
        add_action('wp_ajax_um_get_videos_by_category', array($this, 'ajax_get_videos_by_category'));
        add_action('wp_ajax_nopriv_um_get_videos_by_category', array($this, 'ajax_get_videos_by_category'));
        
        // اکشن‌های AJAX برای پایگاه داده
        add_action('wp_ajax_um_import_database', array($this, 'ajax_import_database'));
        add_action('wp_ajax_um_delete_imported_data', array($this, 'ajax_delete_imported_data'));
        add_action('wp_ajax_um_get_import_status', array($this, 'ajax_get_import_status'));
        add_action('wp_ajax_um_get_import_logs', array($this, 'ajax_get_import_logs'));
        add_action('wp_ajax_um_clear_import_logs', array($this, 'ajax_clear_import_logs'));
        
        // اکشن‌های AJAX برای تنظیمات عمومی
        add_action('wp_ajax_um_authenticate_user', array($this, 'ajax_authenticate_user'));
        add_action('wp_ajax_um_logout_user', array($this, 'ajax_logout_user'));
        add_action('wp_ajax_um_get_seminars', array($this, 'ajax_get_seminars'));
        add_action('wp_ajax_um_save_api_settings', array($this, 'ajax_save_api_settings'));
        add_action('wp_ajax_um_test_api', array($this, 'ajax_test_api'));
        add_action('wp_ajax_um_direct_api_test', array($this, 'ajax_direct_api_test'));
        add_action('wp_ajax_um_import_seminars', array($this, 'ajax_import_seminars'));
        add_action('wp_ajax_um_get_imported_seminars', array($this, 'ajax_get_imported_seminars'));
        add_action('wp_ajax_um_test_image_download', array($this, 'ajax_test_image_download'));
        
        // اکشن‌های AJAX برای آزمون‌ها
        add_action('wp_ajax_um_save_azmoon_api_settings', array($this, 'ajax_save_azmoon_api_settings'));
        add_action('wp_ajax_um_get_azmoons', array($this, 'ajax_get_azmoons'));
        add_action('wp_ajax_um_get_azmoon', array($this, 'ajax_get_azmoon'));
        add_action('wp_ajax_um_create_azmoon', array($this, 'ajax_create_azmoon'));
        add_action('wp_ajax_um_update_azmoon', array($this, 'ajax_update_azmoon'));
        add_action('wp_ajax_um_delete_azmoon', array($this, 'ajax_delete_azmoon'));
        add_action('wp_ajax_um_get_azmoons_widget', array($this, 'ajax_get_azmoons_widget'));
        add_action('wp_ajax_um_load_and_insert_azmoons_from_api', array($this, 'ajax_load_and_insert_azmoons_from_api'));
        
        // ثبت شورت‌کدهای داینامیک
        add_action('init', array($this, 'register_shortcodes'));
        

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
            __('تنظیمات عمومی', 'university-management'),
            __('تنظیمات عمومی', 'university-management'),
            'manage_options',
            'university-general-settings',
            array($this, 'general_settings_admin_page')
        );
        
        add_submenu_page(
            'university-management',
            __('آزمون‌های استخدامی', 'university-management'),
            __('آزمون‌های استخدامی', 'university-management'),
            'manage_options',
            'university-azmoon',
            array($this, 'azmoon_admin_page')
        );
        
        add_submenu_page(
            'university-management',
            __('مدیریت آزمون‌های استخدامی', 'university-management'),
            __('مدیریت آزمون‌های استخدامی', 'university-management'),
            'manage_options',
            'university-employment-exams',
            array($this, 'employment_exams_admin_page')
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
     * صفحه تنظیمات عمومی
     */
    public function general_settings_admin_page() {
        $settings_file = UM_PLUGIN_DIR . 'admin/general-settings-page.php';
        if (file_exists($settings_file)) {
            require_once $settings_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل general-settings-page.php یافت نشد.</p></div>';
        }
    }
    
    /**
     * صفحه مدیریت آزمون‌های استخدامی
     */
    public function azmoon_admin_page() {
        $azmoon_file = UM_PLUGIN_DIR . 'admin/azmoon-page.php';
        if (file_exists($azmoon_file)) {
            require_once $azmoon_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل azmoon-page.php یافت نشد.</p></div>';
        }
    }

    /**
     * صفحه مدیریت آزمون‌های استخدامی (پست تایپ)
     */
    public function employment_exams_admin_page() {
        $employment_file = UM_PLUGIN_DIR . 'admin/employment-exams-page.php';
        if (file_exists($employment_file)) {
            require_once $employment_file;
        } else {
            echo '<div class="wrap"><h1>خطا</h1><p>فایل employment-exams-page.php یافت نشد.</p></div>';
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
        add_meta_box(
            'um_employment_exam_details',
            __('جزئیات آزمون استخدامی', 'university-management'),
            array($this, 'employment_exam_details_meta_box'),
            'um_employment_exams',
            'normal',
            'high'
        );
        add_meta_box(
            'um_video_custom_fields',
            __('زمینه های دلخواه ویدیو', 'university-management'),
            array($this, 'video_custom_fields_meta_box'),
            'um_videos',
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
     * نمایش متاباکس زمینه‌های دلخواه ویدیو
     */
    public function video_custom_fields_meta_box($post) {
        // دریافت اطلاعات ویدیو
        $video_title = get_the_title($post->ID);
        $video_link = get_post_meta($post->ID, '_um_video_link', true);
        $video_content = $post->post_content;
        ?>
        <div class="um-custom-fields-meta-box">
            <p>
                <strong><?php _e('عنوان ویدیو:', 'university-management'); ?></strong><br>
                <input type="text" value="<?php echo esc_attr($video_title); ?>" readonly style="width: 100%; background-color: #f0f0f0;">
            </p>
            <p>
                <strong><?php _e('فایل ویدیو (لینک):', 'university-management'); ?></strong><br>
                <input type="text" value="<?php echo esc_url($video_link); ?>" readonly style="width: 100%; background-color: #f0f0f0;">
            </p>
            <p>
                <strong><?php _e('توضیحات:', 'university-management'); ?></strong><br>
                <textarea readonly style="width: 100%; height: 150px; background-color: #f0f0f0;"><?php echo esc_textarea($video_content); ?></textarea>
            </p>
        </div>
        <?php
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
        
        // استایل‌های مدیریت (فقط اگر فایل وجود داشته باشد)
        $admin_css = UM_PLUGIN_DIR . 'assets/css/admin.css';
        if (file_exists($admin_css)) {
            wp_enqueue_style(
                'university-management-admin-style',
                UM_PLUGIN_URL . 'assets/css/admin.css',
                array(),
                UM_VERSION
            );
        }
        
        // جاوااسکریپت‌های مدیریت (فقط اگر فایل وجود داشته باشد)
        $admin_js = UM_PLUGIN_DIR . 'assets/js/admin.js';
        if (file_exists($admin_js)) {
            wp_enqueue_script(
                'university-management-admin-script',
                UM_PLUGIN_URL . 'assets/js/admin.js',
                array('jquery'),
                UM_VERSION,
                true
            );
        }
        
        // منابع خاص صفحه تنظیمات عمومی
        if (strpos($hook, 'university-general-settings') !== false) {
            $settings_css = UM_PLUGIN_DIR . 'assets/css/general-settings.css';
            if (file_exists($settings_css)) {
                wp_enqueue_style(
                    'university-management-general-settings-style',
                    UM_PLUGIN_URL . 'assets/css/general-settings.css',
                    array(),
                    UM_VERSION
                );
            }
            
            $settings_js = UM_PLUGIN_DIR . 'assets/js/general-settings.js';
            if (file_exists($settings_js)) {
                wp_enqueue_script(
                    'university-management-general-settings-script',
                    UM_PLUGIN_URL . 'assets/js/general-settings.js',
                    array('jquery'),
                    UM_VERSION,
                    true
                );
            }
            
            // انتقال متغیرها به جاوااسکریپت (فقط اگر اسکریپت بارگذاری شده باشد)
            if (file_exists($settings_js)) {
                wp_localize_script(
                    'university-management-general-settings-script',
                    'umGeneralSettings',
                    array(
                        'ajaxUrl' => admin_url('admin-ajax.php'),
                        'authNonce' => wp_create_nonce('um_auth_nonce'),
                        'logoutNonce' => wp_create_nonce('um_logout_nonce'),
                        'seminarsNonce' => wp_create_nonce('um_seminars_nonce'),
                        'apiSettingsNonce' => wp_create_nonce('um_api_settings_nonce'),
                        'tokenExpires' => get_option('_um_token_expires', 0),
                        'isAuthenticated' => (get_option('_um_auth_status') === 'authenticated'),
                        'messages' => array(
                            'loginSuccess' => __('ورود موفقیت‌آمیز بود', 'university-management'),
                            'logoutSuccess' => __('با موفقیت خارج شدید', 'university-management'),
                            'settingsSaved' => __('تنظیمات با موفقیت ذخیره شد', 'university-management'),
                            'seminarsLoaded' => __('سمینارها با موفقیت بارگذاری شدند', 'university-management'),
                            'connectionError' => __('خطا در اتصال به سرور', 'university-management'),
                            'sessionExpired' => __('جلسه شما منقضی شده است', 'university-management'),
                        )
                    )
                );
            }
        }
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

        // ثبت پست تایپ آزمون‌های استخدامی
        $args = array(
            'labels' => array(
                'name'               => __('آزمون‌های استخدامی', 'university-management'),
                'singular_name'      => __('آزمون استخدامی', 'university-management'),
                'add_new'            => __('افزودن آزمون جدید', 'university-management'),
                'add_new_item'       => __('افزودن آزمون استخدامی جدید', 'university-management'),
                'edit_item'          => __('ویرایش آزمون استخدامی', 'university-management'),
                'new_item'           => __('آزمون استخدامی جدید', 'university-management'),
                'view_item'          => __('مشاهده آزمون استخدامی', 'university-management'),
                'search_items'       => __('جستجوی آزمون‌های استخدامی', 'university-management'),
                'not_found'          => __('آزمون استخدامی یافت نشد', 'university-management'),
                'not_found_in_trash' => __('آزمون استخدامی در سطل زباله یافت نشد', 'university-management'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => 'university-management',
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon'           => 'dashicons-clipboard',
            'show_in_rest'        => true,
        );
        register_post_type('um_employment_exams', $args);

        // Register custom meta fields for the post type
        register_meta('post', 'azmoon_id', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'company', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'city', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'start_date', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'end_date', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'exam_date', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'poster', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'agahi_file', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'link', array('show_in_rest' => true, 'single' => true, 'type' => 'string'));
        register_meta('post', 'is_active', array('show_in_rest' => true, 'single' => true, 'type' => 'boolean'));
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
                // تبدیل تاریخ شمسی به میلادی برای تنظیم تاریخ انتشار
                $post_date = $this->convert_shamsi_to_gregorian($news['news_date'], $news['news_time']);
                
                // لاگ تبدیل تاریخ برای دیباگ
                $this->log_import_process('تبدیل تاریخ', array(
                    'news_id' => $news['id'],
                    'original_date' => $news['news_date'],
                    'original_time' => $news['news_time'],
                    'converted_date' => $post_date,
                    'subject' => $news['subject']
                ));
                
                // ایجاد پست جدید
                $post_data = array(
                    'post_title'    => sanitize_text_field($news['subject']),
                    'post_content'  => wp_kses_post($news['content']),
                    'post_excerpt'  => wp_kses_post($news['summary']),
                    'post_status'   => 'publish',
                    'post_type'     => 'post',
                    'post_category' => array($news_category),
                    'post_date'     => $post_date,
                    'post_date_gmt' => get_gmt_from_date($post_date),
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
                    // تبدیل تاریخ شمسی به میلادی برای کامنت
                    $comment_date = isset($comment['comment_date']) ? $comment['comment_date'] : $this->convert_shamsi_to_gregorian($comment['shamsi_date'], $comment['shamsi_time']);
                    
                    $comment_data = array(
                        'comment_post_ID'      => $post_id,
                        'comment_author'       => sanitize_text_field($comment['name']),
                        'comment_author_email' => sanitize_email($comment['email']),
                        'comment_content'      => sanitize_textarea_field($comment['message']),
                        'comment_approved'     => $comment['approved'] ? 1 : 0,
                        'comment_date'         => $comment_date,
                        'comment_date_gmt'     => get_gmt_from_date($comment_date),
                        'comment_meta'         => array(
                            '_um_imported_comment' => true,
                            '_um_original_id'      => $comment['id'],
                            '_um_shamsi_date'      => $comment['shamsi_date'],
                            '_um_shamsi_time'      => $comment['shamsi_time']
                        )
                    );
                    
                    $this->log_import_process('اطلاعات کامنت برای ورود', $comment_data);
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
            'email' => 'email',
            'message' => 'message',
            'approved' => 'approved',
            'comment_date' => 'comment_date',
            'shamsi_date' => 'shamsi_date',
            'shamsi_time' => 'shamsi_time'
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
        $args = array(pathinfo($filename, PATHINFO_FILENAME));

        if ($post_id) {
            $query .= " AND post_parent = %d";
            $args[] = $post_id;
        }

        return $wpdb->get_var($wpdb->prepare($query, $args));
    }
    
    /**
     * Converts Persian date to Gregorian date.
     * This function is self-contained and does not rely on external libraries.
     */
    private function jalali_to_gregorian_manual($jy, $jm, $jd) {
        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

        $jy += 1595;
        $days = -355668 + (365 * $jy) + (((int)($jy / 33)) * 8) + ((int)((($jy % 33) + 3) / 4)) + $jd;
        for ($i = 0; $i < $jm - 1; $i++) {
            $days += $j_days_in_month[$i];
        }

        $gy = 400 * ((int)($days / 146097));
        $days %= 146097;
        if ($days > 36524) {
            $gy += 100 * ((int)(--$days / 36524));
            $days %= 36524;
            if ($days >= 365) $days++;
        }
        $gy += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $gy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $gd = $days + 1;
        foreach ($g_days_in_month as $gm => $days_in_month) {
            if (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)) {
                if ($gm == 1) $days_in_month++;
            }
            if ($gd <= $days_in_month) break;
            $gd -= $days_in_month;
        }
        return array($gy, $gm + 1, $gd);
    }

    private function convert_persian_date($gregorian_date, $time) {
        // The date is already Gregorian from the Python script.
        // We just need to format the time part correctly.
        $time_str = '00:00:00';
        if (!empty($time)) {
             $time_parts = explode(':', str_replace(array(' AM', ' PM'), '', $time));
             if(count($time_parts) >= 3) {
                list($hour, $minute, $second) = array_map('intval', $time_parts);

                if (strpos($time, 'PM') !== false && $hour < 12) {
                    $hour += 12;
                }
                if (strpos($time, 'AM') !== false && $hour == 12) {
                    $hour = 0;
                }
                $time_str = sprintf('%02d:%02d:%02d', $hour, $minute, $second);
             }
        }
        
        return $gregorian_date . ' ' . $time_str;
    }

    /**
     * حذف اطلاعات وارد شده
     */
    private function delete_imported_news_data() {
        global $wpdb;
        $this->log_import_process('شروع فرآیند حذف اطلاعات وارد شده');
        
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
     * نمایش متاباکس جزئیات آزمون استخدامی
     */
    public function employment_exam_details_meta_box($post) {
        wp_nonce_field('um_save_employment_exam', 'um_employment_exam_nonce');

        $exam_date = get_post_meta($post->ID, '_exam_date', true);
        $exam_time = get_post_meta($post->ID, '_exam_time', true);
        $exam_duration = get_post_meta($post->ID, '_exam_duration', true);
        $exam_position = get_post_meta($post->ID, '_exam_position', true);
        $exam_department = get_post_meta($post->ID, '_exam_department', true);
        $exam_location = get_post_meta($post->ID, '_exam_location', true);
        $exam_requirements = get_post_meta($post->ID, '_exam_requirements', true);
        $exam_application_deadline = get_post_meta($post->ID, '_exam_application_deadline', true);
        $exam_status = get_post_meta($post->ID, '_exam_status', true);

        echo '<table class="form-table">';
        
        echo '<tr><th><label for="exam_date">' . __('تاریخ آزمون', 'university-management') . '</label></th>';
        echo '<td><input type="date" id="exam_date" name="exam_date" value="' . esc_attr($exam_date) . '" class="regular-text"></td></tr>';

        echo '<tr><th><label for="exam_time">' . __('زمان آزمون', 'university-management') . '</label></th>';
        echo '<td><input type="time" id="exam_time" name="exam_time" value="' . esc_attr($exam_time) . '" class="regular-text"></td></tr>';

        echo '<tr><th><label for="exam_duration">' . __('مدت زمان آزمون (دقیقه)', 'university-management') . '</label></th>';
        echo '<td><input type="number" id="exam_duration" name="exam_duration" value="' . esc_attr($exam_duration) . '" class="regular-text" min="30" step="15"></td></tr>';

        echo '<tr><th><label for="exam_position">' . __('موقعیت شغلی', 'university-management') . '</label></th>';
        echo '<td><input type="text" id="exam_position" name="exam_position" value="' . esc_attr($exam_position) . '" class="regular-text" placeholder="مثال: مهندس نرم‌افزار"></td></tr>';

        echo '<tr><th><label for="exam_department">' . __('دپارتمان', 'university-management') . '</label></th>';
        echo '<td><input type="text" id="exam_department" name="exam_department" value="' . esc_attr($exam_department) . '" class="regular-text" placeholder="مثال: فناوری اطلاعات"></td></tr>';

        echo '<tr><th><label for="exam_location">' . __('محل برگزاری', 'university-management') . '</label></th>';
        echo '<td><input type="text" id="exam_location" name="exam_location" value="' . esc_attr($exam_location) . '" class="regular-text" placeholder="مثال: سالن اجتماعات دانشگاه"></td></tr>';

        echo '<tr><th><label for="exam_application_deadline">' . __('مهلت ثبت‌نام', 'university-management') . '</label></th>';
        echo '<td><input type="date" id="exam_application_deadline" name="exam_application_deadline" value="' . esc_attr($exam_application_deadline) . '" class="regular-text"></td></tr>';

        echo '<tr><th><label for="exam_status">' . __('وضعیت آزمون', 'university-management') . '</label></th>';
        echo '<td><select id="exam_status" name="exam_status" class="regular-text">';
        echo '<option value="upcoming"' . selected($exam_status, 'upcoming', false) . '>' . __('در انتظار برگزاری', 'university-management') . '</option>';
        echo '<option value="registration"' . selected($exam_status, 'registration', false) . '>' . __('در حال ثبت‌نام', 'university-management') . '</option>';
        echo '<option value="closed"' . selected($exam_status, 'closed', false) . '>' . __('بسته', 'university-management') . '</option>';
        echo '<option value="completed"' . selected($exam_status, 'completed', false) . '>' . __('برگزار شده', 'university-management') . '</option>';
        echo '</select></td></tr>';

        echo '<tr><th><label for="exam_requirements">' . __('شرایط و الزامات', 'university-management') . '</label></th>';
        echo '<td><textarea id="exam_requirements" name="exam_requirements" rows="5" class="large-text" placeholder="شرایط و الزامات مورد نیاز برای شرکت در آزمون...">' . esc_textarea($exam_requirements) . '</textarea></td></tr>';

        echo '</table>';
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

    /**
     * ذخیره متادیتای آزمون‌های استخدامی
     */
    public function save_employment_exam_meta($post_id) {
        // بررسی امنیت
        if (!isset($_POST['um_employment_exam_nonce']) || !wp_verify_nonce($_POST['um_employment_exam_nonce'], 'um_save_employment_exam')) {
            return;
        }

        // بررسی autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // بررسی دسترسی
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // ذخیره فیلدها
        if (isset($_POST['exam_date'])) {
            update_post_meta($post_id, '_exam_date', sanitize_text_field($_POST['exam_date']));
        }

        if (isset($_POST['exam_time'])) {
            update_post_meta($post_id, '_exam_time', sanitize_text_field($_POST['exam_time']));
        }

        if (isset($_POST['exam_duration'])) {
            update_post_meta($post_id, '_exam_duration', absint($_POST['exam_duration']));
        }

        if (isset($_POST['exam_position'])) {
            update_post_meta($post_id, '_exam_position', sanitize_text_field($_POST['exam_position']));
        }

        if (isset($_POST['exam_department'])) {
            update_post_meta($post_id, '_exam_department', sanitize_text_field($_POST['exam_department']));
        }

        if (isset($_POST['exam_location'])) {
            update_post_meta($post_id, '_exam_location', sanitize_text_field($_POST['exam_location']));
        }

        if (isset($_POST['exam_requirements'])) {
            update_post_meta($post_id, '_exam_requirements', wp_kses_post($_POST['exam_requirements']));
        }

        if (isset($_POST['exam_application_deadline'])) {
            update_post_meta($post_id, '_exam_application_deadline', sanitize_text_field($_POST['exam_application_deadline']));
        }

        if (isset($_POST['exam_status'])) {
            update_post_meta($post_id, '_exam_status', sanitize_text_field($_POST['exam_status']));
        }
    }
    
    /**
     * AJAX: احراز هویت کاربر
     */
    public function ajax_authenticate_user() {
        // بررسی امنیت
        if (!current_user_can('manage_options')) {
            wp_send_json_error('شما دسترسی لازم ندارید');
            return;
        }
        
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'um_auth_nonce')) {
            wp_send_json_error('خطای امنیتی - nonce نامعتبر');
            return;
        }
        
        $username = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
        $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
        
        if (empty($username) || empty($password)) {
            wp_send_json_error('نام کاربری و رمز عبور الزامی هستند');
            return;
        }
        
        // لاگ درخواست برای دیباگ
        error_log('UM Auth Request: Username=' . $username);
        
        // ارسال درخواست لاگین به ws_dore.php
        $response = wp_remote_post('https://kwphc.ir/webservice_new/ws_dore.php/login', array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url')
            ),
            'body' => array(
                'username' => $username,
                'password' => $password
            ),
            'timeout' => 30,
            'sslverify' => false
        ));
        
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            error_log('UM Auth Error: ' . $error_message);
            wp_send_json_error('خطا در اتصال به سرور: ' . $error_message);
            return;
        }
        
        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        // لاگ پاسخ برای دیباگ
        error_log('UM Auth Response Code: ' . $http_code);
        error_log('UM Auth Response Body: ' . $body);
        
        if ($http_code !== 200) {
            wp_send_json_error('خطای سرور: کد ' . $http_code);
            return;
        }
        
        $data = json_decode($body, true);
        
        if (!$data) {
            wp_send_json_error('پاسخ نامعتبر از سرور - JSON نامعتبر');
            return;
        }
        
        if (isset($data['status']) && $data['status'] === 'success') {
            // بررسی وجود فیلدهای مورد نیاز
            if (!isset($data['access_token']) || !isset($data['expires_in'])) {
                wp_send_json_error('پاسخ سرور کامل نیست - توکن یا expires_in موجود نیست');
                return;
            }
            
            // ذخیره اطلاعات احراز هویت دوره
            update_option('_um_auth_token', $data['access_token']);
            $refresh_token = isset($data['refresh_token']) ? $data['refresh_token'] : '';
            update_option('_um_refresh_token', $refresh_token);
            update_option('_um_token_expires', time() + intval($data['expires_in']));
            update_option('_um_auth_username', $username);
            update_option('_um_auth_status', 'authenticated');
            
            // --- لاگین به وب‌سرویس آزمون ---
            $azmoon_response = wp_remote_post('https://kwphc.ir/webservice_new/webervice_Azmoon.php/login', array(
                'method' => 'POST',
                'headers' => array(
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url')
                ),
                'body' => array(
                    'username' => $username,
                    'password' => $password
                ),
                'timeout' => 30,
                'sslverify' => false
            ));
            $azmoon_body = wp_remote_retrieve_body($azmoon_response);
            $azmoon_data = json_decode($azmoon_body, true);
            if (isset($azmoon_data['status']) && $azmoon_data['status'] === 'success' && isset($azmoon_data['access_token'])) {
                update_option('_um_azmoon_token', $azmoon_data['access_token']);
                update_option('_um_azmoon_token_expires', time() + intval($azmoon_data['expires_in']));
            } else {
                update_option('_um_azmoon_token', '');
                update_option('_um_azmoon_token_expires', 0);
            }
            // --- پایان لاگین آزمون ---

            // لاگ موفقیت
            error_log('UM Auth Success: Token saved for user ' . $username);
            $message = isset($data['message']) ? $data['message'] : 'ورود موفقیت‌آمیز بود';
            wp_send_json_success(array(
                'message' => $message,
                'username' => $username,
                'expires_in' => $data['expires_in'],
                'token_preview' => substr($data['access_token'], 0, 20) . '...'
            ));
        } else {
            $error_message = isset($data['message']) ? $data['message'] : 'خطا در احراز هویت';
            error_log('UM Auth Failed: ' . $error_message);
            wp_send_json_error($error_message);
        }
    }
    
    /**
     * AJAX: خروج از حساب کاربری
     */
    public function ajax_logout_user() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_logout_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }
        
        // پاک کردن اطلاعات احراز هویت
        delete_option('_um_auth_token');
        delete_option('_um_refresh_token');
        delete_option('_um_token_expires');
        delete_option('_um_auth_username');
        delete_option('_um_auth_status');
        
        wp_send_json_success('با موفقیت خارج شدید');
    }
    
    /**
     * AJAX: دریافت سمینارها
     */
    public function ajax_get_seminars() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_seminars_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }
        
        // بررسی وضعیت احراز هویت
        $auth_status = get_option('_um_auth_status');
        $token = get_option('_um_auth_token');
        $token_expires = get_option('_um_token_expires');
        
        if ($auth_status !== 'authenticated' || empty($token) || time() > $token_expires) {
            wp_send_json_error('لطفاً ابتدا وارد شوید');
        }
        
        // دریافت limit از تنظیمات
        $limit = get_option('_um_seminars_limit', 10);
        
        // لاگ درخواست
        error_log('UM Seminars Request: Limit=' . $limit . ', Token=' . substr($token, 0, 20) . '...');
        
        // ارسال درخواست برای دریافت سمینارها
        $response = wp_remote_get('https://kwphc.ir/webservice_new/ws_dore.php?action=latest_records&limit=' . $limit, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $token,
                'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
                'Accept' => 'application/json'
            ),
            'timeout' => 30,
            'sslverify' => false
        ));
        
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            error_log('UM Seminars Error: ' . $error_message);
            wp_send_json_error('خطا در اتصال به سرور: ' . $error_message);
        }
        
        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        // لاگ پاسخ
        error_log('UM Seminars Response Code: ' . $http_code);
        error_log('UM Seminars Response Body: ' . substr($body, 0, 500) . '...');
        
        if ($http_code === 401) {
            // توکن منقضی شده
            delete_option('_um_auth_status');
            wp_send_json_error('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }
        
        if ($http_code !== 200) {
            wp_send_json_error('خطای سرور: کد ' . $http_code);
        }
        
        $data = json_decode($body, true);
        
        if (!$data) {
            wp_send_json_error('پاسخ نامعتبر از سرور - JSON نامعتبر');
        }
        
        // لاگ موفقیت
        error_log('UM Seminars Success: ' . count($data) . ' seminars received');
        
        wp_send_json_success($data);
    }
    
    /**
     * AJAX: ذخیره تنظیمات API
     */
    public function ajax_save_api_settings() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_api_settings_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }
        
        $limit = intval($_POST['limit']);
        if ($limit < 1 || $limit > 100) {
            wp_send_json_error('حد سمینارها باید بین 1 تا 100 باشد');
        }
        
        update_option('_um_seminars_limit', $limit);
        
        wp_send_json_success('تنظیمات با موفقیت ذخیره شد');
    }
    
    /**
     * AJAX: تست API
     */
    public function ajax_test_api() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_test_api_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }
        
        // تست لاگین با اطلاعات نمونه
        $test_username = 'admin';
        $test_password = 'kwphc_2024!';
        
        $response = wp_remote_post('https://kwphc.ir/webservice_new/ws_dore.php/login', array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url')
            ),
            'body' => array(
                'username' => $test_username,
                'password' => $test_password
            ),
            'timeout' => 30,
            'sslverify' => false
        ));
        
        if (is_wp_error($response)) {
            wp_send_json_error('خطا در اتصال: ' . $response->get_error_message());
        }
        
        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        wp_send_json_success(array(
            'http_code' => $http_code,
            'response' => $body,
            'parsed' => json_decode($body, true)
        ));
    }

    /**
     * AJAX: تست مستقیم API
     */
    public function ajax_direct_api_test() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_direct_test_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }
        
        // اطلاعات تست
        $test_username = 'admin';
        $test_password = 'kwphc_2024!';
        
        // تست اتصال به API
        $response = wp_remote_post('https://kwphc.ir/webservice_new/ws_dore.php/login', array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url')
            ),
            'body' => array(
                'username' => $test_username,
                'password' => $test_password
            ),
            'timeout' => 30,
            'sslverify' => false
        ));
        
        if (is_wp_error($response)) {
            wp_send_json_error('خطا در اتصال: ' . $response->get_error_message());
        }
        
        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        if ($http_code !== 200) {
            wp_send_json_error('خطای سرور: کد ' . $http_code);
        }
        
        $data = json_decode($body, true);
        
        if (!$data) {
            wp_send_json_error('پاسخ نامعتبر از سرور');
        }
        
        if (isset($data['status']) && $data['status'] === 'success') {
            wp_send_json_success(array(
                'http_code' => $http_code,
                'status' => $data['status'],
                'message' => $data['message'],
                'token_preview' => substr($data['access_token'], 0, 30) . '...',
                'expires_in' => $data['expires_in']
            ));
        } else {
            wp_send_json_error('احراز هویت ناموفق: ' . (isset($data['message']) ? $data['message'] : 'نامشخص'));
        }
    }

    /**
     * AJAX: ورود اطلاعات سمینارها
     */
    public function ajax_import_seminars() {
        // افزایش زمان اجرا و حافظه برای جلوگیری از خطا
        @set_time_limit(300);
        @ini_set('memory_limit', '256M');

        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_import_seminars_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        // بررسی وضعیت احراز هویت
        $token = get_option('_um_auth_token');
        if (empty($token) || time() > get_option('_um_token_expires', 0)) {
            wp_send_json_error('توکن احراز هویت معتبر نیست. لطفاً دوباره وارد شوید.');
        }

        // دریافت سمینارها از وب سرویس
        $limit = get_option('_um_seminars_limit', 100); // دریافت تعداد بالا برای وارد کردن همه
        $api_url = 'https://kwphc.ir/webservice_new/ws_dore.php?action=latest_records&limit=' . intval($limit);
        
        $response = wp_remote_get($api_url, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ),
            'timeout' => 60,
            'sslverify' => false
        ));

        if (is_wp_error($response)) {
            wp_send_json_error('خطا در اتصال به وب‌سرویس: ' . $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        // بررسی پاسخ و استخراج رکوردها
        if (!$data || !isset($data['status']) || $data['status'] !== 'success' || !isset($data['records'])) {
            wp_send_json_error('پاسخ وب‌سرویس معتبر نیست یا هیچ سمیناری یافت نشد. پاسخ دریافتی: ' . esc_html($body));
        }
        
        $seminars = $data['records'];

        // شروع فرآیند وارد کردن
        $summary = array(
            'imported' => 0,
            'updated' => 0,
            'skipped' => 0,
            'failed' => 0,
            'images_downloaded' => 0,
            'images_failed' => 0,
            'images_skipped' => 0,
        );

        foreach ($seminars as $seminar) {
            try {
                // کد منحصر به فرد دوره
                $course_code = sanitize_text_field($seminar['co_doreh']);
                if (empty($course_code)) {
                    $summary['failed']++;
                    continue;
                }

                // بررسی وجود پست با این کد دوره
                $existing_post_query = new WP_Query(array(
                    'post_type' => 'um_seminars',
                    'meta_key' => '_um_course_code',
                    'meta_value' => $course_code,
                    'posts_per_page' => 1,
                    'post_status' => 'any',
                    'fields' => 'ids'
                ));
                $existing_post_id = !empty($existing_post_query->posts) ? $existing_post_query->posts[0] : null;

                // آماده‌سازی اطلاعات پست
                $post_title = sanitize_text_field($seminar['Title']);
                $post_content = wp_kses_post(str_replace(array("\r\n", "\r", "\n"), "<br/>", $seminar['Mohtava']));
                $post_excerpt = sanitize_text_field($seminar['Mokhatabin']);
                
                // لاگ اطلاعات سمینار برای دیباگ
                error_log("UM Import: Processing seminar - Title: {$post_title}, Teacher: " . ($seminar['Name_Ostad'] ?? 'null') . ", Date: " . ($seminar['Date_Start'] ?? 'null') . ", Image: " . ($seminar['SeminarPic'] ?? 'null'));

                $post_data = array(
                    'post_title' => $post_title,
                    'post_content' => $post_content,
                    'post_status' => 'publish',
                    'post_type' => 'um_seminars',
                    'post_excerpt' => $post_excerpt,
                );

                if ($existing_post_id) {
                    // به‌روزرسانی پست موجود
                    $post_data['ID'] = $existing_post_id;
                    wp_update_post($post_data);
                    $summary['updated']++;
                    $post_id = $existing_post_id;
                } else {
                    // ایجاد پست جدید
                    $post_id = wp_insert_post($post_data, true);
                    if (is_wp_error($post_id)) {
                        $summary['failed']++;
                        continue;
                    }
                    $summary['imported']++;
                }
                
                // ذخیره فیلدهای سفارشی
                update_post_meta($post_id, '_um_course_code', $course_code);
                update_post_meta($post_id, '_seminar_teacher', sanitize_text_field($seminar['Name_Ostad']));
                update_post_meta($post_id, '_seminar_time', sanitize_text_field($seminar['Date_Start']));
                update_post_meta($post_id, '_seminar_button_text', 'شروع یادگیری');
                // لینک دکمه را می‌توانید در اینجا تنظیم کنید، فعلا خالی می‌گذاریم
                // update_post_meta($post_id, '_seminar_button_link', 'https://example.com');
                
                // سایر فیلدها که ممکن است لازم باشند
                update_post_meta($post_id, '_um_seminar_duration', sanitize_text_field($seminar['Moddat']));
                update_post_meta($post_id, '_um_seminar_audience', $post_excerpt);
                update_post_meta($post_id, '_um_seminar_fee', sanitize_text_field($seminar['H_Amoozeshi']));
                update_post_meta($post_id, '_um_seminar_support_tel', sanitize_text_field($seminar['PostibaniTel']));

                // دانلود و تنظیم تصویر شاخص
                $image_name = $seminar['SeminarPic'] ?: $seminar['Boroshor'];
                if (!empty($image_name) && $image_name !== '-' && $image_name !== 'null' && $image_name !== '') {
                    $image_url = 'https://kwphc.ir/webservice_new/images/' . $image_name;
                    $image_success = $this->sideload_image_and_set_thumbnail($image_url, $post_id, $post_title);
                    
                    // لاگ نتیجه دانلود تصویر
                    if ($image_success) {
                        error_log("UM Import: ✅ Image downloaded and set as thumbnail for post {$post_id}: {$image_name}");
                        $summary['images_downloaded'] = ($summary['images_downloaded'] ?? 0) + 1;
                    } else {
                        error_log("UM Import: ❌ Failed to download image for post {$post_id}: {$image_name}");
                        $summary['images_failed'] = ($summary['images_failed'] ?? 0) + 1;
                    }
                } else {
                    error_log("UM Import: ⚠️ No valid image found for post {$post_id}. SeminarPic: " . ($seminar['SeminarPic'] ?? 'null') . ", Boroshor: " . ($seminar['Boroshor'] ?? 'null'));
                    $summary['images_skipped'] = ($summary['images_skipped'] ?? 0) + 1;
                }

            } catch (Exception $e) {
                $summary['failed']++;
            }
        }

        // لاگ نتیجه نهایی
        error_log("UM Import Seminars Summary: " . json_encode($summary));
        
        wp_send_json_success($summary);
    }
    
    /**
     * دانلود تصویر از URL و تنظیم به عنوان تصویر شاخص
     */
    private function sideload_image_and_set_thumbnail($image_url, $post_id, $description) {
        // نیاز به این فایل‌ها برای دانلود تصویر
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // بررسی وجود تصویر شاخص فعلی
        if (has_post_thumbnail($post_id)) {
            error_log("UM Import: Post {$post_id} already has thumbnail, skipping image download");
            return true;
        }

        // بررسی اعتبار URL
        if (empty($image_url) || !filter_var($image_url, FILTER_VALIDATE_URL)) {
            error_log("UM Import: Invalid image URL: {$image_url}");
            return false;
        }

        // بررسی وجود فایل در سرور
        $response = wp_remote_head($image_url, array(
            'timeout' => 15,
            'sslverify' => false,
            'user-agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url')
        ));

        if (is_wp_error($response)) {
            error_log("UM Import: Network error checking image: " . $response->get_error_message());
            return false;
        }

        $http_code = wp_remote_retrieve_response_code($response);
        if ($http_code !== 200) {
            error_log("UM Import: Image not accessible (HTTP {$http_code}): {$image_url}");
            return false;
        }

        // بررسی نوع فایل
        $content_type = wp_remote_retrieve_header($response, 'content-type');
        if ($content_type && !preg_match('/^image\//', $content_type)) {
            error_log("UM Import: URL is not an image (Content-Type: {$content_type}): {$image_url}");
            return false;
        }

        // دانلود تصویر با نام فایل انگلیسی
        $attachment_id = $this->download_image_with_english_filename($image_url, $post_id, $description);

        // اگر دانلود موفق بود، آن را به عنوان تصویر شاخص تنظیم کن
        if (!is_wp_error($attachment_id) && $attachment_id) {
            // تنظیم تصویر شاخص
            $thumbnail_result = set_post_thumbnail($post_id, $attachment_id);
            
            if ($thumbnail_result) {
                error_log("UM Import: ✅ Successfully set thumbnail for post {$post_id} with attachment {$attachment_id}");
                
                // به‌روزرسانی اطلاعات attachment
                wp_update_post(array(
                    'ID' => $attachment_id,
                    'post_title' => $description,
                    'post_excerpt' => 'تصویر شاخص سمینار: ' . $description
                ));
                
                return true;
            } else {
                error_log("UM Import: ❌ Failed to set thumbnail for post {$post_id} with attachment {$attachment_id}");
                return false;
            }
        } else {
            $error_message = is_wp_error($attachment_id) ? $attachment_id->get_error_message() : 'Unknown error';
            error_log("UM Import: ❌ Failed to sideload image for post {$post_id}: " . $error_message);
        }
        
        return false;
    }
    
    /**
     * دانلود تصویر با نام فایل انگلیسی
     */
    private function download_image_with_english_filename($image_url, $post_id, $description) {
        // دریافت محتوای تصویر
        $response = wp_remote_get($image_url, array(
            'timeout' => 30,
            'sslverify' => false,
            'user-agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url')
        ));

        if (is_wp_error($response)) {
            error_log("UM Import: Failed to download image content: " . $response->get_error_message());
            return false;
        }

        $image_content = wp_remote_retrieve_body($response);
        if (empty($image_content)) {
            error_log("UM Import: Empty image content received");
            return false;
        }

        // تشخیص نوع فایل از محتوا
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_buffer($finfo, $image_content);
        finfo_close($finfo);

        // تعیین پسوند فایل
        $extension = '';
        switch ($mime_type) {
            case 'image/jpeg':
            case 'image/jpg':
                $extension = 'jpg';
                break;
            case 'image/png':
                $extension = 'png';
                break;
            case 'image/gif':
                $extension = 'gif';
                break;
            case 'image/webp':
                $extension = 'webp';
                break;
            default:
                error_log("UM Import: Unsupported image type: {$mime_type}");
                return false;
        }

        // ایجاد نام فایل انگلیسی
        $english_filename = $this->generate_english_filename($post_id, $description, $extension);
        
        // ایجاد مسیر موقت
        $upload_dir = wp_upload_dir();
        $temp_file = $upload_dir['path'] . '/' . $english_filename;

        // ذخیره فایل موقت
        if (file_put_contents($temp_file, $image_content) === false) {
            error_log("UM Import: Failed to save temporary file: {$temp_file}");
            return false;
        }

        // آماده‌سازی فایل برای media_sideload_image
        $_FILES['upload'] = array(
            'name' => $english_filename,
            'type' => $mime_type,
            'tmp_name' => $temp_file,
            'error' => 0,
            'size' => filesize($temp_file)
        );

        // استفاده از media_handle_sideload
        $attachment_id = media_handle_sideload($_FILES['upload'], $post_id, $description);

        // پاک کردن فایل موقت
        if (file_exists($temp_file)) {
            unlink($temp_file);
        }

        if (is_wp_error($attachment_id)) {
            error_log("UM Import: Failed to handle sideload: " . $attachment_id->get_error_message());
            return false;
        }

        error_log("UM Import: Successfully downloaded image with English filename: {$english_filename}");
        return $attachment_id;
    }
    
    /**
     * تولید نام فایل انگلیسی
     */
    private function generate_english_filename($post_id, $description, $extension) {
        // تبدیل عنوان فارسی به انگلیسی
        $english_title = $this->convert_persian_to_english($description);
        
        // حذف کاراکترهای غیرمجاز
        $filename = preg_replace('/[^a-zA-Z0-9\-_]/', '_', $english_title);
        $filename = preg_replace('/_+/', '_', $filename); // حذف _ های تکراری
        $filename = trim($filename, '_'); // حذف _ از ابتدا و انتها
        
        // محدود کردن طول نام فایل
        if (strlen($filename) > 50) {
            $filename = substr($filename, 0, 50);
        }
        
        // اضافه کردن ID پست برای منحصر به فرد بودن
        $filename = 'seminar_' . $post_id . '_' . $filename . '.' . $extension;
        
        return $filename;
    }
    
    /**
     * تبدیل متن فارسی به انگلیسی (ساده)
     */
    private function convert_persian_to_english($text) {
        // تبدیل کلمات فارسی رایج به انگلیسی
        $persian_to_english = array(
            'پایتون' => 'python',
            'جاوا' => 'java',
            'جاوااسکریپت' => 'javascript',
            'پیاچپی' => 'php',
            'سی‌شارپ' => 'csharp',
            'سی‌پلاس‌پلاس' => 'cpp',
            'سی' => 'c',
            'روبی' => 'ruby',
            'گو' => 'go',
            'راست' => 'rust',
            'سوئیفت' => 'swift',
            'کاتلین' => 'kotlin',
            'اسکالا' => 'scala',
            'پرل' => 'perl',
            'لوا' => 'lua',
            'راکت' => 'react',
            'انگولار' => 'angular',
            'ویو' => 'vue',
            'نود' => 'node',
            'اکسپرس' => 'express',
            'لاراول' => 'laravel',
            'دجانگو' => 'django',
            'فلسک' => 'flask',
            'اسپرینگ' => 'spring',
            'دات‌نت' => 'dotnet',
            'لینوکس' => 'linux',
            'ویندوز' => 'windows',
            'مک' => 'mac',
            'اندروید' => 'android',
            'آی‌او‌اس' => 'ios',
            'وب' => 'web',
            'موبایل' => 'mobile',
            'دسکتاپ' => 'desktop',
            'سرور' => 'server',
            'کلاینت' => 'client',
            'دیتابیس' => 'database',
            'مای‌اس‌کیو‌ال' => 'mysql',
            'پست‌گرس‌کیو‌ال' => 'postgresql',
            'مانگو' => 'mongo',
            'ردیس' => 'redis',
            'الاستیک' => 'elastic',
            'سوکت' => 'socket',
            'آر‌پی‌سی' => 'rpc',
            'آر‌است' => 'rest',
            'گراف‌کیو‌ال' => 'graphql',
            'جیسون' => 'json',
            'ایکس‌ام‌ال' => 'xml',
            'یام‌ال' => 'yaml',
            'سی‌اس‌اس' => 'css',
            'اچ‌تی‌ام‌ال' => 'html',
            'اس‌کیو‌ال' => 'sql',
            'نو‌اس‌کیو‌ال' => 'nosql',
            'میکروسرویس' => 'microservice',
            'کانتینر' => 'container',
            'داکر' => 'docker',
            'کوبرنتیز' => 'kubernetes',
            'سی‌آی' => 'ci',
            'سی‌دی' => 'cd',
            'دی‌او‌اس' => 'devops',
            'گیت' => 'git',
            'جیت‌هاب' => 'github',
            'جیت‌لب' => 'gitlab',
            'بیت‌باکت' => 'bitbucket',
            'آمازون' => 'amazon',
            'گوگل' => 'google',
            'مایکروسافت' => 'microsoft',
            'اپل' => 'apple',
            'فیسبوک' => 'facebook',
            'توییتر' => 'twitter',
            'لینکدین' => 'linkedin',
            'یوتیوب' => 'youtube',
            'اینستاگرام' => 'instagram',
            'تلگرام' => 'telegram',
            'واتس‌اپ' => 'whatsapp',
            'اسکایپ' => 'skype',
            'زوم' => 'zoom',
            'اسلک' => 'slack',
            'دیسکورد' => 'discord',
            'تیمز' => 'teams',
            'میت' => 'meet',
            'کلاس' => 'class',
            'درس' => 'lesson',
            'دوره' => 'course',
            'کارگاه' => 'workshop',
            'سمینار' => 'seminar',
            'کنفرانس' => 'conference',
            'وبینار' => 'webinar',
            'آموزش' => 'training',
            'یادگیری' => 'learning',
            'برنامه‌نویسی' => 'programming',
            'توسعه' => 'development',
            'طراحی' => 'design',
            'معماری' => 'architecture',
            'الگوریتم' => 'algorithm',
            'ساختار' => 'structure',
            'الگو' => 'pattern',
            'فریم‌ورک' => 'framework',
            'کتابخانه' => 'library',
            'پلاگین' => 'plugin',
            'ماژول' => 'module',
            'کامپوننت' => 'component',
            'سرویس' => 'service',
            'کنترلر' => 'controller',
            'مدل' => 'model',
            'ویو' => 'view',
            'راوتر' => 'router',
            'میدل‌ور' => 'middleware',
            'هوک' => 'hook',
            'کالبک' => 'callback',
            'پرامیس' => 'promise',
            'آسینک' => 'async',
            'آویت' => 'await',
            'فانکشن' => 'function',
            'کلاس' => 'class',
            'آبجکت' => 'object',
            'آرایه' => 'array',
            'متغیر' => 'variable',
            'ثابت' => 'constant',
            'عملگر' => 'operator',
            'شرط' => 'condition',
            'حلقه' => 'loop',
            'بازگشت' => 'return',
            'ورودی' => 'input',
            'خروجی' => 'output',
            'پارامتر' => 'parameter',
            'آرگومان' => 'argument',
            'مقدار' => 'value',
            'نوع' => 'type',
            'رشته' => 'string',
            'عدد' => 'number',
            'بولین' => 'boolean',
            'نال' => 'null',
            'آندفاین' => 'undefined',
            'نان' => 'nan',
            'اینفینیتی' => 'infinity',
            'گراند' => 'ground',
            'زیرو' => 'zero',
            'وان' => 'one',
            'تو' => 'two',
            'تری' => 'three',
            'فور' => 'four',
            'فایو' => 'five',
            'سیکس' => 'six',
            'سون' => 'seven',
            'ایت' => 'eight',
            'ناین' => 'nine',
            'تن' => 'ten',
            'هاندر' => 'hundred',
            'تازند' => 'thousand',
            'میلین' => 'million',
            'بیلیون' => 'billion',
            'تریلیون' => 'trillion'
        );
        
        // تبدیل کلمات فارسی به انگلیسی
        $text = str_replace(array_keys($persian_to_english), array_values($persian_to_english), $text);
        
        // تبدیل اعداد فارسی به انگلیسی
        $persian_numbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $text = str_replace($persian_numbers, $english_numbers, $text);
        
        // حذف کاراکترهای خاص و تبدیل به حروف کوچک
        $text = preg_replace('/[^\w\s\-]/', '', $text);
        $text = str_replace(' ', '_', $text);
        $text = preg_replace('/_+/', '_', $text); // حذف _ های تکراری
        $text = trim($text, '_'); // حذف _ از ابتدا و انتها
        
        return strtolower($text);
    }

    /**
     * تبدیل تاریخ شمسی به میلادی
     */
    private function convert_shamsi_to_gregorian($shamsi_date, $time = '') {
        // اگر تاریخ خالی باشد، تاریخ جاری را برگردان
        if (empty($shamsi_date)) {
            return current_time('mysql');
        }

        // پردازش زمان
        $time_str = '00:00:00';
        if (!empty($time)) {
            $time_parts = explode(':', str_replace(array(' AM', ' PM'), '', $time));
            if (count($time_parts) >= 3) {
                list($hour, $minute, $second) = array_map('intval', $time_parts);

                if (strpos($time, 'PM') !== false && $hour < 12) {
                    $hour += 12;
                }
                if (strpos($time, 'AM') !== false && $hour == 12) {
                    $hour = 0;
                }
                $time_str = sprintf('%02d:%02d:%02d', $hour, $minute, $second);
            }
        }

        // پردازش تاریخ شمسی
        if (preg_match('/(\d{4})\/(\d{1,2})\/(\d{1,2})/', $shamsi_date, $matches)) {
            $shamsi_year = intval($matches[1]);
            $shamsi_month = intval($matches[2]);
            $shamsi_day = intval($matches[3]);

            // تبدیل شمسی به میلادی با استفاده از الگوریتم تبدیل
            $gregorian_date = $this->shamsi_to_gregorian($shamsi_year, $shamsi_month, $shamsi_day);
            
            return $gregorian_date . ' ' . $time_str;
        }

        // اگر فرمت تاریخ شناخته نشد، تاریخ جاری را برگردان
        return current_time('mysql');
    }

    /**
     * الگوریتم تبدیل تاریخ شمسی به میلادی
     */
    private function shamsi_to_gregorian($shamsi_year, $shamsi_month, $shamsi_day) {
        // میلادی معادل سال 1 شمسی
        $gregorian_year = $shamsi_year + 621;
        
        // تنظیم ماه‌های شمسی (فروردین = 1)
        $shamsi_months = array(
            1 => 31, 2 => 31, 3 => 31, 4 => 31, 5 => 31, 6 => 31,
            7 => 30, 8 => 30, 9 => 30, 10 => 30, 11 => 30, 12 => 29
        );
        
        // در سال کبیسه، اسفند 30 روز دارد
        if ($this->is_shamsi_leap_year($shamsi_year)) {
            $shamsi_months[12] = 30;
        }

        // محاسبه تعداد روزهای گذشته از ابتدای سال شمسی
        $days_passed = 0;
        for ($i = 1; $i < $shamsi_month; $i++) {
            $days_passed += $shamsi_months[$i];
        }
        $days_passed += $shamsi_day - 1;

        // تاریخ شروع سال شمسی در میلادی (حدودی 21 مارس)
        // سال 1400 شمسی = 2021 میلادی، شروع در 20 مارس
        $start_of_shamsi_year = mktime(0, 0, 0, 3, 20, $gregorian_year);
        
        // اضافه کردن روزهای گذشته
        $target_timestamp = $start_of_shamsi_year + ($days_passed * 24 * 60 * 60);
        
        return date('Y-m-d', $target_timestamp);
    }

    /**
     * بررسی کبیسه بودن سال شمسی
     */
    private function is_shamsi_leap_year($year) {
        // الگوریتم ساده برای تشخیص سال کبیسه شمسی
        $cycle = 128;
        $year_in_cycle = $year % $cycle;
        
        $leap_years = array(1, 5, 9, 13, 17, 22, 26, 30, 34, 38, 42, 46, 50, 55, 59, 63, 67, 71, 75, 79, 83, 88, 92, 96, 100, 104, 108, 112, 116, 121, 125);
        
        return in_array($year_in_cycle, $leap_years);
    }
    
    /**
     * AJAX: دریافت لیست سمینارهای وارد شده
     */
    public function ajax_get_imported_seminars() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_imported_seminars_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $args = array(
            'post_type' => 'um_seminars',
            'posts_per_page' => 20,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $query = new WP_Query($args);
        $seminars = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                
                $seminars[] = array(
                    'id' => $post_id,
                    'title' => get_the_title(),
                    'teacher' => get_post_meta($post_id, '_seminar_teacher', true),
                    'time' => get_post_meta($post_id, '_seminar_time', true),
                    'button_text' => get_post_meta($post_id, '_seminar_button_text', true),
                    'button_link' => get_post_meta($post_id, '_seminar_button_link', true),
                    'thumbnail' => get_the_post_thumbnail_url($post_id, 'thumbnail'),
                    'edit_url' => get_edit_post_link($post_id),
                    'view_url' => get_permalink($post_id),
                    'date' => get_the_date('Y/m/d', $post_id),
                    'course_code' => get_post_meta($post_id, '_um_course_code', true),
                    'duration' => get_post_meta($post_id, '_um_seminar_duration', true),
                    'audience' => get_post_meta($post_id, '_um_seminar_audience', true),
                    'fee' => get_post_meta($post_id, '_um_seminar_fee', true),
                    'support_tel' => get_post_meta($post_id, '_um_seminar_support_tel', true)
                );
            }
            wp_reset_postdata();
        }

        wp_send_json_success($seminars);
    }
    
    /**
     * بررسی وضعیت تصاویر سمینارها
     */
    public function check_seminar_images_status() {
        $args = array(
            'post_type' => 'um_seminars',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $query = new WP_Query($args);
        $stats = array(
            'total_seminars' => 0,
            'with_thumbnail' => 0,
            'without_thumbnail' => 0,
            'seminars_without_images' => array()
        );

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                $stats['total_seminars']++;

                if (has_post_thumbnail($post_id)) {
                    $stats['with_thumbnail']++;
                } else {
                    $stats['without_thumbnail']++;
                    $stats['seminars_without_images'][] = array(
                        'id' => $post_id,
                        'title' => get_the_title(),
                        'course_code' => get_post_meta($post_id, '_um_course_code', true)
                    );
                }
            }
            wp_reset_postdata();
        }

        return $stats;
    }
    
    /**
     * AJAX: تست دانلود تصاویر با نام فارسی
     */
    public function ajax_test_image_download() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_test_image_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $test_images = array(
            'پایتون.jpg' => 'https://kwphc.ir/webservice_new/images/پایتون.jpg',
            'جاوا.png' => 'https://kwphc.ir/webservice_new/images/جاوا.png',
            'react.jpg' => 'https://kwphc.ir/webservice_new/images/react.jpg',
            'python.jpg' => 'https://kwphc.ir/webservice_new/images/python.jpg'
        );

        $results = array();

        foreach ($test_images as $filename => $url) {
            $result = array(
                'filename' => $filename,
                'url' => $url,
                'success' => false,
                'error' => '',
                'english_filename' => ''
            );

            try {
                // تست دانلود تصویر
                $test_post_id = 1; // پست تست
                $english_filename = $this->generate_english_filename($test_post_id, $filename, 'jpg');
                
                $result['english_filename'] = $english_filename;
                
                // بررسی وجود فایل در سرور
                $response = wp_remote_head($url, array(
                    'timeout' => 10,
                    'sslverify' => false
                ));

                if (is_wp_error($response)) {
                    $result['error'] = 'خطای شبکه: ' . $response->get_error_message();
                } elseif (wp_remote_retrieve_response_code($response) !== 200) {
                    $result['error'] = 'فایل در سرور موجود نیست (کد: ' . wp_remote_retrieve_response_code($response) . ')';
                } else {
                    $result['success'] = true;
                    $result['error'] = 'موفق';
                }

            } catch (Exception $e) {
                $result['error'] = 'خطا: ' . $e->getMessage();
            }

            $results[] = $result;
        }

        wp_send_json_success($results);
    }
    
    /**
     * AJAX: ذخیره تنظیمات API آزمون‌ها
     */
    public function ajax_save_azmoon_api_settings() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_azmoon_api_settings_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $limit = intval($_POST['limit']);
        
        if ($limit < 1 || $limit > 100) {
            wp_send_json_error('حد آزمون‌ها باید بین 1 تا 100 باشد');
        }

        update_option('_um_azmoon_limit', $limit);
        wp_send_json_success('تنظیمات با موفقیت ذخیره شد');
    }
    
    /**
     * AJAX: دریافت لیست آزمون‌ها
     */
    public function ajax_get_azmoons() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_azmoons_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        // بررسی احراز هویت آزمون
        $auth_status = get_option('_um_auth_status');
        $token_expires = get_option('_um_azmoon_token_expires');
        if ($auth_status !== 'authenticated' || time() > $token_expires) {
            wp_send_json_error('لطفاً ابتدا وارد شوید');
        }

        $limit = get_option('_um_azmoon_limit', 10);
        $api_url = 'https://kwphc.ir/webservice_new/webervice_Azmoon.php';
        
        // دریافت توکن آزمون
        $access_token = get_option('_um_azmoon_token');
        if (!$access_token) {
            wp_send_json_error('توکن دسترسی موجود نیست');
        }

        $response = wp_remote_get($api_url . '?page=1&page_size=' . $limit, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30
        ));

        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        // لاگ پاسخ برای دیباگ
        error_log('UM Azmoons Response Code: ' . $http_code);
        error_log('UM Azmoons Response Body: ' . $body);
        error_log('UM Azmoons Decoded Data: ' . print_r($data, true));

        if ($http_code === 401) {
            delete_option('_um_auth_status');
            wp_send_json_error('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }

        if (!$data) {
            wp_send_json_error('خطا در پردازش پاسخ سرور');
        }

        // بررسی ساختار پاسخ
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['data'])) {
                wp_send_json_success($data['data']);
            } else {
                wp_send_json_success($data);
            }
        } else if (isset($data['data'])) {
            // اگر status نباشد ولی data باشد
            wp_send_json_success($data['data']);
        } else {
            // اگر هیچ‌کدام نباشد، کل پاسخ را برگردان
            wp_send_json_success($data);
        }
    }
    
    /**
     * AJAX: دریافت آزمون بر اساس شناسه
     */
    public function ajax_get_azmoon() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_azmoon_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $id = intval($_POST['id']);
        if (!$id) {
            wp_send_json_error('شناسه آزمون نامعتبر است');
        }

        // بررسی احراز هویت آزمون
        $auth_status = get_option('_um_auth_status');
        $token_expires = get_option('_um_azmoon_token_expires');
        if ($auth_status !== 'authenticated' || time() > $token_expires) {
            wp_send_json_error('لطفاً ابتدا وارد شوید');
        }

        $api_url = 'https://kwphc.ir/webservice_new/webervice_Azmoon.php';
        
        // دریافت توکن آزمون
        $access_token = get_option('_um_azmoon_token');
        if (!$access_token) {
            wp_send_json_error('توکن دسترسی موجود نیست');
        }

        $response = wp_remote_get($api_url . '?id=' . $id, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30
        ));

        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($http_code === 401) {
            delete_option('_um_auth_status');
            wp_send_json_error('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }

        if (!$data) {
            wp_send_json_error('خطا در پردازش پاسخ سرور');
        }

        if (isset($data['status']) && $data['status'] === 'success') {
            wp_send_json_success($data['data']);
        } else {
            $error_message = isset($data['message']) ? $data['message'] : 'خطای نامشخص';
            wp_send_json_error($error_message);
        }
    }
    
    /**
     * AJAX: ایجاد آزمون جدید
     */
    public function ajax_create_azmoon() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_azmoon_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $azmoon_data = $_POST['azmoon_data'];
        if (empty($azmoon_data['Title'])) {
            wp_send_json_error('عنوان آزمون الزامی است');
        }

        // بررسی احراز هویت آزمون
        $auth_status = get_option('_um_auth_status');
        $token_expires = get_option('_um_azmoon_token_expires');
        if ($auth_status !== 'authenticated' || time() > $token_expires) {
            wp_send_json_error('لطفاً ابتدا وارد شوید');
        }

        $api_url = 'https://kwphc.ir/webservice_new/webervice_Azmoon.php';
        
        // دریافت توکن آزمون
        $access_token = get_option('_um_azmoon_token');
        if (!$access_token) {
            wp_send_json_error('توکن دسترسی موجود نیست');
        }

        $response = wp_remote_post($api_url, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($azmoon_data),
            'timeout' => 30
        ));

        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($http_code === 401) {
            delete_option('_um_auth_status');
            wp_send_json_error('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }

        if (!$data) {
            wp_send_json_error('خطا در پردازش پاسخ سرور');
        }

        if (isset($data['status']) && $data['status'] === 'success') {
            wp_send_json_success($data['data']);
        } else {
            $error_message = isset($data['message']) ? $data['message'] : 'خطای نامشخص';
            wp_send_json_error($error_message);
        }
    }
    
    /**
     * AJAX: به‌روزرسانی آزمون
     */
    public function ajax_update_azmoon() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_azmoon_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $azmoon_data = $_POST['azmoon_data'];
        if (empty($azmoon_data['Id']) || empty($azmoon_data['Title'])) {
            wp_send_json_error('شناسه و عنوان آزمون الزامی است');
        }

        // بررسی احراز هویت آزمون
        $auth_status = get_option('_um_auth_status');
        $token_expires = get_option('_um_azmoon_token_expires');
        if ($auth_status !== 'authenticated' || time() > $token_expires) {
            wp_send_json_error('لطفاً ابتدا وارد شوید');
        }

        $api_url = 'https://kwphc.ir/webservice_new/webervice_Azmoon.php';
        
        // دریافت توکن آزمون
        $access_token = get_option('_um_azmoon_token');
        if (!$access_token) {
            wp_send_json_error('توکن دسترسی موجود نیست');
        }

        $response = wp_remote_request($api_url, array(
            'method' => 'PUT',
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($azmoon_data),
            'timeout' => 30
        ));

        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($http_code === 401) {
            delete_option('_um_auth_status');
            wp_send_json_error('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }

        if (!$data) {
            wp_send_json_error('خطا در پردازش پاسخ سرور');
        }

        if (isset($data['status']) && $data['status'] === 'success') {
            wp_send_json_success($data['data']);
        } else {
            $error_message = isset($data['message']) ? $data['message'] : 'خطای نامشخص';
            wp_send_json_error($error_message);
        }
    }
    
    /**
     * AJAX: حذف آزمون
     */
    public function ajax_delete_azmoon() {
        // بررسی امنیت
        if (!current_user_can('manage_options') || !wp_verify_nonce($_POST['nonce'], 'um_azmoon_nonce')) {
            wp_send_json_error('خطای امنیتی');
        }

        $id = intval($_POST['id']);
        if (!$id) {
            wp_send_json_error('شناسه آزمون نامعتبر است');
        }

        // بررسی احراز هویت آزمون
        $auth_status = get_option('_um_auth_status');
        $token_expires = get_option('_um_azmoon_token_expires');
        if ($auth_status !== 'authenticated' || time() > $token_expires) {
            wp_send_json_error('لطفاً ابتدا وارد شوید');
        }

        $api_url = 'https://kwphc.ir/webservice_new/webervice_Azmoon.php?id=' . $id;
        
        // دریافت توکن آزمون
        $access_token = get_option('_um_azmoon_token');
        if (!$access_token) {
            wp_send_json_error('توکن دسترسی موجود نیست');
        }

        $response = wp_remote_request($api_url, array(
            'method' => 'DELETE',
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30
        ));

        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($http_code === 401) {
            delete_option('_um_auth_status');
            wp_send_json_error('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }

        if (!$data) {
            wp_send_json_error('خطا در پردازش پاسخ سرور');
        }

        if (isset($data['status']) && $data['status'] === 'success') {
            wp_send_json_success($data['data']);
        } else {
            $error_message = isset($data['message']) ? $data['message'] : 'خطای نامشخص';
            wp_send_json_error($error_message);
        }
    }

    /**
     * AJAX برای دریافت آزمون‌ها برای ویجت
     */
    public function ajax_get_azmoons_widget() {
        // بررسی nonce
        if (!wp_verify_nonce($_POST['nonce'], 'university-management-nonce')) {
            wp_die('خطای امنیتی');
        }

        $limit = intval($_POST['limit'] ?? 6);

        // بررسی وجود توکن
        $token = get_option('_um_azmoon_token');
        $token_expiry = get_option('_um_azmoon_token_expiry');

        if (!$token || (time() > $token_expiry)) {
            // تلاش برای لاگین مجدد
            $this->authenticate_azmoon_api();
            $token = get_option('_um_azmoon_token');
        }

        if (!$token) {
            wp_send_json_error(array('message' => 'خطا در احراز هویت'));
            return;
        }

        $api_url = get_option('um_azmoon_api_url', '') . '/azmoons?limit=' . $limit;

        $response = wp_remote_get($api_url, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ),
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            wp_send_json_error(array('message' => 'خطا در اتصال به سرور: ' . $response->get_error_message()));
            return;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (isset($data['data']) && is_array($data['data'])) {
            $azmoons = array();
            foreach ($data['data'] as $azmoon) {
                $azmoons[] = array(
                    'id' => $azmoon['id'] ?? 0,
                    'title' => $azmoon['title'] ?? 'آزمون استخدامی',
                    'date' => $azmoon['date'] ?? '۱۴۰۳/۰۱/۰۱',
                    'department' => $azmoon['department'] ?? 'عمومی',
                    'status' => $azmoon['status'] ?? 'active',
                    'link' => $azmoon['link'] ?? '#',
                    'image' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg',
                    'button_text' => 'مشاهده جزئیات',
                );
            }
            wp_send_json_success($azmoons);
        } else {
            wp_send_json_error(array('message' => 'خطا در دریافت داده‌ها'));
        }
    }

    /**
     * ثبت شورت‌کدهای داینامیک
     */
    public function register_shortcodes() {
        add_shortcode('um_azmoon_title', array($this, 'azmoon_title_shortcode'));
        add_shortcode('um_azmoon_date', array($this, 'azmoon_date_shortcode'));
        add_shortcode('um_azmoon_department', array($this, 'azmoon_department_shortcode'));
        add_shortcode('um_azmoon_status', array($this, 'azmoon_status_shortcode'));
        add_shortcode('um_azmoon_link', array($this, 'azmoon_link_shortcode'));
        add_shortcode('um_azmoon_image', array($this, 'azmoon_image_shortcode'));
        add_shortcode('um_azmoon_description', array($this, 'azmoon_description_shortcode'));
        add_shortcode('um_azmoon_list', array($this, 'azmoon_list_shortcode'));
    }

    /**
     * شورت‌کد عنوان آزمون
     */
    public function azmoon_title_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => 'آزمون استخدامی'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            return $azmoon ? $azmoon['title'] : $atts['default'];
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد تاریخ آزمون
     */
    public function azmoon_date_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => '۱۴۰۳/۰۱/۰۱'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            return $azmoon ? $azmoon['date'] : $atts['default'];
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد دپارتمان آزمون
     */
    public function azmoon_department_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => 'عمومی'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            return $azmoon ? $azmoon['department'] : $atts['default'];
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد وضعیت آزمون
     */
    public function azmoon_status_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => 'فعال'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            if ($azmoon) {
                $status_map = array(
                    'active' => 'فعال',
                    'inactive' => 'غیرفعال',
                    'completed' => 'تکمیل شده'
                );
                return isset($status_map[$azmoon['status']]) ? $status_map[$azmoon['status']] : $atts['default'];
            }
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد لینک آزمون
     */
    public function azmoon_link_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => '#'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            return $azmoon ? $azmoon['link'] : $atts['default'];
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد تصویر آزمون
     */
    public function azmoon_image_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            return $azmoon ? $azmoon['image'] : $atts['default'];
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد توضیحات آزمون
     */
    public function azmoon_description_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
            'default' => 'توضیحات آزمون'
        ), $atts);

        if ($atts['id'] > 0) {
            $azmoon = $this->get_azmoon_by_id($atts['id']);
            return $azmoon ? $azmoon['description'] : $atts['default'];
        }

        return $atts['default'];
    }

    /**
     * شورت‌کد لیست آزمون‌ها
     */
    public function azmoon_list_shortcode($atts) {
        $atts = shortcode_atts(array(
            'limit' => 6,
            'status' => 'active',
            'department' => '',
            'template' => 'grid'
        ), $atts);

        $azmoons = $this->get_azmoons_for_shortcode($atts);

        if (empty($azmoons)) {
            return '<div class="um-azmoon-empty">هیچ آزمونی یافت نشد.</div>';
        }

        $output = '<div class="um-azmoon-list um-template-' . esc_attr($atts['template']) . '">';
        
        foreach ($azmoons as $azmoon) {
            $output .= $this->generate_azmoon_card_html($azmoon, $atts['template']);
        }
        
        $output .= '</div>';

        return $output;
    }

    /**
     * دریافت آزمون بر اساس ID
     */
    private function get_azmoon_by_id($post_id) {
        $post = get_post($post_id);
        if (!$post) {
            return null;
        }

        return array(
            'id' => $post->ID,
            'Title' => $post->post_title,
            'Company' => get_post_meta($post->ID, 'company', true),
            'City' => get_post_meta($post->ID, 'city', true),
            'DSSabtName' => get_post_meta($post->ID, 'start_date', true),
            'DPSabtName' => get_post_meta($post->ID, 'end_date', true),
            'DAzmoon' => get_post_meta($post->ID, 'exam_date', true),
            'Poster' => get_post_meta($post->ID, 'poster', true),
            'Agahi' => get_post_meta($post->ID, 'agahi_file', true),
            'Tozihat' => $post->post_content,
            'Link' => get_post_meta($post->ID, 'link', true),
            'Active' => get_post_meta($post->ID, 'is_active', true) ? '1' : '0',
            'status' => $this->get_azmoon_status($post->ID)
        );
    }
    
    private function get_azmoon_status($post_id) {
        $is_active = get_post_meta($post_id, 'is_active', true);
        $status_map = array(
            'active' => 'فعال',
            'inactive' => 'غیرفعال',
            'completed' => 'تکمیل شده'
        );
        return isset($status_map[$is_active]) ? $status_map[$is_active] : 'نامشخص';
    }

    public function ajax_load_and_insert_azmoons_from_api() {
        check_ajax_referer('um_load_and_insert_azmoons_from_api_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error('شما مجوز لازم برای این کار را ندارید.', 403);
        }

        // دریافت آزمون‌ها از وب‌سرویس
        try {
            $azmoons_data = $this->get_azmoons_from_webservice();
        } catch (Exception $e) {
            wp_send_json_error('خطا در دریافت آزمون‌ها از وب‌سرویس: ' . $e->getMessage());
            return;
        }

        if (empty($azmoons_data)) {
            wp_send_json_error('هیچ آزمونی از وب‌سرویس دریافت نشد.');
            return;
        }
        
        $new_azmoons = array();
        $existing_azmoons_count = 0;
        $new_azmoons_count = 0;

        foreach ($azmoons_data as $azmoon) {
            $azmoon_id = isset($azmoon['ID']) ? $azmoon['ID'] : null;

            if (!$azmoon_id) {
                continue;
            }

            // Check if post with this azmoon_id already exists
            $existing_posts = get_posts(array(
                'post_type' => 'um_employment_exams',
                'meta_key' => 'azmoon_id',
                'meta_value' => $azmoon_id,
                'post_status' => 'any',
                'fields' => 'ids'
            ));

            if (!empty($existing_posts)) {
                $existing_azmoons_count++;
                continue; // Skip if already exists
            }

            $post_data = array(
                'post_title'   => sanitize_text_field($azmoon['Title']),
                'post_content' => wp_kses_post($azmoon['Tozihat']),
                'post_type'    => 'um_employment_exams',
                'post_status'  => 'publish',
            );

            $post_id = wp_insert_post($post_data);

            if (is_wp_error($post_id)) {
                // Handle error if needed
                continue;
            }

            // Add meta fields
            add_post_meta($post_id, 'azmoon_id', $azmoon_id);
            add_post_meta($post_id, 'company', sanitize_text_field($azmoon['Company']));
            add_post_meta($post_id, 'city', sanitize_text_field($azmoon['City']));
            add_post_meta($post_id, 'start_date', sanitize_text_field($azmoon['DSSabtName']));
            add_post_meta($post_id, 'end_date', sanitize_text_field($azmoon['DPSabtName']));
            add_post_meta($post_id, 'exam_date', sanitize_text_field($azmoon['DAzmoon']));
            add_post_meta($post_id, 'poster', esc_url_raw($azmoon['Poster']));
            add_post_meta($post_id, 'agahi_file', esc_url_raw($azmoon['Agahi']));
            add_post_meta($post_id, 'link', esc_url_raw($azmoon['Link']));
            add_post_meta($post_id, 'is_active', $azmoon['Active'] ? '1' : '0');
            
            $new_azmoons_count++;
            $new_azmoons[] = $this->get_azmoon_by_id($post_id);
        }

        $total_fetched = count($azmoons_data);
        wp_send_json_success(array(
            'message' => "عملیات با موفقیت انجام شد. از مجموع {$total_fetched} آزمون دریافت شده از وب‌سرویس، {$new_azmoons_count} آزمون جدید اضافه شد و {$existing_azmoons_count} آزمون تکراری یافت شد.",
            'new_azmoons' => $new_azmoons
        ));
    }

    private function get_azmoons_from_webservice() {
        // بررسی احراز هویت آزمون
        $auth_status = get_option('_um_auth_status');
        $token_expires = get_option('_um_azmoon_token_expires');
        if ($auth_status !== 'authenticated' || time() > $token_expires) {
            throw new Exception('لطفاً ابتدا وارد شوید');
        }

        $limit = 100; // دریافت حداکثر 100 آزمون
        $api_url = 'https://kwphc.ir/webservice_new/webervice_Azmoon.php';
        
        // دریافت توکن آزمون
        $access_token = get_option('_um_azmoon_token');
        if (!$access_token) {
            throw new Exception('توکن دسترسی موجود نیست');
        }

        $response = wp_remote_get($api_url . '?page=1&page_size=' . $limit, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30
        ));

        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        // لاگ پاسخ برای دیباگ
        error_log('UM Load Azmoons Response Code: ' . $http_code);
        error_log('UM Load Azmoons Response Body: ' . $body);

        if ($http_code === 401) {
            delete_option('_um_auth_status');
            throw new Exception('توکن منقضی شده است. لطفاً مجدداً وارد شوید.');
        }

        if (!$data) {
            throw new Exception('خطا در پردازش پاسخ سرور');
        }

        // استخراج آرایه آزمون‌ها
        $azmoons_array = array();
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['data'])) {
                $azmoons_array = $data['data'];
            }
        } else if (isset($data['data'])) {
            $azmoons_array = $data['data'];
        } else if (is_array($data)) {
            $azmoons_array = $data;
        }

        if (!is_array($azmoons_array)) {
            throw new Exception('فرمت پاسخ وب‌سرویس نامعتبر است');
        }

        // پردازش و تبدیل داده‌ها
        $processed_azmoons = array();
        foreach ($azmoons_array as $azmoon) {
            if (!is_array($azmoon)) {
                continue;
            }

            // پردازش مسیر تصاویر
            $poster_url = '';
            $agahi_url = '';
            
            if (!empty($azmoon['Poster'])) {
                if (filter_var($azmoon['Poster'], FILTER_VALIDATE_URL)) {
                    $poster_url = $azmoon['Poster'];
                } else {
                    $poster_url = 'https://kwphc.ir/uploads/azmoon/posters/' . $azmoon['Poster'];
                }
            }
            
            if (!empty($azmoon['Agahi'])) {
                if (filter_var($azmoon['Agahi'], FILTER_VALIDATE_URL)) {
                    $agahi_url = $azmoon['Agahi'];
                } else {
                    $agahi_url = 'https://kwphc.ir/uploads/azmoon/agahi/' . $azmoon['Agahi'];
                }
            }

            $processed_azmoons[] = array(
                'ID' => $azmoon['Id'] ?? $azmoon['ID'] ?? 0,
                'Title' => !empty($azmoon['Title']) ? $azmoon['Title'] : 'آزمون استخدامی',
                'Company' => $azmoon['Company'] ?? '',
                'City' => $azmoon['City'] ?? '',
                'DSSabtName' => $azmoon['DSSabtName'] ?? '',
                'DPSabtName' => $azmoon['DPSabtName'] ?? '',
                'DAzmoon' => $azmoon['DAzmoon'] ?? '',
                'Poster' => $poster_url,
                'Agahi' => $agahi_url,
                'Tozihat' => $azmoon['Tozihat'] ?? '',
                'Link' => $azmoon['Link'] ?? '',
                'Active' => isset($azmoon['Active']) ? intval($azmoon['Active']) : 1
            );
        }

        if (empty($processed_azmoons)) {
            throw new Exception('هیچ آزمونی از وب‌سرویس دریافت نشد');
        }

        return $processed_azmoons;
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