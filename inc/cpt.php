<?php

function gu_register_post_types() {

    $loc_labels = array(
        'name'                  => _x( 'Locations', 'Post type general name', 'location' ),
        'singular_name'         => _x( 'Location', 'Post type singular name', 'location' ),
        'menu_name'             => _x( 'Locations', 'Admin Menu text', 'location' ),
        'name_admin_bar'        => _x( 'Location', 'Add New on Toolbar', 'location' ),
        'add_new'               => __( 'Add New', 'location' ),
        'add_new_item'          => __( 'Add New location', 'location' ),
        'new_item'              => __( 'New location', 'location' ),
        'edit_item'             => __( 'Edit location', 'location' ),
        'view_item'             => __( 'View location', 'location' ),
        'all_items'             => __( 'All locations', 'location' ),
        'search_items'          => __( 'Search locations', 'location' ),
        'parent_item_colon'     => __( 'Parent locations:', 'location' ),
        'not_found'             => __( 'No locations found.', 'location' ),
        'not_found_in_trash'    => __( 'No locations found in Trash.', 'location' ),
        'featured_image'        => _x( 'Location Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'location' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'location' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'location' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'location' ),
        'archives'              => _x( 'Location archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'location' ),
        'insert_into_item'      => _x( 'Insert into new location', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'location' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this location', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'location' ),
        'filter_items_list'     => _x( 'Filter locations list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'location' ),
        'items_list_navigation' => _x( 'Location list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'location' ),
        'items_list'            => _x( 'Location list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'location' ),
    ); 
    
    $loc_labels = array(
        'name'                  => _x( 'Locations', 'Post type general name', 'location' ),
        'singular_name'         => _x( 'Location', 'Post type singular name', 'location' ),
        'menu_name'             => _x( 'Locations', 'Admin Menu text', 'location' ),
        'name_admin_bar'        => _x( 'Location', 'Add New on Toolbar', 'location' ),
        'add_new'               => __( 'Add New', 'location' ),
        'add_new_item'          => __( 'Add New location', 'location' ),
        'new_item'              => __( 'New location', 'location' ),
        'edit_item'             => __( 'Edit location', 'location' ),
        'view_item'             => __( 'View location', 'location' ),
        'all_items'             => __( 'All locations', 'location' ),
        'search_items'          => __( 'Search locations', 'location' ),
        'parent_item_colon'     => __( 'Parent locations:', 'location' ),
        'not_found'             => __( 'No locations found.', 'location' ),
        'not_found_in_trash'    => __( 'No locations found in Trash.', 'location' ),
        'featured_image'        => _x( 'Location Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'location' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'location' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'location' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'location' ),
        'archives'              => _x( 'Location archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'location' ),
        'insert_into_item'      => _x( 'Insert into new location', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'location' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this location', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'location' ),
        'filter_items_list'     => _x( 'Filter locations list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'location' ),
        'items_list_navigation' => _x( 'Location list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'location' ),
        'items_list'            => _x( 'Location list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'location' ),
    );  

    $loc_args = array(
        'labels'             => $loc_labels,
        'description'        => 'Location custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'location' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );

    $restaurant_labels = array(
        'name'                  => _x( 'Restaurants', 'Post type general name', 'Restaurant' ),
        'singular_name'         => _x( 'Restaurant', 'Post type singular name', 'Restaurant' ),
        'menu_name'             => _x( 'Restaurants', 'Admin Menu text', 'Restaurant' ),
        'name_admin_bar'        => _x( 'Restaurant', 'Add New on Toolbar', 'Restaurant' ),
        'add_new'               => __( 'Add New', 'Restaurant' ),
        'add_new_item'          => __( 'Add New Restaurant', 'Restaurant' ),
        'new_item'              => __( 'New Restaurant', 'Restaurant' ),
        'edit_item'             => __( 'Edit Restaurant', 'Restaurant' ),
        'view_item'             => __( 'View Restaurant', 'Restaurant' ),
        'all_items'             => __( 'All Restaurants', 'Restaurant' ),
        'search_items'          => __( 'Search Restaurants', 'Restaurant' ),
        'parent_item_colon'     => __( 'Parent Restaurants:', 'Restaurant' ),
        'not_found'             => __( 'No Restaurants found.', 'Restaurant' ),
        'not_found_in_trash'    => __( 'No Restaurants found in Trash.', 'Restaurant' ),
        'featured_image'        => _x( 'Restaurant Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Restaurant' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Restaurant' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Restaurant' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Restaurant' ),
        'archives'              => _x( 'Restaurant archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Restaurant' ),
        'insert_into_item'      => _x( 'Insert into Restaurant', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Restaurant' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Restaurant', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Restaurant' ),
        'filter_items_list'     => _x( 'Filter Restaurants list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Restaurant' ),
        'items_list_navigation' => _x( 'Restaurants list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Restaurant' ),
        'items_list'            => _x( 'Restaurants list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Restaurant' ),
    );    

    $restaurant_args = array(
        'labels'             => $restaurant_labels,
        'description'        => 'Restaurant custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'restaurant' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-food',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        'taxonomies'         => array( 'cuisines'),
        'show_in_rest'       => true
    );
      
    register_post_type( 'restaurant', $restaurant_args );
    register_post_type( 'location', $loc_args );
}
add_action( 'init', 'gu_register_post_types' );