<?php 

//* Link Post Format
	$link = get_post_meta( $post->ID, 'zp_link_format', true );
	$content = get_the_content(); 
	$title = get_the_title(  );
	
	$image = genesis_get_image(  array(  'format' => 'url', 'size' => genesis_get_option(  'image_size'  )   )   );

	echo '<div class="media_container">';
		if($image){
	       printf(  '<a href = "%s" rel = "bookmark" target="_blank" ><img class = "post-image" src = "%s" alt="" /></a>', $link, $image   );
		}
	echo '</div>';
	
	//Post format icon
	$post_format_icon = '<header class="entry-header"><p class="entry-meta">'.do_shortcode( '[post_date] ' . __( 'by', 'drone' ) . ' [post_author_posts_link] [post_comments] [zp_post_like]' ).'</p><i class="fa fa-link"></i></header>';
	
	echo '<div class="content_container">'.$post_format_icon;
		printf( '<div %s>', genesis_attr( 'entry-content' ) );
		echo '<h2><a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></h2>';	
		echo apply_filters( 'content', get_the_content() );			
		echo '</div>';

	if( is_single() ){
		do_action( 'genesis_after_entry_content' );
		do_action( 'genesis_entry_footer' );	
	}
	echo '</div>';