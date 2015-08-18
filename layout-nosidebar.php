<?php

//* Add custom body class to the head
add_filter( 'body_class', 'sp_body_class' );
function sp_body_class( $classes ) {
	
	$classes[] = 'no-sidebar';
	return $classes;
	
}

unregister_sidebar( 'sidebar' );
//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );
/**
 * Custom Loop for Archive Layout
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-genesis-custom-layout/
 */
function be_no_sidebar() {
	$site_layout = genesis_site_layout();
	if ( 'no-sidebar' == $site_layout ) {
		be_no_sidebar();
	} else {
	genesis_standard_loop();
	}
}
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'be_no_sidebar');