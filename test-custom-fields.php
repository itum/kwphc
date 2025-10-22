<?php
/**
 * تست فیلدهای سفارشی آزمون‌های استخدامی
 * این فایل برای تست عملکرد فیلدهای سفارشی جدید ایجاد شده است
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// بررسی دسترسی کاربر
if (!current_user_can('manage_options')) {
    wp_die(__('شما دسترسی به این صفحه را ندارید.', 'university-management'));
}

// دریافت آزمون‌های موجود
$args = array(
    'post_type'      => 'um_employment_exams',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$exams = new WP_Query($args);

?>

<div class="wrap">
    <h1><?php _e('تست فیلدهای سفارشی آزمون‌های استخدامی', 'university-management'); ?></h1>
    
    <div style="background: #f0f8ff; padding: 15px; margin: 20px 0; border-left: 4px solid #0073aa;">
        <h3><?php _e('اطلاعات سیستم', 'university-management'); ?></h3>
        <p><strong><?php _e('تعداد آزمون‌های موجود:', 'university-management'); ?></strong> <?php echo $exams->found_posts; ?></p>
        <p><strong><?php _e('پست تایپ ثبت شده:', 'university-management'); ?></strong> <?php echo post_type_exists('um_employment_exams') ? 'بله' : 'خیر'; ?></p>
        <p><strong><?php _e('فیلدهای سفارشی ثبت شده:', 'university-management'); ?></strong></p>
        <ul>
            <li>city (نام شهر خدمت)</li>
            <li>contact_number (شماره تماس)</li>
            <li>job_title (عنوان شغلی مورد نیاز)</li>
            <li>education_level (مقطع تحصیلی مورد نیاز)</li>
            <li>exam_type (نوع آزمون)</li>
            <li>registration_start_date (شروع ثبت نام)</li>
            <li>registration_end_date (پایان ثبت نام)</li>
            <li>employment_link (لینک استخدام)</li>
            <li>employment_link_enabled (وضعیت فعال بودن لینک استخدام)</li>
        <li>exam_time (زمان آزمون)</li>
        <li>exam_date_custom (تاریخ آزمون)</li>
        <li>exam_status_custom (وضعیت آزمون)</li>
        <li>exam_results_link (لینک نتایج آزمون)</li>
            <li>exam_date (تاریخ آزمون)</li>
            <li>end_date (تاریخ پایان ثبت نام)</li>
        </ul>
    </div>
    
    <?php if ($exams->have_posts()) : ?>
        <h2><?php _e('آزمون‌های موجود و فیلدهای سفارشی آنها', 'university-management'); ?></h2>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('عنوان آزمون', 'university-management'); ?></th>
                    <th><?php _e('نام شهر خدمت', 'university-management'); ?></th>
                    <th><?php _e('شماره تماس', 'university-management'); ?></th>
                    <th><?php _e('عنوان شغلی', 'university-management'); ?></th>
                    <th><?php _e('مقطع تحصیلی', 'university-management'); ?></th>
                    <th><?php _e('نوع آزمون', 'university-management'); ?></th>
                    <th><?php _e('تاریخ آزمون', 'university-management'); ?></th>
                    <th><?php _e('زمان آزمون', 'university-management'); ?></th>
                    <th><?php _e('تاریخ آزمون سفارشی', 'university-management'); ?></th>
                    <th><?php _e('وضعیت آزمون', 'university-management'); ?></th>
                    <th><?php _e('لینک نتایج', 'university-management'); ?></th>
                    <th><?php _e('پایان ثبت نام', 'university-management'); ?></th>
                    <th><?php _e('لینک استخدام', 'university-management'); ?></th>
                    <th><?php _e('وضعیت لینک', 'university-management'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($exams->have_posts()) : $exams->the_post(); 
                    $city = get_post_meta(get_the_ID(), 'city', true);
                    $contact_number = get_post_meta(get_the_ID(), 'contact_number', true);
                    $job_title = get_post_meta(get_the_ID(), 'job_title', true);
                    $education_level = get_post_meta(get_the_ID(), 'education_level', true);
                    $exam_type = get_post_meta(get_the_ID(), 'exam_type', true);
                    $exam_date = get_post_meta(get_the_ID(), 'exam_date', true);
                    $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                    $registration_start_date = get_post_meta(get_the_ID(), 'registration_start_date', true);
                    $registration_end_date = get_post_meta(get_the_ID(), 'registration_end_date', true);
                    $employment_link = get_post_meta(get_the_ID(), 'employment_link', true);
                    $employment_link_enabled = get_post_meta(get_the_ID(), 'employment_link_enabled', true);
                    $exam_time_custom = get_post_meta(get_the_ID(), 'exam_time', true);
                    $exam_date_custom = get_post_meta(get_the_ID(), 'exam_date_custom', true);
                    $exam_status_custom = get_post_meta(get_the_ID(), 'exam_status_custom', true);
                    $exam_results_link = get_post_meta(get_the_ID(), 'exam_results_link', true);
                ?>
                    <tr>
                        <td><strong><?php the_title(); ?></strong></td>
                        <td><?php echo esc_html($city ?: '-'); ?></td>
                        <td><?php echo esc_html($contact_number ?: '-'); ?></td>
                        <td><?php echo esc_html($job_title ?: '-'); ?></td>
                        <td><?php echo esc_html($education_level ?: '-'); ?></td>
                        <td><?php echo esc_html($exam_type ?: '-'); ?></td>
                        <td><?php echo esc_html($exam_date ?: '-'); ?></td>
                        <td><?php echo esc_html($exam_time_custom ?: '-'); ?></td>
                        <td><?php echo esc_html($exam_date_custom ?: '-'); ?></td>
                        <td><?php echo esc_html($exam_status_custom ?: '-'); ?></td>
                        <td>
                            <?php if ($exam_results_link) : ?>
                                <a href="<?php echo esc_url($exam_results_link); ?>" target="_blank" rel="noopener noreferrer" class="button button-small">
                                    <?php _e('نتایج', 'university-management'); ?>
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($end_date ?: '-'); ?></td>
                        <td>
                            <?php if ($employment_link) : ?>
                                <a href="<?php echo esc_url($employment_link); ?>" target="_blank" rel="noopener noreferrer" class="button button-small">
                                    <?php _e('مشاهده', 'university-management'); ?>
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($employment_link_enabled) : ?>
                                <span style="color: #28a745; font-weight: bold;"><?php _e('فعال', 'university-management'); ?></span>
                            <?php else : ?>
                                <span style="color: #dc3545; font-weight: bold;"><?php _e('غیرفعال', 'university-management'); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <?php wp_reset_postdata(); ?>
        
        <div style="background: #d4edda; padding: 15px; margin: 20px 0; border-left: 4px solid #28a745;">
            <h3><?php _e('نکات مهم:', 'university-management'); ?></h3>
            <ul>
                <li><?php _e('فیلدهای تاریخ شروع و پایان ثبت نام به صورت دستی وارد می‌شوند (فرمت: YYYY/MM/DD)', 'university-management'); ?></li>
                <li><?php _e('فیلدهای تاریخ به صورت خودکار فرمت می‌شوند', 'university-management'); ?></li>
                <li><?php _e('لینک استخدام فقط در صورت فعال بودن نمایش داده می‌شود', 'university-management'); ?></li>
                <li><?php _e('وضعیت آزمون از چهار گزینه انتخاب می‌شود', 'university-management'); ?></li>
                <li><?php _e('فیلدهای سفارشی جدید با کلیدهای مخصوص ذخیره می‌شوند', 'university-management'); ?></li>
                <li><?php _e('لینک نتایج آزمون برای نمایش نتایج استفاده می‌شود', 'university-management'); ?></li>
                <li><?php _e('کنترل‌های نمایش در تنظیمات ویجت المنتور قابل تنظیم است', 'university-management'); ?></li>
            </ul>
        </div>
        
        <div style="background: #d4edda; padding: 15px; margin: 20px 0; border-left: 4px solid #28a745;">
            <h3><?php _e('نحوه استفاده', 'university-management'); ?></h3>
            <ol>
                <li><?php _e('برای افزودن آزمون جدید با فیلدهای سفارشی، به صفحه "مدیریت آزمون‌های استخدامی" بروید', 'university-management'); ?></li>
                <li><?php _e('فرم را تکمیل کنید و فیلدهای جدید را پر کنید', 'university-management'); ?></li>
                <li><?php _e('فیلدها به صورت خودکار ذخیره می‌شوند و در ویجت نمایش داده می‌شوند', 'university-management'); ?></li>
                <li><?php _e('برای ویرایش آزمون موجود، روی دکمه "ویرایش" کلیک کنید', 'university-management'); ?></li>
                <li><?php _e('کنترل‌های نمایش را در تنظیمات ویجت المنتور می‌توانید تغییر دهید', 'university-management'); ?></li>
            </ol>
        </div>
        
    <?php else : ?>
        <div style="background: #f8d7da; padding: 15px; margin: 20px 0; border-left: 4px solid #dc3545;">
            <h3><?php _e('هیچ آزمونی یافت نشد', 'university-management'); ?></h3>
            <p><?php _e('برای تست فیلدهای سفارشی، ابتدا یک آزمون استخدامی اضافه کنید.', 'university-management'); ?></p>
            <p><a href="<?php echo admin_url('admin.php?page=employment-exams'); ?>" class="button button-primary"><?php _e('افزودن آزمون جدید', 'university-management'); ?></a></p>
        </div>
    <?php endif; ?>
    
        <div style="background: #fff3cd; padding: 15px; margin: 20px 0; border-left: 4px solid #ffc107;">
            <h3><?php _e('نکات مهم', 'university-management'); ?></h3>
            <ul>
                <li><?php _e('تمام فیلدهای سفارشی اختیاری هستند', 'university-management'); ?></li>
                <li><?php _e('فیلدها در تمام انواع نمایش (کارت، جدول، لیست) نمایش داده می‌شوند', 'university-management'); ?></li>
                <li><?php _e('فیلدها برای سازگاری با سیستم موجود، در دو مکان ذخیره می‌شوند', 'university-management'); ?></li>
                <li><?php _e('استایل‌های مخصوص برای هر فیلد در CSS تعریف شده است', 'university-management'); ?></li>
                <li><?php _e('تاریخ‌های ثبت نام باید به فرمت YYYY/MM/DD وارد شوند (مثال: 1404/07/27)', 'university-management'); ?></li>
                <li><?php _e('سیستم به صورت خودکار فرمت تاریخ را هنگام تایپ اصلاح می‌کند', 'university-management'); ?></li>
            </ul>
        </div>
</div>
