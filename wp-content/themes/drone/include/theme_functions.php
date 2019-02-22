<?php 
/** 
 * Themes' Helper Functions
 */
 
/**
 * Gallery Function
 *
 * Function to display a slider using Bootstrap Carousel
 *
 * @param integer $postid - Post ID
 * @param string $imagesize - Image size name
 * @param string $metabox_id - Metabox option ID
 * @param boolean $lightbox - Boolean: true/false. If true, slide items will have link
 * @return a markup for the gallery slider
 */
 
  function zp_gallery( $postid, $imagesize, $metabox_id, $lightbox = false ) {
	   global $post;
		$output = '';
        // get all of the attachments for the post
		$post_gallery_images = get_post_meta( $postid, $metabox_id, true );
		
		// get all image ID
		$post_gallery_ids = explode(",", $post_gallery_images );	
		
		$output='';
        if( count( $post_gallery_ids ) > 0 ) {
            $output .='<div class="carousel slide" id="'.$postid.'">';
			$output .= '<ol class="carousel-indicators">';
					
			$output .= '</ol>';
			$output .= '<div class="carousel-inner">';
			
			// checker variable
			$flag = 0;
	
			$counter = 0;
			$i=0;
			while($i < count( $post_gallery_ids ) ){
				if( $post_gallery_ids[$i] ){
					$flag++;
					if($flag == 1){
						$active = 'active';
					}else{
						$active = '';
					}
					$image_url = wp_get_attachment_image_src( $post_gallery_ids[$i], $imagesize );
					$full_size  = wp_get_attachment_image_src( $post_gallery_ids[$i], 'full' );
					
					$output .= '<div class="item '.$active.'">';
					
					if( $lightbox ){
						$output .= '<a href="'.$full_size[0].'" data-rel="prettyPhoto"><img class="img-responsive" alt="'.get_the_title().'" src="'.$image_url[0].'" /></a>';
					}else{
						$output .= '<img class="img-responsive" alt="'.get_the_title().'" src="'.$image_url[0].'" />';
					}
					$output .= '</div>';
				}
				$i++;
			}
				
			$output .= '</div>';
			$output .= '<a data-slide="prev" data-target="#'.$postid.'" class="carousel-control left"><span class="glyphicon glyphicon-chevron-left"></span></a>';
			$output .= '<a data-slide="next" data-target="#'.$postid.'" class="carousel-control right"><span class="glyphicon glyphicon-chevron-right"></span></a>';
			$output .= '</div>';
			
			return $output;
        }
    }
	
/**
 * Blog Video Function
 *
 * @param integer $postid - Post ID
 * @param string $imagesize - Image size name
 * @return a markup for the video
 */
 
 function zp_video( $postid, $image_size ) {
			
    	$height = get_post_meta( $postid, 'zp_video_prieview_image_height', true);
    	$m4v = get_post_meta( $postid, 'zp_video_m4v_url', true);
    	$ogv = get_post_meta( $postid, 'zp_video_ogv_url', true);
    	$poster = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), $image_size );
		$output = '';
		
		//set width and height
		$style = '';
		$width = $poster[1];
		$height = $poster[2];

	
		if( !empty($poster[0]) ) {
			$poster_size = 'size: { width: "'.$width.'px", height: "'.$height.'px" },';
 		}else{
			$poster_size = 'size: { width: "100%", height: "33px" },';
		}
	

		
		$output .= '<script type="text/javascript">
			jQuery(document).ready(function($){
				if( $().jPlayer ) {
					$("#jquery-jplayer-video-'.$postid.'").jPlayer({
						ready: function () {
							$(this).jPlayer("setMedia", {
								m4v: "'.$m4v.'",
								ogv: "'.$ogv.'",
								poster: "'.$poster[0].'"
							});
						},
						size: {
							cssClass: "jp-video-normal",
							width: "100%",
							height: "'.$height.'px"
						},
						swfPath: "'.get_stylesheet_directory_uri().'/js",
						solution: "flash, html",
						wmode: "window",
						cssSelectorAncestor: "#jp-video-container-'.$postid.'",
						supplied: "m4v, ogv"
					});
	
					$("#jquery-jplayer-video-'.$postid.'").bind($.jPlayer.event.playing, function(event) {
						$(this).add("#jp-video-interface-'. $postid.'").hover( function() {
							$("#jp-video-interface-'.$postid.'").stop().animate({ opacity: 1 }, 400);
						}, function() {
							$("#jp-video-interface-'.$postid.'").stop().animate({ opacity: 0 }, 400);
						});
					});
					
					$("#jquery-jplayer-video-'.$postid.'").bind($.jPlayer.event.pause, function(event) {
						$("#jquery-jplayer-video-'.$postid.'").add("#jp-video-interface-'.$postid.'").unbind("hover");
						$("#jp-video-interface-'.$postid.'").stop().animate({ opacity: 1 }, 400);
					});
				}
						
			});
		</script>';
	
		$output .= '<div id="jp-video-container-'.$postid.'" class="jp-video jp-video-normal" >';
			$output .= '<div class="jp-type-single">';
				$output .= '<div id="jquery-jplayer-video-'.$postid.'" class="jp-jplayer" data-orig-width="'.$width.'" data-orig-height="'.$height.'"></div>';
				$output .= '<div class="jp-gui">';
				$output .= '<div id="jp-video-interface-'.$postid.'" class="jp-interface">';
					$output .= '<ul class="jp-controls">';
						$output .= '<li><a href="#" class="jp-play" tabindex="1">play</a></li>';
						$output .= '<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>';
						$output .= '<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>';
						$output .= '<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>';
				   $output .= ' </ul>';
					$output .= '<div class="jp-progress">';
						$output .= '<div class="jp-seek-bar">';
							$output .= '<div class="jp-play-bar"></div>';
					   $output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="jp-volume-bar">';
						$output .= '<div class="jp-volume-bar-value"></div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	
	}
	
	
