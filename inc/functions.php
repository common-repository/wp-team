<?php

// Member Image Size
add_theme_support( 'post-thumbnails' );
add_image_size( 'wp-team-member-image', 400, 400, true );


// Register Team Post Type
function wpv_wp_team_register_post_type() {

	$labels = array(
		'name'               => esc_html__( 'Members', 'wp-team' ),
		'singular_name'      => esc_html__( 'Member', 'wp-team' ),
		'add_new'            => esc_html_x( 'Add New Member', 'wp-team', 'wp-team' ),
		'add_new_item'       => esc_html__( 'Add New Member', 'wp-team' ),
		'edit_item'          => esc_html__( 'Edit Member', 'wp-team' ),
		'new_item'           => esc_html__( 'New Member', 'wp-team' ),
		'all_items'          => esc_html__( 'All Members', 'wp-team' ),
		'view_item'          => esc_html__( 'View Member', 'wp-team' ),
		'search_items'       => esc_html__( 'Search Members', 'wp-team' ),
		'not_found'          => esc_html__( 'No Members found', 'wp-team' ),
		'not_found_in_trash' => esc_html__( 'No Members found in Trash', 'wp-team' ),
		'parent_item_colon'  => esc_html__( 'Parent Member:', 'wp-team' ),
		'menu_name'          => esc_html__( 'WP Team', 'wp-team' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-businessman',
		'supports'           => array( 'title', 'thumbnail' )
	);

	register_post_type( 'wp_team', $args );

}

add_action( 'init', 'wpv_wp_team_register_post_type' );


// Meta Box
if ( file_exists( WPV_WP_TEAM_PATH . 'inc/metabox/meta-box.php' ) ) {
	require_once( WPV_WP_TEAM_PATH . "inc/metabox/meta-box.php" );
}