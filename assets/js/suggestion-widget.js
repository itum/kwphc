(function($){
    $(document).on('submit', 'form.um-suggestion-form', function(e){
        e.preventDefault();
        var $form = $(this);
        var data = $form.serialize();
        data += '&action=um_submit_suggestion';
        $.post(um_suggestion_vars.ajax_url, data, function(resp){
            if (resp.success) {
                alert('پیام شما ثبت شد.');
                $form[0].reset();
            } else {
                alert('خطا در ارسال پیام.');
            }
        });
    });
})(jQuery);


