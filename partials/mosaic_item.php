<?php
$mosaic_data = array(
  'permalink' => get_the_permalink(),
  'title' => get_the_title(),
  'img_src' => str_img_src( get_the_content() )
);
?>
<div class="mosaic__item <?php echo ( $i == 1 ? 'mosaic__item--xxl' : '' ) ?> <?php echo ( $i % 6 == 0 ? 'mosaic__item--xl' : '' ) ?>">
  <a href="<?php echo $mosaic_data['permalink'] ?>" title="<?php echo $mosaic_data['title']; ?>" style="background-image: url(<?php echo $mosaic_data['img_src'] ?>)" class="teaser <?php echo ( $mosaic_data['img_src'] ? '' : 'teaser--noimage' ) ?>">
    <div class="teaser__title"><?php echo $mosaic_data['title']; ?></div>
  </a>
</div>