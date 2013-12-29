<?php while ( have_posts() ) : the_post(); ?>

<?php
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