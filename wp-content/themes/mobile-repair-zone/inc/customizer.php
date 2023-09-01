<?php
/**
 * Mobile Repair Zone Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Mobile Repair Zone
 */

use WPTRT\Customize\Section\Mobile_Repair_Zone_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Mobile_Repair_Zone_Button::class );

    $manager->add_section(
        new Mobile_Repair_Zone_Button( $manager, 'mobile_repair_zone_pro', [
            'title'       => __( 'Mobile Repair Pro', 'mobile-repair-zone' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'mobile-repair-zone' ),
            'button_url'  => esc_url( 'https://www.themagnifico.net/themes/phone-repair-wordpress-theme/', 'mobile-repair-zone')
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'mobile-repair-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'mobile-repair-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mobile_repair_zone_customize_register($wp_customize){
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('mobile_repair_zone_logo_title', array(
        'default' => true,
        'sanitize_callback' => 'mobile_repair_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'mobile_repair_zone_logo_title',array(
        'label'          => __( 'Enable Disable Title', 'mobile-repair-zone' ),
        'section'        => 'title_tagline',
        'settings'       => 'mobile_repair_zone_logo_title',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('mobile_repair_zone_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'mobile_repair_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'mobile_repair_zone_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'mobile-repair-zone' ),
        'section'        => 'title_tagline',
        'settings'       => 'mobile_repair_zone_theme_description',
        'type'           => 'checkbox',
    )));

    // General Settings
     $wp_customize->add_section('mobile_repair_zone_general_settings',array(
        'title' => esc_html__('General Settings','mobile-repair-zone'),
        'description' => esc_html__('General settings of our theme.','mobile-repair-zone'),
        'priority'   => 30,
    ));

     $wp_customize->add_setting('mobile_repair_zone_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'mobile_repair_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'mobile_repair_zone_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'mobile-repair-zone' ),
        'section'        => 'mobile_repair_zone_general_settings',
        'settings'       => 'mobile_repair_zone_sticky_header',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('mobile_repair_zone_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'mobile_repair_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'mobile_repair_zone_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'mobile-repair-zone' ),
        'section'        => 'mobile_repair_zone_general_settings',
        'settings'       => 'mobile_repair_zone_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'mobile_repair_zone_preloader_bg_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_repair_zone_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_general_settings',
        'settings' => 'mobile_repair_zone_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'mobile_repair_zone_preloader_dot_1_color', array(
        'default' => '#040039',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_repair_zone_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_general_settings',
        'settings' => 'mobile_repair_zone_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'mobile_repair_zone_preloader_dot_2_color', array(
        'default' => '#f31b67',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_repair_zone_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_general_settings',
        'settings' => 'mobile_repair_zone_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('mobile_repair_zone_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'mobile_repair_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'mobile_repair_zone_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'mobile-repair-zone' ),
        'section'        => 'mobile_repair_zone_general_settings',
        'settings'       => 'mobile_repair_zone_scroll_hide',
        'type'           => 'checkbox',
    )));

    // Top Header
    $wp_customize->add_section('mobile_repair_zone_top_header',array(
        'title' => esc_html__('Top Header','mobile-repair-zone'),
    ));

    $wp_customize->add_setting('mobile_repair_zone_email_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_email_icon',array(
        'label' => esc_html__('Add Email Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_top_header',
        'setting' => 'mobile_repair_zone_email_icon',
        'type'  => 'text',
        'default' => 'fas fa-envelope',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-envelope','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_email',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    ));
    $wp_customize->add_control('mobile_repair_zone_email',array(
        'label' => esc_html__('Add Email','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_top_header',
        'setting' => 'mobile_repair_zone_email',
        'type'  => 'text'
    ));

    $wp_customize->add_section('mobile_repair_zone_top_header',array(
        'title' => esc_html__('Top Header','mobile-repair-zone'),
    ));

    $wp_customize->add_setting('mobile_repair_zone_phone_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_phone_icon',array(
        'label' => esc_html__('Add Phone Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_top_header',
        'setting' => 'mobile_repair_zone_phone_icon',
        'type'  => 'text',
        'default' => 'fas fa-phone',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-phone','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_phone',array(
        'default' => '',
        'sanitize_callback' => 'mobile_repair_zone_sanitize_phone_number'
    ));
    $wp_customize->add_control('mobile_repair_zone_phone',array(
        'label' => esc_html__('Add Phone Number','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_top_header',
        'setting' => 'mobile_repair_zone_phone',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('mobile_repair_zone_location_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_location_icon',array(
        'label' => esc_html__('Add Location Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_top_header',
        'setting' => 'mobile_repair_zone_location_icon',
        'type'  => 'text',
        'default' => 'fas fa-map-marker-alt',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-map-marker-alt','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_location',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_location',array(
        'label' => esc_html__('Add Location','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_top_header',
        'setting' => 'mobile_repair_zone_location',
        'type'  => 'text'
    ));

    // Social Link
    $wp_customize->add_section('mobile_repair_zone_social_link',array(
        'title' => esc_html__('Social Links','mobile-repair-zone'),
    ));

    $wp_customize->add_setting('mobile_repair_zone_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_facebook_icon',array(
        'label' => esc_html__('Facebook Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('mobile_repair_zone_facebook_url',array(
        'label' => esc_html__('Facebook Link','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_facebook_url',
        'type'  => 'url'
    ));


    $wp_customize->add_setting('mobile_repair_zone_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_twitter_icon',array(
        'label' => esc_html__('Twitter Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('mobile_repair_zone_twitter_url',array(
        'label' => esc_html__('Twitter Link','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('mobile_repair_zone_intagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_intagram_icon',array(
        'label' => esc_html__('Facebook Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_intagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('mobile_repair_zone_intagram_url',array(
        'label' => esc_html__('Intagram Link','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('mobile_repair_zone_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_linkedin_icon',array(
        'label' => esc_html__('Linkedin Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('mobile_repair_zone_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('mobile_repair_zone_pintrest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_pintrest_icon',array(
        'label' => esc_html__('Pinterest Icon','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_pintrest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('mobile_repair_zone_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','mobile-repair-zone'),
        'section' => 'mobile_repair_zone_social_link',
        'setting' => 'mobile_repair_zone_pintrest_url',
        'type'  => 'url'
    ));

    //Slider
    $wp_customize->add_section('mobile_repair_zone_top_slider',array(
        'title' => esc_html__('Slider Option','mobile-repair-zone')
    ));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'mobile_repair_zone_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'mobile_repair_zone_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'mobile_repair_zone_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'mobile-repair-zone' ),
            'section'  => 'mobile_repair_zone_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    // Team Section
    $wp_customize->add_section('mobile_repair_zone_team_post',array(
        'title' => esc_html__('Team Section','mobile-repair-zone')
    ));

    $wp_customize->add_setting('mobile_repair_zone_team_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mobile_repair_zone_team_heading', array(
        'label' => __('Add Heading', 'mobile-repair-zone'),
        'section' => 'mobile_repair_zone_team_post',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('mobile_repair_zone_team_heading_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mobile_repair_zone_team_heading_text', array(
        'label' => __('Add Text', 'mobile-repair-zone'),
        'section' => 'mobile_repair_zone_team_post',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('mobile_repair_zone_team_btn_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mobile_repair_zone_team_btn_text', array(
        'label' => __('Add Button Text', 'mobile-repair-zone'),
        'section' => 'mobile_repair_zone_team_post',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('mobile_repair_zone_team_btn_link', array(
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mobile_repair_zone_team_btn_link', array(
        'label' => __('Add Button Link', 'mobile-repair-zone'),
        'section' => 'mobile_repair_zone_team_post',
        'priority' => 1,
        'type' => 'url',
    ));

    $wp_customize->add_setting('mobile_repair_zone_team_post_loop',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('mobile_repair_zone_team_post_loop',array(
        'label' => esc_html__('No of Team post','mobile-repair-zone'),
        'section'   => 'mobile_repair_zone_team_post',
        'type'      => 'number',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 0,
            'max'              => 12,
        ),
    ));

    $team_post_loop = get_theme_mod('mobile_repair_zone_team_post_loop');

    $mobile_repair_zone_args = array('numberposts' => -1);
    $post_list = get_posts($mobile_repair_zone_args);
    $i = 1;
    $pst_sls[]= __('Select','mobile-repair-zone');
    foreach ($post_list as $key => $p_post) {
        $pst_sls[$p_post->ID]=$p_post->post_title;
    }
    for ( $i = 1; $i <= $team_post_loop; $i++ ) {
        $wp_customize->add_setting('mobile_repair_zone_other_team_post_section'.$i,array(
            'sanitize_callback' => 'mobile_repair_zone_sanitize_choices',
        ));
        $wp_customize->add_control('mobile_repair_zone_other_team_post_section'.$i,array(
            'type'    => 'select',
            'choices' => $pst_sls,
            'label' => __('Select Post','mobile-repair-zone'),
            'section' => 'mobile_repair_zone_team_post',
        ));
    }
    wp_reset_postdata();

    // Footer
    $wp_customize->add_section('mobile_repair_zone_site_footer_section', array(
        'title' => esc_html__('Footer', 'mobile-repair-zone'),
    ));

    $wp_customize->add_setting('mobile_repair_zone_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mobile_repair_zone_footer_text_setting', array(
        'label' => __('Replace the footer text', 'mobile-repair-zone'),
        'section' => 'mobile_repair_zone_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));
}
add_action('customize_register', 'mobile_repair_zone_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function mobile_repair_zone_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function mobile_repair_zone_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mobile_repair_zone_customize_preview_js(){
    wp_enqueue_script('mobile-repair-zone-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'mobile_repair_zone_customize_preview_js');
