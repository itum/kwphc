<?php
/**
 * صفحه مدیریت زمان‌بندی کلاس‌ها
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// بررسی دسترسی کاربر
if (!current_user_can('manage_options')) {
    wp_die(__('شما دسترسی به این صفحه را ندارید.', 'university-management'));
}

// حذف کلاس (ایمن با نانس)
if (
    isset($_GET['page']) && $_GET['page'] === 'university-class-timing' &&
    isset($_GET['action']) && $_GET['action'] === 'um_delete_class' &&
    isset($_GET['class_id'])
) {
    $class_id = absint($_GET['class_id']);
    if ($class_id) {
        if (!current_user_can('delete_post', $class_id)) {
            add_settings_error('um_class_timing', 'um_class_delete_cap', __('اجازه حذف این کلاس را ندارید.', 'university-management'), 'error');
        } elseif (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'um_delete_class_' . $class_id)) {
            add_settings_error('um_class_timing', 'um_class_delete_nonce', __('اعتبار لینک حذف به پایان رسیده است.', 'university-management'), 'error');
        } else {
            $result = wp_trash_post($class_id);
            if ($result) {
                add_settings_error('um_class_timing', 'um_class_deleted', __('کلاس با موفقیت حذف شد.', 'university-management'), 'success');
            } else {
                add_settings_error('um_class_timing', 'um_class_delete_error', __('خطا در حذف کلاس.', 'university-management'), 'error');
            }
        }
    }
}

// دانلود فایل نمونه اکسل
if (
    isset($_GET['page']) && $_GET['page'] === 'university-class-timing' &&
    isset($_GET['action']) && $_GET['action'] === 'um_download_sample_xlsx'
) {
    if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'um_download_sample_xlsx')) {
        wp_die(__('درخواست نامعتبر است.', 'university-management'));
    }
    // English headers for maximum compatibility
    $headers = array(
        'class_name (required)',
        'date_mode (single|range, required)',
        'date_start (YYYY-MM-DD, required)',
        'date_end (YYYY-MM-DD, optional for range)',
        'class_time (HH:MM, required)',
        'duration_minutes (required)',
        'teacher_name (required)',
        'status (scheduled|canceled|postponed|finished, optional)',
        'description (optional)',
        'sat','sun','mon','tue','wed','thu','fri'
    );
    // Use Shamsi in sample
    $g1 = strtotime('+3 days');
    $g2s = strtotime('+1 week'); $g2e = strtotime('+3 week');
    list($j1y,$j1m,$j1d) = um_gregorian_to_jalali(intval(date('Y',$g1)), intval(date('n',$g1)), intval(date('j',$g1)));
    list($j2sy,$j2sm,$j2sd) = um_gregorian_to_jalali(intval(date('Y',$g2s)), intval(date('n',$g2s)), intval(date('j',$g2s)));
    list($j2ey,$j2em,$j2ed) = um_gregorian_to_jalali(intval(date('Y',$g2e)), intval(date('n',$g2e)), intval(date('j',$g2e)));
    $row1 = array('Sample PHP Class','single', sprintf('%04d/%02d/%02d',$j1y,$j1m,$j1d), '', '10:00', '90', 'Professor Demo', 'scheduled', 'Single date class example', 'no','no','no','no','no','no','no');
    $row2 = array('NodeJS Course','range', sprintf('%04d/%02d/%02d',$j2sy,$j2sm,$j2sd), sprintf('%04d/%02d/%02d',$j2ey,$j2em,$j2ed), '14:00', '90', 'Engineer Demo', 'scheduled', 'Create classes on selected weekdays', 'yes','no','yes','no','yes','no','no');
    $rows = array($headers, $row1, $row2);
    // Always deliver UTF-8 CSV (Excel compatible)
    if (!headers_sent()) {
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="um-classes-sample.csv"');
        header('Pragma: public');
        header('Cache-Control: max-age=0');
    }
    echo "\xEF\xBB\xBF"; // UTF-8 BOM for Excel
    $out = fopen('php://output', 'w');
    foreach ($rows as $r) { fputcsv($out, $r); }
    fclose($out);
    exit;
}

// حذف دسته‌ای کلاس‌ها بر اساس batch_id
if (
    isset($_GET['page']) && $_GET['page'] === 'university-class-timing' &&
    isset($_GET['action']) && $_GET['action'] === 'um_delete_import_batch' &&
    isset($_GET['batch_id'])
) {
    if (!current_user_can('manage_options')) {
        add_settings_error('um_class_timing', 'um_batch_delete_cap', __('اجازه انجام این عملیات را ندارید.', 'university-management'), 'error');
    } elseif (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'um_delete_import_batch_' . sanitize_text_field($_GET['batch_id']))) {
        add_settings_error('um_class_timing', 'um_batch_delete_nonce', __('اعتبار لینک حذف به پایان رسیده است.', 'university-management'), 'error');
    } else {
        global $wpdb;
        $batch_id = sanitize_text_field($_GET['batch_id']);
        $post_ids = $wpdb->get_col($wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value = %s",
            '_um_batch_id',
            $batch_id
        ));
        $deleted = 0;
        if (!empty($post_ids)) {
            foreach ($post_ids as $pid) {
                $res = wp_delete_post((int)$pid, true); // حذف دائمی
                if ($res) { $deleted++; }
            }
        }
        if ($deleted > 0) {
            add_settings_error('um_class_timing', 'um_batch_deleted', sprintf(__('تعداد %1$d کلاس مربوط به ایمپورت %2$s حذف شد', 'university-management'), $deleted, esc_html($batch_id)), 'success');
        } else {
            add_settings_error('um_class_timing', 'um_batch_not_found', __('هیچ کلاسی با این batch_id یافت نشد.', 'university-management'), 'warning');
        }
    }
}

// وضعیت ویرایش (لود داده‌های کلاس برای فرم)
$editing_class = null;
$editing_id = 0;
$editing_name = '';
$editing_date_greg = '';
$editing_time = '';
$editing_duration = 90;
$editing_teacher = '';
$editing_description = '';
$editing_status = 'scheduled';

if (
    isset($_GET['page']) && $_GET['page'] === 'university-class-timing' &&
    isset($_GET['action']) && $_GET['action'] === 'um_edit_class' &&
    isset($_GET['class_id'])
) {
    $editing_id = absint($_GET['class_id']);
    if ($editing_id) {
        if (!current_user_can('edit_post', $editing_id)) {
            add_settings_error('um_class_timing', 'um_class_edit_cap', __('اجازه ویرایش این کلاس را ندارید.', 'university-management'), 'error');
        } else {
            $editing_class = get_post($editing_id);
            if ($editing_class && $editing_class->post_type === 'um_classes') {
                $editing_name = $editing_class->post_title;
                $editing_description = $editing_class->post_content;
                $full_dt = get_post_meta($editing_id, '_class_date', true); // YYYY-MM-DD HH:MM:SS
                if ($full_dt) {
                    $editing_date_greg = date('Y-m-d', strtotime($full_dt));
                    $editing_time = date('H:i', strtotime($full_dt));
                }
                $editing_duration = get_post_meta($editing_id, '_class_duration', true);
                $editing_teacher = get_post_meta($editing_id, '_class_teacher', true);
                $editing_status = get_post_meta($editing_id, '_class_status', true) ?: 'scheduled';
            }
        }
    }
}

// پردازش فرم ارسالی
if (isset($_POST['um_add_class_nonce']) && wp_verify_nonce($_POST['um_add_class_nonce'], 'um_add_class')) {
    
    // بررسی وجود پست تایپ
    if (!post_type_exists('um_classes')) {
        add_settings_error('um_class_timing', 'um_post_type_error', __('خطا: پست تایپ "um_classes" ثبت نشده است. لطفاً افزونه را غیرفعال و مجدداً فعال کنید.', 'university-management'), 'error');
    } else {
        // دریافت مقادیر فرم
        $class_name = sanitize_text_field($_POST['class_name']);
        // حالت های تاریخ: single | range
        $date_mode = isset($_POST['date_mode']) ? sanitize_text_field($_POST['date_mode']) : 'single';
        // فیلدهای تاریخ (میلادی که در hidden ذخیره می‌شوند)
        $date_from = isset($_POST['date_from']) ? sanitize_text_field($_POST['date_from']) : '';
        $date_to   = isset($_POST['date_to']) ? sanitize_text_field($_POST['date_to']) : '';
        // برای سازگاری قدیمی اگر class_date ارسال شد
        $legacy_class_date = isset($_POST['class_date']) ? sanitize_text_field($_POST['class_date']) : '';
        $class_time = sanitize_text_field($_POST['class_time']);
        $class_duration = absint($_POST['class_duration']);
        $class_teacher = sanitize_text_field($_POST['class_teacher']);
        $class_description = wp_kses_post($_POST['class_description']);
        $class_status = isset($_POST['class_status']) ? sanitize_text_field($_POST['class_status']) : 'scheduled';
        $full_week = isset($_POST['full_week']) ? true : false;
        $weekdays = isset($_POST['weekdays']) && is_array($_POST['weekdays']) ? array_map('intval', $_POST['weekdays']) : array();
        
        // شناسه batch برای ایمپورت اکسل (اختیاری)
        $incoming_batch_id = isset($_POST['um_batch_id']) ? sanitize_text_field($_POST['um_batch_id']) : '';
        if ($incoming_batch_id === 'new') {
            if (function_exists('wp_generate_uuid4')) {
                $incoming_batch_id = wp_generate_uuid4();
            } else {
                $incoming_batch_id = 'batch_' . date('Ymd_His') . '_' . wp_rand(1000, 9999);
            }
        }

        // تابع کمکی برای ایجاد یک کلاس در تاریخ مشخص
        $create_class = function($date_ymd) use ($class_name, $class_time, $class_description, $class_duration, $class_teacher, $class_status, $incoming_batch_id) {
            $class_datetime = $date_ymd . ' ' . $class_time . ':00';
            $class_timestamp = strtotime($class_datetime);
            if ($class_timestamp === false) {
                return new WP_Error('invalid_date', __('تاریخ یا زمان وارد شده معتبر نیست.', 'university-management'));
            }
            $post_data = array(
                'post_title'    => $class_name,
                'post_content'  => $class_description,
                'post_status'   => 'publish',
                'post_type'     => 'um_classes',
                'post_author'   => get_current_user_id(),
            );
            $post_id = wp_insert_post($post_data);
            if (!is_wp_error($post_id) && $post_id > 0) {
                update_post_meta($post_id, '_class_date', $class_datetime);
                update_post_meta($post_id, '_class_timestamp', $class_timestamp);
                update_post_meta($post_id, '_class_duration', $class_duration ?: 90);
                update_post_meta($post_id, '_class_teacher', $class_teacher);
                update_post_meta($post_id, '_class_status', in_array($class_status, array('scheduled','canceled','postponed','finished'), true) ? $class_status : 'scheduled');
                if (!empty($incoming_batch_id)) {
                    update_post_meta($post_id, '_um_batch_id', $incoming_batch_id);
                    update_post_meta($post_id, '_um_batch_time', current_time('mysql'));
                }
            }
            return $post_id;
        };

        // بررسی داده‌های الزامی
        $base_date = $legacy_class_date ?: $date_from; // در حالت single ممکن است از فیلد قدیمی بیاید
        if (!empty($class_name) && !empty($base_date) && !empty($class_time)) {
            // اگر حالت بازه است، بر اساس روزهای انتخابی تکرار ایجاد کنیم
            if ($date_mode === 'range' && !empty($date_from) && !empty($date_to)) {
                $start_ts = strtotime($date_from . ' 00:00:00');
                $end_ts   = strtotime($date_to . ' 23:59:59');
                if ($start_ts === false || $end_ts === false || $start_ts > $end_ts) {
                    add_settings_error('um_class_timing', 'um_range_error', __('بازه تاریخ معتبر نیست.', 'university-management'), 'error');
                } else {
                    if ($full_week) {
                        $weekdays = array(0,1,2,3,4,5,6);
                    }
                    if (empty($weekdays)) {
                        add_settings_error('um_class_timing', 'um_weekdays_error', __('حداقل یک روز هفته را انتخاب کنید.', 'university-management'), 'error');
                    } else {
                        $created = array();
                        $current = $start_ts;
                        $uploaded_attachment_id = 0;
                        while ($current <= $end_ts) {
                            $w = intval(date('w', $current));
                            if (in_array($w, $weekdays, true)) {
                                $date_ymd = date('Y-m-d', $current);
                                $pid = $create_class($date_ymd);
                                if (!is_wp_error($pid) && $pid > 0) {
                                    // تصویر را فقط یک بار آپلود کن و برای بقیه ست کن
                                    if ($uploaded_attachment_id === 0 && isset($_FILES['class_image']) && !empty($_FILES['class_image']['name'])) {
                                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                                        $uploaded_attachment_id = media_handle_upload('class_image', $pid);
                                        if (is_wp_error($uploaded_attachment_id)) {
                                            $uploaded_attachment_id = 0;
                                        }
                                    }
                                    if ($uploaded_attachment_id) {
                                        set_post_thumbnail($pid, $uploaded_attachment_id);
                                    }
                                    $created[] = $pid;
                                }
                            }
                            $current = strtotime('+1 day', $current);
                        }
                        if (!empty($created)) {
                            add_settings_error('um_class_timing', 'um_classes_added', sprintf(__('تعداد %d کلاس در بازه انتخابی ایجاد شد.', 'university-management'), count($created)), 'success');
                        } else {
                            add_settings_error('um_class_timing', 'um_no_class_created', __('هیچ کلاسی ایجاد نشد.', 'university-management'), 'warning');
                        }
                    }
                }
            } else {
                // حالت تک‌تاریخ
                $post_id = $create_class($base_date);
                if (!is_wp_error($post_id) && $post_id > 0) {
                    if (isset($_FILES['class_image']) && !empty($_FILES['class_image']['name'])) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                        $attachment_id = media_handle_upload('class_image', $post_id);
                        if (!is_wp_error($attachment_id)) {
                            set_post_thumbnail($post_id, $attachment_id);
                        }
                    }
                    add_settings_error('um_class_timing', 'um_class_added', sprintf(__('کلاس "%s" با موفقیت اضافه شد. شناسه پست: %d (وضعیت: %s)', 'university-management'), $class_name, $post_id, esc_html($class_status)), 'success');
                } else {
                    $error_message = is_wp_error($post_id) ? $post_id->get_error_message() : 'خطای نامشخص در ایجاد پست';
                    add_settings_error('um_class_timing', 'um_class_error', sprintf(__('خطا در افزودن کلاس: %s', 'university-management'), $error_message), 'error');
                }
            }
        } else {
            add_settings_error('um_class_timing', 'um_class_required', __('نام کلاس، تاریخ و زمان الزامی هستند.', 'university-management'), 'error');
        }
    }
} elseif (isset($_POST['um_add_class_nonce'])) {
    // اگر nonce معتبر نباشد
    add_settings_error('um_class_timing', 'um_nonce_error', __('خطای امنیتی. لطفاً دوباره تلاش کنید.', 'university-management'), 'error');
}

// پردازش ایمپورت اکسل
if (isset($_POST['um_import_xlsx_nonce']) && wp_verify_nonce($_POST['um_import_xlsx_nonce'], 'um_import_xlsx')) {
    if (!current_user_can('manage_options')) {
        add_settings_error('um_class_timing', 'um_xlsx_cap', __('اجازه انجام این عملیات را ندارید.', 'university-management'), 'error');
    } elseif (!isset($_FILES['um_xlsx_file']) || empty($_FILES['um_xlsx_file']['tmp_name'])) {
        add_settings_error('um_class_timing', 'um_xlsx_file', __('فایل اکسل انتخاب نشده است.', 'university-management'), 'error');
    } else {
        $file_tmp = $_FILES['um_xlsx_file']['tmp_name'];
        $name = $_FILES['um_xlsx_file']['name'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $rows = array();
        if (in_array($ext, array('csv','tsv'))) {
            // CSV/TSV
            $content = file_get_contents($file_tmp);
            if ($ext === 'tsv') {
                // handle UTF-16LE with BOM
                if (substr($content,0,2) === "\xFF\xFE") { $content = mb_convert_encoding(substr($content,2), 'UTF-8', 'UTF-16LE'); }
                $lines = preg_split("/(\r\n|\n|\r)/", $content);
                foreach ($lines as $line) { if ($line==='') continue; $rows[] = preg_split("/\t/", $line); }
            } else {
                // CSV UTF-8
                $handle = fopen($file_tmp, 'r');
                if ($handle) { while (($r = fgetcsv($handle)) !== false) { $rows[] = $r; } fclose($handle); }
            }
        } else {
            // XLSX
            require_once UM_PLUGIN_DIR . 'includes/simplexlsx.php';
            $data = file_get_contents($file_tmp);
            $xlsx = SimpleXLSX::parseData($data);
            if ($xlsx) { $rows = $xlsx->rows(0); }
        }
        if (empty($rows)) {
            add_settings_error('um_class_timing', 'um_xlsx_parse', __('خطا در خواندن فایل یا فایل خالی است.', 'university-management'), 'error');
        } else {
            // انتظار داریم ردیف 0 هدر و ردیف 1 راهنما باشد
            if (count($rows) < 3) {
                add_settings_error('um_class_timing', 'um_xlsx_empty', __('فایل اکسل خالی یا نامعتبر است.', 'university-management'), 'error');
            } else {
                // batch id
                $batch_mode = isset($_POST['um_import_batch']) ? sanitize_text_field($_POST['um_import_batch']) : 'new';
                $batch_id = '';
                if ($batch_mode === 'manual') {
                    $batch_id = sanitize_text_field($_POST['um_import_batch_manual'] ?? '');
                }
                if (empty($batch_id)) {
                    $batch_id = function_exists('wp_generate_uuid4') ? wp_generate_uuid4() : ('batch_' . date('Ymd_His') . '_' . wp_rand(1000,9999));
                }

                $created_total = 0; $errors = array();

                // Map indices by header names (flexible order)
                $headers = array_map('trim', $rows[0]);
                // Map English headers primarily; also accept Persian equivalents
                $idx = array(
                    'name' => um_header_index($headers, array('class_name (required)','نام کلاس (اجباری)')),
                    'mode' => um_header_index($headers, array('date_mode (single|range, required)','حالت تاریخ (single/range) (اجباری)')),
                    'start' => um_header_index($headers, array('date_start (YYYY-MM-DD, required)','تاریخ شروع (YYYY-MM-DD) (اجباری)')),
                    'end' => um_header_index($headers, array('date_end (YYYY-MM-DD, optional for range)','تاریخ پایان (YYYY-MM-DD) (اختیاری برای range)')),
                    'time' => um_header_index($headers, array('class_time (HH:MM, required)','زمان شروع کلاس (HH:MM) (اجباری)')),
                    'duration' => um_header_index($headers, array('duration_minutes (required)','مدت زمان کلاس (دقیقه) (اجباری)')),
                    'teacher' => um_header_index($headers, array('teacher_name (required)','نام استاد (اجباری)')),
                    'status' => um_header_index($headers, array('status (scheduled|canceled|postponed|finished, optional)','وضعیت (scheduled/canceled/postponed/finished) (اختیاری)')),
                    'desc' => um_header_index($headers, array('description (optional)','توضیحات (اختیاری)')),
                    'sat' => um_header_index($headers, array('sat','شنبه')),
                    'sun' => um_header_index($headers, array('sun','یکشنبه')),
                    'mon' => um_header_index($headers, array('mon','دوشنبه')),
                    'tue' => um_header_index($headers, array('tue','سه‌شنبه')),
                    'wed' => um_header_index($headers, array('wed','چهارشنبه')),
                    'thu' => um_header_index($headers, array('thu','پنجشنبه')),
                    'fri' => um_header_index($headers, array('fri','جمعه')),
                );

                // تابع ایجاد کلاس (با استفاده از تابع داخلی موجود)
                $make = function($class_name, $date_mode, $date_from, $date_to, $class_time, $duration, $teacher, $status, $desc, $weekdays) use (&$created_total, $batch_id) {
                    // شبیه‌سازی درخواست فرم برای استفاده از همان منطق ذخیره
                    $_POST['class_name'] = $class_name;
                    $_POST['date_mode'] = $date_mode;
                    $_POST['date_from'] = $date_from;
                    $_POST['date_to'] = $date_to;
                    $_POST['class_time'] = $class_time;
                    $_POST['class_duration'] = $duration;
                    $_POST['class_teacher'] = $teacher;
                    $_POST['class_status'] = $status ?: 'scheduled';
                    $_POST['class_description'] = $desc;
                    $_POST['weekdays'] = $weekdays;
                    $_POST['um_batch_id'] = $batch_id;
                };

                // پردازش سطرها (از ردیف 2 به بعد: 0=هدر،1=راهنما)
                for ($i = 2; $i < count($rows); $i++) {
                    $r = $rows[$i];
                    $name = trim($r[$idx['name']] ?? '');
                    $mode = strtolower(trim($r[$idx['mode']] ?? ''));
                    $start_raw = trim($r[$idx['start']] ?? '');
                    $end_raw = trim($r[$idx['end']] ?? '');
                    $start = um_normalize_import_date($start_raw);
                    $end = um_normalize_import_date($end_raw);
                    $time = trim($r[$idx['time']] ?? '');
                    $duration = absint($r[$idx['duration']] ?? 90);
                    $teacher = trim($r[$idx['teacher']] ?? '');
                    $status = trim($r[$idx['status']] ?? '');
                    $desc = trim($r[$idx['desc']] ?? '');

                    $yes = function($v){ return in_array(strtolower(trim((string)$v)), array('yes','y','1','true','بله')); };
                    $week = array();
                    if ($mode === 'range') {
                        // WordPress date('w'): 0=Sunday...6=Saturday
                        if ($yes($r[$idx['sun']] ?? '')) $week[] = 0;
                        if ($yes($r[$idx['mon']] ?? '')) $week[] = 1;
                        if ($yes($r[$idx['tue']] ?? '')) $week[] = 2;
                        if ($yes($r[$idx['wed']] ?? '')) $week[] = 3;
                        if ($yes($r[$idx['thu']] ?? '')) $week[] = 4;
                        if ($yes($r[$idx['fri']] ?? '')) $week[] = 5;
                        if ($yes($r[$idx['sat']] ?? '')) $week[] = 6;
                    }

                    if ($name === '' || $mode === '' || $start === '' || $time === '' || $duration <= 0 || $teacher === '') {
                        $errors[] = sprintf('سطر %d: فیلدهای اجباری ناقص است.', $i+1);
                        continue;
                    }
                    if (!in_array($mode, array('single','range'), true)) {
                        $errors[] = sprintf('سطر %d: حالت تاریخ فقط single یا range باشد.', $i+1);
                        continue;
                    }

                    // آماده‌سازی داده‌ها برای ایجاد
                    $make($name, $mode, $start, $end, $time, $duration, $teacher, $status, $desc, $week);

                    // اجرای همان منطق ساخت با فراخوانی مستقیم تابع create_class ممکن نیست چون در scope محلی تعریف شده.
                    // بنابراین از پردازش فرم اصلی تقلید نمی‌کنیم؛ در عوض در پایین بعد از این بلاک،
                    // از تابع داخلی دوباره استفاده نشده و خودمان فرآیند ایجاد را تکرار می‌کنیم.
                    // برای سادگی، در اینجا مستقیماً کلاس می‌سازیم:

                    $create_single = function($date_ymd) use ($name, $time, $desc, $duration, $teacher, $status, $batch_id) {
                        $datetime = $date_ymd . ' ' . $time . ':00';
                        $ts = strtotime($datetime);
                        if ($ts === false) { return 0; }
                        $post_id = wp_insert_post(array(
                            'post_title' => $name,
                            'post_content' => $desc,
                            'post_status' => 'publish',
                            'post_type' => 'um_classes',
                            'post_author' => get_current_user_id(),
                        ));
                        if (!is_wp_error($post_id) && $post_id > 0) {
                            update_post_meta($post_id, '_class_date', $datetime);
                            update_post_meta($post_id, '_class_timestamp', $ts);
                            update_post_meta($post_id, '_class_duration', $duration ?: 90);
                            update_post_meta($post_id, '_class_teacher', $teacher);
                            update_post_meta($post_id, '_class_status', in_array($status, array('scheduled','canceled','postponed','finished'), true) ? $status : 'scheduled');
                            update_post_meta($post_id, '_um_batch_id', $batch_id);
                            update_post_meta($post_id, '_um_batch_time', current_time('mysql'));
                            return $post_id;
                        }
                        return 0;
                    };

                    if ($mode === 'single') {
                        $pid = $create_single($start);
                        if ($pid) { $created_total++; } else { $errors[] = sprintf('سطر %d: ایجاد کلاس ناموفق بود.', $i+1); }
                    } else {
                        if ($end === '') { $errors[] = sprintf('سطر %d: تاریخ پایان برای حالت range الزامی است.', $i+1); continue; }
                        $start_ts = strtotime($start . ' 00:00:00');
                        $end_ts = strtotime($end . ' 23:59:59');
                        if ($start_ts === false || $end_ts === false || $start_ts > $end_ts) { $errors[] = sprintf('سطر %d: بازه تاریخ نامعتبر است.', $i+1); continue; }
                        if (empty($week)) { $errors[] = sprintf('سطر %d: حداقل یک روز هفته را انتخاب کنید.', $i+1); continue; }
                        $current = $start_ts;
                        while ($current <= $end_ts) {
                            $w = intval(date('w', $current));
                            if (in_array($w, $week, true)) {
                                $date_ymd = date('Y-m-d', $current);
                                $pid = $create_single($date_ymd);
                                if ($pid) { $created_total++; }
                            }
                            $current = strtotime('+1 day', $current);
                        }
                    }
                }

                if ($created_total > 0) {
                    add_settings_error('um_class_timing', 'um_xlsx_created', sprintf(__('ایمپورت اکسل با موفقیت انجام شد. تعداد %d کلاس ایجاد شد. شناسه دسته: %s', 'university-management'), $created_total, esc_html($batch_id)), 'success');
                } else {
                    add_settings_error('um_class_timing', 'um_xlsx_none', __('هیچ کلاسی ایجاد نشد.', 'university-management'), 'warning');
                }
                if (!empty($errors)) {
                    add_settings_error('um_class_timing', 'um_xlsx_errors', implode('<br>', array_map('esc_html', $errors)), 'error');
                }
            }
        }
    }
}

// پردازش به‌روزرسانی کلاس
if (isset($_POST['um_update_class_nonce']) && wp_verify_nonce($_POST['um_update_class_nonce'], 'um_update_class')) {
    $class_id = isset($_POST['class_id']) ? absint($_POST['class_id']) : 0;
    if ($class_id && current_user_can('edit_post', $class_id)) {
        $class_name = sanitize_text_field($_POST['class_name']);
        $class_date = sanitize_text_field($_POST['class_date']); // YYYY-MM-DD (از فیلد مخفی)
        $class_time = sanitize_text_field($_POST['class_time']); // HH:MM
        $class_duration = absint($_POST['class_duration']);
        $class_teacher = sanitize_text_field($_POST['class_teacher']);
        $class_description = wp_kses_post($_POST['class_description']);
        $class_status = isset($_POST['class_status']) ? sanitize_text_field($_POST['class_status']) : 'scheduled';

        if (!empty($class_name) && !empty($class_date) && !empty($class_time)) {
            $class_datetime = $class_date . ' ' . $class_time . ':00';
            $class_timestamp = strtotime($class_datetime);
            if ($class_timestamp === false) {
                add_settings_error('um_class_timing', 'um_date_error', __('تاریخ یا زمان وارد شده معتبر نیست.', 'university-management'), 'error');
            } else {
                // به‌روزرسانی پست
                wp_update_post(array(
                    'ID' => $class_id,
                    'post_title' => $class_name,
                    'post_content' => $class_description,
                ));

                update_post_meta($class_id, '_class_date', $class_datetime);
                update_post_meta($class_id, '_class_timestamp', $class_timestamp);
                update_post_meta($class_id, '_class_duration', $class_duration ?: 90);
                update_post_meta($class_id, '_class_teacher', $class_teacher);
                update_post_meta($class_id, '_class_status', in_array($class_status, array('scheduled','canceled','postponed','finished'), true) ? $class_status : 'scheduled');

                // تصویر (اختیاری)
                if (isset($_FILES['class_image']) && !empty($_FILES['class_image']['name'])) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/media.php');
                    $attachment_id = media_handle_upload('class_image', $class_id);
                    if (!is_wp_error($attachment_id)) {
                        set_post_thumbnail($class_id, $attachment_id);
                    }
                }

                add_settings_error('um_class_timing', 'um_class_updated', sprintf(__('کلاس با موفقیت به‌روزرسانی شد. (وضعیت: %s)', 'university-management'), esc_html($class_status)), 'success');

                // خروج از حالت ویرایش پس از موفقیت
                $editing_class = null;
                $editing_id = 0;
                $editing_name = $editing_description = $editing_date_greg = $editing_time = '';
                $editing_duration = 90;
                $editing_teacher = '';
                $editing_status = 'scheduled';
            }
        } else {
            add_settings_error('um_class_timing', 'um_class_update_required', __('نام کلاس، تاریخ و زمان الزامی هستند.', 'university-management'), 'error');
        }
    } else {
        add_settings_error('um_class_timing', 'um_class_update_cap', __('اجازه ویرایش این کلاس را ندارید.', 'university-management'), 'error');
    }
}

// نمایش پیام‌های خطا/موفقیت
settings_errors('um_class_timing');

// بررسی پیام موفقیت از redirect
if (isset($_GET['added']) && $_GET['added'] == '1') {
    echo '<div class="notice notice-success is-dismissible"><p>' . __('کلاس با موفقیت اضافه شد!', 'university-management') . '</p></div>';
}

// دریافت کلاس‌های موجود
$args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'meta_value',
    'meta_key'       => '_class_date',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => '_class_date',
            'value'   => date('Y-m-d 00:00:00'), // شروع روز جاری
            'compare' => '>=',
            'type'    => 'DATETIME'
        )
    )
);

$classes = new WP_Query($args);

// برای debugging - بیایید تمام کلاس‌ها را هم چک کنیم
$all_classes_args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);
$all_classes = new WP_Query($all_classes_args);

// Query ساده برای تست
$simple_classes_args = array(
    'post_type'      => 'um_classes',
    'posts_per_page' => -1,
    'post_status'    => array('publish', 'draft', 'private'),
);
$simple_classes = new WP_Query($simple_classes_args);

function um_header_index(array $headers, array $candidates) {
    // Normalize headers: trim, lowercase, strip UTF-8 BOM if present
    $norm_headers = array();
    foreach ($headers as $i => $h) {
        $h = (string)$h;
        if (substr($h, 0, 3) === "\xEF\xBB\xBF") { $h = substr($h, 3); }
        $norm_headers[$i] = strtolower(trim($h));
    }
    $norm_candidates = array();
    foreach ($candidates as $c) { $norm_candidates[] = strtolower(trim((string)$c)); }
    foreach ($norm_headers as $i => $h) {
        if (in_array($h, $norm_candidates, true)) { return $i; }
    }
    return -1;
}

// تبدیل تاریخ ورودی ایمپورت به میلادی (YYYY-MM-DD). اگر شمسی باشد (مثل 1404/05/21) تبدیل می‌کنیم
function um_normalize_import_date($date_str) {
    $date_str = trim((string)$date_str);
    if ($date_str === '') return '';
    // اگر شبیه 1404/05/21 یا 1404-05-21 باشد و سال بزرگتر از 1300 باشد، شمسی در نظر بگیریم
    $ds = str_replace('-', '/', $date_str);
    if (preg_match('/^(\d{4})\/(\d{1,2})\/(\d{1,2})$/', $ds, $m)) {
        $y = intval($m[1]); $mo = intval($m[2]); $d = intval($m[3]);
        if ($y >= 1300) {
            list($gy, $gm, $gd) = um_jalali_to_gregorian($y, $mo, $d);
            return sprintf('%04d-%02d-%02d', $gy, $gm, $gd);
        }
    }
    // در غیر اینصورت همان مقدار (ممکن است از قبل میلادی باشد)
    return str_replace('/', '-', $date_str);
}

// الگوریتم تبدیل جلالی به میلادی (منبع عمومی)
function um_jalali_to_gregorian($jy, $jm, $jd) {
    $jy = intval($jy); $jm = intval($jm); $jd = intval($jd);
    $jy += 1595;
    $days = -355668 + (365 * $jy) + (int)floor($jy / 33) * 8 + (int)floor(((($jy % 33) + 3) / 4)) + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
    $gy = 400 * (int)floor($days / 146097);
    $days %= 146097;
    if ($days > 36524) {
        $gy += 100 * (int)floor(--$days / 36524);
        $days %= 36524;
        if ($days >= 365) $days++;
    }
    $gy += 4 * (int)floor($days / 1461);
    $days %= 1461;
    if ($days > 365) {
        $gy += (int)floor(($days - 1) / 365);
        $days = ($days - 1) % 365;
    }
    $gd = $days + 1;
    $sal_a = array(0,31,($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0) ? 29 : 28,31,30,31,30,31,31,30,31,30,31);
    for ($gm = 1; $gm <= 12 && $gd > $sal_a[$gm]; $gm++) { $gd -= $sal_a[$gm]; }
    return array($gy, $gm, $gd);
}

// تبدیل میلادی به جلالی برای تولید نمونه
function um_gregorian_to_jalali($gy, $gm, $gd) {
    $g_d_m = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
    $gy2 = $gy-1600; $gm2 = $gm-1; $gd2 = $gd-1;
    $g_day_no = 365*$gy2 + (int)(($gy2+3)/4) - (int)(($gy2+99)/100) + (int)(($gy2+399)/400);
    for ($i=0;$i<$gm2;$i++) $g_day_no += $g_d_m[$i+1];
    if ($gm>2 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0))) $g_day_no++;
    $g_day_no += $gd2;
    $j_day_no = $g_day_no - 79;
    $j_np = (int)($j_day_no / 12053); $j_day_no %= 12053;
    $jy = 979 + 33*$j_np + 4*(int)($j_day_no/1461); $j_day_no %= 1461;
    if ($j_day_no >= 366) { $jy += (int)(($j_day_no-366)/365); $j_day_no = ($j_day_no-366)%365; }
    $jm_list = array(31,31,31,31,31,31,30,30,30,30,30,29);
    for ($jm=0;$jm<12 && $j_day_no >= $jm_list[$jm]; $jm++) $j_day_no -= $jm_list[$jm];
    $jm += 1; $jd = $j_day_no + 1;
    return array($jy,$jm,$jd);
}
?>

<div class="wrap">
    <h1><?php _e('مدیریت زمان‌بندی کلاس‌ها', 'university-management'); ?></h1>
    
    <div class="um-admin-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <!-- فرم افزودن/ویرایش کلاس -->
        <div class="um-admin-form" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 40%; min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php echo $editing_class ? __('ویرایش کلاس', 'university-management') : __('افزودن کلاس جدید', 'university-management'); ?></h2>
            
            <form method="post" action="" enctype="multipart/form-data">
                <?php if ($editing_class): ?>
                    <input type="hidden" name="class_id" value="<?php echo esc_attr($editing_id); ?>">
                    <?php wp_nonce_field('um_update_class', 'um_update_class_nonce'); ?>
                <?php else: ?>
                    <?php wp_nonce_field('um_add_class', 'um_add_class_nonce'); ?>
                <?php endif; ?>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="um_batch_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Batch ID (اختیاری – برای ایمپورت اکسل)</label>
                    <input type="text" id="um_batch_id" name="um_batch_id" class="regular-text" style="width: 100%;" placeholder="مثال: 2025-09-23_141200 یا UUID؛ مقدار new = ساخت خودکار">
                    <p class="description">در زمان ایمپورت اکسل، یک شناسه یکتا به همه رکوردهای این فایل نسبت دهید تا مدیریت و حذف گروهی ممکن شود.</p>
                </div>

                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_name" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام کلاس', 'university-management'); ?> *</label>
                    <input type="text" id="class_name" name="class_name" class="regular-text" required style="width: 100%;" value="<?php echo esc_attr($editing_class ? $editing_name : ''); ?>">
                </div>

<script>
(function(){
  // جلوگیری از رفتن به ویرایشگر پست‌تایپ؛ ویرایش باید در همین صفحه انجام شود
  document.addEventListener('click', function(e){
    var a = e.target.closest('a.um-edit-class');
    if (a){
      try {
        var href = a.getAttribute('href') || '';
        if (href.indexOf('post.php') !== -1){
          e.preventDefault();
          var id = a.getAttribute('data-class-id');
          var url = new URL(window.location.href);
          url.searchParams.set('page','university-class-timing');
          url.searchParams.set('action','um_edit_class');
          url.searchParams.set('class_id', id);
          window.location.assign(url.toString());
          return false;
        }
      } catch(err) {}
    }
  }, true);

  function ensureMoment(cb){
    function loadScript(src, onload){ var s=document.createElement('script'); s.src=src; s.async=true; s.onload=onload; document.head.appendChild(s); }
    if (typeof moment === 'undefined'){
      loadScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', function(){
        loadScript('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', cb);
      });
    } else if (typeof moment.loadPersian === 'undefined'){
      loadScript('https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js', cb);
    } else { cb(); }
  }

  function bindJalaliPair(displayId, hiddenId, initial){
    var display = document.getElementById(displayId);
    var hidden = document.getElementById(hiddenId);
    if (!display || !hidden) return;
    if (initial){
      var m0 = moment(initial, 'YYYY-MM-DD');
      if (m0.isValid()) display.value = m0.format('jYYYY/jMM/jDD');
    }
    if (hidden.value && !display.value){
      var m1 = moment(hidden.value, 'YYYY-MM-DD');
      if (m1.isValid()) display.value = m1.format('jYYYY/jMM/jDD');
    }
    display.addEventListener('input', function(){
      var v = (display.value || '').replace(/[-.]/g,'/');
      var m = moment(v, 'jYYYY/jMM/jDD', true);
      if (m.isValid()){
        hidden.value = m.format('YYYY-MM-DD');
        display.setCustomValidity('');
      } else {
        hidden.value = '';
        display.setCustomValidity('تاریخ نامعتبر است. مثال: 1404/05/20');
      }
    });
  }

  function initUI(){
    if (typeof moment.loadPersian === 'function') moment.loadPersian({usePersianDigits:false});
    bindJalaliPair('date_from_display', 'date_from', '<?php echo esc_js($editing_class ? $editing_date_greg : ''); ?>');
    bindJalaliPair('date_to_display', 'date_to', '');

    // برای سازگاری فیلد قدیمی: فقط زمانی ساخته می‌شود که حالت single باشد
    bindJalaliPair('class_date_display', 'class_date', '<?php echo esc_js($editing_class ? $editing_date_greg : ''); ?>');

    var mode = document.getElementById('date_mode');
    var rangeWrap = document.getElementById('range_fields');
    var singleWrap = document.getElementById('single_field');
    var fullWeek = document.getElementById('full_week');
    var weekdays = document.getElementById('weekdays');

    function renderVisibility(){
      var isRange = mode.value === 'range';
      rangeWrap.style.display = isRange ? '' : 'none';
      singleWrap.style.display = isRange ? 'none' : '';
      weekdays.parentElement.style.display = (isRange && !fullWeek.checked) ? '' : 'none';
    }
    mode.addEventListener('change', renderVisibility);
    fullWeek.addEventListener('change', renderVisibility);
    renderVisibility();
  }

  if (document.readyState === 'loading'){
    document.addEventListener('DOMContentLoaded', function(){ ensureMoment(initUI); });
  } else { ensureMoment(initUI); }
})();
</script>

                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="date_mode" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('حالت تاریخ', 'university-management'); ?></label>
                    <select id="date_mode" name="date_mode" style="width: 100%;">
                        <option value="single">single</option>
                        <option value="range">range</option>
                    </select>
                </div>

                <div id="single_field" class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_date_display" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ شروع (شمسی)', 'university-management'); ?> *</label>
                    <input type="text" id="class_date_display" class="regular-text" style="width: 100%;" placeholder="مثال: ۱۴۰۴/۰۵/۲۰">
                    <input type="hidden" id="class_date" name="class_date" value="<?php echo esc_attr($editing_class ? $editing_date_greg : ''); ?>">
                </div>

                <div id="range_fields">
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="date_from_display" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ شروع (از تاریخ)', 'university-management'); ?></label>
                        <input type="text" id="date_from_display" class="regular-text" style="width: 100%;" placeholder="مثال: ۱۴۰۴/۰۵/۲۰">
                        <input type="hidden" id="date_from" name="date_from" value="">
                    </div>
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label for="date_to_display" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تاریخ پایان (تا تاریخ)', 'university-management'); ?></label>
                        <input type="text" id="date_to_display" class="regular-text" style="width: 100%;" placeholder="مثال: ۱۴۰۴/۰۵/۲۵">
                        <input type="hidden" id="date_to" name="date_to" value="">
                    </div>
                    <div class="um-form-row" style="margin-bottom: 15px;">
                        <label style="display:block; margin-bottom:5px; font-weight:bold;"><?php _e('روزهای هفته', 'university-management'); ?></label>
                        <label style="display:inline-flex; align-items:center; gap:6px; margin-bottom:8px;">
                            <input type="checkbox" id="full_week" name="full_week" value="1"> <?php _e('نمایش کل هفته', 'university-management'); ?>
                        </label>
                        <select id="weekdays" name="weekdays[]" multiple size="7" style="width:100%;">
                            <option value="6">شنبه</option>
                            <option value="0">یکشنبه</option>
                            <option value="1">دوشنبه</option>
                            <option value="2">سه‌شنبه</option>
                            <option value="3">چهارشنبه</option>
                            <option value="4">پنجشنبه</option>
                            <option value="5">جمعه</option>
                        </select>
                    </div>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_time" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('زمان شروع کلاس', 'university-management'); ?> *</label>
                    <input type="time" id="class_time" name="class_time" class="regular-text" required style="width: 100%;" value="<?php echo esc_attr($editing_class ? $editing_time : ''); ?>">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_duration" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('مدت زمان کلاس (دقیقه)', 'university-management'); ?></label>
                    <input type="number" id="class_duration" name="class_duration" class="regular-text" min="30" step="5" value="<?php echo esc_attr($editing_class ? ($editing_duration ?: 90) : 90); ?>" style="width: 100%;">
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_teacher" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('نام استاد', 'university-management'); ?></label>
                    <input type="text" id="class_teacher" name="class_teacher" class="regular-text" style="width: 100%;" value="<?php echo esc_attr($editing_class ? $editing_teacher : ''); ?>">
                </div>

                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_status" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('وضعیت کلاس', 'university-management'); ?></label>
                    <select id="class_status" name="class_status" style="width: 100%;">
                        <?php $status_current = $editing_class ? $editing_status : 'scheduled'; ?>
                        <option value="scheduled" <?php selected($status_current, 'scheduled'); ?>><?php _e('زمان‌بندی‌شده', 'university-management'); ?></option>
                        <option value="canceled" <?php selected($status_current, 'canceled'); ?>><?php _e('لغو شد', 'university-management'); ?></option>
                        <option value="postponed" <?php selected($status_current, 'postponed'); ?>><?php _e('به زمان دیگری موکول شد', 'university-management'); ?></option>
                        <option value="finished" <?php selected($status_current, 'finished'); ?>><?php _e('برگزار شد', 'university-management'); ?></option>
                    </select>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_description" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('توضیحات کلاس', 'university-management'); ?></label>
                    <textarea id="class_description" name="class_description" rows="5" class="regular-text" style="width: 100%;"><?php echo esc_textarea($editing_class ? $editing_description : ''); ?></textarea>
                </div>
                
                <div class="um-form-row" style="margin-bottom: 15px;">
                    <label for="class_image" style="display: block; margin-bottom: 5px; font-weight: bold;"><?php _e('تصویر کلاس', 'university-management'); ?></label>
                    <input type="file" id="class_image" name="class_image" accept="image/*">
                </div>
                
                <div class="um-form-row">
                    <input type="submit" class="button button-primary" value="<?php echo $editing_class ? esc_attr__('به‌روزرسانی کلاس', 'university-management') : esc_attr__('افزودن کلاس', 'university-management'); ?>">
                    <?php if ($editing_class): ?>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=university-class-timing')); ?>" class="button" style="margin-right:10px;"><?php _e('لغو ویرایش', 'university-management'); ?></a>
                    <?php endif; ?>
                </div>
            </form>

            <hr style="margin:20px 0;">
            <h2><?php _e('ایمپورت از اکسل', 'university-management'); ?></h2>
            <p class="description">برای ورود گروهی کلاس‌ها از فایل اکسل استفاده کنید. می‌توانید فایل نمونه را دانلود کنید.</p>
            <p>
                <a href="<?php echo esc_url( admin_url('admin-ajax.php?action=um_download_sample_xlsx&_ajax_nonce=' . wp_create_nonce('um_download_sample_xlsx')) ); ?>" class="button">
                    <?php _e('دانلود فایل نمونه CSV (English headers)', 'university-management'); ?>
                </a>
            </p>
            <form method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('um_import_xlsx', 'um_import_xlsx_nonce'); ?>
                <div class="um-form-row" style="margin-bottom: 10px;">
                    <input type="file" name="um_xlsx_file" accept=".xlsx,.xls,.csv,.tsv" required>
                </div>
                <div class="um-form-row" style="margin-bottom: 10px;">
                    <label for="import_batch_mode" style="display:block;margin-bottom:5px;font-weight:bold;">Batch ID</label>
                    <select id="import_batch_mode" name="um_import_batch" style="width:100%;max-width:200px;">
                        <option value="new">ساخت خودکار شناسه جدید</option>
                        <option value="manual">ثبت شناسه دلخواه</option>
                    </select>
                    <input type="text" name="um_import_batch_manual" placeholder="در حالت Manual اینجا بنویسید" style="margin-top:8px;width:100%;max-width:300px;">
                </div>
                <button type="submit" class="button button-primary"><?php _e('آپلود و ایمپورت اکسل', 'university-management'); ?></button>
            </form>
        </div>
        
        <!-- مدیریت ایمپورت‌های اکسل (Batch) + لیست کلاس‌ها -->
        <div class="um-admin-list" style="background: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: calc(60% - 20px); min-width: 300px; padding: 20px; box-sizing: border-box;">
            <h2><?php _e('مدیریت ایمپورت‌های اکسل', 'university-management'); ?></h2>
            <table class="wp-list-table widefat fixed striped" style="width: 100%; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th><?php _e('شناسه Batch', 'university-management'); ?></th>
                        <th><?php _e('تاریخ/ساعت ایمپورت', 'university-management'); ?></th>
                        <th><?php _e('تعداد کلاس‌ها', 'university-management'); ?></th>
                        <th><?php _e('عملیات', 'university-management'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                global $wpdb;
                $batch_rows = $wpdb->get_results($wpdb->prepare(
                    "SELECT meta_value AS batch_id, MAX(meta_id) AS mid FROM {$wpdb->postmeta} WHERE meta_key=%s GROUP BY meta_value ORDER BY mid DESC",
                    '_um_batch_id'
                ));
                if (empty($batch_rows)) {
                    echo '<tr><td colspan="4">' . esc_html__('هیچ ایمپورتی یافت نشد.', 'university-management') . '</td></tr>';
                } else {
                    foreach ($batch_rows as $row) {
                        $bid = $row->batch_id;
                        if ($bid === '' || $bid === null) { continue; }
                        $count = (int)$wpdb->get_var($wpdb->prepare(
                            "SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_key=%s AND meta_value=%s",
                            '_um_batch_id', $bid
                        ));
                        $import_time = $wpdb->get_var($wpdb->prepare(
                            "SELECT pm.meta_value FROM {$wpdb->postmeta} pm INNER JOIN {$wpdb->postmeta} pm2 ON pm.post_id=pm2.post_id WHERE pm.meta_key=%s AND pm2.meta_key=%s AND pm2.meta_value=%s LIMIT 1",
                            '_um_batch_time', '_um_batch_id', $bid
                        ));
                        $import_time_disp = $import_time ? date_i18n('Y/m/d H:i', strtotime($import_time)) : '—';
                        $del_url = wp_nonce_url(
                            add_query_arg(array('page'=>'university-class-timing','action'=>'um_delete_import_batch','batch_id'=>$bid), admin_url('admin.php')),
                            'um_delete_import_batch_' . $bid
                        );
                        $confirm_msg = esc_js(__('آیا از حذف همه کلاس‌های این ایمپورت اطمینان دارید؟ این عملیات قابل بازگشت نیست.', 'university-management'));
                        $btn_label = esc_html__('حذف همه کلاس‌های این ایمپورت', 'university-management');
                        echo '<tr>';
                        echo '<td><code>' . esc_html($bid) . '</code></td>';
                        echo '<td>' . esc_html($import_time_disp) . '</td>';
                        echo '<td>' . esc_html($count) . '</td>';
                        echo '<td><a class="button" href="' . esc_url($del_url) . '" onclick="return confirm(\'' . $confirm_msg . '\');">' . $btn_label . '</a></td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>

            <h2><?php _e('کلاس‌های آینده', 'university-management'); ?></h2>
            
            <!-- اطلاعات debugging -->
            <div style="background: #f0f8ff; padding: 10px; margin-bottom: 15px; border-left: 3px solid #0073aa;">
                <strong>اطلاعات سیستم:</strong><br>
                - تعداد کل کلاس‌ها (Query ساده): <?php echo $simple_classes->found_posts; ?><br>
                - تعداد کل کلاس‌ها (Query عادی): <?php echo $all_classes->found_posts; ?><br>
                - تعداد کلاس‌های آینده: <?php echo $classes->found_posts; ?><br>
                - زمان فعلی سرور: <?php echo current_time('Y-m-d H:i:s'); ?><br>
                - تاریخ شروع روز: <?php echo date('Y-m-d 00:00:00'); ?><br>
                - پست تایپ موجود: <?php echo post_type_exists('um_classes') ? 'بله' : 'خیر'; ?>
            </div>
            
            <?php if ($simple_classes->have_posts()) : ?>
                <h3>تمام کلاس‌ها (Query ساده):</h3>
                <table class="wp-list-table widefat fixed striped" style="width: 100%; margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th><?php _e('نام کلاس', 'university-management'); ?></th>
                            <th><?php _e('استاد', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
                            <th><?php _e('مدت (دقیقه)', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($simple_classes->have_posts()) : $simple_classes->the_post(); 
                            $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                            $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                            $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = $class_date ? date_i18n('Y/m/d H:i', strtotime($class_date)) : 'تاریخ نامعلوم';
                        ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($class_teacher); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php 
                                    $status = get_post_meta(get_the_ID(), '_class_status', true);
                                    $status_text = '';
                                    switch($status) {
                                        case 'canceled': $status_text = 'لغو شد'; break;
                                        case 'postponed': $status_text = 'موکول شد'; break;
                                        case 'finished': $status_text = 'برگزار شد'; break;
                                        default: $status_text = 'زمان‌بندی‌شده'; break;
                                    }
                                    echo esc_html($status_text) . ' (' . esc_html($status ?: 'scheduled') . ')';
                                ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-class-timing',
                                                'action' => 'um_edit_class',
                                                'class_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-class-timing',
                                                    'action' => 'um_delete_class',
                                                    'class_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_class_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small um-edit-class" data-class-id="<?php echo get_the_ID(); ?>"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            
            <?php if ($all_classes->have_posts()) : ?>
                <h3>تمام کلاس‌ها (Query عادی):</h3>
                <table class="wp-list-table widefat fixed striped" style="width: 100%; margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th><?php _e('نام کلاس', 'university-management'); ?></th>
                            <th><?php _e('استاد', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
                            <th><?php _e('مدت (دقیقه)', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($all_classes->have_posts()) : $all_classes->the_post(); 
                            $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                            $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                            $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = $class_date ? date_i18n('Y/m/d H:i', strtotime($class_date)) : 'تاریخ نامعلوم';
                        ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($class_teacher); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php 
                                    $status = get_post_meta(get_the_ID(), '_class_status', true);
                                    $status_text = '';
                                    switch($status) {
                                        case 'canceled': $status_text = 'لغو شد'; break;
                                        case 'postponed': $status_text = 'موکول شد'; break;
                                        case 'finished': $status_text = 'برگزار شد'; break;
                                        default: $status_text = 'زمان‌بندی‌شده'; break;
                                    }
                                    echo esc_html($status_text) . ' (' . esc_html($status ?: 'scheduled') . ')';
                                ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-class-timing',
                                                'action' => 'um_edit_class',
                                                'class_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-class-timing',
                                                    'action' => 'um_delete_class',
                                                    'class_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_class_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small um-edit-class" data-class-id="<?php echo get_the_ID(); ?>"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            
            <?php if ($classes->have_posts()) : ?>
                <h3>کلاس‌های آینده:</h3>
                <table class="wp-list-table widefat fixed striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php _e('نام کلاس', 'university-management'); ?></th>
                            <th><?php _e('استاد', 'university-management'); ?></th>
                            <th><?php _e('تاریخ و زمان', 'university-management'); ?></th>
                            <th><?php _e('وضعیت', 'university-management'); ?></th>
                            <th><?php _e('مدت (دقیقه)', 'university-management'); ?></th>
                            <th><?php _e('عملیات', 'university-management'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($classes->have_posts()) : $classes->the_post(); 
                            $class_date = get_post_meta(get_the_ID(), '_class_date', true);
                            $class_duration = get_post_meta(get_the_ID(), '_class_duration', true);
                            $class_teacher = get_post_meta(get_the_ID(), '_class_teacher', true);
                            
                            // تبدیل تاریخ به فرمت مناسب نمایش
                            $date_display = $class_date ? date_i18n('Y/m/d H:i', strtotime($class_date)) : 'تاریخ نامعلوم';
                        ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($class_teacher); ?></td>
                                <td><?php echo esc_html($date_display); ?></td>
                                <td><?php 
                                    $status = get_post_meta(get_the_ID(), '_class_status', true);
                                    $status_text = '';
                                    switch($status) {
                                        case 'canceled': $status_text = 'لغو شد'; break;
                                        case 'postponed': $status_text = 'موکول شد'; break;
                                        case 'finished': $status_text = 'برگزار شد'; break;
                                        default: $status_text = 'زمان‌بندی‌شده'; break;
                                    }
                                    echo esc_html($status_text) . ' (' . esc_html($status ?: 'scheduled') . ')';
                                ?></td>
                                <td><?php echo esc_html($class_duration ?: '90'); ?></td>
                                <td>
                                    <?php
                                        $edit_url = add_query_arg(
                                            array(
                                                'page' => 'university-class-timing',
                                                'action' => 'um_edit_class',
                                                'class_id' => get_the_ID(),
                                            ),
                                            admin_url('admin.php')
                                        );
                                        $delete_url = wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                    'page' => 'university-class-timing',
                                                    'action' => 'um_delete_class',
                                                    'class_id' => get_the_ID(),
                                                ),
                                                admin_url('admin.php')
                                            ),
                                            'um_delete_class_' . get_the_ID()
                                        );
                                    ?>
                                    <a href="<?php echo esc_url($edit_url); ?>" class="button button-small um-edit-class" data-class-id="<?php echo get_the_ID(); ?>"><?php _e('ویرایش', 'university-management'); ?></a>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" style="color: #a00;" onclick="return confirm('<?php _e('آیا از حذف این کلاس اطمینان دارید؟', 'university-management'); ?>')"><?php _e('حذف', 'university-management'); ?></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php _e('هیچ کلاس آینده‌ای ثبت نشده است.', 'university-management'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="um-admin-help" style="margin-top: 30px;">
        <h2><?php _e('راهنما', 'university-management'); ?></h2>
        <p><?php _e('برای استفاده از ویجت زمان‌بندی کلاس‌ها، پس از افزودن کلاس‌ها در این قسمت، کافیست ویجت "زمان‌بندی کلاس‌ها" را در صفحه‌ساز المنتور به صفحه مورد نظر خود اضافه کنید.', 'university-management'); ?></p>
        <p><?php _e('نکات مهم:', 'university-management'); ?></p>
        <ul style="list-style-type: disc; padding-right: 20px;">
            <li><?php _e('در این صفحه فقط کلاس‌های آینده نمایش داده می‌شوند.', 'university-management'); ?></li>
            <li><?php _e('در صورت نیاز به تغییر زمان یا مشخصات یک کلاس، روی دکمه ویرایش کلیک کنید.', 'university-management'); ?></li>
            <li><?php _e('اضافه کردن تصویر برای کلاس اختیاری است اما برای بهبود ظاهر ویجت توصیه می‌شود.', 'university-management'); ?></li>
        </ul>
    </div>
</div> 