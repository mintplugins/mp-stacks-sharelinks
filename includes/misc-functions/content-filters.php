<?php 
/**
 * This file contains the function which hooks to a brick's content output
 *
 * @since 1.0.0
 *
 * @package    MP Stacks ShareLinks
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * This function hooks to the brick css output. If it is supposed to be a 'sharelink', then it will add the css for those sharelinks to the brick's css
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_stacks_brick_content_output_css_sharelinks( $css_output, $post_id, $first_content_type, $second_content_type ){
	
	if ( $first_content_type != 'sharelinks' && $second_content_type != 'sharelinks' ){
		return $css_output;	
	}
	
	//Enqueue Font Awesome CSS
	wp_enqueue_style( 'mp-stacks-sharelinks-icons', plugins_url( '/fonts/fontello/css/fontello.css', dirname( __FILE__ ) ), array(), MP_STACKS_SHARELINKS_VERSION );
			
	//Enqueue sharelinks CSS
	wp_enqueue_style( 'mp_stacks_sharelinks_css', plugins_url( 'css/sharelinks.css', dirname( __FILE__ ) ), array(), MP_STACKS_SHARELINKS_VERSION );
	
	//Get ShareLinks Metabox Repeater Array
	$sharelinks_repeaters = get_post_meta($post_id, 'mp_sharelinks_repeater', true);
	
	//If no sharelinks have been set up, return
	if ( empty( $sharelinks_repeaters ) ){
		return $css_output;
	}
	
	//ShareLinks per row
	$sharelinks_per_row = get_post_meta($post_id, 'sharelinks_per_row', true);
	$sharelinks_per_row = empty( $sharelinks_per_row ) ? '2' : $sharelinks_per_row;
	
	//ShareLinks spacing
	$sharelinks_spacing = get_post_meta($post_id, 'sharelinks_spacing', true);
	$sharelinks_spacing = empty( $sharelinks_spacing ) ? '20' : $sharelinks_spacing;
	
	//ShareLinks icon size
	$sharelinks_size = get_post_meta($post_id, 'sharelinks_size', true);
	$sharelinks_size = empty( $sharelinks_size ) ? 20 : $sharelinks_size;
	
	//ShareLinks Color
	$sharelinks_color = get_post_meta($post_id, 'sharelinks_color', true);
	$sharelinks_color = empty( $sharelinks_color ) ? '#FFF' : $sharelinks_color;
	
	//ShareLinks color hover 
	$sharelinks_color_hover = get_post_meta($post_id, 'sharelinks_color_hover', true);
	$sharelinks_color_hover = empty( $sharelinks_color_hover ) ? '#FFF' : $sharelinks_color_hover;
	
	//ShareLinks icon hover size - make it .5 bigger than non-hover to cover weird whitespace
	$sharelinks_hover_size = get_post_meta($post_id, 'sharelinks_size', true);
	$sharelinks_hover_size = empty( $sharelinks_hover_size ) ? '20.5px' : $sharelinks_hover_size . 'px';
	
	//Set ShareLinks CSS Output
	$css_sharelinks_output = '
	#mp-brick-' . $post_id . ' .mp-stacks-sharelink{ 
		width:' . $sharelinks_size .'px;
		height: ' . $sharelinks_size . 'px;
		margin: ' . $sharelinks_spacing . 'px;
	}
	#mp-brick-' . $post_id . ' .mp-stacks-sharelink a{ 
		color:' . $sharelinks_color . ';
	}
	#mp-brick-' . $post_id . ' .mp-stacks-sharelink a:hover{ 
		color:' . $sharelinks_color_hover . ';
		font-size:' . $sharelinks_hover_size . ';
	}
	#mp-brick-' . $post_id . ' .mp-stacks-sharelinks-icon-container {
		width: ' . $sharelinks_size . 'px;
	}
	#mp-brick-' . $post_id . ' .mp-stacks-sharelinks-icon {
		font-size: ' . $sharelinks_size . 'px;
		width: ' . $sharelinks_size . 'px;
	}
	#mp-brick-' . $post_id . ' .mp-stacks-sharelinks-image {
		width: ' . $sharelinks_size . 'px;
		height: ' . $sharelinks_size . 'px;
		background-size: ' . $sharelinks_size . 'px;
	}';
		
	if ($sharelinks_repeaters ){
	
		$social_link_counter = 0;
		
		//Loop through each sharelink
		foreach( $sharelinks_repeaters as $sharelinks_repeater ){
			
			//If we are using an icon
			if ( $sharelinks_repeater['sharelink_icon_type'] == 'sharelink_icon' ){
				
				//Get and set Social Icon Color Hover
				$sharelink_icon_color = $sharelinks_repeater['sharelink_icon_color'];
				$sharelink_icon_color = !empty( $sharelink_icon_color ) ? $sharelink_icon_color : NULL;
				
				//CSS for this Social Icon's Color 
				if ( !empty( $sharelink_icon_color ) ){
					$css_sharelinks_output .= '#mp-brick-' . $post_id . ' .mp-stacks-sharelink-' . $social_link_counter . ' a{';
						$css_sharelinks_output .= 'color:' . $sharelink_icon_color . ';';
					$css_sharelinks_output .= '}';
				}
				
				//Get and set Social Icon Color Hover
				$sharelink_icon_color_hover = $sharelinks_repeater['sharelink_icon_color_hover'];
				$sharelink_icon_color_hover = !empty( $sharelink_icon_color_hover ) ? $sharelink_icon_color_hover : NULL;
				
				
				//CSS for this Social Icon's Color Hover
				if ( !empty( $sharelink_icon_color_hover ) ){
					$css_sharelinks_output .= '#mp-brick-' . $post_id . ' .mp-stacks-sharelink-' . $social_link_counter . ' a:hover{';
						$css_sharelinks_output .= 'color:' . $sharelink_icon_color_hover . ';';
					$css_sharelinks_output .= '}';
				}
			}
			//If we are using an image instead of a font icon
			else if ( $sharelinks_repeater['sharelink_icon_type'] == 'sharelink_image' ){
				
				//ShareLinks Image
				$sharelink_image = $sharelinks_repeater['sharelink_image'];
				
				//ShareLinks Image Hover
				$sharelink_image_hover = $sharelinks_repeater['sharelink_image_hover'];
				
				//CSS for this Social Image
				if ( !empty( $sharelink_image ) ){
						$css_sharelinks_output .= '#mp-brick-' . $post_id . ' .mp-stacks-sharelink-' . $social_link_counter . ' a .mp-stacks-sharelinks-image{';
							$css_sharelinks_output .= 'background-image: url(\'' . $sharelink_image . '\');';
						$css_sharelinks_output .= '}';
						$css_sharelinks_output .= '#mp-brick-' . $post_id . ' .mp-stacks-sharelink-' . $social_link_counter . ' a:hover .mp-stacks-sharelinks-image{';
							$css_sharelinks_output .= 'background-image: url(\'' . $sharelink_image_hover . '\');';
						$css_sharelinks_output .= '}';
				}
			}
			
			//Increment social link counter
			$social_link_counter = $social_link_counter + 1;
			
		}
	}

	return $css_sharelinks_output . $css_output;
		
}
add_filter('mp_brick_additional_css', 'mp_stacks_brick_content_output_css_sharelinks', 10, 4);

/**
 * This function hooks to the brick output. If it is supposed to be a 'sharelink', then it will output the sharelinks
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_stacks_brick_content_output_sharelinks($default_content_output, $mp_stacks_content_type, $post_id){
	
	//If this stack content type is set to be an image	
	if ($mp_stacks_content_type != 'sharelinks'){
		return $default_content_output;	
	}
		
	//Set default value for $content_output to NULL
	$content_output = NULL;	
	
	//Get ShareLinks Metabox Repeater Array
	$sharelinks_repeaters = get_post_meta($post_id, 'mp_sharelinks_repeater', true);
	
	//ShareLinks per row
	$sharelinks_per_row = get_post_meta($post_id, 'sharelinks_per_row', true);
	$sharelinks_per_row = empty( $sharelinks_per_row ) ? '2' : $sharelinks_per_row;
	
	//Feature alignment
	$sharelink_alignment = get_post_meta($post_id, 'sharelink_alignment', true);
	$sharelink_alignment = empty( $sharelink_alignment ) ? 'left' : $sharelink_alignment;

	//Get ShareLinks Output
	$sharelinks_output = '<div class="mp-stacks-sharelinks">';
	
	//Set counter to 0
	$counter = 1;
	
	//get the queried post id
	global $wp_query;
	
	//If we are NOT doing ajax get the parent's post id from the wp_query.
	if ( !defined( 'DOING_AJAX' ) ){
		$queried_id = $wp_query->queried_object_id;
	}
	//If we are doing ajax, get the parent's post id from the AJAX-passed $POST['mp_stacks_queried_object_id']
	else{
		$queried_id = isset( $_POST['mp_stacks_queried_object_id'] ) ? $_POST['mp_stacks_queried_object_id'] : '';
	}
	
	$featured_image = mp_core_the_featured_image( $queried_id );
	
	if ($sharelinks_repeaters ){
		
		$social_link_counter = 0;
		
		//Loop through each sharelink
		foreach( $sharelinks_repeaters as $sharelinks_repeater ){
						
			$sharelinks_output .= '<div class="mp-stacks-sharelink mp-stacks-sharelink-' . $social_link_counter . '">';
								
				//If the user has saved an open type
				if ( !empty($sharelinks_repeater['sharelink_icon_link_type'])){
					$target = $sharelinks_repeater['sharelink_icon_link_type'];
				}
				//If they haven't saved an open type
				else{
					$target = 'popup_window';
				}
				
				//Get the format of the share url based on the service
				switch ($sharelinks_repeater['sharelink_service'] ){
					case 'twitter':
						$share_url = 'http://twitter.com/?status=' . mp_core_get_current_url();
						$popup_width = '500';
						$popup_height = '440';
						break;
					case 'facebook':
						$share_url = 'http://www.facebook.com/share.php?u=' . mp_core_get_current_url();
						$popup_width = '500';
						$popup_height = '532';
						break;
					case 'pinterest':
						$share_url = 'http://pinterest.com/pin/create/button/?url=' . mp_core_get_current_url() . '&media=' . $featured_image . '&description=' . htmlspecialchars( strip_tags( mp_core_get_excerpt_by_id( $queried_id ) ) ) . ' | ' . get_bloginfo( 'name' );
						$popup_width = '500';
						$popup_height = '325';
						break;
					case 'linkedin':
						$share_url = 'http://www.linkedin.com/shareArticle?mini=true&url=' . mp_core_get_current_url() . '&title=' . the_title_attribute( 'echo=0&post=' . $queried_id ) . ' | ' . get_bloginfo( 'name' ) . '&summary=' . htmlspecialchars( strip_tags( mp_core_get_excerpt_by_id( $queried_id ) ) ) . '&source=' . get_bloginfo( 'wpurl' );
						$popup_width = '500';
						$popup_height = '600';
						break;
					case 'googleplus':
						$share_url = 'https://plus.google.com/share?url=' . mp_core_get_current_url();
						$popup_width = '500';
						$popup_height = '500';
						break;
				}
				
				if ( empty( $share_url ) ){
					return false;	
				}
				
				$target = $target == '_blank' ? ' target="_blank" ' : 'onclick="window.open(\'' . $share_url. '\', \'' . the_title_attribute( 'echo=0&post=' . $queried_id ) . '\', \'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' . $popup_width  . ', height=' . $popup_height . '\'); return false;"';
				
				$sharelinks_output .= '<a href="' . $share_url . '" class="mp-stacks-sharelinks-icon-link" ' . $target . ' title="' . the_title_attribute( 'echo=0&post=' . $queried_id )  . '">';
										
					//If we should use an image as the sociallind icon
					if ( $sharelinks_repeater['sharelink_icon_type'] == 'sharelink_image' ){
						$sharelinks_output .= '<div class="mp-stacks-sharelinks-icon-container mp-stacks-sharelinks-image">';
						$sharelinks_output .= '</div>';
					}
					//If we should use an icon from the icon font
					else{	
						$sharelinks_output .= '<div class="mp-stacks-sharelinks-icon-container mp-stacks-sharelinks-icon">';
							$sharelinks_output .= '<div class="mp-stacks-sharelinks-icon ' . $sharelinks_repeater['sharelink_icon'] . '" ' . $sharelinks_repeater['sharelink_icon_color'] . '></div>';
						$sharelinks_output .= '</div>';
					}
				
				$sharelinks_output .= !empty($sharelinks_repeater['sharelink_icon_link']) ? '</a>' : NULL;
										
				$sharelinks_output .= $sharelink_alignment == 'center' ? '<div class="mp-stacks-sharelinks-clearedfix"></div>' : NULL;
				
			$sharelinks_output .= '</div>';
			
			if ( $sharelinks_per_row == $counter ){
				
				//Add clear div to bump a new row
				$sharelinks_output .= '<div class="mp-stacks-sharelinks-clearedfix"></div>';
				
				//Reset counter
				$counter = 1;
			}
			else{
				
				//Increment Counter
				$counter = $counter + 1;
				
			}	
			
			$social_link_counter = $social_link_counter + 1;
		}
	}
	
	$sharelinks_output .= '</div>';
	
	//Content output
	$content_output .= $sharelinks_output;
	
	//Return
	return $content_output;
	
}
add_filter('mp_stacks_brick_content_output', 'mp_stacks_brick_content_output_sharelinks', 10, 3);