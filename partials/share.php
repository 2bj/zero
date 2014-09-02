<?php

$post_item = array(
  'id' => get_the_ID(),
  'link' => get_the_permalink(),
  'title' => strip_tags( $title ) . '. ' . LOGO,
  'image' => SHARE
);

$post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), '960x', true);
if ( strstr( $post_image[0], 'images/media/default' ) ) {
  $post_image = str_img_src( get_the_content() );
} else {
  $post_image = $post_image[0];
}

if ( $post_image ) {
  $post_item['image'] = $post_image;
}

?>

<div class="share" data-url="<?php echo $post_item['link'] ?>" data-twitter="<?php echo ( TWITTER ? 'yep' : '' ) ?>" data-facebook="<?php echo ( get_theme_mod( 'zero_og_fb_like' ) ? 'yep' : '' ) ?>" data-vkontakte="<?php echo ( get_theme_mod( 'zero_og_vk_like' ) ? 'yep' : '' ) ?>">
  <div class="share__caller">
    <div class="share__count"></div>
    <div class="share__heart">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" fill="#e1e1e1" d="M12.526,11.856c-1.079,1.111-3.205,2.872-3.474,3.148c-0.274-0.277-2.441-2.037-3.541-3.148c-1.293-1.307-2.513-2.653-2.513-4.501c0-1.849,1.483-3.347,3.313-3.347c1.14,0,2.146,0.582,2.741,1.468c0.585-0.886,1.571-1.468,2.69-1.468c1.795,0,3.25,1.499,3.25,3.347C14.992,9.204,13.796,10.549,12.526,11.856z"/>
      </svg>
    </div>
  </div>
  <div class="share__wrapper">

    <?php if ( $fb_like ): ?>
    <div class="share__item share__item--fb">
      <div class="fb-like" data-href="<?php echo $post_item['link'] ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
    </div>
    <?php endif; ?>

    <?php if ( $vk_like ): ?>
    <div class="share__item share__item--vk">
      <div id="vk_like_<?php echo $post_item['id'] ?>"></div>
      <script type="text/javascript">
      VK.Widgets.Like("vk_like_<?php echo $post_item['id'] ?>", {
        type: "mini",
        height: 20,
        pageUrl: "<?php echo $post_item['link'] ?>",
        pageTitle: "<?php echo $post_item['title'] ?>",
        pageDescription: "<?php echo LOGO ?>",
        pageImage: "<?php echo $post_item['image'] ?>"
      });
      </script>
    </div>
    <?php endif; ?>

    <div class="share__item share__item--tw">
      <a lang="en" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $post_item['link'] ?>" data-text="<?php echo $post_item['title'] ?>">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>
  </div>
</div>