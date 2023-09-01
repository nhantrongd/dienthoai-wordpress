<?php
/**
 * Helper Functions
 */
/** Get Post Lists */
if (!function_exists('meta_store_elements_post_lists')) {

    function meta_store_elements_post_lists($multiple) {
        $posts = get_posts(array('posts_per_page' => 100));

        if ($multiple) {
            $post_list = array('all' => __('All', 'meta-store-elements'));
        } else {
            $post_list = array('none' => __('None', 'meta-store-elements'));
        }

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $post_list[$post->post_name] = $post->post_title;
            }
        }

        return $post_list;
    }

}

if (!function_exists('meta_store_elements_post')) {

    function meta_store_elements_post() {
        $posts = get_posts(array('posts_per_page' => 100));

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $post_list[$post->post_name] = $post->post_title;
            }
        }

        return $post_list;
    }

}

/** Get Tag Lists */
if (!function_exists('meta_store_elements_tag_lists')) {

    function meta_store_elements_tag_lists() {
        return array(
            'h1' => __('H1', 'meta-store-elements'),
            'h2' => __('H2', 'meta-store-elements'),
            'h3' => __('H3', 'meta-store-elements'),
            'h4' => __('H4', 'meta-store-elements'),
            'h5' => __('H5', 'meta-store-elements'),
            'h6' => __('H6', 'meta-store-elements'),
            'span' => __('Span', 'meta-store-elements'),
            'div' => __('Div', 'meta-store-elements'),
        );
    }

}

/** Orderby List */
if (!function_exists('meta_store_elements_orderby_list')) {

    function meta_store_elements_orderby_list() {
        return array(
            'none' => __('None', 'meta-store-elements'),
            'date' => __('Date', 'meta-store-elements'),
            'title' => __('Title', 'meta-store-elements'),
            'name' => __('Name', 'meta-store-elements'),
            'ID' => __('ID', 'meta-store-elements'),
        );
    }

}

/** Order List */
if (!function_exists('meta_store_elements_order_list')) {

    function meta_store_elements_order_list() {
        return array(
            'ASC' => __('Ascending', 'meta-store-elements'),
            'DESC' => __('Descending', 'meta-store-elements'),
        );
    }

}

/** Image Sizes List */
if (!function_exists('meta_store_elements_imagesizes_list')) {

    function meta_store_elements_imagesizes_list() {
        global $_wp_additional_image_sizes;

        $default_image_sizes = get_intermediate_image_sizes();
        $image_size_list = array();

        foreach ($default_image_sizes as $size) {
            $image_sizes[$size]['width'] = intval(get_option("{$size}_size_w"));
            $image_sizes[$size]['height'] = intval(get_option("{$size}_size_h"));
            $image_sizes[$size]['crop'] = get_option("{$size}_crop") ? get_option("{$size}_crop") : false;
        }

        if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes)) {
            $image_sizes = array_merge($image_sizes, $_wp_additional_image_sizes);
        }
        foreach ($image_sizes as $key => $value) {
            $image_size_list[$key] = ucfirst($key);
        }
        return $image_size_list;
    }

}

/** Get Attachment Alt Tag */
if (!function_exists('meta_store_elements_get_altofimage')) {

    function meta_store_elements_get_altofimage($attachment) {
        $attachment_id = '';
        if ($attachment) {
            if (is_string($attachment)) {
                $attachment_id = attachment_url_to_postid($attachment);
            } elseif (is_int($attachment)) {
                $attachment_id = $attachment;
            }
            return get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        }
    }

}

/** Get All Authors */
if (!function_exists('meta_store_elements_get_auhtors')) {

    function meta_store_elements_get_auhtors() {

        $options = array();

        $users = get_users();

        foreach ($users as $user) {
            $options[$user->ID] = $user->display_name;
        }

        return $options;
    }

}

/** Get All Posts */
if (!function_exists('meta_store_elements_get_posts')) {

    function meta_store_elements_get_posts() {

        $post_list = get_posts(array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }

}

/** Get Woocommerce Categories */
if (!function_exists('meta_store_elements_get_woo_categories_list')) {

    function meta_store_elements_get_woo_categories_list() {
        $term_list = array('0' => __('Select Category', 'meta-store-elements'));

        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ));

        foreach ($terms as $term) {
            $term_list[$term->term_id] = $term->name;
        }

        return $term_list;
    }

}

/** Get Woocommerce Categories */
if (!function_exists('meta_store_elements_get_woo_categories')) {

    function meta_store_elements_get_woo_categories() {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ));

        foreach ($terms as $term) {
            $term_list[$term->term_id] = $term->name;
        }

        return $term_list;
    }

}

/** Get Sales Product List */
if (!function_exists('meta_store_elements_get_sales_products')) {

    function meta_store_elements_get_sales_products() {
        $product_list = array('0' => __('Select Product', 'meta-store-elements'));

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'OR',
                array(// Simple products type
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
                array(// Variable products type
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                )
            )
        );

        $products = get_posts($args);

        if (!empty($products)) {
            foreach ($products as $product) {
                $product_list[$product->ID] = $product->post_title;
            }
        }

        return $product_list;
    }

}

/** Menu List */
if (!function_exists('meta_store_elements_menulist')) {

    function meta_store_elements_menulist() {
        $menus = wp_get_nav_menus();

        $menu_list['none'] = esc_html__(' -- Select Menu -- ', 'meta-store');
        foreach ($menus as $menu) {
            $menu_list[$menu->slug] = $menu->name;
        }

        return $menu_list;
    }

}

if (!function_exists('meta_store_content_product')) {

    function meta_store_content_product($img_size = 'large') {
        ?>
        <li class="product">
            <div class="ms-product-block">
                <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                    <?php
                    $attachment_id = get_post_thumbnail_id(get_the_id());
                    $image = wp_get_attachment_image_src($attachment_id, $img_size);
                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', TRUE);
                    woocommerce_show_product_loop_sale_flash();
                    ?>
                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                </a>

                <div class="ms-woocommerce-product-info">
                    <h2 class="woocommerce-loop-product__title">
                        <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><?php the_title(); ?></a>
                    </h2>
                    <?php woocommerce_template_loop_price(); ?>
                    <div class="mesp-cart-button">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>    
            </div>
        </li><?php
    }

}