<div id="cart-content" class="tab-content" style="display:none">
    <h2><?php esc_html_e('Configure Cart Content', 'mini-ajax-cart'); ?></h2>

    <div class="majc-submenu">
        <div class="majc-submenu-tab majc-tab-active" data-tab="majc-header-sub-section"><?php esc_html_e('Header', 'mini-ajax-cart'); ?></div>
        <div class="majc-submenu-tab" data-tab="majc-cart-items-sub-section"><?php esc_html_e('Cart Products', 'mini-ajax-cart'); ?></div>
        <div class="majc-submenu-tab" data-tab="majc-coupon-sub-section"><?php esc_html_e('Coupon', 'mini-ajax-cart'); ?></div>
        <div class="majc-submenu-tab" data-tab="majc-button-sub-section"><?php esc_html_e('Buttons', 'mini-ajax-cart'); ?></div>
    </div>

    <div class="majc-submenu-content">
        <div class="majc-submenu-section" id="majc-header-sub-section">
            <h2><?php esc_html_e('Header Section', 'mini-ajax-cart'); ?></h2>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Header Title Text', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <input type="text" name="majc_settings[header][title_text]" value="<?php echo isset($header['title_text']) ? esc_attr($header['title_text']) : null; ?>">
                </div>	
            </div>	

            <div class="majc-settings-row">
                <label><?php esc_html_e('Header Icon Type', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <div class="majc-settings-list-row">
                        <div class="majc-settings-list">
                            <select name="majc_settings[header][icon_type]" data-condition="toggle" id="majc-header-icon-type">
                                <option value="none" <?php
                                if (isset($header['icon_type'])) {
                                    selected($header['icon_type'], 'none');
                                }
                                ?>><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                                <option value="default_icon" <?php
                                if (isset($header['icon_type'])) {
                                    selected($header['icon_type'], 'default_icon');
                                }
                                ?>><?php esc_html_e('Default Icon', 'mini-ajax-cart'); ?></option>
                                <option value="available_icon" <?php
                                if (isset($header['icon_type'])) {
                                    selected($header['icon_type'], 'available_icon');
                                }
                                ?>><?php esc_html_e('Available Icon', 'mini-ajax-cart'); ?></option>
                                <option value="custom_icon" <?php
                                if (isset($header['icon_type'])) {
                                    selected($header['icon_type'], 'custom_icon');
                                }
                                ?>><?php esc_html_e('Custom Icon', 'mini-ajax-cart'); ?></option>
                            </select>
                        </div>

                        <div class="majc-settings-list" data-condition-toggle="majc-header-icon-type" data-condition-val="available_icon">
                            <label for="majc_floatmenu_default_icon"><?php esc_html_e('Choose Header Icon', 'mini-ajax-cart'); ?></label>
                            <?php
                            $inputName = 'majc_settings[header][available_icon]';
                            $iconName = isset($header['available_icon']) ? $header['available_icon'] : null; //icon value from db
                            $this->icon_field($inputName, $iconName);
                            ?>
                        </div>

                        <div class="majc-settings-list" data-condition-toggle="majc-header-icon-type" data-condition-val="custom_icon">
                            <label for="majc-header-icon"><?php esc_html_e('Upload Header Icon', 'mini-ajax-cart'); ?></label>
                            <div class="majc-icon-image-uploader">
                                <div class="majc-custom-img-icon-btn">
                                    <div class="majc-custom-menu-image-icon current-bg-image" >
                                        <?php if (isset($header['custom_icon']) && !empty($header['custom_icon'])) { ?>
                                            <img src="<?php echo isset($header['custom_icon']) ? esc_url($header['custom_icon']) : ''; ?>"/>
                                        <?php } ?>
                                    </div>
                                    <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                                </div>

                                <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                                <input type="hidden" class="majc-upload-background-url" name="majc_settings[header][custom_icon]" id="majc-header-icon" value="<?php echo isset($header['custom_icon']) ? esc_url($header['custom_icon']) : ''; ?>"/>
                            </div> <!-- majc-icon-image-uploader -->
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="majc-submenu-section" id="majc-cart-items-sub-section" style="display: none">
            <h2><?php esc_html_e('Added to Cart Product Section', 'mini-ajax-cart'); ?></h2>
            <div class="majc-settings-row">
                <label><?php esc_html_e('Products Layout', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <select name="majc_settings[cart_item_layout]">
                        <option value="list" <?php
                        if (isset($majc_settings['cart_item_layout'])) {
                            selected($majc_settings['cart_item_layout'], 'list');
                        }
                        ?>><?php esc_html_e('List', 'mini-ajax-cart'); ?></option>\
                        <option value="grid" <?php
                        if (isset($majc_settings['cart_item_layout'])) {
                            selected($majc_settings['cart_item_layout'], 'grid');
                        }
                        ?>><?php esc_html_e('Grid', 'mini-ajax-cart'); ?></option>
                    </select>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Show Cart Quantity & Items', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields majc-toggle-input-field">
                    <input type="checkbox" name="majc_settings[header][show_cart_item_count]" <?php
                    if (isset($header['show_cart_item_count'])) {
                        checked($header['show_cart_item_count'], 'on', true);
                    }
                    ?>>
                </div>
            </div>
        </div>

        <div class="majc-submenu-section" id="majc-coupon-sub-section" style="display: none">
            <h2><?php esc_html_e('Coupon Code Section', 'mini-ajax-cart'); ?></h2>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Enable Coupon Field', 'mini-ajax-cart'); ?></label>

                <div class="majc-settings-fields majc-toggle-input-field">
                    <input type="checkbox" name="majc_settings[coupon][enable]" <?php
                    if (isset($coupon['enable'])) {
                        checked($coupon['enable'], 'on', true);
                    }
                    ?> data-condition="toggle" id="majc-enable-coupon">
                </div>
            </div>

            <div class="majc-settings-row" data-condition-toggle="majc-enable-coupon">
                <label><?php esc_html_e('Apply Coupon Button Label', 'mini-ajax-cart'); ?></label>

                <div class="majc-settings-fields">
                    <input type="text" name="majc_settings[coupon][button_text]" value="<?php echo isset($coupon['button_text']) ? esc_html($coupon['button_text']) : null; ?>">
                </div>
            </div>

            <div class="majc-settings-row" data-condition-toggle="majc-enable-coupon">
                <label><?php esc_html_e('Promo Code Placeholder', 'mini-ajax-cart'); ?></label>

                <div class="majc-settings-fields">
                    <input type="text" name="majc_settings[coupon][promocode_placeholder]" value="<?php echo isset($coupon['promocode_placeholder']) ? esc_html($coupon['promocode_placeholder']) : null; ?>">
                </div>
            </div>
        </div>

        <div class="majc-submenu-section" id="majc-button-sub-section" style="display: none">
            <h2><?php esc_html_e('View Cart, Checkout & Continue Shopping Buttons', 'mini-ajax-cart'); ?></h2>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Cart Button', 'mini-ajax-cart'); ?></label>

                <div class="majc-settings-fields">
                    <div class="majc-settings-list-row">
                        <div class="majc-settings-list">
                            <label><?php esc_html_e('Show View Cart Button', 'mini-ajax-cart'); ?></label>
                            <div class="majc-toggle-input-field">
                                <input type="checkbox" name="majc_settings[buttons][show_view_cart]" <?php
                                if (isset($buttons['show_view_cart'])) {
                                    checked($buttons['show_view_cart'], 'on', true);
                                }
                                ?> data-condition="toggle" id="majc-show-cart-button">
                            </div>
                        </div>

                        <div class="majc-settings-list" data-condition-toggle="majc-show-cart-button">
                            <label><?php esc_html_e('View Cart Label', 'mini-ajax-cart'); ?></label>
                            <input type="text" name="majc_settings[buttons][view_cart_label]" value="<?php echo isset($buttons['view_cart_label']) ? esc_html($buttons['view_cart_label']) : esc_html__('View Cart', 'mini-ajax-cart'); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Checkout Button', 'mini-ajax-cart'); ?></label>

                <div class="majc-settings-fields">
                    <div class="majc-settings-list-row">
                        <div class="majc-settings-list">
                            <label><?php esc_html_e('Show Checkout Button', 'mini-ajax-cart'); ?></label>
                            <div class="majc-toggle-input-field">
                                <input type="checkbox" name="majc_settings[buttons][show_checkout]" <?php
                                if (isset($buttons['show_checkout'])) {
                                    checked($buttons['show_checkout'], 'on', true);
                                }
                                ?> data-condition="toggle" id="majc-show-checkout-button">
                            </div>
                        </div>

                        <div class="majc-settings-list" data-condition-toggle="majc-show-checkout-button">
                            <label><?php esc_html_e('View Checkout Label', 'mini-ajax-cart'); ?></label>
                            <input type="text" name="majc_settings[buttons][checkout_label]" value="<?php echo isset($buttons['checkout_label']) ? esc_html($buttons['checkout_label']) : esc_html__('View Checkout', 'mini-ajax-cart'); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Continue Button', 'mini-ajax-cart'); ?></label>

                <div class="majc-settings-fields">
                    <div class="majc-settings-list-row">
                        <div class="majc-settings-list">
                            <label><?php esc_html_e('Show Continue Shopping Button', 'mini-ajax-cart'); ?></label>
                            <div class="majc-toggle-input-field">
                                <input type="checkbox" name="majc_settings[buttons][show_continue_shopping]" <?php
                                if (isset($buttons['show_continue_shopping'])) {
                                    checked($buttons['show_continue_shopping'], 'on', true);
                                }
                                ?> data-condition="toggle" id="majc-show-shopping-button">
                            </div>
                        </div>

                        <div class="majc-settings-list" data-condition-toggle="majc-show-shopping-button">
                            <label><?php esc_html_e('View Continue Shopping Label', 'mini-ajax-cart'); ?></label>
                            <input type="text" name="majc_settings[buttons][continue_shopping_label]" value="<?php echo isset($buttons['continue_shopping_label']) ? esc_html($buttons['continue_shopping_label']) : esc_html__('Continue Shopping', 'mini-ajax-cart'); ?>">
                        </div>

                        <div class="majc-settings-list" data-condition-toggle="majc-show-shopping-button">
                            <label><?php esc_html_e('Continue Shopping Link', 'mini-ajax-cart'); ?></label>
                            <input type="text" name="majc_settings[buttons][continue_shopping_link]" value="<?php echo isset($buttons['continue_shopping_link']) ? esc_url($buttons['continue_shopping_link']) : ""; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Shipping Text Label', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <input type="text" name="majc_settings[buttons][shipping_text]" value="<?php echo isset($buttons['shipping_text']) ? esc_html($buttons['shipping_text']) : null; ?>">
                    <p class="majc-desc"><?php esc_html_e('It will appear just above buttons.', 'mini-ajax-cart'); ?></p>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Hide Cart Total', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields majc-toggle-input-field">
                    <input type="checkbox" name="majc_settings[summary][hide_cart_total]" <?php
                    if (isset($summary['hide_cart_total'])) {
                        checked($summary['hide_cart_total'], 'on', true);
                    }
                    ?>>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Hide Discount', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields majc-toggle-input-field">
                    <input type="checkbox" name="majc_settings[summary][hide_discount]" <?php
                    if (isset($summary['hide_discount'])) {
                        checked($summary['hide_discount'], 'on', true);
                    }
                    ?>>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Hide Subtotal', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields majc-toggle-input-field">
                    <input type="checkbox" name="majc_settings[summary][hide_subtotal]" <?php
                    if (isset($summary['hide_subtotal'])) {
                        checked($summary['hide_subtotal'], 'on', true);
                    }
                    ?>>
                </div>
            </div>
        </div>
    </div>
</div>