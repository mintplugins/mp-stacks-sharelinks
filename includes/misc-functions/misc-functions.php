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
	//$subject = file_get_contents( plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
	
	// Initializing curl
	$ch = curl_init();
	 
	//Return Transfer
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	//File to fetch
	curl_setopt($ch, CURLOPT_URL, plugins_url( '/fonts/fontello/css/fontello.css', dirname( __FILE__ ) ) );
											 
	// Getting results
	$subject =  curl_exec($ch); // Getting jSON result string
	
	curl_close($ch);
	
	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
	
	$icons = array();

	foreach($matches as $match){
		$icons[$match[1]] = $match[1];
	}
	
	return $icons;
}