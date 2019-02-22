<?php

/**-------------------------------------------------------------------
// Single Portfolio
--------------------------------------------------------------------*/

/**
 * Add Single Portfolio Navigation
 */
add_action( 'genesis_after_header', 'zp_portfolio_single_nav' );
function zp_portfolio_single_nav(){
	global $post;
	$output = '';
	
	$output .= '<div class="single_portfolio_nav">';
	
	$prev_post = get_previous_post();
	if ( !empty( $prev_post )){
		$output .= '<div class="single_nav_prev"><a href="'.get_permalink( $prev_post->ID ).'" class="btn btn-lg btn-default"><i class="fa fa-angle-left"></i></a></div>';
	}
	
	$next_post = get_next_post();
	if ( !empty( $next_post )){
		$output .= '<div class="single_nav_next inline"><a href="'.get_permalink( $next_post->ID ).'" class="btn btn-lg btn-default"><i class="fa fa-angle-right"></i></a></div>';
	}
	$output .= '</div>';
	
	echo $output;
}

/**
 * Remove default Genesis sidebar and
 * the sidebar created by Genesis Simple Sidebars 
 */

add_action( 'get_header', 'zp_portfolio_sidebar' );
function zp_portfolio_sidebar(){

	if( is_singular( 'portfolio' ) ){
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		remove_action( 'genesis_sidebar', 'ss_do_sidebar' );
		remove_action( 'genesis_sidebar_alt', 'ss_do_sidebar_alt' );
		add_action( 'genesis_sidebar', 'zp_get_portfolio_sidebar' );	
	}
}

function zp_get_portfolio_sidebar(){
	
	genesis_get_structural_wrap( 'sidebar' );
	do_action( 'genesis_before_sidebar_widget_area' );
	dynamic_sidebar( 'portfolio-sidebar' );
	do_action( 'genesis_after_sidebar_widget_area' );
	genesis_get_structural_wrap( 'sidebar', 'close' );
}
 
/* Add Related Portfolio */
add_action( 'genesis_after_content', 'zp_display_related_portfolio' );
function zp_display_related_portfolio(){
	$items = genesis_get_option( 'zp_related_items', ZP_SETTINGS_FIELD );
	$columns = genesis_get_option( 'zp_related_columns', ZP_SETTINGS_FIELD );
	
	if( genesis_get_option( 'zp_enable_related', ZP_SETTINGS_FIELD ) ){	
		echo '<div class="zp_related_container"><div class="container"><div class="row">'.zp_related_portfolio( $items, $columns ).'</div></div></div>';
	}
}

/**
 * Remove default Genesis Loop
 */
