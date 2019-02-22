<?php
/*
 * Template Name: Landing
 */

// Add custom body class to the head
add_filter( 'body_class', 'zp_landing_body_class' );
function zp_landing_body_class( $classes ) {
	$classes[] = 'zp-landing-page';
	return $classes;
}

// Remove Breadcrumbs
remove_action(  'genesis_before_content', 'genesis_do_breadcrumbs'  );

// Set landing page to full-width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * Remove Un-necessary areas
 */
remove_action( 'genesis_before_header', 'zp_top_widget_area' );
remove_action('genesis_before_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_before_content_sidebar_wrap', 'zp_breadcrumb_search_form' );
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'zzp_header_markup_open', 6 );
remove_action( 'genesis_header', 'zzp_header_markup_close', 14 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'zp_mobile_nav' );
remove_action( 'genesis_header', 'genesis_do_nav', 11 );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
remove_action( 'genesis_after_header', 'zp_page_header' );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
remove_action( 'genesis_footer', 'zzp_footer_markup_open', 6 );
remove_action( 'genesis_footer', 'zzp_footer_markup_close', 14 );

genesis();