<?php
/**
 * ZP Custom Single Page 
 */

/**
 * Add Single Post Navigation
 */
add_action( 'genesis_after_header', 'zp_post_single_nav' );
function zp_post_single_nav(){
	global $post;
	$output = '';
		
	$output .= '<div class="single_post_nav">';
	
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
 
remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_custom_single_template' );

function zp_custom_single_template(){
	global $post, $paged;	

	if ( have_posts() ) : while ( have_posts() ) : the_post();
	
			$content = get_the_content();
			$title = get_the_title(  );
			$permalink=get_permalink(  );
		
			do_action( 'genesis_before_entry' );

			printf( '<article %s>', genesis_attr( 'entry' ) );

			// check post format and call template
			$format = get_post_format(); 		
			get_template_part( 'content', $format );					
			echo '</article>';

			do_action( 'genesis_after_entry' );

		endwhile; //* end of one post
		do_action( 'genesis_after_endwhile' );

	else : //* if no posts exist
		do_action( 'genesis_loop_else' );
	endif; //* end loop


}

//* Add full width banner image
add_action('genesis_before_content_sidebar_wrap', 'show_portfolio_banner');
function show_portfolio_banner() {
	if ( get_field('banner') ) {
		printf('<img src="%s" alt="%s" class="portfolio-banner" style="width:100%%">', get_field('banner'), get_the_title());
	}
}

genesis();