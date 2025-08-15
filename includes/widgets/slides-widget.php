<?php
/**
 * ویجت اسلایدها (هماهنگ با المنتور پیشفرض) اما خواندن خودکار از پست‌تایپ um_slides
 */

if (!defined('ABSPATH')) { exit; }

class UM_Slides_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'um_slides';
    }

    public function get_title() {
        return um_translate('اسلایدهای سایت', __('اسلایدهای سایت', 'university-management'));
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['university-management'];
    }

    public function get_script_depends() {
        return ['swiper', 'um-slides-widget'];
    }

    public function get_style_depends() {
        return ['swiper', 'um-slides-widget'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => um_translate('محتوا', __('محتوا', 'university-management')),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('source', [
            'label' => um_translate('منبع اسلایدها', __('منبع اسلایدها', 'university-management')),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'auto',
            'options' => [
                'auto' => um_translate('خودکار (از پست‌تایپ)', __('خودکار (از پست‌تایپ)', 'university-management')),
                'manual' => um_translate('دستی', __('دستی', 'university-management')),
            ],
        ]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('image', [
            'label' => __('تصویر', 'university-management'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);
        $repeater->add_control('title', [
            'label' => __('عنوان', 'university-management'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('عنوان اسلاید', 'university-management'),
        ]);
        $repeater->add_control('description', [
            'label' => __('توضیحات', 'university-management'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 3,
        ]);
        $repeater->add_control('button_text', [
            'label' => __('متن دکمه', 'university-management'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('بیشتر', 'university-management'),
        ]);
        $repeater->add_control('link', [
            'label' => __('لینک', 'university-management'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => 'https://',
        ]);

        $this->add_control('slides', [
            'label' => __('اسلایدها', 'university-management'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
            'condition' => [ 'source' => 'manual' ],
        ]);

        $this->add_control('posts_per_page', [
            'label' => __('تعداد نمایش', 'university-management'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5,
            'min' => 1,
            'max' => 20,
            'condition' => [ 'source' => 'auto' ],
        ]);

        $this->end_controls_section();
    }

    private function get_cpt_slides($limit = 5) {
        $args = array(
            'post_type' => 'um_slides',
            'posts_per_page' => $limit,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_status' => 'publish',
        );
        if (function_exists('pll_current_language')) {
            $args['lang'] = pll_current_language();
        }
        $query = new WP_Query($args);
        $items = [];
        while ($query->have_posts()) { $query->the_post();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $items[] = [
                'image' => $image,
                'title' => get_the_title(),
                'description' => get_the_excerpt(),
                'button_text' => get_post_meta(get_the_ID(), '_slide_button_text', true),
                'link' => [ 'url' => get_post_meta(get_the_ID(), '_slide_link_url', true), 'is_external' => (bool)get_post_meta(get_the_ID(), '_slide_open_new', true) ],
            ];
        }
        wp_reset_postdata();
        return $items;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $slides = [];
        if ($settings['source'] === 'auto') {
            $slides = $this->get_cpt_slides(!empty($settings['posts_per_page']) ? intval($settings['posts_per_page']) : 5);
        } else {
            $slides = $settings['slides'];
        }

        if (empty($slides)) {
            echo '<div class="um-slides-empty">' . esc_html__('اسلایدی یافت نشد.', 'university-management') . '</div>';
            return;
        }

        echo '<div class="um-slides-widget swiper">';
        echo '<div class="swiper-wrapper">';
        foreach ($slides as $slide) {
            $image = is_array($slide) && isset($slide['image']['url']) ? $slide['image']['url'] : (isset($slide['image']) ? $slide['image'] : '');
            $title = isset($slide['title']) ? $slide['title'] : '';
            $desc = isset($slide['description']) ? $slide['description'] : '';
            $btn = isset($slide['button_text']) ? $slide['button_text'] : '';
            $link = isset($slide['link']['url']) ? $slide['link']['url'] : (isset($slide['link']) ? $slide['link'] : '');
            $ext = isset($slide['link']['is_external']) ? (bool)$slide['link']['is_external'] : false;

            echo '<div class="swiper-slide um-slide-item" style="background-image:url(' . esc_url($image) . ');">';
            echo '<div class="um-slide-content">';
            if ($title) echo '<h3>' . esc_html($title) . '</h3>';
            if ($desc) echo '<p>' . esc_html($desc) . '</p>';
            if ($btn && $link) {
                $target = $ext ? ' target="_blank" rel="noopener"' : '';
                echo '<a class="um-slide-btn" href="' . esc_url($link) . '"' . $target . '>' . esc_html($btn) . '</a>';
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="swiper-pagination"></div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
        echo '</div>';

        ?>
        <script>
        (function(){
            if (window.Swiper) {
                new Swiper('.um-slides-widget', { loop: true, pagination: { el: '.swiper-pagination', clickable: true }, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' } });
            }
        })();
        </script>
        <?php
    }
}


