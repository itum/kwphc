<?php
/**
 * صفحه تنظیمات عمومی
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// بررسی دسترسی کاربر
if (!current_user_can('manage_options')) {
    wp_die(__('شما دسترسی به این صفحه را ندارید.', 'university-management'));
}

// دریافت وضعیت احراز هویت
$auth_status = get_option('_um_auth_status');
$auth_username = get_option('_um_auth_username');
$token_expires = get_option('_um_token_expires');
$seminars_limit = get_option('_um_seminars_limit', 10);
$debug_mode = get_option('um_debug_mode', '0');

$is_authenticated = ($auth_status === 'authenticated' && !empty($auth_username) && time() < $token_expires);
?>

<div class="wrap">
    <h1><?php _e('تنظیمات عمومی', 'university-management'); ?></h1>
    
    <!-- منطقه نمایش پیام‌ها -->
    <div id="um-messages"></div>
    
    <!-- بخش تست API -->
    <div class="card" style="margin-bottom: 20px;">
        <h2>تست اتصال API</h2>
        <p>ابتدا اتصال به API را تست کنید:</p>
        <button type="button" id="um-direct-test-btn" class="button button-secondary">تست مستقیم API</button>
        <div id="um-direct-test-result" style="margin-top: 10px;"></div>
    </div>
    
    <div class="um-general-settings">
        <!-- بخش احراز هویت -->
        <div class="um-auth-section">
            <div class="card">
                <h2><?php _e('احراز هویت', 'university-management'); ?></h2>
                
                <div id="um-auth-status" class="um-status-display">
                    <?php if ($is_authenticated): ?>
                        <div class="notice notice-success">
                            <p>
                                <strong><?php _e('وضعیت:', 'university-management'); ?></strong> 
                                <?php _e('وارد شده', 'university-management'); ?>
                                <br>
                                <strong><?php _e('نام کاربری:', 'university-management'); ?></strong> 
                                <?php echo esc_html($auth_username); ?>
                                <br>
                                <strong><?php _e('انقضای توکن:', 'university-management'); ?></strong> 
                                <?php echo date_i18n('Y/m/d H:i', $token_expires); ?>
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="notice notice-warning">
                            <p><?php _e('شما وارد نشده‌اید. لطفاً نام کاربری و رمز عبور خود را وارد کنید.', 'university-management'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <form id="um-auth-form" class="um-auth-form">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-username"><?php _e('نام کاربری', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="text" id="um-username" name="username" class="regular-text" 
                                       value="<?php echo $is_authenticated ? esc_attr($auth_username) : 'admin'; ?>" 
                                       <?php echo $is_authenticated ? 'readonly' : ''; ?> />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="um-password"><?php _e('رمز عبور', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="password" id="um-password" name="password" class="regular-text" 
                                       value="<?php echo $is_authenticated ? '' : 'kwphc_2024!'; ?>"
                                       <?php echo $is_authenticated ? 'readonly placeholder="رمز عبور ذخیره شده است"' : ''; ?> />
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <?php if ($is_authenticated): ?>
                            <button type="button" id="um-logout-btn" class="button button-secondary">
                                <?php _e('خروج از حساب کاربری', 'university-management'); ?>
                            </button>
                        <?php else: ?>
                            <button type="submit" id="um-login-btn" class="button button-primary">
                                <?php _e('ورود', 'university-management'); ?>
                            </button>
                        <?php endif; ?>
                        <span id="um-auth-loading" class="spinner" style="display: none;"></span>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش تنظیمات حالت دیباگ -->
        <div class="um-debug-settings-section">
            <div class="card">
                <h2><?php _e('تنظیمات حالت دیباگ', 'university-management'); ?></h2>
                <p class="description">
                    <?php _e('در حالت دیباگ، تمام لاگ‌های جزئیات فنی و اطلاعات توسعه‌دهندگان ثبت می‌شوند. توصیه می‌شود این گزینه را فقط برای رفع مشکلات فعال کنید.', 'university-management'); ?>
                </p>
                
                <form id="um-debug-settings-form">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-debug-mode"><?php _e('حالت دیباگ', 'university-management'); ?></label>
                            </th>
                            <td>
                                <label>
                                    <input type="checkbox" id="um-debug-mode" name="debug_mode" value="1" 
                                           <?php checked($debug_mode, '1'); ?> />
                                    <?php _e('فعال‌سازی حالت دیباگ', 'university-management'); ?>
                                </label>
                                <p class="description">
                                    <?php _e('با فعال کردن این گزینه، لاگ‌های جزئیات برای رفع مشکلات ثبت می‌شوند. در حالت عادی این گزینه را غیرفعال نگه دارید.', 'university-management'); ?>
                                </p>
                                <?php if ($debug_mode === '1'): ?>
                                    <div class="notice notice-warning inline" style="margin-top: 10px;">
                                        <p><strong>⚠️ هشدار:</strong> حالت دیباگ فعال است. این ممکن است باعث پر شدن فایل error_log شود.</p>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره تنظیمات دیباگ', 'university-management'); ?>
                        </button>
                        <span id="um-debug-loading" class="spinner" style="display: none;"></span>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش تنظیمات API -->
        <div class="um-api-settings-section">
            <div class="card">
                <h2><?php _e('تنظیمات API', 'university-management'); ?></h2>
                
                <form id="um-api-settings-form">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-seminars-limit"><?php _e('حد سمینارها', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="number" id="um-seminars-limit" name="limit" class="small-text" 
                                       value="<?php echo esc_attr($seminars_limit); ?>" min="1" max="100" />
                                <p class="description">
                                    <?php _e('تعداد سمینارهایی که از API دریافت می‌شود (1 تا 100)', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره تنظیمات', 'university-management'); ?>
                        </button>
                        <span id="um-api-loading" class="spinner" style="display: none;"></span>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش تنظیمات درگاه پرداخت -->
        <div class="um-payment-settings-section">
            <div class="card">
                <h2><?php _e('تنظیمات درگاه پرداخت زرین‌پال', 'university-management'); ?></h2>
                
                <form id="um-payment-settings-form">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-zarinpal-merchant-id"><?php _e('کلید درگاه', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="text" id="um-zarinpal-merchant-id" name="merchant_id" class="regular-text" 
                                       value="<?php echo esc_attr(get_option('um_zarinpal_merchant_id', '')); ?>" />
                                <p class="description">
                                    <?php _e('کلید درگاه زرین‌پال خود را وارد کنید', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="um-zarinpal-sandbox"><?php _e('حالت تست', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" id="um-zarinpal-sandbox" name="sandbox" value="1" 
                                       <?php checked(get_option('um_zarinpal_sandbox', '1'), '1'); ?> />
                                <label for="um-zarinpal-sandbox"><?php _e('استفاده از درگاه تست (Sandbox)', 'university-management'); ?></label>
                                <p class="description">
                                    <?php _e('برای تست پرداخت‌ها این گزینه را فعال نگه دارید', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره تنظیمات درگاه', 'university-management'); ?>
                        </button>
                        <span id="um-payment-loading" class="spinner" style="display: none;"></span>
                    </p>
                </form>
            </div>
        </div>
        

        
        <!-- بخش مدیریت سمینارها -->
        <div class="um-seminars-section">
            <div class="card">
                <h2><?php _e('مدیریت سمینارها', 'university-management'); ?></h2>
                
                <div id="um-seminars-status">
                    <?php if (!$is_authenticated): ?>
                        <div class="notice notice-info">
                            <p><?php _e('برای مشاهده سمینارها، ابتدا وارد شوید.', 'university-management'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="um-seminars-controls">
                    <button type="button" id="um-load-seminars-btn" class="button button-secondary" 
                            <?php echo !$is_authenticated ? 'disabled' : ''; ?>>
                        <?php _e('بارگذاری پیش‌نمایش سمینارها', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-import-seminars-btn" class="button button-primary" 
                            <?php echo !$is_authenticated ? 'disabled' : ''; ?>>
                        <?php _e('وارد کردن سمینارها به وردپرس', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-view-imported-seminars-btn" class="button button-secondary">
                        <?php _e('مشاهده سمینارهای وارد شده', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-check-images-btn" class="button button-secondary">
                        <?php _e('بررسی وضعیت تصاویر', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-test-images-btn" class="button button-secondary">
                        <?php _e('تست دانلود تصاویر فارسی', 'university-management'); ?>
                    </button>
                    <span id="um-seminars-loading" class="spinner" style="display: none;"></span>
                </div>
                
                <div id="um-seminars-stats" class="um-seminars-stats" style="margin-top: 15px; display: none;">
                    <!-- آمار سمینارها اینجا نمایش داده می‌شود -->
                </div>
                
                <div id="um-seminars-list" class="um-seminars-list" style="margin-top: 20px;">
                    <!-- سمینارها اینجا نمایش داده می‌شوند -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript بر اساس کدهای تست موفق
jQuery(document).ready(function($) {
    console.log('University Management General Settings loaded');
    
    // تست مستقیم API (مثل test-auth.php)
    $('#um-direct-test-btn').on('click', function() {
        var $button = $(this);
        var $result = $('#um-direct-test-result');
        
        $button.prop('disabled', true).text('در حال تست...');
        $result.html('<p>در حال تست اتصال...</p>');
        
        // استفاده از AJAX برای فراخوانی تست
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_direct_api_test',
                nonce: '<?php echo wp_create_nonce('um_direct_test_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    $result.html('<div style="background: #d4edda; padding: 10px; border: 1px solid #c3e6cb; border-radius: 4px; margin-top: 10px;">' +
                        '<strong>✅ API کار می‌کند!</strong><br>' +
                        'کد HTTP: ' + response.data.http_code + '<br>' +
                        'وضعیت: ' + response.data.status + '<br>' +
                        'پیام: ' + response.data.message + '<br>' +
                        'توکن: ' + response.data.token_preview + 
                        '</div>');
                } else {
                    $result.html('<div style="background: #f8d7da; padding: 10px; border: 1px solid #f5c6cb; border-radius: 4px; margin-top: 10px;">' +
                        '<strong>❌ خطا در API:</strong><br>' + response.data +
                        '</div>');
                }
            },
            error: function(xhr, status, error) {
                $result.html('<div style="background: #f8d7da; padding: 10px; border: 1px solid #f5c6cb; border-radius: 4px; margin-top: 10px;">' +
                    '<strong>❌ خطا در اتصال:</strong><br>' + error +
                    '</div>');
            },
            complete: function() {
                $button.prop('disabled', false).text('تست مستقیم API');
            }
        });
    });
    
    // فرم احراز هویت
    $('#um-auth-form').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');
        
        var username = $('#um-username').val();
        var password = $('#um-password').val();
        
        if (!username || !password) {
            showMessage('نام کاربری و رمز عبور الزامی هستند', 'error');
            return;
        }
        
        var $button = $('#um-login-btn');
        var $loading = $('#um-auth-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_authenticate_user',
                username: username,
                password: password,
                nonce: '<?php echo wp_create_nonce('um_auth_nonce'); ?>'
            },
            success: function(response) {
                console.log('AJAX Success:', response);
                
                if (response.success) {
                    showMessage('ورود موفقیت‌آمیز بود! صفحه بازخوانی می‌شود...', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    showMessage('خطا در ورود: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // خروج از حساب
    $('#um-logout-btn').on('click', function(e) {
        e.preventDefault();
        
        if (!confirm('آیا مطمئن هستید که می‌خواهید خارج شوید؟')) {
            return;
        }
        
        var $button = $(this);
        var $loading = $('#um-auth-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_logout_user',
                nonce: '<?php echo wp_create_nonce('um_logout_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage('با موفقیت خارج شدید! صفحه بازخوانی می‌شود...', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    showMessage('خطا در خروج: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // ذخیره تنظیمات دیباگ
    $('#um-debug-settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var debugMode = $('#um-debug-mode').is(':checked') ? '1' : '0';
        
        var $button = $(this).find('button[type="submit"]');
        var $loading = $('#um-debug-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_save_debug_settings',
                debug_mode: debugMode,
                nonce: '<?php echo wp_create_nonce('um_debug_settings_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage('تنظیمات دیباگ با موفقیت ذخیره شد. صفحه بازخوانی می‌شود...', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showMessage('خطا در ذخیره تنظیمات دیباگ: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // ذخیره تنظیمات API
    $('#um-api-settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var limit = $('#um-seminars-limit').val();
        
        if (!limit || limit < 1 || limit > 100) {
            showMessage('حد سمینارها باید بین 1 تا 100 باشد', 'error');
            return;
        }
        
        var $button = $(this).find('button[type="submit"]');
        var $loading = $('#um-api-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_save_api_settings',
                limit: limit,
                nonce: '<?php echo wp_create_nonce('um_api_settings_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage('تنظیمات با موفقیت ذخیره شد', 'success');
                } else {
                    showMessage('خطا در ذخیره تنظیمات: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // ذخیره تنظیمات API آزمون‌ها
    $('#um-azmoon-api-settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var limit = $('#um-azmoon-limit').val();
        
        if (!limit || limit < 1 || limit > 100) {
            showMessage('حد آزمون‌ها باید بین 1 تا 100 باشد', 'error');
            return;
        }
        
        var $button = $(this).find('button[type="submit"]');
        var $loading = $('#um-azmoon-api-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_save_azmoon_api_settings',
                limit: limit,
                nonce: '<?php echo wp_create_nonce('um_azmoon_api_settings_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage('تنظیمات آزمون‌ها با موفقیت ذخیره شد', 'success');
                } else {
                    showMessage('خطا در ذخیره تنظیمات: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // بارگذاری سمینارها
    $('#um-load-seminars-btn').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $loading = $('#um-seminars-loading');
        var $list = $('#um-seminars-list');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_get_seminars',
                nonce: '<?php echo wp_create_nonce('um_seminars_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    displaySeminars(response.data);
                    showMessage('سمینارها با موفقیت بارگذاری شدند', 'success');
                } else {
                    showMessage('خطا در بارگذاری سمینارها: ' + response.data, 'error');
                    $list.html('<div class="no-seminars">خطا در بارگذاری سمینارها</div>');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
                $list.html('<div class="no-seminars">خطا در اتصال به سرور</div>');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // وارد کردن سمینارها
    $('#um-import-seminars-btn').on('click', function(e) {
        e.preventDefault();
        
        if (!confirm('آیا مطمئن هستید؟ این عملیات ممکن است پست‌های جدیدی در سایت شما ایجاد کند.')) {
            return;
        }
        
        var $button = $(this);
        var $loading = $('#um-seminars-loading');
        
        $button.prop('disabled', true);
        $('#um-load-seminars-btn').prop('disabled', true);
        $loading.show();
        showMessage('در حال وارد کردن سمینارها... این عملیات ممکن است چند دقیقه طول بکشد.', 'info');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_import_seminars',
                nonce: '<?php echo wp_create_nonce('um_import_seminars_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    var summary = response.data;
                    var message = 'عملیات با موفقیت انجام شد!<br>';
                    message += '✅ ' + summary.imported + ' سمینار جدید وارد شد.<br>';
                    message += '🔄 ' + summary.updated + ' سمینار به‌روزرسانی شد.<br>';
                    message += '👌 ' + summary.skipped + ' سمینار تکراری بود.<br>';
                    message += '❌ ' + summary.failed + ' سمینار با خطا مواجه شد.<br>';
                    message += '🖼️ ' + (summary.images_downloaded || 0) + ' تصویر دانلود شد.<br>';
                    message += '⚠️ ' + (summary.images_failed || 0) + ' تصویر دانلود نشد.<br>';
                    message += '⏭️ ' + (summary.images_skipped || 0) + ' تصویر رد شد.';
                    showMessage(message, 'success');
                } else {
                    showMessage('خطا در عملیات وارد کردن: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $('#um-load-seminars-btn').prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // مشاهده سمینارهای وارد شده
    $('#um-view-imported-seminars-btn').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $loading = $('#um-seminars-loading');
        var $list = $('#um-seminars-list');
        
        $button.prop('disabled', true);
        $loading.show();
        $list.html('<div class="loading">در حال بارگذاری سمینارهای وارد شده...</div>');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_get_imported_seminars',
                nonce: '<?php echo wp_create_nonce('um_imported_seminars_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    displayImportedSeminars(response.data);
                    showMessage('سمینارهای وارد شده با موفقیت بارگذاری شدند', 'success');
                } else {
                    showMessage('خطا در بارگذاری سمینارها: ' + response.data, 'error');
                    $list.html('<div class="no-seminars">خطا در بارگذاری سمینارها</div>');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
                $list.html('<div class="no-seminars">خطا در اتصال به سرور</div>');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    });
    
    // بررسی وضعیت تصاویر
    $('#um-check-images-btn').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $list = $('#um-seminars-list');
        
        $button.prop('disabled', true);
        $list.html('<div class="loading">در حال بررسی وضعیت تصاویر...</div>');
        
        // بررسی وضعیت تصاویر
        var stats = checkImagesStatus();
        displayImagesStatus(stats);
        
        $button.prop('disabled', false);
    });
    
    // تابع بررسی وضعیت تصاویر
    function checkImagesStatus() {
        var stats = {
            total_seminars: 0,
            with_thumbnail: 0,
            without_thumbnail: 0,
            seminars_without_images: []
        };
        
        // اینجا می‌توانید از AJAX استفاده کنید یا مستقیماً بررسی کنید
        // فعلاً از داده‌های موجود استفاده می‌کنیم
        return stats;
    }
    
    // تابع نمایش وضعیت تصاویر
    function displayImagesStatus(stats) {
        var $list = $('#um-seminars-list');
        $list.empty();
        
        var $status = $('<div class="um-images-status" style="background: #f8f9fa; padding: 20px; border-radius: 8px;">');
        
        $status.append('<h3 style="margin-top: 0; color: #0073aa;">وضعیت تصاویر سمینارها</h3>');
        $status.append('<div class="um-status-stats">');
        $status.append('<p><strong>📊 آمار کلی:</strong></p>');
        $status.append('<ul>');
        $status.append('<li>📝 کل سمینارها: ' + stats.total_seminars + '</li>');
        $status.append('<li>✅ با تصویر شاخص: ' + stats.with_thumbnail + '</li>');
        $status.append('<li>❌ بدون تصویر شاخص: ' + stats.without_thumbnail + '</li>');
        $status.append('</ul>');
        $status.append('</div>');
        
        if (stats.seminars_without_images.length > 0) {
            $status.append('<div class="um-seminars-without-images">');
            $status.append('<p><strong>📋 سمینارهای بدون تصویر:</strong></p>');
            $status.append('<ul>');
            $.each(stats.seminars_without_images, function(index, seminar) {
                $status.append('<li>' + escapeHtml(seminar.title) + ' (ID: ' + seminar.id + ')</li>');
            });
            $status.append('</ul>');
            $status.append('</div>');
        }
        
        $list.append($status);
    }
    
    // تست دانلود تصاویر فارسی
    $('#um-test-images-btn').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $list = $('#um-seminars-list');
        
        $button.prop('disabled', true);
        $list.html('<div class="loading">در حال تست دانلود تصاویر فارسی...</div>');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_test_image_download',
                nonce: '<?php echo wp_create_nonce('um_test_image_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    displayImageTestResults(response.data);
                    showMessage('تست دانلود تصاویر فارسی کامل شد', 'success');
                } else {
                    showMessage('خطا در تست دانلود: ' + response.data, 'error');
                    $list.html('<div class="no-seminars">خطا در تست دانلود تصاویر</div>');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
                $list.html('<div class="no-seminars">خطا در اتصال به سرور</div>');
            },
            complete: function() {
                $button.prop('disabled', false);
            }
        });
    });
    
    // تابع نمایش نتایج تست تصاویر
    function displayImageTestResults(results) {
        var $list = $('#um-seminars-list');
        $list.empty();
        
        var $results = $('<div class="um-image-test-results" style="background: #f8f9fa; padding: 20px; border-radius: 8px;">');
        
        $results.append('<h3 style="margin-top: 0; color: #0073aa;">نتایج تست دانلود تصاویر فارسی</h3>');
        
        $.each(results, function(index, result) {
            var statusClass = result.success ? 'success' : 'error';
            var statusIcon = result.success ? '✅' : '❌';
            
            var $item = $('<div class="um-test-item" style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 4px; background: #fff;">');
            
            $item.append('<div style="font-weight: bold; margin-bottom: 5px;">' + 
                statusIcon + ' ' + escapeHtml(result.filename) + '</div>');
            
            $item.append('<div style="font-size: 12px; color: #666; margin-bottom: 5px;">' +
                '<strong>URL:</strong> ' + escapeHtml(result.url) + '</div>');
            
            $item.append('<div style="font-size: 12px; color: #666; margin-bottom: 5px;">' +
                '<strong>نام فایل انگلیسی:</strong> ' + escapeHtml(result.english_filename) + '</div>');
            
            $item.append('<div style="font-size: 12px; color: ' + (result.success ? '#28a745' : '#dc3545') + ';">' +
                '<strong>وضعیت:</strong> ' + escapeHtml(result.error) + '</div>');
            
            $results.append($item);
        });
        
        $list.append($results);
    }
    
    // تابع نمایش سمینارهای وارد شده
    function displayImportedSeminars(seminars) {
        var $list = $('#um-seminars-list');
        $list.empty();
        
        if (!seminars || seminars.length === 0) {
            $list.html('<div class="no-seminars">هیچ سمینار وارد شده‌ای یافت نشد</div>');
            return;
        }
        
        $.each(seminars, function(index, seminar) {
            var $item = $('<div class="um-seminar-item" style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 8px;">');
            
            // عنوان
            $item.append('<div class="um-seminar-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">' + 
                escapeHtml(seminar.title) + 
                '</div>');
            
            // تصویر شاخص
            if (seminar.thumbnail) {
                $item.append('<div class="um-seminar-thumbnail" style="margin-bottom: 10px;">' +
                    '<img src="' + seminar.thumbnail + '" alt="تصویر شاخص" style="max-width: 200px; max-height: 150px; border-radius: 4px;">' +
                    '</div>');
            }
            
            // اطلاعات کلیدی
            var mainInfo = [];
            if (seminar.teacher) mainInfo.push('👨‍🏫 مدرس: ' + escapeHtml(seminar.teacher));
            if (seminar.time) mainInfo.push('📅 زمان برگزاری: ' + escapeHtml(seminar.time));
            if (seminar.duration) mainInfo.push('⏰ مدت: ' + escapeHtml(seminar.duration) + ' ساعت');
            if (seminar.fee) mainInfo.push('💰 هزینه: ' + formatPrice(seminar.fee) + ' ریال');
            
            if (mainInfo.length > 0) {
                $item.append('<div class="um-seminar-main-info" style="margin-bottom: 10px;">' + mainInfo.join('<br>') + '</div>');
            }
            
            // مخاطبین
            if (seminar.audience) {
                $item.append('<div class="um-seminar-audience" style="margin-bottom: 10px;">' +
                    '<strong>👥 مخاطبین:</strong> ' + escapeHtml(seminar.audience) +
                    '</div>');
            }
            
            // اطلاعات اضافی
            var additionalInfo = [];
            if (seminar.course_code) additionalInfo.push('کد دوره: ' + escapeHtml(seminar.course_code));
            if (seminar.support_tel) additionalInfo.push('📞 پشتیبانی: ' + escapeHtml(seminar.support_tel));
            if (seminar.date) additionalInfo.push('تاریخ ایجاد: ' + escapeHtml(seminar.date));
            
            if (additionalInfo.length > 0) {
                $item.append('<div class="um-seminar-additional" style="margin-bottom: 10px; font-size: 12px; color: #666;">' +
                    additionalInfo.join(' | ') +
                    '</div>');
            }
            
            // دکمه‌های عملیات
            var $actions = $('<div class="um-seminar-actions" style="margin-top: 10px;">');
            
            if (seminar.edit_url) {
                $actions.append('<a href="' + seminar.edit_url + '" class="button button-small" target="_blank">ویرایش</a> ');
            }
            
            if (seminar.view_url) {
                $actions.append('<a href="' + seminar.view_url + '" class="button button-small" target="_blank">مشاهده</a> ');
            }
            
            $actions.append('<span class="seminar-id" style="color: #999; font-size: 11px;">ID: ' + seminar.id + '</span>');
            
            $item.append($actions);
            $list.append($item);
        });
    }
    
    // تابع نمایش سمینارها
    function displaySeminars(seminars) {
        var $list = $('#um-seminars-list');
        $list.empty();
        
        if (!seminars || seminars.length === 0) {
            $list.html('<div class="no-seminars">هیچ سمیناری یافت نشد</div>');
            return;
        }
        
        $.each(seminars, function(index, seminar) {
            var $item = $('<div class="um-seminar-item">');
            
            // عنوان دوره
            if (seminar.Title) {
                $item.append('<div class="um-seminar-title">' + 
                    escapeHtml(seminar.Title) + 
                    '</div>');
            }
            
            // اطلاعات کلیدی
            var mainInfo = [];
            if (seminar.Date_Start) mainInfo.push('📅 تاریخ شروع: ' + formatPersianDate(seminar.Date_Start));
            if (seminar.Name_Ostad) mainInfo.push('👨‍🏫 مدرس: ' + escapeHtml(seminar.Name_Ostad));
            if (seminar.Moddat) mainInfo.push('⏰ مدت: ' + formatPersianDate(seminar.Moddat) + ' ساعت');
            
            if (mainInfo.length > 0) {
                $item.append('<div class="um-seminar-main-info">' + mainInfo.join('<br>') + '</div>');
            }
            
            // تصویر پوستر
            if (seminar.SeminarPic || seminar.Boroshor) {
                var imageName = seminar.SeminarPic || seminar.Boroshor;
                if (imageName && imageName !== '-' && imageName !== '') {
                    // فرض می‌کنیم تصاویر در مسیر خاصی قرار دارند
                    var imageUrl = 'https://kwphc.ir/webservice_new/images/' + imageName;
                    $item.append('<div class="um-seminar-image">' +
                        '<img src="' + imageUrl + '" alt="پوستر ' + escapeHtml(seminar.Title || 'دوره') + '" ' +
                        'style="max-width: 200px; max-height: 150px; border-radius: 8px; margin: 10px 0;" ' +
                        'onerror="this.style.display=\'none\'">' +
                        '</div>');
                }
            }
            
            // هزینه آموزشی
            if (seminar.H_Amoozeshi && seminar.H_Amoozeshi !== '0') {
                var formattedFee = formatPrice(seminar.H_Amoozeshi);
                $item.append('<div class="um-seminar-fee">' +
                    '💰 هزینه آموزشی: ' + formattedFee + ' ریال' +
                    '</div>');
            }
            
            // مخاطبین
            if (seminar.Mokhatabin && seminar.Mokhatabin !== '-') {
                $item.append('<div class="um-seminar-audience">' +
                    '<strong>👥 مخاطبین:</strong> ' + escapeHtml(seminar.Mokhatabin) +
                    '</div>');
            }
            
            // محتوای دوره
            if (seminar.Mohtava && seminar.Mohtava !== '-') {
                // پاک کردن تگ‌های HTML اضافی و نمایش محتوا
                var content = cleanHtmlContent(seminar.Mohtava);
                
                $item.append('<div class="um-seminar-content">' +
                    '<strong>📋 محتوای دوره:</strong><br>' +
                    '<div class="content-text">' + escapeHtml(content) + '</div>' +
                    '</div>');
            }
            
            // اطلاعات تماس
            if (seminar.PostibaniTel && seminar.PostibaniTel !== '-') {
                $item.append('<div class="um-seminar-contact">' +
                    '📞 تماس پشتیبانی: ' + escapeHtml(seminar.PostibaniTel) +
                    '</div>');
            }
            
            // اطلاعات اضافی (در صورت نیاز)
            var additionalInfo = [];
            if (seminar.co_doreh) additionalInfo.push('کد دوره: ' + escapeHtml(seminar.co_doreh));
            if (seminar.Date_Final) additionalInfo.push('تاریخ پایان: ' + formatPersianDate(seminar.Date_Final));
            
            if (additionalInfo.length > 0) {
                $item.append('<div class="um-seminar-additional">' +
                    '<small style="color: #666;">' + additionalInfo.join(' | ') + '</small>' +
                    '</div>');
            }
            
            $list.append($item);
        });
    }
    
    // تابع نمایش پیام
    function showMessage(message, type) {
        var $messages = $('#um-messages');
        var className = 'notice notice-' + type;
        var $message = $('<div class="' + className + '"><p>' + message + '</p></div>');
        
        $messages.empty().append($message);
        
        // حذف پیام بعد از 5 ثانیه
        setTimeout(function() {
            $message.fadeOut();
        }, 5000);
    }
    
    // تابع escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    
    // تابع فرمت کردن تاریخ فارسی
    function formatPersianDate(dateStr) {
        if (!dateStr || dateStr === '-') return '';
        
        // تبدیل اعداد انگلیسی به فارسی
        var persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        var formattedDate = dateStr.replace(/[0-9]/g, function(w) {
            return persianNumbers[+w];
        });
        
        return formattedDate;
    }
    
    // تابع فرمت کردن قیمت
    function formatPrice(price) {
        if (!price || price === '0') return '';
        
        var number = parseInt(price);
        var formatted = number.toLocaleString('fa-IR');
        
        return formatted;
    }
    
    // تابع تمیز کردن محتوای HTML
    function cleanHtmlContent(htmlContent) {
        if (!htmlContent) return '';
        
        return htmlContent
            .replace(/<div[^>]*>/g, '')
            .replace(/<\/div>/g, '\n')
            .replace(/<span[^>]*>/g, '')
            .replace(/<\/span>/g, '')
            .replace(/<br\s*\/?>/g, '\n')
            .replace(/&nbsp;/g, ' ')
            .replace(/\r\n/g, '\n')
            .replace(/\n\s*\n/g, '\n')
            .replace(/^\s+|\s+$/g, '')
            .trim();
    }
});
</script>

<style>
.um-general-settings .card {
    margin-bottom: 20px;
    padding: 20px;
}

.um-status-display {
    margin-bottom: 20px;
}

.spinner {
    float: none;
    margin: 0 10px;
}

.um-seminars-list {
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid #ddd;
    padding: 15px;
    background: #f9f9f9;
}

.um-seminar-item {
    padding: 20px;
    margin-bottom: 15px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.um-seminar-title {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 8px;
}

.um-seminar-main-info {
    background: #e8f4f8;
    padding: 12px;
    border-radius: 6px;
    margin: 10px 0;
    border-left: 4px solid #3498db;
    line-height: 1.6;
}

.um-seminar-image {
    text-align: center;
    margin: 15px 0;
}

.um-seminar-image img {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
}

.um-seminar-fee {
    background: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 6px;
    margin: 10px 0;
    border-left: 4px solid #28a745;
    font-weight: bold;
}

.um-seminar-audience {
    background: #fff3cd;
    color: #856404;
    padding: 10px;
    border-radius: 6px;
    margin: 10px 0;
    border-left: 4px solid #ffc107;
}

.um-seminar-content {
    margin: 15px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 4px solid #6c757d;
}

.um-seminar-content .content-text {
    margin-top: 8px;
    line-height: 1.8;
    white-space: pre-line;
    color: #495057;
}

.um-seminar-contact {
    background: #cce7ff;
    color: #004085;
    padding: 10px;
    border-radius: 6px;
    margin: 10px 0;
    border-left: 4px solid #007bff;
    font-weight: bold;
}

.um-seminar-additional {
    margin-top: 15px;
    padding-top: 10px;
    border-top: 1px solid #e9ecef;
}

#um-messages {
    margin-bottom: 20px;
}

.no-seminars {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 40px;
    background: #f8f9fa;
    border-radius: 8px;
}

/* اضافه کردن انیمیشن برای بارگذاری */
.um-seminar-item {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* بهبود نمایش در موبایل */
@media (max-width: 768px) {
    .um-seminar-item {
        padding: 15px;
        margin-bottom: 10px;
    }
    
    .um-seminar-title {
        font-size: 16px;
    }
    
    .um-seminar-image img {
        max-width: 100% !important;
        height: auto !important;
    }
}
</style> 