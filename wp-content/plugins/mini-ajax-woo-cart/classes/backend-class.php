<?php
defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Backend')) {

    class MAJC_Backend extends MAJC_Library {

        function __construct() {
            add_action('init', array($this, 'register_post_type'));

            add_action('add_meta_boxes', array($this, 'settings_metabox'));
            add_action('save_post', array($this, 'save_metabox_settings'));
            add_action('wp_loaded', array($this, 'admin_notice'), 20);
            add_action('admin_init', array($this, 'welcome_init'));
        }

        public function settings_metabox() {
            add_meta_box('majc-settings-metabox', esc_html__('Mini Ajax Cart', 'mini-ajax-cart'), array($this, 'settings_metabox_callback'), 'ultimate-woo-cart', 'normal', 'high');
        }

        public function settings_metabox_callback() {
            include MAJC_PATH . 'inc/backend/settings.php';
        }

        public function save_metabox_settings($post_id) {
            if (isset($_POST['majc_settings_nonce']) && wp_verify_nonce($_POST['majc_settings_nonce'], 'majc-settings-nonce')) {
                $majc_settings = parent::recursive_parse_args($_POST['majc_settings'], parent::checkbox_settings());
                $majc_settings = parent::sanitize_array($majc_settings);

                update_post_meta($post_id, 'uwcc_settings', $majc_settings);
            }
            return;
        }

        public function register_post_type() {
            $labels = array(
                'name' => _x('Mini Ajax Cart', 'post type general name', 'mini-ajax-cart'),
                'singular_name' => _x('Mini Ajax Cart', 'post type singular name', 'mini-ajax-cart'),
                'menu_name' => _x('Mini Ajax Cart', 'admin menu', 'mini-ajax-cart'),
                'name_admin_bar' => _x('Mini Ajax Cart', 'add new on admin bar', 'mini-ajax-cart'),
                'add_new' => _x('Add New', 'Mini Ajax Cart', 'mini-ajax-cart'),
                'add_new_item' => esc_html__('Add New Mini Ajax Cart', 'mini-ajax-cart'),
                'new_item' => esc_html__('New Cart', 'mini-ajax-cart'),
                'edit_item' => esc_html__('Edit Cart', 'mini-ajax-cart'),
                'view_item' => esc_html__('View Cart', 'mini-ajax-cart'),
                'all_items' => esc_html__('All Cart', 'mini-ajax-cart'),
                'search_items' => esc_html__('Search Cart', 'mini-ajax-cart'),
                'parent_item_colon' => esc_html__('Parent Cart:', 'mini-ajax-cart'),
                'not_found' => esc_html__('No Cart found.', 'mini-ajax-cart'),
                'not_found_in_trash' => esc_html__('No Cart found in Trash.', 'mini-ajax-cart')
            );

            $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_icon' => 'dashicons-cart',
                'query_var' => true,
                'rewrite' => array('slug' => 'ultimate-woo-cart'),
                'capability_type' => 'post',
                'has_archive' => false,
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title')
            );

            register_post_type('ultimate-woo-cart', $args);
        }

        public function icon_field($inputName, $iconName) {
            $inputName = isset($inputName) ? $inputName : '';
            $iconName = isset($iconName) ? $iconName : '';
            if (!isset($iconName))
                return;
            ?>
            <div class="majc-icon-box-wrap">
                <div class="majc-selected-icon">
                    <i class="<?php echo esc_attr($iconName); ?>"></i>
                    <span><i class="majc-down-icon"></i></span>
                </div>

                <div class="majc-icon-box">
                    <div class="majc-icon-search">
                        <select>
                            <option value="majc-icofont-list"><?php esc_html_e('Ico Font', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-fontawesome-list"><?php esc_html_e('Font Awesome', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-essentialicon-list"><?php esc_html_e('Essential Icon', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-material-icon-list"><?php esc_html_e('Material Icon', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-elegant-icon-list"><?php esc_html_e('Elegant Icon', 'mini-ajax-cart'); ?> </option>
                        </select>
                        <input type="text" class="majc-icon-search-input" placeholder="<?php esc_html_e('Type to filter', 'mini-ajax-cart'); ?>" />
                    </div>
                    <?php
                    echo '<ul class="majc-icon-list majc-icofont-list clearfix active">';
                    $majc_icofont_icon_array = majc_icofont_icon_array();
                    foreach ($majc_icofont_icon_array as $majc_icofont_icon) {
                        $icon_class = $iconName == $majc_icofont_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_icofont_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-fontawesome-list clearfix">';
                    $majc_font_awesome_icon_array = majc_font_awesome_icon_array();
                    foreach ($majc_font_awesome_icon_array as $majc_font_awesome_icon) {
                        $icon_class = $iconName == $majc_font_awesome_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_font_awesome_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-essentialicon-list clearfix">';
                    $majc_essential_icon_array = majc_essential_icon_array();
                    foreach ($majc_essential_icon_array as $majc_essential_icon) {
                        $icon_class = $iconName == $majc_essential_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_essential_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-material-icon-list clearfix">';
                    $majc_materialdesignicons_icon_array = majc_materialdesignicons_array();
                    foreach ($majc_materialdesignicons_icon_array as $majc_materialdesignicons_icon) {
                        $icon_class = $iconName == $majc_materialdesignicons_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_materialdesignicons_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-elegant-icon-list clearfix">';
                    $majc_eleganticons_icon_array = majc_eleganticons_array();
                    foreach ($majc_eleganticons_icon_array as $majc_eleganticons_icon) {
                        $icon_class = $iconName == $majc_eleganticons_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_eleganticons_icon) . '"></i></li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
                <input class="majc-icon" type="hidden" value="<?php echo esc_attr($iconName); ?>" name="<?php echo esc_attr($inputName); ?>"/>
            </div>
            <?php
        }

        public function admin_notice() {
            add_action('admin_notices', array($this, 'admin_notice_content'));
        }

        public function admin_notice_content() {
            if (!$this->is_dismissed('review') && !empty(get_option('majc_first_activation')) && time() > get_option('majc_first_activation') + 15 * DAY_IN_SECONDS) {
                $this->review_notice();
            }
        }

        public static function is_dismissed($notice) {
            $dismissed = get_option('majc_dismissed_notices', array());

            // Handle legacy user meta
            $dismissed_meta = get_user_meta(get_current_user_id(), 'majc_dismissed_notices', true);
            if (is_array($dismissed_meta)) {
                if (array_diff($dismissed_meta, $dismissed)) {
                    $dismissed = array_merge($dismissed, $dismissed_meta);
                    update_option('majc_dismissed_notices', $dismissed);
                }
                if (!is_multisite()) {
                    // Don't delete on multisite to avoid the notices to appear in other sites.
                    delete_user_meta(get_current_user_id(), 'majc_dismissed_notices');
                }
            }

            return in_array($notice, $dismissed);
        }

        public function review_notice() {
            ?>
            <div class="majc-notice notice notice-info">
                <?php $this->dismiss_button('review'); ?>
                <div class="majc-notice-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>basket-check</title><path d="M21.63 16.27L17.76 20.17L16.41 18.8L15 20.22L17.75 23L23.03 17.68L21.63 16.27M13 20C13 16.69 15.69 14 19 14C20 14 20.92 14.24 21.74 14.67L22.96 10.29L23 10C23 9.45 22.55 9 22 9H17.42L12.83 2.44C12.65 2.17 12.34 2 12 2S11.36 2.17 11.18 2.43L6.58 9H2C1.45 9 1 9.45 1 10L1.1 10.44L3.71 19.9C4.04 20.55 4.72 21 5.5 21H13.09C13.04 20.67 13 20.34 13 20M12 4.74L15 9H9L12 4.74M10 15C10 13.9 10.9 13 12 13S14 13.9 14 15 13.11 17 12 17 10 16.11 10 15Z" /></svg>
                </div>

                <div class="majc-notice-content">
                    <p>
                        <?php
                        printf(
                                /* translators: %1$s is link start tag, %2$s is link end tag. */
                                esc_html__('Great to see that you have been using Mini Ajax Cart for some time. We hope you love it, and we would really appreciate it if you would %1$sgive us a 5 stars rating%2$s and spread your words to the world.', 'mini-ajax-cart'), '<a target="_blank" href="https://wordpress.org/support/plugin/mini-ajax-woo-cart/reviews/?filter=5">', '</a>'
                        );
                        ?>
                    </p>
                    <a target="_blank" class="button button-primary button-large" href="https://wordpress.org/support/plugin/mini-ajax-woo-cart/reviews/?filter=5"><span class="dashicons dashicons-thumbs-up"></span><?php echo esc_html__('Yes, of course', 'mini-ajax-cart') ?></a> &nbsp;
                    <a class="button button-large" href="<?php echo esc_url(wp_nonce_url(add_query_arg('majc-hide-notice', 'review'), 'review', 'majc_notice_nonce')); ?>"><span class="dashicons dashicons-yes"></span><?php echo esc_html__('I have already rated', 'mini-ajax-cart') ?></a>
                </div>
            </div>
            <?php
        }

        public function welcome_init() {
            if (!get_option('majc_first_activation')) {
                update_option('majc_first_activation', time());
            };

            if (isset($_GET['majc-hide-notice'], $_GET['majc_notice_nonce'])) {
                $notice = sanitize_key($_GET['majc-hide-notice']);
                check_admin_referer($notice, 'majc_notice_nonce');
                self::dismiss($notice);
                wp_safe_redirect(remove_query_arg(array('majc-hide-notice', 'majc_notice_nonce'), wp_get_referer()));
                exit;
            }
        }

        public function dismiss_button($name) {
            printf('<a class="notice-dismiss" href="%s"><span class="screen-reader-text">%s</span></a>', esc_url(wp_nonce_url(add_query_arg('majc-hide-notice', $name), $name, 'majc_notice_nonce')), esc_html__('Dismiss this notice.', 'mini-ajax-cart'));
        }

        public static function dismiss($notice) {
            $dismissed = get_option('majc_dismissed_notices', array());

            if (!in_array($notice, $dismissed)) {
                $dismissed[] = $notice;
                update_option('majc_dismissed_notices', array_unique($dismissed));
            }
        }

    }

    $menu_class_obj = new MAJC_Backend();
}