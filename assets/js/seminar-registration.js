/**
 * JavaScript برای مدیریت ثبت نام سمینارها
 */

jQuery(document).ready(function($) {
    
    // نمایش جزئیات به‌صورت داینامیک به جای مودال مستقیم
    $(document).on('click', '.um-seminar-details-btn', function(e) {
        e.preventDefault();
        
        var seminarId = $(this).data('seminar-id');
        var seminarTitle = $(this).data('seminar-title');
        var $card = $(this).closest('.swiper-slide');

        if (!seminarId && !seminarTitle) {
            alert('اطلاعات سمینار نامعتبر است.');
            return;
        }
        
        // اگر فقط عنوان سمینار داریم، ابتدا سمینار را پیدا یا ایجاد کن
        if (!seminarId && seminarTitle) {
            findOrCreateSeminar(seminarTitle, $card);
        } else {
            // بارگذاری جزئیات و نمایش در کارت
            loadSeminarDetails(seminarId, $card);
        }
    });
    
    // پیدا کردن یا ایجاد سمینار بر اساس عنوان
    function findOrCreateSeminar(seminarTitle, $context) {
        $.ajax({
            url: um_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'um_find_or_create_seminar',
                seminar_title: seminarTitle,
                nonce: um_ajax.nonce
            },
            beforeSend: function() {
                $('.um-seminar-details-btn').prop('disabled', true).text('در حال پردازش...');
            },
            success: function(response) {
                if (response.success) {
                    loadSeminarDetails(response.data.seminar_id, $context);
                } else {
                    alert('خطا: ' + response.data);
                }
            },
            error: function() {
                alert('خطا در ارتباط با سرور');
            },
            complete: function() {
                $('.um-seminar-details-btn').prop('disabled', false).text('اطلاعات بیشتر و ثبت‌نام');
            }
        });
    }

    // بارگذاری و رندر جزئیات سمینار در همان کارت
    function loadSeminarDetails(seminarId, $context) {
        $.ajax({
            url: um_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'um_get_seminar_details',
                seminar_id: seminarId,
                nonce: um_ajax.nonce
            },
            beforeSend: function() {
                $context.find('.content-wrapper').after('<div class="um-loading">در حال بارگذاری جزئیات...</div>');
            },
            success: function(response) {
                $context.find('.um-loading').remove();
                if (response.success) {
                    // اگر قبلا جزئیات وجود دارد، جایگزین کن
                    $context.find('.um-seminar-details').remove();
                    $context.append(response.data);
                } else {
                    alert('خطا: ' + response.data);
                }
            },
            error: function() {
                $context.find('.um-loading').remove();
                alert('خطا در ارتباط با سرور');
            }
        });
    }
    
    // نمایش مودال ثبت نام (برای CTA نهایی)
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
    // کلیک روی CTA ثبت نام اکنون داخل جزئیات
    $(document).on('click', '.um-seminar-cta-register', function(e) {
        e.preventDefault();
        var seminarId = $(this).data('seminar-id');
        if (!seminarId) return;
        showRegistrationModal(seminarId);
    });
    
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
        
        // اضافه کردن nonce برای امنیت
        if (typeof um_ajax !== 'undefined' && um_ajax.nonce) {
            formData.append('nonce', um_ajax.nonce);
        }
        
        // بررسی وجود um_ajax
        if (typeof um_ajax === 'undefined') {
            $('#um-registration-message').html('<div class="um-error">خطا: متغیرهای JavaScript لود نشده‌اند. لطفاً صفحه را نوسازی کنید.</div>').show();
            return;
        }
        
        var ajaxUrl = um_ajax.ajax_url || (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
        
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.um-register-button').prop('disabled', true).text('در حال پردازش...');
            },
            success: function(response) {
                if (response && response.success) {
                    if (response.data && response.data.free) {
                        $('#um-registration-message').html('<div class="um-success">' + response.data.message + '</div>').show();
                        setTimeout(function() {
                            $('.um-registration-modal').remove();
                        }, 3000);
                    } else if (response.data && response.data.payment_url) {
                        // هدایت به درگاه پرداخت
                        window.location.href = response.data.payment_url;
                    } else {
                        $('#um-registration-message').html('<div class="um-error">پاسخ نامعتبر از سرور</div>').show();
                    }
                } else {
                    var errorMsg = (response && response.data) ? response.data : 'خطای نامشخص';
                    $('#um-registration-message').html('<div class="um-error">' + errorMsg + '</div>').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error);
                var errorMsg = 'خطا در ارتباط با سرور';
                if (xhr.responseJSON && xhr.responseJSON.data) {
                    errorMsg = xhr.responseJSON.data;
                } else if (xhr.status === 400) {
                    errorMsg = 'درخواست نامعتبر است. لطفاً تمام فیلدها را تکمیل کنید.';
                } else if (xhr.status === 403) {
                    errorMsg = 'خطای امنیتی. لطفاً صفحه را نوسازی کنید.';
                } else if (xhr.status === 500) {
                    errorMsg = 'خطای سرور. لطفاً بعداً تلاش کنید.';
                }
                $('#um-registration-message').html('<div class="um-error">' + errorMsg + '</div>').show();
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

// اطمینان از نمایش ستاره کنار لیبل‌های فایل آپلود (اجرای سریع در زمان بارگذاری اسکریپت)
jQuery(document).ready(function($) {
    try {
        var fileIds = ['last_certificate','national_card','id_card_first_page','personal_photo'];
        fileIds.forEach(function(id){
            var $label = $('label[for=\"' + id + '\"]');
            if ($label.length && $label.text().indexOf('*') === -1) {
                $label.append(' <span class=\"um-required\">*</span>');
            }
            var $input = $('#' + id);
            if ($input.length) {
                $input.prop('required', true);
            }
        });
    } catch (e) {
        // ignore
    }
});

// نظارت بر تغییرات DOM در ظرف فرم ثبت‌نام تا پس از بارگذاری AJAX نیز ستاره اضافه شود
(function(){
    function addFileStars() {
        try {
            var ids = ['last_certificate','national_card','id_card_first_page','personal_photo'];
            ids.forEach(function(id){
                var el = document.querySelector('label[for=\"' + id + '\"]');
                if (el && el.textContent.indexOf('*') === -1) {
                    var span = document.createElement('span');
                    span.className = 'um-required';
                    span.textContent = '*';
                    span.style.color = '#c0392b';
                    span.style.marginLeft = '6px';
                    el.appendChild(span);
                }
                var input = document.getElementById(id);
                if (input) input.required = true;
            });
        } catch (e) {}
    }

    var container = document.getElementById('um-registration-form-container');
    if (container) {
        var mo = new MutationObserver(function(mutations) {
            addFileStars();
        });
        mo.observe(container, { childList: true, subtree: true });
        // اجرا یکبار به صورت اولیه
        addFileStars();
    }
})();
