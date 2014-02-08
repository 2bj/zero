<?php
header('Content-type: text/css; charset=utf-8');

echo file_get_contents( 'styles.css' );

define('WP_USE_THEMES', false);
require('../../../../../wp-blog-header.php');

$bg_style = render_bg( get_theme_mod( 'zero_theme_bg_image_position' ), get_theme_mod( 'zero_theme_bg_image_repeat' ), get_theme_mod( 'zero_theme_bg_image_fixed' ) );

?>

body, .hr {
	background-color: <?php echo get_theme_mod( 'zero_theme_bg' ); ?>;
	background-image: <?php echo ( get_theme_mod( 'zero_theme_bg_image' ) ? 'url(' . get_theme_mod( 'zero_theme_bg_image' ) . ');' : 'none' ) ?>
	<?php echo $bg_style; ?>
}
a,
.nav li.current_page_item a,
.nav li.current-menu-item a,
.pagination .page-numbers,
.header a:hover,
.post .post__header .post__title a:hover,
.post .post__header .post__title.post__title--white a:hover,
.post .post__header .post__quote-author.post__quote-author--white a:hover,
.pagination a.page-numbers:hover,
.credits a:hover {
  color: <?php echo get_theme_mod( 'zero_theme_color' ) ?>;
}
.fotorama__nav__frame:hover .fotorama__dot,
.fotorama__nav__frame.fotorama__active .fotorama__dot {
  background-color: <?php echo get_theme_mod( 'zero_theme_color' ) ?>;
}

<?php

if ( get_theme_mod( 'zero_css_code' ) ) {
	echo get_theme_mod( 'zero_css_code' );
}

if ( get_theme_mod( 'zero_theme_layout' ) == 'center' ) {
	?>
	.blog, .header, .pagination, .post-meta, .page, .comments, .credits {
		margin-left: auto !important;
		margin-right: auto !important;
	}
	.header, .pagination, .post-date {
		padding-left: 0;
	}
	@media screen and (max-width: 960px) {
		.header, .pagination, .post-date, .page {
			padding-left: 60px;
		}
	}
	.page p img {
		margin-left: 0;
	}
	@media screen and (max-width: 960px) {
		.page p img {
			margin-left: -60px;
		}
	}
	<?php
}
?>