<?php

/**
 * Насильно ставим в качестве формата даты юникод
 */
add_filter( 'init', 'set_date_format' );
function set_date_format() {
  update_option( 'date_format', 'U' );
}

/**
 * Подаем на вход юникод, получаем на выходе дату на русском
 */
function render_date( $u ) {
  return zero_nicetime( $u, false );
}

/**
 * Подаем на вход номер месяца, получаем на выходе месяц в родительном падеже
 */
function zero_month( $n ) {
  $month = array( __( 'January', 'zero' ), __( 'February', 'zero' ), __( 'March', 'zero' ), __( 'April', 'zero' ), __( 'May', 'zero' ), __( 'June', 'zero' ), __( 'July', 'zero' ), __( 'August', 'zero' ), __( 'September', 'zero' ), __( 'October', 'zero' ), __( 'November', 'zero' ), __( 'December', 'zero' ));
  return $month[ $n-1 ];
}

/**
 * Рендерим дату
 */
function zero_nicetime( $date, $time = null ) {
  if( empty( $date ) ) {
    return ( "No date provided" );
  }

  $output         = '';
  $now            = time() + get_option( 'gmt_offset' ) * 3600;
  $current_year   = date( 'Y', $now );
  $post_date      = $date;
  $post_year      = date( 'Y', $post_date );
  $post_month     = zero_month( date( 'n', $post_date ) );
  $post_day       = date( 'j', $post_date );

  if ( $time ) {
    $time = ' at ' . date( 'H:i', $post_date );
  }

  // check validity of date
  if( empty( $post_date ) ) {
    return ( "Bad date" );
  }

  $difference = date( 'j', $now ) - date( 'j', $post_date );

  if ( date( 'j', $now ) == date( 'j', $post_date ) && date( 'n', $now ) == date( 'n', $post_date ) && date( 'Y', $now ) == date( 'Y', $post_date ) ) {
    if ( is_single() ) {
      return ( __( 'Today', 'zero' ) . $time );
    }
  }

  $output = $post_day . ' ' . $post_month . ' ' . $post_year;
  if ( $post_year == $current_year ) {
    $output = $post_day . ' ' . $post_month;
  }
  return ( $output . $time );
}