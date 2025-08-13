<?php
if (!defined('ABSPATH')) { exit; }

// اطمینان از در دسترس بودن توابع Settings API در مدیریت وردپرس
if (!function_exists('settings_fields')) {
  $tpl = ABSPATH . 'wp-admin/includes/template.php';
  if (file_exists($tpl)) {
    require_once $tpl;
  }
}

?>
<div class="wrap university-management-admin">
  <h1>تنظیمات سالن جلسات</h1>
  <form method="post" action="options.php">
    <?php if (function_exists('settings_fields')) { settings_fields('um_hall_settings_group'); } ?>
    <?php if (function_exists('do_settings_sections')) { do_settings_sections('um_hall_settings_group'); } ?>
    <table class="form-table" role="presentation">
      <tr>
        <th scope="row"><label for="um_hall_capacity">ظرفیت سالن</label></th>
        <td><input name="um_hall_capacity" id="um_hall_capacity" type="number" value="<?php echo esc_attr(get_option('um_hall_capacity', 50)); ?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th scope="row"><label for="um_hall_hourly_rate">هزینه ساعتی (تومان)</label></th>
        <td><input name="um_hall_hourly_rate" id="um_hall_hourly_rate" type="number" value="<?php echo esc_attr(get_option('um_hall_hourly_rate', 0)); ?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th scope="row">تجهیزات پیش‌فرض</th>
        <td>
          <?php $enable_eq = get_option('um_hall_enable_equipment', '1'); ?>
          <label style="display:inline-block;margin-bottom:8px">
            <input type="checkbox" name="um_hall_enable_equipment" value="1" <?php checked($enable_eq, '1'); ?> /> فعال‌سازی انتخاب تجهیزات در فرم رزرو
          </label>
          <div class="um-eq-repeater">
            <div class="um-eq-head">
              <span>نام تجهیز</span>
              <span>قیمت (تومان)</span>
              <span>واحد قیمت</span>
              <span>دسته‌بندی</span>
              <span>ترتیب</span>
              <span></span>
            </div>
            <div class="um-eq-rows" id="um-eq-rows"></div>
            <p><button type="button" class="button" id="um-eq-add">افزودن تجهیز</button></p>
            <input type="hidden" name="um_hall_equipment" id="um_hall_equipment_json" value='<?php echo esc_attr(get_option('um_hall_equipment', '[]')); ?>' />
          </div>
          <style>
            .um-eq-repeater{border:1px solid #ccd0d4;border-radius:4px;padding:10px;background:#fff;max-width:1000px}
            .um-eq-head{display:grid;grid-template-columns:2fr 1fr 1fr 1.2fr 0.6fr 80px;font-weight:600;color:#23282d;margin-bottom:6px;gap:8px}
            .um-eq-row{display:grid;grid-template-columns:2fr 1fr 1fr 1.2fr 0.6fr 80px;gap:8px;margin-bottom:8px;align-items:center}
            .um-eq-row input[type=text],.um-eq-row input[type=number],.um-eq-row select{width:100%}
          </style>
          <script>
          (function(){
            function slugify(str){return (str||'').toString().trim().toLowerCase().replace(/\s+/g,'-').replace(/[^\w\-]+/g,'').replace(/\-+/g,'-');}
            var rows = document.getElementById('um-eq-rows');
            var input = document.getElementById('um_hall_equipment_json');
            function render(){
              rows.innerHTML='';
              var data=[]; try{data=JSON.parse(input.value||'[]')||[]}catch(e){data=[]}
              data.sort(function(a,b){return (parseInt(a.order||0,10)) - (parseInt(b.order||0,10));});
              data.forEach(function(eq,idx){ addRow(eq.label||'', eq.price||'', eq.unit||'fixed', eq.category||'', eq.order||idx+1, eq.id||slugify(eq.label||('eq-'+(idx+1)))); });
              if(data.length===0){ addRow('', '', 'fixed', '', 1, ''); }
            }
            function addRow(label, price, unit, category, order, id){
              var div=document.createElement('div'); div.className='um-eq-row';
              div.innerHTML='\
                <input type="text" placeholder="مثلاً ویدئو پروژکتور" class="um-eq-label" value="'+(label||'')+'" />\
                <input type="number" placeholder="مثلاً 200000" class="um-eq-price" value="'+(price||'')+'" min="0" step="1" />\
                <select class="um-eq-unit">\
                  <option value="fixed"'+(unit==='fixed'?' selected':'')+'>ثابت (به ازای هر رزرو)</option>\
                  <option value="per_hour"'+(unit==='per_hour'?' selected':'')+'>به ازای هر ساعت</option>\
                </select>\
                <input type="text" placeholder="مثلاً صدا و تصویر" class="um-eq-category" value="'+(category||'')+'" />\
                <input type="number" class="um-eq-order" value="'+(order||1)+'" min="0" step="1" />\
                <button type="button" class="button link-delete">حذف</button>';
              div.querySelector('.link-delete').addEventListener('click', function(){ rows.removeChild(div); sync(); });
              div.querySelector('.um-eq-label').addEventListener('input', sync);
              div.querySelector('.um-eq-price').addEventListener('input', sync);
              div.querySelector('.um-eq-unit').addEventListener('change', sync);
              div.querySelector('.um-eq-category').addEventListener('input', sync);
              div.querySelector('.um-eq-order').addEventListener('input', sync);
              rows.appendChild(div);
            }
            function sync(){
              var list=[]; [].slice.call(rows.querySelectorAll('.um-eq-row')).forEach(function(r){
                var label=r.querySelector('.um-eq-label').value.trim();
                var price=parseFloat(r.querySelector('.um-eq-price').value||'0')||0;
                var unit=r.querySelector('.um-eq-unit').value||'fixed';
                var category=r.querySelector('.um-eq-category').value.trim();
                var order=parseInt(r.querySelector('.um-eq-order').value||'0',10)||0;
                if(label){ list.push({ id: slugify(label), label: label, price: price, unit: unit, category: category, order: order }); }
              });
              input.value = JSON.stringify(list);
            }
            document.getElementById('um-eq-add').addEventListener('click', function(){ addRow('', '', 'fixed', '', 0, ''); });
            document.querySelector('form[action="options.php"]').addEventListener('submit', function(){ sync(); });
            render();
          })();
          </script>
          <p class="description">با کلیک روی «افزودن تجهیز» موارد را اضافه کنید. «دسته‌بندی» و «ترتیب» اختیاری هستند. «واحد قیمت» اگر «به ازای هر ساعت» انتخاب شود در مبلغ نهایی در تعداد ساعت ضرب می‌شود.</p>
        </td>
      </tr>
      <tr>
        <th scope="row">درگاه پرداخت</th>
        <td>
          <select name="um_hall_gateway">
            <?php $gw = get_option('um_hall_gateway', 'zarinpal'); ?>
            <option value="zarinpal" <?php selected($gw, 'zarinpal'); ?>>زرین‌پال</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="um_hall_zarinpal_merchant_id">مرچنت آیدی زرین‌پال</label></th>
        <td><input name="um_hall_zarinpal_merchant_id" id="um_hall_zarinpal_merchant_id" type="text" value="<?php echo esc_attr(get_option('um_hall_zarinpal_merchant_id', '')); ?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th scope="row">Sandbox زرین‌پال</th>
        <td>
          <label>
            <input type="checkbox" name="um_hall_zarinpal_sandbox" value="1" <?php checked(get_option('um_hall_zarinpal_sandbox', '0'), '1'); ?> />
            فعال‌سازی حالت تست (Sandbox)
          </label>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="um_hall_admin_email">ایمیل مدیر</label></th>
        <td><input name="um_hall_admin_email" id="um_hall_admin_email" type="email" value="<?php echo esc_attr(get_option('um_hall_admin_email', get_option('admin_email'))); ?>" class="regular-text" /></td>
      </tr>
    </table>

    <?php if (function_exists('submit_button')) { submit_button(); } else { echo '<p class="submit"><input type="submit" class="button button-primary" value="ذخیره تغییرات" /></p>'; } ?>
  </form>
</div>


