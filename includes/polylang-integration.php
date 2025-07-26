<?php
/**
 * ادغام Polylang برای افزونه مدیریت دانشگاه
 * 
 * @package University_Management
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// تابع um_translate از فایل safe-polylang-fallback.php بارگذاری می‌شود

/**
 * کلاس ادغام Polylang
 */
class UM_Polylang_Integration {

    /**
     * نمونه کلاس
     * @var UM_Polylang_Integration
     */
    private static $instance = null;

    /**
     * دریافت نمونه کلاس
     * @return UM_Polylang_Integration
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
    private function __construct() {
        // فقط اگر Polylang موجود باشد رشته‌ها را ثبت کن
        add_action('init', array($this, 'register_all_strings'), 20);
    }

    /**
     * ثبت تمام رشته‌های ترجمه
     */
    public function register_all_strings() {
        // بررسی وجود Polylang
        if (!function_exists('pll_register_string')) {
            error_log('UM Plugin: Polylang not available for string registration');
            return;
        }
        
        error_log('UM Plugin: Registering strings with Polylang');

        // رشته‌های عمومی
        $this->register_general_strings();
        
        // رشته‌های ویجت تقویم
        $this->register_calendar_widget_strings();
        
        // رشته‌های ویجت زمان‌بندی کلاس‌ها
        $this->register_class_timer_widget_strings();
        
        // رشته‌های ویجت ویدیو
        $this->register_video_widget_strings();
        
        // رشته‌های ویجت اسلایدر سمینار
        $this->register_seminar_slider_widget_strings();
        
        // رشته‌های ویجت آزمون
        $this->register_azmoon_widget_strings();
        
        // رشته‌های ویجت آزمون‌های استخدامی
        $this->register_employment_exams_widget_strings();
    }

    /**
     * رشته‌های عمومی
     */
    private function register_general_strings() {
        pll_register_string('um_general_university_management', 'مدیریت دانشگاه', 'University Management');
        pll_register_string('um_general_content', 'محتوا', 'University Management');
        pll_register_string('um_general_style', 'استایل', 'University Management');
        pll_register_string('um_general_general_settings', 'تنظیمات عمومی', 'University Management');
        pll_register_string('um_general_manual', 'دستی', 'University Management');
        pll_register_string('um_general_auto', 'خودکار (از پست‌تایپ)', 'University Management');
        pll_register_string('um_general_yes', 'بله', 'University Management');
        pll_register_string('um_general_no', 'خیر', 'University Management');
    }

    /**
     * رشته‌های ویجت تقویم
     */
    private function register_calendar_widget_strings() {
        pll_register_string('um_calendar_widget_title', 'تقویم دانشگاه', 'University Management');
        pll_register_string('um_calendar_widget_event_source', 'منبع رویدادها', 'University Management');
        pll_register_string('um_calendar_widget_events_count', 'تعداد رویدادها', 'University Management');
        pll_register_string('um_calendar_widget_manual_events', 'رویدادهای دستی', 'University Management');
        pll_register_string('um_calendar_widget_event_date', 'تاریخ رویداد', 'University Management');
        pll_register_string('um_calendar_widget_event_title', 'عنوان رویداد', 'University Management');
        pll_register_string('um_calendar_widget_is_important', 'رویداد مهم (هایلایت)', 'University Management');
        pll_register_string('um_calendar_widget_events', 'رویدادها', 'University Management');
        pll_register_string('um_calendar_widget_no_events_found', 'هیچ رویدادی یافت نشد.', 'University Management');
        pll_register_string('um_calendar_widget_start_classes', 'شروع کلاس‌ها', 'University Management');
        pll_register_string('um_calendar_widget_project_presentation', 'ارائه پروژه', 'University Management');
        pll_register_string('um_calendar_widget_midterm_exam', 'میان‌ترم', 'University Management');
    }

