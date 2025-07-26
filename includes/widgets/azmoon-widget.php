<?php
/**
 * ویجت آزمون استخدامی برای المنتور
 *
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت آزمون استخدامی
 */
class UM_Azmoon_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'um_azmoon';
    }

    public function get_title() {
        return um_translate('آزمون استخدامی', __('آزمون استخدامی', 'university-management'));
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['university-management'];
    }

    public function get_script_depends() {
        return ['um-azmoon-widget'];
    }

    public function get_style_depends() {
        return ['um-azmoon-widget'];
    }

    /**
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_polylang_strings() {
        if (function_exists('pll_register_string')) {
            // رشته‌های بخش محتوا
            pll_register_string('um_azmoon_widget_content_section', 'محتوا', 'University Management');
            pll_register_string('um_azmoon_widget_main_title', 'عنوان اصلی', 'University Management');
            pll_register_string('um_azmoon_widget_default_main_title', "آزمون‌های\nاستخدامی\nبرگزاری شده", 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_source', 'منبع آزمون‌ها', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_source_manual', 'دستی', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_source_auto', 'خودکار (از API)', 'University Management');
            pll_register_string('um_azmoon_widget_posts_per_page', 'تعداد برای نمایش', 'University Management');

            // رشته‌های تکرارکننده
            pll_register_string('um_azmoon_widget_azmoon_image', 'تصویر', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_title', 'عنوان آزمون', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_date', 'تاریخ برگزاری', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_department', 'دپارتمان', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_status', 'وضعیت', 'University Management');
            pll_register_string('um_azmoon_widget_status_active', 'فعال', 'University Management');
            pll_register_string('um_azmoon_widget_status_inactive', 'غیرفعال', 'University Management');
            pll_register_string('um_azmoon_widget_status_completed', 'تکمیل شده', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_link', 'لینک دکمه', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_button_text', 'عنوان دکمه', 'University Management');
            pll_register_string('um_azmoon_widget_azmoon_list', 'لیست آزمون‌ها', 'University Management');
            pll_register_string('um_azmoon_widget_default_azmoon_button_text', 'مشاهده جزئیات', 'University Management');

            // رشته‌های بخش استایل
            pll_register_string('um_azmoon_widget_style_section', 'استایل', 'University Management');
            pll_register_string('um_azmoon_widget_title_color', 'رنگ عنوان', 'University Management');
            pll_register_string('um_azmoon_widget_card_background', 'رنگ پس‌زمینه کارت', 'University Management');
            
            // رشته‌های خروجی
            pll_register_string('um_azmoon_widget_no_azmoon_found', 'هیچ آزمونی یافت نشد.', 'University Management');
            pll_register_string('um_azmoon_widget_status_unknown', 'نامشخص', 'University Management');
        }
    }

    protected function _register_controls() {
        $this->register_polylang_strings();
        $this->start_controls_section(
            'section_content',
            [
                'label' => um_translate('محتوا', __('محتوا', 'university-management')),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => um_translate('عنوان اصلی', __('عنوان اصلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "آزمون‌های\nاستخدامی\nبرگزاری شده",
                'rows' => 3,
            ]
        );

        $this->add_control(
            'azmoon_source',
            [
                'label' => um_translate('منبع آزمون‌ها', __('منبع آزمون‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => [
                    'manual' => um_translate('دستی', __('دستی', 'university-management')),
                    'auto' => um_translate('خودکار (از API)', __('خودکار (از API)', 'university-management')),
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => um_translate('تعداد برای نمایش', __('تعداد برای نمایش', 'university-management')),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 20,
                'condition' => [
                    'azmoon_source' => 'auto',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'azmoon_image',
            [
                'label' => um_translate('تصویر', __('تصویر', 'university-management')),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg',
                ],
            ]
        );

        $repeater->add_control(
            'azmoon_title',
            [
                'label' => um_translate('عنوان آزمون', __('عنوان آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('آزمون استخدامی مهندس نرم‌افزار', __('آزمون استخدامی مهندس نرم‌افزار', 'university-management')),
            ]
        );

        $repeater->add_control(
            'azmoon_date',
            [
                'label' => um_translate('تاریخ برگزاری', __('تاریخ برگزاری', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('۱۴۰۳/۰۵/۲۰', __('۱۴۰۳/۰۵/۲۰', 'university-management')),
            ]
        );

        $repeater->add_control(
            'azmoon_department',
            [
                'label' => um_translate('دپارتمان', __('دپارتمان', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('فنی و مهندسی', __('فنی و مهندسی', 'university-management')),
            ]
        );

        $repeater->add_control(
            'azmoon_status',
            [
                'label' => um_translate('وضعیت', __('وضعیت', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'active',
                'options' => [
                    'active' => um_translate('فعال', __('فعال', 'university-management')),
                    'inactive' => um_translate('غیرفعال', __('غیرفعال', 'university-management')),
                    'completed' => um_translate('تکمیل شده', __('تکمیل شده', 'university-management')),
                ],
            ]
        );

        $repeater->add_control(
            'azmoon_link',
            [
                'label' => um_translate('لینک دکمه', __('لینک دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => um_translate('https://your-link.com', __('https://your-link.com', 'university-management')),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'azmoon_button_text',
            [
                'label' => um_translate('عنوان دکمه', __('عنوان دکمه', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('مشاهده جزئیات', __('مشاهده جزئیات', 'university-management')),
            ]
        );

        $this->add_control(
            'azmoons',
            [
                'label' => um_translate('لیست آزمون‌ها', __('لیست آزمون‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'azmoon_image' => ['url' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg'],
                        'azmoon_title' => 'آزمون استخدامی مهندس نرم‌افزار',
                        'azmoon_date' => '۱۴۰۳/۰۵/۲۰',
                        'azmoon_department' => 'فنی و مهندسی',
                        'azmoon_status' => 'active',
                    ],
                    [
                        'azmoon_image' => ['url' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg'],
                        'azmoon_title' => 'آزمون استخدامی کارشناس IT',
                        'azmoon_date' => '۱۴۰۳/۰۶/۱۰',
                        'azmoon_department' => 'فناوری اطلاعات',
                        'azmoon_status' => 'active',
                    ],
                    [
                        'azmoon_image' => ['url' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg'],
                        'azmoon_title' => 'آزمون استخدامی مدیر پروژه',
                        'azmoon_date' => '۱۴۰۳/۰۷/۰۵',
                        'azmoon_department' => 'مدیریت',
                        'azmoon_status' => 'completed',
                    ],
                ],
                'condition' => [
                    'azmoon_source' => 'manual',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل
        $this->start_controls_section(
            'section_style',
            [
                'label' => um_translate('استایل', __('استایل', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-azmoon-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .um-azmoon-title',
            ]
        );

        $this->add_control(
            'card_background',
            [
                'label' => um_translate('رنگ پس‌زمینه کارت', __('رنگ پس‌زمینه کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .um-azmoon-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // دریافت آزمون‌ها از API اگر منبع خودکار باشد
        $azmoons = [];
        if ($settings['azmoon_source'] === 'auto') {
            $azmoons = $this->get_azmoons_from_api($settings['posts_per_page']);
        } else {
            $azmoons = $settings['azmoons'];
        }

        if (empty($azmoons)) {
            echo '<div class="um-azmoon-empty">' . esc_html(um_translate('هیچ آزمونی یافت نشد.', __('هیچ آزمونی یافت نشد.', 'university-management'))) . '</div>';
            return;
        }

        ?>
        <div class="um-azmoon-widget">
            <div class="um-azmoon-container">
                <div class="um-azmoon-header">
                    <h2 class="um-azmoon-title"><?php echo esc_html($settings['main_title']); ?></h2>
                </div>
                
                <div class="um-azmoon-grid">
                    <?php foreach ($azmoons as $azmoon): ?>
                        <div class="um-azmoon-card">
                            <div class="um-azmoon-image">
                                <img src="<?php echo esc_url($azmoon['azmoon_image']['url']); ?>" 
                                     alt="<?php echo esc_attr($azmoon['azmoon_title']); ?>">
                                <div class="um-azmoon-status um-status-<?php echo esc_attr($azmoon['azmoon_status']); ?>">
                                    <?php echo $this->get_status_text($azmoon['azmoon_status']); ?>
                                </div>
                            </div>
                            
                            <div class="um-azmoon-content">
                                <h3 class="um-azmoon-card-title"><?php echo esc_html($azmoon['azmoon_title']); ?></h3>
                                <div class="um-azmoon-meta">
                                    <span class="um-azmoon-date">
                                        <i class="eicon-calendar"></i>
                                        <?php echo esc_html($azmoon['azmoon_date']); ?>
                                    </span>
                                    <span class="um-azmoon-department">
                                        <i class="eicon-folder"></i>
                                        <?php echo esc_html($azmoon['azmoon_department']); ?>
                                    </span>
                                </div>
                                
                                <div class="um-azmoon-actions">
                                    <a href="<?php echo esc_url($azmoon['azmoon_link']['url']); ?>" 
                                       class="um-azmoon-button"
                                       <?php echo $azmoon['azmoon_link']['is_external'] ? 'target="_blank"' : ''; ?>
                                       <?php echo $azmoon['azmoon_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                        <?php echo esc_html($azmoon['azmoon_button_text']); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * دریافت آزمون‌ها از API
     */
    private function get_azmoons_from_api($limit = 6) {
        $azmoons = [];
        
        // بررسی وجود توکن
        $token = get_option('_um_azmoon_token');
        $token_expiry = get_option('_um_azmoon_token_expiry');
        
        if (!$token || (time() > $token_expiry)) {
            // تلاش برای لاگین مجدد
            $this->authenticate_azmoon_api();
            $token = get_option('_um_azmoon_token');
        }
        
        if ($token) {
            $api_url = get_option('um_azmoon_api_url', '') . '/azmoons';
            $response = wp_remote_get($api_url, array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ),
                'timeout' => 30,
            ));
            
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $data = json_decode($body, true);
                
                if (isset($data['data']) && is_array($data['data'])) {
                    foreach (array_slice($data['data'], 0, $limit) as $azmoon) {
                        $azmoons[] = array(
                            'azmoon_image' => array('url' => UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg'),
                            'azmoon_title' => $azmoon['title'] ?? 'آزمون استخدامی',
                            'azmoon_date' => $azmoon['date'] ?? '۱۴۰۳/۰۱/۰۱',
                            'azmoon_department' => $azmoon['department'] ?? 'عمومی',
                            'azmoon_status' => $azmoon['status'] ?? 'active',
                            'azmoon_link' => array(
                                'url' => $azmoon['link'] ?? '#',
                                'is_external' => true,
                                'nofollow' => true,
                            ),
                            'azmoon_button_text' => 'مشاهده جزئیات',
                        );
                    }
                }
            }
        }
        
        return $azmoons;
    }

    /**
     * احراز هویت API آزمون
     */
    private function authenticate_azmoon_api() {
        $api_url = get_option('um_azmoon_api_url', '');
        $username = get_option('um_azmoon_username', '');
        $password = get_option('um_azmoon_password', '');
        
        if (!$api_url || !$username || !$password) {
            return false;
        }
        
        $response = wp_remote_post($api_url . '/auth/login', array(
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode(array(
                'username' => $username,
                'password' => $password,
            )),
            'timeout' => 30,
        ));
        
        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            
            if (isset($data['access_token'])) {
                update_option('_um_azmoon_token', $data['access_token']);
                update_option('_um_azmoon_token_expiry', time() + ($data['expires_in'] ?? 3600));
                return true;
            }
        }
        
        return false;
    }

    /**
     * دریافت متن وضعیت
     */
    private function get_status_text($status) {
        switch ($status) {
            case 'active':
                return um_translate('فعال', __('فعال', 'university-management'));
            case 'inactive':
                return um_translate('غیرفعال', __('غیرفعال', 'university-management'));
            case 'completed':
                return um_translate('تکمیل شده', __('تکمیل شده', 'university-management'));
            default:
                return um_translate('نامشخص', __('نامشخص', 'university-management'));
        }
    }
} 