<?php

// Start the engine

require_once( get_template_directory() . '/lib/init.php' );



// Localization

load_child_theme_textdomain(  'drone', apply_filters(  'child_theme_textdomain', get_stylesheet_directory(  ) . '/languages', 'drone'  )  );



// include bootstrap inclusion function

include( get_stylesheet_directory() . '/include/bootstrap_class_inclusion.php' );



// Add Custom Post Types

require_once(  get_stylesheet_directory(  ) . '/include/cpt/super-cpt.php'   );

require_once(  get_stylesheet_directory(  ) . '/include/cpt/zp_cpt.php'   );



// Include Theme Settings

require_once (  get_stylesheet_directory(  ) . '/include/theme_settings.php'   );



// Include Additional Theme Functions

require_once (  get_stylesheet_directory(  ) . '/include/theme_functions.php'   );



// Include Shortcodes

require_once(  get_stylesheet_directory(  ) . '/include/shortcode/shortcodes_init.php' );



// Include Related Post File

require_once(  get_stylesheet_directory(  ) . '/include/related_post.php' );



// Child theme (do not remove)

define( 'CHILD_THEME_NAME', 'Drone' );

define( 'CHILD_THEME_URL', 'http://demo.zigzagpress.com/drone/' );



// Supports HTML5

add_theme_support( 'html5' );



// Add Mobile Support viewport

add_theme_support( 'genesis-responsive-viewport' );



// Add support for custom background

$args = array(

	'default-image' => get_stylesheet_directory_uri().'/images/bg.png',

);

add_theme_support( 'custom-background' , $args );



// Add support for structural wraps

add_theme_support( 'genesis-structural-wraps', array ( 'footer-widgets' ) );



//* Add support for post formats

add_theme_support( 'post-formats', array( 'audio','gallery','link','quote','video', 'image') );



// add footer widget area

add_theme_support(  'genesis-footer-widgets', 3 );



// Reposition Primary Navigation

remove_action( 'genesis_after_header', 'genesis_do_nav' );

add_action( 'genesis_header', 'genesis_do_nav', 11 );



// Reposition Secondary Navigation

remove_action( 'genesis_after_header', 'genesis_do_subnav' );

add_action( 'genesis_header', 'genesis_do_subnav', 11 );



// Unregister header right

unregister_sidebar(  'header-right'  );

unregister_sidebar( 'sidebar-alt' );



// Unregister Layout

genesis_unregister_layout( 'content-sidebar-sidebar' );

genesis_unregister_layout( 'sidebar-sidebar-content' );

genesis_unregister_layout( 'sidebar-content-sidebar' );



/**

 * Adding Tinymice Editor Style

 */

function zp_add_editor_styles() {

	add_editor_style( get_stylesheet_directory_uri( ).'/css/zp_editor_style.css' );

}

add_action( 'after_setup_theme', 'zp_add_editor_styles' );



/**

 * Add Bootstrap CSS before child theme style

 * Load bootstrap first before the child theme style.css.

 */

 

add_action( 'wp_enqueue_scripts','zp_add_bootstrap_class', 5 );

function zp_add_bootstrap_class(){

	wp_register_style( 'bootstrap', get_stylesheet_directory_uri( ).'/css/bootstrap.css' );

	wp_enqueue_style( 'bootstrap' );

}



// Additional Stylesheets

add_action( 'wp_enqueue_scripts', 'zp_print_styles'  );

