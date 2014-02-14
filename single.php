<?php

if ( strpos( $_SERVER['REQUEST_URI'], "fb_action_ids") ) {
	$uri = explode( "?", $_SERVER['REQUEST_URI'] );
	header( "location: " . $uri[0] );
}

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

	$meta_single = array(
		'title'	=> ( ( is_feed() || !trim( wp_title( false, false ) ) ) ? 'Блог' : wp_title( false, false ) )
	);
	if ( $cover ) {
		$meta_single['image'] = $cover;
	}
	if ( $lead ) {
		$meta_single['description'] = strip_tags( $lead );
	}
	$meta = merge_meta( $meta_single );

	if ( $metaboxes['of_bg_image'][0] ) {
		$bg_style = render_bg( $metaboxes['of_bg_position'][0], $metaboxes['of_bg_repeat'][0], $metaboxes['of_bg_attachment'][0] );
		$bg_image = wp_get_attachment_image_src( $metaboxes['of_bg_image'][0], 'full' );
		$bg_style .= ' background-image: url(' . $bg_image[0] . '); ';
	}

	require( '_partials/head.php' );
	require( '_partials/header.php' );

	echo '<section class="blog">';
	require( '_partials/blog__item.php' );
	echo '</section>';
	?>

	<div class="post-meta">
		<div class="post-meta__date">
			<div class="post-date">
				<?php echo render_date( get_the_date() ); ?>
			</div>
		</div>
		<div class="post-meta__tags">
			<ul class="tags">
			<?php
			$tags = get_the_tags();
			if ( ! empty( $tags ) ) {
				foreach ( $tags as $tag ) {
					echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . $tag->name . '">' . $tag->name . '</a></li>';
				}
			}
			?>
			</ul>
		</div>
	</div>

	<?php if ( get_theme_mod( 'zero_og_disqus' ) ) : ?>
	<div class="comments">
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
			var disqus_shortname = '<?php echo get_theme_mod( 'zero_og_disqus' ); ?>'; // required: replace example with your forum shortname
			var disqus_disable_mobile = true;
			/* * * DON'T EDIT BELOW THIS LINE * * */
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	</div>
	<?php endif; ?>

<?php } ?>

<?php require( '_partials/foot.php' ); ?>