<?php
/**
 * Plugin Name: Swift Demo Import
 * Plugin URI: https://www.mysticalthemes.com/plugins/swift-demo-import
 * Description: A Plugin to import WordPress contents, customizer settings and widgets.
 * Version: 2.0.6
 * Author: bnayawpguy
 * Author URI: https://mysticalthemes.com
 * Text Domain: swift-demo-import
 * Domain Path: /languages/
 * License:GPLv2 or later
 * */
if (!defined('ABSPATH'))
    exit;


define('SDI_VERSION', '2.0.5');

define('SDI_FILE', __FILE__);
define('SDI_PLUGIN_BASENAME', plugin_basename(SDI_FILE));
define('SDI_PATH', plugin_dir_path(SDI_FILE));
define('SDI_URL', plugins_url('/', SDI_FILE));

define('SDI_ASSETS_URL', SDI_URL . 'assets/');

if (!class_exists('SDI_Importer')) {

    class SDI_Importer {

        public $configFile;
        public $uploads_dir;
        public $plugin_install_count;
        public $plugin_active_count;
        public $ajax_response = array();

        /*
         * Constructor
         */

        public function __construct() {

            $this->uploads_dir = wp_get_upload_dir();

            $this->plugin_install_count = 0;
            $this->plugin_active_count = 0;

            // Include necesarry files
            $this->configFile = include SDI_PATH . 'import_config.php';

            require_once SDI_PATH . 'classes/class-demo-importer.php';
            require_once SDI_PATH . 'classes/class-customizer-importer.php';
            require_once SDI_PATH . 'classes/class-widget-importer.php';

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));

            // WP-Admin Menu
            add_action('admin_menu', array($this, 'sdi_menu'));

            // Add necesary backend JS
            add_action('admin_enqueue_scripts', array($this, 'load_backends'));

            // Actions for the ajax call
            add_filter('upload_mimes', array($this, 'sdi_allow_svg_upload'));
            add_filter('mime_types', array($this, 'sdi_allow_svg_upload'));
            add_action('wp_ajax_sdi_install_demo', array($this, 'sdi_install_demo'));
            add_action('wp_ajax_sdi_install_plugin', array($this, 'sdi_install_plugin'));
            add_action('wp_ajax_sdi_activate_plugin', array($this, 'sdi_activate_plugin'));
            add_action('wp_ajax_sdi_download_files', array($this, 'sdi_download_files'));
            add_action('wp_ajax_sdi_import_xml', array($this, 'sdi_import_xml'));
            add_action('wp_ajax_sdi_customizer_import', array($this, 'sdi_customizer_import'));
            add_action('wp_ajax_sdi_menu_import', array($this, 'sdi_menu_import'));
            add_action('wp_ajax_sdi_theme_option', array($this, 'sdi_theme_option'));
            add_action('wp_ajax_sdi_importing_widget', array($this, 'sdi_importing_widget'));
            add_action('wp_ajax_sdi_importing_revslider', array($this, 'sdi_importing_revslider'));
        }

        /**
         * Loads the translation files
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain('swift-demo-import', false, SDI_PATH . '/languages');
        }

        /*
         * WP-ADMIN Menu for importer
         */

        function sdi_menu() {
            add_submenu_page('themes.php', esc_html__('OneClick Demo Install', 'swift-demo-import'), esc_html__('Swift Demo Import', 'swift-demo-import'), 'manage_options', 'sdi-demo-import', array($this, 'sdi_display_demos'));
        }

        /** Enabling SVG Upload * */
        function sdi_allow_svg_upload($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        }

        /*
         *  Display the available demos
         */

        function sdi_display_demos() {
            ?>
            <div class="wrap sdi-demo-import-wrap">
                <h3 class="heading"><?php echo esc_html__('Swift Demo Import', 'swift-demo-import'); ?></h3>

                <?php
                if (is_array($this->configFile) && !is_null($this->configFile) && !empty($this->configFile)) {
                    $tags = $pagebuilders = array();
                    foreach ($this->configFile as $demo_slug => $demo_pack) {
                        if (isset($demo_pack['tags']) && is_array($demo_pack['tags'])) {
                            foreach ($demo_pack['tags'] as $key => $tag) {
                                $tags[$key] = $tag;
                            }
                        }
                    }

                    foreach ($this->configFile as $demo_slug => $demo_pack) {
                        if (isset($demo_pack['pagebuilder']) && is_array($demo_pack['pagebuilder'])) {
                            foreach ($demo_pack['pagebuilder'] as $key => $pagebuilder) {
                                $pagebuilders[$key] = $pagebuilder;
                            }
                        }
                    }
                    asort($tags);
                    asort($pagebuilders);

                    if (!empty($tags) || !empty($pagebuilders)) {
                        ?>
                        <div class="sdi-tab-filter sdi-clearfix">
                            <?php
                            if (!empty($tags)) {
                                ?>
                                <div class="sdi-tab-group sdi-tag-group" data-filter-group="tag">
                                    <div class="sdi-tab" data-filter="*">
                                        <?php esc_html_e('All', 'swift-demo-import'); ?>
                                    </div>
                                    <?php
                                    foreach ($tags as $key => $value) {
                                        ?>
                                        <div class="sdi-tab" data-filter=".<?php echo esc_attr($key); ?>">
                                            <?php echo esc_html($value); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }

                            if (!empty($pagebuilders)) {
                                ?>
                                <div class="sdi-tab-group sdi-pagebuilder-group" data-filter-group="pagebuilder">
                                    <div class="sdi-tab" data-filter="*">
                                        <?php esc_html_e('All', 'swift-demo-import'); ?>
                                    </div>
                                    <?php
                                    foreach ($pagebuilders as $key => $value) {
                                        ?>
                                        <div class="sdi-tab" data-filter=".<?php echo esc_attr($key); ?>">
                                            <?php echo esc_html($value); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="sdi-demo-box-wrap wp-clearfix">
                        <?php
                        // Loop through Demos
                        foreach ($this->configFile as $demo_slug => $demo_pack) {
                            $tags = $pagebuilders = $class = '';
                            if (isset($demo_pack['tags'])) {
                                $tags = implode(' ', array_keys($demo_pack['tags']));
                            }

                            if (isset($demo_pack['pagebuilder'])) {
                                $pagebuilders = implode(' ', array_keys($demo_pack['pagebuilder']));
                            }

                            $classes = $tags . ' ' . $pagebuilders;

                            $type = isset($demo_pack['type']) ? $demo_pack['type'] : 'free';
                            ?>
                            <div id="<?php echo esc_attr($demo_slug); ?>" class="sdi-demo-box <?php echo esc_attr($classes); ?>">
                                <div class="sdi-demo-elements">
                                    <?php if ($type == 'pro') { ?>
                                        <div class="sdi-ribbon"><span><?php echo esc_html__('Premium', 'swift-demo-import'); ?></span></div>
                                    <?php } ?>

                                    <img src="<?php echo esc_url($demo_pack['image']); ?> ">

                                    <div class="sdi-demo-actions">

                                        <h4><?php echo esc_html($demo_pack['name']); ?></h4>

                                        <div class="sdi-demo-buttons">
                                            <a href="<?php echo esc_url($demo_pack['preview_url']); ?>" target="_blank" class="button">
                                                <?php echo esc_html__('Preview', 'swift-demo-import'); ?>
                                            </a> 

                                            <?php
                                            if ($type == 'pro') {
                                                $buy_url = isset($demo_pack['buy_url']) ? $demo_pack['buy_url'] : '#';
                                                ?>
                                                <a target="_blank" href="<?php echo esc_url($buy_url) ?>" class="button button-primary">
                                                    <?php echo esc_html__('Buy Now', 'swift-demo-import') ?>
                                                </a>
                                            <?php } else { ?>
                                                <a href="#sdi-modal-<?php echo esc_attr($demo_slug) ?>" class="sdi-modal-button button button-primary">
                                                    <?php echo esc_html__('Install', 'swift-demo-import') ?>
                                                </a>
                                            <?php }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                <?php } else {
                    ?>
                    <div class="sdi-demo-wrap">
                        <?php esc_html_e("It looks like the config file for the demos is missing or conatins errors!. Demo install can't go futher!", 'swift-demo-import'); ?>  
                    </div>
                <?php }
                ?>

                <?php
                /* Demo Modals */
                if (is_array($this->configFile) && !is_null($this->configFile)) {
                    foreach ($this->configFile as $demo_slug => $demo_pack) {
                        ?>
                        <div id="sdi-modal-<?php echo esc_attr($demo_slug) ?>" class="sdi-modal" style="display: none;">

                            <div class="sdi-modal-header">
                                <h2><?php printf(esc_html('Import %s Demo', 'swift-demo-import'), esc_html($demo_pack['name'])); ?></h2>
                                <div class="sdi-modal-back"><span class="dashicons dashicons-no-alt"></span></div>
                            </div>

                            <div class="sdi-modal-wrap">
                                <p><?php echo sprintf(esc_html__('We recommend you backup your website content before attempting to import the demo so that you can recover your website if something goes wrong. You can use %s plugin for it.', 'swift-demo-import'), '<a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">' . esc_html__('All in one migration', 'swift-demo-import') . '</a>'); ?></p>

                                <p><?php echo esc_html__('This process will install all the required plugins, import contents and setup customizer and theme options.', 'swift-demo-import'); ?></p>

                                <div class="sdi-modal-recommended-plugins">
                                    <h4><?php esc_html_e('Required Plugins', 'swift-demo-import'); ?></h4>
                                    <p><?php esc_html_e('For your website to look exactly like the demo,the import process will install and activate the following plugin if they are not installed or activated.', 'swift-demo-import'); ?></p>
                                    <?php
                                    $plugins = isset($demo_pack['plugins']) ? $demo_pack['plugins'] : '';

                                    if (is_array($plugins)) {
                                        ?>
                                        <ul class="sdi-plugin-status">
                                            <?php
                                            foreach ($plugins as $plugin) {
                                                $name = isset($plugin['name']) ? $plugin['name'] : '';
                                                $status = SDI_Demo_Importer::plugin_active_status($plugin['file_path']);
                                                if ($status == 'active') {
                                                    $plugin_class = '<span class="dashicons dashicons-yes-alt"></span>';
                                                } else if ($status == 'inactive') {
                                                    $plugin_class = '<span class="dashicons dashicons-warning"></span>';
                                                } else {
                                                    $plugin_class = '<span class="dashicons dashicons-dismiss"></span>';
                                                }
                                                ?>
                                                <li class="sdi-<?php echo esc_attr($status); ?>">
                                                    <?php
                                                    echo $plugin_class . ' ' . esc_html($name) . ' - <i>' . $this->get_plugin_status($status) . '</i>';
                                                    ?>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                        <?php
                                    } else {
                                        ?>
                                        <ul>
                                            <li><?php esc_html_e('No Required Plugins Found.', 'swift-demo-import'); ?></li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="sdi-reset-checkbox">
                                    <h4><?php esc_html_e('Reset Website', 'swift-demo-import') ?></h4>
                                    <p><?php esc_html_e('Reseting the website will delete all your post, pages, custom post types, categories, taxonomies, images and all other customizer and theme option settings.', 'swift-demo-import') ?></p>
                                    <p><?php esc_html_e('It is always recommended to reset the database for a complete demo import.', 'swift-demo-import') ?></p>
                                    <label class="sdi-reset-website-checkbox">
                                        <input id="checkbox-reset-<?php echo esc_attr($demo_slug); ?>" type="checkbox" value='1' checked="checked"/>
                                        <?php echo esc_html('Reset Website - Check this box only if you are sure to reset the website.', 'swift-demo-import'); ?>
                                    </label>
                                </div>

                                <a href="javascript:void(0)" data-demo-slug="<?php echo esc_attr($demo_slug) ?>" class="button button-primary sdi-import-demo"><?php esc_html_e('Import Demo', 'swift-demo-import'); ?></a>
                                <a href="javascript:void(0)" class="button sdi-modal-cancel"><?php esc_html_e('Cancel', 'swift-demo-import'); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div id="sdi-import-progress" style="display: none">
                    <h2 class="sdi-import-progress-header"><?php echo esc_html__('Demo Import Progress', 'swift-demo-import'); ?></h2>

                    <div class="sdi-import-progress-wrap">
                        <div class="sdi-import-loader">
                            <div class="sdi-loader-content">
                                <div class="sdi-loader-content-inside">
                                    <div class="sdi-loader-rotater"></div>
                                    <div class="sdi-loader-line-point"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sdi-import-progress-message"></div>
                    </div>
                </div>
            </div>
            <?php
        }

        /*
         *  Do the install on ajax call
         */

        function sdi_install_demo() {
            check_ajax_referer('demo-importer-ajax', 'security');

            // Get the demo content from the right file
            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $this->ajax_response['demo'] = $demo_slug;

            if (isset($_POST['reset']) && $_POST['reset'] == 'true') {
                $this->database_reset();
                $this->ajax_response['complete_message'] = esc_html__('Database reset complete', 'swift-demo-import');
            }

            $this->ajax_response['next_step'] = 'sdi_install_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Installing required plugins', 'swift-demo-import');
            $this->send_ajax_response();
        }

        function sdi_install_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Install Required Plugins
            $this->install_plugins($demo_slug);

            $plugin_install_count = $this->plugin_install_count;

            if ($plugin_install_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins installed', 'swift-demo-import');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to install', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sdi_activate_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Activating required plugins', 'swift-demo-import');
            $this->send_ajax_response();
        }

        function sdi_activate_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Activate Required Plugins
            $this->activate_plugins($demo_slug);

            $plugin_active_count = $this->plugin_active_count;

            if ($plugin_active_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins activated', 'swift-demo-import');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to activate', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sdi_download_files';
            $this->ajax_response['next_step_message'] = esc_html__('Downloading demo files', 'swift-demo-import');
            $this->send_ajax_response();
        }

        function sdi_download_files() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $downloads = $this->download_files($this->configFile[$demo_slug]['external_url']);
            if ($downloads) {
                $this->ajax_response['complete_message'] = esc_html__('All demo files downloaded', 'swift-demo-import');
                $this->ajax_response['next_step'] = 'sdi_import_xml';
                $this->ajax_response['next_step_message'] = esc_html__('Importing posts, pages and medias. It may take a bit longer time', 'swift-demo-import');
            } else {
                $this->ajax_response['error'] = true;
                $this->ajax_response['error_message'] = esc_html__('Demo import process failed. Demo files can not be downloaded', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function sdi_import_xml() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Import XML content
            $xml_filepath = $this->demo_upload_dir($demo_slug) . '/content.xml';

            if (file_exists($xml_filepath)) {
                $this->importDemoContent($xml_filepath);
                $this->ajax_response['complete_message'] = esc_html__('All content imported', 'swift-demo-import');
                $this->ajax_response['next_step'] = 'sdi_customizer_import';
                $this->ajax_response['next_step_message'] = esc_html__('Importing customizer settings', 'swift-demo-import');
            } else {
                $this->ajax_response['error'] = true;
                $this->ajax_response['error_message'] = esc_html__('Demo import process failed. No content file found', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function sdi_customizer_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $customizer_filepath = $this->demo_upload_dir($demo_slug) . '/customizer.dat';

            if (file_exists($customizer_filepath)) {
                ob_start();
                SDI_Customizer_Importer::import($customizer_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Customizer settings imported', 'swift-demo-import');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No customizer settings found', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sdi_menu_import';
            $this->ajax_response['next_step_message'] = esc_html__('Setting menus', 'swift-demo-import');
            $this->send_ajax_response();
        }

        function sdi_menu_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $menu_array = isset($this->configFile[$demo_slug]['menu_array']) ? $this->configFile[$demo_slug]['menu_array'] : '';
            // Set menu
            if ($menu_array) {
                $this->setMenu($menu_array);
                $this->ajax_response['complete_message'] = esc_html__('Menus saved', 'swift-demo-import');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No menus saved', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sdi_theme_option';
            $this->ajax_response['next_step_message'] = esc_html__('Importing theme option settings', 'swift-demo-import');
            $this->send_ajax_response();
        }

        function sdi_theme_option() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $options_array = isset($this->configFile[$demo_slug]['options_array']) ? $this->configFile[$demo_slug]['options_array'] : '';

            if (isset($options_array) && is_array($options_array)) {
                foreach ($options_array as $theme_option) {
                    $option_filepath = $this->demo_upload_dir($demo_slug) . '/' . $theme_option . '.json';

                    if (file_exists($option_filepath)) {
                        $data = file_get_contents($option_filepath);

                        if ($data) {
                            update_option($theme_option, json_decode($data, true));
                        }
                    }
                }
                $this->ajax_response['complete_message'] = esc_html__('Theme options settings imported', 'swift-demo-import');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No theme options found', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sdi_importing_widget';
            $this->ajax_response['next_step_message'] = esc_html__('Importing widgets', 'swift-demo-import');
            $this->send_ajax_response();
        }

        function sdi_importing_widget() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $widget_filepath = $this->demo_upload_dir($demo_slug) . '/widget.wie';

            if (file_exists($widget_filepath)) {
                ob_start();
                SDI_Widget_Importer::import($widget_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Widgets imported', 'swift-demo-import');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No widgets found', 'swift-demo-import');
            }

            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';

            if (file_exists($sliderFile)) {
                $this->ajax_response['next_step'] = 'sdi_importing_revslider';
                $this->ajax_response['next_step_message'] = esc_html__('Importing Revolution slider', 'swift-demo-import');
            } else {
                $this->ajax_response['next_step'] = '';
                $this->ajax_response['next_step_message'] = '';
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function sdi_importing_revslider() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Get the zip file path
            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';

            if (file_exists($sliderFile)) {
                if (class_exists('RevSlider')) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $sliderFile);
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider installed', 'swift-demo-import');
                } else {
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider plugin not installed', 'swift-demo-import');
                }
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No Revolution slider found', 'swift-demo-import');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = '';
            $this->ajax_response['next_step_message'] = '';
            $this->send_ajax_response();
        }

        public function download_files($external_url) {
            // Make sure we have the dependency.
            if (!function_exists('WP_Filesystem')) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }

            /**
             * Initialize WordPress' file system handler.
             *
             * @var WP_Filesystem_Base $wp_filesystem
             */
            WP_Filesystem();
            global $wp_filesystem;

            $result = true;

            if (!($wp_filesystem->exists($this->demo_upload_dir()))) {
                $result = $wp_filesystem->mkdir($this->demo_upload_dir());
            }

            // Abort the request if the local uploads directory couldn't be created.
            if (!$result) {
                return false;
            } else {
                $demo_pack = $this->demo_upload_dir() . 'demo-pack.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->put_contents($demo_pack, $file);
                unzip_file($demo_pack, $this->demo_upload_dir());
                $wp_filesystem->delete($demo_pack);
                return true;
            }
        }

        /*
         * Reset the database, if the case
         */

        function database_reset() {

            global $wpdb;
            $core_tables = array('commentmeta', 'comments', 'links', 'postmeta', 'posts', 'term_relationships', 'term_taxonomy', 'termmeta', 'terms');
            $exclude_core_tables = array('options', 'usermeta', 'users');
            $core_tables = array_map(function ($tbl) {
                global $wpdb;
                return $wpdb->prefix . $tbl;
            }, $core_tables);
            $exclude_core_tables = array_map(function ($tbl) {
                global $wpdb;
                return $wpdb->prefix . $tbl;
            }, $exclude_core_tables);
            $custom_tables = array();

            $table_status = $wpdb->get_results('SHOW TABLE STATUS');
            if (is_array($table_status)) {
                foreach ($table_status as $index => $table) {
                    if (0 !== stripos($table->Name, $wpdb->prefix)) {
                        continue;
                    }
                    if (empty($table->Engine)) {
                        continue;
                    }

                    if (false === in_array($table->Name, $core_tables) && false === in_array($table->Name, $exclude_core_tables)) {
                        $custom_tables[] = $table->Name;
                    }
                }
            }
            $custom_tables = array_merge($core_tables, $custom_tables);

            foreach ($custom_tables as $tbl) {
                $wpdb->query('SET foreign_key_checks = 0');
                $wpdb->query('TRUNCATE TABLE ' . $tbl);
            }

            // Delete Widgets
            global $wp_registered_widget_controls;

            $widget_controls = $wp_registered_widget_controls;

            $available_widgets = array();

            foreach ($widget_controls as $widget) {
                if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
                    $available_widgets[] = $widget['id_base'];
                }
            }

            update_option('sidebars_widgets', array('wp_inactive_widgets' => array()));
            foreach ($available_widgets as $widget_data) {
                update_option('widget_' . $widget_data, array());
            }

            // Delete Thememods
            $theme_slug = get_option('stylesheet');
            $mods = get_option("theme_mods_$theme_slug");
            if (false !== $mods) {
                delete_option("theme_mods_$theme_slug");
            }

            //Clear "uploads" folder
            $this->clear_uploads($this->uploads_dir['basedir']);
        }

        /**
         * Clear "uploads" folder
         * @param string $dir
         * @return bool
         */
        private function clear_uploads($dir) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                ( is_dir("$dir/$file") ) ? $this->clear_uploads("$dir/$file") : unlink("$dir/$file");
            }

            return ( $dir != $this->uploads_dir['basedir'] ) ? rmdir($dir) : true;
        }

        /*
         * Set the menu on theme location
         */

        function setMenu($menu_array) {

            if (!$menu_array) {
                return;
            }

            $locations = get_theme_mod('nav_menu_locations');

            foreach ($menu_array as $menuId => $menuname) {
                $menu_exists = wp_get_nav_menu_object($menuname);

                if (!$menu_exists) {
                    $term_id_of_menu = wp_create_nav_menu($menuname);
                } else {
                    $term_id_of_menu = $menu_exists->term_id;
                }

                $locations[$menuId] = $term_id_of_menu;
            }

            set_theme_mod('nav_menu_locations', $locations);
        }

        /*
         * Import demo XML content
         */

        function importDemoContent($xml_filepath) {

            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);

            if (!class_exists('SDI_Import')) {
                $class_wp_importer = SDI_PATH . "wordpress-importer/wordpress-importer.php";
                if (file_exists($class_wp_importer)) {
                    require_once $class_wp_importer;
                }
            }

            // Import demo content from XML
            if (class_exists('SDI_Import')) {
                $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';
                $home_slug = isset($this->configFile[$demo_slug]['home_slug']) ? $this->configFile[$demo_slug]['home_slug'] : '';
                $blog_slug = isset($this->configFile[$demo_slug]['blog_slug']) ? $this->configFile[$demo_slug]['blog_slug'] : '';

                $shop_slug = isset($this->configFile[$demo_slug]['shop_slug']) ? $this->configFile[$demo_slug]['shop_slug'] : '';
                $cart_slug = isset($this->configFile[$demo_slug]['cart_slug']) ? $this->configFile[$demo_slug]['cart_slug'] : '';
                $checkout_slug = isset($this->configFile[$demo_slug]['checkout_slug']) ? $this->configFile[$demo_slug]['checkout_slug'] : '';
                $myaccount_slug = isset($this->configFile[$demo_slug]['myaccount_slug']) ? $this->configFile[$demo_slug]['myaccount_slug'] : '';

                if (file_exists($xml_filepath)) {
                    $wp_import = new SDI_Import();
                    $wp_import->fetch_attachments = true;
                    // Capture the output.
                    ob_start();
                    $wp_import->import($xml_filepath);
                    // Clean the output.
                    ob_end_clean();
                    // Import DONE
                    // set homepage as front page
                    if ($home_slug) {
                        $page = get_page_by_path($home_slug);
                        if ($page) {
                            update_option('show_on_front', 'page');
                            update_option('page_on_front', $page->ID);
                        } else {
                            $page = get_page_by_title('Home');
                            if ($page) {
                                update_option('show_on_front', 'page');
                                update_option('page_on_front', $page->ID);
                            }
                        }
                    }

                    if ($blog_slug) {
                        $blog = get_page_by_path($blog_slug);
                        if ($blog) {
                            update_option('show_on_front', 'page');
                            update_option('page_for_posts', $blog->ID);
                        }
                    }

                    if (!$home_slug && !$blog_slug) {
                        update_option('show_on_front', 'posts');
                    }

                    if ($shop_slug) {
                        $page = get_page_by_path($shop_slug);
                        if ($page) {
                            update_option('woocommerce_shop_page_id', $page->ID);
                        }
                    }

                    if ($cart_slug) {
                        $page = get_page_by_path($cart_slug);
                        if ($page) {
                            update_option('woocommerce_cart_page_id', $page->ID);
                        }
                    }

                    if ($checkout_slug) {
                        $page = get_page_by_path($checkout_slug);
                        if ($page) {
                            update_option('woocommerce_checkout_page_id', $page->ID);
                        }
                    }

                    if ($myaccount_slug) {
                        $page = get_page_by_path($myaccount_slug);
                        if ($page) {
                            update_option('woocommerce_myaccount_page_id', $page->ID);
                        }
                    }
                }
            }
        }

        function demo_upload_dir($path = '') {
            $upload_dir = $this->uploads_dir['basedir'] . '/demo-pack/' . $path;
            return $upload_dir;
        }

        function install_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $source = isset($plugin['source']) ? $plugin['source'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $location = isset($plugin['location']) ? $plugin['location'] : '';

                if ($source == 'wordpress') {
                    $this->plugin_installer_callback($file_path, $plugin_slug);
                } else {
                    $this->plugin_offline_installer_callback($file_path, $location);
                }
            }
        }

        function activate_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $plugin_status = $this->plugin_status($file_path);

                if ($plugin_status == 'inactive') {
                    $this->activate_plugin($file_path);
                    $this->plugin_active_count++;
                }
            }
        }

        public function plugin_installer_callback($path, $slug) {
            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Include required libs for installation
                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
                require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

                // Get Plugin Info
                $api = $this->call_plugin_api($slug);

                $skin = new WP_Ajax_Upgrader_Skin();
                $upgrader = new Plugin_Upgrader($skin);
                $upgrader->install($api->download_link);

                $this->activate_plugin($file_path);

                $this->plugin_install_count++;
            }
        }

        public function plugin_offline_installer_callback($path, $external_url) {

            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Make sure we have the dependency.
                if (!function_exists('WP_Filesystem')) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }

                /**
                 * Initialize WordPress' file system handler.
                 *
                 * @var WP_Filesystem_Base $wp_filesystem
                 */
                WP_Filesystem();
                global $wp_filesystem;

                $plugin = $this->demo_upload_dir() . 'plugin.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->mkdir($this->demo_upload_dir());

                $wp_filesystem->put_contents($plugin, $file);

                unzip_file($plugin, WP_PLUGIN_DIR);

                $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($path);

                $wp_filesystem->delete($plugin);

                $this->activate_plugin($file_path);

                $this->plugin_install_count++;
            }
        }

        /* Plugin API */

        public function call_plugin_api($slug) {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

            $call_api = plugins_api('plugin_information', array(
                'slug' => $slug,
                'fields' => array(
                    'downloaded' => false,
                    'rating' => false,
                    'description' => false,
                    'short_description' => false,
                    'donate_link' => false,
                    'tags' => false,
                    'sections' => false,
                    'homepage' => false,
                    'added' => false,
                    'last_updated' => false,
                    'compatibility' => false,
                    'tested' => false,
                    'requires' => false,
                    'downloadlink' => true,
                    'icons' => false
            )));

            return $call_api;
        }

        public function activate_plugin($file_path) {
            if ($file_path) {
                $activate = activate_plugin($file_path, '', false, true);
            }
        }

        /* Check if plugin is active or not */

        public function plugin_status($file_path) {
            $status = 'install';

            $plugin_path = WP_PLUGIN_DIR . '/' . $file_path;

            if (file_exists($plugin_path)) {
                $status = is_plugin_active($file_path) ? 'active' : 'inactive';
            }
            return $status;
        }

        public function get_plugin_status($status) {
            switch ($status) {
                case 'install':
                    $plugin_status = esc_html__('Not Installed', 'swift-demo-import');
                    break;

                case 'active':
                    $plugin_status = esc_html__('Installed and Active', 'swift-demo-import');
                    break;

                case 'inactive':
                    $plugin_status = esc_html__('Installed but Not Active', 'swift-demo-import');
                    break;
            }
            return $plugin_status;
        }

        public function send_ajax_response() {
            $json = wp_json_encode($this->ajax_response);
            echo $json;
            die();
        }

        /*
          Register necessary backend js
         */

        function load_backends() {
            $data = array(
                'nonce' => wp_create_nonce('demo-importer-ajax'),
                'prepare_importing' => esc_html__('Preparing to import demo', 'swift-demo-import'),
                'reset_database' => esc_html__('Reseting database', 'swift-demo-import'),
                'no_reset_database' => esc_html__('Database was not reset', 'swift-demo-import'),
                'import_error' => esc_html__('There was an error in importing demo. Please reload the page and try again.', 'swift-demo-import'),
                'import_success' => '<h2>' . esc_html__('All done. Have fun!', 'swift-demo-import') . '</h2><p>' . esc_html__('Your website has been successfully setup.', 'swift-demo-import') . '</p><a class="button" target="_blank" href="' . esc_url(home_url('/')) . '">View your Website</a><a class="button" href="' . esc_url(admin_url('/admin.php?page=sdi-demo-import')) . '">' . esc_html__('Go Back', 'swift-demo-import') . '</a>'
            );

            wp_enqueue_script('isotope-pkgd', SDI_ASSETS_URL . 'isotope.pkgd.js', array('jquery'), SDI_VERSION, true);
            wp_enqueue_script('sdi-demo-ajax', SDI_ASSETS_URL . 'demo-importer-ajax.js', array('jquery', 'imagesloaded'), SDI_VERSION, true);
            wp_localize_script('sdi-demo-ajax', 'sdi_ajax_data', $data);
            wp_enqueue_style('sdi-demo-style', SDI_ASSETS_URL . 'demo-importer-style.css', array(), SDI_VERSION);
        }

    }

}

function sdi_importer() {
    new SDI_Importer;
}

add_action('after_setup_theme', 'sdi_importer');
