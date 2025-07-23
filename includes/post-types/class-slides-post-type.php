<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class KWPRC_Slides_Post_Type {
    public function __construct() {
        add_action('init', [$this, 'register_slides_post_type']);
        add_action('add_meta_boxes', [$this, 'add_slides_meta_boxes']);
        add_action('save_post', [$this, 'save_slides_meta'], 10, 2);
    }

    public function register_slides_post_type() {
        $labels = [
            'name'               => 'اسلایدها',
            'singular_name'      => 'اسلاید',
            'menu_name'          => 'اسلایدها',
            'add_new'            => 'افزودن اسلاید جدید',
            'add_new_item'       => 'افزودن اسلاید جدید',
            'edit_item'          => 'ویرایش اسلاید',
            'new_item'           => 'اسلاید جدید',
            'view_item'          => 'مشاهده اسلاید',
            'search_items'       => 'جستجوی اسلایدها',
            'not_found'          => 'اسلایدی یافت نشد',
            'not_found_in_trash' => 'اسلایدی در زباله‌دان یافت نشد'
        ];

        $args = [
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'slide'],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'supports'           => ['title', 'thumbnail']
        ];

        register_post_type('kwprc_slide', $args);
    }

    public function add_slides_meta_boxes() {
        add_meta_box(
            'kwprc_slide_details',
            'جزئیات اسلاید',
            [$this, 'render_slide_details_meta_box'],
            'kwprc_slide',
            'normal',
            'default'
        );
    }

    public function render_slide_details_meta_box($post) {
        wp_nonce_field('kwprc_slide_details_nonce', 'kwprc_slide_details_nonce');
        
        $slide_link = get_post_meta($post->ID, 'slide_link', true);
        $slide_description = get_post_meta($post->ID, 'slide_description', true);
        ?>
        <table class="form-table">
            <tr>
                <th><label for="slide_link">لینک اسلاید</label></th>
                <td>
                    <input type="text" id="slide_link" name="slide_link" 
                           value="<?php echo esc_attr($slide_link); ?>" 
                           class="regular-text">
                </td>
            </tr>
            <tr>
                <th><label for="slide_description">توضیحات اسلاید</label></th>
                <td>
                    <textarea id="slide_description" name="slide_description" 
                              rows="4" class="large-text"><?php echo esc_textarea($slide_description); ?></textarea>
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_slides_meta($post_id, $post) {
        if (!isset($_POST['kwprc_slide_details_nonce']) || 
            !wp_verify_nonce($_POST['kwprc_slide_details_nonce'], 'kwprc_slide_details_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if ($post->post_type !== 'kwprc_slide') {
            return;
        }

        if (isset($_POST['slide_link'])) {
            update_post_meta($post_id, 'slide_link', sanitize_text_field($_POST['slide_link']));
        }

        if (isset($_POST['slide_description'])) {
            update_post_meta($post_id, 'slide_description', sanitize_textarea_field($_POST['slide_description']));
        }
    }
}

new KWPRC_Slides_Post_Type(); 