<?php
if (!defined('ABSPATH')) { exit; }

$current_page = isset($_GET['page']) ? sanitize_text_field(wp_unslash($_GET['page'])) : '';
// اگر به هر دلیلی این فایل با اسلاگ تنظیمات لود شد، همان‌جا صفحه تنظیمات را بارگذاری کن
if ($current_page === 'university-hall-settings') {
  $settings_file = defined('UM_PLUGIN_DIR') ? UM_PLUGIN_DIR . 'admin/hall-booking-settings-page.php' : __DIR__ . '/hall-booking-settings-page.php';
  if (file_exists($settings_file)) {
    require_once $settings_file;
    return;
  }
}

$from = isset($_GET['from']) ? sanitize_text_field(wp_unslash($_GET['from'])) : '';
$to   = isset($_GET['to']) ? sanitize_text_field(wp_unslash($_GET['to'])) : '';
$status = isset($_GET['status']) ? sanitize_text_field(wp_unslash($_GET['status'])) : '';

$args = array(
  'post_type' => 'hall_booking',
  'posts_per_page' => -1,
  'post_status' => array('publish','pending','draft'),
  'orderby' => 'meta_value',
  'meta_key' => '_um_hall_date',
  'order' => 'DESC',
  'meta_query' => array('relation' => 'AND')
);
if ($from && $to) {
  $args['meta_query'][] = array('key' => '_um_hall_date', 'value' => array($from,$to), 'compare' => 'BETWEEN', 'type' => 'DATE');
} elseif ($from) {
  $args['meta_query'][] = array('key' => '_um_hall_date', 'value' => $from, 'compare' => '>=', 'type' => 'DATE');
} elseif ($to) {
  $args['meta_query'][] = array('key' => '_um_hall_date', 'value' => $to, 'compare' => '<=', 'type' => 'DATE');
}
if ($status) {
  $args['meta_query'][] = array('key' => '_um_hall_payment_status', 'value' => $status);
}

$posts = get_posts($args);
$count = 0; $sum = 0; $rows = array();
foreach ($posts as $p) {
  $count++;
  $amount = floatval(get_post_meta($p->ID, '_um_hall_total_amount', true));
  if (get_post_meta($p->ID, '_um_hall_payment_status', true) === 'success') {
    $sum += $amount;
  }
  $rows[] = array(
    'date' => get_post_meta($p->ID, '_um_hall_date', true),
    'time' => get_post_meta($p->ID, '_um_hall_start_time', true) . ' - ' . get_post_meta($p->ID, '_um_hall_end_time', true),
    'title' => get_post_meta($p->ID, '_um_hall_event_title', true),
    'name' => get_post_meta($p->ID, '_um_hall_reserver_name', true),
    'amount' => $amount,
    'status' => get_post_meta($p->ID, '_um_hall_payment_status', true),
  );
}

// خروجی CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
  nocache_headers();
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=hall-bookings.csv');
  $out = fopen('php://output', 'w');
  fputcsv($out, array('Date','Time','Event Title','Name','Amount','Status'));
  foreach ($rows as $r) {
    fputcsv($out, array($r['date'], $r['time'], $r['title'], $r['name'], $r['amount'], $r['status']));
  }
  fclose($out);
  exit;
}

?>
<div class="wrap" style="direction:rtl;text-align:right">
  <h1>گزارش‌گیری رزرو سالن</h1>
  <form method="get" style="margin:16px 0">
    <input type="hidden" name="page" value="university-hall-reports" />
    <label>از تاریخ: <input type="date" name="from" value="<?php echo esc_attr($from); ?>" /></label>
    <label>تا تاریخ: <input type="date" name="to" value="<?php echo esc_attr($to); ?>" /></label>
    <label>وضعیت پرداخت:
      <select name="status">
        <option value="">همه</option>
        <option value="pending" <?php selected($status,'pending'); ?>>در انتظار</option>
        <option value="success" <?php selected($status,'success'); ?>>موفق</option>
        <option value="failed" <?php selected($status,'failed'); ?>>ناموفق</option>
      </select>
    </label>
    <?php submit_button('اعمال فیلتر', 'primary', '', false); ?>
    <a class="button" href="<?php echo esc_url(add_query_arg(array_merge($_GET, array('export'=>'csv')))); ?>">خروجی CSV</a>
  </form>

  <p><strong>تعداد رزروها:</strong> <?php echo esc_html($count); ?> | <strong>مجموع درآمد (موفق):</strong> <?php echo esc_html(number_format_i18n($sum)); ?> تومان</p>

  <table class="widefat fixed striped">
    <thead>
      <tr><th>تاریخ</th><th>ساعت</th><th>عنوان رویداد</th><th>رزروکننده</th><th>مبلغ</th><th>وضعیت</th></tr>
    </thead>
    <tbody>
      <?php if (empty($rows)) : ?>
        <tr><td colspan="6">موردی یافت نشد.</td></tr>
      <?php else : foreach ($rows as $r) : ?>
        <tr>
          <td><?php echo esc_html($r['date']); ?></td>
          <td><?php echo esc_html($r['time']); ?></td>
          <td><?php echo esc_html($r['title']); ?></td>
          <td><?php echo esc_html($r['name']); ?></td>
          <td><?php echo esc_html(number_format_i18n($r['amount'])); ?></td>
          <td><?php echo esc_html($r['status']); ?></td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>


