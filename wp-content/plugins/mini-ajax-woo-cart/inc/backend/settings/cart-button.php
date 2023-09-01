<div id="cart-button" class="tab-content" style="display:none">
    <h2><?php esc_html_e('Cart Basket/Button Settings', 'mini-ajax-cart'); ?></h2>
    <div class="majc-settings-row">
        <label><?php esc_html_e('Icon', 'mini-ajax-cart'); ?></label>

        <div class="majc-settings-fields">
            <div class="majc-settings-list-row">
                <div class="majc-settings-list">
                    <label>Choose Icon Type</label>
                    <select name="majc_settings[cart_basket][icon_type]" data-condition="toggle" id="majc-icon-type">
                        <option value="default_icon" <?php
                        if (isset($cart_basket['icon_type'])) {
                            selected($cart_basket['icon_type'], 'default_icon');
                        }
                        ?>><?php esc_html_e('Default Icon', 'mini-ajax-cart'); ?></option>
                        <option value="available_icon" <?php
                        if (isset($cart_basket['icon_type'])) {
                            selected($cart_basket['icon_type'], 'available_icon');
                        }
                        ?>><?php esc_html_e('Available Icon', 'mini-ajax-cart'); ?></option>
                        <option value="custom_icon" <?php
                        if (isset($cart_basket['icon_type'])) {
                            selected($cart_basket['icon_type'], 'custom_icon');
                        }
                        ?>><?php esc_html_e('Custom Icon', 'mini-ajax-cart'); ?></option>
                    </select>
                </div>

                <div class="majc-settings-list" data-condition-toggle="majc-icon-type" data-condition-val="available_icon">
                    <ul class="majc-two-column-row">
                        <li class="majc-settings-list">
                            <label for="majc_floatmenu_default_icon"><?php esc_html_e('Choose Open Icon', 'mini-ajax-cart'); ?></label>
                            <?php
                            $inputName = 'majc_settings[cart_basket][open_available_icon]';
                            $iconName = isset($cart_basket['open_available_icon']) ? $cart_basket['open_available_icon'] : null; //icon value from db
                            $this->icon_field($inputName, $iconName);
                            ?>
                        </li>
                        <li class="majc-settings-list">
                            <label for="majc_floatmenu_default_icon"><?php esc_html_e('Choose Close Icon', 'mini-ajax-cart'); ?></label>
                            <?php
                            $inputName = 'majc_settings[cart_basket][close_available_icon]';
                            $iconName = isset($cart_basket['close_available_icon']) ? $cart_basket['close_available_icon'] : null; //icon value from db
                            $this->icon_field($inputName, $iconName);
                            ?>
                        </li>
                    </ul>
                </div>

                <div class="majc-settings-list" data-condition-toggle="majc-icon-type" data-condition-val="custom_icon">
                    <ul class="majc-two-column-row">
                        <li class="majc-settings-list">
                            <label for="majc-header-icon"><?php esc_html_e('Upload Open Icon', 'mini-ajax-cart'); ?></label>
                            <div class="majc-icon-image-uploader">
                                <div class="majc-custom-img-icon-btn">
                                    <div class="majc-custom-menu-image-icon current-bg-image" >
                                        <?php if (isset($cart_basket['open_custom_icon']) && !empty($cart_basket['open_custom_icon'])) { ?>
                                            <img src="<?php echo isset($cart_basket['open_custom_icon']) ? esc_url($cart_basket['open_custom_icon']) : ''; ?>"/>
                                        <?php } ?>
                                    </div>
                                    <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                                </div>

                                <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                                <input type="hidden" class="majc-upload-background-url" name="majc_settings[cart_basket][open_custom_icon]" id="majc-header-icon" value="<?php echo isset($cart_basket['open_custom_icon']) ? esc_url($cart_basket['open_custom_icon']) : ''; ?>"/>
                            </div> <!-- majc-icon-image-uploader -->
                        </li>
                        <li class="majc-settings-list">
                            <label for="majc-header-icon"><?php esc_html_e('Upload Close Icon', 'mini-ajax-cart'); ?></label>
                            <div class="majc-icon-image-uploader">
                                <div class="majc-custom-img-icon-btn">
                                    <div class="majc-custom-menu-image-icon current-bg-image" >
                                        <?php if (isset($cart_basket['close_custom_icon']) && !empty($cart_basket['close_custom_icon'])) { ?>
                                            <img src="<?php echo isset($cart_basket['close_custom_icon']) ? esc_url($cart_basket['close_custom_icon']) : ''; ?>"/>
                                        <?php } ?>
                                    </div>
                                    <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                                </div>
                                <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                                <input type="hidden" class="majc-upload-background-url" name="majc_settings[cart_basket][close_custom_icon]" id="majc-header-icon" value="<?php echo isset($cart_basket['close_custom_icon']) ? esc_url($cart_basket['close_custom_icon']) : ''; ?>"/>
                            </div> <!-- majc-icon-image-uploader -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Button Shape', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields">
            <select name="majc_settings[cart_basket][shape]">
                <option value="round" <?php
                if (isset($cart_basket['shape'])) {
                    selected($cart_basket['shape'], 'round');
                }
                ?>><?php esc_html_e('Round', 'mini-ajax-cart'); ?></option>
                <option value="square" <?php
                if (isset($cart_basket['shape'])) {
                    selected($cart_basket['shape'], 'square');
                }
                ?>><?php esc_html_e('Square', 'mini-ajax-cart'); ?></option>
                <option value="rounded_square" <?php
                if (isset($cart_basket['shape'])) {
                    selected($cart_basket['shape'], 'rounded_square');
                }
                ?>><?php esc_html_e('Rounded Square', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Button Position', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields">
            <select name="majc_settings[basket_position]">
                <option value="left-middle" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'left-middle');
                }
                ?>><?php esc_html_e('Left Middle', 'mini-ajax-cart'); ?></option>
                <option value="right-middle" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'right-middle');
                }
                ?>><?php esc_html_e('Right Middle', 'mini-ajax-cart'); ?></option>
                <option disabled value="" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'left-top');
                }
                ?>><?php esc_html_e('Left Top (Pro)', 'mini-ajax-cart'); ?></option>
                <option disabled value="" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'left-bottom');
                }
                ?>><?php esc_html_e('Left Bottom (Pro)', 'mini-ajax-cart'); ?></option>
                <option disabled value="" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'right-top');
                }
                ?>><?php esc_html_e('Right Top (Pro)', 'mini-ajax-cart'); ?></option>
                <option disabled value="" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'right-bottom');
                }
                ?>><?php esc_html_e('Right Bottom (Pro)', 'mini-ajax-cart'); ?></option>
                <option disabled value="" <?php
                if (isset($majc_settings['basket_position'])) {
                    selected($majc_settings['basket_position'], 'center-bottom');
                }
                ?>><?php esc_html_e('Center Bottom (Pro)', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_attr_e('Hover Animation', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-fields">
            <select name="majc_settings[cart_basket][hover_animation]">
                <option value="none"><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                <?php foreach ($animations['hover_animation'] as $type => $type_array): ?>
                    <optgroup label="<?php echo esc_attr($type) ?>">
                        <?php foreach ($type_array as $key => $value): ?>
                            <option value="<?php echo esc_attr($value) ?>" <?php
                            if (isset($majc_settings['cart_basket']['hover_animation'])) {
                                selected($majc_settings['cart_basket']['hover_animation'], $value);
                            }
                            ?>><?php echo esc_attr($key) ?></option>
                                <?php endforeach ?>
                    </optgroup>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Show Product Counter', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[cart_basket][product_count]" <?php
            if (isset($cart_basket['product_count'])) {
                checked($cart_basket['product_count'], 'on', true);
            }
            ?>>
            <p class="majc-desc"><?php echo esc_html__('Displays at the side of Basket/Button', 'mini-ajax-cart'); ?></p>
        </div>
    </div>
</div>