jQuery(document).ready(function(){   

	jQuery('#scpt_meta_section_background_color').ColorPicker({

			color: '#0000ff',

			onShow: function (colpkr) {

				jQuery(colpkr).fadeIn(500);

				return false;

			},

			onHide: function (colpkr) {

				jQuery(colpkr).fadeOut(500);

				return false;

			},
			

			onChange: function (hsb, hex, rgb) {

				jQuery('input#scpt_meta_section_background_color,#tmnf_post_bg').css('backgroundColor', '#' + hex);

				jQuery('input#scpt_meta_section_background_color').val('#' + hex); 

			}

		});

		

	jQuery('#scpt_meta_section_text_color').ColorPicker({

			color: '#0000ff',

			onShow: function (colpkr) {

				jQuery(colpkr).fadeIn(500);

				return false;

			},

			onHide: function (colpkr) {

				jQuery(colpkr).fadeOut(500);

				return false;

			},

			onChange: function (hsb, hex, rgb) {

				jQuery('input#scpt_meta_section_text_color,#tmnf_post_text').css('backgroundColor', '#' + hex);

				jQuery('input#scpt_meta_section_text_color').val('#' + hex); 

			}

		});

	



    }); 