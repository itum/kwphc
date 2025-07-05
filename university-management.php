<?php
/**
 * Plugin Name: مدیریت دانشگاه
 * Plugin URI: https://yourwebsite.com
 * Description: افزونه مدیریت دانشگاه شامل سه ویجت اختصاصی المنتور: تقویم، زمان‌بندی کلاس‌ها و مدیریت ویدیوها
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: university-management
 * Domain Path: /languages
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

// تعریف ثابت‌های افزونه
define('UM_VERSION', '1.0.0');
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
        
        // اضافه کردن اکشن‌های AJAX
        add_action('wp_ajax_um_get_videos_by_category', array($this, 'ajax_get_videos_by_category'));
        add_action('wp_ajax_nopriv_um_get_videos_by_category', array($this, 'ajax_get_videos_by_category'));
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
            require_once UM_PLUGIN_DIR . 'includes/widgets/elementor-widgets.php';
            add_action('elementor/widgets/widgets_registered', array($this, 'register_elementor_widgets'));
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
     * ثبت ویجت‌های المنتور
     */
    public function register_elementor_widgets() {
        // ثبت ویجت‌ها
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
    }

    /**
     * صفحه اصلی مدیریت
     */
    public function admin_page() {
        require_once UM_PLUGIN_DIR . 'admin/admin-page.php';
    }

    /**
     * صفحه مدیریت تقویم
     */
    public function calendar_admin_page() {
        require_once UM_PLUGIN_DIR . 'admin/calendar-page.php';
    }

    /**
     * صفحه مدیریت زمان‌بندی کلاس‌ها
     */
    public function class_timing_admin_page() {
        require_once UM_PLUGIN_DIR . 'admin/class-timing-page.php';
    }

    /**
     * صفحه مدیریت ویدیوها
     */
    public function videos_admin_page() {
        require_once UM_PLUGIN_DIR . 'admin/videos-page.php';
    }
    
    /**
     * افزودن متاباکس‌ها
     */
    public function add_meta_boxes() {
        // متاباکس لینک ویدیو
        add_meta_box(
            'um_video_link',
            __('لینک ویدیو', 'university-management'),
            array($this, 'video_link_meta_box'),
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
        register_post_type('um_videos', array(
            'labels' => array(
                'name'               => __('ویدیوها', 'university-management'),
                'singular_name'      => __('ویدیو', 'university-management'),
                'add_new'            => __('افزودن ویدیو جدید', 'university-management'),
                'add_new_item'       => __('افزودن ویدیو جدید', 'university-management'),
                'edit_item'          => __('ویرایش ویدیو', 'university-management'),
                'new_item'           => __('ویدیو جدید', 'university-management'),
                'view_item'          => __('مشاهده ویدیو', 'university-management'),
                'search_items'       => __('جستجوی ویدیوها', 'university-management'),
                'not_found'          => __('ویدیویی یافت نشد', 'university-management'),
                'not_found_in_trash' => __('ویدیویی در سطل زباله یافت نشد', 'university-management'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => 'university-management',
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon'           => 'dashicons-video-alt3',
            'show_in_rest'        => true,
        ));
        
        // ثبت تاکسونومی دسته‌بندی ویدیوها
        register_taxonomy('um_video_category', 'um_videos', array(
            'labels' => array(
                'name'              => __('دسته‌بندی ویدیوها', 'university-management'),
                'singular_name'     => __('دسته‌بندی ویدیو', 'university-management'),
                'search_items'      => __('جستجوی دسته‌بندی‌ها', 'university-management'),
                'all_items'         => __('همه دسته‌بندی‌ها', 'university-management'),
                'parent_item'       => __('دسته‌بندی والد', 'university-management'),
                'parent_item_colon' => __('دسته‌بندی والد:', 'university-management'),
                'edit_item'         => __('ویرایش دسته‌بندی', 'university-management'),
                'update_item'       => __('بروزرسانی دسته‌بندی', 'university-management'),
                'add_new_item'      => __('افزودن دسته‌بندی جدید', 'university-management'),
                'new_item_name'     => __('نام دسته‌بندی جدید', 'university-management'),
                'menu_name'         => __('دسته‌بندی', 'university-management'),
            ),
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'video-category'),
            'show_in_rest'      => true,
        ));
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
    // ایجاد دیتابیس یا سایر عملیات مورد نیاز هنگام فعال‌سازی
    flush_rewrite_rules();
}

/**
 * غیرفعال‌سازی افزونه
 */
function university_management_deactivate() {
    // پاکسازی دیتابیس یا سایر عملیات مورد نیاز هنگام غیرفعال‌سازی
    flush_rewrite_rules();
} 