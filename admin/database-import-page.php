<?php
/**
 * صفحه مدیریت ورود اطلاعات پایگاه داده
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// بررسی دسترسی
if (!current_user_can('manage_options')) {
    wp_die(__('شما دسترسی لازم برای مشاهده این صفحه را ندارید.'));
}

// دریافت وضعیت فعلی
$import_status = get_option('_um_import_stats', array());
$has_imported_data = !empty($import_status);
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <!-- نمایش وضعیت فعلی -->
    <div class="um-status-section">
        <div class="card">
            <h2>وضعیت فعلی</h2>
            <div id="um-current-status">
                <?php if ($has_imported_data): ?>
                    <div class="notice notice-success">
                        <p>
                            <strong>اطلاعات وارد شده:</strong><br>
                            <?php printf(
                                '%d خبر، %d کامنت و %d تصویر در تاریخ %s',
                                $import_status['news_count'],
                                $import_status['comments_count'],
                                $import_status['images_count'],
                                date_i18n('Y/m/d H:i', strtotime($import_status['import_date']))
                            ); ?>
                        </p>
                    </div>
                <?php else: ?>
                    <div class="notice notice-info">
                        <p>هیچ اطلاعاتی از قبل وارد نشده است.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- فرم آپلود -->
    <div class="um-upload-section">
        <div class="card">
            <h2>آپلود فایل SQL</h2>
            <form id="um-import-form" method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('um_import_nonce', 'um_import_nonce'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="sql_file">فایل SQL</label>
                        </th>
                        <td>
                            <input type="file" name="sql_file" id="sql_file" accept=".sql" required>
                            <p class="description">
                                فایل news.sql خود را انتخاب کنید. حداکثر سایز مجاز: 50 مگابایت
                            </p>
                        </td>
                    </tr>
                </table>
                
                <div class="um-upload-instructions">
                    <h3>راهنمای آپلود:</h3>
                    <ul>
                        <li>فایل باید از نوع SQL باشد</li>
                        <li>فایل باید شامل جدول‌های kw_news و kw_news_comments باشد</li>
                        <li>تصاویر باید در پوشه extracted_images قرار داشته باشند</li>
                        <li>عملیات آپلود ممکن است چند دقیقه طول بکشد</li>
                        <li>در صورت وجود اطلاعات قبلی، ابتدا آن‌ها را حذف کنید</li>
                    </ul>
                </div>
                
                <p class="submit">
                    <input type="submit" name="submit" id="um-import-submit" class="button button-primary" value="شروع عملیات ورود اطلاعات">
                    <span id="um-import-loading" class="spinner" style="display: none;"></span>
                </p>
            </form>
        </div>
    </div>

    <!-- نتیجه آپلود -->
    <div id="um-import-result" style="display: none;"></div>

    <!-- بخش حذف اطلاعات -->
    <?php if ($has_imported_data): ?>
    <div class="um-delete-section">
        <div class="card">
            <h2>حذف اطلاعات وارد شده</h2>
            <p>با استفاده از این بخش می‌توانید همه اطلاعات وارد شده (اخبار، کامنت‌ها و تصاویر) را به صورت کامل حذف کنید.</p>
            
            <div class="um-delete-warning">
                <div class="notice notice-warning">
                    <p><strong>هشدار:</strong> این عملیات قابل برگشت نیست!</p>
                </div>
            </div>
            
            <p class="submit">
                <button id="um-delete-all" class="button button-secondary">حذف همه اطلاعات وارد شده</button>
                <span id="um-delete-loading" class="spinner" style="display: none;"></span>
            </p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- بخش لاگ‌ها -->
    <div class="um-logs-section">
        <div class="card">
            <h2>لاگ‌های عملیات</h2>
            <p>جزئیات عملیات آپلود و پردازش فایل‌ها در اینجا نمایش داده می‌شود.</p>
            
            <div class="um-logs-controls">
                <button id="um-load-logs" class="button">بارگذاری لاگ‌ها</button>
                <button id="um-clear-logs" class="button button-secondary">پاک کردن لاگ‌ها</button>
                <span id="um-logs-loading" class="spinner" style="display: none;"></span>
            </div>
            
            <div id="um-logs-container" style="display: none;">
                <div class="um-logs-wrapper">
                    <div id="um-logs-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // آپلود فایل
    $('#um-import-form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        formData.append('action', 'um_import_database');
        
        // نمایش loading
        $('#um-import-submit').prop('disabled', true);
        $('#um-import-loading').show();
        $('#um-import-result').hide();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#um-import-result').html(
                        '<div class="notice notice-success"><p><strong>موفقیت:</strong> ' + response.data.message + '</p></div>'
                    ).show();
                    
                    // بروزرسانی وضعیت
                    location.reload();
                } else {
                    $('#um-import-result').html(
                        '<div class="notice notice-error"><p><strong>خطا:</strong> ' + response.data + '</p></div>'
                    ).show();
                }
            },
            error: function(xhr, status, error) {
                $('#um-import-result').html(
                    '<div class="notice notice-error"><p><strong>خطا:</strong> خطا در اتصال به سرور</p></div>'
                ).show();
            },
            complete: function() {
                $('#um-import-submit').prop('disabled', false);
                $('#um-import-loading').hide();
            }
        });
    });
    
    // حذف اطلاعات
    $('#um-delete-all').on('click', function(e) {
        e.preventDefault();
        
        if (!confirm('آیا مطمئن هستید که می‌خواهید همه اطلاعات وارد شده را حذف کنید؟\n\nاین عملیات قابل برگشت نیست!')) {
            return;
        }
        
        const $button = $(this);
        const $loading = $('#um-delete-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_delete_imported_data',
                nonce: '<?php echo wp_create_nonce('um_delete_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    alert('موفقیت: ' + response.data.message);
                    location.reload();
                } else {
                    alert('خطا: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                alert('خطا در اتصال به سرور');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // بروزرسانی وضعیت
    function updateStatus() {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_get_import_status',
                nonce: '<?php echo wp_create_nonce('um_status_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    const status = response.data;
                    let html = '';
                    
                    if (status.has_data) {
                        html = '<div class="notice notice-success"><p><strong>اطلاعات وارد شده:</strong><br>' +
                               status.news_count + ' خبر، ' + status.comments_count + ' کامنت و ' +
                               status.images_count + ' تصویر در تاریخ ' + status.import_date + '</p></div>';
                    } else {
                        html = '<div class="notice notice-info"><p>' + status.message + '</p></div>';
                    }
                    
                    $('#um-current-status').html(html);
                }
            }
        });
    }
    
    // بروزرسانی وضعیت هر 30 ثانیه
    setInterval(updateStatus, 30000);
    
    // بارگذاری لاگ‌ها
    $('#um-load-logs').on('click', function(e) {
        e.preventDefault();
        
        const $button = $(this);
        const $loading = $('#um-logs-loading');
        const $container = $('#um-logs-container');
        const $content = $('#um-logs-content');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_get_import_logs',
                nonce: '<?php echo wp_create_nonce('um_logs_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    let html = '';
                    
                    if (response.data.length === 0) {
                        html = '<p>هیچ لاگی موجود نیست.</p>';
                    } else {
                        html = '<div class="um-logs-list">';
                        
                        response.data.forEach(function(log) {
                            html += '<div class="um-log-entry">';
                            html += '<div class="um-log-header">';
                            html += '<span class="um-log-time">' + log.timestamp + '</span>';
                            html += '<span class="um-log-message">' + log.message + '</span>';
                            html += '</div>';
                            
                            if (log.data && Object.keys(log.data).length > 0) {
                                html += '<div class="um-log-data">';
                                html += '<pre>' + JSON.stringify(log.data, null, 2) + '</pre>';
                                html += '</div>';
                            }
                            
                            html += '</div>';
                        });
                        
                        html += '</div>';
                    }
                    
                    $content.html(html);
                    $container.show();
                } else {
                    alert('خطا در بارگذاری لاگ‌ها');
                }
            },
            error: function(xhr, status, error) {
                alert('خطا در اتصال به سرور');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // پاک کردن لاگ‌ها
    $('#um-clear-logs').on('click', function(e) {
        e.preventDefault();
        
        if (!confirm('آیا مطمئن هستید که می‌خواهید همه لاگ‌ها را پاک کنید؟')) {
            return;
        }
        
        const $button = $(this);
        const $loading = $('#um-logs-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_clear_import_logs',
                nonce: '<?php echo wp_create_nonce('um_clear_logs_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    $('#um-logs-content').empty();
                    $('#um-logs-container').hide();
                    alert('لاگ‌ها پاک شدند');
                } else {
                    alert('خطا در پاک کردن لاگ‌ها');
                }
            },
            error: function(xhr, status, error) {
                alert('خطا در اتصال به سرور');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // بارگذاری خودکار لاگ‌ها در صورت وجود خطا
    if (window.location.hash === '#show-logs') {
        $('#um-load-logs').click();
    }
});
</script>

<style>
.um-status-section,
.um-upload-section,
.um-delete-section {
    margin-bottom: 20px;
}

.um-upload-instructions {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 15px;
    margin: 15px 0;
}

.um-upload-instructions h3 {
    margin-top: 0;
    margin-bottom: 10px;
    color: #23282d;
}

.um-upload-instructions ul {
    margin: 0;
    padding-left: 20px;
}

.um-upload-instructions li {
    margin-bottom: 5px;
    color: #666;
}

.um-delete-warning {
    margin: 15px 0;
}

.spinner {
    float: none;
    margin: 0 5px;
}

#um-import-result {
    margin-top: 20px;
}

.card {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
}

.card h2 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 18px;
    color: #23282d;
}

.um-logs-section {
    margin-top: 20px;
}

.um-logs-controls {
    margin-bottom: 15px;
}

.um-logs-controls button {
    margin-left: 10px;
}

.um-logs-wrapper {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: #fafafa;
}

.um-logs-list {
    padding: 10px;
}

.um-log-entry {
    margin-bottom: 15px;
    padding: 10px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 4px;
}

.um-log-entry:last-child {
    margin-bottom: 0;
}

.um-log-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
}

.um-log-time {
    font-size: 12px;
    color: #666;
    font-family: monospace;
}

.um-log-message {
    font-weight: bold;
    color: #23282d;
}

.um-log-data {
    margin-top: 8px;
}

.um-log-data pre {
    background: #f8f8f8;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 8px;
    margin: 0;
    font-size: 11px;
    line-height: 1.4;
    overflow-x: auto;
    color: #333;
}

/* responsive */
@media (max-width: 768px) {
    .um-log-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .um-log-time {
        margin-bottom: 5px;
    }
    
    .um-logs-controls button {
        display: block;
        width: 100%;
        margin-left: 0;
        margin-bottom: 5px;
    }
}
</style> 