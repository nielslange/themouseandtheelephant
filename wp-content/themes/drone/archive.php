<?php 
/* 
 * Archive Page
 *
 */

remove_action(	'genesis_loop', 'genesis_do_loop' );

add_action(	'genesis_loop', 'zp_custom_post_archive_page' );
function zp_custom_post_archive_page(){
	global $post;	
		
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			do_action( 'genesis_before_entry' );

			printf( '<article %s>', genesis_attr( 'entry' ) );

			// check post format and call template
			$format = get_post_format(); 
			get_template_part( 'content', $format );

			do_action( 'genesis_after_entry_content' );
		
			//do_action( 'genesis_entry_footer' ); 					
					
			echo '</article>';

			do_action( 'genesis_after_entry' );


		endwhile; 
		
	endif; 
	
	//* Genesis navigation
	genesis_posts_nav();
}

genesis();