<?php 

// ZP Custom Meta boxes Initialization

function zp_custom_post_type() {

/*----------------------------------------------------*/
// Add Post Custom Meta
/*---------------------------------------------------*/	

	$post_meta = new Super_Custom_Post_Meta( 'post' );

	$post_meta->add_meta_box( array(
		'id' => 'audio-settings',
		'context' => 'side',
		'priority' => 'high',
		'fields' => array(
			'zp_audio_mp3_url' => array( 'label' => __( 'Audio .mp3 URL','drone'), 'type' => 'text', 'data-zp_desc' => __( 'The URL to the .mp3 audio file','drone') ),
			'zp_audio_ogg_url' => array( 'label' => __( 'Audio .ogg, .oga URL','drone'), 'type' => 'text', 'data-zp_desc' => __( 'The URL to the .oga, .ogg audio file','drone') ),
			'zp_embed_audio' => array( 'label' => __( 'Embed Audio','drone'), 'type' => 'textarea', 'data-zp_desc' => __( 'Embed audio code here.','drone') )
		)
	) );

	$post_meta->add_meta_box( array(
		'id' => 'link-settings',
		'context' => 'side',
		'priority' => 'high',
		'fields' => array(
			'zp_link_format' => array( 'label' => __( 'Enter link.  E.g., http://www.yourlink.com','drone'), 'type' => 'text', 'data-zp_desc' => __( 'Input your link. e.g., http://www.yourlink.com','drone') )
		)
	) );

	$post_meta->add_meta_box( array(
		'id' => 'video-settings',
		'context' => 'side',
		'priority' => 'high',
		'fields' => array(
			'zp_video_m4v_url' => array( 'label' => __( 'Video File (.m4v)','drone'), 'type' => 'text', 'data-zp_desc' => __( 'The URL to the .m4v video file','drone') ),
			'zp_video_ogv_url' => array( 'label' => __( 'Video File (.ogv)','drone'), 'type' => 'text', 'data-zp_desc' => __( 'The URL to the .ogv video file','drone') ),
			'zp_video_format_embed' => array( 'label' => __( 'Embed Video','drone'), 'type' => 'textarea', 'data-zp_desc' => __( 'If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 600px with any height. This field will override the above.','drone') ),
		)

	));
	
	$post_meta->add_meta_box( array(
		'id' => 'gallery-settings',
		'context' => 'side',
		'priority' => 'high',
		'fields' => array(
			'zp_post_gallery' => array( 'label' => __( 'Add Gallery Images. ','drone'), 'type' => 'multiple_media', 'data-zp_desc' => __( 'Add images for gallery post format.','drone') ),
		)

	));
	
	$post_meta->add_meta_box( array(	
			'id' => 'page_subtitle',		
			'context' => 'side',		
			'priority' => 'high',		
			'fields' => array(		
				'subtitle' => array( 'label' => '', 'type' => 'textarea', 'data-zp_desc' => __( 'Add subtitle','drone') ),
			)
	));


/*----------------------------------------------------*/
// Add Page Custom Meta
/*---------------------------------------------------*/	
	$page_meta = new Super_Custom_Post_Meta( 'page' );		
	$page_meta->add_meta_box( array(	
		'id' => 'page_subtitle',		
		'context' => 'side',		
		'priority' => 'high',		
		'fields' => array(
			'subtitle' => array( 'label' => '', 'type' => 'textarea', 'data-zp_desc' => __( 'Add subtitle','drone') ),
		)
	) );

/*----------------------------------------------------*/
// Add Portfolio Post Type
/*---------------------------------------------------*/
	$portfolio_custom_default = array(
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions','genesis-layouts', 'genesis-seo', 'genesis-cpt-archives-settings', 'excerpt' ) ,
		'menu_icon' => 'dashicons-portfolio'
	);
	
	//register portfolio post type
	$portfolio = new Super_Custom_Post_Type( 'portfolio', 'Portfolio', 'Portfolio',  $portfolio_custom_default );
	$portfolio_category = new Super_Custom_Taxonomy( 'portfolio_category' , 'Portfolio Category' , 'Portfolio Categories', 'cat' );
	connect_types_and_taxes( $portfolio, array( $portfolio_category ) );
		
	$portfolio->add_meta_box( array(
		'id' => 'portfolio_settings',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			'portfolio_link' => array( 'label' => __('Type of Portfolio link','drone'), 'type' => 'select', 'options' => array( 'lightbox','external_link', 'single_page' ), 'data-zp_desc' => __('Select what type of link you want for this portfolio item.','drone') ),
		)
	));
		
	$portfolio->add_meta_box( array(
		'id' => 'portfolio_lightbox',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(	
			'video_link' => array( 'label' => __('Video Link','drone'), 'type' => 'text', 'data-zp_desc' => __('Add video link here. Video link format: Youtube: "http://www.youtube.com/watch?v=7HKoqNJtMTQ", Vimeo: "http://vimeo.com/123123". Leave empty if you don\'t want to have a video on a lightbox.','drone') ),
			'lightbox_images' => array( 'label' => __('Upload/Attach images to this portfolio item. Images attached in here will be shown in lightbox to form slideshow gallery.','drone'), 'type' => 'multiple_media', 'data-zp_desc' => __('Leave empty if you don\'t want to have a galley slideshow on a lightbox.','drone') ),
		)
	));
	$portfolio->add_meta_box( array(
			'id' => 'portfolio_external_link',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				'zp_external_link' => array( 'label' => __('External Link','drone'), 'type' => 'text', 'data-zp_desc' => __('Add external link for this portfolio item.','drone') ),			
			)
	));

	$portfolio->add_meta_box( array(
			'id' => 'portfolio_single_page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				'button_label' => array( 'label' => __('Button Label','drone'), 'type' => 'text', 'data-zp_desc' => __('Add button label','drone') ),
				'button_link' => array( 'label' => __('Button Link','drone'), 'type' => 'text', 'data-zp_desc' => __( 'Add button link','drone') ),
				'portfolio_images' => array( 'label' => __('Upload/Attach an image to this portfolio item. Images attached in here will be shown in lightbox and single portfolio page.','drone'), 'type' => 'multiple_media', 'data-zp_desc' => __('Add images to this portfolio. If this is empty, the featured image will be use.','drone') ),
				'display_type' => array( 'label' => __('Portfolio Image Display Type','drone'), 'type' => 'select', 'options' => array( 'list','slider' ), 'data-zp_desc' => __('Select how to display portfolio images on single portfolio page.','drone') ),
				'single_video_link' => array( 'label' => __('Video Link','drone'), 'type' => 'text', 'data-zp_desc' => __('Add video link here. Video link format: Youtube: "http://www.youtube.com/watch?v=7HKoqNJtMTQ", Vimeo: "http://vimeo.com/123123". If this is empty, the featured image will be used on lightbox.','drone') )
			)
	));	
	
	
	// Manage portfolio columns
	function zp_add_portfolio_columns($columns) {
		global $zp_option;
		
		return array(
			'cb' => '<input type="checkbox" />',
			'title' => __('Title', 'drone'),
			'portfolio_category' => __('Portfolio Category(s)','drone'),
			'author' =>__( 'Author', 'drone'),
			'date' => __('Date', 'drone'),
		);
	}
	
	add_filter('manage_portfolio_posts_columns' , 'zp_add_portfolio_columns');
	
	function zp_custom_portfolio_columns( $column, $post_id ) {
		global $zp_option;
		
		switch ( $column ) {
			case 'portfolio_category':
				$terms = get_the_term_list( $post_id , 'portfolio_category' , '' , ',' , '' );
				if ( is_string( $terms ) )
					echo $terms;
				else
					_e( 'Unable to get portfolio category.', 'drone' );
					break;
		}
	}
	add_action( 'manage_posts_custom_column' , 'zp_custom_portfolio_columns', 10, 2 );
}

add_action( 'init', 'zp_custom_post_type', 0 );