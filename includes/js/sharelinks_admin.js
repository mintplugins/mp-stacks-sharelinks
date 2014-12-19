jQuery(document).ready(function($){
	
	mp_sharelinks_reset_icon_types();
		
	$(document).on('change', "[class$='sharelink_icon_typeBBBBB'] select, [class*='sharelink_icon_typeBBBBB '] select", function() {
		mp_sharelinks_reset_icon_types();
	});
	
	function mp_sharelinks_reset_icon_types(){
		
		$("[class$='sharelink_icon_typeBBBBB'] select>option:selected, [class*='sharelink_icon_typeBBBBB '] select>option:selected").map(function() {	
			
			var icon_type = $(this).val();
			
			//If the value of the selected option is sharelink_icon	
			if ( icon_type == 'sharelink_icon' ){
				//Show the icon field
				$(this).parent().parent().parent().find("[class$='sharelink_iconBBBBB'], [class*='sharelink_iconBBBBB ']").css('display', 'block');
				$(this).parent().parent().parent().find("[class$='sharelink_icon_colorBBBBB'], [class*='sharelink_icon_colorBBBBB ']").css('display', 'block');
				$(this).parent().parent().parent().find("[class$='sharelink_icon_color_hoverBBBBB'], [class*='sharelink_icon_color_hoverBBBBB ']").css('display', 'block');
				
				//Hide the the image field
				$(this).parent().parent().parent().find("[class$='sharelink_imageBBBBB'], [class*='sharelink_imageBBBBB ']").css('display', 'none');
				$(this).parent().parent().parent().find("[class$='sharelink_image_hoverBBBBB'], [class*='sharelink_image_hoverBBBBB ']").css('display', 'none');
			}
			else if( icon_type == 'sharelink_image' ){
				//Hide the icon field
				$(this).parent().parent().parent().find("[class$='sharelink_iconBBBBB'], [class*='sharelink_iconBBBBB ']").css('display', 'none');
				$(this).parent().parent().parent().find("[class$='sharelink_icon_colorBBBBB'], [class*='sharelink_icon_colorBBBBB ']").css('display', 'none');
				$(this).parent().parent().parent().find("[class$='sharelink_icon_color_hoverBBBBB'], [class*='sharelink_icon_color_hoverBBBBB ']").css('display', 'none');
				
				//Show the the image field
				$(this).parent().parent().parent().find("[class$='sharelink_imageBBBBB'], [class*='sharelink_imageBBBBB ']").css('display', 'block');
				$(this).parent().parent().parent().find("[class$='sharelink_image_hoverBBBBB'], [class*='sharelink_image_hoverBBBBB ']").css('display', 'block');
			}
			else{
				//Hide both the icon and the image selector fields
				$(this).parent().parent().parent().find("[class$='sharelink_iconBBBBB'], [class*='sharelink_iconBBBBB ']").css('display', 'none');
				$(this).parent().parent().parent().find("[class$='sharelink_icon_colorBBBBB'], [class*='sharelink_icon_colorBBBBB ']").css('display', 'none');
				$(this).parent().parent().parent().find("[class$='sharelink_icon_color_hoverBBBBB'], [class*='sharelink_icon_color_hoverBBBBB ']").css('display', 'none');
				
				$(this).parent().parent().parent().find("[class$='sharelink_imageBBBBB'], [class*='sharelink_imageBBBBB ']").css('display', 'none');
				$(this).parent().parent().parent().find("[class$='sharelink_image_hoverBBBBB'], [class*='sharelink_image_hoverBBBBB ']").css('display', 'none');
			}
						
		});
	}	
	
	//When a new sharelinks gets duplicated
	$(window).on('mp_core_duplicate_repeater_after', function(event, data){
		
		var containing_li = data[0];
		
		//Hide the icon
		$( containing_li ).next( ".mp_sharelinks_repeater_repeater" ).find("[class$='sharelink_iconBBBBB'], [class*='sharelink_iconBBBBB ']").css('display', 'none');
		$( containing_li ).next( ".mp_sharelinks_repeater_repeater" ).find("[class$='sharelink_icon_colorBBBBB'], [class*='sharelink_icon_colorBBBBB ']").css('display', 'none');
		$( containing_li ).next( ".mp_sharelinks_repeater_repeater" ).find("[class$='sharelink_icon_color_hoverBBBBB'], [class*='sharelink_icon_color_hoverBBBBB ']").css('display', 'none');
		
		//Hide image upload fields
		$( containing_li ).next( ".mp_sharelinks_repeater_repeater" ).find("[class$='sharelink_imageBBBBB'], [class*='sharelink_imageBBBBB ']").css('display', 'none');	
		$( containing_li ).next( ".mp_sharelinks_repeater_repeater" ).find("[class$='sharelink_image_hoverBBBBB'], [class*='sharelink_image_hoverBBBBB ']").css('display', 'none');		
		
	});
	
}); 