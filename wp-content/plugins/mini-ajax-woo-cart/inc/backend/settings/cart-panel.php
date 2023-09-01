<div id="cart-panel" class="tab-content" style="display:none">
    <h2><?php esc_html_e('Cart Panel Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Layout', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields">
            <select name="majc_settings[layout_type]" class="layout_type">			
                <option value="slidein" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'slidein');
                }
                ?>><?php esc_html_e('Slide In', 'mini-ajax-cart'); ?></option>
                <option disabled value="floating" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'floating');
                }
                ?>><?php esc_html_e('Floating (Available in Pro)', 'mini-ajax-cart'); ?></option>
                <option disabled value="popup" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'popup');
                }
                ?>><?php esc_html_e('Popup (Available in Pro)', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_attr_e('Animation', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-fields">
            <ul class="majc-two-column-row">
                <li>
                    <label><?php esc_attr_e('Show Animation', 'mini-ajax-cart') ?></label>
                    <select name="majc_settings[show_animation]">
                        <option value="none"><?php esc_html_e('Default', 'mini-ajax-cart'); ?></option>
                        <?php foreach ($animations['show_animation'] as $key => $key_array): ?>
                            <optgroup label="<?php echo esc_attr($key) ?>">
                                <?php foreach ($key_array as $value): ?>
                                    <option value="<?php echo esc_attr($value) ?>" <?php
                                    if (isset($majc_settings['show_animation'])) {
                                        selected($majc_settings['show_animation'], $value);
                                    }
                                    ?>><?php echo esc_attr($value) ?></option>
                                        <?php endforeach ?>
                            </optgroup>
                        <?php endforeach ?>
                    </select>
                </li>
                <li>
                    <label><?php esc_attr_e('Hide Animation', 'mini-ajax-cart') ?></label>
                    <select name="majc_settings[hide_animation]">
                        <option value="none"><?php esc_html_e('Default', 'mini-ajax-cart'); ?></option>
                        <?php foreach ($animations['hide_animation'] as $key => $key_array): ?>
                            <optgroup label="<?php echo esc_attr($key) ?>">
                                <?php foreach ($key_array as $value): ?>
                                    <option value="<?php echo esc_attr($value) ?>" <?php
                                    if (isset($majc_settings['hide_animation'])) {
                                        selected($majc_settings['hide_animation'], $value);
                                    }
                                    ?>><?php echo esc_attr($value) ?></option>
                                        <?php endforeach ?>
                            </optgroup>
                        <?php endforeach ?>
                    </select>
                </li>
            </ul>

        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Content Width', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields">
            <input type="number" name="majc_settings[content_width]" value="<?php echo isset($majc_settings['content_width']) ? intval($majc_settings['content_width']) : null; ?>"> px
        </div>	
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Enable Overlay', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[enable_overlay]" <?php
            if (isset($majc_settings['enable_overlay'])) {
                checked($majc_settings['enable_overlay'], 'on', true);
            }
            ?>>
            <p class="majc-desc"><?php echo esc_html__('Background behind the cart panel when it is opened', 'mini-ajax-cart'); ?></p>
        </div>
    </div>
</div>