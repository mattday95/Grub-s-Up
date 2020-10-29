<?php
// Define path and URL to the ACF plugin.
define( 'GRUBS_UP_ACF_PATH', get_stylesheet_directory() . '/inc/acf/' );
define( 'GRUBS_UP_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/' );

// Include the ACF plugin.
include_once( GRUBS_UP_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'grubs_up_acf_settings_url');
function grubs_up_acf_settings_url( $url ) {
    return GRUBS_UP_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'grubs_up_acf_settings_show_admin');
function grubs_up_acf_settings_show_admin( $show_admin ) {
    return true;
}

require_once(__DIR__.'/inc/enqueue.php');
require_once(__DIR__.'/inc/login.php');
require_once(__DIR__.'/inc/cpt.php');
require_once(__DIR__.'/inc/tax.php');
require_once(__DIR__.'/inc/api.php');
require_once(__DIR__.'/inc/maps.php');
require_once(__DIR__.'/inc/theme_settings.php');
require_once(__DIR__.'/inc/utilities.php');