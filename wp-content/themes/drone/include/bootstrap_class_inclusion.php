<?php
/**
 * Integration of Bootstrap classes to Genesis Framework
 */

	/**
	*  Add bootstrap class to .site-header
	*/
	add_filter( 'genesis_attr_site-header', 'zzp_site_header_id', 10, 2 );
	function zzp_site_header_id( $attributes, $context ){
		$attributes['id'] = 'header' ;
		return  $attributes;
	}
	
	/**
	* Add bootstrap class to .nav-primary
	*/
	add_filter( 'genesis_attr_site-header', 'zzp_site_header_class', 10, 2 );
	function zzp_site_header_class( $attributes, $context ){
		$attributes['class'] = 'site-header navbar navbar-default fixed_header ';
		return  $attributes;
	}
 
	/**
	* Add bootstrap class to .nav-primary
	*/
	add_filter( 'genesis_attr_nav-primary', 'zzp_nav_primary_class', 10 , 2  );
	function zzp_nav_primary_class( $attributes, $context ){
		$attributes['class'] = 'nav-primary navbar-right';
		return $attributes;
	}
	
	/**
	* Add bootstrap class to .secondary-primary
	*/
	add_filter( 'genesis_attr_nav-secondary', 'zzp_nav_secondary_class', 10 , 2  );
	function zzp_nav_secondary_class( $attributes, $context ){
		$attributes['class'] = 'nav-secondary';
		return $attributes;
	}
	
	/**
	* Add bootstrap class to .site-footer
	*/
	add_filter( 'genesis_attr_site-footer', 'zzp_site_footer_class', 10 , 2  );
	function zzp_site_footer_class( $attributes, $context ){
		$attributes['class'] = 'site-footer bottom-menu';
		return $attributes;
	}

	/**
	* Add bootstrap class to .title-area
	*/
	add_filter( 'genesis_attr_title-area', 'zzp_title_area_class', 10 , 2  );
	function zzp_title_area_class( $attributes, $context ){		
		$attributes['class'] = 'title-area navbar-left';
		return $attributes;
	}
	
	/**
	* Add bootstrap class to .header-widget-area
	*/
	add_filter( 'genesis_attr_header-widget-area', 'zzp_header_widget_area_class', 10 , 2  );
	function zzp_header_widget_area_class( $attributes, $context ){
		$attributes['class'] = 'header-widget-area col-md-8 col-sm-8';
		return $attributes;
	}
	
	/**
	* Create additional <div> 'container' and 'row' on site header
	*/
	
	add_action( 'genesis_header', 'zzp_header_markup_open', 6 );
	
	function zzp_header_markup_open(){
	 echo '<div class="container">';  
	}
	
	add_action( 'genesis_header', 'zzp_header_markup_close', 14 );
	function zzp_header_markup_close(){
	  echo '</div>';
	}
	
	/**
	* Create additional <div> 'container' and 'row' on site inner
	*
	*/
	
	add_action( 'genesis_before_content', 'zzp_site_inner_markup_open' );
	function zzp_site_inner_markup_open(){
		if( !is_page_template( 'home_template.php' ) && !is_tax(  'portfolio_category'  ) && !is_post_type_archive( 'portfolio' ) )
			echo '<div class="container"><div class="row">';
	}
	
	add_action( 'genesis_after_content', 'zzp_site_inner_markup_close' );
	function zzp_site_inner_markup_close(){
		if( !is_page_template( 'home_template.php' ) && !is_tax(  'portfolio_category'  ) && !is_post_type_archive( 'portfolio' ) )
			echo '</div></div>';
	}
  
	/**
	* Create additional <div> 'container' and 'row' on site footer
	*/
	
	add_action( 'genesis_footer', 'zzp_footer_markup_open', 6 );
	function zzp_footer_markup_open(){
	  echo '<div class="container"><div class="row">';
	}
	
	add_action( 'genesis_footer', 'zzp_footer_markup_close', 14 );
	function zzp_footer_markup_close(){
	 echo '</div></div>'; 
	}
  
	/**
	* Add Classes to Genesis Primary nav
	*/

	add_filter( 'wp_nav_menu_args' , 'zp_custom_primary_nav' );
	function zp_custom_primary_nav( $args ) {
		if ( $args['theme_location'] == 'primary' || $args['theme_location'] == 'secondary' ) {
			$args['walker'] = new ZP_Custom_Genesis_Nav_Menu;
			$args['desc_depth'] = 0;
			$args['thumbnail'] = false;
		}
		return $args;
		
	}

	/**
	* Menu Walker Class
	*/
	
	class ZP_Custom_Genesis_Nav_Menu extends Walker_Nav_Menu {
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
		
		 $attributes='';

        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . ' dropdown"';
 
        $output .= '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		
		//check if the link is a section or an http link
		$check_link = strpos( $item->url, 'http' );
		if( $check_link === false ){
			$dropdown_class = 'class="dropdown-toggle" data-toggle="dropdown"';
			$external_class = '';
 		}else{
			$dropdown_class = '';
			$external_class = '';	
		}

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
	    $item_output = $args->before;
		
		// menu link output
        $item_output .= '<a class="'.$external_class.'" '. $attributes .'  '.$dropdown_class.' >';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			
		// close menu link anchor
        $item_output .= '</a>';
        $item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	* Filter Primary Nav
	*/
	
	add_filter( 'genesis_do_nav', 'zp_filter_genesis_nav', 10, 3 );
	
	function zp_filter_genesis_nav( $nav_output , $nav, $args){
		
		if ( ! genesis_nav_menu_supported( 'primary' ) )
		return;

		//* If menu is assigned to theme location, output
		if ( has_nav_menu( 'primary' ) ) {
	
			$class = 'menu genesis-nav-menu menu-primary nav navbar-nav navbar-left';
			if ( genesis_superfish_enabled() )
				$class .= ' js-superfish';
	
			$args = array(
				'theme_location' => 'primary',
				'container'      => '',
				'menu_class'     => $class,
				'echo'           => 0,
			);
	
			$nav = wp_nav_menu( $args );
	
			//* Do nothing if there is nothing to show
			if ( ! $nav )
				return;
	
			$nav_markup_open = genesis_markup( array(
				'html5'   => '<nav %s>',
				'xhtml'   => '<div id="nav">',
				'context' => 'nav-primary',
				'echo'    => false,
			) );
			$nav_markup_open .= genesis_get_structural_wrap( 'menu-primary', 'open', 0 );
	
			$nav_markup_close  = genesis_get_structural_wrap( 'menu-primary', 'close', 0 );
			$nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';
	
			$nav_output = $nav_markup_open . $nav . $nav_markup_close;
			
			
		 }
		 return $nav_output;
	}

	/**
	* Filter Secondary Nav
	*/
	add_filter( 'genesis_do_subnav', 'zp_filter_genesis_subnav', 10, 3 );
	
	function zp_filter_genesis_subnav( $nav_output , $nav, $args){
		
		if ( ! genesis_nav_menu_supported( 'secondary' ) )
		return;

		//* If menu is assigned to theme location, output
		if ( has_nav_menu( 'secondary' ) ) {

		$class = 'menu genesis-nav-menu menu-secondary nav navbar-nav navbar-right';
		if ( genesis_superfish_enabled() )
			$class .= ' js-superfish';

		$args = array(
			'theme_location' => 'secondary',
			'container'      => '',
			'menu_class'     => $class,
			'echo'           => 0,
		);

		$subnav = wp_nav_menu( $args );

		//* Do nothing if there is nothing to show
		if ( ! $subnav )
			return;

		$subnav_markup_open = genesis_markup( array(
			'html5'   => '<nav %s>',
			'xhtml'   => '<div id="subnav">',
			'context' => 'nav-secondary',
			'echo'    => false,
		) );
		$subnav_markup_open .= genesis_get_structural_wrap( 'menu-secondary', 'open', 0 );

		$subnav_markup_close  = genesis_get_structural_wrap( 'menu-secondary', 'close', 0 );
		$subnav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

		$subnav_output = $subnav_markup_open . $subnav . $subnav_markup_close;
			
			
		 }
		 return $subnav_output;
	}