function zp_print_styles( ) {



	wp_enqueue_style( 'fontawesome_css', get_stylesheet_directory_uri( ).'/css/fontawesome.css' );

	wp_enqueue_style( 'bootstrap_override', get_stylesheet_directory_uri( ).'/css/main.css' );

	wp_enqueue_style( 'prettyPhoto', get_stylesheet_directory_uri( ).'/css/prettyPhoto.css' );

	

	// Include shortcode CSS

	wp_enqueue_style( 'zp_shortcode', get_stylesheet_directory_uri( ).'/include/shortcode/shortcode.css' );	

	

	// Mobile CSS

	wp_register_style( 'mobile', get_stylesheet_directory_uri( ).'/css/mobile.css' );

	wp_enqueue_style( 'mobile'  );

	

	// Load theme skin

	if( genesis_get_option( 'zp_theme_skin',  ZP_SETTINGS_FIELD ) != '' ){

		$skin = genesis_get_option( 'zp_theme_skin',  ZP_SETTINGS_FIELD );

		wp_enqueue_style( 'zp_theme_skin', get_stylesheet_directory_uri( ).'/css/'.$skin.'.css' );

	}

	

	// Load color scheme css

	if( genesis_get_option( 'zp_color_scheme',  ZP_SETTINGS_FIELD ) != '' ){

		$color = genesis_get_option( 'zp_color_scheme',  ZP_SETTINGS_FIELD );

		wp_enqueue_style( 'color_scheme', get_stylesheet_directory_uri( ).'/css/color/'.$color.'.css' );

	}

}



/**

 * Add Body class on Dark Skin

 */

add_filter('body_class', 'zp_dark_skin_bodyclass');

function zp_dark_skin_bodyclass( $classes ) {

	if( genesis_get_option( 'zp_theme_skin',  ZP_SETTINGS_FIELD ) == 'dark'  ){

		$classes[] = 'zp_dark_skin';

	}

	return $classes;

}



/**

 * Add custom.css file after all other css including plugin CSS

 */

add_action( 'wp_enqueue_scripts', 'zp_custom_css' , 50 );

function zp_custom_css(){

	wp_enqueue_style( 'custom', get_stylesheet_directory_uri( ).'/custom.css' );

}



// Theme Scripts

add_action( 'wp_enqueue_scripts', 'zp_theme_js' );

function zp_theme_js( ) {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'bootstrap.min', get_stylesheet_directory_uri().'/js/bootstrap.min.js','', '3.0', true );

	wp_enqueue_script( 'jquery.fitvids', get_stylesheet_directory_uri() . '/js/jquery.fitvids.js','','1.0.3', true );

	wp_enqueue_script( 'jquery_jplayer', get_stylesheet_directory_uri() . '/js/jquery.jplayer.min.js','','2.5.0' );

	wp_enqueue_script( 'jquery_scrollTo_js', get_stylesheet_directory_uri() . '/js/jquery.ScrollTo.min.js','','1.4.3.1', true );

	wp_enqueue_script( 'jquery.isotope.min', get_stylesheet_directory_uri().'/js/jquery.isotope.min.js', '', '1.5.25', true  );

	wp_enqueue_script( 'prettyPhoto', get_stylesheet_directory_uri().'/js/jquery.prettyPhoto.js', '', '', true  );

	wp_register_script('zp_imageloaded', get_stylesheet_directory_uri() . '/js/imagesloaded.min.js',array( 'jquery' , 'jquery.isotope.min' ),'3.1.8', true );

	wp_enqueue_script('custom_js', get_stylesheet_directory_uri() . '/js/custom.js','','1.0', true );

	wp_register_script('zp_post_like', get_stylesheet_directory_uri() . '/js/zp_post_like.js','','1.0', true );

	wp_register_script('zp_post_load_more', get_stylesheet_directory_uri() . '/js/zp_post_load_more.js','','1.0', true );	

}



// Register Widget Area

genesis_register_sidebar( array(

	'id'			=> 'bottom-widget',

	'name'			=> __( 'Bottom Widget', 'drone' ),

	'description'	=> __( 'This is the bottom widget area.', 'drone' ),

));



genesis_register_sidebar( array(

	'id'			=> 'portfolio-sidebar',

	'name'			=> __( 'Portfolio Sidebar', 'drone' ),

	'description'	=> __( 'This is the sidebar for the portfolio single page.', 'drone' ),

));



// Footer Credits

add_filter( 'genesis_footer_creds_text', 'zp_footer_creds_text' );

