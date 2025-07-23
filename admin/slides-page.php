<?php
if (!defined('ABSPATH')) {
    exit;
}

// افزودن صفحه مدیریت اسلایدها به منوی پنل دانشگاه
function kw_add_slides_menu_page() {
    add_submenu_page(
        'university-management',           // منوی پدر
        'مدیریت اسلایدها',                 // عنوان صفحه
        'مدیریت اسلایدها',                 // عنوان منو
        'manage_options',                  // قابلیت مورد نیاز
        'university-slides',               // شناسه صفحه
        'kw_render_slides_management_page' // تابع نمایش صفحه
    );
}
add_action('admin_menu', 'kw_add_slides_menu_page');

// تابع رندر صفحه مدیریت اسلایدها
function kw_render_slides_management_page() {
    // بررسی مجوزهای کاربری
    if (!current_user_can('manage_options')) {
        wp_die('شما مجوز کافی برای دسترسی به این صفحه را ندارید.');
    }

    // پردازش اقدامات
    kw_handle_slide_actions();

    // دریافت اسلایدها
    $slides_query = new WP_Query([
        'post_type'      => 'university_slide',
        'posts_per_page' => 20,
        'paged'          => max(1, isset($_GET['paged']) ? intval($_GET['paged']) : 1)
    ]);

    ?>
    <div class="wrap">
        <h1>مدیریت اسلایدها</h1>

        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('post-new.php?post_type=university_slide'); ?>" class="button button-primary">افزودن اسلاید جدید</a>
            </div>
        </div>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th scope="col" class="manage-column column-title">عنوان</th>
                    <th scope="col" class="manage-column column-thumbnail">تصویر</th>
                    <th scope="col" class="manage-column column-caption">زیرنویس</th>
                    <th scope="col" class="manage-column column-actions">اقدامات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($slides_query->have_posts()) : ?>
                    <?php while ($slides_query->have_posts()) : $slides_query->the_post(); ?>
                        <tr>
                            <td><?php the_title(); ?></td>
                            <td>
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                <?php else : ?>
                                    بدون تصویر
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $caption = get_post_meta(get_the_ID(), '_university_slide_caption', true);
                                echo $caption ? esc_html($caption) : 'بدون زیرنویس'; 
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo get_edit_post_link(); ?>" class="button">ویرایش</a>
                                <a href="<?php echo get_delete_post_link(); ?>" class="button button-link-delete" onclick="return confirm('آیا مطمئن هستید؟');">حذف</a>
                            </td>
                        </tr>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">هیچ اسلایدی یافت نشد.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php 
        // صفحه‌بندی
        $total_pages = $slides_query->max_num_pages;
        if ($total_pages > 1) {
            echo '<div class="tablenav-pages">';
            echo paginate_links([
                'base'    => add_query_arg('paged', '%#%'),
                'format'  => '',
                'current' => max(1, isset($_GET['paged']) ? intval($_GET['paged']) : 1),
                'total'   => $total_pages
            ]);
            echo '</div>';
        }
        ?>
    </div>
    <?php
}

// پردازش اقدامات اسلایدها (مانند حذف)
function kw_handle_slide_actions() {
    // می‌توانید اقدامات اضافی مانند توده‌ای حذف را اینجا اضافه کنید
} 