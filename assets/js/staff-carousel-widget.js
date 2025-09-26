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

        $root.on('click', '.um-staff-filter button', function(){
            var term = $(this).data('term');
            $(this).addClass('active').siblings().removeClass('active');
            swiper.slides.each(function(idx, el){
                var terms = (el.getAttribute('data-terms')||'').split(' ');
                var show = term === 'all' || terms.indexOf(term) !== -1;
                el.style.display = show ? '' : 'none';
            });
            swiper.update();
        });
    };

    $(window).on('elementor/frontend/init', function(){
        elementorFrontend.hooks.addAction('frontend/element_ready/um_staff_carousel.default', handler);
    });
})(jQuery);