function zp_footer_creds_text(){

	

	$cred_text = '<div class="creds"><p>Copyright &copy; '.date('Y').' '.get_bloginfo( 'name' ).' '.get_bloginfo(  'description' ).'</p></div>';


	// main footer area

	echo '<div class="zp_footer_main col-md-12 col-sm-12">';

		if( genesis_get_option( 'zp_footer_text',  ZP_SETTINGS_FIELD ) ){

			echo '<div class="creds">'.genesis_get_option( 'zp_footer_text',  ZP_SETTINGS_FIELD ).'</div>';

		} else {

			echo $cred_text;

		}	
	
		if(is_active_sidebar('bottom-widget')){

			echo '<div class="bottom-widget">';

			dynamic_sidebar('bottom-widget');

			echo '</div>';

		}
	
	echo '</div>';

	/*
	// left footer area

	echo '<div class="zp_footer_left col-md-6 col-sm-12">';

	if( genesis_get_option( 'zp_footer_text',  ZP_SETTINGS_FIELD ) ){

		echo '<div class="creds">'.genesis_get_option( 'zp_footer_text',  ZP_SETTINGS_FIELD ).'</div>';

	}else{

		echo $cred_text;

	}	

	echo '</div>';

	// right footer area

	echo '<div class="zp_footer_right col-md-6 col-sm-12">';

	if(is_active_sidebar('bottom-widget')){

		echo '<div class="bottom-widget">';

			dynamic_sidebar('bottom-widget');

		echo '</div>';

	}

	echo '</div>';
	*/

}



// Enable shortcode in Text Widgets

add_filter( 'widget_text', 'do_shortcode' );



/* Remove Post Image in the entry Content */

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );



// Custom Favivon

add_filter( 'genesis_favicon_url', 'zp_favicon_url' );

function zp_favicon_url(  ) {	



	$favicon_link = genesis_get_option( 'zp_favicon', ZP_SETTINGS_FIELD );	

	

	if (  $favicon_link  ) {

		$favicon = $favicon_link;

		return $favicon;

	}else

	return false;

}



// Custom Logo

add_action(  'wp_head', 'zp_custom_logo'  );

function zp_custom_logo(  ) {

	if (  genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD )  ) { ?>

		<style type="text/css">

			.header-image .site-header .title-area {

				background-image: url( "<?php echo genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD ); ?>" );

				background-position: center center;

				background-repeat: no-repeat;

				height: <?php echo genesis_get_option( 'zp_logo_height', ZP_SETTINGS_FIELD );?>px;

				width: <?php echo genesis_get_option( 'zp_logo_width', ZP_SETTINGS_FIELD );?>px;

			}

			

			.header-image .title-area, .header-image .site-title, .header-image .site-title a{

				height: <?php echo genesis_get_option( 'zp_logo_height', ZP_SETTINGS_FIELD );?>px;

				width: <?php echo genesis_get_option( 'zp_logo_width', ZP_SETTINGS_FIELD );?>px;

			}

       </style>

	 <?php }

}



// Add mobile menu



add_action( 'genesis_header', 'zp_mobile_nav' );

function zp_mobile_nav(){

	$output = '';	

	$output .=  '<div class="mobile_menu navbar-default" role="navigation"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';

	$output .= '<span class="sr-only">Toggle navigation</span>';

	$output .= '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';

	$output .= '</button></div>';

	

	echo $output;

}



// Modify Read More Text



add_filter(  'excerpt_more', 'zp_read_more_link'  );

add_filter(  'get_the_content_more_link', 'zp_read_more_link'  );

add_filter( 'the_content_more_link', 'zp_read_more_link' );

function zp_read_more_link(  ) {

    return '&hellip; <p><a class="btn btn-default" href="' . get_permalink(  ) . '"> '.__( 'Read More ','drone' ).'</a></p>';

}



// Modify Post Info and Add Post format icons

add_filter( 'genesis_post_info', 'zp_custom_post_info' );

function zp_custom_post_info(){

	return '[post_date] ' . __( 'by', 'drone' ) . ' [post_author_posts_link] [post_comments] [zp_post_like]';	

}



//Reposition Post Info

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

add_action( 'genesis_entry_header', 'genesis_post_info', 9 );



// Modify Post Meta



add_filter( 'genesis_post_meta','zp_custom_post_meta' );

