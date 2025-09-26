(function($){
    function showSuccessModal(name, trackingId, onConfirm){
        var displayName = (name || '').trim();
        if (!displayName) displayName = 'کاربر گرامی';
        var modalId = 'um-suggestion-success-modal';
        var $existing = $('#' + modalId);
        if ($existing.length === 0) {
            var html = '' +
                '<div id="'+modalId+'" class="um-suggestion-modal" role="dialog" aria-modal="true">' +
                    '<div class="um-suggestion-modal__backdrop"></div>'+
                    '<div class="um-suggestion-modal__content" role="document">' +
                        '<div class="um-suggestion-modal__body">' +
                            '<div class="um-suggestion-modal__title">ثبت موفق</div>' +
                            '<div class="um-suggestion-modal__message"></div>' +
                            '<div class="um-suggestion-modal__actions">' +
                                '<button type="button" class="um-suggestion-modal__ok">تایید</button>' +
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            $('body').append(html);
        }
        var $modal = $('#' + modalId);
        var $msg = $modal.find('.um-suggestion-modal__message');
        var message = displayName + ' عزیز، پیام شما با موفقیت ثبت شد.';
        if (trackingId) {
            message += '<br/><small>کد پیگیری: ' + trackingId + '</small>';
        }
        $msg.html(message);

        function close(){
            $modal.removeClass('is-open');
            if (typeof onConfirm === 'function') onConfirm();
        }
        $modal.find('.um-suggestion-modal__ok').off('click').on('click', close);
        $modal.find('.um-suggestion-modal__backdrop').off('click').on('click', close);
        $(document).off('keydown.umSugg').on('keydown.umSugg', function(ev){ if(ev.key === 'Escape'){ close(); }});
        setTimeout(function(){ $modal.addClass('is-open'); }, 10);
    }

    $(document).on('submit', 'form.um-suggestion-form', function(e){
        e.preventDefault();
        var $form = $(this);
        var data = $form.serialize();
        data += '&action=um_submit_suggestion';
        $.post(um_suggestion_vars.ajax_url, data, function(resp){
            if (resp && resp.success) {
                var name = $form.find('[name="um_sugg_name"]').val();
                var trackingId = resp.data && resp.data.id ? resp.data.id : null;
                showSuccessModal(name, trackingId, function(){
                    if ($form && $form[0]) { $form[0].reset(); }
                });
            } else {
                var msg = 'خطا در ارسال پیام. لطفاً دوباره تلاش کنید.';
                if (resp && resp.data === 'invalid_nonce') msg = 'اعتبارسنجی امنیتی ناموفق بود. صفحه را رفرش کنید.';
                window.alert(msg);
            }
        });
    });
})(jQuery);


