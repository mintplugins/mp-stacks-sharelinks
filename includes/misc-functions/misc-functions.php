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
 * Function which returns an array of font awesome icons
 */
function mp_stacks_sharelinks_get_sharelinks_icons(){

	//Get all font styles in the css document and put them in an array
	$pattern = '/\.(mp-stacks-sharelinks-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

	$path = MP_STACKS_SHARELINKS_PLUGIN_DIR . 'includes/fonts/fontello/css/fontello.css';

    // We gotta get fancy here to include the CSS the way we need it. Standard wp_remote_get methods fail because it's local
    ob_start();
    include( $path );
    $response = ob_get_clean();

	preg_match_all($pattern, $response, $matches, PREG_SET_ORDER);

	$icons = array();

	foreach($matches as $match){
		$icons[$match[1]] = $match[1];
	}

	return $icons;
}
