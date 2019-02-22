<?php
/**-------------------------------------------------------------------
 * Theme Settings
 --------------------------------------------------------------------*/
 
define( 'ZP_SETTINGS_FIELD', 'zp-settings' );


/**
* zpsettings_default_theme_options function.
*/
function zpsettings_default_theme_options() {
	$options = array(
		'zp_logo' => '',
		'zp_logo_height' => 64,
		'zp_logo_width' => 180,
		'zp_footer_text' 	=> '',
		'zp_enable_related' => 1,
		'zp_related_items' => '3',
		'zp_related_columns' => '3',
		'zp_portfolio_archive_items' => '8',
		'zp_portfolio_archive_columns' => '3',
		'zp_portfolio_archive_filter' => true,
		'zp_portfolio_archive_loadmore' => true,
		'zp_portfolio_category_items' => '8',
		'zp_portfolio_category_columns' => '3',
		'zp_portfolio_category_loadmore' => true,
		'zp_related_post'=> '1',
		'zp_related_post_title' => 'Related Posts',
		'zp_related_post_items'=>'4',
		'zp_theme_skin' => ''
	);
	
	return apply_filters( 'zpsettings_default_theme_options', $options );
}


/**
* zpsettings_sanitize_inputs function.
*/ 
add_action( 'genesis_settings_sanitizer_init', 'zpsettings_sanitize_inputs' );

function zpsettings_sanitize_inputs() {
    genesis_add_option_filter( 'one_zero',
		ZP_SETTINGS_FIELD,
			array(
				'zp_enable_related',
				'zp_portfolio_category_loadmore',
				'zp_portfolio_archive_filter',
				'zp_portfolio_archive_loadmore',
				'zp_related_post'
			)
		);

	genesis_add_option_filter( 'no_html',
		ZP_SETTINGS_FIELD,
			array(
				'zp_logo_height',
				'zp_logo',
				'zp_related_title',
				'zp_related_items',
				'zp_portfolio_archive_items',
				'zp_portfolio_category_items',
				'zp_related_post_title',
				'zp_related_post_items'
			)
		);
		
	genesis_add_option_filter( 'requires_unfiltered_html',
		ZP_SETTINGS_FIELD,
			array(
				'zp_footer_text',
			)
		);
}


/**
* zpsettings_register_settings function.
*/
add_action( 'admin_init', 'zpsettings_register_settings' );

function zpsettings_register_settings() {
	register_setting( ZP_SETTINGS_FIELD, ZP_SETTINGS_FIELD );
	
	add_option( ZP_SETTINGS_FIELD, zpsettings_default_theme_options() );
	
	if ( genesis_get_option( 'reset', ZP_SETTINGS_FIELD ) ) {
		update_option( ZP_SETTINGS_FIELD, zpsettings_default_theme_options() );
		genesis_admin_redirect( ZP_SETTINGS_FIELD, array( 'reset' => 'true' ) );
		exit;
	}
}

/**
* zpsettings_theme_settings_notice function.
*/
add_action( 'admin_notices', 'zpsettings_theme_settings_notice' );

function zpsettings_theme_settings_notice() {
	if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] != ZP_SETTINGS_FIELD )
		return;
	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings reset.', 'drone' ) . '</strong></p></div>';
	elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings saved.', 'drone' ) . '</strong></p></div>';
}

/**
* zpsettings_theme_options function.
*/
add_action( 'admin_menu', 'zpsettings_theme_options' );

function zpsettings_theme_options() {
	global $_zpsettings_settings_pagehook;
	
	$_zpsettings_settings_pagehook = add_submenu_page( 'genesis', 'Drone Settings', 'Drone Settings', 'edit_theme_options', ZP_SETTINGS_FIELD, 'zpsettings_theme_options_page' );
	
	//add_action( 'load-'.$_zpsettings_settings_pagehook, 'zpsettings_settings_styles' );
	add_action( 'load-'.$_zpsettings_settings_pagehook, 'zpsettings_settings_scripts' );
	add_action( 'load-'.$_zpsettings_settings_pagehook, 'zpsettings_settings_boxes' );
}


/**
* zpsettings_settings_scripts function.
* This function enqueues the scripts needed for the ZP Settings settings page.
*/

function zpsettings_settings_scripts() {
	global $_zpsettings_settings_pagehook, $post;
	
	if( is_admin() ){
		
		
		wp_register_script( 'zp_image_upload', get_stylesheet_directory_uri() .'/include/upload/image-upload.js', array('jquery','media-upload','thickbox') );
		wp_enqueue_script('jquery');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		
		wp_enqueue_media( array( 'post' => $post ) );
		wp_enqueue_script('zp_image_upload');		
	}
}


