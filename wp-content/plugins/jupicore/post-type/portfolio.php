<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Portfolio: Custom Post Types
 *
 *
 */
class jupitercore_portfolio_Post_Types {
	
	public function __construct()
	{
		$this->register_post_type();
	}

	public function register_post_type()
	{
		$args = array();	

		// Portfolio
		$args['post-type-portfolio'] = array(
			'labels' => array(
				'name' => __( 'Portfolio', 'jupitercore' ),
				'singular_name' => __( 'Item', 'jupitercore' ),
				'add_new' => __( 'Add New Item', 'jupitercore' ),
				'add_new_item' => __( 'Add New Item', 'jupitercore' ),
				'edit_item' => __( 'Edit Item', 'jupitercore' ),
				'new_item' => __( 'New Item', 'jupitercore' ),
				'view_item' => __( 'View Item', 'jupitercore' ),
				'search_items' => __( 'Search Through portfolio', 'jupitercore' ),
				'not_found' => __( 'No items found', 'jupitercore' ),
				'not_found_in_trash' => __( 'No items found in Trash', 'jupitercore' ),
				'parent_item_colon' => __( 'Parent Item:', 'jupitercore' ),
				'menu_name' => __( 'Portfolio', 'jupitercore' ),				
			),		  
			'hierarchical' => false,
	        'description' => __( 'Add a Portfolio Item', 'jupitercore' ),
	        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'),
	        'menu_icon' =>  'dashicons-images-alt',
	        'public' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => true,
	        'query_var' => true,
	        'rewrite' => array( 'slug' => 'portfolio' ),
	        // This is where we add taxonomies to our CPT
        	//'taxonomies'          => array( 'category' ),
		);	

		// Register post type: name, arguments
		register_post_type('portfolio', $args['post-type-portfolio']);
	}
}

function jupitercore_portfolio_types() { new jupitercore_portfolio_Post_Types(); }

add_action( 'init', 'jupitercore_portfolio_types' );

/*-----------------------------------------------------------------------------------*/
/*	Creating Custom Taxonomy 
/*-----------------------------------------------------------------------------------*/
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'jupitercore_create_portfolio_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function jupitercore_create_portfolio_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'jupitercore' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'jupitercore' ),
		'search_items'      => __( 'Search Categories', 'jupitercore' ),
		'all_items'         => __( 'Categories', 'jupitercore' ),
		'parent_item'       => __( 'Parent Category', 'jupitercore' ),
		'parent_item_colon' => __( 'Parent Category:', 'jupitercore' ),
		'edit_item'         => __( 'Edit Category', 'jupitercore' ),
		'update_item'       => __( 'Update Category', 'jupitercore' ),
		'add_new_item'      => __( 'Add New Category', 'jupitercore' ),
		'new_item_name'     => __( 'New Category', 'jupitercore' ),
		'menu_name'         => __( 'Categories', 'jupitercore' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfoliocategory' ),
	);

	register_taxonomy( 'portfoliocats', array( 'portfolio' ), $args );
}