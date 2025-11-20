/**
 * جاوا اسکریپت مدیریت عمومی افزونه مدیریت دانشگاه
 */

(function($) {
    'use strict';

    // آماده شدن DOM
    $(document).ready(function() {
        // اضافه کردن کلاس برای استایل‌دهی
        $('.wrap').addClass('university-management-admin');
        
        // بهبود نمایش پیام‌های مدیریت
        $('.notice').each(function() {
            var $notice = $(this);
            if ($notice.hasClass('notice-success')) {
                $notice.addClass('notice-success');
            } else if ($notice.hasClass('notice-warning')) {
                $notice.addClass('notice-warning');
            } else if ($notice.hasClass('notice-error')) {
                $notice.addClass('notice-error');
            }
        });
        
        // مدیریت اسپینرها
        $('.spinner').each(function() {
            var $spinner = $(this);
            if ($spinner.hasClass('is-active')) {
                $spinner.show();
            } else {
                $spinner.hide();
            }
        });
        
        // انتخاب همه و حذف دسته‌ای در صفحه گزارش‌ها
        // از کلیک استفاده می‌کنیم و پس از تنظیم وضعیت، رویداد change را برای هر چک‌باکس تریگر می‌کنیم
        $(document).on('click', '#um-select-all', function() {
            var checked = $(this).is(':checked');
            $('.um-select-reg').prop('checked', checked).trigger('change');
        });
        
        // همگام‌سازی حالت header checkbox با چک‌باکس‌های ردیف‌ها
        $(document).on('change', '.um-select-reg', function() {
            var total = $('.um-select-reg').length;
            var checked = $('.um-select-reg:checked').length;
            $('#um-select-all').prop('checked', total > 0 && total === checked);
        });

        $(document).on('click', '#um-bulk-delete-btn', function(e) {
            e.preventDefault();
            var ids = [];
            $('.um-select-reg:checked').each(function() {
                ids.push($(this).val());
            });
            if (ids.length === 0) {
                if (window.Swal) {
                    Swal.fire({ icon: 'warning', title: 'هیچ آیتمی انتخاب نشده', text: 'لطفاً حداقل یک ثبت‌نام برای حذف انتخاب کنید.' });
                } else {
                    alert('هیچ آیتمی انتخاب نشده. لطفاً حداقل یک ثبت‌نام انتخاب کنید.');
                }
                return;
            }

            var titleText = (ids.length === 1) ? 'آیا از حذف این ثبت‌نام مطمئن هستید؟' : 'آیا از حذف ' + ids.length + ' ثبت‌نام مطمئن هستید؟';
            var confirmButtonText = (ids.length === 1) ? 'حذف کن' : 'حذف ' + ids.length + ' مورد';

            var doAjax = function() {
                var data = {
                    action: 'um_bulk_delete_seminar_registrations',
                    ids: ids,
                    nonce: (typeof um_admin_vars !== 'undefined' ? um_admin_vars.bulk_nonce : '')
                };
                $.post( (typeof um_admin_vars !== 'undefined' ? um_admin_vars.ajax_url : ajaxurl), data, function(resp) {
                    if (resp && resp.success) {
                        if (window.Swal) {
                            Swal.fire({ icon: 'success', title: 'حذف با موفقیت انجام شد', text: resp.data.message }).then(function(){ location.reload(); });
                        } else {
                            alert(resp.data.message);
                            location.reload();
                        }
                    } else {
                        var msg = (resp && resp.data && resp.data.message) ? resp.data.message : 'خطا در عملیات';
                        if (window.Swal) {
                            Swal.fire({ icon: 'error', title: 'خطا', text: msg });
                        } else {
                            alert(msg);
                        }
                    }
                }, 'json').fail(function() {
                    if (window.Swal) {
                        Swal.fire({ icon: 'error', title: 'خطا', text: 'در ارتباط با سرور مشکلی رخ داد.' });
                    } else {
                        alert('در ارتباط با سرور مشکلی رخ داد.');
                    }
                });
            };

            if (window.Swal) {
                Swal.fire({
                    title: titleText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'لغو'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        doAjax();
                    }
                });
            } else {
                if (confirm(titleText)) {
                    doAjax();
                }
            }
        });
        
        console.log('University Management Admin JS loaded');
    });

})(jQuery); 