/**
 * Blog Audio Fucntion
 *
 * @param integer $postid - Post ID
 * @param string $image_size - Image size name
 * @return a markup for audio post format
 */
 
 function zp_audio($postid, $image_size ) {	
	
    	$mp3 = get_post_meta( $postid, 'zp_audio_mp3_url', true);
    	$ogg = get_post_meta( $postid, 'zp_audio_ogg_url', true);
    	$poster = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), $image_size );
		$output = '';
		
		//set width and height
		$style = '';
		$width = $poster[1];
		$height = $poster[2];

	
		if( !empty($poster[0]) ) {
			$poster_size = 'size: { width: "100%", height: "'.$height.'px" },';
 		}else{
			$poster_size = 'size: { width: "100%", height: "33px" },';
		}
		
    	$output .='<script type="text/javascript">		
    			jQuery(document).ready(function($){
	
    				if( $().jPlayer ) {
    					$("#jquery-jplayer-audio-'.$postid.'").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", {
    							    poster: "'.$poster[0].'",
    								mp3: "'.$mp3.'",
    								oga: "'.$ogg.'",
    								end: ""
    							});
    						},
    						'.$poster_size.'
    						swfPath: "'.get_stylesheet_directory_uri().'/js",
							solution: "flash, html",
							wmode: "window",
    						cssSelectorAncestor: "#jp-audio-interface-'.$postid.'",
    						supplied: "mp3, oga"
    					});
					
    				}
    			});
    		</script>';
			
    	    $output .= '<div id="jp-container-'.$postid.'" class="jp-audio">';
                $output .= '<div class="jp-type-single">';
                    $output .= '<div id="jquery-jplayer-audio-'.$postid.'" class="jp-jplayer" data-orig-width="'.$width.'" data-orig-height="'.$height.'"></div>';
                    $output .= '<div id="jp-audio-interface-'.$postid.'" class="jp-interface">';
                        $output .= '<ul class="jp-controls">';
                            $output .= '<li><a href="#" class="jp-play" tabindex="1" title="play">play</a></li>';
                            $output .= '<li><a href="#" class="jp-pause" tabindex="1" title="pause">pause</a></li>';
                            $output .= '<li><a href="#" class="jp-mute" tabindex="1" title="mute">mute</a></li>';
                            $output .= '<li><a href="#" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>';
                        $output .= '</ul>';
                       $output .= ' <div class="jp-progress">';
                            $output .= '<div class="jp-seek-bar">';
                                $output .= '<div class="jp-play-bar"></div>';
                            $output .= '</div>';
                       $output .= ' </div>';
                        $output .= '<div class="jp-volume-bar">';
                            $output .= '<div class="jp-volume-bar-value"></div>';
                       $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>'; 
			
		return $output;
    }
	
/**
 * Matches the input video link inserted.
 *
 * @param string $link - Full video URL
 * @return a video URL needed in video post format
 */
 
 function zp_return_desired_link( $link){
	 $src = '';
	 
	 if( preg_match( '/youtube/', $link ) ){
		 if( preg_match_all('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i', $link, $matches ) ){
			 $src = '//www.youtube.com/embed/'.$matches[4][0].'?autoplay=1';
		}
	}elseif( preg_match( '/vimeo/', $link ) ){
		if( preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $link, $matches ) ){
			$src = '//player.vimeo.com/video/'.$matches[3].'?autoplay=1';
		}
	}
	return $src;
}

/**
 * Remove default Page and Post Titles
 */
add_action( 'get_header', 'zp_remove_page_titles' );
function zp_remove_page_titles(  ) {
	if( is_search() ){
		remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
	}else{
		if ( !is_page_template( 'page_blog.php' ) && !is_archive()  ) {
			remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		}
	}
}

/**
 * Settings Page  Header Title and Description
 */
 
