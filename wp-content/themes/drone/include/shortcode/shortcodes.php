<?php
/**
 * Theme Shortcodes
 *
 */

/**
 * Post Like
 */
if( !function_exists( 'zp_post_like' )){
	function zp_post_like(){
		global $post;
		
		// Enqueue script
		wp_enqueue_script('zp_post_like' );
		wp_localize_script( 'zp_post_like', 'zp_post_like', 
			array(
				'ajax_url' => admin_url('admin-ajax.php')
			)
		);
		
		$like_counter = ( get_post_meta( $post->ID, 'zp_like' ,true ) > 0 )? get_post_meta( $post->ID, 'zp_like' ,true ): 0;
		$like = '<span class="zp_like_holder '.$post->ID.'"><i class="fa fa-heart-o '.$post->ID.'"></i><em class="like_counter">('.$like_counter.')</em></span>';
		
		return $like;
	}
	add_shortcode( 'zp_post_like', 'zp_post_like' );
}
 
/*
 * Button Shortcode
 */
if (!function_exists( 'zp_button' )){
	function zp_button( $atts, $content = null ){
		extract( shortcode_atts( array(
			'link' => '',
			'size' => '',
			'type' => '',
			'outline' => '',
			'target' => ''
		),$atts ));
		
		if( $outline == 'true' ){
			$outline = 'btn-outline';
		}else{
			$outline = '';
		}
		$target = ( $target != '' )? 'target="'.$target.'"' : '';
		
		$type = ( $type == '' )? 'btn-default' : 'btn-'.$type;
		
		return '<a type="button" class="btn '.$type.' '.$outline.' '.$size.'" href="'.$link.'" '.$target.'>'.$content.'</a>';
	}
	add_shortcode( 'zp_button', 'zp_button');
}

/*
 * Columns
 */

// Column Wrapper
if ( !function_exists( 'zp_column_wrapper' ) ){
	function zp_column_wrapper( $atts, $content = null ){
		return '<div class="column_wrapper row">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_wrapper', 'zp_column_wrapper' );
}

// One Third Column
if (!function_exists('zp_one_third')) {
	function zp_one_third( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';	
		}else{
			$align = 'text-left';	
		}
	   return '<div class="col-md-4 col-sm-4 col-xs-12 '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode('one_third', 'zp_one_third');
}

// One Half Column
if ( !function_exists( 'zp_one_half' ) ){
	function zp_one_half( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));

		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';	
		}else{
			$align = 'text-left';	
		}
		
		return '<div class="col-md-6 col-sm-6 col-xs-12  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'one_half', 'zp_one_half' );
}

// One Fourth Column
if ( !function_exists( 'zp_one_fourth' ) ){
	function zp_one_fourth( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';	
		}else{
			$align = 'text-left';	
		}
		
		return '<div class="col-md-3 col-sm-3 col-xs-12  '.$class.' '.$align.'">'.do_shortcode($content).'</div>'; 
	}
	add_shortcode( 'one_fourth', 'zp_one_fourth' );
}

/**
 *	Grid Columns
 */
 
// Grid Column 1
if ( !function_exists( 'zp_column_grid_1' ) ){
	function zp_column_grid_1( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));	
		
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		return '<div class="col-md-1  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_1','zp_column_grid_1' );
}

// Grid Column 2
if( !function_exists( 'zp_column_grid_2' )){
	function zp_column_grid_2( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';	
		}
		
		return '<div class="col-md-2  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_2', 'zp_column_grid_2' );
}

