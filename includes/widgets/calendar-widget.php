<?php
/**
 * ویجت تقویم دانشگاه برای المنتور
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit; // خروج در صورت دسترسی مستقیم
}

/**
 * کلاس ویجت تقویم برای المنتور
 */
class UM_Calendar_Widget extends \Elementor\Widget_Base {

    /**
     * نام ویجت
     * @return string
     */
    public function get_name() {
        return 'um_calendar';
    }

    /**
     * عنوان ویجت
     * @return string
     */
    public function get_title() {
        return um_translate('تقویم دانشگاه', __('تقویم دانشگاه', 'university-management'));
    }

    /**
     * آیکون ویجت
     * @return string
     */
    public function get_icon() {
        return 'eicon-calendar';
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
        return ['um-calendar-widget'];
    }

    /**
     * استایل‌های وابسته
     * @return array
     */
    public function get_style_depends() {
        return ['um-calendar-widget'];
    }

    /**
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_polylang_strings() {
        if (function_exists('pll_register_string')) {
            // رشته‌های بخش تنظیمات عمومی
            pll_register_string('um_calendar_widget_general_settings', 'تنظیمات عمومی', 'University Management');
            pll_register_string('um_calendar_widget_event_source', 'منبع رویدادها', 'University Management');
            pll_register_string('um_calendar_widget_event_source_auto', 'خودکار (از پست‌تایپ)', 'University Management');
            pll_register_string('um_calendar_widget_event_source_manual', 'دستی', 'University Management');
            pll_register_string('um_calendar_widget_events_count', 'تعداد رویدادها', 'University Management');

            // رشته‌های بخش رویدادهای دستی
            pll_register_string('um_calendar_widget_manual_events', 'رویدادهای دستی', 'University Management');
            pll_register_string('um_calendar_widget_event_date', 'تاریخ رویداد', 'University Management');
            pll_register_string('um_calendar_widget_event_title', 'عنوان رویداد', 'University Management');
            pll_register_string('um_calendar_widget_is_important', 'رویداد مهم (هایلایت)', 'University Management');
            pll_register_string('um_calendar_widget_yes', 'بله', 'University Management');
            pll_register_string('um_calendar_widget_no', 'خیر', 'University Management');
            pll_register_string('um_calendar_widget_events', 'رویدادها', 'University Management');
            pll_register_string('um_calendar_widget_default_event_title_1', 'شروع کلاس‌ها', 'University Management');
            pll_register_string('um_calendar_widget_default_event_title_2', 'ارائه پروژه', 'University Management');
            pll_register_string('um_calendar_widget_default_event_title_3', 'میان‌ترم', 'University Management');
            pll_register_string('um_calendar_widget_event_description', 'توضیحات رویداد', 'University Management');

            // رشته‌های بخش استایل
            pll_register_string('um_calendar_widget_style_section', 'استایل', 'University Management');
            pll_register_string('um_calendar_widget_highlight_color', 'رنگ هایلایت', 'University Management');
            pll_register_string('um_calendar_widget_text_color', 'رنگ متن', 'University Management');
            pll_register_string('um_calendar_widget_highlight_text_color', 'رنگ متن هایلایت', 'University Management');
            pll_register_string('um_calendar_widget_day_color', 'رنگ عدد روز', 'University Management');
            pll_register_string('um_calendar_widget_event_padding', 'پدینگ رویداد', 'University Management');

            // رشته‌های خروجی
            pll_register_string('um_calendar_widget_no_events_found', 'هیچ رویدادی یافت نشد.', 'University Management');
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

        // انتخاب نمایش خودکار یا دستی رویدادها
        $this->add_control(
            'event_source',
            [
                'label' => um_translate('منبع رویدادها', um_translate('منبع رویدادها', __('منبع رویدادها', 'university-management'))),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => um_translate('خودکار (از پست‌تایپ)', um_translate('خودکار (از پست‌تایپ)', __('خودکار (از پست‌تایپ)', 'university-management'))),
                    'manual' => um_translate('دستی', um_translate('دستی', __('دستی', 'university-management'))),
                ],
            ]
        );

        // تعداد رویدادها برای نمایش
        $this->add_control(
            'events_count',
            [
                'label' => um_translate('تعداد رویدادها', __('تعداد رویدادها', 'university-management')),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 6,
                'condition' => [
                    'event_source' => 'auto',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش رویدادهای دستی (اگر منبع دستی انتخاب شده باشد)
        $this->start_controls_section(
            'section_manual_events',
            [
                'label' => um_translate('رویدادهای دستی', __('رویدادهای دستی', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'event_source' => 'manual',
                ],
            ]
        );

        // تکرارکننده برای اضافه کردن رویدادها
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'event_date',
            [
                'label' => um_translate('تاریخ رویداد', __('تاریخ رویداد', 'university-management')),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => date('Y-m-d'),
            ]
        );

        $repeater->add_control(
            'event_title',
            [
                'label' => um_translate('عنوان رویداد', __('عنوان رویداد', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('عنوان رویداد', __('عنوان رویداد', 'university-management')),
            ]
        );

        $repeater->add_control(
            'is_important',
            [
                'label' => um_translate('رویداد مهم (هایلایت)', __('رویداد مهم (هایلایت)', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('بله', __('بله', 'university-management')),
                'label_off' => um_translate('خیر', __('خیر', 'university-management')),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'event_description',
            [
                'label' => um_translate('توضیحات رویداد', __('توضیحات رویداد', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => um_translate('توضیحات رویداد', __('توضیحات رویداد', 'university-management')),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'manual_events',
            [
                'label' => um_translate('رویدادها', __('رویدادها', 'university-management')),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'event_date' => date('Y-m-d'),
                        'event_title' => um_translate('شروع کلاس‌ها', __('شروع کلاس‌ها', 'university-management')),
                        'is_important' => 'yes',
                        'event_description' => um_translate('کلاس‌های ترم جدید آغاز می‌شوند.', __('کلاس‌های ترم جدید آغاز می‌شوند.', 'university-management')),
                    ],
                    [
                        'event_date' => date('Y-m-d', strtotime('+10 days')),
                        'event_title' => um_translate('ارائه پروژه', __('ارائه پروژه', 'university-management')),
                        'is_important' => '',
                        'event_description' => um_translate('آخرین مهلت برای ارائه پروژه‌های درسی.', __('آخرین مهلت برای ارائه پروژه‌های درسی.', 'university-management')),
                    ],
                    [
                        'event_date' => date('Y-m-d', strtotime('+20 days')),
                        'event_title' => um_translate('میان‌ترم', __('میان‌ترم', 'university-management')),
                        'is_important' => '',
                        'event_description' => um_translate('برگزاری آزمون‌های میان‌ترم.', __('برگزاری آزمون‌های میان‌ترم.', 'university-management')),
                    ],
                ],
                'title_field' => '{{{ event_title }}}',
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

        // رنگ هایلایت
        $this->add_control(
            'highlight_color',
            [
                'label' => um_translate('رنگ هایلایت', __('رنگ هایلایت', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212179',
                'selectors' => [
                    '{{WRAPPER}} .event-cal.blue' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .event-cal:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .event-cal .icon-cal .svg1 path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // رنگ متن
        $this->add_control(
            'text_color',
            [
                'label' => um_translate('رنگ متن', __('رنگ متن', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .event-cal' => 'color: {{VALUE}};',
                ],
            ]
        );

        // رنگ متن هایلایت
        $this->add_control(
            'highlight_text_color',
            [
                'label' => um_translate('رنگ متن هایلایت', __('رنگ متن هایلایت', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .event-cal.blue' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .event-cal:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        // رنگ روز
        $this->add_control(
            'day_color',
            [
                'label' => um_translate('رنگ عدد روز', __('رنگ عدد روز', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#BE0000',
                'selectors' => [
                    '{{WRAPPER}} .day-cal' => 'color: {{VALUE}};',
                ],
            ]
        );

        // تنظیمات فاصله‌ها
        $this->add_responsive_control(
            'event_padding',
            [
                'label' => um_translate('پدینگ رویداد', __('پدینگ رویداد', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .event-cal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true,
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
        
        // تعیین منبع رویدادها
        $events = array();
        
        if ($settings['event_source'] === 'auto') {
            // دریافت رویدادها از پست‌تایپ
            $args = array(
                'post_type' => 'um_calendar_events',
                'posts_per_page' => $settings['events_count'],
                'orderby' => 'meta_value',
                'meta_key' => '_event_date',
                'order' => 'ASC',
            );
            
            // فیلتر بر اساس زبان فعلی (اگر Polylang فعال باشد)
            if (function_exists('pll_current_language')) {
                $current_lang = pll_current_language();
                error_log('=== CALENDAR WIDGET LANGUAGE DEBUG ===');
                error_log('Current Language: ' . $current_lang);
                
                if ($current_lang) {
                    // دریافت رویدادها با محدودیت (کش غیرفعال موقت)
                    $all_events = new WP_Query(array(
                        'post_type' => 'um_calendar_events',
                        'posts_per_page' => 100, // محدود کردن به 100 رویداد
                        'orderby' => 'meta_value',
                        'meta_key' => '_event_date',
                        'order' => 'ASC',
                    ));
                    
                    // فیلتر بر اساس زبان
                    $filtered_posts = array();
                    if ($all_events->have_posts()) {
                        while ($all_events->have_posts()) {
                            $all_events->the_post();
                            $post_lang = pll_get_post_language(get_the_ID());
                            
                            if ($post_lang === $current_lang) {
                                $filtered_posts[] = get_the_ID();
                            }
                        }
                        wp_reset_postdata();
                    }
                    
                    // کوئری جدید با پست‌های فیلتر شده
                    if (!empty($filtered_posts)) {
                        $args = array(
                            'post_type' => 'um_calendar_events',
                            'posts_per_page' => $settings['events_count'],
                            'orderby' => 'meta_value',
                            'meta_key' => '_event_date',
                            'order' => 'ASC',
                            'post__in' => $filtered_posts,
                        );
                        error_log('Filtered Posts Found: ' . count($filtered_posts));
                    } else {
                        // اگر هیچ پستی با زبان فعلی نباشد، کوئری خالی
                        $args = array(
                            'post_type' => 'um_calendar_events',
                            'posts_per_page' => $settings['events_count'],
                            'post__in' => array(0), // هیچ پستی
                        );
                        error_log('No posts found for current language');
                    }
                }
            }
            
            // کش کردن کوئری نهایی (غیرفعال موقت برای تست)
            $query = new \WP_Query($args);
            
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                    $is_important = get_post_meta(get_the_ID(), '_is_important', true);
                    
                    $events[] = array(
                        'date' => $event_date,
                        'title' => get_the_title(),
                        'important' => $is_important,
                        'description' => get_the_excerpt(),
                    );
                }
                
                wp_reset_postdata();
            }
        } else {
            // استفاده از رویدادهای دستی
            foreach ($settings['manual_events'] as $event) {
                $events[] = array(
                    'date' => $event['event_date'],
                    'title' => $event['event_title'],
                    'important' => isset($event['is_important']) ? $event['is_important'] : 'no',
                    'description' => isset($event['event_description']) ? $event['event_description'] : '',
                );
            }
        }
        
        // تبدیل رویدادها بر اساس زبان فعلی و مرتب‌سازی
        $converted_events = array();
        
        foreach ($events as $event) {
            $converted_date = $this->convert_date_by_language($event['date']);
            
            $converted_events[] = array(
                'day' => $converted_date['day'],
                'month' => $converted_date['month'],
                'year' => $converted_date['year'],
                'month_number' => $converted_date['month_number'],
                'title' => $event['title'],
                'important' => isset($event['important']) ? $event['important'] : 'no',
                'description' => isset($event['description']) ? $event['description'] : '',
            );
        }
        
        // مرتب‌سازی رویدادها بر اساس تاریخ
        usort($converted_events, function($a, $b) {
            if ($a['year'] != $b['year']) {
                return $a['year'] - $b['year'];
            }
            
            $month_diff = $a['month_number'] - $b['month_number'];
            if ($month_diff != 0) {
                return $month_diff;
            }
            
            return $a['day'] - $b['day'];
        });
        
        // ایجاد کلاس‌های استایل
        $this->add_render_attribute('wrapper', 'class', 'timeline-cal');
        
        // رندر HTML
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php 
            // همه رویدادها را در یک wrapper نمایش می‌دهیم
            if (!empty($converted_events)) {
                ?>
                <div class="wrapper-cal">
                    <?php foreach ($converted_events as $event) { ?>
                            <div class="event-cal<?php echo (isset($event['important']) && $event['important'] === 'yes') ? ' blue' : ''; ?>" data-title="<?php echo esc_attr($event['title']); ?>" data-time="<?php echo esc_attr($event['day'] . ' ' . $event['month'] . ' - ' . $event['year']); ?>" data-description="<?php echo esc_attr($event['description']); ?>">
                                <div class="day-cal"><?php echo esc_html($event['day']); ?></div>
                                <div class="month-year"><?php echo esc_html($event['month'] . ' - ' . $event['year']); ?></div>
                                <div class="icon-cal">
                                    <svg class="svg1" width="61" height="27" viewBox="0 0 61 27" fill="white" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_464_337)">
                                            <rect width="1440" height="8024" transform="translate(-1070 -2881)" fill="white"/>
                                            <g opacity="0.19"></g>
                                            <path d="M25.4645 4.53554C27.4171 2.58291 30.5829 2.58291 32.5355 4.53553L37.4645 9.46446C39.4171 11.4171 39.4171 14.5829 37.4645 16.5355L32.5355 21.4645C30.5829 23.4171 27.4171 23.4171 25.4645 21.4645L20.5355 16.5355C18.5829 14.5829 18.5829 11.4171 20.5355 9.46447L25.4645 4.53554Z" fill="#212179"/>
                                            <path d="M26.8787 9.12132C28.0503 7.94975 29.9497 7.94975 31.1213 9.12132L32.8787 10.8787C34.0503 12.0503 34.0503 13.9497 32.8787 15.1213L31.1213 16.8787C29.9497 18.0503 28.0503 18.0503 26.8787 16.8787L25.1213 15.1213C23.9497 13.9497 23.9497 12.0503 25.1213 10.8787L26.8787 9.12132Z" fill="white"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_464_337">
                                                <rect width="1440" height="8024" fill="white" transform="translate(-1070 -2881)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg class="svg2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.46446 3.53554C10.4171 1.58291 13.5829 1.58291 15.5355 3.53553L20.4645 8.46446C22.4171 10.4171 22.4171 13.5829 20.4645 15.5355L15.5355 20.4645C13.5829 22.4171 10.4171 22.4171 8.46447 20.4645L3.53554 15.5355C1.58291 13.5829 1.58291 10.4171 3.53553 8.46447L8.46446 3.53554Z" fill="white"/>
                                        <path d="M9.87868 8.12132C11.0503 6.94975 12.9497 6.94975 14.1213 8.12132L15.8787 9.87868C17.0503 11.0503 17.0503 12.9497 15.8787 14.1213L14.1213 15.8787C12.9497 17.0503 11.0503 17.0503 9.87868 15.8787L8.12132 14.1213C6.94975 12.9497 6.94975 11.0503 8.12132 9.87868L9.87868 8.12132Z" fill="#212179"/>
                                    </svg>
                                </div>
                                <div class="label-cal"><?php echo esc_html($event['title']); ?></div>
                            </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="um-no-events">
                    <?php echo esc_html(um_translate('هیچ رویدادی یافت نشد.', __('هیچ رویدادی یافت نشد.', 'university-management'))); ?>
                </div>
            <?php } ?>
        </div>

        <!-- Modal Structure -->
        <div id="eventModal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <h2 id="modalTitle"></h2>
                <p id="modalTime"></p>
                <p id="modalDescription"></p>
            </div>
        </div>
        <?php
    }

    /**
     * تبدیل تاریخ بر اساس زبان فعلی
     * @param string $date تاریخ میلادی
     * @return array آرایه شامل روز، ماه، سال و نام ماه
     */
    private function convert_date_by_language($date) {
        $timestamp = strtotime($date);
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);
        $day = date('d', $timestamp);
        
