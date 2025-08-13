/* global jQuery, um_hall_widget_vars */
(function($){
  window.UM_Hall_Form = {
    calcTotal: function($form){
      try {
        var rate = parseFloat(um_hall_widget_vars.hourly_rate || 0) || 0;
        var start = $form.find('input[name="start_time"]').val();
        var end   = $form.find('input[name="end_time"]').val();
        var total = 0;
        if (start && end) {
          var s = start.split(':');
          var e = end.split(':');
          var sd = new Date(); sd.setHours(parseInt(s[0]||0,10), parseInt(s[1]||0,10), 0, 0);
          var ed = new Date(); ed.setHours(parseInt(e[0]||0,10), parseInt(e[1]||0,10), 0, 0);
          var diff = (ed - sd) / 3600000; // hours
          if (diff > 0) {
            total += Math.ceil(diff) * rate;
          }
        }
        if (um_hall_widget_vars.equipments_enabled) {
          var selected = ($form.serializeArray().filter(function(it){return it.name === 'equipments[]';}).map(function(it){return it.value;}));
          (um_hall_widget_vars.equipments || []).forEach(function(eq){
            if (selected.indexOf(eq.id) !== -1) {
              var p = parseFloat(eq.price || 0) || 0;
              if ((eq.unit||'fixed') === 'per_hour') {
                // اگر قیمت به ازای هر ساعت است، در تعداد ساعت ضرب می‌شود
                var h = 0; if (start && end) { var s = start.split(':'), e = end.split(':'); var sd = new Date(); sd.setHours(parseInt(s[0]||0,10), parseInt(s[1]||0,10), 0, 0); var ed = new Date(); ed.setHours(parseInt(e[0]||0,10), parseInt(e[1]||0,10), 0, 0); h = Math.max(1, Math.ceil((ed - sd) / 3600000)); }
                total += p * h;
              } else {
                total += p;
              }
            }
          });
        }
        // پذیرایی (در صورت فعال بودن)
        if (um_hall_widget_vars.caterings && Array.isArray(um_hall_widget_vars.caterings)) {
          var selectedCat = ($form.serializeArray().filter(function(it){return it.name === 'catering[]';}).map(function(it){return it.value;}));
          (um_hall_widget_vars.caterings || []).forEach(function(ct){
            if (selectedCat.indexOf(ct.id) !== -1) {
              var p = parseFloat(ct.price || 0) || 0;
              if ((ct.unit||'fixed') === 'per_hour') {
                var h = 0; if (start && end) { var s = start.split(':'), e = end.split(':'); var sd = new Date(); sd.setHours(parseInt(s[0]||0,10), parseInt(s[1]||0,10), 0, 0); var ed = new Date(); ed.setHours(parseInt(e[0]||0,10), parseInt(e[1]||0,10), 0, 0); h = Math.max(1, Math.ceil((ed - sd) / 3600000)); }
                total += p * h;
              } else {
                total += p;
              }
            }
          });
        }
        $('#um-hall-total').text(total > 0 ? ('مبلغ قابل پرداخت: ' + total.toLocaleString('fa-IR') + ' تومان') : '');
      } catch(e) {
        // noop
      }
    },
    submit: function(e){
      e.preventDefault();
      var $form = $(e.target);
      UM_Hall_Form.calcTotal($form);
      var data = $form.serializeArray().reduce(function(acc, cur){ acc[cur.name] = acc[cur.name] ? ([]).concat(acc[cur.name], cur.value) : cur.value; return acc; }, {});
      $('#um-hall-msg').removeClass('error success').text('');
      $.ajax({
        url: um_hall_widget_vars.ajax_url,
        method: 'POST',
        data: $.extend({ action: 'um_hall_create_and_pay' }, data),
        dataType: 'json',
        beforeSend: function(){ $form.find('button[type="submit"]').prop('disabled', true).text('در حال انتقال به درگاه...'); },
        complete: function(){ $form.find('button[type="submit"]').prop('disabled', false).text('پرداخت و نهایی‌سازی'); },
        success: function(res){
          if(res && res.success && res.data && res.data.redirect_url){
            window.location.href = res.data.redirect_url;
          } else {
            $('#um-hall-msg').addClass('error').text(res && res.data && res.data.message ? res.data.message : 'خطای نامشخص');
          }
        },
        error: function(){
          $('#um-hall-msg').addClass('error').text('خطا در ارتباط با سرور');
        }
      });
      return false;
    }
  };
  $(document).on('change input', '.um-hall-form input, .um-hall-form textarea, .um-hall-form select', function(){
    var $form = $(this).closest('form');
    UM_Hall_Form.calcTotal($form);
  });
})(jQuery);


