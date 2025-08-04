/**
 * فایل JavaScript عمومی برای فرانت‌اند
 * مدیریت دانشگاه آب و برق خوزستان
 */

(function($) {
    'use strict';

    // متغیرهای عمومی
    var UM = {
        ajax_url: um_vars.ajax_url,
        nonce: um_vars.nonce,
        debug: false
    };

    /**
     * تابع اصلی برای راه‌اندازی
     */
    function init() {
        console.log('University Management Frontend JS Loaded');
        
        // راه‌اندازی توابع مختلف
        initAjaxHandlers();
        initMessageHandlers();
        initFormHandlers();
        initLoadingHandlers();
        
        // راه‌اندازی event listeners
        $(document).ready(function() {
            setupEventListeners();
        });
    }

    /**
     * راه‌اندازی event listeners
     */
    function setupEventListeners() {
        // کلیک روی دکمه‌های عمومی
        $(document).on('click', '.um-btn', function(e) {
            var $btn = $(this);
            var action = $btn.data('action');
            
            if (action) {
                e.preventDefault();
                handleButtonAction($btn, action);
            }
        });

        // فرم‌های عمومی
        $(document).on('submit', '.um-form', function(e) {
            e.preventDefault();
            handleFormSubmit($(this));
        });

        // لینک‌های عمومی
        $(document).on('click', '.um-link', function(e) {
            var $link = $(this);
            var href = $link.attr('href');
            
            if (href && href !== '#') {
                // اجازه رفتن به لینک
                return true;
            }
            
            e.preventDefault();
            var action = $link.data('action');
            if (action) {
                handleLinkAction($link, action);
            }
        });
    }

    /**
     * راه‌اندازی AJAX handlers
     */
    function initAjaxHandlers() {
        // تنظیم AJAX پیش‌فرض
        $.ajaxSetup({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', UM.nonce);
            }
        });
    }

    /**
     * راه‌اندازی message handlers
     */
    function initMessageHandlers() {
        // حذف خودکار پیام‌ها بعد از 5 ثانیه
        setTimeout(function() {
            $('.um-message').fadeOut(500, function() {
                $(this).remove();
            });
        }, 5000);
    }

    /**
     * راه‌اندازی form handlers
     */
    function initFormHandlers() {
        // اعتبارسنجی فرم‌ها
        $('.um-form').each(function() {
            var $form = $(this);
            var requiredFields = $form.find('[required]');
            
            requiredFields.on('blur', function() {
                validateField($(this));
            });
        });
    }

    /**
     * راه‌اندازی loading handlers
     */
    function initLoadingHandlers() {
        // نمایش loading برای AJAX requests
        $(document).ajaxStart(function() {
            showLoading();
        });

        $(document).ajaxStop(function() {
            hideLoading();
        });
    }

    /**
     * مدیریت عملیات دکمه‌ها
     */
    function handleButtonAction($btn, action) {
        var data = $btn.data();
        
        switch(action) {
            case 'delete':
                if (confirm('آیا مطمئن هستید که می‌خواهید این مورد را حذف کنید؟')) {
                    performDelete(data.id, data.type);
                }
                break;
                
            case 'refresh':
                location.reload();
                break;
                
            case 'export':
                performExport(data.type);
                break;
                
            default:
                console.log('عملیات ناشناخته:', action);
        }
    }

    /**
     * مدیریت عملیات لینک‌ها
     */
    function handleLinkAction($link, action) {
        var data = $link.data();
        
        switch(action) {
            case 'modal':
                showModal(data.modal);
                break;
                
            case 'tab':
                showTab(data.tab);
                break;
                
            default:
                console.log('عملیات لینک ناشناخته:', action);
        }
    }

    /**
     * مدیریت ارسال فرم
     */
    function handleFormSubmit($form) {
        var formData = new FormData($form[0]);
        var action = $form.data('action');
        
        if (!action) {
            console.error('عملیات فرم تعریف نشده است');
            return;
        }

        $.ajax({
            url: UM.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showMessage('success', response.data.message || 'عملیات با موفقیت انجام شد');
                    $form[0].reset();
                } else {
                    showMessage('error', response.data.message || 'خطا در انجام عملیات');
                }
            },
            error: function() {
                showMessage('error', 'خطا در ارتباط با سرور');
            }
        });
    }

    /**
     * نمایش پیام
     */
    function showMessage(type, message) {
        var messageHtml = '<div class="um-message um-message-' + type + '">' + message + '</div>';
        $('body').append(messageHtml);
        
        // حذف خودکار بعد از 5 ثانیه
        setTimeout(function() {
            $('.um-message').fadeOut(500, function() {
                $(this).remove();
            });
        }, 5000);
    }

    /**
     * نمایش loading
     */
    function showLoading() {
        if ($('.um-loading-overlay').length === 0) {
            var overlay = '<div class="um-loading-overlay"><div class="um-loading"></div></div>';
            $('body').append(overlay);
        }
        $('.um-loading-overlay').show();
    }

    /**
     * مخفی کردن loading
     */
    function hideLoading() {
        $('.um-loading-overlay').hide();
    }

    /**
     * اعتبارسنجی فیلد
     */
    function validateField($field) {
        var value = $field.val();
        var required = $field.prop('required');
        
        if (required && !value) {
            $field.addClass('um-error');
            return false;
        } else {
            $field.removeClass('um-error');
            return true;
        }
    }

    /**
     * انجام عملیات حذف
     */
    function performDelete(id, type) {
        $.ajax({
            url: UM.ajax_url,
            type: 'POST',
            data: {
                action: 'um_delete_' + type,
                id: id,
                nonce: UM.nonce
            },
            success: function(response) {
                if (response.success) {
                    showMessage('success', 'مورد با موفقیت حذف شد');
                    // حذف عنصر از DOM
                    $('[data-id="' + id + '"]').fadeOut(500, function() {
                        $(this).remove();
                    });
                } else {
                    showMessage('error', response.data.message || 'خطا در حذف');
                }
            },
            error: function() {
                showMessage('error', 'خطا در ارتباط با سرور');
            }
        });
    }

    /**
     * انجام عملیات export
     */
    function performExport(type) {
        window.open(UM.ajax_url + '?action=um_export_' + type + '&nonce=' + UM.nonce, '_blank');
    }

    /**
     * نمایش modal
     */
    function showModal(modalId) {
        $('#' + modalId).show();
    }

    /**
     * نمایش tab
     */
    function showTab(tabId) {
        $('.um-tab-content').hide();
        $('#' + tabId).show();
        
        $('.um-tab-link').removeClass('active');
        $('[data-tab="' + tabId + '"]').addClass('active');
    }

    /**
     * تابع utility برای debug
     */
    function debug(message, data) {
        if (UM.debug) {
            console.log('UM Debug:', message, data);
        }
    }

    // راه‌اندازی
    init();

    // در دسترس قرار دادن توابع عمومی
    window.UM = {
        showMessage: showMessage,
        showLoading: showLoading,
        hideLoading: hideLoading,
        debug: debug
    };

})(jQuery); 