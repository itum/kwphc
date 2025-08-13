<?php
if (!defined('ABSPATH')) { exit; }

$post_type = 'hall_booking';
$add_new_url = admin_url('post-new.php?post_type=' . $post_type);
$list_url = admin_url('edit.php?post_type=' . $post_type);
?>
<div class="wrap">
  <h1>مدیریت رزروها</h1>
  <p>
    <a class="button button-primary" href="<?php echo esc_url($add_new_url); ?>">افزودن رزرو جدید</a>
    <a class="button" href="<?php echo esc_url($list_url); ?>">مشاهده لیست همه رزروها</a>
  </p>
  <p>برای مشاهده، ویرایش یا افزودن رزروها از صفحه پست‌تایپ اختصاصی استفاده کنید.</p>
</div>


