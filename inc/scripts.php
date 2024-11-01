<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/*** Plugin Scripts and CSS ***/
if ( ! function_exists( 'wpv_wp_team_scripts_and_styles' ) ) {
	function wpv_wp_team_scripts_and_styles() {
		// CSS Files
		wp_enqueue_style( 'slick', WPV_WP_TEAM_URL . 'assets/css/slick.css', array(), null );
		wp_enqueue_style( 'font-awesome-min', WPV_WP_TEAM_URL . 'assets/css/font-awesome.min.css', array(), null );
		wp_enqueue_style( 'wp-team-style', WPV_WP_TEAM_URL . 'assets/css/style.css' );

		//JS Files
		wp_enqueue_script( 'slick-min-js', WPV_WP_TEAM_URL . 'assets/js/slick.min.js', array( 'jquery' ), null, true );
	}
	add_action( 'wp_enqueue_scripts', 'wpv_wp_team_scripts_and_styles' );
}

// Plugin admin Scripts and CSS
if ( is_admin() ) {
	function wpv_wp_team_admin_scripts_and_styles() {
		// Meta Box
		wp_enqueue_style( 'wp-team-meta-style', WPV_WP_TEAM_URL . '/inc/metabox/assets/css/admin.css' );
	}
	add_action( 'admin_enqueue_scripts', 'wpv_wp_team_admin_scripts_and_styles' );
}