function zp_custom_post_meta(){

	return '[post_categories before="" after="" sep=","] [post_tags before="" after="" sep=","]';	

}



// Add Post Format Icon on entry-header

add_action( 'genesis_entry_header', 'zp_post_format_icon', 9 );

function zp_post_format_icon(){

	global $post;

	

	if( is_page() )

		return;

			

	$format = get_post_format();	

	switch( $format ){

		case 'gallery': $post_format_icon = '<i class="fa fa-picture-o "></i>'; break;

		case 'video': $post_format_icon = '<i class="fa fa-film"></i>'; break;

		case 'audio': $post_format_icon = '<i class="fa fa-music"></i>'; break;

		case 'image': $post_format_icon = '<i class="fa fa-image "></i>'; break;

		case 'link': $post_format_icon = '<i class="fa fa-link "></i>'; break;

		case 'quote': $post_format_icon = '<i class="fa fa-quote "></i>'; break;

		default: $post_format_icon = '<i class="fa fa-thumb-tack"></i>'; break;

	}	

	echo $post_format_icon;

}



// Add Contact Form 7 shortcode support

add_filter( 'wpcf7_form_elements', 'zp_wpcf7_form_elements' );

function zp_wpcf7_form_elements( $form ) {

	$form = do_shortcode( $form );

	return $form;

}



// Reposition Breadcrumbs

remove_action(  'genesis_before_loop', 'genesis_do_breadcrumbs'  );

add_action(  'genesis_before_content', 'genesis_do_breadcrumbs'  );



// Change breadcrumb separator

add_filter( 'genesis_breadcrumb_args', 'zp_breadcrumb_separator' );

function zp_breadcrumb_separator( $args ){

	

	$args['sep'] = ' <i class="fa fa-angle-right"></i> ';	

	if( is_page_template( 'portfolio_template.php' ) ){

		$args['prefix'] = sprintf( '<div class="container"><div %s>', genesis_attr( 'breadcrumb' ) );

		$args['suffix'] = '</div></div>';	

	}else{

		$args['prefix'] = sprintf( '<div %s>', genesis_attr( 'breadcrumb' ) );

		$args['suffix'] = '</div>';	

	}	

	return $args;	

}



// Change Portfolio Archive Settings Page Label

add_filter( 'genesis_cpt_archive_settings_page_label', 'zp_portfolio_archive_settings_page_label' );

function zp_portfolio_archive_settings_page_label(){

	return __( 'Portfolio Archive Settings', 'drone' );

}



//Change Portfolio Archive Settings Menu Label

add_filter( 'genesis_cpt_archive_settings_menu_label', 'zp_portfolio_archive_settings_menu_label' );

function zp_portfolio_archive_settings_menu_label(){

	return __( 'Portfolio Archive Settings', 'drone' );	

}



// To Top Link

add_action( 'genesis_before_footer','zp_add_top_link' );

function zp_add_top_link(  ){

	echo '<a href="#top" id="top-link"><i class="fa fa-angle-up"></i></a>';

}


//* single line comment
// 	single line comment
# 	single line comment

/*
multi
line
comment
*/

// Add Image sizes 

#add_image_size( 'blog_gallery', 790, 450, true );

#add_image_size( 'col2' , 540 );

add_image_size( 'col3', 350 ); // keep it

#add_image_size( 'col4' , 255 );

#add_image_size( 'related_col2' , 555 );

#add_image_size( 'related_col3', 360 );

#add_image_size( 'related_col4' , 262 );

#add_image_size( 'related_post', 217, 217, true );



// Include Custom Theme Function

require_once (  get_stylesheet_directory(  ) . '/custom_functions.php' );


// Show homepage hero image

add_action( 'genesis_after_header', 'show_homepage_hero_image' );
function show_homepage_hero_image() {
	if ( is_front_page() ) {
		$upload_dir = wp_upload_dir();
		echo '<img src="' . $upload_dir['url'] . '/ME.r2.jpg">';
	}
}

@ini_set( 'upload_max_size' , '32M' );
@ini_set( 'post_max_size', '32M');
@ini_set( 'max_execution_time', '300' );