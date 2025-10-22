<?php
/**
 * تست گزینه "اعلام نتایج" در آزمون‌های استخدامی
 * این فایل برای تست و اطمینان از نمایش گزینه "اعلام نتایج" ایجاد شده است
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
    <h1><?php _e('تست گزینه "اعلام نتایج" در آزمون‌های استخدامی', 'university-management'); ?></h1>
    
    <div style="background: #f0f8ff; padding: 15px; margin: 20px 0; border-left: 4px solid #0073aa;">
        <h3><?php _e('اطلاعات سیستم', 'university-management'); ?></h3>
        <p><strong><?php _e('تعداد آزمون‌های موجود:', 'university-management'); ?></strong> <?php echo $exams->found_posts; ?></p>
        <p><strong><?php _e('پست تایپ ثبت شده:', 'university-management'); ?></strong> <?php echo post_type_exists('um_employment_exams') ? 'بله' : 'خیر'; ?></p>
        <p><strong><?php _e('فیلدهای سفارشی ثبت شده:', 'university-management'); ?></strong></p>
        <ul>
            <li>exam_status_custom (وضعیت آزمون) - <?php echo get_registered_meta_keys('post')['exam_status_custom'] ? 'ثبت شده' : 'ثبت نشده'; ?></li>
            <li>exam_results_link (لینک نتایج آزمون) - <?php echo get_registered_meta_keys('post')['exam_results_link'] ? 'ثبت شده' : 'ثبت نشده'; ?></li>
        </ul>
    </div>
    
    <div style="background: #fff3cd; padding: 15px; margin: 20px 0; border-left: 4px solid #ffc107;">
        <h3><?php _e('راه‌حل‌های پیشنهادی', 'university-management'); ?></h3>
        <ol>
            <li><strong><?php _e('پاک کردن کش:', 'university-management'); ?></strong> <?php _e('از پنل مدیریت WordPress، کش را پاک کنید', 'university-management'); ?></li>
            <li><strong><?php _e('غیرفعال و فعال کردن افزونه:', 'university-management'); ?></strong> <?php _e('افزونه را غیرفعال و مجدداً فعال کنید', 'university-management'); ?></li>
            <li><strong><?php _e('بررسی فایل‌ها:', 'university-management'); ?></strong> <?php _e('اطمینان حاصل کنید که فایل‌ها به درستی آپلود شده‌اند', 'university-management'); ?></li>
        </ol>
    </div>
    
    <?php if ($exams->have_posts()) : ?>
        <h3><?php _e('آزمون‌های موجود و وضعیت آن‌ها', 'university-management'); ?></h3>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('عنوان آزمون', 'university-management'); ?></th>
                    <th><?php _e('وضعیت آزمون', 'university-management'); ?></th>
                    <th><?php _e('لینک نتایج', 'university-management'); ?></th>
                    <th><?php _e('عملیات', 'university-management'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($exams->have_posts()) : $exams->the_post(); 
                    $exam_status_custom = get_post_meta(get_the_ID(), 'exam_status_custom', true);
                    $exam_results_link = get_post_meta(get_the_ID(), 'exam_results_link', true);
                ?>
                    <tr>
                        <td><?php the_title(); ?></td>
                        <td>
                            <span style="padding: 4px 8px; border-radius: 4px; background: <?php echo $exam_status_custom === 'اعلام نتایج' ? '#28a745' : '#6c757d'; ?>; color: white;">
                                <?php echo esc_html($exam_status_custom ?: 'تعریف نشده'); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($exam_results_link) : ?>
                                <a href="<?php echo esc_url($exam_results_link); ?>" target="_blank" style="color: #0073aa;">
                                    <?php echo esc_html($exam_results_link); ?>
                                </a>
                            <?php else : ?>
                                <span style="color: #999;"><?php _e('تعریف نشده', 'university-management'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" class="button button-small">
                                <?php _e('ویرایش', 'university-management'); ?>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p><?php _e('هیچ آزمون استخدامی یافت نشد.', 'university-management'); ?></p>
    <?php endif; ?>
    
    <div style="background: #d1ecf1; padding: 15px; margin: 20px 0; border-left: 4px solid #17a2b8;">
        <h3><?php _e('تست مستقیم گزینه "اعلام نتایج"', 'university-management'); ?></h3>
        <p><?php _e('برای تست مستقیم، لطفاً مراحل زیر را انجام دهید:', 'university-management'); ?></p>
        <ol>
            <li><?php _e('به صفحه افزودن آزمون جدید بروید', 'university-management'); ?></li>
            <li><?php _e('در بخش "جزئیات آزمون استخدامی" فیلد "وضعیت آزمون" را بررسی کنید', 'university-management'); ?></li>
            <li><?php _e('گزینه "اعلام نتایج" باید در لیست موجود باشد', 'university-management'); ?></li>
            <li><?php _e('اگر گزینه موجود نیست، کش را پاک کنید یا افزونه را مجدداً فعال کنید', 'university-management'); ?></li>
        </ol>
    </div>
</div>
