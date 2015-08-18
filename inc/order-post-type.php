<?php
function custom_order_type() { 
	// creating (registering) the Order type 
	register_post_type( 'customorder', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Special Orders', 'syndeysapp' ), /* This is the Title of the Group */
			'singular_name' => __( 'Special orders', 'syndeysapp' ), /* This is the individual type */
			'all_items' => __( 'All Orders', 'syndeysapp' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'syndeysapp' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Order', 'syndeysapp' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'syndeysapp' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Orders', 'syndeysapp' ), /* Edit Display Title */
			'new_item' => __( 'New Order', 'syndeysapp' ), /* New Display Title */
			'view_item' => __( 'View Order', 'syndeysapp' ), /* View Display Title */
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
			'menu_icon' => 'dashicons-products', /* the icon for the Order post type menu */
			'rewrite'	=> array( 'slug' => 'customorder', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'customorder', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'comments')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your Order post type */
	register_taxonomy_for_object_type( 'category', 'customorder' );
	/* this adds your post tags to your Order post type */
	register_taxonomy_for_object_type( 'post_tag', 'customorder' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_order_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add Order categories (these act like categories)
	register_taxonomy( 'order_cat', 
		array('customorder'), /* if you change the name of register_post_type( 'customorder', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Order Categories', 'syndeysapp' ), /* name of the Order taxonomy */
				'singular_name' => __( 'Order Category', 'syndeysapp' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Order Categories', 'syndeysapp' ), /* search title for taxomony */
				'all_items' => __( 'All Order Categories', 'syndeysapp' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Order Category', 'syndeysapp' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Order Category:', 'syndeysapp' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Order Category', 'syndeysapp' ), /* edit Order taxonomy title */
				'update_item' => __( 'Update Order Category', 'syndeysapp' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Order Category', 'syndeysapp' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Order Category Name', 'syndeysapp' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'Order-slug' ),
		)
	);
	
	// now let's add Order tags (these act like categories)
	register_taxonomy( 'order_tag', 
		array('customorder'), /* if you change the name of register_post_type( 'customorder', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Order Tags', 'syndeysapp' ), /* name of the Order taxonomy */
				'singular_name' => __( 'Order Tag', 'syndeysapp' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Order Tags', 'syndeysapp' ), /* search title for taxomony */
				'all_items' => __( 'All Order Tags', 'syndeysapp' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Order Tag', 'syndeysapp' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Order Tag:', 'syndeysapp' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Order Tag', 'syndeysapp' ), /* edit Order taxonomy title */
				'update_item' => __( 'Update Order Tag', 'syndeysapp' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Order Tag', 'syndeysapp' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Order Tag Name', 'syndeysapp' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);