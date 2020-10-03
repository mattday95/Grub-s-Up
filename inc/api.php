<?php

// Modify base url prefix
add_filter( 'rest_url_prefix', 'gu_api_slug');
 
function gu_api_slug( $slug ) {
    return 'api';
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'consumer', '/restaurants', array(
        'methods' => 'GET',
        'callback' => 'gu_get_restaurants',
    ) );
    register_rest_route( 'consumer', '/cuisines', array(
        'methods' => 'GET',
        'callback' => 'gu_get_all_cuisines',
    ) );
} );

function gu_get_restaurants( WP_REST_Request $request ) {

    $data = array();

    if($request['postcode']){

        $postcode = urlencode($request['postcode']);

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  

        $postcode_data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$postcode."&key=AIzaSyA99pWkEHbin-urBWAEOQNYQ65MP7M02wM", false, stream_context_create($arrContextOptions));
        $postcode_data = json_decode($postcode_data, true);
        $customer_location = $postcode_data['results'][0]['geometry']['bounds']['northeast'];
    }

    $args = array(
        'post_type' => 'restaurant',
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);
    $all_restaurants = $query->posts;
    
    $filtered_restaurants = [];

    foreach( $all_restaurants as $key => $restaurant ){
        $restaurant_location = get_field('restaurant_location', $restaurant->ID);
        if( gu_calculate_distance($customer_location['lat'], $customer_location['lng'], $restaurant_location['lat'], $restaurant_location['lng'], "M") <= 5 ){
            array_push($filtered_restaurants, $restaurant);
        }
    }

    if($filtered_restaurants):

        foreach ( $filtered_restaurants as $restaurant ):

        $data[] = array(
            'name' => get_the_title($restaurant->ID),
            'logo' => get_field('restaurant_logo', $restaurant->ID)['url'],
            'location' => get_field('restaurant_location', $restaurant->ID),
            'cuisines' => get_the_terms( $restaurant->ID , 'cuisines' ) ? get_the_terms( $restaurant->ID , 'cuisines' ) : []
        );
    
        endforeach;

    endif;
 
    return $data;
}

function gu_get_all_cuisines( $data ) {

    $data = [];

    $cuisines = get_terms( 'cuisines', array(
        'hide_empty' => true,
    ) );

    if($cuisines):

        foreach ($cuisines as $cuisine):

            $data[] = array(
                'cuisine' => $cuisine,
                'featured_image' => get_field('featured_image', $cuisine->taxonomy . '_' . $cuisine->term_id)['url']
            );

        endforeach;

    endif;
 
    return $data;
}