/**
* zpsettings_settings_boxes function.
*
* This function sets up the metaboxes to be populated by their respective callback functions.
*
*/
function zpsettings_settings_boxes() {
	global $_zpsettings_settings_pagehook;
	
	add_meta_box( 'zpsettings_general_settings', __( 'General Settings', 'drone' ), 'zpsettings_general_settings', $_zpsettings_settings_pagehook, 'main' ,'high');
	add_meta_box( 'zpsettings_related_portfolio_settings', __( 'Related Portfolio Settings', 'drone' ), 'zpsettings_related_portfolio_settings', $_zpsettings_settings_pagehook, 'main','high' );
	add_meta_box( 'zpsettings_portfolio_archive_settings', __( 'Portfolio Archive Settings', 'drone' ), 'zpsettings_portfolio_archive_settings', $_zpsettings_settings_pagehook, 'main','high' );
	add_meta_box( 'zpsettings_portfolio_category_settings', __( 'Portfolio Category Settings', 'drone' ), 'zpsettings_portfolio_category_settings', $_zpsettings_settings_pagehook, 'main','high' );
	add_meta_box( 'zpsettings_related_post_settings', __( 'Related Posts Settings', 'drone' ), 'zpsettings_related_post_settings', $_zpsettings_settings_pagehook, 'main','high' );
	add_meta_box( 'zpsettings_footer_settings', __( 'Footer Settings', 'drone' ), 'zpsettings_footer_settings', $_zpsettings_settings_pagehook, 'main','high' );
}

/**
* zpsettings_home_settings function.
*
* Callback function for the ZP Settings Social Sharing metabox.
*
*/

function zpsettings_general_settings() { ?>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_theme_skin]"><?php _e( 'Select Theme Skin:','drone' );?></label>
    <select id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_theme_skin]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_theme_skin]">
    <option  value="" <?php selected( genesis_get_option( 'zp_theme_skin', ZP_SETTINGS_FIELD ), '' ); ?>>Default</option>
    <option  value="dark" <?php selected( genesis_get_option( 'zp_theme_skin', ZP_SETTINGS_FIELD ), 'dark' ); ?>>Dark</option>
    </select></p> 

	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_color_scheme]"><?php _e( 'Select color scheme:','drone' );?></label>
    <select id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_color_scheme]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_color_scheme]">
    <option  value="" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), '' ); ?>>Default</option>
    <option  value="grey" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'grey' ); ?>>Grey</option>
    <option  value="blue" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'blue' ); ?>>Blue</option>
    <option  value="brown" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'brown' ); ?>>Brown</option>
    <option  value="caramel" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'caramel' ); ?>>Caramel</option>
    <option  value="green" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'green' ); ?>>Green</option>
    <option  value="light_blue" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'light_blue' ); ?>>Light Blue</option>
    <option  value="light_red" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'light_red' ); ?>>Light Red</option>
    <option  value="pink" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'pink' ); ?>>Pink</option>
    <option  value="purple" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'purple' ); ?>>Purple</option>
    <option  value="red" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'red' ); ?>>Red</option>
    <option  value="yellow" <?php selected( genesis_get_option( 'zp_color_scheme', ZP_SETTINGS_FIELD ), 'yellow' ); ?>>Yellow</option>
    </select></p>  

    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo]"><?php _e( 'Upload Custom Logo.', 'drone' ); ?></label>
    <input type="text" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo]" value="<?php echo  genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD ); ?>" />    
    <input id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Logo', 'drone' ); ?>" /> 
	<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Logo', 'drone' ); ?>" /> 
    <span class="upload_preview" style="display: block;">
		<img style="max-width:100%;" src="<?php echo genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD ); ?>" />
	</span>
    </p>

    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_width]"><?php _e( 'Custom Logo Width in pixel. e.g. 200', 'drone' ); ?></label>

	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_logo_width', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_width]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_width]">

	</p> 
    
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_height]"><?php _e( 'Custom Logo Height in pixel. e.g. 200', 'drone' ); ?></label>

	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_logo_height', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_height]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_height]">

	</p>       

    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_favicon]"><?php _e( 'Upload Custom Favicon.', 'drone' ); ?></label>  

    <input type="text" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_favicon]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_favicon]" value="<?php echo  genesis_get_option( 'zp_favicon', ZP_SETTINGS_FIELD ); ?>" />

    <input id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_favicon_upload_button]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_favicon_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Favicon', 'drone' ); ?>" />
    <input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Favicon', 'drone' ); ?>" /> 
    <span class="upload_preview" style="display: block;">
		<img style="max-width:100%;" src="<?php echo genesis_get_option( 'zp_favicon', ZP_SETTINGS_FIELD ); ?>" />
	</span>
    </p>
	<p><span class="description"><?php _e( 'This is the general settings.','drone' ); ?></span></p>    

