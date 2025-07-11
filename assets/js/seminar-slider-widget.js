(function($) {
    "use strict";

    var seminarSliderHandler = function($scope, $) {
        var $slider = $scope.find('.mySwiper');

        if ($slider.length && !$scope.hasClass('single-seminar')) {
            var swiper = new Swiper($slider[0], {
                slidesPerView: 1,
                spaceBetween: 16,
                navigation: {
                    nextEl: $scope.find('.swiper-button-next')[0],
                    prevEl: $scope.find('.swiper-button-prev')[0],
                },
                pagination: {
                    el: $scope.find('.swiper-pagination')[0],
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 4,
                    }
                }
            });

            // Initialize Lucide icons if they are used in the slides
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/um_seminar_slider.default', seminarSliderHandler);
    });

})(jQuery); 