add_action( 'genesis_after_header', 'zp_page_header' );
function zp_page_header(){
	global $post, $wp_query;
	
	// Escape when it is layout template
	if( is_page_template( 'home_template.php' ) )
		return;
	
	if( is_404( )){?>
    	<div class="page_header zp_header_404" >
			<div class="container">
				<h1><?php _e( 'Error 404','drone' ) ?></h1>
				<p class="lead"><?php _e( 'Ooops! Page Not Found','drone' ) ?></p>
			 </div>
		</div>
    <?php
	}else if( is_search( )){?>
    	<div class="page_header zp_header_404" >
			<div class="container">
				<h1><?php _e( 'Search Results for: ','drone' ); ?><?php echo get_search_query();?></h1>
			 </div>
		</div>
    <?php
	}
	else if( is_tax(  'portfolio_category'  ) ){
		$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();		
		// Remove taxonomy description
		remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
	?>
    	<div class="page_header zp_header_taxonomy" >
        	<div class="container">
            <?php if ( $term->meta['headline'] ):?>
            	<h1><?php echo strip_tags( $term->meta['headline'] ); ?></h1>
            <?php else: ?>
            	<h1><?php echo single_tag_title( '',FALSE ); ?></h1>
            <?php endif; ?>
            <?php if( $term->meta['intro_text'] ):?>
                <p class="lead"><?php echo $term->meta['intro_text'];?></p>
            <?php endif; ?>
            </div>
        </div>
    <?php
	}else if( is_post_type_archive( 'portfolio' )  ){
		// Remove Archive description
		remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
		
		$headline   = ( genesis_get_cpt_option( 'headline' ) ) ? genesis_get_cpt_option( 'headline' ) : post_type_archive_title( '',false );
		$intro_text = genesis_get_cpt_option( 'intro_text' );
	?>
    	<div class="page_header zp_header_archive_portfolio" >
        	<div class="container">
            <?php if( $headline ):?>
            	<h1><?php echo $headline; ?></h1>
            <?php endif; ?>
            <?php if( $intro_text ):?>
                <p class="lead"><?php echo $intro_text ?></p>
            <?php endif; ?>
            </div>
        </div>
    <?php
	}else if( is_singular(  'portfolio'  ) ){
	?>
    	<div class="page_header zp_header_single" >
        	<div class="container">
            <?php if( get_the_title() ):?>
            	<h1><?php echo get_the_title(); ?></h1>
            <?php endif; ?>
            <?php 
				$single_desc = zp_portfolio_items_term( $post->ID, ',' );
			?>
             <p class="lead"><?php echo apply_filters( 'zp_single_portfolio_desc', $single_desc, $post->ID  ); ?></p>
            </div>
        </div>
    <?php
	}else if( is_author() ){
		// remove default author title and description
		remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );	
		$headline   = get_the_author_meta( 'headline', (int) get_query_var( 'author' ) );
		$intro_text = get_the_author_meta( 'intro_text', (int) get_query_var( 'author' ) );	?>
		<div class="page_header zp_header_archive" >
        	<div class="container">
            <?php if ( $headline ):?>
            	<h1><?php echo $headline; ?></h1>
            <?php endif; ?>
            <?php if ( $intro_text  ):?>
             <p class="lead"><?php echo strip_tags( $intro_text); ?></p>
            <?php endif ?>
            </div>
        </div>
    <?php
	}else if( is_category() || is_tag() ){
		// remove default category title and description
		remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );		
		$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
		$headline = $intro_text = '';		
		?>
		<div class="page_header zp_header_archive" >
        	<div class="container">
            <?php if ( $term->meta['headline'] ):?>
            	<h1><?php echo strip_tags( $term->meta['headline'] ); ?></h1>
            <?php endif; ?>
            <?php if ( $term->meta['intro_text'] ):?>
             <p class="lead"><?php echo strip_tags( apply_filters( 'genesis_term_intro_text_output', $term->meta['intro_text'] )); ?></p>
            <?php endif ?>
            </div>
        </div>
    	<?php
	}else if( is_date() ){
		?>
		<div class="page_header zp_header_date_archive" >
        	<div class="container">
            	<?php
					$title = get_the_time('F').' '.get_the_time( 'Y' );
					$date_archive_header = apply_filters( 'zp_post_date_archive_header',  $title );
					$date_archive_desc = apply_filters( 'zp_post_date_archive_desc',  '' );
					echo '<h1>'.$date_archive_header.'</h1><p class="lead">'.$date_archive_desc.'</p>';
                ?>
            </div>
        </div>
    	<?php
	}else{
		?>
		<div class="page_header zp_header_default_page" >
			<div class="container">
				<h1><?php echo get_the_title(); ?></h1>
				<p class="lead"><?php echo get_post_meta( $post->ID, 'subtitle', true );?></p>
			 </div>
		</div>
		<?php
	}
}

/**
 * Get the terms where the portfolio items belong and use as a class
 * Terms was used as a selector on the isotope filter 
 * @param integer $id - ID of the post
 * @param string $sep - term separator
 * @returns string - list of terms separated by space
*/
function zp_portfolio_items_term( $id, $sep ){
	$output = '';
	
	$terms = wp_get_post_terms( $id, 'portfolio_category' );
	$term_string = $term_link = '';
		foreach( $terms as $term ){
			if( $sep == '' ){
				$term_string.=( $term->slug ).' ';
			}else{
				$term_link .= '<a href="'.get_term_link( $term->term_id, 'portfolio_category' ).'">'.$term->name.'</a>'.$sep.' ';	
			}
		}
	
	/** separate terms with space */
	if( $sep == '' ){
		$term_string = substr( $term_string, 0, strlen( $term_string )- 1 );
		$string = str_replace( ","," ",$term_string );
		$output = $string." ";
	}else{
		$term_string = substr( $term_link, 0, strlen( $term_link )- 2 );
		$output = $term_string;
	}
	return $output;		
}

