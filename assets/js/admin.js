/**
 * جاوا اسکریپت مدیریت عمومی افزونه مدیریت دانشگاه
 */

(function($) {
    'use strict';

    // آماده شدن DOM
    $(document).ready(function() {
        console.log('University Management Admin JS loaded');
        
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
        
        // مدیریت کارمندان زیر مجموعه
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
            console.log('Remove member button clicked'); // Debug log
            
            if (confirm('آیا از حذف این کارمند اطمینان دارید؟')) {
                var $row = $(this).closest('.um-sub-member-row');
                console.log('Removing row:', $row.length); // Debug log
                
                $row.remove();
                updateRowNumbers();
                
                console.log('Member removed successfully'); // Debug log
            }
        });
        
        // آپلود تصویر کارمند
        $(document).on('click', '.um-upload-sub-member-image', function(e) {
            e.preventDefault();
            console.log('Upload image button clicked'); // Debug log
            
            var index = $(this).data('index');
            console.log('Image index:', index); // Debug log
            
            // بررسی وجود wp.media
            if (typeof wp === 'undefined' || typeof wp.media === 'undefined') {
                console.error('wp.media is not available, using fallback');
                // استفاده از fallback - ایجاد input file
                createFileInput(index);
                return;
            }
            
            var frame = wp.media({
                title: 'انتخاب تصویر کارمند',
                button: {
                    text: 'انتخاب تصویر'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                console.log('Image selected'); // Debug log
                var attachment = frame.state().get('selection').first().toJSON();
                console.log('Selected attachment:', attachment); // Debug log
                
                updateImagePreview(index, attachment.id, attachment.url);
            });
            
            frame.open();
        });
        
        // تابع fallback برای آپلود فایل
        function createFileInput(index) {
            var $row = $('.um-sub-member-row[data-index="' + index + '"]');
            var $container = $row.find('.um-sub-member-image-container');
            
            // حذف input قبلی اگر وجود داشته باشد
            $container.find('input[type="file"]').remove();
            
            // ایجاد input file جدید
            var $fileInput = $('<input type="file" accept="image/*" style="margin-top: 10px;">');
            $fileInput.on('change', function(e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        updateImagePreview(index, 0, e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            $container.append($fileInput);
        }
        
        // تابع مشترک برای به‌روزرسانی پیش‌نمایش تصویر
        function updateImagePreview(index, imageId, imageUrl) {
            var $row = $('.um-sub-member-row[data-index="' + index + '"]');
            console.log('Target row found:', $row.length); // Debug log
            
            // به‌روزرسانی hidden input
            $row.find('.um-sub-member-image-id').val(imageId);
            
            // نمایش تصویر
            var $preview = $row.find('.um-sub-member-image-preview');
            if ($preview.length === 0) {
                $preview = $('<div class="um-sub-member-image-preview" style="margin-bottom: 10px;"></div>');
                $row.find('.um-sub-member-image-container').prepend($preview);
            }
            
            $preview.html('<img src="' + imageUrl + '" style="max-width: 150px; height: auto; border-radius: 4px;">');
            
            // نمایش دکمه حذف تصویر
            $row.find('.um-remove-sub-member-image').show();
            console.log('Image preview updated'); // Debug log
        }
        
        // حذف تصویر کارمند
        $(document).on('click', '.um-remove-sub-member-image', function(e) {
            e.preventDefault();
            console.log('Remove image button clicked'); // Debug log
            
            var index = $(this).data('index');
            console.log('Remove image index:', index); // Debug log
            
            var $row = $('.um-sub-member-row[data-index="' + index + '"]');
            console.log('Target row for removal:', $row.length); // Debug log
            
            // پاک کردن hidden input
            $row.find('.um-sub-member-image-id').val('');
            
            // حذف پیش‌نمایش تصویر
            $row.find('.um-sub-member-image-preview').remove();
            
            // مخفی کردن دکمه حذف تصویر
            $(this).hide();
            
            console.log('Image removed successfully'); // Debug log
        });
        
        // به‌روزرسانی شماره ردیف‌ها
        function updateRowNumbers() {
            $('.um-sub-member-row').each(function(index) {
                $(this).find('h4').text('کارمند ' + (index + 1));
            });
            console.log('Row numbers updated. Total rows:', $('.um-sub-member-row').length);
        }
        
        // تابع تست برای بررسی عملکرد
        function testSubMembersFunctionality() {
            console.log('=== Testing Sub-Members Functionality ===');
            console.log('jQuery version:', $.fn.jquery);
            console.log('wp.media available:', typeof wp !== 'undefined' && typeof wp.media !== 'undefined');
            console.log('um_admin_ajax available:', typeof um_admin_ajax !== 'undefined');
            console.log('Total sub-member rows:', $('.um-sub-member-row').length);
            console.log('Add button exists:', $('#um-add-sub-member').length);
            console.log('Container exists:', $('#um-sub-members-container').length);
        }
        
        // اجرای تست پس از لود شدن صفحه
        setTimeout(testSubMembersFunctionality, 1000);
        
        // تست کلیک روی دکمه‌ها
        $(document).on('click', 'button', function() {
            var $btn = $(this);
            if ($btn.hasClass('um-upload-sub-member-image') || 
                $btn.hasClass('um-remove-sub-member-image') || 
                $btn.hasClass('um-remove-sub-member') ||
                $btn.attr('id') === 'um-add-sub-member') {
                console.log('Button clicked:', $btn.attr('class'), $btn.attr('id'));
            }
        });
    }

})(jQuery); 