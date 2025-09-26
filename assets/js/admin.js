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
        
        console.log('University Management Admin JS loaded');
        
        // مدیریت زیر مجموعه پرسنل
        initSubMembersManagement();
    });

    // تابع مدیریت زیر مجموعه پرسنل
    function initSubMembersManagement() {
        var subMemberIndex = 0;
        
        // شمارش ردیف‌های موجود برای تعیین index بعدی
        function getNextIndex() {
            var maxIndex = -1;
            $('.um-sub-member-row').each(function() {
                var index = parseInt($(this).data('index'));
                if (index > maxIndex) {
                    maxIndex = index;
                }
            });
            return maxIndex + 1;
        }
        
        // افزودن ردیف جدید کارمند
        $(document).on('click', '#um-add-sub-member', function(e) {
            e.preventDefault();
            console.log('Add button clicked'); // Debug log
            subMemberIndex = getNextIndex();
            console.log('Next index:', subMemberIndex); // Debug log
            
            // بررسی وجود متغیرهای AJAX
            if (typeof um_admin_ajax === 'undefined') {
                console.error('um_admin_ajax is not defined');
                alert('خطا در تنظیمات AJAX');
                return;
            }
            
            // درخواست AJAX برای دریافت HTML ردیف جدید
            $.ajax({
                url: um_admin_ajax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'um_get_sub_member_row',
                    index: subMemberIndex,
                    nonce: um_admin_ajax.nonce
                },
                beforeSend: function() {
                    console.log('Sending AJAX request...');
                },
                success: function(response) {
                    console.log('AJAX response:', response); // Debug log
                    if (response.success) {
                        $('#um-sub-members-container').append(response.data);
                        updateRowNumbers();
                        console.log('Row added successfully');
                    } else {
                        console.error('AJAX error:', response.data);
                        alert('خطا در افزودن ردیف جدید: ' + response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                    console.error('Response:', xhr.responseText);
                    alert('خطا در ارتباط با سرور: ' + error);
                }
            });
        });
        
        // حذف ردیف کارمند
        $(document).on('click', '.um-remove-sub-member', function(e) {
            e.preventDefault();
            if (confirm('آیا از حذف این کارمند اطمینان دارید؟')) {
                $(this).closest('.um-sub-member-row').remove();
                updateRowNumbers();
            }
        });
        
        // آپلود تصویر زیر مجموعه
        $(document).on('click', '.um-upload-sub-member-image', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var frame = wp.media({
                title: 'انتخاب تصویر زیر مجموعه',
                button: {
                    text: 'انتخاب تصویر'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                var $row = $('.um-sub-member-row[data-index="' + index + '"]');
                
                // به‌روزرسانی hidden input
                $row.find('.um-sub-member-image-id').val(attachment.id);
                
                // نمایش تصویر
                var $preview = $row.find('.um-sub-member-image-preview');
                if ($preview.length === 0) {
                    $preview = $('<div class="um-sub-member-image-preview" style="margin-bottom: 10px;"></div>');
                    $row.find('.um-sub-member-image-container').prepend($preview);
                }
                $preview.html('<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 150px; height: auto; border-radius: 4px;">');
                
                // نمایش دکمه حذف تصویر
                $row.find('.um-remove-sub-member-image').show();
            });
            
            frame.open();
        });
        
        // حذف تصویر زیر مجموعه
        $(document).on('click', '.um-remove-sub-member-image', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var $row = $('.um-sub-member-row[data-index="' + index + '"]');
            
            // پاک کردن hidden input
            $row.find('.um-sub-member-image-id').val('');
            
            // حذف پیش‌نمایش تصویر
            $row.find('.um-sub-member-image-preview').remove();
            
            // مخفی کردن دکمه حذف تصویر
            $(this).hide();
        });
        
        // به‌روزرسانی شماره ردیف‌ها
        function updateRowNumbers() {
            $('.um-sub-member-row').each(function(index) {
                $(this).find('h4').text('کارمند ' + (index + 1));
            });
        }
    }

})(jQuery); 