/**
 * Get the category of the posts
 * Category was used as a selector on the isotope fitler 
 * @param integer $id - ID of the post
 * @param string $sep - term separator
 * @returns string - list of terms separated by space
*/
function zp_post_items_term( $id, $sep ){
	$output = '';
	
	$terms = wp_get_post_terms( $id, 'category' );
	$term_string = '';
		foreach( $terms as $term ){
			$term_string.=( $term->slug ).$sep.' ';
		}	
	/** separate terms with space */
	if( $sep == '' ){
		$term_string = substr( $term_string, 0, strlen( $term_string )- 1 );
		$string = str_replace( ","," ",$term_string );
		$output = $string." ";
	}else{
		$term_string = substr( $term_string, 0, strlen( $term_string )- 2 );
		$output = $term_string;
	}
	return $output;		
}

/**
 * Returns number of columns for Portfolio and Masonry Blog
 *
 * @param integer $columns - Number of defined columns
 * @returns a string to define columns
 */
 function zp_columns( $columns ){
	 
	if( $columns == 2 ){
		 $col = 'col2';
	}elseif( $columns == 3 ){
		$col = 'col3';
	}elseif( $columns == 4 ){
		$col = 'col4';
	}else{
		$col = 'col3';
	}
	return $col;	
 }

/**
 * Filter function for Portfolio and Masonry blog
 *
 * @param string $filter - True/False
 * @param string $category - Pre selected category
 * @param string $taxonomy - Taxonomy
 * @returns HTML markup for the taxonomy filter
 */
 function zp_filter_function( $filter, $category , $taxonomy ){
	 
	 $output = '';
	 
	// if $filter
	if( $filter == 'true' ){
		$filter = 'style="display: block;"';
	}else{
		$filter = 'style="display: none;"';
	}
		
	//check if it has categoryed category
	if( $category != '' ){
		$all = '';
		$selected = 'active';	
	}else{
		$all = 'active';
		$selected = '';
	}
			
	$output .='<div class="zp_masonry_filter" '.$filter.'>';
	$output .= '<ul data-option-key="filter" class="option-set" > <li><a class="'.$all.'" href="#" data-option-value="*" >'.__( 'All', 'drone' ).'</a></li>';
	
	// Get all portfolio catgories
	$categories = get_categories( array( 'taxonomy' => $taxonomy ) );

    // NL: Remove gallery from category array
	 foreach ($categories as $index => $data) {
		 if ($data->slug == 'gallery') {
			 unset($categories[$index]);
		 }
	 }

	foreach( $categories as $category ):
		if(  $category == $category->slug ){
			$output .=  '<li ><a class="'.$selected.'" href="#" data-option-value=".'.$category->slug.'" >'.$category->name.'</a></li>';
		}else{
			$output .=  '<li ><a class="" href="#"  data-option-value=".'.$category->slug.'" >'.$category->name.'</a></li>';
		}
	endforeach;
	
	$output .= '</ul></div>';
	
	return $output;
 }

/**
 * Portfolio Layout
 *
 * @param integer $items - Number of items to display
 * @param integer $columns  - Number of columns to display
 * @param boolean $filter - check filter if included or not
 * @param string $category - Portfolio category
 * @param boolean $load_more - Set to true to enable loadmore feature
 * @returns an HTML layout of portfolio
 */
 
 function zp_portfolio_output( $items, $columns , $filter , $category = '', $load_more = true ) {
	global $post;
	
	// Enqueue Scripts
	if( $load_more ){
		$category = ( $category != ''  )? $category : '';		
		wp_enqueue_script('zp_imageloaded' );
		wp_enqueue_script( 'zp_post_load_more' );
		wp_localize_script( 'zp_post_load_more', 'zp_load_more', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'columns' => $columns, 'post_type' => 'portfolio', 'category' => $category, 'posts_per_page' => $items, 'button_label'=> __( 'Load More', 'drone' ), 'loading_label' => __( 'Loading...' ,'drone' ), 'end_post' => __( 'End of Posts', 'drone' ) ) );
	}
	
	wp_enqueue_script('zp_post_like' );
	wp_localize_script( 'zp_post_like', 'zp_post_like', 
		array(
			'ajax_url' => admin_url('admin-ajax.php')
		)
	);
	
	// Initialize $output variable
	$output = '';
	
	// Check if $items and set default 6 when empty
	$items = ( '' == $items )? 6 : $items;
	
	// Check if $column and set default 3 when empty
	$columns  = ( '' == $columns )? 3 : $columns;
	
	// Set columns
	$portfolio_col = zp_columns( $columns );



	// Filter functions	 
	$output .= zp_filter_function( $filter, $category, 'portfolio_category' );
	

	$output .= '<div id="zp_masonry_container">';

	// portfolio query arguments
	if( $category != '' ){
		$args= array( 
			'posts_per_page' => $items,
			'post_type' => 'portfolio',
			'portfolio_category' => $category
		);
	}else{
		$args = array(
			'post_type'		=> 'portfolio',
			'posts_per_page' => $items
		);
	}
	
	$portfolio = new WP_Query( $args );
	
	// Render portfolio loop
	$output .= zp_portfolio_loop( $portfolio, $portfolio_col );
	
	//Load More Button
	if( $load_more ){
		$output .= '<div class="zp_loader_container"><a class="load_more btn btn-default" data-nonce="'.wp_create_nonce('zp_load_posts').'" href="javascript:;">'.__( 'Load more','drone').'</a></div>';
	}
	
	return $output;
}

