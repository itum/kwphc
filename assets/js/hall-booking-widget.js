/* global jQuery, um_hall_widget_vars */
(function($){
  // بررسی وجود متغیرهای لازم
  if (typeof um_hall_widget_vars === 'undefined') {
    console.error('UM Hall Booking: um_hall_widget_vars is not defined!');
  }
  
  window.UM_Hall_Form = {
    calcTotal: function($form){
      try {
        if (typeof um_hall_widget_vars === 'undefined') {
          console.error('UM Hall Booking: um_hall_widget_vars is not defined in calcTotal');
          return;
        }
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
        console.error('UM Hall Booking: Error in calcTotal', e);
      }
    },
    submit: function(e){
      e.preventDefault();
      var $form = $(e.target);
      
      // بررسی وجود متغیرهای لازم
      if (typeof um_hall_widget_vars === 'undefined') {
        console.error('UM Hall Booking: um_hall_widget_vars is not defined!');
        $('#um-hall-msg').addClass('error').text('خطا در بارگذاری فرم. لطفاً صفحه را نوسازی کنید.');
        return false;
      }
      
      // اگر قوانین وجود دارد، باید تیک خورده باشد
      var $terms = $form.find('input[name="accept_terms"]');
      if ($terms.length && !$terms.is(':checked')) {
        $('#um-hall-msg').addClass('error').text('لطفاً قوانین را بپذیرید.');
        return false;
      }
      
      UM_Hall_Form.calcTotal($form);
      var data = $form.serializeArray().reduce(function(acc, cur){ acc[cur.name] = acc[cur.name] ? ([]).concat(acc[cur.name], cur.value) : cur.value; return acc; }, {});
      $('#um-hall-msg').removeClass('error success').text('');
      
      console.log('UM Hall Booking: Submitting form with data:', data);
      
      $.ajax({
        url: um_hall_widget_vars.ajax_url,
        method: 'POST',
        data: $.extend({ action: 'um_hall_create_and_pay' }, data),
        dataType: 'json',
        beforeSend: function(){ 
          $form.find('button[type="submit"]').prop('disabled', true).text('در حال انتقال به درگاه...'); 
        },
        complete: function(){ 
          $form.find('button[type="submit"]').prop('disabled', false).text('پرداخت و نهایی‌سازی'); 
        },
        success: function(res){
          console.log('UM Hall Booking: AJAX response:', res);
          if(res && res.success && res.data && res.data.redirect_url){
            window.location.href = res.data.redirect_url;
          } else {
            var errorMsg = res && res.data && res.data.message ? res.data.message : 'خطای نامشخص';
            console.error('UM Hall Booking: AJAX error:', errorMsg);
            $('#um-hall-msg').addClass('error').text(errorMsg);
          }
        },
        error: function(xhr, status, error){
          console.error('UM Hall Booking: AJAX request failed:', {
            status: status,
            error: error,
            responseText: xhr.responseText,
            statusCode: xhr.status
          });
          var errorMsg = 'خطا در ارتباط با سرور';
          if (xhr.responseText) {
            try {
              var jsonResponse = JSON.parse(xhr.responseText);
              if (jsonResponse.data && jsonResponse.data.message) {
                errorMsg = jsonResponse.data.message;
              }
            } catch(e) {
              // اگر JSON نبود، از پیام پیش‌فرض استفاده کن
            }
          }
          $('#um-hall-msg').addClass('error').text(errorMsg);
        }
      });
      return false;
    }
  };
  $(document).on('change input', '.um-hall-form input, .um-hall-form textarea, .um-hall-form select', function(){
    var $form = $(this).closest('form');
    UM_Hall_Form.calcTotal($form);
    // نمایش/پنهان کردن دکمه پرداخت بر اساس تیک قوانین (فقط اگر required باشد)
    var $terms = $form.find('input[name="accept_terms"]');
    if ($terms.length && $terms.prop('required')) {
      var ok = $terms.is(':checked');
      $form.find('button[type="submit"]').prop('disabled', !ok).toggleClass('disabled', !ok);
    } else if ($terms.length) {
      // اگر terms وجود دارد اما required نیست، دکمه را همیشه فعال نگه دار
      $form.find('button[type="submit"]').prop('disabled', false).removeClass('disabled');
    }
  });
  // در بارگذاری اولیه فرم نیز وضعیت دکمه بررسی شود
  $(function(){
    var $form = $('.um-hall-form');
    if ($form.length) {
      var $terms = $form.find('input[name="accept_terms"]');
      if ($terms.length && $terms.prop('required')) {
        // اگر required است، بررسی کن
        var ok = $terms.is(':checked');
        $form.find('button[type="submit"]').prop('disabled', !ok).toggleClass('disabled', !ok);
      } else if ($terms.length) {
        // اگر terms وجود دارد اما required نیست، دکمه را فعال کن
        $form.find('button[type="submit"]').prop('disabled', false).removeClass('disabled');
      } else {
        // اگر اصلاً terms وجود ندارد، دکمه را فعال کن
        $form.find('button[type="submit"]').prop('disabled', false).removeClass('disabled');
      }
    }
    
    // فرمت کردن خودکار تاریخ شمسی به فرمت YYYY/MM/DD
    var $dateInput = $('#um-hall-date-input');
    if ($dateInput.length) {
      $dateInput.on('input', function(e){
        var value = $(this).val().replace(/[^0-9]/g, ''); // حذف همه کاراکترهای غیر عددی
        
        // اضافه کردن اسلش بعد از سال (4 رقم) و ماه (2 رقم)
        var formatted = '';
        if (value.length > 0) {
          formatted = value.substring(0, 4); // سال (4 رقم اول)
          if (value.length > 4) {
            formatted += '/' + value.substring(4, 6); // ماه (2 رقم بعدی)
          }
          if (value.length > 6) {
            formatted += '/' + value.substring(6, 8); // روز (2 رقم آخر)
          }
        }
        
        // محدود کردن به حداکثر 10 کاراکتر (YYYY/MM/DD)
        if (formatted.length <= 10) {
          $(this).val(formatted);
        }
      });
      
      // جلوگیری از ورود کاراکترهای غیر عددی
      $dateInput.on('keypress', function(e){
        // فقط اعداد و اسلش را بپذیر (اسلش به صورت خودکار اضافه می‌شود)
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode < 48 || charCode > 57) { // فقط اعداد 0-9
          e.preventDefault();
          return false;
        }
      });
      
      // تبدیل فرمت تاریخ هنگام submit به فرمت استاندارد (YYYY/MM/DD)
      $form.on('submit', function(){
        var dateValue = $dateInput.val();
        if (dateValue) {
          // اگر تاریخ به صورت YYYY/MM/DD است، آن را به فرمت استاندارد تبدیل کن
          var dateParts = dateValue.split('/');
          if (dateParts.length === 3) {
            var year = dateParts[0].padStart(4, '0');
            var month = dateParts[1].padStart(2, '0');
            var day = dateParts[2].padStart(2, '0');
            $dateInput.val(year + '/' + month + '/' + day);
          }
        }
      });
    }
  });
})(jQuery);


