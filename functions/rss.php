<?php

function add_data_to_feeds($content) {
  global $post;
  if ( has_post_thumbnail( $post->ID ) ) {
    $content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
  }

  $metaboxes = get_post_custom( $post->ID );
  $lead = $metaboxes['of_lead'][0];

  if ( $lead ) {
    $content = '<p>' . $lead . '</p>' . $content;
  }

  return $content;
}
add_filter('the_content_feed', 'add_data_to_feeds');