/**
 * Display Related Portfolio
 * @param integer $items - Number of items to display
 * @param integer $columns  - Number of columns to display
 * @returns an HTML layout of portfolio
 */
 function zp_related_portfolio( $items, $columns ) {
	global $post, $wp_query;
	
	// Enqueue Scripts
	wp_enqueue_script('zp_post_like' );
	wp_localize_script( 'zp_post_like', 'zp_post_like', 
		array(
			'ajax_url' => admin_url('admin-ajax.php')
		)
	);	
	
	// Initialize $ouput variable
	$output = '';
	
	// Check if $items and set default 6 when empty
	$items = ( '' == $items )? 6 : $items;
	
	// Check if $column and set default 3 when empty
	$columns  = ( '' == $columns )? 3 : $columns;
	
	// Set columns
	$portfolio_col = zp_columns( $columns );
	
	$output .= '<div id="zp_masonry_container">';

	// portfolio query arguments
	$terms = get_the_terms( $post->ID , 'portfolio_category' );
	$term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
	$args = array(
		'post_type' => 'portfolio',
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $term_ids,
				'operator'=> 'IN'
			)),
		'posts_per_page' => $items,
		'orderby' => 'rand',
		'post__not_in'=>array( $post->ID )
	);
	
	$portfolio = new WP_Query( $args );
	
	// Render portfolio loop
	$output .= zp_portfolio_loop( $portfolio, $portfolio_col, true );
		
	return $output;
}

