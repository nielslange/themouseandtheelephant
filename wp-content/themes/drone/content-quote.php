<?php 

//* Quote Post Format

	$content = get_the_content(); 
	$title = get_the_title(  );
	$permalink=get_permalink(  );
	
	$image = genesis_get_image(  array(  'format' => 'url', 'size' => genesis_get_option(  'image_size'  )   )   );
	echo '<div class="media_container">';
		if($image){
	       printf(  '<img class = "post-image" src = "%s" alt="" />', $image   );
		}
	echo '</div>';
	
	//Post format icon
	$post_format_icon = '<header class="entry-header"><p class="entry-meta">'.do_shortcode( '[post_date] ' . __( 'by', 'drone' ) . ' [post_author_posts_link] [post_comments] [zp_post_like]' ).'</p><i class="fa fa-quote-left"></i></header>';
	
	echo '<div class="content_container">'.$post_format_icon;
	printf( '<div %s>', genesis_attr( 'entry-content' ) );
	echo '<h2>'.$content.'</h2>';	
	echo '<p class="quote_author">'.$title.'</p>';			
	echo '</div>';

	if( is_single() ){
		do_action( 'genesis_after_entry_content' );
		do_action( 'genesis_entry_footer' );	
	}	
	echo '</di>';