<!DOCTYPE html>
<!--[if IE 8]>	 <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php echo $meta['title'] ?></title>
		<meta name="description" content="<?php echo $meta['description'] ?>">
		<meta name="viewport" content="width=device-width">

		<meta property="og:url" content="http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
		<meta property="og:title" content="<?php echo $meta['title'] ?>">
		<meta property="og:description" content="<?php echo $meta['description'] ?>">
		<meta property="og:image" content="<?php echo $meta['image'] ?>">
		<meta property="og:type" content="article">

		<meta property="og:site_name" content="<?php echo LOGO; ?>">
		<meta property="fb:admins" content="<?php echo get_theme_mod( 'zero_og_fb' ); ?>" />
		<meta name="twitter:card" value="summary">
		<meta name="twitter:site" value="<?php echo get_theme_mod( 'zero_og_twitter' ); ?>">
		<meta name="twitter:creator" value="<?php echo get_theme_mod( 'zero_og_twitter' ); ?>">
		<meta name="twitter:domain" value="<?php echo $_SERVER['SERVER_NAME']; ?>">

		<link title="" type="application/rss+xml" rel="alternate" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/feed/" />

		<link href='http://fonts.googleapis.com/css?family=PT+Mono|PT+Sans+Caption:700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
		<?php wp_head() ?>

		<?php if ( trim( get_theme_mod( 'zero_og_vk' ) ) ) : ?>
		<!-- Put this script tag to the <head> of your page -->
		<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
		<script type="text/javascript">
		  VK.init({apiId: <?php echo get_theme_mod( 'zero_og_vk' ) ?>, onlyWidgets: true});
		</script>
		<?php endif; ?>

	</head>
	<body style="<?php echo $bg_style; ?>">
		<?php if ( trim( get_theme_mod( 'zero_og_fb_appId' ) ) ) : ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=<?php echo get_theme_mod( 'zero_og_fb_appId' ) ?>";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<?php endif; ?>