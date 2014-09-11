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
}

function sliderImagesToAnchors( $html ) {
  return preg_replace_callback( '/<img(.*?)>/si', sliderImageToAnchor, $html[0] );
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

// Рендерим Фотораму по красоте
add_filter( 'the_content', 'zero_slider' );
function zero_slider( $html ) {
  $output = $html;
  $output = preg_replace_callback( '!<(?:div|p) class="slider">(.*?)</(?:div|p)>!si', sliderImagesToAnchors, $html );
  return $output;
}

// Готовим лейаут для гридов
add_filter( 'the_content', 'zero_grid' );
function zero_grid( $html ) {
  $output = $html;
  $output = preg_replace_callback( '!<(?:div|p) class="grid">(.*?)</(?:div|p)>!si', photosetGrid, $html );
  return $output;
}
