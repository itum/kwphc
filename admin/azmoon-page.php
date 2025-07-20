<?php
/**
 * صفحه مدیریت آزمون‌های استخدامی
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
$azmoon_limit = get_option('_um_azmoon_limit', 10);

$is_authenticated = ($auth_status === 'authenticated' && !empty($auth_username) && time() < $token_expires);
?>

<div class="wrap">
    <h1><?php _e('مدیریت آزمون‌های استخدامی', 'university-management'); ?></h1>
    
    <!-- هشدار هماهنگی با دیتابیس اصلی -->
    <div class="notice notice-info">
        <p><strong>⚠️ توجه:</strong> این بخش با دیتابیس اصلی kwphc.ir_main هماهنگ شده است. تمام تغییرات مستقیماً در دیتابیس اصلی اعمال می‌شود.</p>
    </div>
    
    <!-- منطقه نمایش پیام‌ها -->
    <div id="um-messages"></div>
    
    <div class="um-azmoon-settings">
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
        
        <!-- بخش تنظیمات API -->
        <div class="um-api-settings-section">
            <div class="card">
                <h2><?php _e('تنظیمات API آزمون‌ها', 'university-management'); ?></h2>
                
                <form id="um-azmoon-api-settings-form">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="um-azmoon-limit"><?php _e('حد آزمون‌ها', 'university-management'); ?></label>
                            </th>
                            <td>
                                <input type="number" id="um-azmoon-limit" name="limit" class="small-text" 
                                       value="<?php echo esc_attr($azmoon_limit); ?>" min="1" max="100" />
                                <p class="description">
                                    <?php _e('تعداد آزمون‌هایی که از API دریافت می‌شود (1 تا 100)', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label><?php _e('آدرس وب‌سرویس', 'university-management'); ?></label>
                            </th>
                            <td>
                                <code>https://kwphc.ir/webservice_new/webervice_Azmoon.php</code>
                                <p class="description">
                                    <?php _e('آدرس وب‌سرویس آزمون‌ها (ثابت)', 'university-management'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <button type="submit" class="button button-primary">
                            <?php _e('ذخیره تنظیمات', 'university-management'); ?>
                        </button>
                        <span id="um-azmoon-api-loading" class="spinner" style="display: none;"></span>
                    </p>
                </form>
            </div>
        </div>
        
        <!-- بخش مدیریت آزمون‌ها -->
        <div class="um-azmoon-section">
            <div class="card">
                <h2><?php _e('مدیریت آزمون‌های استخدامی', 'university-management'); ?></h2>
                
                <div id="um-azmoon-status">
                    <?php if (!$is_authenticated): ?>
                        <div class="notice notice-info">
                            <p><?php _e('برای مشاهده آزمون‌ها، ابتدا وارد شوید.', 'university-management'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="um-azmoon-controls">
                    <button type="button" id="um-load-azmoon-from-api-btn" class="button button-secondary"
                            <?php echo !$is_authenticated ? 'disabled' : ''; ?>>
                        <?php _e('بارگذاری آزمون‌ها از API', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-load-azmoon-btn" class="button button-secondary"
                            <?php echo !$is_authenticated ? 'disabled' : ''; ?>>
                        <?php _e('نمایش آزمون‌های موجود', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-add-azmoon-btn" class="button button-primary" 
                            <?php echo !$is_authenticated ? 'disabled' : ''; ?>>
                        <?php _e('افزودن آزمون جدید', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-refresh-azmoon-btn" class="button button-secondary" 
                            <?php echo !$is_authenticated ? 'disabled' : ''; ?>>
                        <?php _e('تازه‌سازی لیست', 'university-management'); ?>
                    </button>
                    <button type="button" id="um-shortcodes-help-btn" class="button button-info">
                        <?php _e('راهنمای شورت‌کدها', 'university-management'); ?>
                    </button>
                    <span id="um-azmoon-loading" class="spinner" style="display: none;"></span>
                </div>
                
                <div id="um-azmoon-list" class="um-azmoon-list" style="margin-top: 20px;">
                    <!-- آزمون‌ها اینجا نمایش داده می‌شوند -->
                </div>
            </div>
        </div>
        
        <!-- مودال افزودن/ویرایش آزمون -->
        <div id="um-azmoon-modal" class="um-modal" style="display: none;">
            <div class="um-modal-content">
                <div class="um-modal-header">
                    <h3 id="um-modal-title">افزودن آزمون جدید</h3>
                    <span class="um-modal-close">&times;</span>
                </div>
                <div class="um-modal-body">
                    <form id="um-azmoon-form">
                        <input type="hidden" id="um-azmoon-id" name="id" value="">
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-title"><?php _e('عنوان آزمون', 'university-management'); ?> *</label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-title" name="Title" class="regular-text" required />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-company"><?php _e('شرکت', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-company" name="Company" class="regular-text" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-city"><?php _e('شهر', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-city" name="City" class="regular-text" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-dssabtname"><?php _e('تاریخ شروع ثبت‌نام', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-dssabtname" name="DSSabtName" class="regular-text" 
                                           placeholder="1402/01/01" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-dpsabtname"><?php _e('تاریخ پایان ثبت‌نام', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-dpsabtname" name="DPSabtName" class="regular-text" 
                                           placeholder="1402/01/15" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-dazmoon"><?php _e('تاریخ آزمون', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-dazmoon" name="DAzmoon" class="regular-text" 
                                           placeholder="1402/02/01" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-poster"><?php _e('فایل پوستر', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-poster" name="Poster" class="regular-text" 
                                           placeholder="poster.jpg" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-agahi"><?php _e('فایل آگهی', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="um-azmoon-agahi" name="Agahi" class="regular-text" 
                                           placeholder="advertisement.pdf" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-tozihat"><?php _e('توضیحات', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <textarea id="um-azmoon-tozihat" name="Tozihat" class="large-text" rows="4"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-link"><?php _e('لینک', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <input type="url" id="um-azmoon-link" name="Link" class="regular-text" 
                                           placeholder="https://example.com" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="um-azmoon-active"><?php _e('فعال', 'university-management'); ?></label>
                                </th>
                                <td>
                                    <select id="um-azmoon-active" name="Active">
                                        <option value="1">فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        
                        <p class="submit">
                            <button type="submit" class="button button-primary">
                                <?php _e('ذخیره آزمون', 'university-management'); ?>
                            </button>
                            <button type="button" class="button button-secondary um-modal-cancel">
                                <?php _e('انصراف', 'university-management'); ?>
                            </button>
                            <span id="um-azmoon-form-loading" class="spinner" style="display: none;"></span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    console.log('University Management Azmoon Page loaded');
    
    // فرم احراز هویت
    $('#um-auth-form').on('submit', function(e) {
        e.preventDefault();
        
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
    
    // بارگذاری آزمون‌ها
    $('#um-load-azmoon-btn').on('click', function(e) {
        e.preventDefault();
        loadAzmoons();
    });
    
    // بارگذاری آزمون‌ها از API
    $('#um-load-azmoon-from-api-btn').on('click', function(e) {
        e.preventDefault();
        loadAndInsertAzmoonsFromAPI();
    });
    
    // تازه‌سازی لیست
    $('#um-refresh-azmoon-btn').on('click', function(e) {
        e.preventDefault();
        loadAzmoons();
    });
    
    // افزودن آزمون جدید
    $('#um-add-azmoon-btn').on('click', function(e) {
        e.preventDefault();
        openAzmoonModal();
    });
    
    // بستن مودال
    $('.um-modal-close, .um-modal-cancel').on('click', function(e) {
        e.preventDefault();
        closeAzmoonModal();
    });
    
    // کلیک خارج از مودال
    $(window).on('click', function(e) {
        if ($(e.target).hasClass('um-modal')) {
            closeAzmoonModal();
        }
    });
    
    // فرم آزمون
    $('#um-azmoon-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serializeArray();
        var azmoonData = {};
        
        $.each(formData, function(index, field) {
            if (field.value) {
                azmoonData[field.name] = field.value;
            }
        });
        
        var isEdit = $('#um-azmoon-id').val() !== '';
        var action = isEdit ? 'um_update_azmoon' : 'um_create_azmoon';
        
        var $button = $(this).find('button[type="submit"]');
        var $loading = $('#um-azmoon-form-loading');
        
        $button.prop('disabled', true);
        $loading.show();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: action,
                azmoon_data: azmoonData,
                nonce: '<?php echo wp_create_nonce('um_azmoon_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage(isEdit ? 'آزمون با موفقیت به‌روزرسانی شد' : 'آزمون با موفقیت ایجاد شد', 'success');
                    closeAzmoonModal();
                    loadAzmoons();
                } else {
                    showMessage('خطا: ' + response.data, 'error');
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
    
    // تابع بارگذاری آزمون‌ها
    function loadAzmoons() {
        var $button = $('#um-load-azmoon-btn');
        var $loading = $('#um-azmoon-loading');
        var $list = $('#um-azmoon-list');
        
        $button.prop('disabled', true);
        $loading.show();
        $list.html('<div class="loading">در حال بارگذاری آزمون‌ها...</div>');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_get_azmoons',
                nonce: '<?php echo wp_create_nonce('um_azmoons_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    displayAzmoons(response.data);
                    showMessage('آزمون‌ها با موفقیت بارگذاری شدند', 'success');
                } else {
                    showMessage('خطا در بارگذاری آزمون‌ها: ' + response.data, 'error');
                    $list.html('<div class="no-azmoons">خطا در بارگذاری آزمون‌ها</div>');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
                $list.html('<div class="no-azmoons">خطا در اتصال به سرور</div>');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    }

    // تابع بارگذاری و افزودن آزمون‌ها از API
    function loadAndInsertAzmoonsFromAPI() {
        var $button = $('#um-load-azmoon-from-api-btn');
        var $loading = $('#um-azmoon-loading');
        var $list = $('#um-azmoon-list');

        $button.prop('disabled', true);
        $loading.show();
        $list.html('<div class="loading">در حال بارگذاری و افزودن آزمون‌ها از API...</div>');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_load_and_insert_azmoons_from_api',
                nonce: '<?php echo wp_create_nonce('um_load_and_insert_azmoons_from_api_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.data.message, 'success');
                    if (response.data.new_azmoons) {
                        displayAzmoons(response.data.new_azmoons);
                    }
                } else {
                    showMessage('خطا: ' + response.data, 'error');
                    $list.html('<div class="no-azmoons">خطا در بارگذاری آزمون‌ها از API</div>');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
                $list.html('<div class="no-azmoons">خطا در اتصال به سرور</div>');
            },
            complete: function() {
                $button.prop('disabled', false);
                $loading.hide();
            }
        });
    }

    // تابع نمایش آزمون‌ها
    function displayAzmoons(azmoons) {
        var $list = $('#um-azmoon-list');
        $list.empty();
        
        if (!azmoons || azmoons.length === 0) {
            $list.html('<div class="no-azmoons">هیچ آزمونی یافت نشد</div>');
            return;
        }
        
        $.each(azmoons, function(index, azmoon) {
            var $item = $('<div class="um-azmoon-item">');
            
            // عنوان آزمون
            if (azmoon.Title) {
                $item.append('<div class="um-azmoon-title">' + 
                    escapeHtml(azmoon.Title) + 
                    '</div>');
            }
            
            // اطلاعات کلیدی
            var mainInfo = [];
            if (azmoon.Company) mainInfo.push('🏢 شرکت: ' + escapeHtml(azmoon.Company));
            if (azmoon.City) mainInfo.push('🏙️ شهر: ' + escapeHtml(azmoon.City));
            if (azmoon.DSSabtName) mainInfo.push('📅 شروع ثبت‌نام: ' + formatPersianDate(azmoon.DSSabtName));
            if (azmoon.DPSabtName) mainInfo.push('📅 پایان ثبت‌نام: ' + formatPersianDate(azmoon.DPSabtName));
            if (azmoon.DAzmoon) mainInfo.push('📅 تاریخ آزمون: ' + formatPersianDate(azmoon.DAzmoon));
            
            if (mainInfo.length > 0) {
                $item.append('<div class="um-azmoon-main-info">' + mainInfo.join('<br>') + '</div>');
            }
            
            // تصویر پوستر
            if (azmoon.Poster && azmoon.Poster !== '-' && azmoon.Poster !== '') {
                var imageUrl = 'https://kwphc.ir/webservice_new/images/' + azmoon.Poster;
                $item.append('<div class="um-azmoon-image">' +
                    '<img src="' + imageUrl + '" alt="پوستر ' + escapeHtml(azmoon.Title || 'آزمون') + '" ' +
                    'style="max-width: 200px; max-height: 150px; border-radius: 8px; margin: 10px 0;" ' +
                    'onerror="this.style.display=\'none\'">' +
                    '</div>');
            }
            
            // توضیحات
            if (azmoon.Tozihat && azmoon.Tozihat !== '-' && azmoon.Tozihat !== '') {
                $item.append('<div class="um-azmoon-description">' +
                    '<strong>📋 توضیحات:</strong><br>' +
                    '<div class="description-text">' + escapeHtml(azmoon.Tozihat) + '</div>' +
                    '</div>');
            }
            
            // لینک
            if (azmoon.Link && azmoon.Link !== '-' && azmoon.Link !== '') {
                $item.append('<div class="um-azmoon-link">' +
                    '🔗 <a href="' + escapeHtml(azmoon.Link) + '" target="_blank">مشاهده آگهی</a>' +
                    '</div>');
            }
            
            // وضعیت فعال
            var statusText = azmoon.Active == 1 ? '✅ فعال' : '❌ غیرفعال';
            var statusClass = azmoon.Active == 1 ? 'active' : 'inactive';
            $item.append('<div class="um-azmoon-status ' + statusClass + '">' + statusText + '</div>');
            
            // دکمه‌های عملیات
            var $actions = $('<div class="um-azmoon-actions">');
            $actions.append('<button type="button" class="button button-small um-edit-azmoon" data-id="' + azmoon.Id + '">ویرایش</button> ');
            $actions.append('<button type="button" class="button button-small um-delete-azmoon" data-id="' + azmoon.Id + '">حذف</button> ');
            $actions.append('<span class="azmoon-id">ID: ' + azmoon.Id + '</span>');
            
            $item.append($actions);
            $list.append($item);
        });
        
        // اضافه کردن event handlers برای دکمه‌ها
        $('.um-edit-azmoon').on('click', function() {
            var id = $(this).data('id');
            editAzmoon(id);
        });
        
        $('.um-delete-azmoon').on('click', function() {
            var id = $(this).data('id');
            deleteAzmoon(id);
        });
    }
    
    // تابع باز کردن مودال
    function openAzmoonModal(azmoonData = null) {
        $('#um-modal-title').text(azmoonData ? 'ویرایش آزمون' : 'افزودن آزمون جدید');
        $('#um-azmoon-form')[0].reset();
        $('#um-azmoon-id').val('');
        
        if (azmoonData) {
            $('#um-azmoon-id').val(azmoonData.Id);
            $('#um-azmoon-title').val(azmoonData.Title);
            $('#um-azmoon-company').val(azmoonData.Company);
            $('#um-azmoon-city').val(azmoonData.City);
            $('#um-azmoon-dssabtname').val(azmoonData.DSSabtName);
            $('#um-azmoon-dpsabtname').val(azmoonData.DPSabtName);
            $('#um-azmoon-dazmoon').val(azmoonData.DAzmoon);
            $('#um-azmoon-poster').val(azmoonData.Poster);
            $('#um-azmoon-agahi').val(azmoonData.Agahi);
            $('#um-azmoon-tozihat').val(azmoonData.Tozihat);
            $('#um-azmoon-link').val(azmoonData.Link);
            $('#um-azmoon-active').val(azmoonData.Active);
        }
        
        $('#um-azmoon-modal').show();
    }
    
    // تابع بستن مودال
    function closeAzmoonModal() {
        $('#um-azmoon-modal').hide();
    }
    
    // تابع ویرایش آزمون
    function editAzmoon(id) {
        // اینجا باید آزمون را از سرور دریافت کنیم
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_get_azmoon',
                id: id,
                nonce: '<?php echo wp_create_nonce('um_azmoon_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    openAzmoonModal(response.data);
                } else {
                    showMessage('خطا در دریافت اطلاعات آزمون: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            }
        });
    }
    
    // تابع حذف آزمون
    function deleteAzmoon(id) {
        if (!confirm('آیا مطمئن هستید که می‌خواهید این آزمون را حذف کنید؟')) {
            return;
        }
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'um_delete_azmoon',
                id: id,
                nonce: '<?php echo wp_create_nonce('um_azmoon_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage('آزمون با موفقیت حذف شد', 'success');
                    loadAzmoons();
                } else {
                    showMessage('خطا در حذف آزمون: ' + response.data, 'error');
                }
            },
            error: function(xhr, status, error) {
                showMessage('خطا در اتصال به سرور: ' + error, 'error');
            }
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
});
</script>

<style>
.um-azmoon-settings .card {
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

.um-azmoon-list {
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid #ddd;
    padding: 15px;
    background: #f9f9f9;
}

.um-azmoon-item {
    padding: 20px;
    margin-bottom: 15px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.um-azmoon-title {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
    color: #2c3e50;
    border-bottom: 2px solid #e74c3c;
    padding-bottom: 8px;
}

.um-azmoon-main-info {
    background: #fdf2f2;
    padding: 12px;
    border-radius: 6px;
    margin: 10px 0;
    border-left: 4px solid #e74c3c;
    line-height: 1.6;
}

.um-azmoon-image {
    text-align: center;
    margin: 15px 0;
}

.um-azmoon-image img {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
}

.um-azmoon-description {
    margin: 15px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 4px solid #6c757d;
}

.um-azmoon-description .description-text {
    margin-top: 8px;
    line-height: 1.8;
    white-space: pre-line;
    color: #495057;
}

.um-azmoon-link {
    background: #cce7ff;
    color: #004085;
    padding: 10px;
    border-radius: 6px;
    margin: 10px 0;
    border-left: 4px solid #007bff;
    font-weight: bold;
}

.um-azmoon-status {
    padding: 8px 12px;
    border-radius: 4px;
    margin: 10px 0;
    font-weight: bold;
    text-align: center;
}

.um-azmoon-status.active {
    background: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.um-azmoon-status.inactive {
    background: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.um-azmoon-actions {
    margin-top: 15px;
    padding-top: 10px;
    border-top: 1px solid #e9ecef;
}

.azmoon-id {
    color: #999;
    font-size: 11px;
    margin-left: 10px;
}

#um-messages {
    margin-bottom: 20px;
}

.no-azmoons {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 40px;
    background: #f8f9fa;
    border-radius: 8px;
}

/* مودال */
.um-modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.um-modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    max-width: 800px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

