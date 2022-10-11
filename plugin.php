<?php
/*
Plugin Name:	Oxyblock Core - Components
Plugin URI:		https://core.oxyblock.xyz
Description:	Modern CSS Framework based on Oxyblock UI
Version:		0.2.2
Author:			Oxyblock
Author URI:		https://oxyblock.com/
License:		GPL-3.0+
License URI:	http://www.gnu.org/licenses/gpl-3.0.txt
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'wp_enqueue_scripts', 'oxyblockCoreComponents_enqueue_files' );
function oxyblockCoreComponents_enqueue_files() {
	if ( ! class_exists( 'CT_Component' ) ) { // if Oxygen is not active
		wp_enqueue_style( 'ob-core-components', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-components.css' );
	}
}

// 1000000 priority so it is executed after all Oxygen's styles
add_action( 'wp_head', 'oxyblockCoreComponents_enqueue_css_after_oxygens', 1000000 );
function oxyblockCoreComponents_enqueue_css_after_oxygens() {
	// if Oxygen is not active, abort.
	if ( ! class_exists( 'CT_Component' ) ) {
		return;
	}

	$styles = new WP_Styles;
	$styles->add( 'ob-core-components', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-components.css' );
	$styles->enqueue( array ( 'ob-core-components' ) );
	$styles->do_items();
}