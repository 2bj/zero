<?php
while ( have_posts() ) {
	the_post();

	$title = get_the_title();
	$metaboxes = $post_meta_data = get_post_custom($post->ID);

	$hidden_title = unserialize( $metaboxes['of_header'][0] );
	if ( $hidden_title[0] == 'title_no' ) {
		$hidden_title = true;
	} else {
		$hidden_title = false;
	}

	$teaser = zero_get_cover( $metaboxes );
	$cover_type = $teaser[0];
	$cover = $teaser[1];
	$lead = $teaser[2];

	$meta_single = array(
		'title'	=> ( ( is_feed() || !trim( wp_title( false, false ) ) ) ? 'Блог' : wp_title( false, false ) )
	);
	if ( $cover ) {
		$meta_single['image'] = $cover;
	}
	if ( $lead ) {
		$meta_single['description'] = $lead;
	}
	$meta = merge_meta( $meta_single );

	require( '_partials/head.php' );
	require( '_partials/header.php' );

	echo '<section class="blog">';
	require( '_partials/blog__item.php' );
	echo '</section>';
	?>

	<div class="post-date">
		<?php echo render_date( get_the_date() ); ?>
	</div>

	<!--<div class="comments">

		<?php
		$page_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$page_url = explode( '?', $page_url );
		$page_url = $page_url[0];
		?>

		<div class="fb-comments" data-width="720" data-href="<?php echo $page_url; ?>" data-numposts="5" data-colorscheme="light"></div>
	</div>-->

<?php } ?>

<?php require( '_partials/foot.php' ); ?>