.um-modal-header {
    padding: 20px;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.um-modal-header h3 {
    margin: 0;
    color: #2c3e50;
}

.um-modal-close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.um-modal-close:hover {
    color: #000;
}

.um-modal-body {
    padding: 20px;
}

/* اضافه کردن انیمیشن برای بارگذاری */
.um-azmoon-item {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* بهبود نمایش در موبایل */
@media (max-width: 768px) {
    .um-azmoon-item {
        padding: 15px;
        margin-bottom: 10px;
    }
    
    .um-azmoon-title {
        font-size: 16px;
    }
    
    .um-azmoon-image img {
        max-width: 100% !important;
        height: auto !important;
    }
    
    .um-modal-content {
        width: 95%;
        margin: 10% auto;
    }
}
</style>

        <!-- بخش مستندات و راهنما -->
        <div class="um-documentation-section">
            <div class="card">
                <h2><?php _e('مستندات و راهنما', 'university-management'); ?></h2>
                
                <div class="um-documentation-content">
                    <h3><?php _e('ویجت‌های المنتور', 'university-management'); ?></h3>
                    <p><?php _e('برای استفاده از ویجت آزمون استخدامی در المنتور:', 'university-management'); ?></p>
                    <ol>
                        <li><?php _e('در المنتور، ویجت "آزمون استخدامی" را از دسته‌بندی "مدیریت دانشگاه" انتخاب کنید', 'university-management'); ?></li>
                        <li><?php _e('تنظیمات مورد نظر را اعمال کنید', 'university-management'); ?></li>
                        <li><?php _e('ویجت آماده استفاده است', 'university-management'); ?></li>
                    </ol>
                    
                    <h3><?php _e('شورت‌کدهای داینامیک', 'university-management'); ?></h3>
                    <p><?php _e('شورت‌کدهای موجود برای نمایش اطلاعات آزمون‌ها:', 'university-management'); ?></p>
                    
                    <div class="um-shortcodes-list">
                        <div class="um-shortcode-item">
                            <strong><?php _e('عنوان آزمون:', 'university-management'); ?></strong>
                            <code>[um_azmoon_title id="1" default="آزمون استخدامی"]</code>
                            <p class="description"><?php _e('نمایش عنوان آزمون با شناسه مشخص شده', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('تاریخ آزمون:', 'university-management'); ?></strong>
                            <code>[um_azmoon_date id="1" default="۱۴۰۳/۰۱/۰۱"]</code>
                            <p class="description"><?php _e('نمایش تاریخ برگزاری آزمون', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('دپارتمان:', 'university-management'); ?></strong>
                            <code>[um_azmoon_department id="1" default="عمومی"]</code>
                            <p class="description"><?php _e('نمایش دپارتمان مربوط به آزمون', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('وضعیت:', 'university-management'); ?></strong>
                            <code>[um_azmoon_status id="1" default="فعال"]</code>
                            <p class="description"><?php _e('نمایش وضعیت آزمون (فعال، غیرفعال، تکمیل شده)', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('لینک:', 'university-management'); ?></strong>
                            <code>[um_azmoon_link id="1" default="#"]</code>
                            <p class="description"><?php _e('نمایش لینک آزمون', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('تصویر:', 'university-management'); ?></strong>
                            <code>[um_azmoon_image id="1"]</code>
                            <p class="description"><?php _e('نمایش تصویر آزمون', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('توضیحات:', 'university-management'); ?></strong>
                            <code>[um_azmoon_description id="1" default="توضیحات آزمون"]</code>
                            <p class="description"><?php _e('نمایش توضیحات کامل آزمون', 'university-management'); ?></p>
                        </div>
                        
                        <div class="um-shortcode-item">
                            <strong><?php _e('لیست آزمون‌ها:', 'university-management'); ?></strong>
                            <code>[um_azmoon_list limit="6" status="active" template="grid"]</code>
                            <p class="description"><?php _e('نمایش لیست آزمون‌ها با قابلیت فیلتر و قالب‌بندی', 'university-management'); ?></p>
                        </div>
                    </div>
                    
                    <h4><?php _e('پارامترهای شورت‌کدها:', 'university-management'); ?></h4>
                    <div class="um-parameters-list">
                        <div class="um-parameter-item">
                            <strong>id:</strong> <?php _e('شناسه آزمون (اختیاری)', 'university-management'); ?>
                        </div>
                        <div class="um-parameter-item">
                            <strong>default:</strong> <?php _e('متن پیش‌فرض در صورت عدم یافتن آزمون', 'university-management'); ?>
                        </div>
                        <div class="um-parameter-item">
                            <strong>limit:</strong> <?php _e('تعداد آزمون‌ها برای نمایش (پیش‌فرض: 6)', 'university-management'); ?>
                        </div>
                        <div class="um-parameter-item">
                            <strong>status:</strong> <?php _e('فیلتر بر اساس وضعیت (active, inactive, completed)', 'university-management'); ?>
                        </div>
                        <div class="um-parameter-item">
                            <strong>department:</strong> <?php _e('فیلتر بر اساس دپارتمان', 'university-management'); ?>
                        </div>
                        <div class="um-parameter-item">
                            <strong>template:</strong> <?php _e('قالب نمایش (grid یا list)', 'university-management'); ?>
                        </div>
                    </div>
                    
                    <h3><?php _e('نمونه‌های استفاده', 'university-management'); ?></h3>
                    
                    <div class="um-examples">
                        <h4><?php _e('نمایش اطلاعات یک آزمون:', 'university-management'); ?></h4>
                        <pre><code>&lt;div class="azmoon-details"&gt;
    &lt;h2&gt;[um_azmoon_title id="1"]&lt;/h2&gt;
    &lt;p&gt;تاریخ: [um_azmoon_date id="1"]&lt;/p&gt;
    &lt;p&gt;دپارتمان: [um_azmoon_department id="1"]&lt;/p&gt;
    &lt;p&gt;وضعیت: [um_azmoon_status id="1"]&lt;/p&gt;
    &lt;a href="[um_azmoon_link id="1"]"&gt;مشاهده جزئیات&lt;/a&gt;
&lt;/div&gt;</code></pre>
                        
                        <h4><?php _e('نمایش لیست آزمون‌ها:', 'university-management'); ?></h4>
                        <pre><code>&lt;!-- آزمون‌های فعال --&gt;
[um_azmoon_list limit="6" status="active" template="grid"]

&lt;!-- آزمون‌های یک دپارتمان خاص --&gt;
[um_azmoon_list limit="5" department="فنی و مهندسی" template="list"]

&lt;!-- آزمون‌های تکمیل شده --&gt;
[um_azmoon_list limit="4" status="completed" template="grid"]</code></pre>
                        
                        <h4><?php _e('استفاده در ویجت‌های وردپرس:', 'university-management'); ?></h4>
                        <pre><code>// در فایل functions.php
function azmoon_widget_content($content) {
    $content = do_shortcode($content);
    return $content;
}
add_filter('widget_text', 'azmoon_widget_content');</code></pre>
                        
                        <h4><?php _e('استفاده در قالب‌های وردپرس:', 'university-management'); ?></h4>
                        <pre><code>// در فایل functions.php یا قالب
function display_featured_azmoon() {
    echo '&lt;div class="featured-azmoon"&gt;';
    echo '&lt;h2&gt;' . do_shortcode('[um_azmoon_title id="1"]') . '&lt;/h2&gt;';
    echo '&lt;p&gt;تاریخ: ' . do_shortcode('[um_azmoon_date id="1"]') . '&lt;/p&gt;';
    echo '&lt;a href="' . do_shortcode('[um_azmoon_link id="1"]') . '"&gt;مشاهده جزئیات&lt;/a&gt;';
    echo '&lt;/div&gt;';
}</code></pre>
                    </div>
                    
                    <h3><?php _e('نکات مهم استفاده', 'university-management'); ?></h3>
                    <div class="um-important-notes">
                        <div class="um-note-item">
                            <strong>🔐 احراز هویت:</strong> <?php _e('تمام شورت‌کدها نیاز به احراز هویت با API دارند', 'university-management'); ?>
                        </div>
                        <div class="um-note-item">
                            <strong>📝 متن پیش‌فرض:</strong> <?php _e('در صورت عدم دسترسی به API، متن پیش‌فرض نمایش داده می‌شود', 'university-management'); ?>
                        </div>
                        <div class="um-note-item">
                            <strong>🛡️ امنیت:</strong> <?php _e('تمام خروجی‌ها با esc_html و esc_url پاکسازی می‌شوند', 'university-management'); ?>
                        </div>
                        <div class="um-note-item">
                            <strong>⚡ عملکرد:</strong> <?php _e('داده‌ها کش می‌شوند تا عملکرد بهتری داشته باشند', 'university-management'); ?>
                        </div>
                        <div class="um-note-item">
                            <strong>📱 سازگاری:</strong> <?php _e('پشتیبانی از RTL و سازگار با تم‌های مختلف', 'university-management'); ?>
                        </div>
                    </div>
                    
                    <h3><?php _e('نکات مهم', 'university-management'); ?></h3>
                    <ul>
                        <li><?php _e('تمام شورت‌کدها نیاز به احراز هویت با API دارند', 'university-management'); ?></li>
                        <li><?php _e('در صورت عدم دسترسی به API، متن پیش‌فرض نمایش داده می‌شود', 'university-management'); ?></li>
                        <li><?php _e('تمام خروجی‌ها با esc_html و esc_url پاکسازی می‌شوند', 'university-management'); ?></li>
                        <li><?php _e('برای استفاده در ویجت‌های وردپرس، فیلتر do_shortcode را اضافه کنید', 'university-management'); ?></li>
                    </ul>
                    
                    <div class="um-documentation-links">
                        <p><strong><?php _e('مستندات کامل:', 'university-management'); ?></strong></p>
                        <ul>
                            <li><a href="<?php echo UM_PLUGIN_URL; ?>README_AZMOON_SHORTCODES.md" target="_blank"><?php _e('شورت‌کدهای داینامیک', 'university-management'); ?></a></li>
                            <li><a href="<?php echo UM_PLUGIN_URL; ?>README_AZMOON_COMPLETE.md" target="_blank"><?php _e('مستندات کامل آزمون‌ها', 'university-management'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* استایل‌های مستندات */
.um-documentation-content {
    line-height: 1.6;
}

.um-documentation-content h3 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 8px;
    margin-top: 25px;
    margin-bottom: 15px;
}

.um-documentation-content h4 {
    color: #34495e;
    margin-top: 20px;
    margin-bottom: 10px;
}

.um-shortcodes-list {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 15px 0;
}

.um-shortcode-item {
    margin-bottom: 12px;
    padding: 8px;
    background: white;
    border-radius: 4px;
    border-left: 3px solid #3498db;
}

.um-shortcode-item strong {
    color: #2c3e50;
    display: block;
    margin-bottom: 5px;
}

.um-shortcode-item code {
    background: #e9ecef;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    color: #495057;
}

.um-shortcode-item .description {
    margin-top: 5px;
    font-size: 0.9rem;
    color: #6c757d;
    font-style: italic;
}

.um-parameters-list {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    margin: 15px 0;
    border-left: 3px solid #17a2b8;
}

.um-parameter-item {
    margin-bottom: 8px;
    padding: 5px;
    background: white;
    border-radius: 3px;
    border-left: 2px solid #17a2b8;
}

.um-parameter-item strong {
    color: #17a2b8;
    font-weight: 600;
}

.um-important-notes {
    background: #fff3cd;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    border-left: 4px solid #ffc107;
}

.um-note-item {
    margin-bottom: 12px;
    padding: 8px;
    background: white;
    border-radius: 4px;
    border-left: 3px solid #ffc107;
}

.um-note-item strong {
    color: #856404;
    font-weight: 600;
}

.um-examples {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 15px 0;
}

.um-examples pre {
    background: #2c3e50;
    color: #ecf0f1;
    padding: 15px;
    border-radius: 6px;
    overflow-x: auto;
    margin: 10px 0;
}

.um-examples code {
    font-family: 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.4;
}

.um-documentation-links {
    background: #e8f4fd;
    padding: 15px;
    border-radius: 6px;
    margin-top: 20px;
    border-left: 4px solid #3498db;
}

.um-documentation-links ul {
    margin: 10px 0;
    padding-left: 20px;
}

.um-documentation-links a {
    color: #2980b9;
    text-decoration: none;
}

.um-documentation-links a:hover {
    text-decoration: underline;
}
</style>

<!-- اضافه کردن فایل CSS اختصاصی -->
<link rel="stylesheet" href="<?php echo UM_PLUGIN_URL; ?>assets/css/azmoon-page.css"> 