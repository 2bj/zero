<?php

function zero_get_cover( $metaboxes ) {
	$cover_type = $metaboxes['of_cover_type'][0];
	if ( $cover_type == 'under' || $cover_type == 'cover' ) {
		$cover = wp_get_attachment_image_src( get_post_thumbnail_id(), '960x', true);
		$cover = $cover[0];
	} else {
		$cover_type = false;
	}

	if ( $cover_type == 'cover' ) {
		$lead = trim( $metaboxes['of_lead'][0] );
	} else {
		$lead = false;
	}
	return array( $cover_type, $cover, $lead );
}

function render_bg( $pos, $repeat, $fixed ) {
	$bg_style = '';

	switch ( $pos ) {
		case 'topleft':
			$bg_style = 'background-position: top left; ';
			break;

		case 'topright':
			$bg_style = 'background-position: top right; ';
			break;

		default:
			$bg_style = 'background-position: top center; ';
			break;
	}

	switch ( $repeat ) {
		case 'repeat':
			$bg_style .= 'background-repeat: repeat; ';
			break;

		case 'repeat-x':
			$bg_style .= 'background-repeat: repeat-x; ';
			break;

		case 'repeat-y':
			$bg_style .= 'background-repeat: repeat-y; ';
			break;

		default:
			$bg_style .= 'background-repeat: no-repeat; ';
			break;
	}

	switch ( $fixed ) {
		case 'fixed':
			$bg_style .= 'background-attachment: fixed; ';
			break;

		default:
			break;
	}
	return $bg_style;
}