/**
 * Portfolio Loop
 *
 * @param object $portfolio_object - Contains the portfolio item query
 * @param string $portfolio_col - Portfolio column class
 * @param boolean $related - Set true if it is related portfolio ( Related portfolio have different image size )
 * @returns an HTML markup of portfolio items
 */
 function zp_portfolio_loop( $portfolio_object, $portfolio_col, $related = false ){
	 global $post;
	 
	 $output = '';
	 
	 if ( $portfolio_object->have_posts() ):
		while ( $portfolio_object->have_posts() ) : $portfolio_object->the_post();
		
			// Get full image size ( for lightbox )
			$image_url = wp_get_attachment_url(  get_post_thumbnail_id(  $post->ID  )  );
			
			// Get image display size
			if( $related ){
				$image_size = 'related_'.$portfolio_col;
			}else{
				$image_size = $portfolio_col;
			}
			
			$image = get_the_post_thumbnail( $post->ID  , $image_size , array('class'=> 'img-responsive', 'alt'	=> get_the_title() , 'title'	=> get_the_title() ) );
					
			// Check portfolio link option ( lightbox, external or single page )
			$link_type = get_post_meta( $post->ID, 'portfolio_link', true );
			
			//add like span
			$like_counter = ( get_post_meta( $post->ID, 'zp_like' ,true ) > 0 )? get_post_meta( $post->ID, 'zp_like' ,true ): 0;
			$like = '<span class="zp_like_holder '.$post->ID.'"><i class="fa fa-heart-o '.$post->ID.'"></i><em class="like_counter">('.$like_counter.')</em></span>';		
			
			switch( $link_type ){
				case 'lightbox':
					//check if portfolio items has a video link
					$video_link = get_post_meta( $post->ID, 'video_link', true );
					$lightbox_images = get_post_meta( $post->ID, 'lightbox_images', true );						
					if( $video_link ){
						//$hover_icon = '<span class="hover_icon"><a href="'.$video_link.'" data-rel="prettyPhoto" title="'.get_the_title().'"><i class="fa fa-plus"></i></a></span>';
						$output .= '<div class="zp_masonry_item  portfolio-item  gallery-video '.$portfolio_col.' '.zp_portfolio_items_term( $post->ID, '' ).'">';
						$output .= '<span class="zp_masonry_media"><a href="'.$video_link.'" data-rel="prettyPhoto" title="'.get_the_title().'">'.$hover_icon.$image.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.$video_link.'" data-rel="prettyPhoto" title="'.get_the_title().'">'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID, ',' ).''.$like.'</span></span>';
						$output .= '</div>';	
					}else if( $lightbox_images ){
					 // Gallery on the lightbox
						$lightbox_gallery='';
					 	$lightbox_gallery_ids = explode(",", $lightbox_images );
						$i=0;
						while($i < count( $lightbox_gallery_ids ) ){
							if( $lightbox_gallery_ids[$i] ){
								$image_full = wp_get_attachment_image_src( $lightbox_gallery_ids[$i], 'full' );
								$image_meta = zp_get_attachment_meta( $lightbox_gallery_ids[$i] );
								$lightbox_gallery .= '<a style="display: none; " href="'.$image_full[0].'" data-rel="prettyPhoto[gal_'.$post->ID.']" title="'.$image_meta['title'].'">'.$image_full[0].'</a>';
							}
						$i++;
						}						
						//$hover_icon = '<span class="hover_icon"><a href="'.$image_url.'" data-rel="prettyPhoto[gal_'.$post->ID.']" title="'.get_the_title().'"><i class="fa fa-plus"></i></a></span>';
						$output .= '<div class="zp_masonry_item  portfolio-item  gallery-image '.$portfolio_col.' '.zp_portfolio_items_term( $post->ID, '' ).'">';
						$output .= '<span class="zp_masonry_media"><a href="'.$image_url.'" data-rel="prettyPhoto[gal_'.$post->ID.']" title="'.get_the_title().'">'.$hover_icon.$image.$lightbox_gallery.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.$image_url.'" data-rel="prettyPhoto" title="'.get_the_title().'">'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID, ',' ).''.$like.'</span></span>';
						$output .= '</div>';
					}else{
					//if there's no video and no gallery images then use the image
						//$hover_icon = '<span class="hover_icon"><a href="'.$image_url.'" data-rel="prettyPhoto" title="'.get_the_title().'"><i class="fa fa-plus"></i></a></span>';
						$output .= '<div class="zp_masonry_item  portfolio-item  gallery-image '.$portfolio_col.' '.zp_portfolio_items_term( $post->ID, '' ).'">';
						$output .= '<span class="zp_masonry_media"><a href="'.$image_url.'" data-rel="prettyPhoto" title="'.get_the_title().'">'.$hover_icon.$image.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.$image_url.'" data-rel="prettyPhoto" title="'.get_the_title().'">'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID, ',' ).''.$like.'</span></span>';
						$output .= '</div>';
					}
					break;
				case 'external_link':
					$external_link = get_post_meta( $post->ID, 'zp_external_link', true );
					//$hover_icon = '<span class="hover_icon"><a href="'.$external_link.'" target="_blank"><i class="fa fa-plus"></i></a></span>';
					$output .= '<div class="zp_masonry_item  portfolio-item  '.$portfolio_col.' '.zp_portfolio_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media"><a href="'.$external_link.'" target="_blank">'.$image.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.$external_link.'" target="_blank">'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID , ',').''.$like.'</span></span>';
					//$output .= '<span class="zp_masonry_media"><a href="'.$external_link.'" target="_blank">'.$hover_icon.$image.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.$external_link.'" target="_blank">'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID , ',').''.$like.'</span></span>';
					$output .= '</div>';
					break;
				default:
					//$hover_icon = '<span class="hover_icon"><a href="'.get_permalink().'"><i class="fa fa-plus"></i></a></span>';
					$output .= '<div class="zp_masonry_item portfolio-item  '.$portfolio_col.' '.zp_portfolio_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media"><a href="'.get_permalink().'">'.$image.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.get_permalink().'" >'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID, ',' ).''.$like.'</span></span>';
					//$output .= '<span class="zp_masonry_media"><a href="'.get_permalink().'">'.$hover_icon.$image.'</a></span><span class="zp_masonry_detail"><span class="portfolio_detail_title"><a href="'.get_permalink().'" >'.get_the_title().'</a></span><span class="portfolio_detail_cat">'.zp_portfolio_items_term( $post->ID, ',' ).''.$like.'</span></span>';
					$output .= '</div>';
					break;
			}
		endwhile;
	endif;
	$output .= '</div>';
	wp_reset_postdata();
	
	return $output;
 }

/**
 * Home Blog Layout
 *
 * @param integer $items - Number of items to display
 * @param integer $columns  - Number of columns to display
 * @param boolean $filter - check filter if included or not
 * @param string $category - Post Category
 * @param boolean $load_more - Set to true to enable loadmore feature
 * @returns an HTML layout of masonry blog
 */ 
 function zp_homeblog_output( $items, $columns , $filter , $category = '', $load_more = true ) {
	global $post;
	
	// Enqueue script
	if( $load_more ){
		$category = ( $category != ''  )? $category : '';
		wp_enqueue_script('zp_imageloaded' );
		wp_enqueue_script( 'zp_post_load_more' );
		wp_localize_script( 'zp_post_load_more', 'zp_load_more', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'columns' => $columns, 'post_type' => 'post', 'category' => $category, 'posts_per_page' => $items, 'button_label'=> __( 'Load More', 'drone' ), 'loading_label' => __( 'Loading...' ,'drone' ), 'end_post' => __( 'End of Posts', 'drone' ) ) );
	}
	
	wp_enqueue_script('zp_post_like' );
	wp_localize_script( 'zp_post_like', 'zp_post_like', 
		array(
			'ajax_url' => admin_url('admin-ajax.php')
		)
	);
	
	// Initialize $ouput variable
	$output = '';
	
	// Check if $items and set default 6 when empty
	$items = ( '' == $items )? 6 : $items;
	
	// Check if $column and set default 3 when empty
	$columns  = ( '' == $columns )? 3 : $columns;

	// Set columns
	$blog_col = zp_columns( $columns );
		 
	// Filter functions
	$filter = ( $filter == 'true' )? true : false;		 
	echo zp_filter_function( $filter, $category, 'category' );
	
	$output .= '<div id="zp_masonry_container">';
	// portfolio query arguments
	if( $category != '' ){
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => $items,
			'category_name' => $category
		);
	}else{
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => $items
		);
	}
	
	$zp_post_query = new WP_Query( $args );
	
	// Render masonry blog loop
	$output .= zp_masonry_blog_loop( $zp_post_query, $blog_col );
	
	//Load More Button
	if( $load_more ){
		$output .= '<div class="zp_loader_container"><a class="load_more btn btn-default" data-nonce="'.wp_create_nonce('zp_load_posts').'" href="javascript:;">'.__( 'Load more','drone').'</a></div>';
	}
	
	return $output;
}

