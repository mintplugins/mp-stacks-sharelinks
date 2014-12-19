<?php
/**
 * This file contains the enqueue scripts function for the sharelinks plugin
 *
 * @since 1.0.0
 *
 * @package    MP Stacks Features
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
 * Enqueue JS and CSS for sharelinks 
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */

/**
 * Enqueue css and js
 *
 * Filter: mp_stacks_sharelinks_css_location
 */
function mp_stacks_sharelinks_enqueue_scripts(){
	
	//Enqueue Font Awesome CSS
	wp_enqueue_style( 'mp-stacks-sharelinks-icons', plugins_url( '/fonts/fontello/css/fontello.css', dirname( __FILE__ ) ) );
			
	//Enqueue sharelinks CSS
	wp_enqueue_style( 'mp_stacks_sharelinks_css', plugins_url( 'css/sharelinks.css', dirname( __FILE__ ) ) );

}
add_action( 'wp_enqueue_scripts', 'mp_stacks_sharelinks_enqueue_scripts' );

/**
 * Enqueue css and js
 *
 * Filter: mp_stacks_sharelinks_css_location
 */
function mp_stacks_sharelinks_admin_enqueue_scripts(){
	
	//Enqueue Admin Features CSS
	wp_enqueue_style( 'mp_stacks_sharelinks_css', plugins_url( 'css/admin-sharelinks.css', dirname( __FILE__ ) ) );
	
	//Enqueue Font Awesome CSS
	wp_enqueue_style( 'mp-stacks-sharelinks-icons', plugins_url( '/fonts/fontello/css/fontello.css', dirname( __FILE__ ) ) );

}
add_action( 'admin_enqueue_scripts', 'mp_stacks_sharelinks_admin_enqueue_scripts' );