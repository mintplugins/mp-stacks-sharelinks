<?php
/**
 * This file contains the enqueue scripts function for the sharelinks plugin
 *
 * @since 1.0.0
 *
 * @package    MP Stacks Features
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2015, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * Enqueue Admin CSS for Ajax
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param  	 array $stylesheets An array containing the urls for each stylesheet as a key>value pair. Each key is what you'd use as the 'handle' in a wp_enqueue_scripts
 * @return   array $stylesheets The incoming array with our additional stylesheet urls added. These will be added to the Brick Editor <head> upon ajax completion.
 */
function mp_stacks_sharelinks_ajax_admin_css( $stylesheets, $metabox_id ){
	
	if ( $metabox_id != 'mp_stacks_sharelinks_metabox' ){
		return $stylesheets;
	}
	
	//Enqueue Admin CSS
	$stylesheets['mp_stacks_sharelinks_css'] = plugins_url( 'css/admin-sharelinks.css?ver=' . MP_STACKS_SHARELINKS_VERSION, dirname( __FILE__ ) );
	
	//Enqueue Admin CSS
	$stylesheets['mp-stacks-sharelinks-icons'] = plugins_url( '/fonts/fontello/css/fontello.css?ver=' . MP_STACKS_SHARELINKS_VERSION, dirname( __FILE__ ) );
	
	return $stylesheets;

}
add_filter( 'mp_core_metabox_ajax_admin_css_stylesheets', 'mp_stacks_sharelinks_ajax_admin_css', 10, 2 );