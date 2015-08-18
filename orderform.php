<?php
/**
 * Template Name: Order Form
 *
 * @author Mike Hemberger
 * @link http://thestizmedia.com/front-end-posting-with-acf-pro/
 * @uses Advanced Custom Fields Pro
 */
/**
 * Add required acf_form_head() function to head of page
 * @uses Advanced Custom Fields Pro
 */
 
 //Dashboard Nav
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );


add_action( 'get_header', 'tsm_do_acf_form_head', 1 );
function tsm_do_acf_form_head() {
	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}
	acf_form_head();
}
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
/**
 * Add ACF form for front end posting
 * @uses Advanced Custom Fields Pro
 */
add_action( 'genesis_entry_content', 'tsm_do_create_post_form' );
function tsm_do_create_post_form() {
	// Bail if not logged in or able to post
	if ( ! ( is_user_logged_in()|| current_user_can('publish_posts') ) ) {
		echo '<p>You must be a registered author to post.</p>';
		return;
	}
	$new_post = array(
		'post_id'            => 'new', // Create a new post
		// PUT IN YOUR OWN FIELD GROUP ID(s)
		'field_groups'       => array(7,9), // Create post field group ID(s)
		'form'               => true,
		//'return'             => 'success-page', // Redirect to new post url
		'html_before_fields' => '',
		'html_after_fields'  => '',
		'submit_value'       => 'Place Order',
		'updated_message'    => 'Saved!'
	);
	acf_form( $new_post );
}
/**
 * Back-end creation of new candidate post
 * @uses Advanced Custom Fields Pro
 */
add_filter('acf/pre_save_post' , 'tsm_do_pre_save_post' );
function tsm_do_pre_save_post( $post_id ) {
	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}
	// check if this is to be a new post
	if( $post_id != 'new' ) {
		return $post_id;
	}
	// Create a new post
	$post = array(
		'post_type'     => 'customorder', // Your post type ( post, page, custom post type )
		'post_status'   => 'publish', // (publish, draft, private, etc.)
		'post_title'    => wp_strip_all_tags($_POST['acf']['field_55ce7eba32cd2']), // Post Title ACF field key
		//'post_content'  => $_POST['acf']['field_54dfc94e35ec5'], // Post Content ACF field key
	);
	// insert the post
	$post_id = wp_insert_post( $post );
	// Save the fields to the post
	do_action( 'acf/save_post' , $post_id );
	return $post_id;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's key
//* Run the Genesis loop
genesis();