        // دریافت زبان فعلی
        $current_lang = 'fa'; // پیش‌فرض فارسی
        if (function_exists('pll_current_language')) {
            $current_lang = pll_current_language();
        }
        
        switch ($current_lang) {
            case 'fa':
                // تقویم شمسی برای فارسی
                return $this->convert_to_jalaali($year, $month, $day);
                
            case 'en':
                // تقویم میلادی برای انگلیسی
                return $this->convert_to_gregorian($year, $month, $day);
                
            case 'ar':
                // تقویم هجری قمری برای عربی
                return $this->convert_to_hijri($year, $month, $day);
                
            default:
                // پیش‌فرض شمسی
                return $this->convert_to_jalaali($year, $month, $day);
        }
    }

    /**
     * تبدیل به تقویم شمسی
     */
    private function convert_to_jalaali($year, $month, $day) {
        $jalaali = $this->gregorian_to_jalaali($year, $month, $day);
        $month_name = $this->get_jalaali_month_name($jalaali['month']);
        
        return [
            'day' => $jalaali['day'],
            'month' => $month_name,
            'year' => $jalaali['year'],
            'month_number' => $jalaali['month']
        ];
    }

    /**
     * تبدیل به تقویم میلادی
     */
    private function convert_to_gregorian($year, $month, $day) {
        $month_name = $this->get_gregorian_month_name($month);
        
        return [
            'day' => $day,
            'month' => $month_name,
            'year' => $year,
            'month_number' => $month
        ];
    }

    /**
     * تبدیل به تقویم هجری قمری
     */
    private function convert_to_hijri($year, $month, $day) {
        $hijri = $this->gregorian_to_hijri($year, $month, $day);
        $month_name = $this->get_hijri_month_name($hijri['month']);
        
        return [
            'day' => $hijri['day'],
            'month' => $month_name,
            'year' => $hijri['year'],
            'month_number' => $hijri['month']
        ];
    }

    /**
     * تبدیل تاریخ میلادی به جلالی
     * @param int $g_y سال میلادی
     * @param int $g_m ماه میلادی
     * @param int $g_d روز میلادی
     * @return array تاریخ جلالی (سال، ماه، روز)
     */
    private function gregorian_to_jalaali($g_y, $g_m, $g_d) {
        $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        
        $gy = $g_y - 1600;
        $gm = $g_m - 1;
        $gd = $g_d - 1;
        
        $g_day_no = 365 * $gy + intval(($gy + 3) / 4) - intval(($gy + 99) / 100) + intval(($gy + 399) / 400);
        
        for ($i = 0; $i < $gm; ++$i)
            $g_day_no += $g_days_in_month[$i];
        
        if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
            $g_day_no++;
        
        $g_day_no += $gd;
        
        $j_day_no = $g_day_no - 79;
        
        $j_np = intval($j_day_no / 12053);
        $j_day_no %= 12053;
        
        $jy = 979 + 33 * $j_np + 4 * intval($j_day_no / 1461);
        
        $j_day_no %= 1461;
        
        if ($j_day_no >= 366) {
            $jy += intval(($j_day_no - 1) / 365);
            $j_day_no = ($j_day_no - 1) % 365;
        }
        
        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
            $j_day_no -= $j_days_in_month[$i];
        
        $jm = $i + 1;
        $jd = $j_day_no + 1;
        
        return ['year' => $jy, 'month' => $jm, 'day' => $jd];
    }

    /**
     * تبدیل تاریخ میلادی به هجری قمری
     * @param int $g_y سال میلادی
     * @param int $g_m ماه میلادی
     * @param int $g_d روز میلادی
     * @return array تاریخ هجری قمری (سال، ماه، روز)
     */
    private function gregorian_to_hijri($g_y, $g_m, $g_d) {
        if (($g_y > 1582) || (($g_y == 1582) && ($g_m > 10)) || (($g_y == 1582) && ($g_m == 10) && ($g_d > 14))) {
            $jd = intval((1461 * ($g_y + 4800 + intval(($g_m - 14) / 12))) / 4) + intval((367 * ($g_m - 2 - 12 * intval(($g_m - 14) / 12))) / 12) - intval((3 * intval(($g_y + 4900 + intval(($g_m - 14) / 12)) / 100)) / 4) + $g_d - 32075;
        } else {
            $jd = 367 * $g_y - intval((7 * ($g_y + 5001 + intval(($g_m - 9) / 7))) / 4) + intval((275 * $g_m) / 9) + $g_d + 1729777;
        }
        
        $l = $jd + 68569;
        $n = intval((4 * $l) / 146097);
        $l = $l - intval((146097 * $n + 3) / 4);
        $i = intval((4000 * ($l + 1)) / 1461001);
        $l = $l - intval((1461 * $i) / 4) + 31;
        $j = intval((80 * $l) / 2447);
        $k = $l - intval((2447 * $j) / 80);
        $l = intval($j / 11);
        $j = $j + 2 - 12 * $l;
        $i = 100 * ($n - 49) + $i + $l;
        
        $h_y = $i;
        $h_m = $j;
        $h_d = $k;
        
        return ['year' => $h_y, 'month' => $h_m, 'day' => $h_d];
    }

    /**
     * دریافت نام ماه شمسی
     * @param int $month شماره ماه
     * @return string نام ماه
     */
    private function get_jalaali_month_name($month) {
        $months = [
            1 => um_translate('فروردین', 'فروردین'),
            2 => um_translate('اردیبهشت', 'اردیبهشت'),
            3 => um_translate('خرداد', 'خرداد'),
            4 => um_translate('تیر', 'تیر'),
            5 => um_translate('مرداد', 'مرداد'),
            6 => um_translate('شهریور', 'شهریور'),
            7 => um_translate('مهر', 'مهر'),
            8 => um_translate('آبان', 'آبان'),
            9 => um_translate('آذر', 'آذر'),
            10 => um_translate('دی', 'دی'),
            11 => um_translate('بهمن', 'بهمن'),
            12 => um_translate('اسفند', 'اسفند'),
        ];
        
        return isset($months[$month]) ? $months[$month] : '';
    }

    /**
     * دریافت نام ماه میلادی
     * @param int $month شماره ماه
     * @return string نام ماه
     */
    private function get_gregorian_month_name($month) {
        $months = [
            1 => um_translate('January', 'January'),
            2 => um_translate('February', 'February'),
            3 => um_translate('March', 'March'),
            4 => um_translate('April', 'April'),
            5 => um_translate('May', 'May'),
            6 => um_translate('June', 'June'),
            7 => um_translate('July', 'July'),
            8 => um_translate('August', 'August'),
            9 => um_translate('September', 'September'),
            10 => um_translate('October', 'October'),
            11 => um_translate('November', 'November'),
            12 => um_translate('December', 'December'),
        ];
        
        return isset($months[$month]) ? $months[$month] : '';
    }

    /**
     * دریافت نام ماه هجری قمری
     * @param int $month شماره ماه
     * @return string نام ماه
     */
    private function get_hijri_month_name($month) {
        $months = [
            1 => um_translate('محرم', 'محرم'),
            2 => um_translate('صفر', 'صفر'),
            3 => um_translate('ربیع‌الاول', 'ربیع‌الاول'),
            4 => um_translate('ربیع‌الثانی', 'ربیع‌الثانی'),
            5 => um_translate('جمادی‌الاول', 'جمادی‌الاول'),
            6 => um_translate('جمادی‌الثانی', 'جمادی‌الثانی'),
            7 => um_translate('رجب', 'رجب'),
            8 => um_translate('شعبان', 'شعبان'),
            9 => um_translate('رمضان', 'رمضان'),
            10 => um_translate('شوال', 'شوال'),
            11 => um_translate('ذی‌القعده', 'ذی‌القعده'),
            12 => um_translate('ذی‌الحجه', 'ذی‌الحجه'),
        ];
        
        return isset($months[$month]) ? $months[$month] : '';
    }

    /**
     * تبدیل نام ماه جلالی به شماره
     * @param string $month نام ماه
     * @return int شماره ماه
     */
    private function get_jalaali_month_number($month) {
        $months = [
            'فروردین' => 1,
            'اردیبهشت' => 2,
            'خرداد' => 3,
            'تیر' => 4,
            'مرداد' => 5,
            'شهریور' => 6,
            'مهر' => 7,
            'آبان' => 8,
            'آذر' => 9,
            'دی' => 10,
            'بهمن' => 11,
            'اسفند' => 12,
        ];
        
        return isset($months[$month]) ? $months[$month] : 0;
    }
}