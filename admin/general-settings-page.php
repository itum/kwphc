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

// پردازش ذخیره تنظیمات برگه جزئیات دوره
if (isset($_POST['um_cdp_nonce']) && wp_verify_nonce($_POST['um_cdp_nonce'], 'um_cdp_save')) {
    update_option('um_course_detail_page_id', intval($_POST['um_course_detail_page_id'] ?? 0));
    echo '<div class="updated"><p>' . esc_html__('تنظیمات ذخیره شد.', 'university-management') . '</p></div>';
}
?>

<div class="wrap">
    <h1><?php _e('تنظیمات عمومی', 'university-management'); ?></h1>
    
    <!-- منطقه نمایش پیام‌ها -->
    <div id="um-messages"></div>
    
    <div class="um-general-settings">
        
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
        
        <!-- بخش انتخاب برگه جزئیات دوره -->
        <div class="um-course-detail-page-section">
            <div class="card">
                <h2><?php _e('برگه جزئیات دوره', 'university-management'); ?></h2>
                <p class="description">
                    <?php _e('برگه‌ای را انتخاب کنید که در آن شورتکد [course_details] قرار دارد. این برگه برای نمایش جزئیات دوره‌ها استفاده می‌شود.', 'university-management'); ?>
                </p>
                
                <form method="post">
                    <?php wp_nonce_field('um_cdp_save', 'um_cdp_nonce'); ?>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-course-detail-page-id"><?php _e('انتخاب برگه', 'university-management'); ?></label>
                            </th>
                            <td>
                                <?php
                                $selected = intval(get_option('um_course_detail_page_id', 0));
                                wp_dropdown_pages(array(
                                    'echo' => 1,
                                    'name' => 'um_course_detail_page_id',
                                    'selected' => $selected,
                                    'show_option_none' => __('— انتخاب صفحه —', 'university-management')
                                ));
                                ?>
                                <p class="description">
                                    <?php _e('در این برگه شورتکد [course_details] را قرار دهید.', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره', 'university-management'); ?>
                        </button>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش تنظیمات درگاه پرداخت -->
        <div class="um-payment-settings-section">
            <div class="card">
                <h2><?php _e('تنظیمات درگاه پرداخت زرین‌پال', 'university-management'); ?></h2>
                
                <form id="um-payment-settings-form" method="post" action="" onsubmit="return false;">
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
                        <button type="button" id="um-test-zarinpal-connection" class="button button-secondary">
                            <?php _e('تست اتصال به درگاه', 'university-management'); ?>
                        </button>
                        <span id="um-payment-loading" class="spinner" style="display: none;"></span>
                        <span id="um-payment-test-result" style="margin-right: 10px; font-weight: bold;"></span>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش انتخاب درگاه پرداخت برای دوره‌ها و سمینارها -->
        <div class="um-course-seminar-gateway-section">
            <div class="card">
                <h2><?php _e('تنظیمات درگاه پرداخت دوره‌ها و سمینارها', 'university-management'); ?></h2>
                <p class="description">
                    <?php _e('درگاه پرداخت مورد استفاده برای خرید دوره‌ها و ثبت‌نام سمینارها را انتخاب کنید.', 'university-management'); ?>
                </p>
                
                <form id="um-course-seminar-gateway-form" method="post" action="" onsubmit="return false;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-course-seminar-gateway"><?php _e('درگاه پرداخت', 'university-management'); ?></label>
                            </th>
                            <td>
                                <select id="um-course-seminar-gateway" name="gateway" class="regular-text">
                                    <?php $current_gateway = get_option('um_seminar_gateway', 'fcp'); ?>
                                    <option value="fcp" <?php selected($current_gateway, 'fcp'); ?>><?php _e('فناوا', 'university-management'); ?></option>
                                    <option value="zarinpal" <?php selected($current_gateway, 'zarinpal'); ?>><?php _e('زرین‌پال', 'university-management'); ?></option>
                                </select>
                                <p class="description">
                                    <?php _e('درگاه پرداخت مورد استفاده برای دوره‌ها و سمینارها', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره تنظیمات', 'university-management'); ?>
                        </button>
                        <span id="um-course-seminar-gateway-loading" class="spinner" style="display: none;"></span>
                        <span id="um-course-seminar-gateway-result" style="margin-right: 10px; font-weight: bold;"></span>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش تنظیمات درگاه پرداخت فناوا -->
        <div class="um-fcp-settings-section">
            <div class="card">
                <h2><?php _e('تنظیمات درگاه پرداخت فناوا', 'university-management'); ?></h2>
                <p class="description">
                    <?php _e('اطلاعات درگاه پرداخت فناوا را وارد کنید. این درگاه به عنوان پیش‌فرض برای رزرو سالن و ثبت‌نام سمینارها استفاده می‌شود.', 'university-management'); ?>
                </p>
                
                <form id="um-fcp-settings-form" method="post" action="" onsubmit="return false;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-fcp-user-id"><?php _e('نام کاربری (UserId)', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="text" id="um-fcp-user-id" name="user_id" class="regular-text" 
                                       value="<?php echo esc_attr(get_option('um_fcp_user_id', '')); ?>" />
                                <p class="description">
                                    <?php _e('نام کاربری درگاه فناوا', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="um-fcp-password"><?php _e('رمز عبور (Password)', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="password" id="um-fcp-password" name="password" class="regular-text" 
                                       value="<?php echo esc_attr(get_option('um_fcp_password', '')); ?>" />
                                <p class="description">
                                    <?php _e('رمز عبور درگاه فناوا', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="um-fcp-merchant-id"><?php _e('شماره پذیرنده (MerchantId)', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="text" id="um-fcp-merchant-id" name="merchant_id" class="regular-text" 
                                       value="<?php echo esc_attr(get_option('um_fcp_merchant_id', '')); ?>" />
                                <p class="description">
                                    <?php _e('شماره پذیرنده درگاه فناوا', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره تنظیمات فناوا', 'university-management'); ?>
                        </button>
                        <span id="um-fcp-loading" class="spinner" style="display: none;"></span>
                        <span id="um-fcp-save-result" style="margin-right: 10px; font-weight: bold;"></span>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript برای تنظیمات عمومی
jQuery(document).ready(function($) {
    console.log('University Management General Settings loaded');
    
    // جلوگیری از submit معمولی فرم پرداخت
    $('#um-payment-settings-form').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    });
    
    // مدیریت فرم تنظیمات درگاه پرداخت - مستقل از فایل external
    var paymentForm = $('#um-payment-settings-form');
    if (paymentForm.length) {
        console.log('Payment form found, attaching handlers...');
        
        // Handler برای ذخیره تنظیمات
        paymentForm.on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $loading = $('#um-payment-loading');
            var merchantId = $('#um-zarinpal-merchant-id').val();
            var sandbox = $('#um-zarinpal-sandbox').is(':checked') ? '1' : '0';
            
            if (!merchantId.trim()) {
                alert('کلید درگاه الزامی است');
                return false;
            }
            
            $button.prop('disabled', true);
            $loading.show();
            
            var ajaxUrl = (typeof ajaxurl !== 'undefined') ? ajaxurl : '<?php echo admin_url('admin-ajax.php'); ?>';
            var paymentNonce = '<?php echo wp_create_nonce('um_general_settings'); ?>';
            
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'um_save_payment_settings',
                    merchant_id: merchantId,
                    sandbox: sandbox,
                    nonce: paymentNonce
                },
                success: function(response) {
                    if (response.success) {
                        alert('تنظیمات درگاه پرداخت با موفقیت ذخیره شد');
                        // صفحه را reload نکنیم
                    } else {
                        alert('خطا: ' + response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    alert('خطا در اتصال به سرور: ' + error);
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $loading.hide();
                }
            });
            
            return false;
        });
        
        // Handler برای تست اتصال
        $('#um-test-zarinpal-connection').on('click', function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var $loading = $('#um-payment-loading');
            var $result = $('#um-payment-test-result');
            var merchantId = $('#um-zarinpal-merchant-id').val();
            var sandbox = $('#um-zarinpal-sandbox').is(':checked') ? '1' : '0';
            
            if (!merchantId.trim()) {
                $result.html('<span style="color: red;">لطفاً ابتدا کلید درگاه را وارد کنید</span>');
                return false;
            }
            
            $result.html('<span style="color: blue;">در حال تست اتصال...</span>');
            $button.prop('disabled', true);
            $loading.show();
            
            var ajaxUrl = (typeof ajaxurl !== 'undefined') ? ajaxurl : '<?php echo admin_url('admin-ajax.php'); ?>';
            var paymentNonce = '<?php echo wp_create_nonce('um_general_settings'); ?>';
            
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'um_test_zarinpal_connection',
                    merchant_id: merchantId,
                    sandbox: sandbox,
                    nonce: paymentNonce
                },
                success: function(response) {
                    if (response.success) {
                        $result.html('<span style="color: green;">✓ ' + response.data.message + '</span>');
                        if (response.data.authority) {
                            $result.append('<br><small>Authority: ' + response.data.authority + '</small>');
                        }
                    } else {
                        $result.html('<span style="color: red;">✗ ' + response.data + '</span>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    $result.html('<span style="color: red;">✗ خطا در اتصال به سرور: ' + error + '</span>');
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $loading.hide();
                }
            });
            
            return false;
        });
        
        console.log('Payment form handlers attached successfully');
    }
    
    // مدیریت فرم تنظیمات فناوا
    var fcpForm = $('#um-fcp-settings-form');
    if (fcpForm.length) {
        fcpForm.on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $loading = $('#um-fcp-loading');
            var $result = $('#um-fcp-save-result');
            var userId = $('#um-fcp-user-id').val();
            var password = $('#um-fcp-password').val();
            var merchantId = $('#um-fcp-merchant-id').val();
            
            if (!userId.trim() || !password.trim() || !merchantId.trim()) {
                $result.html('<span style="color: red;">لطفاً تمام فیلدها را تکمیل کنید</span>');
                return false;
            }
            
            $button.prop('disabled', true);
            $loading.show();
            $result.html('');
            
            var ajaxUrl = (typeof ajaxurl !== 'undefined') ? ajaxurl : '<?php echo admin_url('admin-ajax.php'); ?>';
            var fcpNonce = '<?php echo wp_create_nonce('um_general_settings'); ?>';
            
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'um_save_fcp_settings',
                    user_id: userId,
                    password: password,
                    merchant_id: merchantId,
                    nonce: fcpNonce
                },
                success: function(response) {
                    if (response.success) {
                        $result.html('<span style="color: green;">✓ تنظیمات فناوا با موفقیت ذخیره شد</span>');
                    } else {
                        $result.html('<span style="color: red;">✗ خطا: ' + response.data + '</span>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    $result.html('<span style="color: red;">✗ خطا در اتصال به سرور: ' + error + '</span>');
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $loading.hide();
                }
            });
            
            return false;
        });
    }
    
    // مدیریت فرم انتخاب درگاه دوره‌ها و سمینارها
    var courseSeminarGatewayForm = $('#um-course-seminar-gateway-form');
    if (courseSeminarGatewayForm.length) {
        courseSeminarGatewayForm.on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $loading = $('#um-course-seminar-gateway-loading');
            var $result = $('#um-course-seminar-gateway-result');
            var gateway = $('#um-course-seminar-gateway').val();
            
            if (!gateway) {
                $result.html('<span style="color: red;">لطفاً درگاه پرداخت را انتخاب کنید</span>');
                return false;
            }
            
            $button.prop('disabled', true);
            $loading.show();
            $result.html('');
            
            var ajaxUrl = (typeof ajaxurl !== 'undefined') ? ajaxurl : '<?php echo admin_url('admin-ajax.php'); ?>';
            var gatewayNonce = '<?php echo wp_create_nonce('um_general_settings'); ?>';
            
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'um_save_course_seminar_gateway',
                    gateway: gateway,
                    nonce: gatewayNonce
                },
                success: function(response) {
                    if (response.success) {
                        $result.html('<span style="color: green;">✓ تنظیمات با موفقیت ذخیره شد</span>');
                    } else {
                        $result.html('<span style="color: red;">✗ خطا: ' + response.data + '</span>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    $result.html('<span style="color: red;">✗ خطا در اتصال به سرور: ' + error + '</span>');
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $loading.hide();
                }
            });
            
            return false;
        });
    }
    
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
    
});
</script>

<style>
.um-general-settings .card {
    margin-bottom: 20px;
    padding: 20px;
}

.spinner {
    float: none;
    margin: 0 10px;
}

#um-messages {
    margin-bottom: 20px;
}
</style> 