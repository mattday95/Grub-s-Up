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

        $discount = false;
        $cuisine_data = [];
        $cuisines = get_the_terms($restaurant->ID, 'cuisines');
        $times = get_field('times', $restaurant->ID);
        $restaurant_location = get_field('restaurant_location', $restaurant->ID);
        $distance = gu_calculate_distance($customer_location['lat'], $customer_location['lng'], $restaurant_location['lat'], $restaurant_location['lng'], "M");

            if( get_field('apply_discount', $restaurant->ID) && get_field('discount_rate', $restaurant->ID) ):

                $discount_rate = get_field('discount_rate', $restaurant->ID);
                $minimum_spend = get_field('add_minimum_spend', $restaurant->ID) && get_field('minimum_spend', $restaurant->ID) ? get_field('minimum_spend', $restaurant->ID) : false;

                
                $discount = array(
                    'rate' => $discount_rate,
                    'minimum_spend'=> $minimum_spend
                );

            endif;

            if( $cuisines ):

                foreach ($cuisines as $cuisine):
        
                    $cuisine_data[] = array(
                        'id' => $cuisine->term_id,
                        'name' => $cuisine->name,
                        'featured_image' => get_field('featured_image', $cuisine->taxonomy . '_' . $cuisine->term_id)['url']
                    );
                    
                endforeach;

            endif;

            $data[] = array(
                'name' => get_the_title($restaurant->ID),
                'id' => $restaurant->ID,
                'link' => get_the_permalink($restaurant->ID),
                'logo' => get_field('restaurant_logo', $restaurant->ID),
                'location' => $restaurant_location,
                'distance' => number_format((float)$distance, 2, '.', ''),
                'discount' => $discount,
                'cuisines' => $cuisine_data,
                'times' => array(
                    'collection' => $times['average_collection_time'], 
                    'delivery' => $times['average_delivery_time'] 
                ),
                'is_open' => gu_is_restaurant_open($restaurant)
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