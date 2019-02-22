<?php
/* Shortcode String Translations */

function zp_shortcode_label(){

$zp_shortcode_label  = array(
	// Acccordion 
	'accordion' => array(
		'menu' => __('Accordion','drone' ),
		'header_title' => __( 'Insert Accordion Shortcode','drone'),
		'content' => array()
	),
	// Team
	'team' => array(
		'menu' => __('Team','drone' ),
		'header_title' => __( 'Insert Team Shortcode','drone'),
		'content' => array(	)
	),
	// Blog 
	'blog' => array(
		'menu' => __('Blog','drone' ),
		'header_title' => __( 'Insert Blog Shortcode','drone'),
		'content' => array()
	),
	
	// Buttons 
	'buttons' => array(
		'menu' => __('Button','drone' ),
		'header_title' => __( 'Insert Button Shortcode','drone'),
		'content' => array(
			'type' => array(
				'label' => __( 'Type','drone' ),
				'tooltip' => __( 'Select type for buttons.','drone' ),
				'values' => array( 'btn-default', 'btn-primary', 'btn-success', 'btn-info','btn-warning','btn-danger','btn-inverse' )
			),
			'size' => array(
				'label' => __( 'Size','drone' ),
				'tooltip' => __( 'Select button size.','drone' ),
				'values' => array( 'Large', 'Medium', 'Small','Extra Small' )
			),
			'outline' => array(
				'label' => __( 'Outline Style','drone' ),
				'tooltip' => __( 'Select true if you want to have an outline button.','drone' ),
				'values' => array( 'True', 'False')
			),
			'button_link' => array(
				'label' => __( 'Button Link','drone' ),
				'tooltip' => __( 'Add button link.','drone' )
			),
			'button_label' => array(
				'label' => __( 'Button Name','drone' ),
				'tooltip' => __( 'Add button name.','drone' )
			),
			'button_target' => array(
				'label' => __( 'Link Target','drone' ),
				'tooltip' => __( 'Select button link target.','drone' ),
				'values' => array( '_blank', '_self', '_top', '_parent' )
			)
		)
	),
	// Portfolio 
	'portfolio' => array(
		'menu' => __('Portfolio','drone' ),
		'header_title' => __( 'Insert Portfolio Shortcode','drone'),
		'content' => array(
			'preselect_cat' => array(
				'label' => __( 'Pre-select Category','drone' ),
				'tooltip' => __( 'Category that will be loaded first in portfolio section. Leave empty to display all items.','drone' ),
			),
			'lightbox' => array(
				'label' => __( 'Enable Lightbox','drone' ),
				'tooltip' => __( 'Select true to enable portfolio lightbox, false to enable portfolio link.','drone' ),
				'values' => array( 'True', 'False')
			)
		)
	),
	// Testimonial 
	'testimonial' => array(
		'menu' => __('Testimonial','drone' ),
		'header_title' => __( 'Insert Testimonial Shortcode','drone'),
		'content' => array()
	),
	// Services 
	'services' => array(
		'menu' => __('Service','drone' ),
		'header_title' => __( 'Insert Service Shortcode','drone'),
		'content' => array()
	),
	// Progress Bar 
	'progress' => array(
		'menu' => __('Progress Bar','drone' ),
		'header_title' => __( 'Insert Progress Bar Shortcode','drone'),
		'content' => array()
	),
	// Columns 
	'columns' => array(
		'menu' => __('Columns','drone' ),
		'header_title' => __( 'Insert column Shortcode','drone'),
		'content' => array(	),
		'submenu' => array(
			'one_half' => __('One Half','drone' ),
			'one_third' => __('One Third','drone' ),
			'one_fourth' => __('One Fourth','drone' ),
			'column_grid_1' => __('Column Grid 1','drone' ),
			'column_grid_2' => __('Column Grid 2','drone' ),
			'column_grid_3' => __('Column Grid 3','drone' ),
			'column_grid_4' => __('Column Grid 4','drone' ),
			'column_grid_5' => __('Column Grid 5','drone' ),
			'column_grid_6' => __('Column Grid 6','drone' ),
			'column_grid_7' => __('Column Grid 7','drone' ),
			'column_grid_8' => __('Column Grid 8','drone' ),
			'column_grid_9' => __('Column Grid 9','drone' ),
			'column_grid_10' => __('Column Grid 10','drone' ),
			'column_grid_11' => __('Column Grid 11','drone' ),
			'column_grid_12' => __('Column Grid 12','drone' ),
		)

	),
	// Tabs 
	'tab' => array(
		'menu' => __('Tab','drone' ),
		'header_title' => __( 'Insert Tab Shortcode','drone'),
		'content' => array(
			'id1' => array(
				'label' => __( 'First Tab ID','drone' ),
				'tooltip' => __( 'Add first tab ID. This must be unique and one word only.','drone' )
			),
			'title1' => array(
				'label' => __( 'First Tab Title','drone' ),
				'tooltip' => __( 'Add first tab title.','drone' )
			),
			'content1' => array(
				'label' => __( 'First Tab Content','drone' ),
				'tooltip' => __( 'Add first tab content.','drone' )
			),
			'id2' => array(
				'label' => __( 'Second Tab ID','drone' ),
				'tooltip' => __( 'Add second tab ID. This must be unique and one word only.','drone' )
			),
			'title2' => array(
				'label' => __( 'Second Tab Title','drone' ),
				'tooltip' => __( 'Add second tab title.','drone' )
			),
			'content2' => array(
				'label' => __( 'Second Tab Content','drone' ),
				'tooltip' => __( 'Add second tab content.','drone' )
			),
			'id3' => array(
				'label' => __( 'Third Tab ID','drone' ),
				'tooltip' => __( 'Add third tab ID. This must be unique and one word only.','drone' )
			),
			'title3' => array(
				'label' => __( 'Third Tab Title','drone' ),
				'tooltip' => __( 'Add third tab title.','drone' )
			),
			'content3' => array(
				'label' => __( 'Third Tab Content','drone' ),
				'tooltip' => __( 'Add third tab content.','drone' )
			),
			
		)
	),
	// Client Carousel
	'client_carousel' => array(
		'menu' => __('Client Carousel','drone' ),
		'header_title' => __( 'Insert Client Carousel Shortcode','drone'),
		'content' => array(
			'name' => array(
				'label' => __( 'Add Carousel Name','drone' ),
				'tooltip' => __( 'This serves as carousel ID. It must be unique and avoid using spaces. Ex. "client_carousel".','drone' )
			)			
		)
	),
	// Slider
	'slider' => array(
		'menu' => __('Slider','drone' ),
		'header_title' => __( 'Insert Slider Shortcode','drone'),
		'content' => array(	)
	)
);

return $zp_shortcode_label;
}