<?php
/*------------------------------ 
Template Name: Home
------------------------------*/ 

// Add template body class
add_filter( 'body_class', 'zp_homepage_template_bodyclass' );
function zp_homepage_template_bodyclass( $classes ){
	$classes[] = 'zp_layout_template';	
	return $classes;	
}

// Remove Breadcrumbs
remove_action(  'genesis_before_content', 'genesis_do_breadcrumbs'  );

// Force homepage to full width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Homepage Template Header
add_action( 'genesis_after_header', 'zp_homepage_header' );
function zp_homepage_header(){
	global $post;
	$subtitle = get_post_meta( $post->ID, 'subtitle', true );
	?>
    <div class="page_header zp_header_home_page" >
        <div class="container">
            <h1><?php echo get_the_title(); ?></h1>
           <?php if( $subtitle ){ ?> <p class="lead"><?php echo $subtitle;?></p><?php } ?>
         </div>
    </div>
    <?php

}

// Homepage Template custom loop
remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_layout_template' );
function zp_layout_template() {
	global $post;
	 while (  have_posts(  )  ) : the_post(  );
	?>
    <section class="layout_section"><div class="container"><?php echo do_shortcode( apply_filters( 'the_content', get_the_content() ) ); ?></div></section>
    <?php
	endwhile;
}
genesis();