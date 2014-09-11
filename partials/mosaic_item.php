<?php
$mosaic_data = array(
  'permalink' => get_the_permalink(),
  'title' => get_the_title()
);

$size = '';
if ( $i == 1 ) {
  $size = 'xxl';
}
if ( $i % 6 == 0 ) {
  $size = 'xl';
}

$cover = wp_get_attachment_image_src( get_post_thumbnail_id(), '960x', true);

if ( strstr( $cover[0], 'images/media/default' ) ) {
  $cover = str_img_src( get_the_content() );
} else {
  $cover = $cover[0];
}
$mosaic_data['img_src'] = $cover;

?>
<div class="mosaic__item <?php echo ( $size ? 'mosaic__item--' . $size : '' ) ?>">
  <a href="<?php echo $mosaic_data['permalink'] ?>" title="<?php echo strip_tags( $mosaic_data['title'] ); ?>" style="background-image: url(<?php echo $mosaic_data['img_src'] ?>)" class="teaser <?php echo ( $mosaic_data['img_src'] ? '' : 'teaser--noimage' ) ?>">
    <div class="teaser__title"><?php echo $mosaic_data['title']; ?></div>
  </a>
</div>