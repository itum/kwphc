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
        return um_translate('آزمون‌های استخدامی', __('آزمون‌های استخدامی', 'university-management'));
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
     * ثبت رشته‌های ترجمه برای Polylang
     */
    protected function register_polylang_strings() {
        if (function_exists('pll_register_string')) {
            // رشته‌های بخش تنظیمات عمومی
            pll_register_string('um_employment_exams_widget_general_settings', 'تنظیمات عمومی', 'University Management');
            pll_register_string('um_employment_exams_widget_widget_title', 'عنوان ویجت', 'University Management');
            pll_register_string('um_employment_exams_widget_default_widget_title', 'آزمون‌های استخدامی', 'University Management');
            pll_register_string('um_employment_exams_widget_exams_count', 'تعداد آزمون‌ها', 'University Management');
            pll_register_string('um_employment_exams_widget_status_filter', 'فیلتر وضعیت', 'University Management');
            pll_register_string('um_employment_exams_widget_status_all', 'همه', 'University Management');
            pll_register_string('um_employment_exams_widget_status_upcoming', 'در انتظار برگزاری', 'University Management');
            pll_register_string('um_employment_exams_widget_status_registration', 'در حال ثبت‌نام', 'University Management');
            pll_register_string('um_employment_exams_widget_status_closed', 'بسته', 'University Management');
            pll_register_string('um_employment_exams_widget_status_results_announced', 'اعلام نتایج', 'University Management');
            pll_register_string('um_employment_exams_widget_display_type', 'نوع نمایش', 'University Management');
            pll_register_string('um_employment_exams_widget_display_type_cards', 'کارت‌ها', 'University Management');
            pll_register_string('um_employment_exams_widget_display_type_table', 'جدول', 'University Management');
            pll_register_string('um_employment_exams_widget_display_type_list', 'لیست', 'University Management');

            // رشته‌های بخش استایل
            pll_register_string('um_employment_exams_widget_style_section', 'استایل‌ها', 'University Management');
            pll_register_string('um_employment_exams_widget_background_color', 'رنگ پس‌زمینه', 'University Management');
            pll_register_string('um_employment_exams_widget_text_color', 'رنگ متن', 'University Management');
            pll_register_string('um_employment_exams_widget_primary_color', 'رنگ اصلی', 'University Management');

            // رشته‌های خروجی
            pll_register_string('um_employment_exams_widget_no_exams_found', 'هیچ آزمون استخدامی یافت نشد.', 'University Management');
            pll_register_string('um_employment_exams_widget_position_label', 'موقعیت:', 'University Management');
            pll_register_string('um_employment_exams_widget_department_label', 'دپارتمان:', 'University Management');
            pll_register_string('um_employment_exams_widget_exam_date_label', 'تاریخ آزمون:', 'University Management');
            pll_register_string('um_employment_exams_widget_location_label', 'محل برگزاری:', 'University Management');
            pll_register_string('um_employment_exams_widget_deadline_label', 'مهلت ثبت‌نام:', 'University Management');
            pll_register_string('um_employment_exams_widget_table_header_title', 'عنوان آزمون', 'University Management');
            pll_register_string('um_employment_exams_widget_table_header_position', 'موقعیت شغلی', 'University Management');
            pll_register_string('um_employment_exams_widget_table_header_date', 'تاریخ آزمون', 'University Management');
            pll_register_string('um_employment_exams_widget_table_header_status', 'وضعیت', 'University Management');
            pll_register_string('um_employment_exams_widget_unknown_date', 'تاریخ نامعلوم', 'University Management');
            
            // رشته‌های حالت دستی
            pll_register_string('um_employment_exams_widget_manual_mode', 'حالت دستی', 'University Management');
            pll_register_string('um_employment_exams_widget_manual_mode_description', 'در حالت دستی می‌توانید متن دکمه‌ها و فیلدهای اضافی را سفارشی کنید', 'University Management');
            pll_register_string('um_employment_exams_widget_manual_button_text', 'متن دکمه مشاهده جزئیات', 'University Management');
            pll_register_string('um_employment_exams_widget_manual_button_text_default', 'مشاهده جزئیات', 'University Management');
            pll_register_string('um_employment_exams_widget_manual_button_text_placeholder', 'متن دکمه را وارد کنید', 'University Management');
            pll_register_string('um_employment_exams_widget_show_company', 'نمایش شرکت', 'University Management');
            pll_register_string('um_employment_exams_widget_show_contractor', 'نمایش پیمانکار', 'University Management');
            pll_register_string('um_employment_exams_widget_show_registration_start', 'نمایش شروع ثبت نام', 'University Management');
            pll_register_string('um_employment_exams_widget_show_registration_end', 'نمایش پایان ثبت نام', 'University Management');
            pll_register_string('um_employment_exams_widget_show_exam_time_manual', 'نمایش زمان آزمون', 'University Management');
            pll_register_string('um_employment_exams_widget_show_service_location', 'نمایش محل خدمت', 'University Management');
            pll_register_string('um_employment_exams_widget_show_contact_manual', 'نمایش شماره تماس', 'University Management');
            pll_register_string('um_employment_exams_widget_show_featured_image', 'نمایش تصویر شاخص', 'University Management');
            
            // رشته‌های خروجی فیلدهای جدید
            pll_register_string('um_employment_exams_widget_company_label', 'شرکت:', 'University Management');
            pll_register_string('um_employment_exams_widget_contractor_label', 'پیمانکار:', 'University Management');
            pll_register_string('um_employment_exams_widget_registration_start_label', 'شروع ثبت نام:', 'University Management');
            pll_register_string('um_employment_exams_widget_registration_end_label', 'پایان ثبت نام:', 'University Management');
            pll_register_string('um_employment_exams_widget_exam_time_manual_label', 'زمان آزمون:', 'University Management');
            pll_register_string('um_employment_exams_widget_service_location_label', 'محل خدمت:', 'University Management');
            pll_register_string('um_employment_exams_widget_contact_manual_label', 'شماره تماس:', 'University Management');
            pll_register_string('um_employment_exams_widget_exam_results_button', 'نتیجه آزمون', 'University Management');
            pll_register_string('um_employment_exams_widget_image_label', 'تصویر', 'University Management');
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

        // عنوان ویجت
        $this->add_control(
            'widget_title',
            [
                'label' => um_translate('عنوان ویجت', __('عنوان ویجت', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('آزمون‌های استخدامی', __('آزمون‌های استخدامی', 'university-management')),
                'placeholder' => um_translate('عنوان را وارد کنید', __('عنوان را وارد کنید', 'university-management')),
            ]
        );

        // تعداد آزمون‌ها برای نمایش
        $this->add_control(
            'exams_count',
            [
                'label' => um_translate('تعداد آزمون‌ها', __('تعداد آزمون‌ها', 'university-management')),
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
                'label' => um_translate('فیلتر وضعیت', __('فیلتر وضعیت', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => um_translate('همه', __('همه', 'university-management')),
                    'upcoming' => um_translate('در انتظار برگزاری', __('در انتظار برگزاری', 'university-management')),
                    'registration' => um_translate('در حال ثبت‌نام', __('در حال ثبت‌نام', 'university-management')),
                    'closed' => um_translate('بسته', __('بسته', 'university-management')),
                    'results_announced' => um_translate('اعلام نتایج', __('اعلام نتایج', 'university-management')),
                ],
            ]
        );

        // کنترل‌های نمایش فیلدها
        $this->add_control(
            'show_exam_title',
            [
                'label' => um_translate('نمایش عنوان آزمون', __('نمایش عنوان آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_exam_position',
            [
                'label' => um_translate('نمایش موقعیت شغلی', __('نمایش موقعیت شغلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_city',
            [
                'label' => um_translate('نمایش شهر خدمت', __('نمایش شهر خدمت', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_contact_number',
            [
                'label' => um_translate('نمایش شماره تماس', __('نمایش شماره تماس', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_job_title',
            [
                'label' => um_translate('نمایش عنوان شغلی', __('نمایش عنوان شغلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_education_level',
            [
                'label' => um_translate('نمایش مقطع تحصیلی', __('نمایش مقطع تحصیلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_exam_type',
            [
                'label' => um_translate('نمایش نوع آزمون', __('نمایش نوع آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_registration_dates',
            [
                'label' => um_translate('نمایش تاریخ‌های ثبت نام', __('نمایش تاریخ‌های ثبت نام', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_exam_date',
            [
                'label' => um_translate('نمایش تاریخ آزمون', __('نمایش تاریخ آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_exam_time',
            [
                'label' => um_translate('نمایش زمان آزمون', __('نمایش زمان آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_exam_status',
            [
                'label' => um_translate('نمایش وضعیت آزمون', __('نمایش وضعیت آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_employment_link',
            [
                'label' => um_translate('نمایش لینک استخدام', __('نمایش لینک استخدام', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_exam_results_link',
            [
                'label' => um_translate('نمایش لینک نتایج', __('نمایش لینک نتایج', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_featured_image',
            [
                'label' => um_translate('نمایش تصویر شاخص', __('نمایش تصویر شاخص', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_status',
            [
                'label' => um_translate('نمایش وضعیت', __('نمایش وضعیت', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // کنترل‌های حالت دستی
        $this->add_control(
            'manual_mode',
            [
                'label' => um_translate('حالت دستی', __('حالت دستی', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('فعال', __('فعال', 'university-management')),
                'label_off' => um_translate('غیرفعال', __('غیرفعال', 'university-management')),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => um_translate('در حالت دستی می‌توانید متن دکمه‌ها و فیلدهای اضافی را سفارشی کنید', __('در حالت دستی می‌توانید متن دکمه‌ها و فیلدهای اضافی را سفارشی کنید', 'university-management')),
            ]
        );

        // متن دکمه مشاهده جزئیات در حالت دستی
        $this->add_control(
            'manual_button_text',
            [
                'label' => um_translate('متن دکمه مشاهده جزئیات', __('متن دکمه مشاهده جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => um_translate('مشاهده جزئیات', __('مشاهده جزئیات', 'university-management')),
                'placeholder' => um_translate('متن دکمه را وارد کنید', __('متن دکمه را وارد کنید', 'university-management')),
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        // فیلدهای اضافی برای حالت دستی
        $this->add_control(
            'show_company',
            [
                'label' => um_translate('نمایش شرکت', __('نمایش شرکت', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_contractor',
            [
                'label' => um_translate('نمایش پیمانکار', __('نمایش پیمانکار', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_registration_start',
            [
                'label' => um_translate('نمایش شروع ثبت نام', __('نمایش شروع ثبت نام', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_registration_end',
            [
                'label' => um_translate('نمایش پایان ثبت نام', __('نمایش پایان ثبت نام', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_exam_time_manual',
            [
                'label' => um_translate('نمایش زمان آزمون', __('نمایش زمان آزمون', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_service_location',
            [
                'label' => um_translate('نمایش محل خدمت', __('نمایش محل خدمت', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_contact_manual',
            [
                'label' => um_translate('نمایش شماره تماس', __('نمایش شماره تماس', 'university-management')),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => um_translate('نمایش', __('نمایش', 'university-management')),
                'label_off' => um_translate('مخفی', __('مخفی', 'university-management')),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'manual_mode' => 'yes',
                ],
            ]
        );

        // نمایش نوع
        $this->add_control(
            'display_type',
            [
                'label' => um_translate('نوع نمایش', __('نوع نمایش', 'university-management')),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cards',
                'options' => [
                    'cards' => um_translate('کارت‌ها', __('کارت‌ها', 'university-management')),
                    'table' => um_translate('جدول', __('جدول', 'university-management')),
                    'list' => um_translate('لیست', __('لیست', 'university-management')),
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل‌ها
        $this->start_controls_section(
            'section_style',
            [
                'label' => um_translate('استایل‌ها', __('استایل‌ها', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // رنگ پس‌زمینه
        $this->add_control(
            'background_color',
            [
                'label' => um_translate('رنگ پس‌زمینه', __('رنگ پس‌زمینه', 'university-management')),
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
                'label' => um_translate('رنگ متن', __('رنگ متن', 'university-management')),
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
                'label' => um_translate('رنگ اصلی', __('رنگ اصلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0073aa',
                'selectors' => [
                    '{{WRAPPER}} .um-exam-card .exam-status' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .um-exam-card .exam-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Container
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => um_translate('استایل کانتینر', __('استایل کانتینر', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => um_translate('پس‌زمینه کانتینر', __('پس‌زمینه کانتینر', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .um-employment-exams-widget',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => um_translate('حاشیه کانتینر', __('حاشیه کانتینر', 'university-management')),
                'selector' => '{{WRAPPER}} .um-employment-exams-widget',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => um_translate('گردی گوشه‌ها', __('گردی گوشه‌ها', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-employment-exams-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => um_translate('سایه کانتینر', __('سایه کانتینر', 'university-management')),
                'selector' => '{{WRAPPER}} .um-employment-exams-widget',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => um_translate('فاصله داخلی', __('فاصله داخلی', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-employment-exams-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => um_translate('فاصله خارجی', __('فاصله خارجی', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-employment-exams-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Widget Title
        $this->start_controls_section(
            'section_style_widget_title',
            [
                'label' => um_translate('استایل عنوان ویجت', __('استایل عنوان ویجت', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'widget_title_typography',
                'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_control(
            'widget_title_text_color',
            [
                'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'widget_title_background',
                'label' => um_translate('پس‌زمینه عنوان', __('پس‌زمینه عنوان', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_responsive_control(
            'widget_title_padding',
            [
                'label' => um_translate('فاصله داخلی عنوان', __('فاصله داخلی عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'widget_title_margin',
            [
                'label' => um_translate('فاصله خارجی عنوان', __('فاصله خارجی عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'widget_title_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های عنوان', __('گردی گوشه‌های عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Exam Cards
        $this->start_controls_section(
            'section_style_exam_cards',
            [
                'label' => um_translate('استایل کارت‌های آزمون', __('استایل کارت‌های آزمون', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'exam_card_background',
                'label' => um_translate('پس‌زمینه کارت', __('پس‌زمینه کارت', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .um-exam-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'exam_card_border',
                'label' => um_translate('حاشیه کارت', __('حاشیه کارت', 'university-management')),
                'selector' => '{{WRAPPER}} .um-exam-card',
            ]
        );

        $this->add_control(
            'exam_card_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های کارت', __('گردی گوشه‌های کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-exam-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exam_card_box_shadow',
                'label' => um_translate('سایه کارت', __('سایه کارت', 'university-management')),
                'selector' => '{{WRAPPER}} .um-exam-card',
            ]
        );

        $this->add_responsive_control(
            'exam_card_padding',
            [
                'label' => um_translate('فاصله داخلی کارت', __('فاصله داخلی کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-exam-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exam_card_margin',
            [
                'label' => um_translate('فاصله خارجی کارت', __('فاصله خارجی کارت', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .um-exam-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Exam Title
        $this->start_controls_section(
            'section_style_exam_title',
            [
                'label' => um_translate('استایل عنوان آزمون', __('استایل عنوان آزمون', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'exam_title_typography',
                'label' => um_translate('تایپوگرافی عنوان', __('تایپوگرافی عنوان', 'university-management')),
                'selector' => '{{WRAPPER}} .exam-title',
            ]
        );

        $this->add_control(
            'exam_title_text_color',
            [
                'label' => um_translate('رنگ عنوان', __('رنگ عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exam-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exam_title_margin',
            [
                'label' => um_translate('فاصله عنوان', __('فاصله عنوان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exam-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Exam Details
        $this->start_controls_section(
            'section_style_exam_details',
            [
                'label' => um_translate('استایل جزئیات آزمون', __('استایل جزئیات آزمون', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'exam_details_typography',
                'label' => um_translate('تایپوگرافی جزئیات', __('تایپوگرافی جزئیات', 'university-management')),
                'selector' => '{{WRAPPER}} .exam-details',
            ]
        );

        $this->add_control(
            'exam_details_text_color',
            [
                'label' => um_translate('رنگ جزئیات', __('رنگ جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exam-details' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exam_details_margin',
            [
                'label' => um_translate('فاصله جزئیات', __('فاصله جزئیات', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exam-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Status Badge
        $this->start_controls_section(
            'section_style_status_badge',
            [
                'label' => um_translate('استایل نشان وضعیت', __('استایل نشان وضعیت', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'status_badge_typography',
                'label' => um_translate('تایپوگرافی نشان', __('تایپوگرافی نشان', 'university-management')),
                'selector' => '{{WRAPPER}} .status-badge',
            ]
        );

        $this->add_control(
            'status_badge_text_color',
            [
                'label' => um_translate('رنگ متن نشان', __('رنگ متن نشان', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .status-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'status_badge_background',
                'label' => um_translate('پس‌زمینه نشان', __('پس‌زمینه نشان', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .status-badge',
            ]
        );

        $this->add_control(
            'status_badge_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های نشان', __('گردی گوشه‌های نشان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .status-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'status_badge_padding',
            [
                'label' => um_translate('فاصله داخلی نشان', __('فاصله داخلی نشان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .status-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'status_badge_margin',
            [
                'label' => um_translate('فاصله خارجی نشان', __('فاصله خارجی نشان', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .status-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // بخش استایل - Table (if table display is used)
        $this->start_controls_section(
            'section_style_table',
            [
                'label' => um_translate('استایل جدول', __('استایل جدول', 'university-management')),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'table_background',
                'label' => um_translate('پس‌زمینه جدول', __('پس‌زمینه جدول', 'university-management')),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .exam-table',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'label' => um_translate('حاشیه جدول', __('حاشیه جدول', 'university-management')),
                'selector' => '{{WRAPPER}} .exam-table',
            ]
        );

        $this->add_control(
            'table_border_radius',
            [
                'label' => um_translate('گردی گوشه‌های جدول', __('گردی گوشه‌های جدول', 'university-management')),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exam-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_typography',
                'label' => um_translate('تایپوگرافی جدول', __('تایپوگرافی جدول', 'university-management')),
                'selector' => '{{WRAPPER}} .exam-table td, {{WRAPPER}} .exam-table th',
            ]
        );

        $this->add_control(
            'table_text_color',
            [
                'label' => um_translate('رنگ متن جدول', __('رنگ متن جدول', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exam-table td, {{WRAPPER}} .exam-table th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_header_background',
            [
                'label' => um_translate('پس‌زمینه هدر جدول', __('پس‌زمینه هدر جدول', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exam-table th' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_header_text_color',
            [
                'label' => um_translate('رنگ متن هدر جدول', __('رنگ متن هدر جدول', 'university-management')),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exam-table th' => 'color: {{VALUE}};',
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
            echo '<div class="um-no-exams"><p>' . um_translate('هیچ آزمون استخدامی یافت نشد.', __('هیچ آزمون استخدامی یافت نشد.', 'university-management')) . '</p></div>';
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
        
        <!-- مودال تصویر شاخص -->
        <div id="um-image-modal" class="um-image-modal">
            <div class="um-modal-overlay"></div>
            <div class="um-modal-content">
                <span class="um-modal-close">&times;</span>
                <img id="um-modal-image" src="" alt="">
            </div>
        </div>
        <?php

        wp_reset_postdata();
    }

    /**
     * نمایش به صورت کارت
     */
    private function render_cards_view($query) {
        $settings = $this->get_settings_for_display();
        
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
            
            // دریافت فیلدهای سفارشی جدید
            $city = get_post_meta(get_the_ID(), 'city', true);
            $contact_number = get_post_meta(get_the_ID(), 'contact_number', true);
            $job_title = get_post_meta(get_the_ID(), 'job_title', true);
            $education_level = get_post_meta(get_the_ID(), 'education_level', true);
            $exam_type = get_post_meta(get_the_ID(), 'exam_type', true);
            $registration_start_date = get_post_meta(get_the_ID(), 'registration_start_date', true);
            $registration_end_date = get_post_meta(get_the_ID(), 'registration_end_date', true);
            $employment_link = get_post_meta(get_the_ID(), 'employment_link', true);
            $employment_link_enabled = get_post_meta(get_the_ID(), 'employment_link_enabled', true);
            $exam_time_custom = get_post_meta(get_the_ID(), 'exam_time', true);
            $exam_date_custom = get_post_meta(get_the_ID(), 'exam_date_custom', true);
            $exam_status_custom = get_post_meta(get_the_ID(), 'exam_status_custom', true);
            $exam_results_link = get_post_meta(get_the_ID(), 'exam_results_link', true);
            
            // دریافت فیلدهای جدید برای حالت دستی
            $company = get_post_meta(get_the_ID(), 'company', true);
            $contractor = get_post_meta(get_the_ID(), 'contractor', true);
            $registration_start_manual = get_post_meta(get_the_ID(), 'registration_start_manual', true);
            $registration_end_manual = get_post_meta(get_the_ID(), 'registration_end_manual', true);
            $exam_time_manual = get_post_meta(get_the_ID(), 'exam_time_manual', true);
            $service_location = get_post_meta(get_the_ID(), 'service_location', true);
            $contact_manual = get_post_meta(get_the_ID(), 'contact_manual', true);
            
            $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : '';
            $deadline_display = $exam_application_deadline ? date_i18n('Y/m/d', strtotime($exam_application_deadline)) : '';
            
            $status_labels = array(
                'upcoming' => um_translate('در انتظار برگزاری', __('در انتظار برگزاری', 'university-management')),
                'registration' => um_translate('در حال ثبت‌نام', __('در حال ثبت‌نام', 'university-management')),
                'closed' => um_translate('بسته', __('بسته', 'university-management')),
                'results_announced' => um_translate('اعلام نتایج', __('اعلام نتایج', 'university-management'))
            );
            $status_display = isset($status_labels[$exam_status]) ? $status_labels[$exam_status] : $exam_status;
            
            ?>
            <div class="um-exam-card">
                <?php if (has_post_thumbnail() && $settings['show_featured_image'] === 'yes') : ?>
                    <div class="exam-thumbnail" onclick="umOpenImageModal('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>', '<?php echo esc_attr(get_the_title()); ?>')">
                        <?php the_post_thumbnail('medium'); ?>
                        <div class="zoom-overlay">
                            <span class="zoom-icon">🔍</span>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="exam-content">
                    <h4 class="exam-title"><?php the_title(); ?></h4>
                    
                    <?php if ($exam_position && $settings['show_exam_position'] === 'yes') : ?>
                        <div class="exam-position">
                            <strong><?php echo esc_html(um_translate('موقعیت:', __('موقعیت:', 'university-management'))); ?></strong> <?php echo esc_html($exam_position); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_department) : ?>
                        <div class="exam-department">
                            <strong><?php echo esc_html(um_translate('دپارتمان:', __('دپارتمان:', 'university-management'))); ?></strong> <?php echo esc_html($exam_department); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($date_display) : ?>
                        <div class="exam-date">
                            <strong><?php echo esc_html(um_translate('تاریخ آزمون:', __('تاریخ آزمون:', 'university-management'))); ?></strong> <?php echo esc_html($date_display); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_location) : ?>
                        <div class="exam-location">
                            <strong><?php echo esc_html(um_translate('محل برگزاری:', __('محل برگزاری:', 'university-management'))); ?></strong> <?php echo esc_html($exam_location); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($deadline_display) : ?>
                        <div class="exam-deadline">
                            <strong><?php echo esc_html(um_translate('مهلت ثبت‌نام:', __('مهلت ثبت‌نام:', 'university-management'))); ?></strong> <?php echo esc_html($deadline_display); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- فیلدهای سفارشی جدید -->
                    <?php if ($city && $settings['show_city'] === 'yes') : ?>
                        <div class="exam-city">
                            <strong><?php echo esc_html(um_translate('محل خدمت:', __('محل خدمت:', 'university-management'))); ?></strong> <?php echo esc_html($city); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($contact_number && $settings['show_contact_number'] === 'yes') : ?>
                        <div class="exam-contact">
                            <strong><?php echo esc_html(um_translate('شماره تماس:', __('شماره تماس:', 'university-management'))); ?></strong> <?php echo esc_html($contact_number); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($job_title && $settings['show_job_title'] === 'yes') : ?>
                        <div class="exam-job-title">
                            <strong><?php echo esc_html(um_translate('عنوان شغلی:', __('عنوان شغلی:', 'university-management'))); ?></strong> <?php echo esc_html($job_title); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($education_level && $settings['show_education_level'] === 'yes') : ?>
                        <div class="exam-education">
                            <strong><?php echo esc_html(um_translate('مقطع تحصیلی:', __('مقطع تحصیلی:', 'university-management'))); ?></strong> <?php echo esc_html($education_level); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_type && $settings['show_exam_type'] === 'yes') : ?>
                        <div class="exam-type">
                            <strong><?php echo esc_html(um_translate('نوع آزمون:', __('نوع آزمون:', 'university-management'))); ?></strong> <?php echo esc_html($exam_type); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (($registration_start_date || $registration_end_date) && $settings['show_registration_dates'] === 'yes') : ?>
                        <div class="exam-registration-period">
                            <strong><?php echo esc_html(um_translate('بازه ثبت نام:', __('بازه ثبت نام:', 'university-management'))); ?></strong>
                            <?php 
                            // نمایش تاریخ‌ها به همان فرمت وارد شده (Persian format)
                            $start_display = $registration_start_date ? esc_html($registration_start_date) : '';
                            $end_display = $registration_end_date ? esc_html($registration_end_date) : '';
                            echo esc_html($start_display . ($start_display && $end_display ? ' - ' : '') . $end_display);
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_date_custom && $settings['show_exam_date'] === 'yes') : ?>
                        <div class="exam-date-custom">
                            <strong><?php echo esc_html(um_translate('تاریخ آزمون:', __('تاریخ آزمون:', 'university-management'))); ?></strong> <?php echo esc_html($exam_date_custom); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_time_custom && $settings['show_exam_time'] === 'yes') : ?>
                        <div class="exam-time-custom">
                            <strong><?php echo esc_html(um_translate('زمان آزمون:', __('زمان آزمون:', 'university-management'))); ?></strong> <?php echo esc_html($exam_time_custom); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($employment_link && $employment_link_enabled && $settings['show_employment_link'] === 'yes') : ?>
                        <div class="exam-employment-link">
                            <strong><?php echo esc_html(um_translate('لینک استخدام:', __('لینک استخدام:', 'university-management'))); ?></strong>
                            <a href="<?php echo esc_url($employment_link); ?>" target="_blank" rel="noopener noreferrer" class="employment-link-btn">
                                <?php echo esc_html(um_translate('مشاهده آگهی', __('مشاهده آگهی', 'university-management'))); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_status_custom && $settings['show_exam_status'] === 'yes') : ?>
                        <div class="exam-status-custom">
                            <strong><?php echo esc_html(um_translate('وضعیت آزمون:', __('وضعیت آزمون:', 'university-management'))); ?></strong> <?php echo esc_html($exam_status_custom); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($exam_results_link && $settings['show_exam_results_link'] === 'yes') : ?>
                        <div class="exam-results-link">
                            <strong><?php echo esc_html(um_translate('لینک نتایج:', __('لینک نتایج:', 'university-management'))); ?></strong>
                            <a href="<?php echo esc_url($exam_results_link); ?>" target="_blank" rel="noopener noreferrer" class="results-link-btn">
                                <?php echo esc_html(um_translate('مشاهده نتایج', __('مشاهده نتایج', 'university-management'))); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <!-- فیلدهای جدید برای حالت دستی -->
                    <?php if ($settings['manual_mode'] === 'yes') : ?>
                        <?php if ($company && $settings['show_company'] === 'yes') : ?>
                            <div class="exam-company">
                                <strong><?php echo esc_html(um_translate('شرکت:', __('شرکت:', 'university-management'))); ?></strong> <?php echo esc_html($company); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($contractor && $settings['show_contractor'] === 'yes') : ?>
                            <div class="exam-contractor">
                                <strong><?php echo esc_html(um_translate('پیمانکار:', __('پیمانکار:', 'university-management'))); ?></strong> <?php echo esc_html($contractor); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($registration_start_manual && $settings['show_registration_start'] === 'yes') : ?>
                            <div class="exam-registration-start-manual">
                                <strong><?php echo esc_html(um_translate('شروع ثبت نام:', __('شروع ثبت نام:', 'university-management'))); ?></strong> <?php echo esc_html($registration_start_manual); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($registration_end_manual && $settings['show_registration_end'] === 'yes') : ?>
                            <div class="exam-registration-end-manual">
                                <strong><?php echo esc_html(um_translate('پایان ثبت نام:', __('پایان ثبت نام:', 'university-management'))); ?></strong> <?php echo esc_html($registration_end_manual); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($exam_time_manual && $settings['show_exam_time_manual'] === 'yes') : ?>
                            <div class="exam-time-manual">
                                <strong><?php echo esc_html(um_translate('زمان آزمون:', __('زمان آزمون:', 'university-management'))); ?></strong> <?php echo esc_html($exam_time_manual); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($service_location && $settings['show_service_location'] === 'yes') : ?>
                            <div class="exam-service-location">
                                <strong><?php echo esc_html(um_translate('محل خدمت:', __('محل خدمت:', 'university-management'))); ?></strong> <?php echo esc_html($service_location); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($contact_manual && $settings['show_contact_manual'] === 'yes') : ?>
                            <div class="exam-contact-manual">
                                <strong><?php echo esc_html(um_translate('شماره تماس:', __('شماره تماس:', 'university-management'))); ?></strong> <?php echo esc_html($contact_manual); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <!-- Dynamic Button and Sidebar based on exam status -->
                    <?php 
                    // تعیین دکمه و لینک بر اساس وضعیت آزمون
                    $button_text = '';
                    $button_link = '';
                    $button_class = '';
                    $sidebar_text = '';
                    $sidebar_class = '';
                    
                    // اگر حالت دستی فعال است، از متن دستی استفاده کن
                    if ($settings['manual_mode'] === 'yes' && !empty($settings['manual_button_text'])) {
                        $button_text = $settings['manual_button_text'];
                        $button_link = $employment_link;
                        $button_class = 'btn-manual';
                        $sidebar_text = um_translate('دستی', __('دستی', 'university-management'));
                        $sidebar_class = 'status-manual';
                    } else {
                        // منطق قبلی برای حالت خودکار
                        switch($exam_status_custom) {
                            case 'در انتظار برگزاری':
                                $button_text = um_translate('ثبت نام', __('ثبت نام', 'university-management'));
                                $button_link = $employment_link;
                                $button_class = 'btn-register';
                                $sidebar_text = um_translate('در انتظار برگزاری', __('در انتظار برگزاری', 'university-management'));
                                $sidebar_class = 'status-pending';
                                break;
                            case 'در حال ثبت نام':
                                $button_text = um_translate('ثبت نام', __('ثبت نام', 'university-management'));
                                $button_link = $employment_link;
                                $button_class = 'btn-register';
                                $sidebar_text = um_translate('در حال ثبت نام', __('در حال ثبت نام', 'university-management'));
                                $sidebar_class = 'status-registering';
                                break;
                            case 'بسته':
                                $button_text = um_translate('بسته', __('بسته', 'university-management'));
                                $button_link = '#';
                                $button_class = 'btn-closed';
                                $sidebar_text = um_translate('بسته', __('بسته', 'university-management'));
                                $sidebar_class = 'status-closed';
                                break;
                        case 'اعلام نتایج':

                            // وقتی وضعیت "اعلام نتایج" باشد، در بخش کارت دکمه نمایش داده نشود
                            $button_text = '';
                            $button_link = '';
                            $button_class = '';
                            $sidebar_text = um_translate('اعلام نتایج', __('اعلام نتایج', 'university-management'));
                            $sidebar_class = 'status-results-announced';
                            break;
                            default:
                                $button_text = um_translate('مشاهده آگهی', __('مشاهده آگهی', 'university-management'));
                                $button_link = $employment_link;
                                $button_class = 'btn-default';
                                $sidebar_text = um_translate('در حال برگزاری', __('در حال برگزاری', 'university-management'));
                                $sidebar_class = 'status-default';
                        }
                    }
                    ?>
                    
                    <?php if ($button_link && $button_link !== '#') : ?>
                        <div class="exam-dynamic-button">
                            <a href="<?php echo esc_url($button_link); ?>" target="_blank" rel="noopener noreferrer" class="dynamic-btn <?php echo esc_attr($button_class); ?>">
                                <?php echo esc_html($button_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="exam-status-sidebar <?php echo esc_attr($sidebar_class); ?>">
                        <?php echo esc_html($sidebar_text); ?>
                    </div>
                    
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
        $settings = $this->get_settings_for_display();
        
        ?>
        <table class="um-exams-table">
            <thead>
                <tr>
                    <?php if ($settings['show_featured_image'] === 'yes') : ?><th><?php echo esc_html(um_translate('تصویر', __('تصویر', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_title'] === 'yes') : ?><th><?php echo esc_html(um_translate('عنوان آزمون', __('عنوان آزمون', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_position'] === 'yes') : ?><th><?php echo esc_html(um_translate('موقعیت شغلی', __('موقعیت شغلی', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_city'] === 'yes') : ?><th><?php echo esc_html(um_translate('محل خدمت', __('محل خدمت', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_contact_number'] === 'yes') : ?><th><?php echo esc_html(um_translate('شماره تماس', __('شماره تماس', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_job_title'] === 'yes') : ?><th><?php echo esc_html(um_translate('عنوان شغلی', __('عنوان شغلی', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_education_level'] === 'yes') : ?><th><?php echo esc_html(um_translate('مقطع تحصیلی', __('مقطع تحصیلی', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_type'] === 'yes') : ?><th><?php echo esc_html(um_translate('نوع آزمون', __('نوع آزمون', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_registration_dates'] === 'yes') : ?><th><?php echo esc_html(um_translate('بازه ثبت نام', __('بازه ثبت نام', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_date'] === 'yes') : ?><th><?php echo esc_html(um_translate('تاریخ آزمون سفارشی', __('تاریخ آزمون سفارشی', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_time'] === 'yes') : ?><th><?php echo esc_html(um_translate('زمان آزمون', __('زمان آزمون', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_status'] === 'yes') : ?><th><?php echo esc_html(um_translate('وضعیت آزمون', __('وضعیت آزمون', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_employment_link'] === 'yes') : ?><th><?php echo esc_html(um_translate('لینک استخدام', __('لینک استخدام', 'university-management'))); ?></th><?php endif; ?>
                    <?php if ($settings['show_exam_results_link'] === 'yes') : ?><th><?php echo esc_html(um_translate('لینک نتایج', __('لینک نتایج', 'university-management'))); ?></th><?php endif; ?>
                    <th><?php echo esc_html(um_translate('وضعیت', __('وضعیت', 'university-management'))); ?></th>
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
                    
                    // دریافت فیلدهای سفارشی جدید
                    $city = get_post_meta(get_the_ID(), 'city', true);
                    $contact_number = get_post_meta(get_the_ID(), 'contact_number', true);
                    $job_title = get_post_meta(get_the_ID(), 'job_title', true);
                    $education_level = get_post_meta(get_the_ID(), 'education_level', true);
                    $exam_type = get_post_meta(get_the_ID(), 'exam_type', true);
                    $employment_link = get_post_meta(get_the_ID(), 'employment_link', true);
                    $employment_link_enabled = get_post_meta(get_the_ID(), 'employment_link_enabled', true);
                    $exam_time_custom = get_post_meta(get_the_ID(), 'exam_time', true);
                    $exam_date_custom = get_post_meta(get_the_ID(), 'exam_date_custom', true);
                    $exam_status_custom = get_post_meta(get_the_ID(), 'exam_status_custom', true);
                    $exam_results_link = get_post_meta(get_the_ID(), 'exam_results_link', true);
                    
                    // دریافت فیلدهای جدید برای حالت دستی
                    $company = get_post_meta(get_the_ID(), 'company', true);
                    $contractor = get_post_meta(get_the_ID(), 'contractor', true);
                    $registration_start_manual = get_post_meta(get_the_ID(), 'registration_start_manual', true);
                    $registration_end_manual = get_post_meta(get_the_ID(), 'registration_end_manual', true);
                    $exam_time_manual = get_post_meta(get_the_ID(), 'exam_time_manual', true);
                    $service_location = get_post_meta(get_the_ID(), 'service_location', true);
                    $contact_manual = get_post_meta(get_the_ID(), 'contact_manual', true);
                    
                    $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : um_translate('تاریخ نامعلوم', __('تاریخ نامعلوم', 'university-management'));
                    
                    // استفاده از وضعیت سفارشی برای نمایش صحیح
                    $status_display = $exam_status_custom ?: $exam_status;
                    
                    ?>
                    <tr>
                        <?php if ($settings['show_featured_image'] === 'yes') : ?><td>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="exam-thumbnail-small" onclick="umOpenImageModal('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>', '<?php echo esc_attr(get_the_title()); ?>')">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                    <div class="zoom-overlay-small">
                                        <span class="zoom-icon-small">🔍</span>
                                    </div>
                                </div>
                            <?php else : ?>
                                <span class="no-image">-</span>
                            <?php endif; ?>
                        </td><?php endif; ?>
                        <?php if ($settings['show_exam_title'] === 'yes') : ?><td><?php the_title(); ?></td><?php endif; ?>
                        <?php if ($settings['show_exam_position'] === 'yes') : ?><td><?php echo esc_html($exam_position); ?></td><?php endif; ?>
                        <?php if ($settings['show_city'] === 'yes') : ?><td><?php echo esc_html($city); ?></td><?php endif; ?>
                        <?php if ($settings['show_contact_number'] === 'yes') : ?><td><?php echo esc_html($contact_number); ?></td><?php endif; ?>
                        <?php if ($settings['show_job_title'] === 'yes') : ?><td><?php echo esc_html($job_title); ?></td><?php endif; ?>
                        <?php if ($settings['show_education_level'] === 'yes') : ?><td><?php echo esc_html($education_level); ?></td><?php endif; ?>
                        <?php if ($settings['show_exam_type'] === 'yes') : ?><td><?php echo esc_html($exam_type); ?></td><?php endif; ?>
                        <?php if ($settings['show_registration_dates'] === 'yes') : ?><td><?php echo esc_html($registration_start_date . ' - ' . $registration_end_date); ?></td><?php endif; ?>
                        <?php if ($settings['show_exam_date'] === 'yes') : ?><td><?php echo esc_html($exam_date_custom ?: '-'); ?></td><?php endif; ?>
                        <?php if ($settings['show_exam_time'] === 'yes') : ?><td><?php echo esc_html($exam_time_custom ?: '-'); ?></td><?php endif; ?>
                        <?php if ($settings['show_exam_status'] === 'yes') : ?><td><?php echo esc_html($exam_status_custom ?: '-'); ?></td><?php endif; ?>
                        <?php if ($settings['show_employment_link'] === 'yes') : ?><td>
                            <?php 
                            // تعیین دکمه و لینک بر اساس وضعیت آزمون
                            $button_text = '';
                            $button_link = '';
                            $button_class = '';
                            
                            switch($exam_status_custom) {
                                case 'در انتظار برگزاری':
                                case 'در حال ثبت نام':
                                    $button_text = um_translate('ثبت نام', __('ثبت نام', 'university-management'));
                                    $button_link = $employment_link;
                                    $button_class = 'btn-register';
                                    break;
                                case 'بسته':
                                    $button_text = um_translate('بسته', __('بسته', 'university-management'));
                                    $button_link = '#';
                                    $button_class = 'btn-closed';
                                    break;
                                case 'اعلام نتایج':
                                    // وقتی وضعیت "اعلام نتایج" باشد، در ستون "لینک استخدام" فقط "-" نمایش داده شود
                                    $button_text = '-';
                                    $button_link = '#';
                                    $button_class = 'btn-disabled';
                                    break;
                                default:
                                    $button_text = um_translate('مشاهده', __('مشاهده', 'university-management'));
                                    $button_link = $employment_link;
                                    $button_class = 'btn-default';
                            }
                            
                            if ($button_link && $button_link !== '#') : ?>
                                <a href="<?php echo esc_url($button_link); ?>" target="_blank" rel="noopener noreferrer" class="dynamic-btn <?php echo esc_attr($button_class); ?>">
                                    <?php echo esc_html($button_text); ?>
                                </a>
                            <?php else : ?>
                                <span class="btn-disabled"><?php echo esc_html($button_text); ?></span>
                            <?php endif; ?>
                        </td><?php endif; ?>
                        <?php if ($settings['show_exam_results_link'] === 'yes') : ?><td>
                            <?php if ($exam_results_link) : ?>
                                <a href="<?php echo esc_url($exam_results_link); ?>" class="btn-results" target="_blank" rel="noopener noreferrer">
                                    <?php echo esc_html(um_translate('مشاهده نتایج', __('مشاهده نتایج', 'university-management'))); ?>
                                </a>
                            <?php else : ?>
                                <span class="btn-disabled">-</span>
                            <?php endif; ?>
                        </td><?php endif; ?>
                        <?php if ($settings['show_status'] === 'yes') : ?><td class="status-<?php echo esc_attr(sanitize_title($exam_status_custom ?: $exam_status)); ?>"><?php echo esc_html($status_display); ?></td><?php endif; ?>
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
        $settings = $this->get_settings_for_display();
        
        echo '<ul class="um-exams-list">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            $exam_date = get_post_meta(get_the_ID(), '_exam_date', true);
            $exam_time = get_post_meta(get_the_ID(), '_exam_time', true);
            $exam_position = get_post_meta(get_the_ID(), '_exam_position', true);
            $exam_status = get_post_meta(get_the_ID(), '_exam_status', true);
            
            // دریافت فیلدهای سفارشی جدید
            $city = get_post_meta(get_the_ID(), 'city', true);
            $contact_number = get_post_meta(get_the_ID(), 'contact_number', true);
            $job_title = get_post_meta(get_the_ID(), 'job_title', true);
            $education_level = get_post_meta(get_the_ID(), 'education_level', true);
            $exam_type = get_post_meta(get_the_ID(), 'exam_type', true);
            $employment_link = get_post_meta(get_the_ID(), 'employment_link', true);
            $employment_link_enabled = get_post_meta(get_the_ID(), 'employment_link_enabled', true);
            $exam_time_custom = get_post_meta(get_the_ID(), 'exam_time', true);
            $exam_date_custom = get_post_meta(get_the_ID(), 'exam_date_custom', true);
            $exam_status_custom = get_post_meta(get_the_ID(), 'exam_status_custom', true);
            $exam_results_link = get_post_meta(get_the_ID(), 'exam_results_link', true);
            
            // دریافت فیلدهای جدید برای حالت دستی
            $company = get_post_meta(get_the_ID(), 'company', true);
            $contractor = get_post_meta(get_the_ID(), 'contractor', true);
            $registration_start_manual = get_post_meta(get_the_ID(), 'registration_start_manual', true);
            $registration_end_manual = get_post_meta(get_the_ID(), 'registration_end_manual', true);
            $exam_time_manual = get_post_meta(get_the_ID(), 'exam_time_manual', true);
            $service_location = get_post_meta(get_the_ID(), 'service_location', true);
            $contact_manual = get_post_meta(get_the_ID(), 'contact_manual', true);
            
            $date_display = ($exam_date && $exam_time) ? date_i18n('Y/m/d H:i', strtotime($exam_date . ' ' . $exam_time)) : '';
            
            // استفاده از وضعیت سفارشی برای نمایش صحیح
            $status_display = $exam_status_custom ?: $exam_status;
            
            ?>
            <li class="um-exam-item status-<?php echo esc_attr(sanitize_title($exam_status_custom ?: $exam_status)); ?>">
                <?php if (has_post_thumbnail() && $settings['show_featured_image'] === 'yes') : ?>
                    <div class="exam-thumbnail-list" onclick="umOpenImageModal('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>', '<?php echo esc_attr(get_the_title()); ?>')">
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <div class="zoom-overlay-list">
                            <span class="zoom-icon-list">🔍</span>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="exam-title"><?php the_title(); ?></div>
                <?php if ($exam_position && $settings['show_exam_position'] === 'yes') : ?>
                    <div class="exam-position"><?php echo esc_html($exam_position); ?></div>
                <?php endif; ?>
                <?php if ($city && $settings['show_city'] === 'yes') : ?>
                    <div class="exam-city"><?php echo esc_html(um_translate('محل خدمت:', __('محل خدمت:', 'university-management'))); ?> <?php echo esc_html($city); ?></div>
                <?php endif; ?>
                <?php if ($contact_number && $settings['show_contact_number'] === 'yes') : ?>
                    <div class="exam-contact"><?php echo esc_html(um_translate('شماره تماس:', __('شماره تماس:', 'university-management'))); ?> <?php echo esc_html($contact_number); ?></div>
                <?php endif; ?>
                <?php if ($job_title && $settings['show_job_title'] === 'yes') : ?>
                    <div class="exam-job-title"><?php echo esc_html(um_translate('عنوان شغلی:', __('عنوان شغلی:', 'university-management'))); ?> <?php echo esc_html($job_title); ?></div>
                <?php endif; ?>
                <?php if ($education_level && $settings['show_education_level'] === 'yes') : ?>
                    <div class="exam-education"><?php echo esc_html(um_translate('مقطع تحصیلی:', __('مقطع تحصیلی:', 'university-management'))); ?> <?php echo esc_html($education_level); ?></div>
                <?php endif; ?>
                <?php if ($exam_type && $settings['show_exam_type'] === 'yes') : ?>
                    <div class="exam-type"><?php echo esc_html(um_translate('نوع آزمون:', __('نوع آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_type); ?></div>
                <?php endif; ?>
                <?php if ($registration_start_date && $registration_end_date && $settings['show_registration_dates'] === 'yes') : ?>
                    <div class="exam-registration-period"><?php echo esc_html(um_translate('بازه ثبت نام:', __('بازه ثبت نام:', 'university-management'))); ?> <?php echo esc_html($registration_start_date . ' - ' . $registration_end_date); ?></div>
                <?php endif; ?>
                <?php if ($exam_date_custom && $settings['show_exam_date'] === 'yes') : ?>
                    <div class="exam-date-custom"><?php echo esc_html(um_translate('تاریخ آزمون:', __('تاریخ آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_date_custom); ?></div>
                <?php endif; ?>
                <?php if ($exam_time_custom && $settings['show_exam_time'] === 'yes') : ?>
                    <div class="exam-time-custom"><?php echo esc_html(um_translate('زمان آزمون:', __('زمان آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_time_custom); ?></div>
                <?php endif; ?>
                <?php if ($exam_status_custom && $settings['show_exam_status'] === 'yes') : ?>
                    <div class="exam-status-custom"><?php echo esc_html(um_translate('وضعیت آزمون:', __('وضعیت آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_status_custom); ?></div>
                <?php endif; ?>
                <?php if ($employment_link && $employment_link_enabled && $settings['show_employment_link'] === 'yes') : ?>
                    <div class="exam-employment-link"><?php echo esc_html(um_translate('لینک استخدام:', __('لینک استخدام:', 'university-management'))); ?> 
                        <a href="<?php echo esc_url($employment_link); ?>" target="_blank" rel="noopener noreferrer" class="employment-link-btn">
                            <?php echo esc_html(um_translate('مشاهده آگهی', __('مشاهده آگهی', 'university-management'))); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($exam_results_link && $settings['show_exam_results_link'] === 'yes') : ?>
                    <div class="exam-results-link"><?php echo esc_html(um_translate('لینک نتایج:', __('لینک نتایج:', 'university-management'))); ?> 
                        <a href="<?php echo esc_url($exam_results_link); ?>" target="_blank" rel="noopener noreferrer" class="results-link-btn">
                            <?php echo esc_html(um_translate('مشاهده نتایج', __('مشاهده نتایج', 'university-management'))); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <!-- فیلدهای جدید برای حالت دستی در لیست -->
                <?php if ($settings['manual_mode'] === 'yes') : ?>
                    <?php if ($company && $settings['show_company'] === 'yes') : ?>
                        <div class="exam-company"><?php echo esc_html(um_translate('شرکت:', __('شرکت:', 'university-management'))); ?> <?php echo esc_html($company); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($contractor && $settings['show_contractor'] === 'yes') : ?>
                        <div class="exam-contractor"><?php echo esc_html(um_translate('پیمانکار:', __('پیمانکار:', 'university-management'))); ?> <?php echo esc_html($contractor); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($registration_start_manual && $settings['show_registration_start'] === 'yes') : ?>
                        <div class="exam-registration-start-manual"><?php echo esc_html(um_translate('شروع ثبت نام:', __('شروع ثبت نام:', 'university-management'))); ?> <?php echo esc_html($registration_start_manual); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($registration_end_manual && $settings['show_registration_end'] === 'yes') : ?>
                        <div class="exam-registration-end-manual"><?php echo esc_html(um_translate('پایان ثبت نام:', __('پایان ثبت نام:', 'university-management'))); ?> <?php echo esc_html($registration_end_manual); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($exam_time_manual && $settings['show_exam_time_manual'] === 'yes') : ?>
                        <div class="exam-time-manual"><?php echo esc_html(um_translate('زمان آزمون:', __('زمان آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_time_manual); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($service_location && $settings['show_service_location'] === 'yes') : ?>
                        <div class="exam-service-location"><?php echo esc_html(um_translate('محل خدمت:', __('محل خدمت:', 'university-management'))); ?> <?php echo esc_html($service_location); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($contact_manual && $settings['show_contact_manual'] === 'yes') : ?>
                        <div class="exam-contact-manual"><?php echo esc_html(um_translate('شماره تماس:', __('شماره تماس:', 'university-management'))); ?> <?php echo esc_html($contact_manual); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <!-- Dynamic Button based on exam status -->
                <?php 
                // تعیین دکمه و لینک بر اساس وضعیت آزمون
                $button_text = '';
                $button_link = '';
                $button_class = '';
                
                // اگر حالت دستی فعال است، از متن دستی استفاده کن
                if ($settings['manual_mode'] === 'yes' && !empty($settings['manual_button_text'])) {
                    $button_text = $settings['manual_button_text'];
                    $button_link = $employment_link;
                    $button_class = 'btn-manual';
                } else {
                    // منطق قبلی برای حالت خودکار
                    switch($exam_status_custom) {
                        case 'در انتظار برگزاری':
                        case 'در حال ثبت نام':
                            $button_text = um_translate('ثبت نام', __('ثبت نام', 'university-management'));
                            $button_link = $employment_link;
                            $button_class = 'btn-register';
                            break;
                        case 'بسته':
                            $button_text = um_translate('بسته', __('بسته', 'university-management'));
                            $button_link = '#';
                            $button_class = 'btn-closed';
                            break;
                        case 'اعلام نتایج':
                            // وقتی وضعیت "اعلام نتایج" باشد، در بخش لیست دکمه نمایش داده نشود
                            $button_text = '';
                            $button_link = '';
                            $button_class = '';
                            break;
                        default:
                            $button_text = um_translate('مشاهده آگهی', __('مشاهده آگهی', 'university-management'));
                            $button_link = $employment_link;
                            $button_class = 'btn-default';
                    }
                }
                
                if ($button_link && $button_link !== '#') : ?>
                    <div class="exam-dynamic-button">
                        <a href="<?php echo esc_url($button_link); ?>" target="_blank" rel="noopener noreferrer" class="dynamic-btn <?php echo esc_attr($button_class); ?>">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($exam_date_custom) : ?>
                    <div class="exam-date-custom"><?php echo esc_html(um_translate('تاریخ آزمون:', __('تاریخ آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_date_custom); ?></div>
                <?php endif; ?>
                <?php if ($exam_time_custom) : ?>
                    <div class="exam-time-custom"><?php echo esc_html(um_translate('زمان آزمون:', __('زمان آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_time_custom); ?></div>
                <?php endif; ?>
                <?php if ($exam_status_custom) : ?>
                    <div class="exam-status-custom"><?php echo esc_html(um_translate('وضعیت آزمون:', __('وضعیت آزمون:', 'university-management'))); ?> <?php echo esc_html($exam_status_custom); ?></div>
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