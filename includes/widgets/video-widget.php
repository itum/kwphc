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
        return __('مدیریت ویدیوها', 'university-management');
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
     * ثبت کنترل‌های ویجت
     */
    protected function _register_controls() {
        // بخش تنظیمات عمومی
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('تنظیمات عمومی', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // عنوان اول
        $this->add_control(
            'title_one',
            [
                'label' => __('عنوان اول', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('لورم ایپسوم', 'university-management'),
            ]
        );

        // عنوان دوم
        $this->add_control(
            'title_two',
            [
                'label' => __('عنوان دوم', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('صنعت آب و برق خوزستان', 'university-management'),
            ]
        );

        // انتخاب نمایش خودکار یا دستی ویدیوها
        $this->add_control(
            'video_source',
            [
                'label' => __('منبع ویدیوها', 'university-management'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => __('خودکار (از پست‌تایپ)', 'university-management'),
                    'manual' => __('دستی', 'university-management'),
                ],
            ]
        );

        // انتخاب دسته‌بندی ویدیوها
        $this->add_control(
            'video_category',
            [
                'label' => __('دسته‌بندی ویدیوها', 'university-management'),
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
                'label' => __('تعداد ویدیوها', 'university-management'),
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
                'label' => __('ویدیوهای دستی', 'university-management'),
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
                'label' => __('عنوان ویدیو', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('عنوان ویدیو', 'university-management'),
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => __('آدرس ویدیو (MP4)', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'video_thumbnail',
            [
                'label' => __('تصویر کوچک ویدیو', 'university-management'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'manual_videos',
            [
                'label' => __('ویدیوها', 'university-management'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'video_title' => __('ویدیو اول', 'university-management'),
                        'video_url' => '',
                    ],
                    [
                        'video_title' => __('ویدیو دوم', 'university-management'),
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
                'label' => __('استایل', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ عنوان اول
        $this->add_control(
            'title_one_color',
            [
                'label' => __('رنگ عنوان اول', 'university-management'),
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
                'label' => __('تایپوگرافی عنوان اول', 'university-management'),
                'selector' => '{{WRAPPER}} .title-one',
            ]
        );

        // رنگ عنوان دوم
        $this->add_control(
            'title_two_color',
            [
                'label' => __('رنگ عنوان دوم', 'university-management'),
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
                'label' => __('تایپوگرافی عنوان دوم', 'university-management'),
                'selector' => '{{WRAPPER}} .title-two',
            ]
        );

        // رنگ پس‌زمینه دسته‌بندی
        $this->add_control(
            'category_bg_color',
            [
                'label' => __('رنگ پس‌زمینه دسته‌بندی', 'university-management'),
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
                'label' => __('رنگ متن دسته‌بندی', 'university-management'),
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
                'label' => __('ارتفاع ویدیو', 'university-management'),
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
     * رندر کردن خروجی ویجت
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // تعیین منبع ویدیوها
        $videos = array();
        
        if ($settings['video_source'] === 'auto') {
            // دریافت ویدیوها از پست‌تایپ
            $args = array(
                'post_type' => 'um_videos',
                'posts_per_page' => $settings['videos_count'],
                'orderby' => 'date',
                'order' => 'DESC',
            );
            
            // اگر دسته‌بندی انتخاب شده باشد
            if (!empty($settings['video_category'])) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'um_video_category',
                        'field'    => 'term_id',
                        'terms'    => $settings['video_category'],
                    ),
                );
            }
            
            $query = new \WP_Query($args);
            
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $video_link = get_post_meta(get_the_ID(), '_um_video_link', true);
                    $video_type = get_post_meta(get_the_ID(), '_um_video_type', true) ?: 'external';
                    
                    // تصویر پیش‌فرض اگر تصویر شاخص نداشت
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if (!$thumbnail) {
                        $thumbnail = UM_PLUGIN_URL . 'assets/images/video-placeholder.jpg';
                    }
                    
                    $videos[] = array(
                        'title' => get_the_title(),
                        'url' => $video_link,
                        'type' => $video_type,
                        'thumbnail' => $thumbnail,
                    );
                }
                
                wp_reset_postdata();
            }
        } else {
            // استفاده از ویدیوهای دستی
            foreach ($settings['manual_videos'] as $video) {
                $videos[] = array(
                    'title' => $video['video_title'],
                    'url' => $video['video_url'],
                    'thumbnail' => $video['video_thumbnail']['url'],
                );
            }
        }
        
        // دریافت دسته‌بندی‌های ویدیو
        $categories = $this->get_video_categories();
        
        // ایجاد کلاس‌های استایل
        $this->add_render_attribute('wrapper', 'class', 'video-section');
        
        // رندر HTML
        ?>
        <section <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <!-- عنوان و دسته‌بندی -->
            <div class="top-bar">
                <div class="title-video">
                    <svg width="4" height="34" viewBox="0 0 4 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 2L2 18.9231" stroke="#01ADED" stroke-width="3" stroke-linecap="round"/>
                        <path d="M2 22L2 32" stroke="#9BE4FF" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                    <h2 class="title-one"><?php echo esc_html($settings['title_one']); ?></h2>
                    <h2 class="title-two"><?php echo esc_html($settings['title_two']); ?></h2>
                </div>
                <div class="category-video">
                    <span><?php _e('دسته‌بندی', 'university-management'); ?></span>
                    <select id="categorySelect">
                        <?php foreach ($categories as $id => $name) : ?>
                            <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- بخش ویدیو -->
            <div class="video-wrapper" id="videoWrapper">
                <?php if (!empty($videos)) : ?>
                    <video id="mainVideo" poster="<?php echo esc_url($videos[0]['thumbnail']); ?>">
                        <source src="<?php echo esc_url($videos[0]['url']); ?>" type="video/mp4">
                    </video>
                    <button id="playBtn" class="play-btn">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="40" fill="white" fill-opacity="0.5"/>
                            <path d="M53.5 37.4019C55.5 38.5566 55.5 41.4434 53.5 42.5981L35 53.3923C33 54.547 30.5 53.1036 30.5 50.7942L30.5 29.2058C30.5 26.8964 33 25.453 35 26.6077L53.5 37.4019Z" fill="white"/>
                        </svg>
                    </button>
                    <button id="pauseBtn" class="pause-btn">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="40" fill="white" fill-opacity="0.5"/>
                            <rect x="30" y="26" width="8" height="28" rx="2" fill="white"/>
                            <rect x="42" y="26" width="8" height="28" rx="2" fill="white"/>
                        </svg>
                    </button>

                    <div id="thumbnails" class="thumbnails">
                        <?php foreach ($videos as $index => $video) : ?>
                            <img src="<?php echo esc_url($video['thumbnail']); ?>" 
                                 alt="<?php echo esc_attr($video['title']); ?>" 
                                 data-video="<?php echo esc_url($video['url']); ?>"
                                 class="<?php echo ($index === 0) ? 'active' : ''; ?>">
                        <?php endforeach; ?>
                    </div>

                    <a href="#" class="view-all">
                        <?php _e('مشاهده همه', 'university-management'); ?>
                        <svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 7L26 7" stroke="#C4C4C4" stroke-opacity="0.3" stroke-width="2"/>
                            <path d="M1.96435 10.4459C-0.654782 8.91436 -0.654782 5.08563 1.96435 3.55414L7.11432 0.539012C9.73345 -0.99248 13 0.921884 13 3.98486V10.0151C13 13.0781 9.73345 14.9925 7.11432 13.461L1.96435 10.4459Z" fill="white"/>
                        </svg>
                    </a>
                <?php else : ?>
                    <div class="no-videos"><?php _e('هیچ ویدیویی یافت نشد.', 'university-management'); ?></div>
                <?php endif; ?>
            </div>
        </section>

        <script>
        jQuery(document).ready(function($) {
            // تعریف متغیرها
            var videoWrapper = $('#videoWrapper');
            var mainVideo = $('#mainVideo')[0];
            var mainVideoSource = $('#mainVideo source');
            var playBtn = $('#playBtn');
            var pauseBtn = $('#pauseBtn');
            var thumbnails = $('#thumbnails img');
            var currentVideoIndex = 0;
            
            // ذخیره داده‌های ویدیو
            var videoData = {
                'default': [
                    <?php foreach ($videos as $index => $video) : ?>
                    {
                        src: '<?php echo esc_url($video['url']); ?>',
                        thumb: '<?php echo esc_url($video['thumbnail']); ?>',
                        title: '<?php echo esc_js($video['title']); ?>'
                    }<?php echo ($index < count($videos) - 1) ? ',' : ''; ?>
                    <?php endforeach; ?>
                ]
            };
            
            // کلیک روی دکمه پخش
            playBtn.click(function() {
                var videos = videoData['default'];
                if (videos && videos.length > 0) {
                    playVideoFromThumb(videos[currentVideoIndex].src, videos[currentVideoIndex].thumb);
                }
            });
            
            // کلیک روی دکمه توقف
            pauseBtn.click(function() {
                mainVideo.pause();
                playBtn.show();
                videoWrapper.removeClass('playing');
            });
            
            // پایان ویدیو
            mainVideo.addEventListener('ended', function() {
                videoWrapper.removeClass('playing');
                pauseBtn.hide();
                playBtn.show();
            });
            
            // کلیک روی تصاویر بندانگشتی
            thumbnails.click(function() {
                var index = $(this).index();
                currentVideoIndex = index;
                var videos = videoData['default'];
                if (videos && videos.length > index) {
                    playVideoFromThumb(videos[index].src, videos[index].thumb);
                }
                
                // فعال کردن تصویر بندانگشتی
                thumbnails.removeClass('active');
                $(this).addClass('active');
            });
            
            // تابع پخش ویدیو از تصویر بندانگشتی
            function playVideoFromThumb(src, thumb) {
                mainVideoSource.attr('src', src);
                mainVideo.poster = thumb;
                mainVideo.load();
                mainVideo.play();
                playBtn.hide();
                videoWrapper.addClass('playing');
            }
            
            // تغییر دسته‌بندی
            $('#categorySelect').change(function() {
                var categoryId = $(this).val();
                
                // ارسال درخواست AJAX برای دریافت ویدیوهای دسته‌بندی
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'um_get_videos_by_category',
                        category_id: categoryId,
                        nonce: '<?php echo wp_create_nonce('um_video_nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            // بروزرسانی داده‌های ویدیو
                            videoData['default'] = response.data;
                            
                            // بازنشانی ویدیو اصلی
                            currentVideoIndex = 0;
                            if (response.data.length > 0) {
                                mainVideoSource.attr('src', response.data[0].src);
                                mainVideo.poster = response.data[0].thumb;
                                mainVideo.load();
                                
                                // بروزرسانی تصاویر بندانگشتی
                                var thumbnailsHtml = '';
                                $.each(response.data, function(index, video) {
                                    thumbnailsHtml += '<img src="' + video.thumb + '" alt="' + video.title + '" class="' + (index === 0 ? 'active' : '') + '">';
                                });
                                $('#thumbnails').html(thumbnailsHtml);
                                
                                // اتصال مجدد رویدادها
                                thumbnails = $('#thumbnails img');
                                thumbnails.click(function() {
                                    var index = $(this).index();
                                    currentVideoIndex = index;
                                    playVideoFromThumb(videoData['default'][index].src, videoData['default'][index].thumb);
                                    thumbnails.removeClass('active');
                                    $(this).addClass('active');
                                });
                            } else {
                                $('#thumbnails').html('<div class="no-videos"><?php _e('هیچ ویدیویی در این دسته‌بندی یافت نشد.', 'university-management'); ?></div>');
                            }
                        }
                    }
                });
            });
        });
        </script>
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
            $categories['default'] = __('پیش‌فرض', 'university-management');
        }
        
        return $categories;
    }
}