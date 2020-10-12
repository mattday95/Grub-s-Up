<?php

//add SVG to allowed file uploads
function gu_add_file_types_to_uploads($file_types){

	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg';
	$file_types = array_merge($file_types, $new_filetypes );

	return $file_types; 
} 
add_action('upload_mimes', 'gu_add_file_types_to_uploads');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}