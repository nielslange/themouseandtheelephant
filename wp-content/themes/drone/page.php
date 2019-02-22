<?php
/**
 * ZP Custom Page 
 */

//* Add full width banner image
add_action('genesis_before_content_sidebar_wrap', 'show_portfolio_banner');
function show_portfolio_banner() {
	if ( get_field('banner') ) {
		printf('<img src="%s" alt="%s" class="portfolio-banner" style="width:100%%">', get_field('banner'), get_the_title());
	}
}

genesis();