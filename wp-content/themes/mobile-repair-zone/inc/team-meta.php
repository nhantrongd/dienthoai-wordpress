<?php

// Team Meta
function mobile_repair_zone_bn_custom_meta_team() {
    add_meta_box( 'bn_meta', __( 'Team Meta Feilds', 'mobile-repair-zone' ), 'mobile_repair_zone_meta_callback_team', 'post', 'normal', 'high' );
}

if (is_admin()){
  add_action('admin_menu', 'mobile_repair_zone_bn_custom_meta_team');
}

function mobile_repair_zone_meta_callback_team( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'mobile_repair_zone_team_meta_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $team_designation = get_post_meta( $post->ID, 'mobile_repair_zone_team_designation', true );
    ?>
    <div id="testimonials_custom_stuff">
        <table id="list">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-8">
                    <td class="left">
                        <?php esc_html_e( 'Team Designation', 'mobile-repair-zone' )?>
                    </td>
                    <td class="left">
                        <input type="text" name="mobile_repair_zone_team_designation" id="mobile_repair_zone_team_designation" value="<?php echo esc_html($team_designation); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/* Saves the custom meta input */
function mobile_repair_zone_bn_metadesig_save( $post_id ) {
    if (!isset($_POST['mobile_repair_zone_team_meta_nonce']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['mobile_repair_zone_team_meta_nonce']) ), basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save Trip Amount
    if( isset( $_POST[ 'mobile_repair_zone_team_designation' ] ) ) {
        update_post_meta( $post_id, 'mobile_repair_zone_team_designation', strip_tags( wp_unslash( $_POST[ 'mobile_repair_zone_team_designation' ]) ) );
    }
}
add_action( 'save_post', 'mobile_repair_zone_bn_metadesig_save' );