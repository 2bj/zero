<?php while ( have_posts() ) : the_post(); ?>

<?php

function zero_html_attributes() {
	echo ' prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#"';
}
add_action('html_attributes', 'zero_html_attributes');

function zero_og_extras() {
	echo "\n";
	echo "\t\t<meta property=\"og:type\" content=\"article\">";
}
add_action('og_extras', 'zero_og_extras');


$meta = merge_meta( array(
	'title' 			=> wp_title( false, false )
) );
require( '_partials/head.php' );
require( '_partials/header.php' );
?>

	<section class="page">
		<div class="page__content">
			<?php the_content(); ?>
		</div>
	</section>

<?php require( '_partials/foot.php' ); ?>

<?php endwhile; ?>