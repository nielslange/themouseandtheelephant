<?php 

/*------------------------------
	Portfolio Taxonomy Template
------------------------------*/

// Force homepage to full width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove Breadcrumbs
remove_action(  'genesis_before_content', 'genesis_do_breadcrumbs'  );

// custom loop
remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_portfolio_taxonomy_template' );
function zp_portfolio_taxonomy_template() {
	
	//Get Portfolio Category	
	$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
	
	// Get setting values
	$items = genesis_get_option( 'zp_portfolio_category_items', ZP_SETTINGS_FIELD );
	$columns = genesis_get_option( 'zp_portfolio_category_columns', ZP_SETTINGS_FIELD );
	$filter = genesis_get_option( 'zp_portfolio_category_filter', ZP_SETTINGS_FIELD );
	$loadmore = genesis_get_option( 'zp_portfolio_category_loadmore', ZP_SETTINGS_FIELD );
	
	$filter = ( $filter )? true : false;
	$loadmore = ( $loadmore )? true : false;
	
	echo '<section class="layout_section portfolio_category_layout"><div class="container">';
	echo zp_portfolio_output( $items, $columns ,$filter , $term->slug , $loadmore );
	echo '</div></section>';
}
genesis();