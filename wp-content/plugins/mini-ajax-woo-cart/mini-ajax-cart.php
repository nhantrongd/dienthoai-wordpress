<?php

defined('ABSPATH') or die('No script please!');
/*
  Plugin Name: Mini Ajax Cart for WooCommerce
  Plugin URI: https://github.com/pzstar/mini-ajax-woo-cart
  Description: Ajax, Floating, Slide In, Popup Cart For WordPress with WooCommerce
  Version:     1.1.9
  Author:      HashThemes
  Author URI:  http://hashthemes.com
  License:     GPLv2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages
  Text Domain: mini-ajax-cart
 */

include( plugin_dir_path(__FILE__) . '/classes/library-class.php');

if (!class_exists('MAJC_Class')) {

    class MAJC_Class extends MAJC_Library {

        function __construct() {
            if (!function_exists('is_plugin_active')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            add_action('plugins_loaded', array($this, 'majc_text_domain'));

            if (!is_plugin_active('woocommerce/woocommerce.php')) {
                add_action('admin_notices', array($this, 'majc_woocommerce_install_message'));
            } else if (!is_plugin_active('ultimate-woocommerce-cart/ultimate-woocommerce-cart.php')) {
                $this->define_constants();
                $this->includes();
            }
        }

        public function define_constants() {
            defined('MAJC_VERSION') or define('MAJC_VERSION', '1.1.9'); //plugin version

            defined('MAJC_TD') or define('MAJC_TD', 'mini-ajax-cart'); //plugin's text domain

            defined('MAJC_CSS_PREFIX') or define('MAJC_CSS_PREFIX', 'majc-'); //plugin's text domain

            defined('MAJC_IMG_DIR') or define('MAJC_IMG_DIR', plugin_dir_url(__FILE__) . 'assets/img/');

            defined('MAJC_BACKEND_IMG_DIR') or define('MAJC_BACKEND_IMG_DIR', plugin_dir_url(__FILE__) . 'assets/backend/img/');

            defined('MAJC_FRONTEND_IMG_DIR') or define('MAJC_FRONTEND_IMG_DIR', plugin_dir_url(__FILE__) . 'assets/frontend/img/');

            defined('MAJC_BACKEND_JS_DIR') or define('MAJC_BACKEND_JS_DIR', plugin_dir_url(__FILE__) . 'assets/backend/js/');

            defined('MAJC_FRONTEND_JS_DIR') or define('MAJC_FRONTEND_JS_DIR', plugin_dir_url(__FILE__) . 'assets/frontend/js/');

            defined('MAJC_BACKEND_CSS_DIR') or define('MAJC_BACKEND_CSS_DIR', plugin_dir_url(__FILE__) . 'assets/backend/css/');

            defined('MAJC_FRONTEND_CSS_DIR') or define('MAJC_FRONTEND_CSS_DIR', plugin_dir_url(__FILE__) . 'assets/frontend/css/');

            defined('MAJC_PATH') or define('MAJC_PATH', plugin_dir_path(__FILE__));

            defined('MAJC_URL') or define('MAJC_URL', plugin_dir_url(__FILE__));
        }

        public function includes() {
            include plugin_dir_path(__FILE__) . '/font-icons.php';

            include plugin_dir_path(__FILE__) . '/google-fonts-list.php';

            include MAJC_PATH . '/classes/enqueue-class.php';

            include MAJC_PATH . '/classes/backend-class.php';

            include MAJC_PATH . '/classes/frontend-class.php';
        }

        public function majc_text_domain() {
            load_plugin_textdomain('mini-ajax-cart', false, plugin_dir_url(__FILE__) . 'languages');
        }

        public function majc_woocommerce_install_message() {
            $message = sprintf(/* translators: Placeholders: %1$s and %2$s are <strong> tags. %3$s and %4$s are <a> tags */
                    esc_html__('%1$sMini Ajax Cart for WooCommerce %2$s requires WooCommerce Plugin. Please install and activate %3$sWooCommerce%4$s.', 'ultimate-woocommerce-cart'), '<strong>', '</strong>', '<a href="' . admin_url('plugin-install.php?s=woocommerce&tab=search&type=term') . '">', '</a>'
            );
            echo sprintf('<div class="error"><p>%s</p></div>', $message);
        }

    }

    new MAJC_Class();
}