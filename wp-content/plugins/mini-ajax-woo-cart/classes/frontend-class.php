<?php
defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Frontend')) {

    class MAJC_Frontend extends MAJC_Library {

        function __construct() {

            add_action('wp_footer', array($this, 'majc_menu'));

            add_filter('woocommerce_add_to_cart_fragments', array($this, 'add_to_cart_fragments'), 10, 1);

            // Change The Quantiy of the Woocommerce Product
            add_action('wp_ajax_change_item_qty', array($this, 'change_item_qty'));
            add_action('wp_ajax_nopriv_change_item_qty', array($this, 'change_item_qty'));

            add_action('wp_ajax_add_coupon_code', array($this, 'addCouponCode'));
            add_action('wp_ajax_nopriv_add_coupon_code', array($this, 'addCouponCode'));

            add_action('wp_ajax_remove_coupon_code', array($this, 'remove_coupon_code'));
            add_action('wp_ajax_nopriv_remove_coupon_code', array($this, 'remove_coupon_code'));

            add_action('wp_ajax_get_refresh_fragments', array($this, 'get_refreshed_fragments'));
            add_action('wp_ajax_nopriv_get_refresh_fragments', array($this, 'get_refreshed_fragments'));

            add_action('wp_ajax_remove_item', array($this, 'cart_remove_item'));
            add_action('wp_ajax_nopriv_remove_item', array($this, 'cart_remove_item'));

            // Prevent Refresh from Adding Another Product in WooCommerce
            add_action('woocommerce_add_to_cart_redirect', array($this, 'prevent_add_to_cart_on_redirect'));
        }

        private function checkNonce() {
            if (isset($_POST['wp_nonce']) && wp_verify_nonce($_POST['wp_nonce'], 'majc-frontend-ajax-nonce')) {
                return 'true';
            } else {
                return 'false';
            }
        }

        function prevent_add_to_cart_on_redirect($url = false) {
            if (!empty($url)) {
                return $url;
            }

            return add_query_arg(array(), remove_query_arg('add-to-cart'));
        }

        function change_item_qty() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            $c_key = isset($_REQUEST['ckey']) ? sanitize_text_field($_REQUEST['ckey']) : null;
            $qty = isset($_REQUEST['qty']) ? sanitize_text_field($_REQUEST['qty']) : null;
            WC()->cart->set_quantity($c_key, $qty, true);
            WC()->cart->set_session();
            die();
        }

        public function remove_coupon_code() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            $couponCode = isset($_POST['couponCode']) ? sanitize_text_field($_POST['couponCode']) : null;

            if (WC()->cart->remove_coupon($couponCode)) {
                esc_html_e('Coupon Removed Successfully.', 'mini-ajax-cart');
            }

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            WC()->cart->set_session();

            die();
        }

        public function addCouponResponse($response) {
            header('Content-Type: application/json');
            echo json_encode($response);

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            WC()->cart->set_session();
        }

        public function addCouponCode() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            $code = isset($_POST['couponCode']) ? sanitize_text_field($_POST['couponCode']) : null;
            $code = strtolower($code);

            /* Check if coupon code is empty */
            if (empty($code) || !isset($code)) {

                $response = array(
                    'result' => 'empty',
                    'msg' => esc_html__('Coupon Code Field is Empty!', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);

                exit();
            }

            /* Create an instance of WC_Coupon with our code */
            $coupon = new WC_Coupon($code);
            $applied_coupons = WC()->cart->get_applied_coupons();

            if (in_array($code, $applied_coupons)) {

                $response = array(
                    'result' => 'already applied',
                    'msg' => esc_html__('Coupon Code Already Applied.', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);
            } else if (!$coupon->is_valid()) {

                $response = array(
                    'result' => 'not valid',
                    'msg' => esc_html__('Invalid code entered. Please try again.', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);
            } else {

                WC()->cart->apply_coupon($code);

                $response = array(
                    'result' => 'success',
                    'msg' => esc_html__('Coupon Applied Successfully.', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);

                wc_clear_notices();
            }
            die();
        }

        public function add_to_cart_fragments($fragments) {
            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            global $woocommerce;
            ob_start();
            ?>
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

                                        <div class="majc-item-price">
                                            <?php
                                            $wc_product = $itemVal['data'];
                                            echo WC()->cart->get_product_subtotal($wc_product, $itemVal['quantity']);
                                            ?>
                                        </div>

                                        <div class="majc-item-qty">
                                            <span class="majc-qty-minus majc-qty-chng icon_minus-06"></span>

                                            <input type="number" name="majc-qty-input" class="majc-qty" step="1" min="0" max="14" value="<?php echo intval($itemVal['quantity']); ?>" placeholder="" inputmode="numeric">

                                            <span class="majc-qty-plus majc-qty-chng icon_plus"></span>
                                        </div>
                                    </div> <!-- majc-item-desc -->
                                </div> <!-- majc-cart-items-inner -->
                            </div> <!-- majc-cart-items -->
                            <?php
                        } // product foreach loop ends
                        ?>
                    </div> 
                <?php } ?>
            </div>
            <?php
            $cart_body_contents = ob_get_clean();
            $fragments['div.majc-cart-item-wrap'] = $cart_body_contents;

            // Update subtotal Amount
            $get_totals = WC()->cart->get_totals();
            $cart_total = $get_totals['subtotal'];
            $cart_discount = $get_totals['discount_total'];
            $final_subtotal = $cart_total - $cart_discount;
            $subtotal = "<div class='majc-subtotal-amount'>" . get_woocommerce_currency_symbol() . number_format($final_subtotal, 2) . "</div>";
            $fragments['div.majc-subtotal-amount'] = $subtotal;

            // Update Total Amount
            $cartTotal = '<div class="majc-cart-total-amount">' . wc_price(WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax()) . '</div>';
            $fragments['div.majc-cart-total-amount'] = $cartTotal;

            // Update Discount Amount
            $discountTotal = '<div class="majc-cart-discount-amount">' . wc_price(WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total()) . '</div>';
            $fragments['div.majc-cart-discount-amount'] = $discountTotal;

            $fragments['.majc-check-cart'] = WC()->cart->is_empty() ? '<div class="majc-check-cart majc-hide-cart-items"></div>' : '<div class="majc-check-cart"></div>';

            // Update Applied Coupon
            $applied_coupons = WC()->cart->get_applied_coupons();
            ob_start();
            if (!empty($applied_coupons)) {
                ?>

                <ul class='majc-applied-cpns'>
                    <?php foreach ($applied_coupons as $cpns) { ?>
                        <li data-code='<?php echo esc_attr($cpns); ?>'><?php echo esc_attr($cpns); ?> <span class='majc-remove-cpn icofont-close-line'></span></li>
                        <?php } ?>
                </ul>
                <?php
            } else {
                echo '<ul class="majc-applied-cpns" style="display: none;"><li></li></ul>';
            }
            $cart_cpn = ob_get_clean();
            $fragments['ul.majc-applied-cpns'] = $cart_cpn;

            // Update the Items Count In the Cart
            $fragments['.majc-cart-qty-count'] = '<span class="majc-cart-qty-count">' . esc_html__('Quantity: ', 'mini-ajax-cart') . WC()->cart->get_cart_contents_count() . '</span>';
            $fragments['.majc-cart-items-count'] = '<span class="majc-cart-items-count">' . esc_html__('Items: ', 'mini-ajax-cart') . sizeof(WC()->cart->get_cart()) . '</span>';

            // Cart Basket Items Count
            $fragments['.majc-item-count-wrap .majc-cart-item-count'] = '<span class="majc-cart-item-count">' . WC()->cart->get_cart_contents_count() . '</span>';

            return $fragments;
        }

        public function majc_menu() {
            if (!(defined('REST_REQUEST') && REST_REQUEST)) {
                include MAJC_PATH . '/inc/frontend/front.php';
            }
        }

        public function get_refreshed_fragments() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            WC_AJAX::get_refreshed_fragments();
        }

        public function cart_remove_item() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            ob_start();
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                if ($cart_item['product_id'] == $_POST['cart_item_id'] && $cart_item_key == $_POST['cart_item_key']) {
                    WC()->cart->remove_cart_item($cart_item_key);
                }
            }

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();

            woocommerce_mini_cart();

            $mini_cart = ob_get_clean();

            // Fragments and mini cart are returned
            $data = array(
                'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array(
                    'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
                        )
                ),
                'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
            );

            wp_send_json($data);

            die();
        }

        public static function hide_show_pages($pageid, $specific_page, $hide_show, $front, $blog, $cpt, $error, $search, $archive, $posttype, $specific_archive, $current_archive) {
            $show = true;

            switch ($hide_show) {
                case 'show_all':
                    $show = true;
                    break;

                case 'hide_all':
                    $show = false;
                    break;

                case 'show_selected':
                    $show = false;
                    if (in_array($pageid, $specific_page)) {
                        $show = true;
                    }
                    if (is_singular() && !is_archive() && in_array($posttype, $cpt)) {
                        $show = true;
                    }
                    if ($front == 'on' && ('front' == $current_archive)) {
                        $show = true;
                    }
                    if ($blog == 'on' && ('front' == $current_archive)) {
                        $show = true;
                    }
                    if ($error == 'on' && is_404()) {
                        $show = true;
                    }
                    if ($search == 'on' && is_search()) {
                        $show = true;
                    }
                    if ($archive == 'on' && is_archive()) {
                        $show = true;
                    }
                    if ($archive == 'on' && ('post' == $current_archive && !is_singular())) {
                        $show = true;
                    }
                    if (!is_singular() && in_array($current_archive, $specific_archive)) {
                        $show = true;
                    }
                    break;

                case 'hide_selected':
                    $show = true;
                    if (is_singular() && !is_archive() && in_array($posttype, $cpt)) {
                        $show = false;
                    }
                    if (in_array($pageid, $specific_page)) {
                        $show = false;
                    }
                    if ($front == 'on' && ('front' == $current_archive)) {
                        $show = false;
                    }
                    if ($blog == 'on' && ('front' == $current_archive)) {
                        $show = false;
                    }
                    if ($error == 'on' && is_404()) {
                        $show = false;
                    }
                    if ($search == 'on' && is_search()) {
                        $show = false;
                    }
                    if ($archive == 'on' && ('post' == $current_archive && !is_singular())) {
                        $show = false;
                    }
                    if (!is_singular() && in_array($current_archive, $specific_archive)) {
                        $show = false;
                    }
                    break;
            }
            return $show;
        }

    }

    new MAJC_Frontend();
}