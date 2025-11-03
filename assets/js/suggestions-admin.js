(function($){
    'use strict';
    
    function toggleDetails(postId) {
        var $detailsRow = $('.um-sugg-details[data-id="' + postId + '"]');
        var $button = $('.um-toggle-details[data-id="' + postId + '"]');
        var $detailsText = $button.find('.um-details-text');
        var $hideText = $button.find('.um-hide-text');
        
        // بستن سایر جزئیات باز شده
        $('.um-sugg-details').each(function(){
            var otherPostId = $(this).data('id');
            if (otherPostId != postId && $(this).is(':visible')) {
                $(this).slideUp(200);
                var $otherButton = $('.um-toggle-details[data-id="' + otherPostId + '"]');
                $otherButton.find('.um-details-text').show();
                $otherButton.find('.um-hide-text').hide();
                $otherButton.removeClass('button-primary');
            }
        });
        
        // نمایش/مخفی کردن جزئیات فعلی
        if ($detailsRow.is(':visible')) {
            $detailsRow.slideUp(200);
            $detailsText.show();
            $hideText.hide();
            $button.removeClass('button-primary');
        } else {
            $detailsRow.slideDown(200);
            $detailsText.hide();
            $hideText.show();
            $button.addClass('button-primary');
        }
    }
    
    $(document).ready(function(){
        // نمایش/مخفی کردن جزئیات با کلیک روی دکمه
        $(document).on('click', '.um-toggle-details', function(e){
            e.preventDefault();
            e.stopPropagation();
            var postId = $(this).data('id');
            if (postId) {
                toggleDetails(postId);
            }
        });
    });
})(jQuery);