remove_action( 	'genesis_loop', 'genesis_do_loop'  );
add_action( 'genesis_loop', 'zp_single_portfolio_page'  );
function zp_single_portfolio_page(){
	global $post;
	
	$output = '';
	
	// retrieve post meta values
	$button_label = get_post_meta( $post->ID, 'button_label', true );
	$button_link = get_post_meta( $post->ID, 'button_link', true );
	
	$output .= '<div class="col-md-12 col-sm-12 col-xs-12 pull-left single_portfolio_main">';
	$output .= '<article '.genesis_attr( 'entry' ).'>';
		
	if (  have_posts(  )  ) : while (  have_posts(  )  ) : the_post(  );
	
		$image = get_the_post_thumbnail( $post->ID  , 'full', array('class'=> 'img-responsive', 'alt'	=> get_the_title(), 'title'	=> get_the_title() ) );
		$image_url = wp_get_attachment_url(  get_post_thumbnail_id(  $post->ID  )  );
			
		//Type of link
		$link_type = get_post_meta( $post->ID, 'portfolio_link', true );
		
		// get video link
		$video_link = get_post_meta( $post->ID, 'single_video_link', true );
		
		// get portfolio attached images ids
		$portfolio_images = get_post_meta( $post->ID, 'portfolio_images', true );
		
		// Portfolio Image display type
		$display_type = get_post_meta( $post->ID, 'display_type', true );
	
		$output .= '<div '.genesis_attr( 'entry-content' ).'>';
		
		// If lightbox
		if( $link_type == 'lightbox' ){
			//$output .= '<div class="single_portfolio_container single_portfolio_image"><a href="'.$image_url.'" data-rel="prettyPhoto"><span class="portfolio_icon_class"><i class="fa fa-plus"></i></span>'.$image.'</a></div>';
			// content
			if( get_the_content() ){
				$output .= '<div class="single_portfolio_container single_portfolio_content">';
				$output .= '<div class="widget single_portfolio_section single_portfolio_meta col-m-12 col-sm-12 col-xs-12">';
				$output .= apply_filters('the_content', get_the_content() );
				$output .= '</div>';
			}
		}else if(  $link_type == 'external_link' ){
		// if external link
			$external_link = get_post_meta( $post->ID, 'zp_external_link', true );
			//$output .= '<div class="single_portfolio_container single_portfolio_image"><a href="'.$external_link.'" target="_blank" ><span class="portfolio_icon_class portfolio_icon_link"><i class="fa fa-link"></i></span>'.$image.'</a></div>';
			// content
			if( get_the_content() ){
				$output .= '<div class="single_portfolio_container single_portfolio_content">';
				$output .= '<div class="widget single_portfolio_section single_portfolio_meta col-m-12 col-sm-12 col-xs-12">';
				$output .= apply_filters('the_content', get_the_content() );
				$output .= '</div>';
			}
		}else{
		//if single page or empty
			if( $video_link ){
				//$output .= '<div class="single_portfolio_container single_portfolio_video fitvids"><iframe src="'.zp_return_desired_link( $video_link ).'" width="710" height="400" ></iframe></div>';
			}elseif( $portfolio_images ){
				if( $display_type ==  'list' ){
					$post_gallery_images = get_post_meta( $post->ID, 'portfolio_images', true );
					$post_gallery_ids = explode(",", $post_gallery_images );
					$output .= '<div class="single_portfolio_container single_portfolio_gallery">';
					
					$i=0;
					while($i < count( $post_gallery_ids ) ){
						if( $post_gallery_ids[$i] ){
							$image_full = wp_get_attachment_image_src( $post_gallery_ids[$i], 'full' );
							$image_meta = zp_get_attachment_meta( $post_gallery_ids[$i] );
							
							if( !empty($image_meta['caption']) ){
								$image_caption = '<span class="single_caption_text">'.$image_meta['caption'].'</span>';
							}else{
								$image_caption = '';
							}
													
							$output .= '<span class="single_portfolio_list"><a href="'.$image_full[0].'" data-rel="prettyPhoto[gallery]"><span class="portfolio_icon_class"><i class="fa fa-plus"></i></span>'.wp_get_attachment_image( $post_gallery_ids[$i], 'full' ).'</a>'.$image_caption.'</span>';
						}
						$i++;
					}
					$output .= '</div>';				
				}else{
					$output .= '<div class="single_portfolio_container single_portfolio_slide">';
					$output .= zp_gallery(  $post->ID, 'full', 'portfolio_images', true );
					$output .= '</div>';
				}
			}else{
				//$output .= '<div class="single_portfolio_container single_portfolio_image"><a href="'.$image_url.'" data-rel="prettyPhoto"><span class="portfolio_icon_class"><i class="fa fa-plus"></i></span>'.$image.'</a></div>';
			}			
			
			// content
			if( get_the_content() ){
				$output .= '<div class="single_portfolio_container single_portfolio_content">';
				$output .= '<div class="widget single_portfolio_section single_portfolio_meta col-m-12 col-sm-12 col-xs-12 col-sm-12 col-xs-12">';
				$output .= apply_filters('the_content', get_the_content() );
				$output .= '</div>';
			}
			
			//add like span
			$like_counter = ( get_post_meta( $post->ID, 'zp_like' ,true ) > 0 )? get_post_meta( $post->ID, 'zp_like' ,true ): 0;
			$like = '<span class="zp_like_holder '.$post->ID.'"><i class="fa fa-heart-o '.$post->ID.'"></i><em class="like_counter">('.$like_counter.')</em></span>';
				
			if( $button_link ){
					$output .= '<div class="widget single_portfolio_section single_portfolio_button col-m-12 col-sm-12 col-xs-12"><a class="btn btn-default " href="'.$button_link.'">'.$button_label.'</a>'.$like.'</div>';
			}
		}
		
				
		$output .= '</div>';

	endwhile; endif;	
	$output .= '</article></div>';	
	echo $output;
	
	
}

//* Add full width banner image
add_action('genesis_before_content_sidebar_wrap', 'show_portfolio_banner');
function show_portfolio_banner() {
	if ( get_field('banner') ) {
		printf('<img src="%s" alt="%s" class="portfolio-banner" style="width:100%%">', get_field('banner'), get_the_title());
	}
}

genesis();