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

function gu_is_service_available( $restaurant, $service ){

  $is_service_available = false;
  $current_day = date('N') - 1;
  $current_time = date_i18n('H:i');

  $all_days = get_field('opening_hours', $restaurant->ID)['days'];

  $current_day_times = $all_days[$current_day];
  $previous_day_times = $current_day > 0 ? $all_days[$current_day - 1] : $all_days[6];

  if(get_field('opening_hours', $restaurant->ID)['open_for_business']):

    // If service was available the previous day and times are set.
    if($previous_day_times['enable_'.$service] && $previous_day_times[$service.'_end'] && $previous_day_times[$service.'_start']):
      
      // Previous day service ends the following day
      if( strtotime($previous_day_times[$service.'_end']) < strtotime($previous_day_times[$service.'_start']) ):
        
        // If current time is before previous day service end then service is available.
        if( strtotime($current_time) < strtotime($previous_day_times[$service.'_end']) ):
          $is_service_available = true;
          return $is_service_available;
        endif;
        
      endif;

    endif;
      
     // If service is available today and times are set.
    if($current_day_times['enable_'.$service] && $current_day_times[$service.'_start'] && $current_day_times[$service.'_end']):
        
      // If current day service ends after start time (ie. same day)
      if( strtotime($current_day_times[$service.'_end']) > strtotime($current_day_times[$service.'_start'])):

        $is_service_available = strtotime($current_time) >= strtotime($current_day_times[$service.'_start']) && strtotime($current_time) < strtotime($current_day_times[$service.'_end']);

      else:

        $is_service_available = strtotime($current_time) >= strtotime($current_day_times[$service.'_start']);

      endif;

    endif;

  endif;

  return $is_service_available;

}

function gu_is_preorder_available( $restaurant ){

  $current_day = date('N') - 1;
  $all_days = get_field('opening_hours', $restaurant->ID)['days'];

  $current_day_times = $all_days[$current_day];

  $is_preorder_available = $current_day_times['enable_preorder'] && get_field('opening_hours', $restaurant->ID)['open_for_business'];
  return $is_preorder_available;
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