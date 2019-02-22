<?php  
    
//* Audio post format

global $post;

echo '<div class="media_container">';
	echo zp_gallery( $post->ID, 'blog_gallery', 'zp_post_gallery' ); 			
echo '</div>';
echo '<div class="content_container">';
do_action( 'genesis_entry_header' );

do_action( 'genesis_before_entry_content' );
printf( '<div %s>', genesis_attr( 'entry-content' ) );
	do_action( 'genesis_entry_content' );
echo '</div>'; //* end .entry-content
if( is_single() ){
		do_action( 'genesis_after_entry_content' );
		do_action( 'genesis_entry_footer' );	
	}
echo '</div>';
  