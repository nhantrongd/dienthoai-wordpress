<?php

defined('ABSPATH') or die('No Script Found!');

if (!class_exists('MAJC_Library')) {

    class MAJC_Library {

        static function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }

            foreach ($array as $k => $v) {
                if (!is_array($v)) {
                    $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = self::sanitize_value($v, $sanitize_type);
                }

                if (is_array($v)) {
                    $array[$k] = self::sanitize_array($v, $sanitize_rule);
                }
            }

            return $array;
        }

        static function sanitize_value($value = '', $sanitize_type = 'html') {
            switch ($sanitize_type) {
                case 'text':
                    $allowed_html = wp_kses_allowed_html('post');
                    return wp_kses($value, $allowed_html);
                    break;
                default:
                    return sanitize_text_field($value);
                    break;
            }
        }

        public function majc_animations() {
            $animations = [
                'show_animation' => array(
                    'Fading Entrances' => array('fadeIn', 'fadeInLeft', 'fadeInRight'),
                    'Slide Entrance' => array('slideInLeft', 'slideInRight')
                ),
                'hide_animation' => array(
                    'Fading Exits' => array('fadeOut', 'fadeOutLeft', 'fadeOutRight'),
                    'Slide Exits' => array('slideOutLeft', 'slideOutRight')
                ),
                'hover_animation' => array(
                    '2D Transitions' => array(
                        'Grow' => 'hvr-grow',
                        'Shrink' => 'hvr-shrink',
                        'Pulse' => 'hvr-pulse'
                    )
                ),
            ];
            return $animations;
        }

        public static function checkbox_settings() {
            return array(
                'enable_overlay' => 'off',
                'display' => array(
                    'enable_flying_cart' => 'off',
                    'front_pages' => 'off',
                    'blog_pages' => 'off',
                    'archive_pages' => 'off',
                    'error_pages' => 'off',
                    'search_pages' => 'off',
                    'single_pages' => 'off'
                ),
                'cart_basket' => array(
                    'product_count' => 'off',
                ),
                'buttons' => array(
                    'show_view_cart' => 'off',
                    'show_checkout' => 'off',
                    'show_continue_shopping' => 'off'
                ),
                'summary' => array(
                    'hide_cart_total' => 'off',
                    'hide_discount' => 'off',
                    'hide_subtotal' => 'off'
                ),
                'header' => array(
                    'show_cart_item_count' => 'off'
                ),
                'coupon' => array(
                    'enable' => 'off'
                )
            );
        }

        public static function default_values() {
            return array(
                'cart_basket' => array(
                    'icon_type' => 'default_icon',
                    'open_available_icon' => 'mdi mdi-cart-check',
                    'open_custom_icon' => '',
                    'close_available_icon' => 'mdi mdi-cart-remove',
                    'close_custom_icon' => '',
                    'shape' => 'round',
                    'hover_animation' => 'hvr-grow',
                    'product_count' => 'on',
                ),
                'basket_position' => 'left-middle',
                'layout_type' => 'slidein',
                'show_animation' => 'none',
                'hide_animation' => 'none',
                'cart_item_layout' => 'list',
                'content_width' => '400',
                'enable_overlay' => 'on',
                'header' => array(
                    'title_text' => 'Your Product Basket',
                    'icon_type' => 'none',
                    'available_icon' => 'icofont-basket',
                    'custom_icon' => '',
                    'show_cart_item_count' => 'on',
                ),
                'coupon' => array(
                    'enable' => 'on',
                    'button_text' => 'Apply Coupon',
                    'promocode_placeholder' => 'Promo Code',
                ),
                'summary' => array(
                    'hide_cart_total' => 'off',
                    'hide_discount' => 'off',
                    'hide_subtotal' => 'off'
                ),
                'display' => array(
                    'enable_flying_cart' => 'on',
                    'hide_screen' => array(),
                    'display_condition' => 'show_all',
                    'specific_pages' => array(),
                    'front_pages' => 'off',
                    'blog_pages' => 'off',
                    'archive_pages' => 'off',
                    'error_pages' => 'off',
                    'search_pages' => 'off',
                    'cpt_pages' => array(),
                    'specific_archive' => array()
                ),
                'buttons' => array(
                    'show_view_cart' => 'on',
                    'show_checkout' => 'on',
                    'show_continue_shopping' => 'on',
                    'continue_shopping_link' => '',
                    'view_cart_label' => 'View Cart',
                    'checkout_label' => 'View Checkout',
                    'continue_shopping_label' => 'Continue Shopping',
                ),
                'custom' => array(
                    'header_title_font_family' => 'Default',
                    'header_title_font_style' => 'Default',
                    'header_title_text_transform' => 'inherit',
                    'header_title_text_decoration' => 'inherit',
                    'header_title_font_size' => '',
                    'header_title_line_height' => '',
                    'header_title_letter_spacing' => '',
                    'header_title_font_color' => '',
                    'content_font_family' => 'Default',
                    'content_font_style' => 'Default',
                    'content_text_transform' => 'inherit',
                    'content_text_decoration' => 'inherit',
                    'content_font_size' => '',
                    'content_line_height' => '',
                    'content_letter_spacing' => '',
                    'content_font_color' => '',
                    'button_text_font_family' => 'Default',
                    'button_text_font_style' => 'Default',
                    'button_text_text_transform' => 'inherit',
                    'button_text_text_decoration' => 'inherit',
                    'button_text_font_size' => '',
                    'button_text_line_height' => '',
                    'button_text_letter_spacing' => '',
                    'product_title_font_family' => 'Default',
                    'product_title_font_style' => 'Default',
                    'product_title_text_transform' => 'inherit',
                    'product_title_text_decoration' => 'inherit',
                    'product_title_font_size' => '',
                    'product_title_line_height' => '',
                    'product_title_letter_spacing' => '',
                    'product_title_font_color' => '',
                    'coupon_btn_bg_color' => '',
                    'coupon_btn_hover_bg_color' => '',
                    'coupon_btn_font_color' => '',
                    'coupon_btn_hover_font_color' => '',
                    'continueshop_btn_bg_color' => '',
                    'continueshop_btn_hover_bg_color' => '',
                    'continueshop_btn_font_color' => '',
                    'continueshop_btn_hover_font_color' => '',
                    'continueshop_btn_normal_border_color' => '',
                    'continueshop_btn_hover_border_color' => '',
                    'viewcart_btn_bg_color' => '',
                    'viewcart_btn_hover_bg_color' => '',
                    'viewcart_btn_font_color' => '',
                    'viewcart_btn_hover_font_color' => '',
                    'viewcart_btn_normal_border_color' => '',
                    'viewcart_btn_hover_border_color' => '',
                    'checkout_btn_bg_color' => '',
                    'checkout_btn_hover_bg_color' => '',
                    'checkout_btn_font_color' => '',
                    'checkout_btn_hover_font_color' => '',
                    'checkout_btn_normal_border_color' => '',
                    'checkout_btn_hover_border_color' => '',
                    'trigger_btn_bg_color' => '',
                    'trigger_btn_hover_bg_color' => '',
                    'trigger_btn_font_color' => '',
                    'trigger_btn_hover_font_color' => '',
                    'cart_total_box_bg_color' => '',
                    'cart_total_box_text_color' => '',
                    'drawer_content_bg_type' => 'choose_color',
                    'drawer_content_bg_color' => '',
                    'drawer_content_bg_image' => '',
                    'remove_product_btn_bg_color' => '',
                    'remove_product_btn_font_color' => '',
                    'close_icon_color' => '',
                    'default_border_color' => '',
                    'qty_change_btn_bg_color' => '',
                    'qty_change_icon_color' => '',
                ),
            );
        }

        public static function recursive_parse_args($args, $defaults) {

            $new_args = (array) $defaults;

            foreach ($args as $key => $value) {
                if (is_array($value) && isset($new_args[$key])) {
                    $new_args[$key] = self::recursive_parse_args($value, $new_args[$key]);
                } else {
                    $new_args[$key] = $value;
                }
            }

            return $new_args;
        }

    }

    new MAJC_Library();
}