<?php

/**
 * Шорткод [inset id="0"]
 */
add_shortcode( 'inset', 'shortcode_inset' );
function shortcode_inset( $atts ) {
	extract( shortcode_atts( array(
		'id' => 0
	), $atts ) );

	if ( ! $atts['id'] || ! is_numeric( $atts['id'] ) ) {
		return false;
	}

	global $wpdb;
	$query = $wpdb->get_results( $wpdb->prepare( "SELECT p.post_title
																								FROM $wpdb->posts p
																								WHERE p.ID = %d
																								AND p.post_status = 'publish'
																								", $atts['id'] ) );

	$pic = get_field( 'cover_type', $atts['id'] );
	if ( $pic == 'image' || $pic == 'cover' ) {
		$pic = get_field( 'cover_image', $atts['id'] );
	} else {
		$pic = 0;
	}

	$output = '
		<p class="inset-right-teaser">
			<a href="' . get_permalink( $atts['id'] ) . '" title="' . $query[0]->post_title . '" class="teaser">
				' . ( $pic ? '<img src="' . $pic['sizes']['240x'] . '" width="' . $pic['sizes']['240x-width'] . '" height="' . $pic['sizes']['240x-height'] . '" alt="' . $query[0]->post_title . '" />' : '' ) . '
				<u>
					' . $query[0]->post_title . '
				</u>
			</a>
		</p>';

	return $output;
}