<?php

$cuisine_labels = array(
    'name'              => _x( 'Cuisines', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'Cuisine', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search Cuisines', 'textdomain' ),
    'all_items'         => __( 'All Cuisines', 'textdomain' ),
    'parent_item'       => __( 'Parent Cuisine', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Cuisine:', 'textdomain' ),
    'edit_item'         => __( 'Edit Cuisine', 'textdomain' ),
    'update_item'       => __( 'Update Cuisine', 'textdomain' ),
    'add_new_item'      => __( 'Add New Cuisine', 'textdomain' ),
    'new_item_name'     => __( 'New Cuisine Name', 'textdomain' ),
    'menu_name'         => __( 'Cuisines', 'textdomain' ),
);

$cuisine_args = array(
    'labels'            => $cuisine_labels,
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'cuisine' ),
);

$location_labels = array(
    'name'              => _x( 'Locations', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'Location', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search Locations', 'textdomain' ),
    'all_items'         => __( 'All Locations', 'textdomain' ),
    'parent_item'       => __( 'Parent Location', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Location:', 'textdomain' ),
    'edit_item'         => __( 'Edit Location', 'textdomain' ),
    'update_item'       => __( 'Update Location', 'textdomain' ),
    'add_new_item'      => __( 'Add New Location', 'textdomain' ),
    'new_item_name'     => __( 'New Location Name', 'textdomain' ),
    'menu_name'         => __( 'Locations', 'textdomain' ),
);

$location_args = array(
    'labels'            => $location_labels,
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'location' ),
);

register_taxonomy( 'cuisines', array( 'restaurant' ), $cuisine_args );
register_taxonomy( 'locations', array( 'restaurant' ), $location_args );