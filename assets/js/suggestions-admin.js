(function($){
    $(document).ready(function(){
        $('#um-suggestions-table').on('click', '.um-sugg-row', function(){
            var $msg = $(this).next('.um-sugg-message');
            $msg.toggle();
        });
    });
})(jQuery);


