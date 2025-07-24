<?php
/**
 * ویجت آزمون‌های استخدامی برای المنتور
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت آزمون‌های استخدامی برای المنتور
 */
class UM_Employment_Exams_Widget extends \Elementor\Widget_Base {

    /**
     * نام ویجت
     * @return string
     */
    public function get_name() {
        return 'um_employment_exams';
    }

    /**
     * عنوان ویجت
     * @return string
     */
    public function get_title() {
        return __('آزمون‌های استخدامی', 'university-management');
    }

    /**
     * آیکون ویجت
     * @return string
     */
    public function get_icon() {
        return 'eicon-table-of-contents';
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
        return ['um-employment-exams-widget'];
    }

    /**
     * استایل‌های وابسته
     * @return array
     */
    public function get_style_depends() {
        return ['um-employment-exams-widget'];
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

        // عنوان ویجت
        $this->add_control(
            'widget_title',
            [
                'label' => __('عنوان ویجت', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('آزمون‌های استخدامی', 'university-management'),
                'placeholder' => __('عنوان را وارد کنید', 'university-management'),
            ]
        );

        // تعداد آزمون‌ها برای نمایش
        $this->add_control(
            'exams_count',
            [
                'label' => __('تعداد آزمون‌ها', 'university-management'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 6,
            ]
        );

        // فیلتر وضعیت
        $this->add_control(
            'status_filter',
            [
                'label' => __('فیلتر وضعیت', 'university-management'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => __('همه', 'university-management'),
                    'upcoming' => __('در انتظار برگزاری', 'university-management'),
                    'registration' => __('در حال ثبت‌نام', 'university-management'),
                    'closed' => __('بسته', 'university-management'),
                    'completed' => __('برگزار شده', 'university-management'),
                ],
            ]
        );

        // نمایش نوع
        $this->add_control(
            'display_type',
            [
                'label' => __('نوع نمایش', 'university-management'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cards',
                'options' => [
                    'cards' => __('کارت‌ها', 'university-management'),
                    'table' => __('جدول', 'university-management'),
                    'list' => __('لیست', 'university-management'),
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل‌ها
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('استایل‌ها', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ پس‌زمینه
        $this->add_control(
            'background_color',
            [
                'label' => __('رنگ پس‌زمینه', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .um-employment-exams-widget' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // رنگ متن
        $this->add_control(
            'text_color',
            [
                'label' => __('رنگ متن', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .um-employment-exams-widget' => 'color: {{VALUE}};',
                ],
            ]
        );

        // رنگ اصلی
        $this->add_control(
            'primary_color',
            [
                'label' => __('رنگ اصلی', 'university-management'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0073aa',
                'selectors' => [
                    '{{WRAPPER}} .um-exam-card .exam-status' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .um-exam-card .exam-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * رندر ویجت
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // دریافت آزمون‌ها
        $args = array(
            'post_type' => 'um_employment_exams',
            'posts_per_page' => $settings['exams_count'],
            'orderby' => 'meta_value',
            'meta_key' => '_exam_date',
            'order' => 'ASC',
        );

        // اضافه کردن فیلتر وضعیت
        if ($settings['status_filter'] !== 'all') {
            $args['meta_query'] = array(
                array(
                    'key' => '_exam_status',
                    'value' => $settings['status_filter'],
                    'compare' => '='
                )
            );
        }

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            echo '<div class="um-no-exams"><p>' . __('هیچ آزمون استخدامی یافت نشد.', 'university-management') . '</p></div>';
            return;
        }

        ?>
        <div class="um-employment-exams-widget um-display-<?php echo esc_attr($settings['display_type']); ?>">
            <?php if (!empty($settings['widget_title'])) : ?>
                <h3 class="um-widget-title"><?php echo esc_html($settings['widget_title']); ?></h3>
            <?php endif; ?>

            <?php if ($settings['display_type'] === 'table') : ?>
                <?php $this->render_table_view($query); ?>
            <?php elseif ($settings['display_type'] === 'list') : ?>
                <?php $this->render_list_view($query); ?>
            <?php else : ?>
                <?php $this->render_cards_view($query); ?>
            <?php endif; ?>
        </div>
        <?php

        wp_reset_postdata();
    }

    /**
     * نمایش به صورت کارت
     */
    private function render_cards_view($query) {
        echo '<div class="um-exams-cards">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            $exam_date = get_post_meta(get_the_ID(), '_exam_date', true);
            $exam_time = get_post_meta(get_the_ID(), '_exam_time', true);
            $exam_position = get_post_meta(get_the_ID(), '_exam_position', true);
            $exam_department = get_post_meta(get_the_ID(), '_exam_department', true);
            $exam_location = get_post_meta(get_the_ID(), '_exam_location', true);
            $exam_status = get_post_meta(get_the_ID(), '_exam_status', true);
            $exam_application_deadline = get_post_meta(get_the_ID(), '_exam_application_deadline', true);
            
            $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : '';
            $deadline_display = $exam_application_deadline ? date_i18n('Y/m/d', strtotime($exam_application_deadline)) : '';
            
            $status_labels = array(
                'upcoming' => __('در انتظار برگزاری', 'university-management'),
                'registration' => __('در حال ثبت‌نام', 'university-management'),
                'closed' => __('بسته', 'university-management'),
                'completed' => __('برگزار شده', 'university-management')
            );
            $status_display = isset($status_labels[$exam_status]) ? $status_labels[$exam_status] : $exam_status;
            
            ?>
            <div class="um-exam-card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="exam-thumbnail">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="exam-content">
                    <h4 class="exam-title"><?php the_title(); ?></h4>
                    
                    <?php if ($exam_position) : ?>
                        <div class="exam-position">
                            <strong><?php _e('موقعیت:', 'university-management'); ?></strong> <?php echo esc_html($exam_position); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_department) : ?>
                        <div class="exam-department">
                            <strong><?php _e('دپارتمان:', 'university-management'); ?></strong> <?php echo esc_html($exam_department); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($date_display) : ?>
                        <div class="exam-date">
                            <strong><?php _e('تاریخ آزمون:', 'university-management'); ?></strong> <?php echo esc_html($date_display); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_location) : ?>
                        <div class="exam-location">
                            <strong><?php _e('محل برگزاری:', 'university-management'); ?></strong> <?php echo esc_html($exam_location); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($deadline_display) : ?>
                        <div class="exam-deadline">
                            <strong><?php _e('مهلت ثبت‌نام:', 'university-management'); ?></strong> <?php echo esc_html($deadline_display); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="exam-status status-<?php echo esc_attr($exam_status); ?>">
                        <?php echo esc_html($status_display); ?>
                    </div>
                    
                    <div class="exam-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        
        echo '</div>';
    }

    /**
     * نمایش به صورت جدول
     */
    private function render_table_view($query) {
        ?>
        <table class="um-exams-table">
            <thead>
                <tr>
                    <th><?php _e('عنوان آزمون', 'university-management'); ?></th>
                    <th><?php _e('موقعیت شغلی', 'university-management'); ?></th>
                    <th><?php _e('تاریخ آزمون', 'university-management'); ?></th>
                    <th><?php _e('وضعیت', 'university-management'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $exam_date = get_post_meta(get_the_ID(), '_exam_date', true);
                    $exam_time = get_post_meta(get_the_ID(), '_exam_time', true);
                    $exam_position = get_post_meta(get_the_ID(), '_exam_position', true);
                    $exam_status = get_post_meta(get_the_ID(), '_exam_status', true);
                    
                    $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : __('تاریخ نامعلوم', 'university-management');
                    
                    $status_labels = array(
                        'upcoming' => __('در انتظار برگزاری', 'university-management'),
                        'registration' => __('در حال ثبت‌نام', 'university-management'),
                        'closed' => __('بسته', 'university-management'),
                        'completed' => __('برگزار شده', 'university-management')
                    );
                    $status_display = isset($status_labels[$exam_status]) ? $status_labels[$exam_status] : $exam_status;
                    
                    ?>
                    <tr>
                        <td><?php the_title(); ?></td>
                        <td><?php echo esc_html($exam_position); ?></td>
                        <td><?php echo esc_html($date_display); ?></td>
                        <td class="status-<?php echo esc_attr($exam_status); ?>"><?php echo esc_html($status_display); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    /**
     * نمایش به صورت لیست
     */
    private function render_list_view($query) {
        echo '<ul class="um-exams-list">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            $exam_date = get_post_meta(get_the_ID(), '_exam_date', true);
            $exam_time = get_post_meta(get_the_ID(), '_exam_time', true);
            $exam_position = get_post_meta(get_the_ID(), '_exam_position', true);
            $exam_status = get_post_meta(get_the_ID(), '_exam_status', true);
            
            $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : '';
            
            $status_labels = array(
                'upcoming' => __('در انتظار برگزاری', 'university-management'),
                'registration' => __('در حال ثبت‌نام', 'university-management'),
                'closed' => __('بسته', 'university-management'),
                'completed' => __('برگزار شده', 'university-management')
            );
            $status_display = isset($status_labels[$exam_status]) ? $status_labels[$exam_status] : $exam_status;
            
            ?>
            <li class="um-exam-item status-<?php echo esc_attr($exam_status); ?>">
                <div class="exam-title"><?php the_title(); ?></div>
                <?php if ($exam_position) : ?>
                    <div class="exam-position"><?php echo esc_html($exam_position); ?></div>
                <?php endif; ?>
                <?php if ($date_display) : ?>
                    <div class="exam-date"><?php echo esc_html($date_display); ?></div>
                <?php endif; ?>
                <div class="exam-status"><?php echo esc_html($status_display); ?></div>
            </li>
            <?php
        }
        
        echo '</ul>';
    }
} 