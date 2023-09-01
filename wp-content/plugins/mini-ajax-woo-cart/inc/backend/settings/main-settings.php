<?php
$display = isset($majc_settings['display']) ? $majc_settings['display'] : null;
$header = isset($majc_settings['header']) ? $majc_settings['header'] : null;
$buttons = isset($majc_settings['buttons']) ? $majc_settings['buttons'] : null;
$coupon = isset($majc_settings['coupon']) ? $majc_settings['coupon'] : null;
$summary = isset($majc_settings['summary']) ? $majc_settings['summary'] : null;
$cart_basket = isset($majc_settings['cart_basket']) ? $majc_settings['cart_basket'] : null;
$animations = $this->majc_animations();
$display = isset($majc_settings['display']) ? $majc_settings['display'] : null;
?>

<div id="layout-settings" class="tab-content">
    <h2><?php esc_html_e('General Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Enable Mini Ajax Cart', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields  majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[display][enable_flying_cart]" <?php
            if (isset($display['enable_flying_cart'])) {
                checked($display['enable_flying_cart'], 'on', true);
            }
            ?>>
            <p class="majc-desc"><?php esc_html_e('Display Ajax Cart?', 'mini-ajax-cart'); ?></p>
        </div>
    </div>

    <h2><?php esc_html_e('Display Settings', 'mini-ajax-cart'); ?></h2>
    
    <div class="majc-settings-row">
        <label><?php esc_html_e('Hide in Screens', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields">
            <div class="majc-text-check-box">
                <label>
                    <input type="checkbox" value="desktop" name="majc_settings[display][hide_screen][]" <?php echo in_array('desktop', $display['hide_screen']) ? 'checked' : ''; ?> />
                    <span><i class="icon_desktop"></i><?php esc_html_e('Desktop', 'mini-ajax-cart'); ?></span>
                </label>
                <label>
                    <input type="checkbox" value="tablet" name="majc_settings[display][hide_screen][]" <?php echo in_array('tablet', $display['hide_screen']) ? 'checked' : ''; ?> />
                    <span><i class="icon_tablet"></i><?php esc_html_e('Tablet', 'mini-ajax-cart'); ?></span>
                </label>
                <label>
                    <input type="checkbox" value="mobile" name="majc_settings[display][hide_screen][]" <?php echo in_array('mobile', $display['hide_screen']) ? 'checked' : ''; ?> />
                    <span><i class="icon_mobile"></i><?php esc_html_e('Mobile', 'mini-ajax-cart'); ?></span>
                </label>
            </div>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Show/Hide in Pages', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-fields">
            <div class="majc-settings-list">
                <select name="majc_settings[display][display_condition]" data-condition="toggle" id="majc-display-condition-show-hide">
                    <option value="show_all" <?php selected($display['display_condition'], 'show_all'); ?>><?php esc_html_e('Show in All Pages', 'mini-ajax-cart'); ?></option>
                    <option value="hide_all" <?php selected($display['display_condition'], 'hide_all'); ?>><?php esc_html_e('Hide in All Pages', 'mini-ajax-cart'); ?></option>
                    <option value="show_selected" <?php selected($display['display_condition'], 'show_selected'); ?>><?php esc_html_e('Show in Selected Pages', 'mini-ajax-cart'); ?></option>
                    <option value="hide_selected" <?php selected($display['display_condition'], 'hide_selected'); ?>><?php esc_html_e('Hide in Selected Pages', 'mini-ajax-cart'); ?></option>
                </select>
            </div>
            
            <div class="majc-display-lists" data-condition-toggle="majc-display-condition-show-hide" data-condition-val="show_selected,hide_selected">
                <div class="majc-postbox-fields">
                    <h4><?php esc_html_e('Default WordPress Pages', 'mini-ajax-cart'); ?><!-- <span class="toggle-indicator" aria-hidden="true"></span> --></h4>

                    <div class="majc-toggle-tab-body">
                        <p>
                            <input type="checkbox" name="majc_settings[display][front_pages]" id="majc_front_pages" <?php
                            if (isset($display['front_pages'])) {
                                checked($display['front_pages'], 'on', true);
                            }
                            ?>/>
                            <label for="majc_front_pages"><?php esc_html_e('Front Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" name="majc_settings[display][blog_pages]" id="majc_blog_pages" <?php
                            if (isset($display['blog_pages'])) {
                                checked($display['blog_pages'], 'on', true);
                            }
                            ?>/>
                            <label for="majc_blog_pages"><?php esc_html_e('Home/Blog Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" class="majc-hide-show-archive-list" name="majc_settings[display][archive_pages]" id="majc_archive_pages" <?php
                            if (isset($display['archive_pages'])) {
                                checked($display['archive_pages'], 'on', true);
                            }
                            ?>/>
                            <label for="majc_archive_pages"><?php esc_html_e('Archive Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" name="majc_settings[display][error_pages]"  id="majc_404_pages" <?php
                            if (isset($display['error_pages'])) {
                                checked($display['error_pages'], 'on', true);
                            }
                            ?>/>
                            <label for="majc_404_pages"><?php esc_html_e('404 Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" name="majc_settings[display][search_pages]"  id="majc_search_pages" <?php
                            if (isset($display['search_pages'])) {
                                checked($display['search_pages'], 'on', true);
                            }
                            ?>/>
                            <label for="majc_search_pages"><?php esc_html_e('Search Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <?php
                        $post_types = get_post_types(array('public' => 'false'));
                        sort($post_types);
                        foreach ($post_types as $post_type) {
                            if (!($post_type == 'attachment') and get_posts(['post_type' => $post_type])) {
                                ?>
                                <p>
                                    <input type="checkbox" name="majc_settings[display][cpt_pages][]" class="majc-hide-show-cpt-posts" id="majc-hscpt-<?php echo esc_attr($post_type); ?>" data-posttype="<?php echo esc_attr($post_type); ?>" value="<?php echo esc_attr($post_type); ?>" <?php echo in_array(esc_attr($post_type), $display['cpt_pages']) ? 'checked="checked"' : '' ?>/>
                                    <label for="majc-hscpt-<?php echo esc_attr($post_type); ?>"><?php echo esc_html('All ' . ucwords($post_type)); ?></label>
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php
                $majc_specific_page = array();
                if (!empty($display['specific_pages'])) {
                    foreach ($display['specific_pages'] as $values) {
                        $majc_specific_page[] = $values;
                    }
                }
                $post_types = get_post_types(array('public' => 'false'));
                sort($post_types);
                ?>
                <div class="majc-hide-singular" id="majc-show-archive" <?php echo $display['archive_pages'] == 'on' ? 'style="display:none;"' : '' ?>>
                    <h4>
                        <?php
                        esc_html_e('Specific Archive Page', 'ultimate-woocommerce-cart');
                        ?>
                        <!-- <span class="toggle-indicator" aria-hidden="true"></span> -->
                    </h4>

                    <div class="majc-toggle-tab-body">
                        <?php
                        foreach ($post_types as $post_type) {
                            if (!($post_type == 'attachment' || $post_type == 'majc-cart-template')) {
                                ?>
                                <p>
                                    <input type="checkbox" name="majc_settings[display][specific_archive][]" id="majc-archive-<?php echo esc_attr($post_type); ?>" value="<?php echo esc_attr($post_type); ?>" <?php if (in_array($post_type, $display['specific_archive'])) echo 'checked'; ?>  />
                                    <label for="majc-archive-<?php echo esc_attr($post_type); ?>"><?php echo esc_html(ucwords($post_type)); ?></label>
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                foreach ($post_types as $post_type) {
                    if (!($post_type == 'attachment')) {
                        $posts_loop = new WP_Query(array('post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => 'publish'));

                        if (!empty($posts_loop->posts)) {
                            ?>
                            <div class="majc-hide-singular" id="majc-cpt-<?php echo esc_attr($post_type); ?>" <?php echo in_array(esc_attr($post_type), $display['cpt_pages']) ? 'style="display:none;"' : '' ?>>

                                <h4>
                                    <?php
                                    esc_html_e('Specific ', 'mini-ajax-cart');
                                    echo esc_html(ucwords($post_type));
                                    ?>
                                    <!-- <span class="toggle-indicator" aria-hidden="true"></span> -->
                                </h4>

                                <div class="majc-toggle-tab-body">
                                    <?php
                                    while ($posts_loop->have_posts()) : $posts_loop->the_post();
                                        $postid = get_the_ID();
                                        ?>
                                        <p>
                                            <input type="checkbox" name="majc_settings[display][specific_pages][]" id="majc-post-<?php echo esc_attr($postid); ?>" value="<?php echo esc_attr($postid); ?>" <?php if (isset($majc_specific_page) && in_array($postid, $majc_specific_page)) echo 'checked'; ?>	/>
                                            <label for="majc-post-<?php echo esc_attr($postid); ?>"><?php esc_html(the_title()); ?></label>
                                        </p>
                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>