    /**
     * رشته‌های ویجت زمان‌بندی کلاس‌ها
     */
    private function register_class_timer_widget_strings() {
        pll_register_string('um_class_timer_widget_title', 'زمان‌بندی کلاس‌ها', 'University Management');
        pll_register_string('um_class_timer_widget_class_source', 'منبع کلاس‌ها', 'University Management');
        pll_register_string('um_class_timer_widget_classes_count', 'تعداد کلاس‌ها', 'University Management');
        pll_register_string('um_class_timer_widget_manual_classes', 'کلاس‌های دستی', 'University Management');
        pll_register_string('um_class_timer_widget_class_name', 'نام کلاس', 'University Management');
        pll_register_string('um_class_timer_widget_class_date', 'تاریخ کلاس', 'University Management');
        pll_register_string('um_class_timer_widget_class_duration', 'مدت زمان کلاس (دقیقه)', 'University Management');
        pll_register_string('um_class_timer_widget_class_teacher', 'نام استاد', 'University Management');
        pll_register_string('um_class_timer_widget_class_image', 'تصویر کلاس', 'University Management');
        pll_register_string('um_class_timer_widget_classes', 'کلاس‌ها', 'University Management');
        pll_register_string('um_class_timer_widget_python_programming', 'کلاس برنامه‌نویسی پایتون', 'University Management');
        pll_register_string('um_class_timer_widget_ai_basics', 'کلاس مبانی هوش مصنوعی', 'University Management');
        pll_register_string('um_class_timer_widget_dr_mohammadi', 'دکتر محمدی', 'University Management');
        pll_register_string('um_class_timer_widget_dr_alavi', 'دکتر علوی', 'University Management');
    }

    /**
     * رشته‌های ویجت ویدیو
     */
    private function register_video_widget_strings() {
        pll_register_string('um_video_widget_title', 'مدیریت ویدیوها', 'University Management');
        pll_register_string('um_video_widget_title_one', 'عنوان اول', 'University Management');
        pll_register_string('um_video_widget_title_two', 'عنوان دوم', 'University Management');
        pll_register_string('um_video_widget_video_source', 'منبع ویدیوها', 'University Management');
        pll_register_string('um_video_widget_video_category', 'دسته‌بندی ویدیوها', 'University Management');
        pll_register_string('um_video_widget_videos_count', 'تعداد ویدیوها', 'University Management');
        pll_register_string('um_video_widget_manual_videos', 'ویدیوهای دستی', 'University Management');
        pll_register_string('um_video_widget_video_title_label', 'عنوان ویدیو', 'University Management');
        pll_register_string('um_video_widget_video_url', 'آدرس ویدیو (MP4)', 'University Management');
        pll_register_string('um_video_widget_video_thumbnail', 'تصویر کوچک ویدیو', 'University Management');
        pll_register_string('um_video_widget_videos', 'ویدیوها', 'University Management');
        pll_register_string('um_video_widget_first_video', 'ویدیو اول', 'University Management');
        pll_register_string('um_video_widget_second_video', 'ویدیو دوم', 'University Management');
        pll_register_string('um_video_widget_general_category', 'عمومی', 'University Management');
        pll_register_string('um_video_widget_categories_label', 'دسته بندی ها', 'University Management');
        pll_register_string('um_video_widget_default_category', 'پیش‌فرض', 'University Management');
    }

