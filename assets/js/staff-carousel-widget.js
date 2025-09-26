(function($){
    "use strict";

    var handler = function($scope){
        var $root = $scope.find('.um-staff-carousel-widget');
        if(!$root.length) return;

        var settings = $root.data('settings') || {};
        var autoplay = settings.autoplay === 'yes';
        var autoplayDelay = parseInt(settings.autoplay_delay) || 3000;

        var swiper = new Swiper($root.find('.swiper')[0], {
            slidesPerView: 1,
            spaceBetween: 16,
            navigation: {
                nextEl: $root.find('.swiper-button-next')[0],
                prevEl: $root.find('.swiper-button-prev')[0]
            },
            pagination: {
                el: $root.find('.swiper-pagination')[0],
                clickable: true
            },
            autoplay: autoplay ? {
                delay: autoplayDelay,
                disableOnInteraction: false,
            } : false,
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            }
        });

        // Filter functionality
        $root.on('click', '.um-staff-filter button', function(e){
            e.preventDefault();
            var $button = $(this);
            var term = $button.data('term');
            
            console.log('Filter clicked:', term); // Debug log
            
            // Update active state
            $button.addClass('active').siblings().removeClass('active');
            
            // Filter slides
            var $slides = $root.find('.swiper-slide');
            console.log('Total slides:', $slides.length); // Debug log
            
            $slides.each(function(){
                var $slide = $(this);
                var terms = ($slide.attr('data-terms') || '').split(' ');
                var show = term === 'all' || terms.indexOf(term) !== -1;
                console.log('Slide terms:', terms, 'Show:', show); // Debug log
                $slide.toggle(show);
            });
            
            // Update swiper
            if (swiper && typeof swiper.update === 'function') {
                swiper.update();
            }
        });
    };

    // Global functions for import/export
    window.umExportStaffCarouselSettings = function(button) {
        var $widget = $(button).closest('.elementor-widget-um_staff_carousel');
        var settings = {};
        
        // Get all widget settings
        $widget.find('.elementor-control input, .elementor-control select, .elementor-control textarea').each(function(){
            var $control = $(this);
            var controlName = $control.attr('name');
            if (controlName && controlName.includes('um_staff_carousel')) {
                var key = controlName.replace('um_staff_carousel_', '');
                if ($control.attr('type') === 'checkbox') {
                    settings[key] = $control.is(':checked') ? 'yes' : 'no';
                } else if ($control.attr('type') === 'number') {
                    settings[key] = parseInt($control.val()) || 0;
                } else {
                    settings[key] = $control.val() || '';
                }
            }
        });
        
        // Copy to clipboard
        var settingsJson = JSON.stringify(settings, null, 2);
        navigator.clipboard.writeText(settingsJson).then(function(){
            alert('تنظیمات کپی شد!');
        }).catch(function(){
            // Fallback for older browsers
            var textArea = document.createElement('textarea');
            textArea.value = settingsJson;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('تنظیمات کپی شد!');
        });
    };

    window.umImportStaffCarouselSettings = function(button) {
        var $widget = $(button).closest('.elementor-widget-um_staff_carousel');
        var $textarea = $widget.find('textarea[placeholder*="تنظیمات کپی شده"]');
        var settingsJson = $textarea.val().trim();
        
        if (!settingsJson) {
            alert('لطفاً تنظیمات را وارد کنید!');
            return;
        }
        
        try {
            var settings = JSON.parse(settingsJson);
            
            // Apply settings to controls
            Object.keys(settings).forEach(function(key){
                var $control = $widget.find('[name="um_staff_carousel_' + key + '"]');
                if ($control.length) {
                    if ($control.attr('type') === 'checkbox') {
                        $control.prop('checked', settings[key] === 'yes');
                    } else {
                        $control.val(settings[key]);
                    }
                    $control.trigger('change');
                }
            });
            
            alert('تنظیمات اعمال شد!');
            $textarea.val('');
            
        } catch (error) {
            alert('خطا در فرمت تنظیمات! لطفاً دوباره تلاش کنید.');
        }
    };

    $(window).on('elementor/frontend/init', function(){
        elementorFrontend.hooks.addAction('frontend/element_ready/um_staff_carousel.default', handler);
    });
})(jQuery);


