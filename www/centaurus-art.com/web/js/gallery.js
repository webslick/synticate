// Unitegallery init настройки

// Галерея (Look-Book)
jQuery(document).ready(function() {
	var apiGallery = jQuery("#brend_gallery").unitegallery({
		tiles_type:"nested",
		tiles_nested_optimal_tile_width: 400,
		tiles_space_between_cols: 10,
		tile_show_link_icon:true,
		tile_enable_textpanel:true,

/*		tile_enable_action:	true,			//enable tile action on click like lightbox
		tile_as_link: false,				//act the tile as link, no lightbox will appear

		tile_enable_textpanel: true,		 	//enable textpanel
		tile_textpanel_source: "title",
		tile_as_link: true,				//act the tile as link, no lightbox will appear 
		
		tile_enable_textpanel:true,
		tile_textpanel_title_text_align: "center",
		tile_textpanel_always_on: false,*/

		//tiles_justified_row_height: 400
					
	});

	jQuery('#brend_gallery .ug-thumb-wrapper').each(function(i, el) {
		var element = apiGallery.getItem(i);
		if (element.link == '') {
			jQuery(el).removeClass('ug-tile-clickable');
			jQuery(el).find('.ug-thumb-overlay').remove();
			jQuery(el).find('.ug-thumb-image').css('cursor', 'default');
		}
		if (element.title == '') {
			jQuery(el).find('.ug-textpanel').html('');
			
		}
	});	
});


// Галерея бренда
//jQuery(document).ready(function() {
//	var apiGallery = jQuery("#brend_gallery").unitegallery({
//		tiles_type:"nested",
//		tiles_nested_optimal_tile_width: 300,
//		tiles_space_between_cols: 10,
//		tile_show_link_icon:true,
//		tile_enable_textpanel:true,
//	});

//	jQuery('#brend_gallery .ug-thumb-wrapper').each(function(i, el) {
//		var element = apiGallery.getItem(i);
//		if (element.link == '') {
//			jQuery(el).removeClass('ug-tile-clickable');
//			jQuery(el).find('.ug-thumb-overlay').remove();
//			jQuery(el).find('.ug-thumb-image').css('cursor', 'default');
//		}
//		if (element.title == '') {
//			jQuery(el).find('.ug-textpanel').html('');
			
//		}
//	});	
//});