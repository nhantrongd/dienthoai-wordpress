<?php
global $post;
$post_id = $post->ID;
$majc_settings = get_post_meta($post_id, 'uwcc_settings', true);
if (!$majc_settings) {
    $majc_settings = parent::default_values();
} else {
    $majc_settings = parent::recursive_parse_args($majc_settings, parent::default_values());
}

wp_nonce_field('majc-settings-nonce', 'majc_settings_nonce');
?>

<div class="majc-settings-outer-wrap">

    <div class="majc-settings-inner-wrap">
        <div class="majc-menu-option-wrap">
            <ul class="majc-side-menus">
                <li class="majc-tab majc-tab-active" data-tab="layout-settings"><?php esc_html_e('Main Settings', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="cart-button"><?php esc_html_e('Cart Button', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="cart-panel"><?php esc_html_e('Cart Panel', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="cart-content"><?php esc_html_e('Cart Content', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="design-settings"><?php esc_html_e('Design', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="upgrade-settings"><?php esc_html_e('Upgrade To Pro', 'mini-ajax-cart'); ?></li>
            </ul>
        </div>

        <div class="majc-menu-field-wrap">
            <?php
            include MAJC_PATH . 'inc/backend/settings/main-settings.php';
            include MAJC_PATH . 'inc/backend/settings/cart-button.php';
            include MAJC_PATH . 'inc/backend/settings/cart-panel.php';
            include MAJC_PATH . 'inc/backend/settings/cart-content.php';
            include MAJC_PATH . 'inc/backend/settings/design-settings.php';
            include MAJC_PATH . 'inc/backend/settings/upgrade.php';
            ?>
        </div>
    </div>


</div>