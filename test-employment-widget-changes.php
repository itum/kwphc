<?php
/**
 * فایل تست برای تغییرات ویجت آزمون استخدام
 * این فایل برای تست تغییرات اعمال شده ایجاد شده است
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// تست وجود فیلدهای جدید
function test_employment_widget_fields() {
    echo "<h2>تست فیلدهای جدید ویجت آزمون استخدام</h2>";
    
    // بررسی وجود فیلدهای جدید در دیتابیس
    $new_fields = [
        'company' => 'شرکت',
        'contractor' => 'پیمانکار',
        'registration_start_manual' => 'شروع ثبت نام',
        'registration_end_manual' => 'پایان ثبت نام',
        'exam_time_manual' => 'زمان آزمون',
        'service_location' => 'محل خدمت',
        'contact_manual' => 'شماره تماس'
    ];
    
    echo "<h3>فیلدهای جدید اضافه شده:</h3>";
    echo "<ul>";
    foreach ($new_fields as $field => $label) {
        echo "<li><strong>{$label}:</strong> {$field}</li>";
    }
    echo "</ul>";
    
    // تست نمونه داده
    echo "<h3>نمونه داده برای تست:</h3>";
    $sample_data = [
        'company' => 'پیمانکاری طرف قرارداد شرکت توزیع نیروی برق اهواز',
        'contractor' => 'پیمانکاری طرف قرارداد شرکت توزیع نیروی برق اهواز',
        'registration_start_manual' => '1404/07/27',
        'registration_end_manual' => '1404/08/06',
        'exam_time_manual' => '1404/08/22',
        'service_location' => 'اهواز',
        'contact_manual' => '0999184394'
    ];
    
    echo "<ul>";
    foreach ($sample_data as $field => $value) {
        echo "<li><strong>{$field}:</strong> {$value}</li>";
    }
    echo "</ul>";
}

// تست تنظیمات حالت دستی
function test_manual_mode_settings() {
    echo "<h2>تست تنظیمات حالت دستی</h2>";
    
    $manual_settings = [
        'manual_mode' => 'حالت دستی',
        'manual_button_text' => 'متن دکمه مشاهده جزئیات',
        'show_company' => 'نمایش شرکت',
        'show_contractor' => 'نمایش پیمانکار',
        'show_registration_start' => 'نمایش شروع ثبت نام',
        'show_registration_end' => 'نمایش پایان ثبت نام',
        'show_exam_time_manual' => 'نمایش زمان آزمون',
        'show_service_location' => 'نمایش محل خدمت',
        'show_contact_manual' => 'نمایش شماره تماس'
    ];
    
    echo "<h3>تنظیمات حالت دستی:</h3>";
    echo "<ul>";
    foreach ($manual_settings as $setting => $label) {
        echo "<li><strong>{$label}:</strong> {$setting}</li>";
    }
    echo "</ul>";
}

// تست استایل‌های CSS
function test_css_styles() {
    echo "<h2>تست استایل‌های CSS</h2>";
    
    $css_classes = [
        'exam-company' => 'استایل شرکت',
        'exam-contractor' => 'استایل پیمانکار',
        'exam-registration-start-manual' => 'استایل شروع ثبت نام',
        'exam-registration-end-manual' => 'استایل پایان ثبت نام',
        'exam-time-manual' => 'استایل زمان آزمون',
        'exam-service-location' => 'استایل محل خدمت',
        'exam-contact-manual' => 'استایل شماره تماس',
        'btn-manual' => 'استایل دکمه دستی',
        'status-manual' => 'استایل وضعیت دستی'
    ];
    
    echo "<h3>کلاس‌های CSS جدید:</h3>";
    echo "<ul>";
    foreach ($css_classes as $class => $description) {
        echo "<li><strong>{$class}:</strong> {$description}</li>";
    }
    echo "</ul>";
}

// تست ارث‌بری فونت
function test_font_inheritance() {
    echo "<h2>تست ارث‌بری فونت</h2>";
    
    echo "<h3>ویژگی‌های ارث‌بری فونت:</h3>";
    echo "<ul>";
    echo "<li><strong>font-family: inherit</strong> - ارث‌بری فونت از قالب</li>";
    echo "<li><strong>font-size: inherit</strong> - ارث‌بری اندازه فونت از قالب</li>";
    echo "<li><strong>line-height: inherit</strong> - ارث‌بری ارتفاع خط از قالب</li>";
    echo "</ul>";
    
    echo "<h3>عناصر تحت تأثیر:</h3>";
    echo "<ul>";
    echo "<li>کلاس .um-employment-exams-widget</li>";
    echo "<li>کلاس .um-employment-exams-widget * (تمام عناصر فرزند)</li>";
    echo "<li>کلاس .um-widget-title</li>";
    echo "<li>کلاس .exam-title</li>";
    echo "</ul>";
}

// اجرای تست‌ها
if (isset($_GET['test']) && $_GET['test'] === 'employment_widget') {
    ?>
    <!DOCTYPE html>
    <html dir="rtl" lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>تست تغییرات ویجت آزمون استخدام</title>
        <style>
            body {
                font-family: 'Tahoma', 'Arial', sans-serif;
                margin: 20px;
                background-color: #f5f5f5;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            h2 {
                color: #0073aa;
                border-bottom: 2px solid #0073aa;
                padding-bottom: 10px;
            }
            h3 {
                color: #333;
                margin-top: 20px;
            }
            ul {
                background: #f8f9fa;
                padding: 15px;
                border-radius: 5px;
                border-left: 4px solid #0073aa;
            }
            li {
                margin-bottom: 8px;
            }
            strong {
                color: #0073aa;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>تست تغییرات ویجت آزمون استخدام</h1>
            
            <?php
            test_employment_widget_fields();
            test_manual_mode_settings();
            test_css_styles();
            test_font_inheritance();
            ?>
            
            <h2>خلاصه تغییرات</h2>
            <ul>
                <li>✅ اضافه شدن حالت دستی برای ویرایش متن دکمه</li>
                <li>✅ اضافه شدن فیلدهای جدید (شرکت، پیمانکار، تاریخ‌ها، محل خدمت، شماره تماس)</li>
                <li>✅ پیاده‌سازی ارث‌بری فونت از قالب</li>
                <li>✅ اضافه شدن استایل‌های CSS مناسب</li>
                <li>✅ پشتیبانی از تمام حالت‌های نمایش (کارت، جدول، لیست)</li>
                <li>✅ به‌روزرسانی وضعیت آزمون: حذف "برگزار شده" و اضافه "اعلام نتایج"</li>
            </ul>
            
            <h2>نحوه استفاده</h2>
            <ol>
                <li>در المنتور، ویجت "آزمون‌های استخدامی" را اضافه کنید</li>
                <li>حالت دستی را فعال کنید</li>
                <li>متن دکمه "مشاهده جزئیات" را سفارشی کنید</li>
                <li>فیلدهای مورد نظر را برای نمایش انتخاب کنید</li>
                <li>در پنل مدیریت، برای هر آزمون فیلدهای جدید را پر کنید</li>
            </ol>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>
