<?php

defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Enqueue')) {

    class MAJC_Enqueue extends MAJC_Library {

        function __construct() {
            add_action('admin_enqueue_scripts', array($this, 'majc_register_backend_assets'));
            add_action('wp_enqueue_scripts', array($this, 'majc_register_frontend_assets'));
        }

        public function majc_register_backend_assets() {
            wp_enqueue_media();

            wp_enqueue_style('fontawesome-6.3.0', MAJC_BACKEND_CSS_DIR . '/icons/fontawesome-6.3.0.css', array(), MAJC_VERSION);
            wp_enqueue_style('eleganticons', MAJC_BACKEND_CSS_DIR . '/icons/eleganticons.css', array(), MAJC_VERSION);
            wp_enqueue_style('essentialicon', MAJC_BACKEND_CSS_DIR . '/icons/essentialicon.css', array(), MAJC_VERSION);
            wp_enqueue_style('icofont', MAJC_BACKEND_CSS_DIR . '/icons/icofont.css', array(), MAJC_VERSION);
            wp_enqueue_style('materialdesignicons', MAJC_BACKEND_CSS_DIR . '/icons/materialdesignicons.css', array(), MAJC_VERSION);

            /* Enqueue jQuery Chosen */
            wp_enqueue_style('chosen', MAJC_BACKEND_CSS_DIR . 'chosen.css', '', MAJC_VERSION);
            wp_enqueue_script('chosen-script', MAJC_BACKEND_JS_DIR . 'chosen.jquery.js', array('jquery'), MAJC_VERSION);

            /* For color picker */
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');

            /* Register Custom Scrollbar */
            wp_enqueue_style('jquery-mCustomScrollbar', MAJC_BACKEND_CSS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.css', array(), MAJC_VERSION);
            wp_enqueue_script('jquery-mCustomScrollbar-style', MAJC_BACKEND_JS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.js', array('jquery'), MAJC_VERSION);

            /* Register condition Script */
            wp_enqueue_script('jquery-condition', MAJC_BACKEND_JS_DIR . 'jquery-condition.js', array('jquery'), MAJC_VERSION, true);

            /* Register Backend Script */
            wp_enqueue_script('majc-admin-script', MAJC_BACKEND_JS_DIR . 'admin-script.js', array('jquery', 'jquery-ui-sortable', 'chosen-script'), MAJC_VERSION, true);

            /* Register Backend Style */
            if (is_rtl()) {
                wp_enqueue_style('majc-admin-style', MAJC_BACKEND_CSS_DIR . 'admin-style.rtl.css', '', MAJC_VERSION);
            } else {
                wp_enqueue_style('majc-admin-style', MAJC_BACKEND_CSS_DIR . 'admin-style.css', '', MAJC_VERSION);
            }

            /* Send php values to JS script */
            wp_localize_script('majc-admin-script', 'majc_admin_js_obj', array(
                'image_path' => MAJC_BACKEND_IMG_DIR,
                'js_path' => MAJC_BACKEND_JS_DIR,
                'ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('majc-backend-ajax-nonce')
            ));
        }

        public function majc_register_frontend_assets() {
            // Icons Styles
            wp_enqueue_style('fontawesome-6.3.0', MAJC_BACKEND_CSS_DIR . '/icons/fontawesome-6.3.0.css', array(), MAJC_VERSION);
            wp_enqueue_style('eleganticons', MAJC_BACKEND_CSS_DIR . '/icons/eleganticons.css', array(), MAJC_VERSION);
            wp_enqueue_style('essentialicon', MAJC_BACKEND_CSS_DIR . '/icons/essentialicon.css', array(), MAJC_VERSION);
            wp_enqueue_style('icofont', MAJC_BACKEND_CSS_DIR . '/icons/icofont.css', array(), MAJC_VERSION);
            wp_enqueue_style('materialdesignicons', MAJC_BACKEND_CSS_DIR . '/icons/materialdesignicons.css', array(), MAJC_VERSION);

            // jQuery
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-effects-slide');
            wp_enqueue_script('jquery-effects-shake');

            // Animate CSS
            wp_enqueue_style('animate', MAJC_FRONTEND_CSS_DIR . 'animate.css', false, MAJC_VERSION);

            wp_enqueue_style('hover', MAJC_FRONTEND_CSS_DIR . 'hover-min.css', false, MAJC_VERSION);

            /* Register Custom Scrollbar */
            wp_enqueue_style('jquery-mCustomScrollbar', MAJC_FRONTEND_CSS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.css', array(), MAJC_VERSION);
            wp_enqueue_script('jquery-mCustomScrollbar-script', MAJC_FRONTEND_JS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.js', array('jquery'), MAJC_VERSION);

            // Plugins Frontend Styles
            wp_enqueue_style('majc-fonts', majc_fonts_url(), array(), NULL);
            if (is_rtl()) {
                wp_enqueue_style('majc-frontend-flymenu-style', MAJC_FRONTEND_CSS_DIR . 'frontend.rtl.css', false, MAJC_VERSION);
            } else {
                wp_enqueue_style('majc-frontend-flymenu-style', MAJC_FRONTEND_CSS_DIR . 'frontend.css', false, MAJC_VERSION);
            }

            // Plugins Frontend Scripts
            wp_enqueue_script('majc-frontend-script', MAJC_FRONTEND_JS_DIR . 'frontend.js', array('jquery-effects-shake', 'jquery-effects-slide', 'jquery-ui-core', 'jquery', 'jquery-ui-draggable'), MAJC_VERSION);

            $frontend_js_obj = array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('majc-frontend-ajax-nonce')
            );
            wp_localize_script('majc-frontend-script', 'majc_frontend_js_obj', $frontend_js_obj);
        }

    }

    new MAJC_Enqueue();
}