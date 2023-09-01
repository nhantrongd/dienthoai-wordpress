<?php
global $post;

if (!empty($post)) {
    $current_page_id = is_front_page() ? null : ($post ? $post->ID : null);

    if (class_exists('WooCommerce') && is_shop()) {
        $current_page_id = wc_get_page_id('shop');
    } else if (is_single() || is_front_page()) {
        $current_page_id = $post->ID;
    } else if (is_archive()) {
        $current_page_id = get_queried_object_id();
    } else if (is_home()) {
        $current_page_id = get_queried_object_id();
    }

    $current_archive = is_front_page() ? 'front' : ($post ? $post->post_type : get_queried_object()->name);
    $current_post_type = is_archive() ? null : $current_archive;

    $query = new WP_Query(array('post_type' => 'ultimate-woo-cart', 'posts_per_page' => -1));

    if ($query->have_posts()) :
        while ($query->have_posts()) :

            $query->the_post();

            $postid = get_the_ID();
            $majc_settings = get_post_meta($postid, 'uwcc_settings', true);

            if (!empty($majc_settings)) {

                WC()->cart->calculate_totals();
                WC()->cart->maybe_set_cart_cookies();

                // Main Settings
                $layout_type = 'slidein';

                $basket_position = isset($majc_settings['basket_position']) ? $majc_settings['basket_position'] : 'left-middle';
                if ($basket_position == 'left-top' || $basket_position == 'left-middle' || $basket_position == 'left-bottom') {
                    $basket_position_class = 'majc-position-left';
                } else if ($basket_position == 'right-top' || $basket_position == 'right-middle' || $basket_position == 'right-bottom') {
                    $basket_position_class = 'majc-position-right';
                }
                $cart_item_layout = isset($majc_settings['cart_item_layout']) ? $majc_settings['cart_item_layout'] : 'layout-1';
                $show_animation = isset($majc_settings['show_animation']) && $majc_settings['show_animation'] != 'none' ? $majc_settings['show_animation'] : '';
                $hide_animation = isset($majc_settings['hide_animation']) && $majc_settings['hide_animation'] != 'none' ? $majc_settings['hide_animation'] : '';
                $enable_overlay = isset($majc_settings['enable_overlay']) ? $majc_settings['enable_overlay'] : 'off';

                // Header Settings
                $header = isset($majc_settings['header']) ? $majc_settings['header'] : null;
                $header_title = isset($header['title_text']) ? $header['title_text'] : '';
                $header_icon_type = isset($header['icon_type']) ? $header['icon_type'] : 'default_icon';
                $header_available_icon = isset($header['available_icon']) ? $header['available_icon'] : null;
                $header_custom_icon = isset($header['custom_icon']) ? $header['custom_icon'] : null;
                $header_show_total_items = isset($header['show_cart_item_count']) ? $header['show_cart_item_count'] : 'off';

                // Buttons Settings
                $buttons = isset($majc_settings['buttons']) ? $majc_settings['buttons'] : null;
                $show_view_cart = isset($buttons['show_view_cart']) ? $buttons['show_view_cart'] : 'off';
                $show_checkout = isset($buttons['show_checkout']) ? $buttons['show_checkout'] : 'off';
                $show_continue_shopping = isset($buttons['show_continue_shopping']) ? $buttons['show_continue_shopping'] : 'off';
                $continue_shopping_link = isset($buttons['continue_shopping_link']) ? $buttons['continue_shopping_link'] : '#';
                $view_cart_text = isset($buttons['view_cart_label']) ? $buttons['view_cart_label'] : esc_html__('View Cart', 'mini-ajax-cart');
                $checkout_text = isset($buttons['checkout_label']) ? $buttons['checkout_label'] : esc_html__('View Checkout', 'mini-ajax-cart');
                $continue_shopping_text = isset($buttons['continue_shopping_label']) ? $buttons['continue_shopping_label'] : esc_html__('Continue Shopping', 'mini-ajax-cart');
                $shipping_text = isset($buttons['shipping_text']) ? $buttons['shipping_text'] : esc_html__('To find out your shipping cost , Please proceed to checkout.', 'mini-ajax-cart');

                // Coupon Settings
                $coupon = isset($majc_settings['coupon']) ? $majc_settings['coupon'] : null;
                $enable_coupon = isset($coupon['enable']) ? $coupon['enable'] : 'off';
                $apply_coupon_btn_text = isset($coupon['button_text']) ? $coupon['button_text'] : esc_html__('Apply Coupon', 'mini-ajax-cart');
                $promocode_placeholder = isset($coupon['promocode_placeholder']) ? $coupon['promocode_placeholder'] : esc_html__('Enter your promo code', 'mini-ajax-cart');

                // Cart Basket Settings
                $cart_basket = isset($majc_settings['cart_basket']) ? $majc_settings['cart_basket'] : null;
                $cart_basket_icon_type = isset($cart_basket['icon_type']) ? $cart_basket['icon_type'] : 'default_icon';
                $cart_basket_open_available_icon = isset($cart_basket['open_available_icon']) ? $cart_basket['open_available_icon'] : null;
                $cart_basket_open_custom_icon = isset($cart_basket['open_custom_icon']) ? $cart_basket['open_custom_icon'] : null;
                $cart_basket_close_available_icon = isset($cart_basket['close_available_icon']) ? $cart_basket['close_available_icon'] : null;
                $cart_basket_close_custom_icon = isset($cart_basket['close_custom_icon']) ? $cart_basket['close_custom_icon'] : null;
                $cart_basket_shape = isset($cart_basket['shape']) ? $cart_basket['shape'] : null;
                $cart_basket_product_count = isset($cart_basket['product_count']) ? $cart_basket['product_count'] : 'off';
                $cart_basket_hover_animation = isset($cart_basket['hover_animation']) && $cart_basket['hover_animation'] != 'none' ? $cart_basket['hover_animation'] : null;

                // Summary Settings
                $summary = isset($majc_settings['summary']) ? $majc_settings['summary'] : null;
                $hide_cart_total = isset($summary['hide_cart_total']) ? $summary['hide_cart_total'] : 'off';
                $hide_discount = isset($summary['hide_discount']) ? $summary['hide_discount'] : 'off';
                $hide_subtotal = isset($summary['hide_subtotal']) ? $summary['hide_subtotal'] : 'off';

                // Custom Settings
                $custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;

                // Display Settings
                $specific_pages = isset($majc_settings['display']['specific_pages']) && !empty($majc_settings['display']['specific_pages']) ? $majc_settings['display']['specific_pages'] : array();
                $display_condition = isset($majc_settings['display']['display_condition']) ? $majc_settings['display']['display_condition'] : null;
                $front_pages = isset($majc_settings['display']['front_pages']) ? $majc_settings['display']['front_pages'] : 'off';
                $blog_pages = isset($majc_settings['display']['blog_pages']) ? $majc_settings['display']['blog_pages'] : 'off';
                $error_pages = isset($majc_settings['display']['error_pages']) ? $majc_settings['display']['error_pages'] : 'off';
                $search_pages = isset($majc_settings['display']['search_pages']) ? $majc_settings['display']['search_pages'] : 'off';
                $archive_pages = isset($majc_settings['display']['archive_pages']) ? $majc_settings['display']['archive_pages'] : 'off';
                $enable_flymenu = isset($majc_settings['display']['enable_flying_cart']) ? $majc_settings['display']['enable_flying_cart'] : 'off';
                $cpt_pages = !empty($majc_settings['display']['cpt_pages']) ? $majc_settings['display']['cpt_pages'] : array();
                $specific_archive = !empty($majc_settings['display']['specific_archive']) ? $majc_settings['display']['specific_archive'] : array();
                $hide_screen = !empty($majc_settings['display']['hide_screen']) ? $majc_settings['display']['hide_screen'] : array();

                if ($enable_flymenu != 'on') {
                    continue;
                }

                $show = $this->hide_show_pages($current_page_id, $specific_pages, $display_condition, $front_pages, $blog_pages, $cpt_pages, $error_pages, $search_pages, $archive_pages, $current_post_type, $specific_archive, $current_archive);

                // Hide the fly menu if false
                if (!$show) {
                    continue;
                }

                $content_width = isset($majc_settings['content_width']) ? $majc_settings['content_width'] : 400;

                $wrapper_class = array(
                    'majc-main-wrapper',
                    'majc-main-wrapper-' . $postid,
                    'majc-layout-' . $layout_type,
                    'majc-' . $basket_position,
                    'majc-cartitem-' . $cart_item_layout,
                    $basket_position_class,
                    $hide_screen ? 'majc-hide-' . implode(' majc-hide-', $hide_screen) : ''
                );
                ?>

                <div id="majc-main-wrapper-<?php echo esc_attr($post->ID); ?>" class="<?php echo implode(' ', $wrapper_class) ?>" data-overlayenable="<?php echo ($enable_overlay == 'on') ? 'majc-overlay-enabled' : ''; ?>" data-pageid="<?php echo esc_attr($current_page_id); ?>">
                    <div class="majc-check-cart <?php echo esc_attr(WC()->cart->is_empty() ? 'majc-hide-cart-items' : ''); ?>"></div>
                    <div class="majc-main-inner-wrapper">
                        <div class="majc-toggle-button <?php echo esc_attr('majc-' . $cart_basket_shape); ?>">
                            <div class="majc-toggle-open-btn majc-cartbasket-toggle-btn <?php echo esc_attr($cart_basket_hover_animation); ?>">


                                <?php if (isset($cart_basket_icon_type) && $cart_basket_icon_type == 'available_icon') { ?>
                                    <span class="majc-cartbasket-icon majc-cartbasket-open-icon <?php echo esc_attr($cart_basket_open_available_icon); ?>"></span>
                                <?php } else if (isset($cart_basket_icon_type) && $cart_basket_icon_type == 'custom_icon') { ?>
                                    <div class="majc-cartbasket-img majc-cartbasket-icon majc-cartbasket-open-icon">
                                        <img src="<?php echo esc_url($cart_basket_open_custom_icon); ?>">
                                    </div>
                                <?php } else if (isset($cart_basket_icon_type) && $cart_basket_icon_type == 'default_icon') { ?>
                                    <span class="majc-cartbasket-icon majc-cartbasket-open-icon icon_cart_alt"></span>
                                <?php } ?>

                                <?php if (isset($cart_basket_icon_type) && $cart_basket_icon_type == 'available_icon') { ?>
                                    <span class="majc-cartbasket-icon majc-cartbasket-close-icon <?php echo esc_attr($cart_basket_close_available_icon); ?>"></span>
                                <?php } else if (isset($cart_basket_icon_type) && $cart_basket_icon_type == 'custom_icon') { ?>
                                    <div class="majc-cartbasket-img majc-cartbasket-icon majc-cartbasket-close-icon">
                                        <img src="<?php echo esc_url($cart_basket_close_custom_icon); ?>">
                                    </div>
                                <?php } else if (isset($cart_basket_icon_type) && $cart_basket_icon_type == 'default_icon') { ?>
                                    <span class="majc-cartbasket-icon majc-cartbasket-close-icon icon_close"></span>
                                <?php } ?>

                                <?php if ($cart_basket_product_count == 'on') { ?>
                                    <div class="majc-item-count-wrap">
                                        <span class="majc-cart-item-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <?php
                        if (!empty($show_animation) && !empty($hide_animation)) {
                            $majc_popup_class = 'majc-cartpop-animation-enabled majc-cartpop-both-animation-enabled';
                        } elseif (!empty($show_animation)) {
                            $majc_popup_class = 'majc-cartpop-animation-enabled majc-cartpop-show-animation-enabled';
                        } elseif (!empty($hide_animation)) {
                            $majc_popup_class = 'majc-cartpop-animation-enabled majc-cartpop-hide-animation-enabled';
                        } else {
                            $majc_popup_class = '';
                        }
                        ?>
                        <div class="majc-cart-popup <?php echo esc_attr($majc_popup_class); ?>" 
                        <?php if (!empty($show_animation)) { ?>
                                 data-showanimation="<?php echo 'animate--' . esc_attr($show_animation); ?>" 
                                 <?php
                             }
                             if (!empty($hide_animation)) {
                                 ?>
                                 data-hideanimation="<?php echo 'animate--' . esc_attr($hide_animation); ?>"
                             <?php } ?>
                             style="width:<?php echo $content_width ?>px">
                            <div class="majc-cart-popup-inner">

                                <div class="majc-header">
                                    <h2>
                                        <?php if (isset($header_icon_type) && $header_icon_type == 'available_icon') { ?>
                                            <div class="majc-header-icon"><span class="<?php echo esc_attr($header_available_icon); ?>"></span></div>
                                        <?php } else if (isset($header_icon_type) && $header_icon_type == 'custom_icon') { ?>
                                            <div class="majc-header-icon"><img src="<?php echo esc_url($header_custom_icon); ?>"></div>
                                        <?php } else if (isset($header_icon_type) && $header_icon_type == 'default_icon') { ?>
                                            <div class="majc-header-icon"><span class="fa fa-shopping-cart"></span></div>
                                        <?php } ?>
                                        <?php echo esc_html($header_title); ?>
                                    </h2>
                                    <?php if ($header_show_total_items == 'on') { ?>
                                        <div class="majc-sub-header">
                                            <span class="majc-cart-qty-count"><?php esc_html_e('Quantity: ', 'mini-ajax-cart'); ?><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                            <span class="majc-cart-items-count"><?php esc_html_e('Items: ', 'mini-ajax-cart'); ?><?php echo sizeof(WC()->cart->get_cart()); ?></span>
                                        </div>
                                    <?php } ?>
                                    <span class="majc-cart-close icofont-close-line"></span>
                                </div>

                                <div class="majc-body">
                                    <div class="majc-cart-item-wrap">
                                        <?php if (!WC()->cart->is_empty()) { ?>
                                            <div class="majc-mini-cart">
                                                <?php
                                                $items = WC()->cart->get_cart();
                                                foreach ($items as $itemKey => $itemVal) {
                                                    ?>
                                                    <div class="majc-cart-items" data-itemId="<?php echo esc_attr($itemVal['product_id']); ?>" data-cKey="<?php echo esc_attr($itemVal['key']); ?>">
                                                        <div class="majc-cart-items-inner">
                                                            <?php
                                                            $product = wc_get_product($itemVal['data']->get_id());
                                                            $product_id = apply_filters('woocommerce_cart_item_product_id', $itemVal['product_id'], $itemVal, $itemKey);
                                                            $getProductDetail = wc_get_product($itemVal['product_id']);
                                                            ?>
                                                            <div class="majc-item-img">
                                                                <?php echo $getProductDetail->get_image('thumbnail'); ?>
                                                            </div>

                                                            <div class="majc-item-desc">
                                                                <div class="majc-item-remove">
                                                                    <?php
                                                                    echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="majc-remove"  aria-label="%s" data-cart_item_id="%s" data-cart_item_sku="%s" data-cart_item_key="%s"><span class="icon_trash_alt"></span></a>', esc_url(wc_get_cart_remove_url($itemKey)), esc_html__('Remove this item', 'mini-ajax-cart'), esc_attr($product_id), esc_attr($product->get_sku()), esc_attr($itemKey)
                                                                            ), $itemKey);
                                                                    ?>
                                                                </div>

                                                                <div class="majc-item-name">
                                                                    <?php echo esc_html($product->get_name()); ?>
                                                                </div>

                                                                <div class="majc-item-qty">
                                                                    <span class="majc-qty-minus majc-qty-chng icon_minus-06"></span>

                                                                    <input type="number" class="majc-qty" step="1" min="0" max="14" value="<?php echo intval($itemVal['quantity']); ?>" placeholder="" inputmode="numeric">

                                                                    <span class="majc-qty-plus majc-qty-chng icon_plus"></span>
                                                                </div>

                                                                <div class="majc-item-price">
                                                                    <?php
                                                                    $wc_product = $itemVal['data'];
                                                                    echo WC()->cart->get_product_subtotal($wc_product, $itemVal['quantity']);
                                                                    ?>
                                                                </div>
                                                            </div> <!-- majc-item-desc -->
                                                        </div> <!-- majc-cart-items-inner -->
                                                    </div> <!-- majc-car-items -->
                                                    <?php
                                                } // product foreach loop ends
                                                ?>
                                            </div> <!-- majc-mini-cart -->
                                        <?php } else { ?>
                                            <div class="majc-empty-cart">
                                                <?php esc_html_e('The Cart is Empty', 'mini-ajax-cart'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="majc-empty-cart">
                                        <div class="majc-empty-cart-icon">
                                            <span class="mdi mdi-cart-arrow-down"></span>
                                        </div>
                                        <?php esc_html_e('No Porduct in the Cart!', 'mini-ajax-cart'); ?>
                                    </div>

                                    <!-- Coupons -->
                                    <?php if ($enable_coupon == 'on') { ?>
                                        <div class='majc-coupon'>

                                            <div class="majc-cpn-resp" style="display: none;"></div>

                                            <div class="majc-coupon-field">
                                                <input type="text" class="majc-coupon-code" placeholder="<?php echo esc_attr($promocode_placeholder); ?>">
                                                <button class="majc-coupon-submit majc-button"><?php echo esc_html($apply_coupon_btn_text); ?></button>
                                            </div>

                                            <?php
                                            $applied_coupons = WC()->cart->get_applied_coupons();

                                            if (!empty($applied_coupons)) {
                                                ?>
                                                <ul class='majc-applied-cpns'>
                                                    <?php foreach ($applied_coupons as $cpns) { ?>    
                                                        <li data-code='<?php echo esc_attr($cpns); ?>'>
                                                            <?php echo esc_html($cpns); ?><span class='majc-remove-cpn icofont-close-line'></span>
                                                        </li>
                                                    <?php } ?>    
                                                </ul>
                                                <?php
                                            } else {
                                                echo '<ul class="majc-applied-cpns" style="display: none;"><li></li></ul>';
                                            }
                                            ?>
                                        </div>
                                    <?php } ?>

                                    <!-- Summary -->
                                    <div class="majc-buy-summary">

                                        <?php if ($hide_cart_total != 'on') { ?>
                                            <div class="majc-cart-total-wrap">
                                                <label><?php echo esc_html__('Cart Total', 'mini-ajax-cart'); ?></label>
                                                <div class="majc-cart-total-amount"><?php echo wc_price(WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax()); ?></div>
                                            </div>
                                        <?php } ?>

                                        <?php if ($hide_discount != 'on') { ?>
                                            <div class="majc-cart-discount-wrap">
                                                <label><?php echo esc_html__('Discount', 'mini-ajax-cart'); ?></label>
                                                <div class="majc-cart-discount-amount"><?php echo wc_price(WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total()); ?></div>
                                            </div>
                                        <?php } ?>

                                        <?php if ($hide_subtotal != 'on') { ?>
                                            <div class='majc-cart-subtotal-wrap'>
                                                <?php
                                                $get_totals = WC()->cart->get_totals();
                                                $cart_total = $get_totals['subtotal'];
                                                $cart_discount = $get_totals['discount_total'];
                                                $final_subtotal = $cart_total - $cart_discount;
                                                ?>
                                                <label class='majc-total-label'><?php echo esc_html__('Subtotal', 'mini-ajax-cart'); ?></label>

                                                <div class='majc-subtotal-amount'>
                                                    <?php echo get_woocommerce_currency_symbol() . number_format($final_subtotal, 2); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="majc-cart-action-btn-wrap">
                                        <?php if (trim($shipping_text)) { ?>
                                            <p><?php echo esc_html($shipping_text); ?></p>
                                        <?php } ?>

                                        <?php if ($show_continue_shopping == 'on') { ?>
                                            <a class="majc-continue-shoping-btn majc-cart-action-btn majc-button" href="<?php echo esc_url($continue_shopping_link); ?>" >
                                                <?php echo esc_html($continue_shopping_text); ?>
                                            </a>
                                        <?php } ?>

                                        <div class="majc-cart-checkout-btn">
                                            <?php if ($show_view_cart == 'on') { ?>
                                                <a class="majc-view-cart-btn majc-cart-action-btn majc-button" href="<?php echo wc_get_cart_url(); ?>">
                                                    <?php echo esc_html($view_cart_text); ?>
                                                </a>
                                            <?php } ?>

                                            <?php if ($show_checkout == 'on') { ?>
                                                <a class="majc-checkout-btn majc-cart-action-btn majc-button" href="<?php echo wc_get_checkout_url(); ?>">
                                                    <?php echo esc_html($checkout_text); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div> <!-- majc-footer -->
                                </div> <!-- majc-body -->

                            </div> <!-- majc-cart-popup-inner -->
                        </div> <!-- majc-cart-popup -->
                    </div> <!-- majc-main-inner-wrap -->

                    <div class="majc-main-wrapper-bg"></div>
                </div> <!-- majc-main-wrapper -->
                <?php
                // Custom CSS
                include MAJC_PATH . '/inc/frontend/custom-css.php';
            } //Not empty $majc_settings
        endwhile;
        wp_reset_postdata();
    endif;
}
?>