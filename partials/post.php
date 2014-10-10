<?php

$cover = wp_get_attachment_image_src( get_post_thumbnail_id(), '960x', true);
if ( strstr( $cover[0], 'images/media/default' ) ) {
  $cover = false;
} else {
  $cover = $cover[0];
}
$title = get_the_title();

$metaboxes = get_post_custom( $post->ID );

$hidden_title = false;
if ( isset( $metaboxes['of_header'] ) ) {
  $hidden_title = unserialize( $metaboxes['of_header'][0] );
  if ( $hidden_title[0] == 'title_no' || !trim( $title ) ) {
    $hidden_title = true;
  }
}

$link_tag = 'a';
if ( is_single() ) {
  $link_tag = 'div';
}

$lead = '';
$link = get_the_permalink();

if ( isset( $metaboxes['of_lead'] ) ) {
  $url_regexp = '(^http\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(/\S*)?$)';
  $lead = $metaboxes['of_lead'][0];
  if ( preg_match( $url_regexp, $lead) ) {
    $link = $lead;
    $lead = '';
    $link_tag = 'a';
  }
}

?>

    <section class="post <?php echo ( is_page() ? 'post--page' : '' ) ?> <?php echo ( $hidden_title ? 'post--notitle' : '' ) ?>">

      <?php if ( $title && $cover ): ?>

      <<?php echo $link_tag ?> href="<?php echo $link ?>" style="background-image: url('<?php echo $cover ?>')" class="post__header post__header--cover">

        <?php if ( !$hidden_title ): ?>
        <div class="post__title">
          <h1>
            <?php echo $title ?>
          </h1>
        </div>
        <?php endif; ?>

        <?php if ( $lead ): ?>
        <div class="post__lead">
          <?php echo $lead; $lead = ''; ?>
        </div>
        <?php endif; ?>

      </<?php echo $link_tag ?>>

      <?php elseif ( $title && !$cover ): ?>

      <?php if ( !$hidden_title ): ?>
      <header class="post__header">
        <div class="post__title">
          <h1>
            <<?php echo $link_tag ?> href="<?php echo $link ?>" title="<?php echo $title ?>"><?php echo $title ?></<?php echo $link_tag ?>>
          </h1>
        </div>
      </header>
      <?php endif; ?>

      <?php elseif ( !$title && $cover ): ?>

      <<?php echo $link_tag ?> href="<?php echo $link ?>" style="background-image: url('<?php echo $cover ?>')" class="post__header post__header--cover">
        <?php if ( $lead ): ?>
        <div class="post__lead">
          <?php echo $lead; $lead = ''; ?>
        </div>
        <?php endif; ?>
      </<?php echo $link_tag ?>>

      <?php endif; ?>

      <?php if ( is_page() ): ?>

      <?php else: ?>
      <div class="post__share">
        <?php require( 'share.php' ) ?>
      </div>
      <?php endif; ?>

      <?php if ( trim( get_the_content() ) || trim( $lead ) ) : ?>
      <article class="post__content">
        <?php if ( $lead ) : ?>
          <p class="caps"><?php echo $lead; $lead = '' ?></p>
        <?php endif; ?>
        <?php the_content( __( 'Read More', 'zero' ) ); ?>
      </article>
      <?php endif; ?>

    </section>