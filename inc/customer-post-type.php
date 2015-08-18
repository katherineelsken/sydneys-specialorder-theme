<?php
function customer_post_type() { 
	// creating (registering) the Order type 
	register_post_type( 'customer', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Customers', 'syndeysapp' ), /* This is the Title of the Group */
			'singular_name' => __( 'Customer', 'syndeysapp' ), /* This is the individual type */
			'all_items' => __( 'All Customers', 'syndeysapp' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'syndeysapp' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Customer', 'syndeysapp' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'syndeysapp' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Customers', 'syndeysapp' ), /* Edit Display Title */
			'new_item' => __( 'New Customer', 'syndeysapp' ), /* New Display Title */
			'view_item' => __( 'View Customer', 'syndeysapp' ), /* View Display Title */
			'search_items' => __( 'Search', 'syndeysapp' ), /* Search Order Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'syndeysapp' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'syndeysapp' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Order post type', 'syndeysapp' ), /* Order Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-groups', /* the icon for the Order post type menu */
			'rewrite'	=> array( 'slug' => 'customers', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'customers', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', )
		) /* end of options */
	); /* end of register post type */
	

	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'customer_post_type');
	
