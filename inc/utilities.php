<?php

function gu_calculate_distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
      return 0;
    }
    else {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);
  
      if ($unit == "K") {
        return ($miles * 1.609344);
      } else if ($unit == "N") {
        return ($miles * 0.8684);
      } else {
        return $miles;
      }
    }
}

function gu_get_day_of_week() {
    $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
    $current_day_index = date('w');
    return $days[$current_day_index];
}

function gu_is_restaurant_open( $restaurant ){

    $is_open = false;
    $current_day = gu_get_day_of_week();
    $current_time = date_i18n('g:i a');

    $opening_hours = get_field('opening_hours', $restaurant->ID);
    $opening_time = null;
    $closing_time = null;
    

    if( $opening_hours['open_for_business'] && $opening_hours['days'] ):

        foreach( $opening_hours['days'] as $day):
            if($day['day'] == $current_day):
                $opening_time = $day['opening_time'];
                $closing_time = $day['closing_time'];
            endif;
        endforeach;
    endif;

    if($opening_time !== null && $closing_time !== null):
        $is_open = strtotime($current_time) >= strtotime($opening_time) && strtotime($current_time) < strtotime($closing_time);
    endif;

    return $is_open;
}

function gu_is_service_available( $restaurant, $service ){

  $is_service_available = false;
  $current_day = date('w');
  $current_time = date_i18n('H:i');

  $opening_hours = get_field('opening_hours', $restaurant->ID);
  $service_hours = [];
  

  if( $opening_hours['open_for_business'] ):

      switch ($service) {
          case 'collection':
              $service_hours = $opening_hours['collection_hours'];
              break;
          case 'delivery':
              $service_hours = $opening_hours['delivery_hours'];
              break;
      }

  endif;

  $previous_day_times = $current_day > 0 ? $service_hours[$current_day - 1] : $service_hours[6];
  $current_day_times = $service_hours[$current_day];

  if($current_day_times && $previous_day_times):

    // Previous day service ends the following day
      if( strtotime($previous_day_times[$service.'_end']) < strtotime($previous_day_times[$service.'_start']) ):

        // If current time is before previous day service end then service is available.
        if( strtotime($current_time) <= strtotime($previous_day_times[$service.'_end']) ):
          $is_service_available = true;
        endif;

      endif;

      // If current day service ends after start time (ie. same day)
      if( strtotime($current_day_times[$service.'_end']) > strtotime($current_day_times[$service.'_start'])):

        $is_service_available = strtotime($current_time) >= strtotime($current_day_times[$service.'_start']) && strtotime($current_time) <= strtotime($current_day_times[$service.'_end']);

      else:

        $is_service_available = strtotime($current_time) >= strtotime($current_day_times[$service.'_start']);

      endif;


  endif;


  return $is_service_available;
}

function gu_get_reviews_by_restaurant($restaurant){

  $args = array(
    'post_type' => 'review',
    'posts_per_page' => -1,
    'meta_query'	=> array(
        array(
          'key'	 	=> 'restaurant',
          'value'	  	=> $restaurant->ID,
          'compare' 	=> '=',
        ),
    )
    );

    $query = new WP_Query($args);

    return $query->have_posts() ? $query->posts : [];
}

function gu_get_average_rating($reviews) {

  $average_rating = 0;
  $sum_ratings = 0;

  foreach($reviews as $review):

  $sum_ratings += get_field('star_rating', $review->ID);

  endforeach;

  $average_rating = $sum_ratings / count($reviews);

  return $average_rating;
}