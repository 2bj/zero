<?php

if ( $_SERVER['REQUEST_URI'] == '/blog/' ) {
	wp_redirect( '/' );
}

require( '_partials/head.php' );
require( '_partials/header.php' );
?>

	<section class="page">
		<h1 class="page__title">
			Страница не найдена
		</h1>
	</section>

<?php require( '_partials/foot.php' ); ?>