/* اسکریپت ویجت ویدیو */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        // تعریف متغیرها
        var videoWrapper = $('.video-wrapper');
        var mainVideo = $('#mainVideo')[0];
        var mainVideoSource = $('#mainVideo source');
        var playBtn = $('.play-btn');
        var pauseBtn = $('.pause-btn');
        var thumbnails = $('.thumbnails img');
        var currentVideoIndex = 0;
        
        // کلیک روی دکمه پخش
        playBtn.on('click', function() {
            if (mainVideo) {
                mainVideo.play();
                videoWrapper.addClass('playing');
                playBtn.hide();
                pauseBtn.show();
            }
        });
        
        // کلیک روی دکمه توقف
        pauseBtn.on('click', function() {
            if (mainVideo) {
                mainVideo.pause();
                videoWrapper.removeClass('playing');
                pauseBtn.hide();
                playBtn.show();
            }
        });
        
        // پایان ویدیو
        if (mainVideo) {
            mainVideo.addEventListener('ended', function() {
                videoWrapper.removeClass('playing');
                pauseBtn.hide();
                playBtn.show();
            });
        }
        
        // کلیک روی تصاویر بندانگشتی
        thumbnails.on('click', function() {
            var videoSrc = $(this).data('video');
            var thumbnail = $(this).attr('src');
            
            if (mainVideo) {
                // توقف ویدیو فعلی
                mainVideo.pause();
                
                // تغییر ویدیو
                mainVideoSource.attr('src', videoSrc);
                mainVideo.setAttribute('poster', thumbnail);
                
                // بارگذاری مجدد ویدیو
                mainVideo.load();
                
                // نمایش دکمه پخش
                videoWrapper.removeClass('playing');
                pauseBtn.hide();
                playBtn.show();
            }
            
            // فعال کردن تصویر بندانگشتی
            thumbnails.removeClass('active');
            $(this).addClass('active');
        });
        
        // تغییر دسته‌بندی
        $('#categorySelect').on('change', function() {
            var categoryId = $(this).val();
            
            // ارسال درخواست AJAX
            $.ajax({
                url: um_video_vars.ajax_url,
                type: 'POST',
                data: {
                    action: 'um_get_videos_by_category',
                    category_id: categoryId,
                    nonce: um_video_vars.nonce
                },
                beforeSend: function() {
                    // نمایش لودینگ
                    videoWrapper.addClass('loading');
                },
                success: function(response) {
                    // حذف لودینگ
                    videoWrapper.removeClass('loading');
                    
                    if (response.success && response.data) {
                        // بروزرسانی ویدیو اصلی
                        if (response.data.length > 0) {
                            var firstVideo = response.data[0];
                            
                            mainVideoSource.attr('src', firstVideo.src);
                            mainVideo.setAttribute('poster', firstVideo.thumb);
                            mainVideo.load();
                            
                            // بروزرسانی تصاویر بندانگشتی
                            var thumbnailsContainer = $('.thumbnails');
                            thumbnailsContainer.empty();
                            
                            $.each(response.data, function(index, video) {
                                var imgClass = (index === 0) ? 'active' : '';
                                var img = $('<img>', {
                                    src: video.thumb,
                                    alt: video.title,
                                    'data-video': video.src,
                                    'class': imgClass
                                });
                                
                                thumbnailsContainer.append(img);
                            });
                            
                            // اتصال مجدد رویدادها
                            thumbnails = $('.thumbnails img');
                            thumbnails.on('click', function() {
                                var videoSrc = $(this).data('video');
                                var thumbnail = $(this).attr('src');
                                
                                if (mainVideo) {
                                    // توقف ویدیو فعلی
                                    mainVideo.pause();
                                    
                                    // تغییر ویدیو
                                    mainVideoSource.attr('src', videoSrc);
                                    mainVideo.setAttribute('poster', thumbnail);
                                    
                                    // بارگذاری مجدد ویدیو
                                    mainVideo.load();
                                    
                                    // نمایش دکمه پخش
                                    videoWrapper.removeClass('playing');
                                    pauseBtn.hide();
                                    playBtn.show();
                                }
                                
                                // فعال کردن تصویر بندانگشتی
                                thumbnails.removeClass('active');
                                $(this).addClass('active');
                            });
                        }
                    }
                }
            });
        });
    });
})(jQuery);
