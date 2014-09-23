<?php

if ( strpos( $_SERVER['REQUEST_URI'], "fb_action_ids") ) {
  $uri = explode( "?", $_SERVER['REQUEST_URI'] );
  header( "location: " . $uri[0] );
}

$meta = array(
  'title' => LOGO,
  'link' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
  'description' => LOGO,
  'image' => SHARE,
  'type' => 'website'
);

$is_mosaic = false;
$current_tag = '';

if ( is_tag() ) {
  $current_tag = $wp_query->query['tag'];
  $current_tag_name = get_term_by( 'slug', $current_tag, 'post_tag' );
  $current_tag_name = $current_tag_name->name;

  $meta['title'] = $current_tag_name . '. ' . LOGO;

  $mosaic_tags = explode( ",", get_theme_mod( 'zero_theme_mosaic' ) );
  foreach ( $mosaic_tags as $key => $value ) {
    $mosaic_tags[ $key ] = trim( $value );
  }

  if ( is_tag() && in_array( $current_tag_name, $mosaic_tags ) ) {
    $is_mosaic = true;
  }
}

if ( is_single() ) {
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();

      $meta['title'] = strip_tags( get_the_title() . '. ' . LOGO );
      $meta['type'] = 'article';

      if ( trim( get_the_excerpt() ) ) {
        $meta['description'] = get_the_excerpt();
      }

      $post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), '960x', true);
      if ( strstr( $post_image[0], 'images/media/default' ) ) {
        $post_image = str_img_src( get_the_content() );
      } else {
        $post_image = $post_image[0];
      }

      if ( $post_image ) {
        $meta['image'] = $post_image;
      }
    }
  }
}

$lang = 'en';
if ( WPLANG == 'ru_RU' )
  $lang = 'ru';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# <?php echo $meta['type'] ?>: http://ogp.me/ns/<?php echo $meta['type'] ?>#">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="content-type"     content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible"  content="IE=edge,chrome=1">
    <title><?php echo $meta['title'] ?></title>
    <meta name="viewport"               content="width=device-width, initial-scale=1.0">
    <meta name="description"            content="<?php echo $meta['description'] ?>">

    <meta property="og:url"             content="<?php echo $meta['link'] ?>">
    <meta property="og:title"           content="<?php echo $meta['title'] ?>">
    <meta property="og:description"     content="<?php echo $meta['description'] ?>">
    <meta property="og:image"           content="<?php echo $meta['image'] ?>">
    <meta property="og:site_name"       content="<?php echo LOGO ?>">
    <meta property="og:type"            content="<?php echo $meta['type'] ?>">

    <?php if ( is_single() ): ?>
    <meta property="article:published_time" content="<?php echo get_the_date('c') ?>">
    <meta property="article:modified_time" content="<?php echo get_the_modified_date('c') ?>">

    <?php
    $terms = get_the_terms(0, 'post_tag');
    if ($terms !== false) {
      foreach ($terms as $term) {
        echo "\t\t<meta property=\"article:tag\" content=\"" . esc_attr($term->name) . "\">\n";
      }
    }
    ?>

    <?php endif; ?>
    <!-- <meta property="fb:admins"          content="<?php echo get_theme_mod( 'zero_og_fb' ); ?>" /> -->

    <meta name="twitter:card"           value="summary">
    <meta name="twitter:site"           value="<?php echo TWITTER ?>">
    <meta name="twitter:creator"        value="<?php echo TWITTER ?>">
    <meta name="twitter:domain"         value="http://<?php echo $_SERVER['SERVER_NAME']; ?>">

    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>

    <?php
    $vk_like = trim( get_theme_mod( 'zero_og_vk_like' ) );
    if ( $vk_like ) {
      $vk_like = preg_match_all('/\d+/', $vk_like, $matches );
      $vk_like = $matches[0][1];
      ?>
      <script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
      <script type="text/javascript">
        VK.init({apiId: <?php echo $vk_like ?>, onlyWidgets: true});
      </script>
      <?php
    }

    ?>
    <?php wp_head() ?>
  </head>
  <body class="body <?php echo ( $is_mosaic ? 'body--mosaic' : '' ) ?> <?php echo ( ( is_page() || $is_mosaic ) ? 'body--white' : '' ) ?> <?php echo ( get_theme_mod( 'zero_theme_layout' ) == 'center' ? 'body--center' : '' ) ?>">