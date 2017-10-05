jQuery(document).ready(function($) {
	'use strict';

	/********** POST TYPE SELECTOR START **********/
	$('#post-formats-select input').on('change', function() {
		if($(this).attr("id") =="post-format-audio") {
			$("#setting_post_audio_embed").css("display", "block");
			$("#setting_post_link_embed").css("display", "none");
			$("#setting_post_video_embed").css("display", "none");
			$("#setting_post_images").css("display", "none");
		}
		else if ($(this).attr("id") =="post-format-video") {
			$("#setting_post_video_embed").css("display", "block");
			$("#setting_post_audio_embed").css("display", "none");
			$("#setting_post_link_embed").css("display", "none");
			$("#setting_post_images").css("display", "none");
			
		}
		else if($(this).attr("id") =="post-format-link") {
			$("#setting_post_link_embed").css("display", "block");
			$("#setting_post_video_embed").css("display", "none");
			$("#setting_post_audio_embed").css("display", "none");
			$("#setting_post_images").css("display", "none");
		}
		else if($(this).attr("id") =="post-format-gallery") {
			$("#setting_post_images").css("display", "block");
			$("#setting_post_link_embed").css("display", "none");
			$("#setting_post_video_embed").css("display", "none");
			$("#setting_post_audio_embed").css("display", "none");
		}
		else {
			$("#setting_post_link_embed").css("display", "none");
			$("#setting_post_video_embed").css("display", "none");
			$("#setting_post_audio_embed").css("display", "none");
			$("#setting_post_images").css("display", "none");
		};
	});
	
	$("#post-formats-select input[checked]").each( 
		function() {
			var post_type_check = $(this).val();
			if(post_type_check == "audio") {
				$("#setting_post_audio_embed").css("display", "block");
				$("#setting_post_link_embed").css("display", "none");
				$("#setting_post_video_embed").css("display", "none");
				$("#setting_post_images").css("display", "none");
			}
			else if(post_type_check == "video") {
				$("#setting_post_video_embed").css("display", "block");
				$("#setting_post_audio_embed").css("display", "none");
				$("#setting_post_link_embed").css("display", "none");
				$("#setting_post_images").css("display", "none");
			}
			else if(post_type_check == "link") {
				$("#setting_post_link_embed").css("display", "block");
				$("#setting_post_video_embed").css("display", "none");
				$("#setting_post_audio_embed").css("display", "none");
				$("#setting_post_images").css("display", "none");
			}
			else if(post_type_check == "gallery") {
				$("#setting_post_images").css("display", "block");
				$("#setting_post_link_embed").css("display", "none");
				$("#setting_post_video_embed").css("display", "none");
				$("#setting_post_audio_embed").css("display", "none");
			}
			else{
				$("#setting_post_link_embed").css("display", "none");
				$("#setting_post_video_embed").css("display", "none");
				$("#setting_post_audio_embed").css("display", "none");
				$("#setting_post_images").css("display", "none");
			}
		} 
	);
	/********** POST TYPE SELECTOR END **********/

	/********** TAXONOMY SEARCH BOX START **********/
	$('.type-taxonomy-checkbox .format-setting-inner p:first-child').before('<input class="ot-taxonomy-search widefat option-tree-ui-upload-input " type="text" />'+'<span class="ot-taxonomy-search-clear-button"><a onclick="return false;" class="ot-taxonomy-search-clear option-tree-ui-button button button-primary light"><div class="dashicons dashicons-trash"></div></a></span>');
	$('.type-taxonomy-checkbox .format-setting-inner .ot-taxonomy-search').keyup(function(){
		var valThis = $(this).val().toLowerCase();
		$('.type-taxonomy-checkbox .format-setting-inner input[type=checkbox]').each(function(){
			var text = $("label[for='"+$(this).attr('id')+"']").text().toLowerCase();
			(text.indexOf(valThis) == 0) ? $(this).parent().show() : $(this).parent().hide();
		});
	});
	$(".type-taxonomy-checkbox .format-setting-inner .ot-taxonomy-search-clear").click(function(){
		$(".type-taxonomy-checkbox .format-setting-inner .ot-taxonomy-search").val("");
		$('.type-taxonomy-checkbox .format-setting-inner input[type=checkbox]').each(function(){
			$(this).parent().show();
		});
	});
	/********** TAXONOMY SEARCH BOX END **********/

	/********** POST TYPE SEARCH BOX START **********/
	$('.type-custom-post-type-checkbox .format-setting-inner p:first-child').before('<input class="ot-custom-post-type-search widefat option-tree-ui-upload-input " type="text" />'+'<span class="ot-custom-post-type-search-clear-button"><a onclick="return false;" class="ot-custom-post-type-search-clear option-tree-ui-button button button-primary light"><div class="dashicons dashicons-trash"></div></a></span>');
	$('.type-custom-post-type-checkbox .format-setting-inner .ot-custom-post-type-search').keyup(function(){
		var valThis = $(this).val().toLowerCase();
		$('.type-custom-post-type-checkbox .format-setting-inner input[type=checkbox]').each(function(){
			var text = $("label[for='"+$(this).attr('id')+"']").text().toLowerCase();
			(text.indexOf(valThis) == 0) ? $(this).parent().show() : $(this).parent().hide();
		});
	});
	$(".type-custom-post-type-checkbox .format-setting-inner .ot-custom-post-type-search-clear").click(function(){
		$(".type-custom-post-type-checkbox .format-setting-inner .ot-custom-post-type-search").val("");
		$('.type-custom-post-type-checkbox .format-setting-inner input[type=checkbox]').each(function(){
			$(this).parent().show();
		});
	});
	/********** POST TYPE SEARCH BOX END **********/

	/********** ADMIN WIDGETS START **********/
	function close_accordion_section() {
		jQuery('.eventchamp-widget-accordion .eventchamp-widget-accordion-section-title').removeClass('active');
		jQuery('.eventchamp-widget-accordion .eventchamp-widget-accordion-section-content').slideUp(300).removeClass('open');
	}

	jQuery('html, body').on('click', '.eventchamp-widget-accordion-section-title', function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();

			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.eventchamp-widget-accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
		}
		e.stopPropagation();
		
	});
	/********** ADMIN WIDGETS END **********/
	
});