<?php
/**
 * Display Related Post after single post
 *
 */

add_action( 'genesis_after_entry','zp_related_post', 7 );
function zp_related_post(){
	
	if( is_singular( 'post' )){
		global $post;
 
		$count = 0;
		$postIDs = array( $post->ID );
		$related = '';
		$tags = wp_get_post_tags( $post->ID );
		$cats = wp_get_post_categories( $post->ID );
		 
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tagID[] = $tag->term_id;
		}
		
		$args = array(
			'tag__in'               => $tagID,
			'post__not_in'          => $postIDs,
			'showposts'             => 3,
			'ignore_sticky_posts'   => 1,
			'tax_query'             => array(
				array(
					'taxonomy'  => 'post_format',
					'field'     => 'slug',
					'terms'     => array(
						'post-format-status',
						'post-format-aside',
					),
			'operator'  => 'NOT IN'
				)
			)
			);
 
			$tag_query = new WP_Query( $args );
			if ( $tag_query->have_posts() ) {
				while ( $tag_query->have_posts() ) {
					$tag_query->the_post();
					$img = genesis_get_image() ? genesis_get_image( array( 'size' => 'related_post' ) ) : '';
					$related .= '<li><a class="related_image" href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to ' . get_the_title() . '">' . $img .'</a><a class="related_label" href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to ' . get_the_title() . '">'. get_the_title() . '</a></li>';
					$postIDs[] = $post->ID;
					$count++;
				}
			}
		}
		
		if ( $count <= 2 ) {
			$catIDs = array( );
			foreach ( $cats as $cat ) {
				if ( 3 == $cat )
					continue;
					$catIDs[] = $cat;
			}
			$showposts = 4 - $count;
			$args = array(
				'category__in'          => $catIDs,
				'post__not_in'          => $postIDs,
				'showposts'             => $showposts,
				'ignore_sticky_posts'   => 1,
				'orderby'               => 'rand',
				'tax_query'             => array(
									array(
										'taxonomy'  => 'post_format',
										'field'     => 'slug',
										'terms'     => array( 
											'post-format-status', 
											'post-format-aside'
										),
										'operator' => 'NOT IN'
									)
				)
			);
 
			$cat_query = new WP_Query( $args );			 
			if ( $cat_query->have_posts() ) {				 
				while ( $cat_query->have_posts() ) {					 
					$cat_query->the_post(); 
					$img = genesis_get_image() ? genesis_get_image( array( 'size' => 'related_post' ) ) : ''; 
					$related .= '<li><a class="related_image" href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to ' . get_the_title() . '">' . $img .'</a><a class="related_label" href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to ' . get_the_title() . '" >'. get_the_title() . '</a></li>';				}
			}
		}
		
		if ( genesis_get_option( 'zp_related_post',  ZP_SETTINGS_FIELD ) ) {
			printf( '<div class="related-posts"><h3 class="related-title"><span>'.genesis_get_option( 'zp_related_post_title',  ZP_SETTINGS_FIELD ).'</span></h3><ul class="related-list">%s</ul></div>', $related );
		}
		wp_reset_query();
	}
}