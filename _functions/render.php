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