/**
 * Masonry Blog loop
 *
 * @param Object $zp_post_query - Contains the post query
 * @param string $blog_col - Image size/Columns class
 */
 function zp_masonry_blog_loop( $zp_post_query, $blog_col ){
	global $post;
	
	$output = ''; 
	 
	if ( $zp_post_query->have_posts() ):
		while ( $zp_post_query->have_posts() ) : $zp_post_query->the_post();
		
			// Get full image size ( for lightbox )
			$image_url = wp_get_attachment_url(  get_post_thumbnail_id(  $post->ID  )  );
			
			// Get image display size
			$image = get_the_post_thumbnail( $post->ID  , $blog_col , array('class'=> 'img-responsive', 'alt'	=> "", 'title'	=> "" ) );
					
			// Check portfolio link option ( lightbox, external or single page )
			$format = get_post_format( $post->ID );
			
			// get limit content
			if( has_excerpt( $post->ID ) ){ 
				$content = get_the_excerpt(); 
			}else{ 
				$content = strip_tags( strip_shortcodes( get_the_content() ), '<script>,<style>' ); 
				$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) ); 
				$content = genesis_truncate_phrase( $content, 150 ).'...'; 
			}
						 
			// custom read more
			$read_more = '<a class="btn btn-sm btn-default" href="'.get_permalink().'">'.__( 'Read More' , 'drone' ).'<i class="fa fa-angle-double-right"></i></a>';	
			
			// get post time
			$masonry_date = get_the_date( 'F j, Y' );
			
			//add like span
			$like_counter = ( get_post_meta( $post->ID, 'zp_like' ,true ) > 0 )? get_post_meta( $post->ID, 'zp_like' ,true ): 0;
			$like = '<span class="zp_like_holder '.$post->ID.'"><i class="fa fa-heart-o '.$post->ID.'"></i><em class="like_counter">('.$like_counter.')</em></span>';
			
			switch( $format ){
				case 'audio':
					$audio_embed = get_post_meta( $post->ID, 'zp_embed_audio', true);
					if( $audio_embed ){
						$audio_post = stripslashes(htmlspecialchars_decode($audio_embed));
					}else{
						$audio_post = zp_audio( $post->ID, $blog_col );
					}
					$output .= '<div class="zp_masonry_item blog-item  gallery-video '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_audio">'.$audio_post.'</span><span class="zp_masonry_detail"><span class="zp_masonry_title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></span><span class="zp_masonry_info">'.$masonry_date.$like.'</span><span class="zp_masonry_content">'.$content.$read_more.'</span></span>';
					$output .= '</div>';
					break;
				case 'gallery':
					$output .= '<div class="zp_masonry_item blog-item  '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_gallery">'.zp_gallery($post->ID, $blog_col, 'zp_post_gallery' ).'</span><span class="zp_masonry_detail"><span class="zp_masonry_title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></span><span class="zp_masonry_info">'.$masonry_date.$like.'</span><span class="zp_masonry_content">'.$content.$read_more.'</span></span>';
					$output .= '</div>';
					break;
				case 'image':
					$output .= '<div class="zp_masonry_item blog-item  '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_image">'.$image.'</span><span class="zp_masonry_detail"><span class="zp_masonry_title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></span><span class="zp_masonry_info">'.$masonry_date.$like.'</span><span class="zp_masonry_content">'.$content.$read_more.'</span></span>';
					$output .= '</div>';
					break;
				case 'link':
					$link = get_post_meta( $post->ID, 'zp_link_format', true );
					$output .= '<div class="zp_masonry_item blog-item  '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_image"><a href="'.$link.'" target="_blank">'.$image.'</a></span><span class="zp_masonry_detail zp_masonry_link"><span class="zp_masonry_link_title"><h2><a href="'.$link.'" title="'.get_the_title().'" target="_blank">'.get_the_title().'</a></h2><span class="zp_masonry_info">'.$masonry_date.$like.'</span></span><span class="zp_masonry_link_desc">'.apply_filters( 'content', get_the_content() ).'</span>';
					$output .= '</div>';
					break;
				case 'quote':
					$output .= '<div class="zp_masonry_item blog-item  '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_image">'.$image.'</span><span class="zp_masonry_detail zp_masonry_quote"><span class="zp_masonry_quote_title"><h2>'.get_the_content().'</h2></span><span class="zp_masonry_quote_desc">'. get_the_title().$like.'</span></span>';
					$output .= '</div>';
					break;
				case 'video':
					$embed = get_post_meta( $post->ID, 'zp_video_format_embed', true);
					if( !empty( $embed ) ) {
						$video_post = '<script type="text/javascript">jQuery(document).ready(function(){ jQuery(".zp_masonry_video").fitVids(); }); </script>';
						$video_post .=  stripslashes(htmlspecialchars_decode($embed));
                   	} else {
					   $video_post = zp_video($post->ID, $blog_col );
					}
					$output .= '<div class="zp_masonry_item  blog-item  '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_video">'. $video_post.'</span><span class="zp_masonry_detail"><span class="zp_masonry_title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></span><span class="zp_masonry_info">'.$masonry_date.$like.'</span><span class="zp_masonry_content">'.$content.$read_more.'</span></span>';
					$output .= '</div>';
					break;
				default:
				 	// standard post format
					$output .= '<div class="zp_masonry_item  blog-item  '.$blog_col.' '.zp_post_items_term( $post->ID, '' ).'">';
					$output .= '<span class="zp_masonry_media zp_masonry_standard">'.$image.'</span><span class="zp_masonry_detail"><span class="zp_masonry_title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></span><span class="zp_masonry_info">'.$masonry_date.$like.'</span><span class="zp_masonry_content">'.$content.$read_more.'</span></span>';
					$output .= '</div>';
					break;
			}
		endwhile;
	endif;
	$output .= '</div>';
	wp_reset_postdata();
	
	return $output; 
 }

