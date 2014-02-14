<?php

$meta = merge_meta( array(
	'title'	=> ( ( is_feed() || !trim( wp_title( false, false ) ) ) ? LOGO : wp_title( false, false ) )
) );
require( '_partials/head.php' );
require( '_partials/header.php' );

if ( have_posts() ) {

	echo '<section class="blog">';
	while ( have_posts() ) {
		the_post();

		$id = get_the_ID();
		$title = get_the_title();
		$metaboxes = $post_meta_data = get_post_custom($post->ID);

		$hidden_title = unserialize( $metaboxes['of_header'][0] );
		if ( $hidden_title[0] == 'title_no' || !trim( $title ) ) {
			$hidden_title = true;
		} else {
			$hidden_title = false;
		}

		$teaser = zero_get_cover( $metaboxes );
		$cover_type = $teaser[0];
		$cover = $teaser[1];
		$lead = $teaser[2];

		require( '_partials/blog__item.php' );
	}
	echo '</section>';

} else {
	require '_partials/empty.php';
}
require( '_partials/pagination.php' );
require( '_partials/foot.php' );
