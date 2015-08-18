<?php

/** Genesis - Remove edit link */
add_filter( 'genesis_edit_post_link' , '__return_false' );

//Dashboard Nav
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );


/**
 * Deregister the admin styles outputted when using acf_form
 */
add_action( 'wp_print_styles', 'tsm_deregister_admin_styles', 999 );
function tsm_deregister_admin_styles() {
	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}
	wp_deregister_style( 'wp-admin' );
}

add_action( 'get_header', 'do_acf_form_head', 1 );
function do_acf_form_head() {
	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('edit_posts') ) ) {
		return;
	}
	acf_form_head();
}

add_action('genesis_entry_content', 'do_edit');
function do_edit(){
    
 acf_form();
}



/*add_action('genesis_entry_content', 'orderfields');

function orderfields(){

	if ( get_field( 'product' ) ) {
		echo '<p><strong> Product: </strong>' . get_field( 'product' )  . '</p>';
	} 
    
    
}*/

genesis();
?>