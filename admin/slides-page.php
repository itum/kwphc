<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class KWPRC_Slides_Admin_Page {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_slides_menu_page']);
    }

    public function add_slides_menu_page() {
        add_menu_page(
            'مدیریت اسلایدها',
            'اسلایدها',
            'manage_options',
            'kwprc-slides',
            [$this, 'render_slides_page'],
            'dashicons-images-alt2',
            21
        );
    }

    public function render_slides_page() {
        ?>
        <div class="wrap">
            <h1>مدیریت اسلایدها</h1>
            
            <div id="kwprc-slides-manager">
                <?php $this->display_slides_table(); ?>
            </div>

            <div id="kwprc-slide-upload-form" style="margin-top: 20px;">
                <h2>افزودن اسلاید جدید</h2>
                <form method="post" action="" enctype="multipart/form-data">
                    <?php wp_nonce_field('kwprc_add_slide', 'kwprc_slide_nonce'); ?>
                    <table class="form-table">
                        <tr>
                            <th><label for="slide_title">عنوان اسلاید</label></th>
                            <td><input type="text" name="slide_title" required class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label for="slide_image">تصویر اسلاید</label></th>
                            <td>
                                <input type="file" name="slide_image" accept="image/*" required>
                                <p class="description">فرمت‌های مجاز: JPG, PNG, WebP</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="slide_link">لینک اسلاید</label></th>
                            <td><input type="url" name="slide_link" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label for="slide_description">توضیحات اسلاید</label></th>
                            <td><textarea name="slide_description" rows="4" class="large-text"></textarea></td>
                        </tr>
                    </table>
                    <?php submit_button('افزودن اسلاید'); ?>
                </form>
            </div>
        </div>
        <?php
    }

    public function display_slides_table() {
        $slides = get_posts([
            'post_type' => 'kwprc_slide',
            'numberposts' => -1
        ]);

        if (empty($slides)) {
            echo '<p>هیچ اسلایدی وجود ندارد.</p>';
            return;
        }

        ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>لینک</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td>
                            <?php 
                            $image_url = get_the_post_thumbnail_url($slide->ID, 'thumbnail');
                            if ($image_url): ?>
                                <img src="<?php echo esc_url($image_url); ?>" width="100">
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($slide->post_title); ?></td>
                        <td>
                            <?php 
                            $slide_link = get_post_meta($slide->ID, 'slide_link', true);
                            echo $slide_link ? esc_url($slide_link) : 'بدون لینک'; 
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo get_edit_post_link($slide->ID); ?>" class="button">ویرایش</a>
                            <form method="post" action="" style="display: inline;">
                                <?php wp_nonce_field('kwprc_delete_slide', 'kwprc_delete_slide_nonce'); ?>
                                <input type="hidden" name="slide_id_to_delete" value="<?php echo $slide->ID; ?>">
                                <input type="submit" value="حذف" class="button button-link-delete" onclick="return confirm('آیا مطمئن هستید؟');">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }

    public function handle_slide_actions() {
        // اضافه کردن اسلاید جدید
        if (isset($_POST['kwprc_slide_nonce']) && wp_verify_nonce($_POST['kwprc_slide_nonce'], 'kwprc_add_slide')) {
            $this->add_new_slide();
        }

        // حذف اسلاید
        if (isset($_POST['kwprc_delete_slide_nonce']) && wp_verify_nonce($_POST['kwprc_delete_slide_nonce'], 'kwprc_delete_slide')) {
            $this->delete_slide();
        }
    }

    private function add_new_slide() {
        if (!current_user_can('manage_options')) {
            wp_die('شما اجازه این عملیات را ندارید.');
        }

        $title = sanitize_text_field($_POST['slide_title']);
        $link = !empty($_POST['slide_link']) ? esc_url_raw($_POST['slide_link']) : '';
        $description = sanitize_textarea_field($_POST['slide_description']);

        // آپلود تصویر
        if (!empty($_FILES['slide_image']['name'])) {
            $file = $_FILES['slide_image'];
            $upload = wp_handle_upload($file, ['test_form' => false]);

            if (!isset($upload['error'])) {
                $slide_post = [
                    'post_title' => $title,
                    'post_type' => 'kwprc_slide',
                    'post_status' => 'publish'
                ];

                $slide_id = wp_insert_post($slide_post);

                // اضافه کردن متادیتا
                update_post_meta($slide_id, 'slide_link', $link);
                update_post_meta($slide_id, 'slide_description', $description);

                // تنظیم تصویر شاخص
                $attachment_id = $this->upload_slide_image($upload['file'], $slide_id);
                set_post_thumbnail($slide_id, $attachment_id);

                add_action('admin_notices', function() {
                    echo '<div class="notice notice-success"><p>اسلاید با موفقیت اضافه شد.</p></div>';
                });
            } else {
                add_action('admin_notices', function() use ($upload) {
                    echo '<div class="notice notice-error"><p>خطا در آپلود تصویر: ' . esc_html($upload['error']) . '</p></div>';
                });
            }
        }
    }

    private function delete_slide() {
        if (!current_user_can('manage_options')) {
            wp_die('شما اجازه این عملیات را ندارید.');
        }

        $slide_id = intval($_POST['slide_id_to_delete']);
        
        if (wp_delete_post($slide_id, true)) {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-success"><p>اسلاید با موفقیت حذف شد.</p></div>';
            });
        } else {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-error"><p>خطا در حذف اسلاید.</p></div>';
            });
        }
    }

    private function upload_slide_image($file_path, $slide_id) {
        $upload_dir = wp_upload_dir();
        $file_name = basename($file_path);
        $new_file_path = $upload_dir['path'] . '/' . $file_name;

        // انتقال فایل به پوشه آپلود وردپرس
        copy($file_path, $new_file_path);

        $attachment = [
            'guid'           => $upload_dir['url'] . '/' . $file_name, 
            'post_mime_type' => mime_content_type($new_file_path),
            'post_title'     => preg_replace('/\.[^.]+$/', '', $file_name),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ];

        $attachment_id = wp_insert_attachment($attachment, $new_file_path, $slide_id);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $new_file_path);
        wp_update_attachment_metadata($attachment_id, $attachment_data);

        return $attachment_id;
    }
}

$kwprc_slides_admin = new KWPRC_Slides_Admin_Page();
add_action('admin_init', [$kwprc_slides_admin, 'handle_slide_actions']); 