<?php
// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// بررسی دسترسی کاربر
if (!current_user_can('manage_options')) {
    wp_die(__('شما دسترسی به این صفحه را ندارید.', 'university-management'));
}
?>
<div class="wrap">
    <h1><?php _e('انتقادات و پیشنهادات', 'university-management'); ?></h1>

    <?php $admin_nonce = wp_create_nonce('um_suggestions_action'); ?>
    <form method="get" id="um-suggestions-filters" style="margin-bottom:15px; display:flex; gap:10px; align-items:flex-end;">
        <input type="hidden" name="page" value="university-suggestions" />
        <div>
            <label><?php _e('جستجو', 'university-management'); ?></label><br/>
            <input type="search" name="s" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>" />
        </div>
        <div>
            <label><?php _e('گیرنده', 'university-management'); ?></label><br/>
            <select name="recipient">
                <option value=""><?php _e('همه', 'university-management'); ?></option>
                <?php
                // build distinct recipients
                $all_recipients = get_posts(array('post_type' => 'um_suggestions','posts_per_page'=>-1,'fields'=>'ids'));
                $rec_set = array();
                foreach ($all_recipients as $rid) {
                    $v = get_post_meta($rid, 'um_sugg_recipient', true);
                    if ($v) $rec_set[ $v ] = $v;
                }
                foreach ($rec_set as $r) {
                    $sel = (isset($_GET['recipient']) && $_GET['recipient'] === $r) ? 'selected' : '';
                    printf('<option value="%s" %s>%s</option>', esc_attr($r), $sel, esc_html($r));
                }
                ?>
            </select>
        </div>
        <div>
            <label><?php _e('از تاریخ', 'university-management'); ?></label><br/>
            <input type="date" name="from" value="<?php echo esc_attr($_GET['from'] ?? ''); ?>" />
        </div>
        <div>
            <label><?php _e('تا تاریخ', 'university-management'); ?></label><br/>
            <input type="date" name="to" value="<?php echo esc_attr($_GET['to'] ?? ''); ?>" />
        </div>
        <div>
            <button class="button button-primary" type="submit"><?php _e('فیلتر', 'university-management'); ?></button>
            <a href="<?php echo admin_url('admin.php?page=university-suggestions'); ?>" class="button"><?php _e('بازنشانی', 'university-management'); ?></a>
        </div>
    </form>

    <div style="margin-bottom:12px; display:flex; gap:10px; align-items:center;">
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="display:inline;">
            <input type="hidden" name="action" value="um_suggestions_export_csv" />
            <input type="hidden" name="um_sugg_admin_nonce" value="<?php echo esc_attr($admin_nonce); ?>" />
            <input type="hidden" name="s" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>" />
            <input type="hidden" name="recipient" value="<?php echo esc_attr($_GET['recipient'] ?? ''); ?>" />
            <input type="hidden" name="from" value="<?php echo esc_attr($_GET['from'] ?? ''); ?>" />
            <input type="hidden" name="to" value="<?php echo esc_attr($_GET['to'] ?? ''); ?>" />
            <button class="button"><?php _e('خروجی CSV', 'university-management'); ?></button>
        </form>
    </div>

    <?php
    // query with filters
    $paged = max(1, intval($_GET['paged'] ?? 1));
    $query_args = array('post_type' => 'um_suggestions', 'posts_per_page' => 20, 'paged' => $paged);
    if (!empty($_GET['s'])) { $query_args['s'] = sanitize_text_field($_GET['s']); }
    if (!empty($_GET['recipient'])) { $query_args['meta_query'] = array(array('key'=>'um_sugg_recipient','value'=>sanitize_text_field($_GET['recipient']), 'compare'=>'=')); }
    if (!empty($_GET['from']) || !empty($_GET['to'])) {
        $from = !empty($_GET['from']) ? date('Y-m-d 00:00:00', strtotime($_GET['from'])) : null;
        $to = !empty($_GET['to']) ? date('Y-m-d 23:59:59', strtotime($_GET['to'])) : null;
        $query_args['date_query'] = array();
        if ($from) $query_args['date_query']['after'] = $from;
        if ($to) $query_args['date_query']['before'] = $to;
        $query_args['date_query']['inclusive'] = true;
    }

    $q = new WP_Query($query_args);
    ?>

    <table class="widefat fixed" cellspacing="0" id="um-suggestions-table">
        <thead>
            <tr>
                <th><?php _e('شناسه', 'university-management'); ?></th>
                <th><?php _e('عنوان', 'university-management'); ?></th>
                <th><?php _e('وضعیت', 'university-management'); ?></th>
                <th><?php _e('گیرنده', 'university-management'); ?></th>
                <th><?php _e('نام', 'university-management'); ?></th>
                <th><?php _e('شماره تماس', 'university-management'); ?></th>
                <th><?php _e('تاریخ', 'university-management'); ?></th>
                <th><?php _e('اقدامات', 'university-management'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post();
                $p = get_post();
                $name = get_post_meta($p->ID, 'um_sugg_name', true);
                $phone = get_post_meta($p->ID, 'um_sugg_phone', true);
                $recipient = get_post_meta($p->ID, 'um_sugg_recipient', true);
                $content = get_post_field('post_content', $p->ID);
                $is_read = get_post_meta($p->ID, 'um_sugg_read', true) === '1';
            ?>
            <tr class="um-sugg-row <?php echo $is_read ? 'read' : 'unread'; ?>" data-id="<?php echo esc_attr($p->ID); ?>">
                <td><?php echo esc_html($p->ID); ?></td>
                <td><?php echo esc_html($p->post_title); ?></td>
                <td><?php echo $is_read ? __('خوانده‌شده','university-management') : '<strong>'.__('خوانده‌نشده','university-management').'</strong>'; ?></td>
                <td><?php echo esc_html($recipient); ?></td>
                <td><?php echo esc_html($name); ?></td>
                <td><?php echo esc_html($phone); ?></td>
                <td><?php echo esc_html(get_the_date('', $p)); ?></td>
                <td>
                    <button type="button" class="button button-small um-toggle-details" data-id="<?php echo esc_attr($p->ID); ?>">
                        <span class="um-details-text"><?php _e('نمایش جزئیات', 'university-management'); ?></span>
                        <span class="um-hide-text" style="display:none;"><?php _e('مخفی کردن', 'university-management'); ?></span>
                    </button>
                    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="display:inline; margin-left:6px;">
                        <input type="hidden" name="action" value="um_suggestion_mark_read" />
                        <input type="hidden" name="post_id" value="<?php echo esc_attr($p->ID); ?>" />
                        <input type="hidden" name="set" value="<?php echo $is_read ? '0' : '1'; ?>" />
                        <input type="hidden" name="um_sugg_admin_nonce" value="<?php echo esc_attr($admin_nonce); ?>" />
                        <button class="button button-small" type="submit"><?php echo $is_read ? __('برگردان به خوانده‌نشده','university-management') : __('نشانه‌گذاری خوانده','university-management'); ?></button>
                    </form>
                    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="display:inline; margin-left:6px;" onsubmit="return confirm('<?php echo esc_js(__('آیا مطمئن هستید که می‌خواهید این پیام را حذف کنید؟','university-management')); ?>');">
                        <input type="hidden" name="action" value="um_suggestion_delete" />
                        <input type="hidden" name="post_id" value="<?php echo esc_attr($p->ID); ?>" />
                        <input type="hidden" name="um_sugg_admin_nonce" value="<?php echo esc_attr($admin_nonce); ?>" />
                        <button class="button button-small button-danger" type="submit"><?php _e('حذف', 'university-management'); ?></button>
                    </form>
                </td>
            </tr>
            <tr class="um-sugg-details" data-id="<?php echo esc_attr($p->ID); ?>" style="display:none;">
                <td colspan="8" style="background:#f9f9f9; padding:20px;">
                    <div style="background:white; padding:15px; border:1px solid #ddd; border-radius:4px;">
                        <h3 style="margin-top:0; color:#2271b1; border-bottom:2px solid #2271b1; padding-bottom:8px;"><?php _e('جزئیات پیام', 'university-management'); ?></h3>
                        <table style="width:100%; border-collapse:collapse;">
                            <tr>
                                <td style="padding:8px; width:150px; font-weight:bold; border-bottom:1px solid #eee;"><?php _e('شناسه:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;"><?php echo esc_html($p->ID); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold; border-bottom:1px solid #eee;"><?php _e('عنوان:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;"><?php echo esc_html($p->post_title); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold; border-bottom:1px solid #eee;"><?php _e('گیرنده:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;"><?php echo esc_html($recipient ?: '-'); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold; border-bottom:1px solid #eee;"><?php _e('نام و نام خانوادگی:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;"><?php echo esc_html($name ?: '-'); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold; border-bottom:1px solid #eee;"><?php _e('شماره تماس:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;"><?php echo esc_html($phone ?: '-'); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold; border-bottom:1px solid #eee;"><?php _e('تاریخ ارسال:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;"><?php echo esc_html(get_the_date('Y/m/d H:i', $p)); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold; vertical-align:top; border-bottom:1px solid #eee;"><?php _e('پیام شما:', 'university-management'); ?></td>
                                <td style="padding:8px; border-bottom:1px solid #eee;">
                                    <div style="background:#f5f5f5; padding:12px; border-radius:4px; line-height:1.6; white-space:pre-wrap;"><?php echo esc_html($content); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px; font-weight:bold;"><?php _e('وضعیت:', 'university-management'); ?></td>
                                <td style="padding:8px;">
                                    <?php if ($is_read): ?>
                                        <span style="color:#46b450; font-weight:bold;"><?php _e('خوانده شده', 'university-management'); ?></span>
                                    <?php else: ?>
                                        <span style="color:#dc3232; font-weight:bold;"><?php _e('خوانده نشده', 'university-management'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="8"><?php _e('هیچ پیامی یافت نشد.', 'university-management'); ?></td></tr>
            <?php endif; wp_reset_postdata(); ?>
        </tbody>
    </table>

    <div style="margin-top:12px;">
        <?php
        // pagination
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            'base' => add_query_arg('paged','%#%'),
            'format' => '?paged=%#%',
            'current' => $paged,
            'total' => $q->max_num_pages,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;'
        ));
        ?>
    </div>

</div>

<style>
/* ارث‌بری فونت‌های پیشخوان وردپرس */
.wrap, .wrap *,
#um-suggestions-table, #um-suggestions-table * {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {
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
        if ($detailsRow.length && $detailsRow.is(':visible')) {
            $detailsRow.slideUp(200);
            $detailsText.show();
            $hideText.hide();
            $button.removeClass('button-primary');
        } else if ($detailsRow.length) {
            $detailsRow.slideDown(200);
            $detailsText.hide();
            $hideText.show();
            $button.addClass('button-primary');
        }
    }
    
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
</script>


