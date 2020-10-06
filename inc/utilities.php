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