jQuery('.load_more:not(.loading)').on('click',function(e){
	e.preventDefault();		
	var load_more_btn = jQuery(this);
	var post_type = zp_load_more.post_type;
	var offset = jQuery('#zp_masonry_container .zp_masonry_item').length;
	var nonce = load_more_btn.attr('data-nonce');
	var container_width = jQuery('#zp_masonry_container').width();
	
	jQuery.ajax({
		type : "post",
		context: this,
		dataType : "json",
		url : zp_load_more.ajaxurl,
		data : {action: "zp_load_posts", offset:offset, columns:zp_load_more.columns, category: zp_load_more.category, nonce:nonce, post_type:post_type, posts_per_page:zp_load_more.posts_per_page},
		beforeSend: function(data) {
			// here u can do some loading animation...
			load_more_btn.addClass('loading').html( zp_load_more.loading_label );
		},
		success: function(response) {
			if (response['have_posts'] == 1){//if have posts:
				load_more_btn.removeClass('loading').html( zp_load_more.button_label );
				var newElems = jQuery(response['html'].replace(/(\r\n|\n|\r)/gm, ''));
				jQuery('#zp_masonry_container').append( newElems );
				zp_portfolio_item_width();
				// check pre-selected category
				filter_item = jQuery('.zp_masonry_filter .option-set a.selected').attr('data-option-value');
	
				jQuery('#zp_masonry_container').imagesLoaded(function(){
					jQuery('#zp_masonry_container').isotope( 'insert', newElems ).isotope('reLayout').isotope();
				});			
				zp_set_liked();
				jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({ hook: 'data-rel',deeplinking: false });
			} else {
				//end of posts (no posts found)
				load_more_btn.removeClass('loading').addClass('end_of_posts').html('<span>'+zp_load_more.end_post +'</span>');
			}
		}
	});
	
});