<?php
/**
 * ویجت مدیریت ویدیوها برای المنتور
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت مدیریت ویدیوها برای المنتور
 */
class UM_Video_Widget extends \Elementor\Widget_Base {

    /**
     * نام ویجت
     * @return string
     */
    public function get_name() {
        return 'um_video';
    }

    /**
     * عنوان ویجت
     * @return string
     */
    public function get_title() {
        return um_translate('مدیریت ویدیوها', __('مدیریت ویدیوها', 'university-management'));
    }

    /**
     * آیکون ویجت
     * @return string
     */
    public function get_icon() {
        return 'eicon-video-camera';
    }

    /**
     * دسته‌بندی ویجت
     * @return array
     */
    public function get_categories() {
        return ['university-management'];
    }

    /**
     * اسکریپت‌های وابسته
     * @return array
     */
    public function get_script_depends() {
        return ['um-video-widget'];
    }

    /**
     * استایل‌های وابسته
     * @return array
     */
    public function get_style_depends() {
        return ['um-video-widget'];
    }

    /**
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_polylang_strings() {
        if (function_exists('pll_register_string')) {
            // رشته‌های بخش تنظیمات عمومی
            pll_register_string('um_video_widget_general_settings', 'تنظیمات عمومی', 'University Management');
            pll_register_string('um_video_widget_title_one', 'عنوان اول', 'University Management');
            pll_register_string('um_video_widget_default_title_one', 'لورم ایپسوم', 'University Management');
            pll_register_string('um_video_widget_title_two', 'عنوان دوم', 'University Management');
            pll_register_string('um_video_widget_default_title_two', 'صنعت آب و برق خوزستان', 'University Management');
            pll_register_string('um_video_widget_video_source', 'منبع ویدیوها', 'University Management');
            pll_register_string('um_video_widget_video_source_auto', 'خودکار (از پست‌تایپ)', 'University Management');
            pll_register_string('um_video_widget_video_source_manual', 'دستی', 'University Management');
            pll_register_string('um_video_widget_video_category', 'دسته‌بندی ویدیوها', 'University Management');
            pll_register_string('um_video_widget_videos_count', 'تعداد ویدیوها', 'University Management');

            // رشته‌های بخش ویدیوهای دستی
            pll_register_string('um_video_widget_manual_videos', 'ویدیوهای دستی', 'University Management');
            pll_register_string('um_video_widget_video_title', 'عنوان ویدیو', 'University Management');
            pll_register_string('um_video_widget_video_url', 'آدرس ویدیو (MP4)', 'University Management');
            pll_register_string('um_video_widget_video_thumbnail', 'تصویر کوچک ویدیو', 'University Management');
            pll_register_string('um_video_widget_videos', 'ویدیوها', 'University Management');
            pll_register_string('um_video_widget_default_video_title_1', 'ویدیو اول', 'University Management');
            pll_register_string('um_video_widget_default_video_title_2', 'ویدیو دوم', 'University Management');

            // رشته‌های بخش استایل
            pll_register_string('um_video_widget_style_section', 'استایل', 'University Management');
            pll_register_string('um_video_widget_title_one_color', 'رنگ عنوان اول', 'University Management');
            pll_register_string('um_video_widget_title_one_typography', 'تایپوگرافی عنوان اول', 'University Management');
            pll_register_string('um_video_widget_title_two_color', 'رنگ عنوان دوم', 'University Management');
            pll_register_string('um_video_widget_title_two_typography', 'تایپوگرافی عنوان دوم', 'University Management');
            pll_register_string('um_video_widget_category_bg_color', 'رنگ پس‌زمینه دسته‌بندی', 'University Management');
            pll_register_string('um_video_widget_category_text_color', 'رنگ متن دسته‌بندی', 'University Management');
            pll_register_string('um_video_widget_video_height', 'ارتفاع ویدیو', 'University Management');

            // رشته‌های خروجی
            pll_register_string('um_video_widget_general_category', 'عمومی', 'University Management');
            pll_register_string('um_video_widget_categories_label', 'دسته بندی ها', 'University Management');
            pll_register_string('um_video_widget_video_preview_alt', 'پیش‌نمایش ویدیو', 'University Management');
            pll_register_string('um_video_widget_play_video_title', 'پخش ویدیو', 'University Management');
            pll_register_string('um_video_widget_default_category', 'پیش‌فرض', 'University Management');
        }
    }

    /**
     * ثبت کنترل‌های ویجت
     */
    protected function _register_controls() {
        $this->register_polylang_strings();
        // بخش تنظیمات عمومی
        $this->start_controls_section(
            'section_general',
            [
                'label' => um_translate('تنظیمات عمومی', __('تنظیمات عمومی', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // عنوان اول
        $this->add_control(
            'title_one',
            [
                'label' => um_translate('عنوان اول', __('عنوان اول', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('لورم ایپسوم', __('لورم ایپسوم', 'university-management')),
            ]
        );

        // عنوان دوم
        $this->add_control(
            'title_two',
            [
                'label' => um_translate('عنوان دوم', __('عنوان دوم', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('صنعت آب و برق خوزستان', __('صنعت آب و برق خوزستان', 'university-management')),
            ]
        );

        // انتخاب نمایش خودکار یا دستی ویدیوها
        $this->add_control(
            'video_source',
            [
                'label' => um_translate('منبع ویدیوها', __('منبع ویدیوها', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => um_translate('خودکار (از پست‌تایپ)', __('خودکار (از پست‌تایپ)', 'university-management')),
                    'manual' => um_translate('دستی', __('دستی', 'university-management')),
                ],
            ]
        );

        // انتخاب دسته‌بندی ویدیوها
        $this->add_control(
            'video_category',
            [
                'label' => um_translate('دسته‌بندی ویدیوها', __('دسته‌بندی ویدیوها', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_video_categories(),
                'multiple' => false,
                'condition' => [
                    'video_source' => 'auto',
                ],
            ]
        );

        // تعداد ویدیوها برای نمایش
        $this->add_control(
            'videos_count',
            [
                'label' => um_translate('تعداد ویدیوها', __('تعداد ویدیوها', 'university-management')),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 5,
                'condition' => [
                    'video_source' => 'auto',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش ویدیوهای دستی
        $this->start_controls_section(
            'section_manual_videos',
            [
                'label' => um_translate('ویدیوهای دستی', __('ویدیوهای دستی', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'video_source' => 'manual',
                ],
            ]
        );

        // تکرارکننده برای اضافه کردن ویدیوها
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'video_title',
            [
                'label' => um_translate('عنوان ویدیو', __('عنوان ویدیو', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('عنوان ویدیو', __('عنوان ویدیو', 'university-management')),
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => um_translate('آدرس ویدیو (MP4)', __('آدرس ویدیو (MP4)', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'video_thumbnail',
            [
                'label' => um_translate('تصویر کوچک ویدیو', __('تصویر کوچک ویدیو', 'university-management')),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'manual_videos',
            [
                'label' => um_translate('ویدیوها', __('ویدیوها', 'university-management')),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'video_title' => um_translate('ویدیو اول', __('ویدیو اول', 'university-management')),
                        'video_url' => '',
                    ],
                    [
                        'video_title' => um_translate('ویدیو دوم', __('ویدیو دوم', 'university-management')),
                        'video_url' => '',
                    ],
                ],
                'title_field' => '{{{ video_title }}}',
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

        // رنگ عنوان اول
        $this->add_control(
            'title_one_color',
            [
                'label' => um_translate('رنگ عنوان اول', __('رنگ عنوان اول', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .title-one' => 'color: {{VALUE}};',
                ],
            ]
        );

        // اندازه عنوان اول
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_one_typography',
                'label' => um_translate('تایپوگرافی عنوان اول', __('تایپوگرافی عنوان اول', 'university-management')),
                'selector' => '{{WRAPPER}} .title-one',
            ]
        );

        // رنگ عنوان دوم
        $this->add_control(
            'title_two_color',
            [
                'label' => um_translate('رنگ عنوان دوم', __('رنگ عنوان دوم', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212179',
                'selectors' => [
                    '{{WRAPPER}} .title-two' => 'color: {{VALUE}};',
                ],
            ]
        );

        // اندازه عنوان دوم
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_two_typography',
                'label' => um_translate('تایپوگرافی عنوان دوم', __('تایپوگرافی عنوان دوم', 'university-management')),
                'selector' => '{{WRAPPER}} .title-two',
            ]
        );

        // رنگ پس‌زمینه دسته‌بندی
        $this->add_control(
            'category_bg_color',
            [
                'label' => um_translate('رنگ پس‌زمینه دسته‌بندی', __('رنگ پس‌زمینه دسته‌بندی', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212179',
                'selectors' => [
                    '{{WRAPPER}} .category-video' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // رنگ متن دسته‌بندی
        $this->add_control(
            'category_text_color',
            [
                'label' => um_translate('رنگ متن دسته‌بندی', __('رنگ متن دسته‌بندی', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .category-video span' => 'color: {{VALUE}};',
                ],
            ]
        );

        // ارتفاع ویدیو
        $this->add_responsive_control(
            'video_height',
            [
                'label' => um_translate('ارتفاع ویدیو', __('ارتفاع ویدیو', 'university-management')),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 550,
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * رندر کردن ویجت در فرانت‌اند
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $videos = [];

        if ($settings['video_source'] === 'auto') {
            // $cat_id = $settings['video_category']; // Ignore category from settings
            $args = [
                'post_type' => 'um_videos',
                'posts_per_page' => $settings['videos_count'],
                // 'tax_query' => [], // We fetch from all categories now
            ];

            /* We ignore the category selection to allow client-side filtering of all recent videos
            if (!empty($cat_id)) {
                $args['tax_query'][] = [
                    'taxonomy' => 'um_video_category',
                    'field' => 'term_id',
                    'terms' => $cat_id,
                ];
            }
            */

            $query = new \WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if (!$thumbnail_url) {
                        $thumbnail_url = UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg';
                    }
                    $video_url = get_post_meta(get_the_ID(), '_um_video_link', true);
                    $terms = get_the_terms(get_the_ID(), 'um_video_category');
                    $category = !empty($terms) ? $terms[0]->name : um_translate('عمومی', __('عمومی', 'university-management'));

                    if ($video_url) {
                        $videos[] = [
                            'title' => get_the_title(),
                            'src' => $video_url,
                            'thumbnail' => $thumbnail_url,
                            'category' => $category,
                        ];
                    }
                }
                wp_reset_postdata();
            }
        } else {
            if (!empty($settings['manual_videos'])) {
                foreach ($settings['manual_videos'] as $video) {
                     if (!empty($video['video_url'])) {
                        $videos[] = [
                            'title' => $video['video_title'],
                            'src' => $video['video_url'],
                            'thumbnail' => !empty($video['video_thumbnail']['url']) ? $video['video_thumbnail']['url'] : UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg',
                            'category' => um_translate('عمومی', __('عمومی', 'university-management')),
                        ];
                    }
                }
            }
        }

        $all_categories = $this->get_video_categories();
        $widget_id = 'videoApp-' . $this->get_id();
        $videos_json = esc_attr(json_encode($videos));
        $categories_json = esc_attr(json_encode($all_categories));
        ?>
        <div id="<?php echo esc_attr($widget_id); ?>" class="videoApp-container" data-videos='<?php echo $videos_json; ?>' data-categories='<?php echo $categories_json; ?>'>
            <div class="videoApp-wrapper">
                <div class="videoApp-sidebar">
                    <div class="videoApp-header">
                        <span><?php echo esc_html(um_translate('دسته بندی ها', __('دسته بندی ها', 'university-management'))); ?></span>
                        <select class="videoApp-category"></select>
                    </div>
                    <div class="videoApp-thumbnails"></div>
                </div>
                <div class="videoApp-main">
                    <img class="videoApp-preview" src="" alt="<?php echo esc_attr(um_translate('پیش‌نمایش ویدیو', __('پیش‌نمایش ویدیو', 'university-management'))); ?>">
                    <video class="videoApp-current" controls></video>
                    <div class="videoApp-playPauseBtn" title="<?php echo esc_attr(um_translate('پخش ویدیو', __('پخش ویدیو', 'university-management'))); ?>">
                        <svg width="15" height="15" viewBox="0 0 31 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28 12.3039C32 14.6133 32 20.3868 28 22.6962L9.24999 33.5215C5.24999 35.8309 0.250002 32.9441 0.250002 28.3253L0.250003 6.67467C0.250003 2.05587 5.25 -0.830872 9.25 1.47853L28 12.3039Z" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * دریافت لیست دسته‌بندی‌های ویدیو
     * @return array
     */
    private function get_video_categories() {
        $categories = array();
        
        $terms = get_terms(array(
            'taxonomy' => 'um_video_category',
            'hide_empty' => false,
        ));
        
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $categories[$term->term_id] = $term->name;
            }
        }
        
        // اگر دسته‌بندی‌ای وجود نداشت، حداقل یک گزینه پیش‌فرض اضافه کنیم
        if (empty($categories)) {
            $categories['default'] = um_translate('پیش‌فرض', __('پیش‌فرض', 'university-management'));
        }
        
        return $categories;
    }
}