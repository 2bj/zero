<?php
$mosaic_data = array(
  'permalink' => get_the_permalink(),
  'title' => get_the_title()
);

$size = '';
$cover_preset = '240x';
if ( $i == 1 ) {
  $size = 'xxl';
  $cover_preset = '960x';
}
if ( $i % 6 == 0 ) {
  $size = 'xl';
  $cover_preset = '640x';
}

$cover = wp_get_attachment_image_src( get_post_thumbnail_id(), $cover_preset, true);

if ( strstr( $cover[0], 'images/media/default' ) ) {
  $original = $cover = str_img_src( get_the_content() );
  $wp_attach_file = explode( "/", $cover);
  $wp_attach_file = array_slice( array_reverse( $wp_attach_file ), 0, 3 );
  $wp_attach_file = implode( "/", array_reverse( $wp_attach_file) );

  $query = $wpdb->get_results(
    $wpdb->prepare( "SELECT post_id
                      FROM $wpdb->postmeta
                      WHERE meta_key='_wp_attached_file'
                      AND meta_value=%s", $wp_attach_file ) );
  $att_id = $query[0]->post_id;
  $cover = wp_get_attachment_image_src( $att_id, $cover_preset, true);
  // print_r($cover);
  $cover = $cover[0];

  if ( strstr( $cover, 'images/media/default' ) ) {
    $cover = $original;
  }
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