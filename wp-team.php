<?php
/*
Plugin Name: WP Team
Description: WP Team will enable Team carousel section in your WordPress website.
Plugin URI: http://wpvane.com/products/wp-team-pro
Author: WPVane
Author URI: http://wpvane.com
Version: 0.0.1
*/


/* Define */
define( 'WPV_WP_TEAM_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'WPV_WP_TEAM_PATH', plugin_dir_path( __FILE__ ) );


/* Including files */
if(file_exists( WPV_WP_TEAM_PATH . 'inc/functions.php')){
	require_once(WPV_WP_TEAM_PATH . "inc/functions.php");
}
if(file_exists( WPV_WP_TEAM_PATH . 'inc/scripts.php')){
	require_once(WPV_WP_TEAM_PATH . "inc/scripts.php");
}
if(file_exists( WPV_WP_TEAM_PATH . 'inc/shortcodes.php')){
	require_once(WPV_WP_TEAM_PATH . "inc/shortcodes.php");
}