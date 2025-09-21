/**
 * JavaScript برای مدیریت ثبت نام سمینارها
 */

jQuery(document).ready(function($) {
    
    // مدیریت کلیک روی دکمه ثبت نام
    $(document).on('click', '.um-seminar-register-btn', function(e) {
        e.preventDefault();
        
        var seminarId = $(this).data('seminar-id');
        var seminarTitle = $(this).data('seminar-title');
        
        if (!seminarId && !seminarTitle) {
            alert('اطلاعات سمینار نامعتبر است.');
            return;
        }
        
        // اگر فقط عنوان سمینار داریم، ابتدا سمینار را پیدا یا ایجاد کن
        if (!seminarId && seminarTitle) {
            findOrCreateSeminar(seminarTitle);
        } else {
            // نمایش مودال ثبت نام
            showRegistrationModal(seminarId);
        }
    });
    
    // پیدا کردن یا ایجاد سمینار بر اساس عنوان
    function findOrCreateSeminar(seminarTitle) {
        $.ajax({
            url: um_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'um_find_or_create_seminar',
                seminar_title: seminarTitle,
                nonce: um_ajax.nonce
            },
            beforeSend: function() {
                // نمایش لودینگ
                $('.um-seminar-register-btn').prop('disabled', true).text('در حال پردازش...');
            },
            success: function(response) {
                if (response.success) {
                    showRegistrationModal(response.data.seminar_id);
                } else {
                    alert('خطا: ' + response.data);
                }
            },
            error: function() {
                alert('خطا در ارتباط با سرور');
            },
            complete: function() {
                $('.um-seminar-register-btn').prop('disabled', false).text('ثبت نام رایگان');
            }
        });
    }
    
    // نمایش مودال ثبت نام
    function showRegistrationModal(seminarId) {
        // ایجاد مودال
        var modal = $('<div class="um-registration-modal">' +
            '<div class="um-modal-content">' +
                '<div class="um-modal-header">' +
                    '<h3>ثبت نام در سمینار</h3>' +
                    '<span class="um-modal-close">&times;</span>' +
                '</div>' +
                '<div class="um-modal-body">' +
                    '<div id="um-registration-form-container"></div>' +
                '</div>' +
            '</div>' +
        '</div>');
        
        // اضافه کردن مودال به صفحه
        $('body').append(modal);
        
        // بارگذاری فرم ثبت نام
        loadRegistrationForm(seminarId);
        
        // مدیریت بستن مودال
        $('.um-modal-close, .um-registration-modal').on('click', function(e) {
            if (e.target === this) {
                $('.um-registration-modal').remove();
            }
        });
        
        // جلوگیری از بسته شدن مودال با کلیک روی محتوا
        $('.um-modal-content').on('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // بارگذاری فرم ثبت نام
    function loadRegistrationForm(seminarId) {
        $.ajax({
            url: um_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'um_get_registration_form',
                seminar_id: seminarId,
                nonce: um_ajax.nonce
            },
            beforeSend: function() {
                $('#um-registration-form-container').html('<div class="um-loading">در حال بارگذاری...</div>');
            },
            success: function(response) {
                if (response.success) {
                    $('#um-registration-form-container').html(response.data);
                } else {
                    $('#um-registration-form-container').html('<div class="um-error">خطا در بارگذاری فرم: ' + response.data + '</div>');
                }
            },
            error: function() {
                $('#um-registration-form-container').html('<div class="um-error">خطا در ارتباط با سرور</div>');
            }
        });
    }
    
    // مدیریت ارسال فرم ثبت نام
    $(document).on('submit', '#um-seminar-registration-form', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('action', 'um_seminar_register');
        
        $.ajax({
            url: um_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.um-register-button').prop('disabled', true).text('در حال پردازش...');
            },
            success: function(response) {
                if (response.success) {
                    if (response.data.free) {
                        $('#um-registration-message').html('<div class="um-success">' + response.data.message + '</div>').show();
                        setTimeout(function() {
                            $('.um-registration-modal').remove();
                        }, 3000);
                    } else {
                        // هدایت به درگاه پرداخت
                        window.location.href = response.data.payment_url;
                    }
                } else {
                    $('#um-registration-message').html('<div class="um-error">' + response.data + '</div>').show();
                }
            },
            error: function() {
                $('#um-registration-message').html('<div class="um-error">خطا در ارتباط با سرور</div>').show();
            },
            complete: function() {
                $('.um-register-button').prop('disabled', false).text('ثبت نام و پرداخت');
            }
        });
    });
    
    // مدیریت پیام‌های موفقیت/خطا در URL
    var urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.get('payment_success') === '1') {
        var refId = urlParams.get('ref_id');
        alert('پرداخت با موفقیت انجام شد. شماره پیگیری: ' + refId);
    }
    
    if (urlParams.get('payment_error')) {
        var message = urlParams.get('message') || 'خطا در پردازش پرداخت';
        alert('خطا: ' + message);
    }
    
    if (urlParams.get('payment_cancelled') === '1') {
        alert('پرداخت لغو شد.');
    }
    
});

// استایل‌های CSS برای مودال
jQuery(document).ready(function($) {
    if (!$('#um-registration-styles').length) {
        $('head').append(`
            <style id="um-registration-styles">
                .um-registration-modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 9999;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .um-modal-content {
                    background: white;
                    border-radius: 8px;
                    max-width: 600px;
                    width: 90%;
                    max-height: 90vh;
                    overflow-y: auto;
                    position: relative;
                }
                
                .um-modal-header {
                    padding: 20px;
                    border-bottom: 1px solid #eee;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                
                .um-modal-header h3 {
                    margin: 0;
                }
                
                .um-modal-close {
                    font-size: 24px;
                    cursor: pointer;
                    color: #999;
                }
                
                .um-modal-close:hover {
                    color: #333;
                }
                
                .um-modal-body {
                    padding: 20px;
                }
                
                .um-loading {
                    text-align: center;
                    padding: 20px;
                    color: #666;
                }
                
                .um-error {
                    background: #f8d7da;
                    color: #721c24;
                    padding: 10px;
                    border-radius: 4px;
                    margin: 10px 0;
                }
                
                .um-success {
                    background: #d4edda;
                    color: #155724;
                    padding: 10px;
                    border-radius: 4px;
                    margin: 10px 0;
                }
            </style>
        `);
    }
});