/**
 * Add Like functionality on blog items
 * using AJAX
 */
 
add_action('wp_ajax_zp_insert_likes', 'zp_insert_likes');
add_action('wp_ajax_nopriv_zp_insert_likes', 'zp_insert_likes');

function zp_insert_likes(){
	$post_id = $_POST["post_id"];
	zp_add_like($post_id);
	echo get_post_meta( $post_id, 'zp_like', true );
	die();
}

function zp_add_like($post_id){
	$likes = get_post_meta($post_id,'zp_like',true);
	$likes = $likes + 1;
	update_post_meta($post_id,'zp_like',$likes);
}

add_action('publish_post', 'zp_add_custom_likes');
function zp_add_custom_likes($post_id){
	global $post;
	setup_postdata( $post );
	add_post_meta($post_id, 'zp_like', 0, true);
	return true;
}

/**
 * Add Load More Post functionality in
 * portfolio and in masonry blog using AJAX
 */
add_action( "wp_ajax_zp_load_posts", "zp_load_more_posts" );
add_action( "wp_ajax_nopriv_zp_load_posts", "zp_load_more_posts" );

function zp_load_more_posts() {
	//verifying nonce here
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "zp_load_posts" ) ) {
		exit("You should not be here.");
	}

	$offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
	$posts_per_page = isset($_REQUEST['posts_per_page'])?intval($_REQUEST['posts_per_page']):10;
	
	//optional, if post type is not defined use regular post type
	$post_type = isset($_REQUEST['post_type'])?$_REQUEST['post_type']:'portfolio';
	
	// Number of columns
	$columns = isset($_REQUEST['columns'])?$_REQUEST['columns']:'3';
	
	// Get Pre defined category
	$category = isset($_REQUEST['category'])?$_REQUEST['category']:'';
	
	// Set columns
	$masonry_col = zp_columns( $columns );
	
	ob_start();

	//Portfolio Query
	if( $post_type == 'portfolio' ){
		if( $category == '' ){
			$args = array(
				'post_type'	=> $post_type,
				'offset' => $offset,
				'posts_per_page' => $posts_per_page
			);	
		}else{
			$args= array(
				'posts_per_page' => $posts_per_page,
				'post_type' => $post_type,
				'offset' => $offset,
				'portfolio_category' => $category
			);
		}
	}
	
	//Posts Query
	if( $post_type == 'post' ){
		if( $category == '' ){
			$args = array(
				'post_type'		=> $post_type,
				'offset' => $offset,
				'posts_per_page' => $posts_per_page,
				'post_status' => 'publish'
			);	
		}else{
			$args = array(
				'post_type'		=> $post_type,
				'posts_per_page' => $posts_per_page,
				'offset' => $offset,
				'category_name' => $category,
				'post_status' => 'publish'
			);
		}
	}
	
	$posts_query = new WP_Query( $args );
	
	// Get the total number of Posts
	$count_posts = wp_count_posts( $post_type )->publish;
		
	if ( $posts_query->have_posts() && (( $count_posts < $posts_per_page ) || ( $posts_per_page != -1 ) ) ) {
		$result['have_posts'] = true;
			if( $post_type == 'portfolio' )		
				echo zp_portfolio_loop( $posts_query, $masonry_col );
			else
				echo zp_masonry_blog_loop( $posts_query, $masonry_col );
		$result['html'] = ob_get_clean();
	} else {
		//no posts found
		$result['have_posts'] = false;
	}
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$result = json_encode($result);
		echo $result;
	}else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

/**
 * Get Image Attachment Metadata ( caption, title ..)
 *
 * @param integer $attachment_id 
 * @returns an array of values
 */
 function zp_get_attachment_meta( $attachment_id ) {
	 $attachment = get_post( $attachment_id );
	 return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}