// Grid Column 3
if( !function_exists( 'zp_column_grid_3' )){
	function zp_column_grid_3( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-3  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_3', 'zp_column_grid_3' );
}

// Grid Column 4
if( !function_exists( 'zp_column_grid_4' )){
	function zp_column_grid_4( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-4  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_4', 'zp_column_grid_4' );
}

// Grid Column 5
if( !function_exists( 'zp_column_grid_5' )){
	function zp_column_grid_5( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-5  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_5', 'zp_column_grid_5' );
}

// Grid Column 6
if( !function_exists( 'zp_column_grid_6' )){
	function zp_column_grid_6( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-6  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_6', 'zp_column_grid_6' );
}

// Grid Column 7
if( !function_exists( 'zp_column_grid_7' )){
	function zp_column_grid_7( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-7  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_7', 'zp_column_grid_7' );
}

// Grid Column 8
if( !function_exists( 'zp_column_grid_8' )){
	function zp_column_grid_8( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-8  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_8', 'zp_column_grid_8' );
}

// Grid Column 9
if( !function_exists( 'zp_column_grid_9' )){
	function zp_column_grid_9( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-9  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_9', 'zp_column_grid_9' );
}

// Grid Column 10
if( !function_exists( 'zp_column_grid_10' )){
	function zp_column_grid_10( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-10  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_10', 'zp_column_grid_10' );
}

// Grid Column 11
if( !function_exists( 'zp_column_grid_11' )){
	function zp_column_grid_11( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-11  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_11', 'zp_column_grid_11' );
}

// Grid Column 12
if( !function_exists( 'zp_column_grid_12' )){
	function zp_column_grid_12( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
			'class' => ''
		), $atts ));
		
		if( $align == 'center' ){
			$align = 'text-center';	
		}elseif( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		
		return '<div class="col-md-12  '.$class.' '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_grid_12', 'zp_column_grid_12' );
}

/*
 * Service Shortcode
 *
 */
if( !function_exists( 'zp_service_shortcode' )){
	function zp_service_shortcode( $atts, $content = null ){		
		// initialize variable
		$output = '';
		
		$output .= '<div class="service_shortcode row">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	
	add_shortcode( 'services', 'zp_service_shortcode' );
}

if( !function_exists( 'zp_service_shortcode_item' )){
	function zp_service_shortcode_item( $atts, $content = null ){
		extract ( shortcode_atts( array(
			'column' => '',
			'title' => '',
			'align' => '',
			'icon' => '',
			'btn_target' => '',
			'btn_link' => '',
			'btn_name' => ''
		), $atts ));
		
		//initialize variable
		$output = '';
		
		// check icon if an image
		if( ( strpos( $icon, '.png' ) !== false ) || ( strpos( $icon, '.jpg' ) !== false ) || ( strpos( $icon, '.gif' ) !== false ) ){
			$icon_wrap = '<div class="service_icon_wrap"><img src="'.$icon.'" alt="'.$title.'" /></div>';	
		}else{
			$icon_wrap = '<div class="circle"><i class="'.$icon.'"></i></div>';			
		}
		
		// check text alignment
		switch( $align ){
			case 'center': $align = 'text-center'; break;
			case 'left': $align = 'text-left'; break;
			case 'right': $align = 'text-right'; break;
			default: $align = 'text-center'; break;
		}		
		//check number of columns
		switch( $column ){
			case 2: $column = 'col-lg-6 col-md-6 col-sm-6 col-xs-12'; break;
			case 3: $column = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; break;
			case 4: $column = 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
			default:$column = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; break;
		}
		
		//check if there is button
		$btn = '';
		if( $btn_name ){
			$btn = '<p><a href="'.$btn_link.'" class="btn btn-default" target="'.$btn_target.'">'.$btn_name.'</a></p>';	
		}
		
		$title_wrap = '';
		if( $title ){
			$title_wrap = '<h3>'.$title.'</h3>';	
		}
		
		$output .= '<div class="service_item '.$column.' '.$align.'"><div class="featured-box">'.$icon_wrap.'<div class="featured-desc">'.$title_wrap.'<p>'.$content.'</p>'.$btn.'</div></div></div>';
		return $output;
	}
	add_shortcode( 'service_item', 'zp_service_shortcode_item' );
}

/**
 *	Progress Bar
 */
if ( !function_exists( 'zp_progress_bar' ) ){
	function zp_progress_bar( $atts, $content = null ){
		extract( shortcode_atts( array(
			 'label' => '',
			 'value' =>'',
			 'type' => '',
			 'stripe' => ''
		), $atts ));		
		$output = '';
		
		$type = ( $type == '' )? '' : 'progress-bar-'.$type;
		
		$stripe = ( $stripe == 'true' ) ? 'progress-striped' : ''; 
		
		$output .= '<div class="zp_progress_bar progress '.$stripe.'"><div class="progress-bar '.$type.'" role="progressbar" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$value.'%;"> <span class="sr-only">'.$value.'% Complete</span></div><span class="progress-type">'.$label.'</span> <span class="progress-completed">'.$value.'%</span></div>';
		
		return $output;		
	}
	add_shortcode( 'zp_progress', 'zp_progress_bar' );
}

/**
 *	Accordion Section
 */
if ( !function_exists( 'zp_accordion_wrap' ) ){
	function zp_accordion_wrap( $atts, $content = null ){
		return ' <div class="panel-group" id="accordion">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'accordion_wrap', 'zp_accordion_wrap' );
}

if ( !function_exists( 'zp_accordion' )){
	function zp_accordion( $atts, $content = null ){
		extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
			'open' => ''
		), $atts));
		
		$id = str_replace( ' ', '_' , $id );
		
		$open = ( $open == 'true' )? 'zp_open' : '';
		
		$heading = '<div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse"  href="#'.$id.'">'.$title.'</a></h4></div>';
		
		$content = '<div id="'.$id.'" class="'.$open.' panel-collapse collapse"><div class="panel-body">'.do_shortcode( $content ).'</div></div> ';
		
		return '<div class="panel panel-default">'.$heading.$content.'</div>';
	}
	
	add_shortcode( 'accordion', 'zp_accordion' );
}

/**
 * Tabs
 */

if( !function_exists( 'zp_tabs' )){
	function zp_tabs( $atts, $content = null ){
		extract( shortcode_atts( array(
			'ids' => '',
			'nav' => ''
		), $atts ) );
		
		$ids_array = explode( ',',$ids );
		$nav_array = explode( ',',$nav );
		$output = '';
		
		$output .= '<div class="tab_container">';
		$output .= '<ul class="nav nav-tabs">';
		for( $i=0; $i < count( $nav_array ); $i++ ){
			$output .= '<li><a href="#'.$ids_array[$i].'" data-toggle="tab">'.$nav_array[$i].'</a></li>';	
		}
		$output .= '</ul>';
		
		$output .= '<div class="tab-content">'.do_shortcode( $content ).'</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'tab', 'zp_tabs' );
}

if( !function_exists( 'zp_tabpane' )){
	function zp_tabpane( $atts, $content = null ){
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );
		
		return '<div class="tab-pane fade" id="'.$id.'">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'tabpane', 'zp_tabpane' );
}

/**
 *	Testimonial
 */

if ( !function_exists( 'zp_testimonial' )){
	function zp_testimonial( $atts, $content = null ){
		extract( shortcode_atts( array(
			'id' => '',
		),$atts ));
		
		$output = '';
		
		$output .= '<div class="carousel slide" data-ride="carousel" id="quote-carousel">';
		$output .= '<div class="carousel-inner">'.do_shortcode( $content ).'</div>';
		$output .= '<p><a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a><a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a></p>';
		$output .= '</div>';

		
		return $output;
	}
	add_shortcode( 'testimonial','zp_testimonial' );
}

// testimonial item
if( !function_exists( 'zp_testimonial_item' ) ){
	function zp_testimonial_item( $atts, $content = null ){
		extract( shortcode_atts( array(
			'active' => '',
			'image_url' => '',
			'title' => ''
		), $atts ));
		
		$active = ( $active == 'true' ) ? 'active' : '';
				
		$output = '';
		$output .= '<div class="item '.$active.'"><blockquote>';
		$output .= '<div class="row"><div class="col-md-3 col-sm-12 text-center"><img class="img-circle" src="'.$image_url.'"  style="width: 120px;height:120px;"></div>';
		$output .= '<div class="col-md-9 col-sm-12"><p>'.$content.'</p><p><small>'.$title.'</small></p></div></div>';
		$output .= '</blockquote></div>';
		
		return $output;		
	}
	add_shortcode( 'testimonial_item','zp_testimonial_item' );
}

/**
 *	Team Section
 */

if ( !function_exists( 'zp_team_section' )){
	function zp_team_section( $atts, $content = null ){
		extract( shortcode_atts( array(
		), $atts ));
		return '<div class="zp_team"><div class="row">'.do_shortcode($content).'</div></div>';
	}
	add_shortcode ('team', 'zp_team_section');
}

// Team Item
if( !function_exists( 'zp_team_item' ) ){
	function zp_team_item( $atts, $content = null ){
		extract( shortcode_atts( array(
			'column' => '',
			'align' => '',
			'title' => '',
			'position' => '',
			'image_url' =>'',
			'image_style' => '',
			'dribbble' => '',
			'flickr' => '',
			'github' => '',
			'pinterest' => '',
			'twitter' => '',
			'facebook' => '',
			'google' => '',
			'skype' => '',
			'tumblr' => '',
			'vimeo' => '',
			'youtube' => '',
			'linkedin' => ''
		), $atts ));
		
		$output = '';
		
		// check the number of columns
		if( $column == 2 ){
			$column = 'col-md-6 col-sm-6 col-xs-12';
		}elseif( $column == 3 ){
			$column = 'col-md-4 col-sm-6 col-xs-12 ';
		}elseif ( $column == 4 ){
			$column = 'col-md-3 col-sm-6 col-xs-12 ';
		}else{
			$column = 'col-md-3 col-sm-6 col-xs-12';
		}
		
		//Image style
		if( $image_style == '' ){
			$image_style = 'img-responsive img-circle';	
		}else{
			$image_style = 'img-responsive img-'.$image_style;	
		}
		
		// check the content alignment
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';
		}else{
			$align = 'text-left';
		}
		$social = '';
		if( $dribbble ){
			$social .= '<li><a href="'.$dribbble.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Dribbble" target="_blank" ><i class="fa fa-dribbble"></i></a></li>';
		}
		if( $flickr ){
			$social .= '<li><a href="'.$flickr.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Flickr" target="_blank" ><i class="fa fa-flickr"></i></a></li>';	
		}
		if( $github ){
			$social .= '<li><a href="'.$github.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Github" target="_blank" ><i class="fa fa-github"></i></a></li>';	
		}
		if( $pinterest  ){
			$social .= '<li><a href="'.$pinterest.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>';	
		}
		if( $twitter ){
			$social .= '<li><a href="'.$twitter.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>';	
		}
		if( $facebook ){
			$social .= '<li><a href="'.$facebook.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>';	
		}
		if( $google ){
			$social .= '<li><a href="'.$google.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Google+" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>';	
		}
		if( $skype ){
			$social .= '<li><a href="'.$skype.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Skype" target="_blank"><i class="fa fa-skype"></i></a></li>';	
		}
		if( $tumblr ){
			$social .= '<li><a href="'.$tumblr.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Tumblr" target="_blank"><i class="fa fa-tumblr"></i></a></li>';	
		}
		if( $vimeo ){
			$social .= '<li><a href="'.$vimeo.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Vimeo" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';	
		}
		if( $youtube ){
			$social .= '<li><a href="'.$youtube.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>';	
		}
		if( $linkedin ){
			$social .= '<li><a href="'.$linkedin.'" class="tooltip-trigger mlm" title="" data-toggle="tooltip" data-original-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>';	
		}
		
		$output .= '<div class="'.$column.' '.$align.'"><div class="thumbnail" ><div class="feature-icon"><img class="'.$image_style.'" alt="'.$title.'" src="'.$image_url.'" /></div><div class="caption"><h3>'.$title.'<br><small>'.$position.'</small></h3><p>'.do_shortcode( $content ).'</p><ul class="team_social">'.$social.'</ul></div></div></div>';
		
		return $output;		
	}
	
	add_shortcode( 'team_item' , 'zp_team_item' );
}

/**
 * Portfolio
 */

if ( !function_exists( 'zp_portfolio_section' )){
	function zp_portfolio_section( $atts, $content = null ){
		extract( shortcode_atts( array(
			'items' 	=> '',
			'columns'   => '',
			'filter'	=> '',
			'category'	=> '',
			'load_more' => ''
	), $atts ) );
		
		$filter =  ( $filter == 'true' ||  $filter == '' )? true : false;
		$load_more =  ( $load_more == 'true' ||  $load_more == '' )? true : false;
		return zp_portfolio_output( $items, $columns, $filter, $category, $load_more  );
	}
	add_shortcode ('zp_portfolio', 'zp_portfolio_section');
}

/**
 * Blog
 */

if ( !function_exists( 'zp_blog_section' )){
	function zp_blog_section( $atts, $content = null ){
		extract( shortcode_atts( array(
			'items' 	=> '',
			'columns'   => '',
			'filter'	=> '',
			'category'	=> '',
			'load_more' => ''
	), $atts ) );
		
		$filter =  ( $filter == 'true' ||  $filter == '' )? true : false;
		$load_more =  ( $load_more == 'true' ||  $load_more == '' )? true : false;
		return zp_homeblog_output( $items, $columns, $filter, $category, $load_more  );
	}
	add_shortcode ('zp_blog', 'zp_blog_section');
}

/**
 * Slider
 */
if ( !function_exists( 'zp_slider_code' ) ){
	function zp_slider_code( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'id' => '',
			'navigation' => '',
			'indicator' => '',
			'items' => ''
		), $atts ));
		
		$output = '';
		$output .= '<div  class="zp_slider"><div class="carousel slide" id="'.$id.'">';
		
		// Indicator
		if( $indicator == 'true' ){
			$output .= '<ol class="carousel-indicators">';
			
			$items = ( $items != '' )? $items : 1;
			$i=0;
			while( $i < $items ){				
				$active = ( $i == 0)? 'active' : '';				
				$output .= '<li data-target="#'.$id.'" data-slide-to="'.$i.'" class="'.$active.'"></li>';				
				$i++;
			}
			
			$output .= '</ol>';
		}
		$output .= '<div class="carousel-inner">'.do_shortcode( $content ).'</div>';
		
		
		// Navigation
		if( $navigation == 'true' ){
			$output .= '<a class="carousel-control left" data-target="#'.$id.'" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="carousel-control right" data-target="#'.$id.'" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
		}
		
		$output .= '</div></div>';
		return $output;
	}
	add_shortcode ('zp_slider', 'zp_slider_code');
}

if( !function_exists( 'zp_slide_item' ) ){
	function zp_slide_item( $atts, $content = null ){
		extract( shortcode_atts( array(
			'image'	=> '',
			'title' => '',
			'link' => '',
			'active' => ''
		), $atts ));
		
		$output = '';
		
		$header = ( $title != '') ? '<h3>'.$title.'</h3>': '';
		$active = ( $active == 'true' ) ? 'active' : '';
		
		// caption
		if( $title != '' && $content != '' ){
			$caption = '<div class="carousel-caption">'.$header.do_shortcode( $content ).'</div>';	
		}else{
			$caption = '';	
		}

		if( $link != '' ){
			$output .= '<div class="item '.$active.'"><a href="'.$link.'" ><img src="'.$image.'" class="img-responsive" alt="'.$title.'" />'.$caption.'</a></div>';
		}else{
			$output .= '<div class="item '.$active.'"><img src="'.$image.'" class="img-responsive" alt="'.$title.'" />'.$caption.'</div>';
		}
						
		return $output;				
	}
	add_shortcode ('slide_item', 'zp_slide_item');
}