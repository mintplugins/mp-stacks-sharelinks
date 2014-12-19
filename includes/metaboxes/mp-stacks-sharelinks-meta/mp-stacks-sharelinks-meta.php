<?php
/**
 * This page contains functions for modifying the metabox for sharelinks as a media type
 *
 * @link http://mintplugins.com/doc/
 * @since 1.0.0
 *
 * @package    MP Stacks ShareLinks
 * @subpackage Functions
 *
 * @copyright   Copyright (c) 2014, Mint Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author      Philip Johnston
 */
 
/**
 * Add ShareLinks as a Media Type to the dropdown
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @param    array $args See link for description.
 * @return   void
 */
function mp_stacks_sharelinks_create_meta_box(){	
	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_stacks_sharelinks_add_meta_box = array(
		'metabox_id' => 'mp_stacks_sharelinks_metabox', 
		'metabox_title' => __( '"ShareLinks" Content-Type', 'mp_stacks_sharelinks'), 
		'metabox_posttype' => 'mp_brick', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_stacks_sharelinks_items_array = array(
		
		array(
			'field_id'			=> 'mp_stacks_sharelinks_links_showhider',
			'field_title' 	=> __( 'Share Links', 'mp_stacks_sharelinks'),
			'field_description' 	=> '',
			'field_type' 	=> 'showhider',
			'field_value' => '',
		),
		array(
			'field_id'			=> 'sharelink_service',
			'field_title' 	=> __( 'Share Link Service', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'Select the service to which this page will be shared (Facebook, Twitter, etc)',
			'field_type' 	=> 'select',
			'field_value' => '',
			'field_select_values' => array( 
				'twitter' => 'Twitter',
				'facebook' => 'Facebook',
				'pinterest' => 'Pinterest',
				'linkedin' => 'LinkedIn',
				'googleplus' => 'Google+',
			),
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
		),
		array(
			'field_id'			=> 'sharelink_icon_type',
			'field_title' 	=> __( 'Icon Type', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'Select the type of icon to use for this.',
			'field_type' 	=> 'select',
			'field_value' => '',
			'field_select_values' => array('sharelink_icon' => 'Icon', 'sharelink_image' => 'Custom Image'),
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
		),
		array(
			'field_id'			=> 'sharelink_icon',
			'field_title' 	=> __( 'Icon', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'Select the icon to use for this Share Link',
			'field_type' 	=> 'iconfontpicker',
			'field_value' => '',
			'field_select_values' => mp_stacks_sharelinks_get_sharelinks_icons(),
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
			'field_conditional_id' => 'sharelink_icon_type',
			'field_conditional_values' => array( 'sharelink_icon' )
		),
		array(
			'field_id'			=> 'sharelink_icon_color',
			'field_title' 	=> __( 'Custom Icon Color', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'If you\'d like a custom color for this specific icon, select it here:',
			'field_type' 	=> 'colorpicker',
			'field_value' => '',
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
			'field_conditional_id' => 'sharelink_icon_type',
			'field_conditional_values' => array( 'sharelink_icon' )
		),
		array(
			'field_id'			=> 'sharelink_icon_color_hover',
			'field_title' 	=> __( 'Custom Mouse-Over Icon Color', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'If you\'d like a custom color for this specific icon when the mouse is over, select it here:',
			'field_type' 	=> 'colorpicker',
			'field_value' => '',
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
			'field_conditional_id' => 'sharelink_icon_type',
			'field_conditional_values' => array( 'sharelink_icon' )
		),
		array(
			'field_id'			=> 'sharelink_image',
			'field_title' 	=> __( 'Icon', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'Upload the icon image to use for this Share Link. Tip: Make your image a perfect square.',
			'field_type' 	=> 'mediaupload',
			'field_value' => '',
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
			'field_conditional_id' => 'sharelink_icon_type',
			'field_conditional_values' => array( 'sharelink_image' )
		),
		array(
			'field_id'			=> 'sharelink_image_hover',
			'field_title' 	=> __( 'Icon when Mouse Over', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'Upload the icon image to use for this Share Link when the mouse is over it. Tip: Make sure this image matches the size of the one above and is a different color.',
			'field_type' 	=> 'mediaupload',
			'field_value' => '',
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
			'field_conditional_id' => 'sharelink_icon_type',
			'field_conditional_values' => array( 'sharelink_image' )
		),
		array(
			'field_id'			=> 'sharelink_icon_link_type',
			'field_title' 	=> __( 'Open Type', 'mp_stacks_sharelinks'),
			'field_description' 	=> 'Optional: How should this link open?',
			'field_type' 	=> 'select',
			'field_value' => '',
			'field_select_values' => array( '_parent' => __( 'Open in current Window/Tab', 'mp_stacks_sharelinks' ), '_blank' => __( 'Open in New Window/Tab', 'mp_stacks_sharelinks' ) ),
			'field_repeater' => 'mp_sharelinks_repeater',
			'field_showhider' => 'mp_stacks_sharelinks_links_showhider',
		),
		array(
			'field_id'			=> 'mp_stacks_sharelinks_layout_showhider',
			'field_title' 	=> __( 'ShareLinks Layout/Design', 'mp_stacks_sharelinks'),
			'field_description' 	=> NULL,
			'field_type' 	=> 'showhider',
			'field_value' => '',
		),
		array(
			'field_id'			=> 'sharelinks_per_row',
			'field_title' 	=> __( 'Links Per Row', 'mp_stacks_sharelinks'),
			'field_description' 	=> __( 'How many links do you want from left to right before a new row starts?', 'mp_stacks_sharelinks' ),
			'field_type' 	=> 'number',
			'field_value' => '3',
			'field_showhider' => 'mp_stacks_sharelinks_layout_showhider',
		),
		array(
			'field_id'			=> 'sharelinks_spacing',
			'field_title' 	=> __( 'Link Spacing', 'mp_stacks_sharelinks'),
			'field_description' 	=> __( 'How much space would you like to have in between each link? (In Pixels)', 'mp_stacks_sharelinks' ),
			'field_type' 	=> 'number',
			'field_value' => '10',
			'field_showhider' => 'mp_stacks_sharelinks_layout_showhider',
		),
		array(
			'field_id'			=> 'sharelinks_size',
			'field_title' 	=> __( 'Social Icon Size', 'mp_stacks_sharelinks'),
			'field_description' 	=> __( 'What size should the icons be? (Pixels)', 'mp_stacks_sharelinks' ),
			'field_type' 	=> 'number',
			'field_value' => '30',
			'field_showhider' => 'mp_stacks_sharelinks_layout_showhider',
		),
		array(
			'field_id'			=> 'sharelinks_color',
			'field_title' 	=> __( 'Default Icon Colors (Where applicable)', 'mp_stacks_sharelinks'),
			'field_description' 	=> __( 'Select the color the icons will be', 'mp_stacks_sharelinks' ),
			'field_type' 	=> 'colorpicker',
			'field_value' => '',
			'field_showhider' => 'mp_stacks_sharelinks_layout_showhider',
		),
		array(
			'field_id'			=> 'sharelinks_color_hover',
			'field_title' 	=> __( 'Default Mouse-Over Icon Colors (Where applicable)', 'mp_stacks_sharelinks'),
			'field_description' 	=> __( 'Select the color the icons will be when the mouse is over them', 'mp_stacks_sharelinks' ),
			'field_type' 	=> 'colorpicker',
			'field_value' => '',
			'field_showhider' => 'mp_stacks_sharelinks_layout_showhider',
		),
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_stacks_sharelinks_add_meta_box = has_filter('mp_stacks_sharelinks_meta_box_array') ? apply_filters( 'mp_stacks_sharelinks_meta_box_array', $mp_stacks_sharelinks_add_meta_box) : $mp_stacks_sharelinks_add_meta_box;
	
	//Globalize the and populate mp_stacks_sharelinks_items_array (do this before filter hooks are run)
	global $global_mp_stacks_sharelinks_items_array;
	$global_mp_stacks_sharelinks_items_array = $mp_stacks_sharelinks_items_array;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_stacks_sharelinks_items_array = has_filter('mp_stacks_sharelinks_items_array') ? apply_filters( 'mp_stacks_sharelinks_items_array', $mp_stacks_sharelinks_items_array) : $mp_stacks_sharelinks_items_array;
	
	/**
	 * Create Metabox class
	 */
	global $mp_stacks_sharelinks_meta_box;
	$mp_stacks_sharelinks_meta_box = new MP_CORE_Metabox($mp_stacks_sharelinks_add_meta_box, $mp_stacks_sharelinks_items_array);
}
add_action('mp_brick_metabox', 'mp_stacks_sharelinks_create_meta_box');