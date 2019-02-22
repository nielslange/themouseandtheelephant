<?php
/*
 Plugin Name: SuperCPT
 Plugin URI: http://wordpress.org/extend/plugins/super-cpt/
 Description: Insanely easy and attractive custom post types, custom post meta, and custom taxonomies
 Version: 0.1.3
 Author: Matthew Boynes, Union Street Media
 
 Copyright 2011-2012 Shared and distributed between Matthew Boynes and Union Street Media
 GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software 
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 
 */
 
 require_once get_stylesheet_directory() . '/include/cpt/class/scpt-helpers.php';
 require_once get_stylesheet_directory() . '/include/cpt/class/class-scpt-markup.php';
 require_once get_stylesheet_directory() . '/include/cpt/class/class-super-custom-post-meta.php';
 require_once get_stylesheet_directory() . '/include/cpt/class/class-super-custom-post-type.php';
 require_once get_stylesheet_directory() . '/include/cpt/class/class-super-custom-taxonomy.php';
 
 class Super_CPT {
	 
	 /**
	 * Initialize the plugin and call the appropriate hook method
	 *
	 * @uses admin_hooks
	 * @author Matthew Boynes
	 */
	
	function __construct() {
		
		if ( is_admin() )
			add_action( 'init', array( &$this, 'admin_hooks' ) );
		}
		
	/**
	 * Setup appropriate hooks for wp-admin
	 *
	 * @uses SCPT_Admin
	 * @return void
	 * @author Matthew Boynes
	 */
	 
	 function admin_hooks() {
		 add_action( 'admin_enqueue_scripts', array( &$this, 'load_js_and_css' ) );
	 }
	 
	 /**
	 * Add supercpt.css to the doc head
	 *
	 * @return void
	 * @author Matthew Boynes
	 */
	 
	 function load_js_and_css() {
		 wp_register_style( 'supercpt.css', get_stylesheet_directory_uri() . '/include/cpt/css/supercpt.css', array(), '1.3' );
		 wp_register_script( 'supercpt.js', get_stylesheet_directory_uri() . '/include/cpt/js/supercpt.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), '1.1' );
		 wp_enqueue_style( 'supercpt.css' );
		 wp_register_style( 'colorpicker_css', get_stylesheet_directory_uri() . '/include/cpt/js/colorpicker/css/colorpicker.css', array(), '1.3' );
		 wp_enqueue_style( 'colorpicker_css' );
		 wp_register_script( 'colorpicker_js', get_stylesheet_directory_uri() . '/include/cpt/js/colorpicker/js/colorpicker.js', false, '1.0', false );
		 wp_register_script( 'zp_colorpicker_script', get_stylesheet_directory_uri() . '/include/cpt/js/colorpicker/color_picker.js', false, '1.0', false );
		 wp_enqueue_script( 'colorpicker_js' );
		 wp_enqueue_script( 'zp_colorpicker_script' );
		 wp_register_script( 'post_format', get_stylesheet_directory_uri() . '/include/cpt/js/post_format.js', array( 'jquery' ), '1.0' );
		 wp_enqueue_script('post_format');
	}
}
$scpt_plugin = new Super_CPT;
do_action( 'supercpt_loaded' );