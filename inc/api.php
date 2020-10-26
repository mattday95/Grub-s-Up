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

    if($request['postcode']):

        $postcode = urlencode($request['postcode']);

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  

        $postcode_data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$postcode."&key=".get_field('google_api_key', 'option'), false, stream_context_create($arrContextOptions));
        $postcode_data = json_decode($postcode_data, true);
        $ne_bounds = $postcode_data['results'][0]['geometry']['bounds']['northeast'];
        $sw_bounds = $postcode_data['results'][0]['geometry']['bounds']['southwest'];
        $customer_location = array(
            'lat' => ($ne_bounds['lat'] + $sw_bounds['lat']) / 2,
            'lng' => ($ne_bounds['lng'] + $sw_bounds['lng']) / 2
        );

    endif;

    $args = array(
        'post_type' => 'restaurant',
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);
    $all_restaurants = $query->posts;
    $search_radius = get_field('restaurant_search_radius', 'option') ? get_field('restaurant_search_radius', 'option') : 5;
    
    $filtered_restaurants = [];

    foreach( $all_restaurants as $key => $restaurant ):

        $restaurant_location = get_field('restaurant_location', $restaurant->ID);
        $distance_to_restaurant = gu_calculate_distance($customer_location['lat'], $customer_location['lng'], $restaurant_location['lat'], $restaurant_location['lng'], "M");
        $delivery_radius = get_field('delivery_radius', $restaurant->ID) ?  get_field('delivery_radius', $restaurant->ID) : $search_radius;

        if( $distance_to_restaurant <= $search_radius && $distance_to_restaurant <= $delivery_radius):
            array_push($filtered_restaurants, $restaurant);
        endif;

    endforeach;

    if($filtered_restaurants):

        foreach ( $filtered_restaurants as $restaurant ):

        $discount = array(
            'rate' => 0,
            'minimum_spend' => false
        );
        $cuisine_data = [];
        $cuisines = get_the_terms($restaurant->ID, 'cuisines');
        $restaurant_data = get_field('data', $restaurant->ID);
        $delivery_data = $restaurant_data['delivery'];
        $times_data = $restaurant_data['times'];
        $restaurant_location = get_field('restaurant_location', $restaurant->ID);
        $reviews = gu_get_reviews_by_restaurant($restaurant);
        $distance = gu_calculate_distance($customer_location['lat'], $customer_location['lng'], $restaurant_location['lat'], $restaurant_location['lng'], "M");
        $collection_available = gu_is_service_available($restaurant, 'collection');
        $delivery_available = gu_is_service_available($restaurant, 'delivery');
        $preorder_available = gu_is_preorder_available($restaurant);

            if( get_field('apply_discount', $restaurant->ID) && get_field('discount_rate', $restaurant->ID) ):

                $discount_rate = get_field('discount_rate', $restaurant->ID);
                $minimum_spend = get_field('add_minimum_spend', $restaurant->ID) && get_field('minimum_spend', $restaurant->ID) ? get_field('minimum_spend', $restaurant->ID) : false;
                $discount['rate'] = $discount_rate;
                $discount['minimum_spend'] = $minimum_spend;

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
                'name' => $restaurant->post_title,
                'slug'=> $restaurant->post_name,
                'id' => $restaurant->ID,
                'link' => get_the_permalink($restaurant->ID),
                'logo' => get_field('restaurant_logo', $restaurant->ID),
                'hero_background' => get_field('menu_page_hero_background', $restaurant->ID),
                'location' => $restaurant_location,
                'distance' => number_format((float)$distance, 2, '.', ''),
                'discount' => $discount,
                'cuisines' => $cuisine_data,
                'reviews' => array(
                    'num_reviews' => count($reviews),
                    'average_rating' => count($reviews) > 0 ? gu_get_average_rating($reviews) : 0
                ),
                'times' => array(
                    'collection' => $times_data['average_collection_time'], 
                    'delivery' => $times_data['average_delivery_time'] 
                ),
                'delivery' => array(
                    'charge' => number_format((float)$delivery_data['charge'], 2, '.', ''),
                    'minimum_spend' => number_format((float)$delivery_data['minimum_spend'], 2, '.', '')
                ),
                'collection_available' => $collection_available,
                'delivery_available' => $delivery_available,
                'preorder_available' => !$collection_available && !$delivery_available && $preorder_available
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