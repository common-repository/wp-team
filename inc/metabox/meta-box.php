<?php

/*--------------------------------------------------------------
*			Member info
*-------------------------------------------------------------*/

function wp_team_member_info_meta_box() {
	add_meta_box( 'member_info_meta', esc_html__( 'Member Info', 'wp-team' ), 'wp_team_member_info_meta_callback', 'wp_team', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'wp_team_member_info_meta_box');


// member info callback
function wp_team_member_info_meta_callback( $member_info ) {

	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>

	<div style="margin: 10px 0;"><label for="designation" style="width:150px; display:inline-block;"><?php esc_html_e( 'Designation', 'wp-team' ) ?></label>
	<?php $designation = get_post_meta( $member_info->ID, 'designation', true ); ?>
	<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>" style="width:300px;"/>
	</div>

<?php }


/*--------------------------------------------------------------
*			Member social links
*-------------------------------------------------------------*/

function wpv_wp_team_member_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Member Social Links', 'wp-team' ), 'wp_team_social_meta_link_callback', 'wp_team', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'wpv_wp_team_member_social_link_meta_box' );


// Social Meta Callback
function wp_team_social_meta_link_callback( $social_meta ) {

	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>

	<!-- member social -->
	<div class="wrap-meta-group">

		<div style="margin: 10px 0;"><label for="facebook" style="width:150px; display:inline-block;"><?php esc_html_e( 'Facebook', 'wp-team' ) ?></label>
			<?php $facebook = get_post_meta( $social_meta->ID, 'facebook', true ); ?>
			<input type="text" name="facebook" id="facebook" class="facebook" value="<?php echo esc_html($facebook); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="twitter" style="width:150px; display:inline-block;"><?php esc_html_e(
					'Twitter', 'wp-team' ) ?></label>
			<?php $twitter = get_post_meta( $social_meta->ID, 'twitter', true ); ?>
			<input type="text" name="twitter" id="twitter" class="twitter" value="<?php echo esc_html($twitter); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="google_plus" style="width:150px; display:inline-block;"><?php esc_html_e( 'Google Plus', 'wp-team' ) ?></label>
			<?php $google_plus = get_post_meta( $social_meta->ID, 'google_plus', true ); ?>
			<input type="text" name="google_plus" id="google_plus" class="google_plus" value="<?php echo esc_html($google_plus); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="instagram" style="width:150px; display:inline-block;"><?php esc_html_e( 'Instagram', 'wp-team' ) ?></label>
			<?php $instagram = get_post_meta( $social_meta->ID, 'instagram', true ); ?>
			<input type="text" name="instagram" id="instagram" class="instagram" value="<?php echo esc_html($instagram); ?>" style="width:300px;"/>
		</div>

	</div>
<?php }


/*--------------------------------------------------------------
 *			Save member social meta
*-------------------------------------------------------------*/
function save_wp_team_member_social_meta( $post_id ) {
	if ( ! isset( $_POST['member_social_metabox_nonce'] ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'wp_team' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$mymeta = array( 'facebook', 'twitter', 'google_plus', 'instagram', 'designation' );

	foreach ( $mymeta as $keys ) {

		if ( is_array( $_POST[ $keys ] ) ) {
			$data = array();

			foreach ( $_POST[ $keys ] as $key => $value ) {
				$data[] = $value;
			}
		} else {
			$data = sanitize_text_field( $_POST[ $keys ] );
		}

		update_post_meta( $post_id, $keys, $data );
	}

}

add_action( 'save_post', 'save_wp_team_member_social_meta' );