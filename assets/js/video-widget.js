/* اسکریپت ویجت ویدیو */

jQuery(document).ready(function($) {
    console.log('=== VIDEO WIDGET JS DEBUG START ===');
    
    // تابع تشخیص زبان فعلی
    function getCurrentLanguage() {
        // بررسی وجود متغیر زبان در صفحه
        if (typeof umCurrentLang !== 'undefined') {
            return umCurrentLang;
        }
        
        // بررسی از URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('lang')) {
            return urlParams.get('lang');
        }
        
        // بررسی از pathname
        const pathname = window.location.pathname;
        const langMatch = pathname.match(/^\/([a-z]{2})\//);
        if (langMatch) {
            return langMatch[1];
        }
        
        // پیش‌فرض فارسی
        return 'fa';
    }
    
    // Find all video widget instances on the page
    $('.videoApp-container').each(function() {
        const container = $(this);
        const videos_json = container.attr('data-videos');
        const categories_json = container.attr('data-categories');
        const currentLang = getCurrentLanguage();

        console.log('Video Widget Container Found:', container);
        console.log('Current Language:', currentLang);
        console.log('Videos JSON from data attribute:', videos_json);
        console.log('Categories JSON from data attribute:', categories_json);

        // If there's no data, try to load videos by language
        if (!videos_json || videos_json === '[]') {
            console.log('No videos JSON data found, trying to load by language');
            loadVideosByLanguage(container, currentLang);
            return;
        }

        let videos = [];
        try {
            videos = JSON.parse(videos_json);
            console.log('Successfully parsed videos JSON:', videos);
            console.log('Number of videos:', videos.length);
        } catch (e) {
            console.error('Error parsing videos JSON:', e);
            loadVideosByLanguage(container, currentLang);
            return;
        }

        // اگر ویدیویی وجود ندارد، بر اساس زبان بارگذاری کن
        if (!videos || videos.length === 0) {
            console.log('No videos available, loading by language');
            loadVideosByLanguage(container, currentLang);
            return;
        }

        initializeVideoWidget(container, videos, categories_json);
    });
    
    /**
     * بارگذاری ویدیوها بر اساس زبان
     */
    function loadVideosByLanguage(container, lang) {
        console.log('Loading videos for language:', lang);
        
        $.ajax({
            url: um_ajax_url,
            type: 'POST',
            data: {
                action: 'um_get_videos_by_language',
                lang: lang,
                limit: 10,
                nonce: um_video_nonce
            },
            success: function(response) {
                console.log('Videos loaded by language:', response);
                if (response.success && response.data.length > 0) {
                    initializeVideoWidget(container, response.data, '{}');
                } else {
                    container.html('<p style="padding: 10px; text-align: center;">ویدیویی برای زبان ' + lang + ' یافت نشد.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading videos by language:', error);
                container.html('<p style="padding: 10px; text-align: center;">خطا در بارگذاری ویدیوها.</p>');
            }
        });
    }
    
    /**
     * راه‌اندازی ویجت ویدیو
     */
    function initializeVideoWidget(container, videos, categories_json) {
        let all_categories = {};
        if (categories_json) {
            try {
                all_categories = JSON.parse(categories_json);
            } catch (e) {
                // Categories could not be parsed, proceed without them
            }
        }

        // Get elements within the current widget instance
        const categorySelect = container.find(".videoApp-category");
        const thumbnailsContainer = container.find(".videoApp-thumbnails");
        const player = container.find(".videoApp-current")[0];
        const playPauseBtn = container.find(".videoApp-playPauseBtn");
        const previewImg = container.find(".videoApp-preview");
        const videoHeader = container.find('.videoApp-header');
                
        // If no videos are available, display a message and hide the player
        if (!videos || videos.length === 0) {
            console.log('No videos available, showing empty message');
            container.find('.videoApp-wrapper').html('<p style="padding: 10px; text-align: center;">ویدیویی برای نمایش وجود ندارد.</p>');
            return;
        }
        
        console.log('Videos available, proceeding with rendering');

        const category_names = Object.values(all_categories);

        if (category_names.length <= 1) {
            videoHeader.hide();
        } else {
             category_names.forEach(cat_name => {
                const opt = document.createElement("option");
                opt.value = cat_name;
                opt.textContent = cat_name;
                categorySelect.append(opt);
            });
            videoHeader.show();
        }

        // Function to render thumbnails for a selected category
        function renderThumbnails(category) {
            thumbnailsContainer.html("");
            
            // If a category is selected, filter by it. Otherwise, use all videos.
            const filteredVideos = category ? videos.filter(v => v.category === category) : videos;

            if (filteredVideos.length > 0) {
                const first = filteredVideos[0];
                player.src = first.src;
                previewImg.attr('src', first.thumbnail);
                player.style.display = "none";
                previewImg.show();
                playPauseBtn.removeClass("hidden");
                            
                // Activate the first thumbnail in the list
                setTimeout(() => {
                    thumbnailsContainer.find('.videoApp-thumbItem').first().addClass('active');
                }, 0);

            } else {
                 previewImg.hide();
                 playPauseBtn.addClass("hidden");
                 thumbnailsContainer.html('<p style="padding: 10px; text-align: center;">ویدیویی در این دسته‌بندی وجود ندارد.</p>');
                 return;
            }

            filteredVideos.forEach((video) => {
                const wrapper = $('<div class="videoApp-thumbItem"></div>');
                const thumb = $('<img>').attr('src', video.thumbnail).attr('alt', video.title);
                const title = $('<div class="videoApp-thumbTitle"></div>').text(video.title);
                
                wrapper.append(thumb).append(title);

                wrapper.on('click', function() {
                    player.src = video.src;
                    previewImg.attr('src', video.thumbnail);
                    player.pause();
                    player.style.display = "none";
                    previewImg.show();
                    playPauseBtn.removeClass("hidden");
                    
                    container.find(".videoApp-thumbItem").removeClass("active");
                    $(this).addClass("active");
                });

                thumbnailsContainer.append(wrapper);
            });
        }

        // Event listener for category change
        categorySelect.on("change", function() {
            renderThumbnails(this.value);
            // After rendering, mark the first item as active
            thumbnailsContainer.find('.videoApp-thumbItem').first().addClass('active');
        });
                                    
        // Event listener for the play button
        playPauseBtn.on("click", () => {
            previewImg.hide();
            player.style.display = "block";
            player.play();
            playPauseBtn.addClass("hidden");
        });
        
        // Initial render on page load
        const initialCategory = videos.length > 0 ? videos[0].category : null;
        renderThumbnails(initialCategory);
        if (initialCategory) {
            categorySelect.val(initialCategory);
        }
    }
});
