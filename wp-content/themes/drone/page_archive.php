<?php

//* Template Name: Archive

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'zp_custom_archive_template' );
add_action( 'genesis_post_content', 'zp_custom_archive_template' );

function zp_custom_archive_template() { ?>
	<div class="col-md-6 col-sm-6 col-xs-12">
        <h4><?php _e( 'Pages:', 'drone' ); ?></h4>
        <ul>
            <?php wp_list_pages( 'title_li=' ); ?>
        </ul>
    
        <h4><?php _e( 'Categories:', 'drone' ); ?></h4>
        <ul>
            <?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
        </ul>
    </div>
	<div class="col-md-6 col-sm-6 col-xs-12">
        <h4><?php _e( 'Authors:', 'drone' ); ?></h4>
        <ul>
            <?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>
        </ul>
    
        <h4><?php _e( 'Monthly:', 'drone' ); ?></h4>
        <ul>
            <?php wp_get_archives( 'type=monthly' ); ?>
        </ul>
    
        <h4><?php _e( 'Recent Posts:', 'drone' ); ?></h4>
        <ul>
            <?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
        </ul>
    </div>

<?php
}

genesis();