<?php }


function zpsettings_related_portfolio_settings() { ?>
	 <p><input type="checkbox" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_enable_related]" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_enable_related]" value="1" <?php checked( 1, genesis_get_option( 'zp_enable_related', ZP_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_enable_related]"><?php _e( 'Check to enable related portfolio.', 'drone' ); ?></label>  </p>
     <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_items]"><?php _e( 'Related Portfolio items', 'drone' ); ?></label><input type="text" size="30" value="<?php echo genesis_get_option( 'zp_related_items', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_items]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_items]"></p>
     <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_columns]"><?php _e( 'Select related portfolio columns:','drone' );?></label>
    <select id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_columns]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_columns]">
    <option  value="2" <?php selected( genesis_get_option( 'zp_related_columns', ZP_SETTINGS_FIELD ), '2' ); ?>>Two</option>
    <option  value="3" <?php selected( genesis_get_option( 'zp_related_columns', ZP_SETTINGS_FIELD ), '3' ); ?>>Three</option>
    <option  value="4" <?php selected( genesis_get_option( 'zp_related_columns', ZP_SETTINGS_FIELD ), '4' ); ?>>Four</option>
    </select></p>
	<p><span class="description"><?php _e( 'This settings is for related portfolio.','drone' ); ?></span></p>
<?php }

function zpsettings_portfolio_archive_settings() { ?>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_items]"><?php _e( 'Portfolio archive items', 'drone' ); ?></label><input type="text" size="30" value="<?php echo genesis_get_option( 'zp_portfolio_archive_items', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_items]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_items]"></p>
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_columns]"><?php _e( 'Select portfolio archive columns:','drone' );?></label>
    <select id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_columns]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_columns]">
    <option  value="2" <?php selected( genesis_get_option( 'zp_portfolio_archive_columns', ZP_SETTINGS_FIELD ), '2' ); ?>>Two</option>
    <option  value="3" <?php selected( genesis_get_option( 'zp_portfolio_archive_columns', ZP_SETTINGS_FIELD ), '3' ); ?>>Three</option>
    <option  value="4" <?php selected( genesis_get_option( 'zp_portfolio_archive_columns', ZP_SETTINGS_FIELD ), '4' ); ?>>Four</option>
    </select></p>
    <p><input type="checkbox" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_filter]" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_filter]" value="1" <?php checked( 1, genesis_get_option( 'zp_portfolio_archive_filter', ZP_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_filter]"><?php _e( 'Check to enable portfolio archive filter.', 'drone' ); ?></label>  </p>
    <p><input type="checkbox" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_loadmore]" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_loadmore]" value="1" <?php checked( 1, genesis_get_option( 'zp_portfolio_archive_loadmore', ZP_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_loadmore]"><?php _e( 'Check to enable portfolio archive load more.', 'drone' ); ?></label>  </p>     
	<p><span class="description"><?php _e( 'This settings is for portfolio archive.','drone' ); ?></span></p>
<?php }

function zpsettings_portfolio_category_settings() { ?>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_items]"><?php _e( 'Portfolio archive items', 'drone' ); ?></label><input type="text" size="30" value="<?php echo genesis_get_option( 'zp_portfolio_category_items', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_items]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_items]"></p>
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_columns]"><?php _e( 'Select portfolio archive columns:','drone' );?></label>
    <select id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_columns]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_columns]">
    <option  value="2" <?php selected( genesis_get_option( 'zp_portfolio_category_columns', ZP_SETTINGS_FIELD ), '2' ); ?>>Two</option>
    <option  value="3" <?php selected( genesis_get_option( 'zp_portfolio_category_columns', ZP_SETTINGS_FIELD ), '3' ); ?>>Three</option>
    <option  value="4" <?php selected( genesis_get_option( 'zp_portfolio_category_columns', ZP_SETTINGS_FIELD ), '4' ); ?>>Four</option>
    </select></p>
    <p><input type="checkbox" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_loadmore]" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_loadmore]" value="1" <?php checked( 1, genesis_get_option( 'zp_portfolio_category_loadmore', ZP_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_category_loadmore]"><?php _e( 'Check to enable portfolio archive load more.', 'drone' ); ?></label>  </p>     
	<p><span class="description"><?php _e( 'This settings is for portfolio category.','drone' ); ?></span></p>
<?php }

