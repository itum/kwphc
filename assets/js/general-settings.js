/**
 * جاوا اسکریپت صفحه تنظیمات عمومی
 */

(function($) {
    'use strict';

    // متغیرهای سراسری
    var GeneralSettings = {
        init: function() {
            this.bindEvents();
            this.checkAuthStatus();
        },

        bindEvents: function() {
            // احراز هویت
            $('#um-auth-form').on('submit', this.handleLogin.bind(this));
            $('#um-logout-btn').on('click', this.handleLogout.bind(this));
            
            // تنظیمات API
            $('#um-api-settings-form').on('submit', this.handleApiSettings.bind(this));
            
            // تنظیمات درگاه پرداخت
            $('#um-payment-settings-form').on('submit', this.handlePaymentSettings.bind(this));
            
            // مدیریت سمینارها
            $('#um-load-seminars-btn').on('click', this.loadSeminars.bind(this));
            
            // تست API
            $('#um-test-api-btn').on('click', this.testApi.bind(this));
            
            // بررسی وضعیت احراز هویت هر 5 دقیقه
            setInterval(this.checkAuthStatus.bind(this), 300000);
        },

        handleLogin: function(e) {
            e.preventDefault();
            
            var $form = $(e.target);
            var $button = $('#um-login-btn');
            var $loading = $('#um-auth-loading');
            var username = $('#um-username').val();
            var password = $('#um-password').val();
            
            // اعتبارسنجی
            if (!username || !password) {
                this.showMessage('نام کاربری و رمز عبور الزامی هستند', 'error');
                return;
            }
            
            this.setLoading($button, $loading, true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_authenticate_user',
                    username: username,
                    password: password,
                    nonce: umGeneralSettings.authNonce
                },
                success: function(response) {
                    if (response.success) {
                        this.showMessage('ورود موفقیت‌آمیز بود. صفحه بازخوانی می‌شود...', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        this.showMessage('خطا: ' + response.data, 'error');
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    this.showMessage('خطا در اتصال به سرور: ' + error, 'error');
                }.bind(this),
                complete: function() {
                    this.setLoading($button, $loading, false);
                }.bind(this)
            });
        },

        handleLogout: function(e) {
            e.preventDefault();
            
            if (!confirm('آیا مطمئن هستید که می‌خواهید خارج شوید؟')) {
                return;
            }
            
            var $button = $(e.target);
            var $loading = $('#um-auth-loading');
            
            this.setLoading($button, $loading, true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_logout_user',
                    nonce: umGeneralSettings.logoutNonce
                },
                success: function(response) {
                    this.showMessage('با موفقیت خارج شدید. صفحه بازخوانی می‌شود...', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }.bind(this),
                error: function(xhr, status, error) {
                    this.showMessage('خطا در اتصال به سرور: ' + error, 'error');
                }.bind(this),
                complete: function() {
                    this.setLoading($button, $loading, false);
                }.bind(this)
            });
        },

        handleApiSettings: function(e) {
            e.preventDefault();
            
            var $form = $(e.target);
            var $button = $form.find('button[type="submit"]');
            var $loading = $('#um-api-loading');
            var limit = $('#um-seminars-limit').val();
            
            // اعتبارسنجی
            if (!limit || limit < 1 || limit > 100) {
                this.showMessage('حد سمینارها باید بین 1 تا 100 باشد', 'error');
                return;
            }
            
            this.setLoading($button, $loading, true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_save_api_settings',
                    limit: limit,
                    nonce: umGeneralSettings.apiSettingsNonce
                },
                success: function(response) {
                    if (response.success) {
                        this.showMessage('تنظیمات با موفقیت ذخیره شد', 'success');
                    } else {
                        this.showMessage('خطا: ' + response.data, 'error');
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    this.showMessage('خطا در اتصال به سرور: ' + error, 'error');
                }.bind(this),
                complete: function() {
                    this.setLoading($button, $loading, false);
                }.bind(this)
            });
        },

        handlePaymentSettings: function(e) {
            e.preventDefault();
            
            var $form = $(e.target);
            var $button = $form.find('button[type="submit"]');
            var $loading = $('#um-payment-loading');
            var merchantId = $('#um-zarinpal-merchant-id').val();
            var sandbox = $('#um-zarinpal-sandbox').is(':checked') ? '1' : '0';
            
            // اعتبارسنجی
            if (!merchantId.trim()) {
                this.showMessage('کلید درگاه الزامی است', 'error');
                return;
            }
            
            this.setLoading($button, $loading, true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_save_payment_settings',
                    merchant_id: merchantId,
                    sandbox: sandbox,
                    nonce: umGeneralSettings.paymentSettingsNonce
                },
                success: function(response) {
                    if (response.success) {
                        this.showMessage('تنظیمات درگاه پرداخت با موفقیت ذخیره شد', 'success');
                    } else {
                        this.showMessage('خطا: ' + response.data, 'error');
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    this.showMessage('خطا در اتصال به سرور: ' + error, 'error');
                }.bind(this),
                complete: function() {
                    this.setLoading($button, $loading, false);
                }.bind(this)
            });
        },

        loadSeminars: function(e) {
            e.preventDefault();
            
            var $button = $(e.target);
            var $loading = $('#um-seminars-loading');
            var $list = $('#um-seminars-list');
            
            this.setLoading($button, $loading, true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_get_seminars',
                    nonce: umGeneralSettings.seminarsNonce
                },
                success: function(response) {
                    if (response.success) {
                        this.displaySeminars(response.data);
                        this.showMessage('سمینارها با موفقیت بارگذاری شدند', 'success');
                    } else {
                        this.showMessage('خطا: ' + response.data, 'error');
                        $list.html('<div class="no-seminars">خطا در بارگذاری سمینارها</div>');
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    this.showMessage('خطا در اتصال به سرور: ' + error, 'error');
                    $list.html('<div class="no-seminars">خطا در اتصال به سرور</div>');
                }.bind(this),
                complete: function() {
                    this.setLoading($button, $loading, false);
                }.bind(this)
            });
        },

        displaySeminars: function(seminars) {
            var $list = $('#um-seminars-list');
            $list.empty();
            
            if (!seminars || seminars.length === 0) {
                $list.html('<div class="no-seminars">هیچ سمیناری یافت نشد</div>');
                return;
            }
            
            $.each(seminars, function(index, seminar) {
                var $item = $('<div class="um-seminar-item">');
                
                // عنوان
                $item.append('<div class="um-seminar-title">' + 
                    this.escapeHtml(seminar.title || 'بدون عنوان') + 
                    '</div>');
                
                // متا اطلاعات
                var meta = [];
                if (seminar.teacher) meta.push('مدرس: ' + this.escapeHtml(seminar.teacher));
                if (seminar.date) meta.push('تاریخ: ' + this.escapeHtml(seminar.date));
                if (seminar.time) meta.push('زمان: ' + this.escapeHtml(seminar.time));
                if (seminar.duration) meta.push('مدت: ' + this.escapeHtml(seminar.duration));
                
                if (meta.length > 0) {
                    $item.append('<div class="um-seminar-meta">' + meta.join(' | ') + '</div>');
                }
                
                // توضیحات
                if (seminar.description) {
                    $item.append('<div class="um-seminar-description">' + 
                        this.escapeHtml(seminar.description) + 
                        '</div>');
                }
                
                $list.append($item);
            }.bind(this));
        },

        checkAuthStatus: function() {
            // بررسی اینکه آیا کاربر هنوز وارد است یا نه
            var tokenExpires = umGeneralSettings.tokenExpires;
            var currentTime = Math.floor(Date.now() / 1000);
            
            if (tokenExpires && currentTime > tokenExpires) {
                this.showMessage('جلسه شما منقضی شده است. لطفاً مجدداً وارد شوید.', 'warning');
                // غیرفعال کردن دکمه‌های مربوط به API
                $('#um-load-seminars-btn').prop('disabled', true);
            }
        },

        setLoading: function($button, $loading, isLoading) {
            if (isLoading) {
                $button.prop('disabled', true);
                $loading.addClass('is-active');
            } else {
                $button.prop('disabled', false);
                $loading.removeClass('is-active');
            }
        },

        showMessage: function(message, type) {
            // حذف پیام‌های قبلی
            $('.um-message').remove();
            
            var $message = $('<div class="um-message ' + type + '">' + message + '</div>');
            $('.um-general-settings').prepend($message);
            
            // حذف خودکار پیام بعد از 5 ثانیه
            setTimeout(function() {
                $message.fadeOut(function() {
                    $(this).remove();
                });
            }, 5000);
        },

        testApi: function(e) {
            e.preventDefault();
            
            var $button = $(e.target);
            var $loading = $('#um-api-loading');
            
            this.setLoading($button, $loading, true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_test_api',
                    nonce: umGeneralSettings.apiSettingsNonce
                },
                success: function(response) {
                    if (response.success) {
                        console.log('API Test Response:', response.data);
                        
                        var result = response.data;
                        var message = 'تست API:\n';
                        message += 'کد HTTP: ' + result.http_code + '\n';
                        message += 'پاسخ: ' + result.response + '\n';
                        
                        if (result.parsed) {
                            message += 'وضعیت: ' + (result.parsed.status || 'نامشخص') + '\n';
                            if (result.parsed.message) {
                                message += 'پیام: ' + result.parsed.message + '\n';
                            }
                            if (result.parsed.access_token) {
                                message += 'توکن: ' + result.parsed.access_token.substring(0, 20) + '...\n';
                            }
                        }
                        
                        alert(message);
                    } else {
                        alert('خطا در تست API: ' + response.data);
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    alert('خطا در اتصال: ' + error);
                }.bind(this),
                complete: function() {
                    this.setLoading($button, $loading, false);
                }.bind(this)
            });
        },

        escapeHtml: function(text) {
            if (!text) return '';
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    };

    // راه‌اندازی هنگام آماده شدن DOM
    $(document).ready(function() {
        GeneralSettings.init();
    });

    // در دسترس قرار دادن برای استفاده خارجی
    window.UMGeneralSettings = GeneralSettings;

})(jQuery); 