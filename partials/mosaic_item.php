<?php
$mosaic_data = array(
  'permalink' => get_the_permalink(),
  'title' => get_the_title()
);

$cover = wp_get_attachment_image_src( get_post_thumbnail_id(), '960x', true);
if ( strstr( $cover[0], 'images/media/default' ) ) {
  $cover = str_img_src( get_the_content() );
} else {
  $cover = $cover[0];
}
$mosaic_data['img_src'] = $cover;

?>
<div class="mosaic__item <?php echo ( $i == 1 ? 'mosaic__item--xxl' : '' ) ?> <?php echo ( $i % 6 == 0 ? 'mosaic__item--xl' : '' ) ?>">
  <a href="<?php echo $mosaic_data['permalink'] ?>" title="<?php echo $mosaic_data['title']; ?>" style="background-image: url(<?php echo $mosaic_data['img_src'] ?>)" class="teaser <?php echo ( $mosaic_data['img_src'] ? '' : 'teaser--noimage' ) ?>">
    <div class="teaser__title"><?php echo $mosaic_data['title']; ?></div>
  </a>
</div>