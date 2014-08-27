<?php

function sliderImageToAnchor( $html ) {

  $img = array();

  preg_match( '/<img(?:.*?)src="(.*?)(.jpg|.jpeg|.png)"(?:.*?)>/', $html[0], $src );
  preg_match( '/<img(?:.*?)alt="(.*?)"(?:.*?)>/', $html[0], $alt );

  $img['path'] = $src[1];
  $img['type'] = $src[2];
  $img['alt'] = $alt[1];
  $img['filename'] = explode( "/", $src[1] );
  $img['filename'] = array_reverse( $img['filename'] );
  $img['filename'] = $img['filename'][0];
  if ( $img['filename'] == $img['alt'] ) {
    $img['alt'] = '';
  }

  return '<a href="' . $img['path'] . $img['type'] . '" data-caption="' . $img['alt'] . '"><img src="' . $img['path'] . '-150x150' . $img['type'] . '" /></a>';

  // print_r( $img );
}

function sliderImagesToAnchors( $html ) {

  return preg_replace_callback( '/<img(.*?)>/si', sliderImageToAnchor, $html[0] );


  // $pattern2 = '/<img(?:.*?)alt="(.*?)"(?:.*?)src="(.*?)(.jpg|.jpeg|.png)"(?:.*?)>/si';

  // if ( preg_match( $pattern1, $html[0] ) ) {
  //   echo 'Yes';
  //   // $output = preg_replace( $pattern1, '<a href="\\1\\2" data-caption="\\3"><img src="\\1-150x150\\2" /></a>', $html[0]);
  // } else {
  //   echo 'No';
  //   // $output = preg_replace( $pattern2, '<a href="\\2\\3" data-caption="\\1"><img src="\\2-150x150\\3" /></a>', $html[0]);
  // }
  // $output = preg_replace( $pattern2, '<a href="\\2\\3" data-caption="\\1"><img src="\\2-150x150\\3" /></a>', $html[0]);
  // return $output;
}

function photosetGrid( $html ) {
  $img_number = 0;
  $output = '';

  preg_match_all('/<img(.*?)>/si', $html[1], $matches);

  $output .= '<div class="grid"><div class="grid__row" data-layout="' . count( $matches[0] ) . '">';
  $output .= $html[1];
  $output .= '</div></div>';

  return $output;
}

add_filter( 'the_content', 'zero_content' );
function zero_content( $html ) {
  $output = $html;

  // Рендерим Фотораму по красоте )
  $output = preg_replace_callback( '!<(?:div|p) class="slider">(.*?)</(?:div|p)>!si', sliderImagesToAnchors, $html );

  // Готовим лейаут для гридов
  $output = preg_replace_callback( '!<(?:div|p) class="grid">(.*?)</(?:div|p)>!si', photosetGrid, $html );

  return $output;
}
