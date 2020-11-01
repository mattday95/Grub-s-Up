<?php

function grubs_up_populate_subdomain_select( $field ) {
    
    // reset choices
    $field['choices'] = array();

    $find = array( 'http://', 'https://' );
    $replace = '';
    $domain = str_replace( $find, $replace, get_site_url() );

    $choices = get_sites(array(
        'public' => 1,
        'domain__not_in' => array($domain)
    ));

    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        
        foreach( $choices as $choice ) {
            
            $field['choices'][] = $choice->domain;
            
        }
        
    }
    

    // return the field
    return $field;
    
}

add_filter('acf/load_field/key=field_5f9ef615a8c6b', 'grubs_up_populate_subdomain_select');