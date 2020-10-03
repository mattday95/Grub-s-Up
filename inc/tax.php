<?php

$labels = array(
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

$args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'cuisine' ),
);

register_taxonomy( 'cuisines', array( 'restaurant' ), $args );