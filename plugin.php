<?php
/**
 * Plugin Name:     (WP-EXT) Widget
 * Plugin URI:      https://metastore.pro/
 *
 * Description:     Widget and more.
 *
 * Author:          Kitsune Solar
 * Author URI:      https://kitsune.solar/
 *
 * Version:         1.0.0
 *
 * Text Domain:     wp-ext-widget
 * Domain Path:     /languages
 *
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Loading `WP_EXT_Widget`.
 */

function run_wp_ext_widget() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Widget.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Widget_Theme.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Widget_ChildPage.class.php' );
}

run_wp_ext_widget();
