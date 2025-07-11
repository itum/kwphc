<?php
/**
 * ویجت اسلایدر کارگاه و سمینار برای المنتور
 *
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت اسلایدر کارگاه و سمینار
 */
class UM_Seminar_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'um_seminar_slider';
    }

    public function get_title() {
        return __('اسلایدر کارگاه و سمینار', 'university-management');
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['university-management'];
    }

    public function get_script_depends() {
        return ['um-seminar-slider-widget', 'swiper', 'lucide'];
    }

    public function get_style_depends() {
        return ['um-seminar-slider-widget', 'swiper'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('محتوا', 'university-management'),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => __('عنوان اصلی', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "دوره سمینار و\nگارگاه های\nبرگزاری شده",
                'rows' => 3,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'seminar_image',
            [
                'label' => __('تصویر', 'university-management'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/63297photoqoran.jpg',
                ],
            ]
        );

        $repeater->add_control(
            'seminar_title',
            [
                'label' => __('عنوان کارگاه', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('فرانت‌اند', 'university-management'),
            ]
        );

        $repeater->add_control(
            'seminar_time',
            [
                'label' => __('زمان برگزاری', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('۱۴۰۳/۰۵/۲۰', 'university-management'),
            ]
        );

        $repeater->add_control(
            'seminar_teacher',
            [
                'label' => __('مدرس', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('مهدی بیگدلی', 'university-management'),
            ]
        );

        $repeater->add_control(
            'seminar_link',
            [
                'label' => __('لینک دکمه', 'university-management'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'university-management'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'seminars',
            [
                'label' => __('لیست کارگاه‌ها', 'university-management'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/63297photoqoran.jpg'],
                        'seminar_title' => 'فرانت‌اند',
                        'seminar_time' => '۱۴۰۳/۰۵/۲۰',
                        'seminar_teacher' => 'مهدی بیگدلی',
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_220.jpeg'],
                        'seminar_title' => 'Node.js',
                        'seminar_time' => '۱۴۰۳/۰۶/۱۰',
                        'seminar_teacher' => 'سارا سلیمانی',
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_219.jpeg'],
                        'seminar_title' => 'UI/UX',
                        'seminar_time' => '۱۴۰۳/۰۷/۰۵',
                        'seminar_teacher' => 'محمد خانی',
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_218.jpeg'],
                        'seminar_title' => 'React.js',
                        'seminar_time' => '۱۴۰۳/۰۷/۱۵',
                        'seminar_teacher' => 'لیلا نادری',
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/61270phototamdid.jpg'],
                        'seminar_title' => 'Python',
                        'seminar_time' => '۱۴۰۳/۰۸/۰۱',
                        'seminar_teacher' => 'یاسر کرمی',
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/60261savadabi.jpg'],
                        'seminar_title' => 'DevOps',
                        'seminar_time' => '۱۴۰۳/۰۸/۱۵',
                        'seminar_teacher' => 'نگین مرادی',
                    ],
                    [
                        'seminar_image' => ['url' => 'https://appwordpresss.ir/wp-content/uploads/2025/07/image_206.jpeg'],
                        'seminar_title' => 'Docker',
                        'seminar_time' => '۱۴۰۳/۰۹/۰۱',
                        'seminar_teacher' => 'حمیدرضا تهرانی',
                    ]
                ],
                'title_field' => '{{{ seminar_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'um-seminar-slider-widget');
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="container">
                <div class="header">
                    <h2>
                        <svg width="4" height="34" viewBox="0 0 4 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 2L2 18.9231" stroke="#01ADED" stroke-width="3" stroke-linecap="round"/>
                            <path d="M2 22L2 32" stroke="#9BE4FF" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <div><?php echo nl2br(esc_html($settings['main_title'])); ?></div>
                    </h2>
                    <div class="nav-buttons">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['seminars'] as $item) : ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($item['seminar_image']['url']); ?>" alt="<?php echo esc_attr($item['seminar_title']); ?>" />
                                <div class="content-wrapper">
                                    <h3><?php echo esc_html($item['seminar_title']); ?></h3>
                                    <div class="info-row">
                                        <svg width="12" height="12" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 2.38379V5.63379H7.9375M10.375 5.63379C10.375 6.27398 10.2489 6.90791 10.0039 7.49937C9.75892 8.09083 9.39983 8.62825 8.94715 9.08093C8.49446 9.53362 7.95704 9.89271 7.36558 10.1377C6.77412 10.3827 6.14019 10.5088 5.5 10.5088C4.85981 10.5088 4.22588 10.3827 3.63442 10.1377C3.04296 9.89271 2.50554 9.53362 2.05285 9.08093C1.60017 8.62825 1.24108 8.09083 0.996087 7.49937C0.751096 6.90791 0.625 6.27398 0.625 5.63379C0.625 4.34086 1.13861 3.10088 2.05285 2.18664C2.96709 1.2724 4.20707 0.758789 5.5 0.758789C6.79293 0.758789 8.03291 1.2724 8.94715 2.18664C9.86139 3.10088 10.375 4.34086 10.375 5.63379Z" stroke="#212179" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>زمان برگزاری:</span>
                                        <span style="color:#1e2a78;"><?php echo esc_html($item['seminar_time']); ?></span>
                                    </div>
                                    <div class="info-row">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.87499 3C7.87499 3.49728 7.67744 3.97419 7.32581 4.32583C6.97418 4.67746 6.49727 4.875 5.99999 4.875C5.50271 4.875 5.02579 4.67746 4.67416 4.32583C4.32253 3.97419 4.12499 3.49728 4.12499 3C4.12499 2.50272 4.32253 2.02581 4.67416 1.67417C5.02579 1.32254 5.50271 1.125 5.99999 1.125C6.49727 1.125 6.97418 1.32254 7.32581 1.67417C7.67744 2.02581 7.87499 2.50272 7.87499 3ZM2.25049 10.059C2.26656 9.07518 2.66866 8.13708 3.37008 7.44702C4.0715 6.75696 5.01603 6.37023 5.99999 6.37023C6.98394 6.37023 7.92848 6.75696 8.6299 7.44702C9.33132 8.13708 9.73342 9.07518 9.74949 10.059C8.57318 10.5984 7.29406 10.8768 5.99999 10.875C4.66199 10.875 3.39199 10.583 2.25049 10.059Z" stroke="#212179" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>مدرس:</span>
                                        <span style="color:#1e2a78;"><?php echo esc_html($item['seminar_teacher']); ?></span>
                                    </div>
                                    <?php
                                    $target = $item['seminar_link']['is_external'] ? ' target="_blank"' : '';
                                    $nofollow = $item['seminar_link']['nofollow'] ? ' rel="nofollow"' : '';
                                    ?>
                                    <a href="<?php echo esc_url($item['seminar_link']['url']); ?>" class="btn-start"<?php echo $target; ?><?php echo $nofollow; ?>>
                                        <span>شروع یادگیری</span>
                                        <i data-lucide="arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} 