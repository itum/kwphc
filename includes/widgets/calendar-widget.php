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
        return __('تقویم دانشگاه', 'university-management');
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

        // انتخاب نمایش خودکار یا دستی رویدادها
        $this->add_control(
            'event_source',
            [
                'label' => __('منبع رویدادها', 'university-management'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => __('خودکار (از پست‌تایپ)', 'university-management'),
                    'manual' => __('دستی', 'university-management'),
                ],
            ]
        );

        // تعداد رویدادها برای نمایش
        $this->add_control(
            'events_count',
            [
                'label' => __('تعداد رویدادها', 'university-management'),
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
                'label' => __('رویدادهای دستی', 'university-management'),
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
                'label' => __('تاریخ رویداد', 'university-management'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => date('Y-m-d'),
            ]
        );

        $repeater->add_control(
            'event_title',
            [
                'label' => __('عنوان رویداد', 'university-management'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('عنوان رویداد', 'university-management'),
            ]
        );

        $repeater->add_control(
            'is_important',
            [
                'label' => __('رویداد مهم (هایلایت)', 'university-management'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('بله', 'university-management'),
                'label_off' => __('خیر', 'university-management'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'manual_events',
            [
                'label' => __('رویدادها', 'university-management'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'event_date' => date('Y-m-d'),
                        'event_title' => __('شروع کلاس‌ها', 'university-management'),
                        'is_important' => 'yes',
                    ],
                    [
                        'event_date' => date('Y-m-d', strtotime('+10 days')),
                        'event_title' => __('ارائه پروژه', 'university-management'),
                        'is_important' => '',
                    ],
                    [
                        'event_date' => date('Y-m-d', strtotime('+20 days')),
                        'event_title' => __('میان‌ترم', 'university-management'),
                        'is_important' => '',
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
                'label' => __('استایل', 'university-management'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ هایلایت
        $this->add_control(
            'highlight_color',
            [
                'label' => __('رنگ هایلایت', 'university-management'),
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
                'label' => __('رنگ متن', 'university-management'),
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
                'label' => __('رنگ متن هایلایت', 'university-management'),
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
                'label' => __('رنگ عدد روز', 'university-management'),
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
                'label' => __('پدینگ رویداد', 'university-management'),
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
                    'important' => $event['is_important'],
                );
            }
        }
        
        // تبدیل رویدادها به فرمت جلالی و مرتب‌سازی
        $jalaali_events = array();
        
        foreach ($events as $event) {
            $timestamp = strtotime($event['date']);
            $jalaali_date = $this->gregorian_to_jalaali(date('Y', $timestamp), date('m', $timestamp), date('d', $timestamp));
            
            $jalaali_events[] = array(
                'day' => $jalaali_date['day'],
                'month' => $this->get_jalaali_month_name($jalaali_date['month']),
                'year' => $jalaali_date['year'],
                'title' => $event['title'],
                'important' => $event['is_important'],
            );
        }
        
        // مرتب‌سازی رویدادها بر اساس تاریخ
        usort($jalaali_events, function($a, $b) {
            if ($a['year'] != $b['year']) {
                return $a['year'] - $b['year'];
            }
            
            $month_diff = $this->get_jalaali_month_number($a['month']) - $this->get_jalaali_month_number($b['month']);
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
            // رویداد اول را به صورت هایلایت نمایش می‌دهیم
            if (!empty($jalaali_events)) {
                $first_event = array_shift($jalaali_events);
                ?>
                <div class="event-cal blue">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.46446 3.53554C10.4171 1.58291 13.5829 1.58291 15.5355 3.53553L20.4645 8.46446C22.4171 10.4171 22.4171 13.5829 20.4645 15.5355L15.5355 20.4645C13.5829 22.4171 10.4171 22.4171 8.46447 20.4645L3.53554 15.5355C1.58291 13.5829 1.58291 10.4171 3.53553 8.46447L8.46446 3.53554Z" fill="white"/>
                            <path d="M9.87868 8.12132C11.0503 6.94975 12.9497 6.94975 14.1213 8.12132L15.8787 9.87868C17.0503 11.0503 17.0503 12.9497 15.8787 14.1213L14.1213 15.8787C12.9497 17.0503 11.0503 17.0503 9.87868 15.8787L8.12132 14.1213C6.94975 12.9497 6.94975 11.0503 8.12132 9.87868L9.87868 8.12132Z" fill="#212179"/>
                        </svg>
                    </div>
                    <div class="day-cal"><?php echo esc_html($first_event['day']); ?></div>
                    <div class="month-year"><?php echo esc_html($first_event['month'] . ' - ' . $first_event['year']); ?></div>
                    <div class="label-cal"><?php echo esc_html($first_event['title']); ?></div>
                </div>
                
                <?php if (!empty($jalaali_events)) { ?>
                    <div class="wrapper-cal">
                        <?php foreach ($jalaali_events as $event) { ?>
                            <div class="event-cal<?php echo ($event['important'] === 'yes') ? ' blue' : ''; ?>">
                                <div class="day-cal"><?php echo esc_html($event['day']); ?></div>
                                <div class="month-year"><?php echo esc_html($event['month'] . ' - ' . $event['year']); ?></div>
                                <div class="icon-cal">
                                    <svg class="svg1" width="61" height="27" viewBox="0 0 61 27" fill="white" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_464_337)">
                                            <rect width="1440" height="8024" transform="translate(-1070 -2881)" fill="white"/>
                                            <g opacity="0.19"></g>
                                            <path d="M25.4645 4.53554C27.4171 2.58291 30.5829 2.58291 32.5355 4.53553L37.4645 9.46446C39.4171 11.4171 39.4171 14.5829 37.4645 16.5355L32.5355 21.4645C30.5829 23.4171 27.4171 23.4171 25.4645 21.4645L20.5355 16.5355C18.5829 14.5829 18.5829 11.4171 20.5355 9.46447L25.4645 4.53554Z" fill="#212179"/>
                                            <path d="M26.8787 9.12132C28.0503 7.94975 29.9497 7.94975 31.1213 9.12132L32.8787 10.8787C34.0503 12.0503 34.0503 13.9497 32.8787 15.1213L31.1213 16.8787C29.9497 18.0503 28.0503 18.0503 26.8787 16.8787L25.1213 15.1213C23.9497 13.9497 23.9497 12.0503 25.1213 10.8787L26.8787 9.12132Z" fill="white"/>
                                            <path d="M176 13L61 13" stroke="#212179" stroke-opacity="0.45" stroke-width="2" stroke-linecap="round"/>
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
                <?php } ?>
            <?php } else { ?>
                <div class="um-no-events">
                    <?php _e('هیچ رویدادی یافت نشد.', 'university-management'); ?>
                </div>
            <?php } ?>
        </div>
        <?php
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
     * تبدیل شماره ماه جلالی به نام
     * @param int $month شماره ماه
     * @return string نام ماه
     */
    private function get_jalaali_month_name($month) {
        $months = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند',
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