function zpsettings_related_post_settings() { ?>
	<p><input type="checkbox" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_post]" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_post]" value="1" <?php checked( 1, genesis_get_option( 'zp_related_post', ZP_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_post]"><?php _e( 'Check to enable related posts.', 'drone' ); ?></label>    </p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_post_title]"><?php _e( 'Related Posts Title', 'drone' ); ?></label><input type="text" size="30" value="<?php echo genesis_get_option( 'zp_related_post_title', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_post_title]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_related_post_title]"></p> 
	<p><span class="description"><?php _e( 'This settings is for related posts.','drone' ); ?></span></p>
<?php }


function zpsettings_footer_settings() { ?>

	 <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_footer_text]"><?php _e( 'Footer Text', 'drone' ); ?><br><textarea rows="3"  id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_footer_text]" class="widefat"  name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_footer_text]"><?php echo genesis_get_option( 'zp_footer_text', ZP_SETTINGS_FIELD ); ?></textarea>

	<br><small><strong><?php _e( 'Enter your site copyright here.', 'drone' ); ?></strong></small>
	</label>
	</p>
<?php }


/* Replace the 'Insert into Post Button inside Thickbox'
------------------------------------------------------------ */
function zp_replace_thickbox_text($translated_text, $text ) {	

	if ( 'Insert into Post' == $text ) {

		$referer = strpos( wp_get_referer(), ZP_SETTINGS_FIELD );

		if ( $referer != '' ) {

			return __('Insert Image!', 'drone' );

		}

	}
	return $translated_text;

}
/* Hook to filter Insert into Post Button in thickbox
------------------------------------------------------------ */

function zp_change_insert_button_text() {

		add_filter( 'gettext', 'zp_replace_thickbox_text' , 1, 2 );

}

add_action( 'admin_init', 'zp_change_insert_button_text' );


/**
 * zpsettings_settings_layout_columns function.
 *
 * This function sets the column layout to one for the ZP Settings settings page.
 *
 */
add_filter( 'screen_layout_columns', 'zpsettings_settings_layout_columns', 10, 2 );

function zpsettings_settings_layout_columns( $columns, $screen ) {
	global $_zpsettings_settings_pagehook;
	if ( $screen == $_zpsettings_settings_pagehook ) {
		$columns[$_zpsettings_settings_pagehook] = 2;
	}
	return $columns;
}


/**
 * zpsettings_theme_options_page function.
 *
 * This function displays the content for the ZP Settings settings page, builds the forms and outputs the metaboxes.
 *
 */

function zpsettings_theme_options_page() { 
	global $_zpsettings_settings_pagehook, $screen_layout_columns;
	
	$screen = get_current_screen();
	$width = "width: 100%;";
	$hide2 = $hide3 = " display: none;";
	?>	
	<div id="zpsettings" class="wrap genesis-metaboxes">
		<form method="post" action="options.php">
			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
			<?php settings_fields( ZP_SETTINGS_FIELD ); ?>
			<?php screen_icon( 'options-general' ); ?>
			<h2 style="width: 100%; margin-bottom: 10px;" ><?php _e( 'Drone Settings', 'drone' ); ?>
                <span style="float: right; text-align: center;"><input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Save Settings', 'drone' ) ?>" style="vertical-align: top;" />
                <input type="submit" class="button genesis-h2-button" name="<?php echo ZP_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'drone' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset?', 'drone' ) ); ?>');" /></span>
            </h2>
            
       		<div class="metabox-holder">
				<div class="postbox-container" style="<?php echo $width; ?>">
					<?php do_meta_boxes( $_zpsettings_settings_pagehook, 'main', null ); ?>
				</div>
			</div>
            <div class="bottom-buttons">
                <input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Save Settings', 'drone' ) ?>" />
                <input type="submit" class="button genesis-h2-button" name="<?php echo ZP_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'drone' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset?', 'drone' ) ); ?>');" />            
            </div>            
		</form>
     </div>

	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			// postboxes setup
			postboxes.add_postbox_toggles('<?php echo $_zpsettings_settings_pagehook; ?>');
		});
		//]]>
	</script>
<?php }