    /**
     * رشته‌های ویجت اسلایدر سمینار
     */
    private function register_seminar_slider_widget_strings() {
        pll_register_string('um_seminar_slider_widget_title', 'اسلایدر کارگاه و سمینار', 'University Management');
        pll_register_string('um_seminar_slider_widget_main_title', 'عنوان اصلی', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_source', 'منبع کارگاه‌ها', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_category', 'دسته‌بندی کارگاه‌ها', 'University Management');
        pll_register_string('um_seminar_slider_widget_posts_per_page', 'تعداد برای نمایش', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_image', 'تصویر', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_title', 'عنوان کارگاه', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_time', 'زمان برگزاری', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_teacher', 'مدرس', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_link', 'لینک دکمه', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_button_text', 'عنوان دکمه', 'University Management');
        pll_register_string('um_seminar_slider_widget_seminar_list', 'لیست کارگاه‌ها', 'University Management');
        pll_register_string('um_seminar_slider_widget_start_learning', 'شروع یادگیری', 'University Management');
        pll_register_string('um_seminar_slider_widget_time_label', 'زمان برگزاری:', 'University Management');
        pll_register_string('um_seminar_slider_widget_teacher_label', 'مدرس:', 'University Management');
        pll_register_string('um_seminar_slider_widget_all_categories', 'همه دسته‌بندی‌ها', 'University Management');
    }

    /**
     * رشته‌های ویجت آزمون
     */
    private function register_azmoon_widget_strings() {
        pll_register_string('um_azmoon_widget_title', 'آزمون استخدامی', 'University Management');
        pll_register_string('um_azmoon_widget_main_title', 'عنوان اصلی', 'University Management');
        pll_register_string('um_azmoon_widget_azmoon_source', 'منبع آزمون‌ها', 'University Management');
        pll_register_string('um_azmoon_widget_posts_per_page', 'تعداد برای نمایش', 'University Management');
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
        pll_register_string('um_azmoon_widget_view_details', 'مشاهده جزئیات', 'University Management');
        pll_register_string('um_azmoon_widget_no_azmoon_found', 'هیچ آزمونی یافت نشد.', 'University Management');
        pll_register_string('um_azmoon_widget_status_unknown', 'نامشخص', 'University Management');
    }

    /**
     * رشته‌های ویجت آزمون‌های استخدامی
     */
    private function register_employment_exams_widget_strings() {
        pll_register_string('um_employment_exams_widget_title', 'آزمون‌های استخدامی', 'University Management');
        pll_register_string('um_employment_exams_widget_widget_title', 'عنوان ویجت', 'University Management');
        pll_register_string('um_employment_exams_widget_exams_count', 'تعداد آزمون‌ها', 'University Management');
        pll_register_string('um_employment_exams_widget_status_filter', 'فیلتر وضعیت', 'University Management');
        pll_register_string('um_employment_exams_widget_status_all', 'همه', 'University Management');
        pll_register_string('um_employment_exams_widget_status_upcoming', 'در انتظار برگزاری', 'University Management');
        pll_register_string('um_employment_exams_widget_status_registration', 'در حال ثبت‌نام', 'University Management');
        pll_register_string('um_employment_exams_widget_status_closed', 'بسته', 'University Management');
        pll_register_string('um_employment_exams_widget_status_completed', 'برگزار شده', 'University Management');
        pll_register_string('um_employment_exams_widget_display_type', 'نوع نمایش', 'University Management');
        pll_register_string('um_employment_exams_widget_display_type_cards', 'کارت‌ها', 'University Management');
        pll_register_string('um_employment_exams_widget_display_type_table', 'جدول', 'University Management');
        pll_register_string('um_employment_exams_widget_display_type_list', 'لیست', 'University Management');
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
    }

    /**
     * تابع کمکی برای دریافت ترجمه
     * 
     * @param string $string رشته فارسی
     * @param string $fallback رشته پیش‌فرض
     * @return string
     */
    public static function get_translation($string, $fallback = null) {
        // بررسی وجود Polylang
        if (function_exists('pll__')) {
            $translation = pll__($string);
            // بررسی اینکه آیا ترجمه یافت شده یا نه
            if ($translation && $translation !== $string) {
                return $translation;
            }
        }
        
        // اگر ترجمه یافت نشد، fallback را برگردان
        return $fallback ?: $string;
    }
}

// راه‌اندازی کلاس
UM_Polylang_Integration::get_instance();

 