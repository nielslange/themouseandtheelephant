<?php  
    
//* Audio post format

global $post;

wp_enqueue_script('jquery_jplayer');

echo '<div class="audio_container">';
	$embed = get_post_meta( $post->ID, 'zp_embed_audio', true);
	if( !empty( $embed ) ) {
		echo stripslashes(htmlspecialchars_decode($embed));
	}else{
		echo zp_audio( $post->ID, 'blog_gallery' );
	}
echo '</div>';

echo '<div class="content_container">';
do_action( 'genesis_entry_header' );
do_action( 'genesis_before_entry_content' );
printf( '<div %s>', genesis_attr( 'entry-content' ) );
	do_action( 'genesis_entry_content' );
echo '</div>';
if( is_single() ){
		do_action( 'genesis_after_entry_content' );
		do_action( 'genesis_entry_footer' );	
	}
echo '</div>';
