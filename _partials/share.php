<?php

$counter = 0;
$post_item = array(
	'id' => get_the_ID(),
	'link' => get_permalink(),
	'title' => strip_tags( $title ),
	'image' => $cover,
);

if ( trim( get_theme_mod( 'zero_og_fb_appId' ) ) ) {
	$fb = json_decode( file_get_contents( 'http://graph.facebook.com/' . $post_item['link'] ) );
	if ( is_numeric( $fb->shares ) ) {
		$counter += $fb->shares;
	}
}

if ( trim( get_theme_mod( 'zero_og_vk' ) ) ) {
	$vk = json_decode( file_get_contents( 'https://api.vk.com/method/likes.getList?type=sitepage&owner_id=' . get_theme_mod( 'zero_og_vk' ) . '&page_url=' . $post_item['link'] ) );
	if ( is_numeric( $vk->response->count ) ) {
		$counter += $vk->response->count;
	}
}

$twitter = json_decode( file_get_contents( 'http://urls.api.twitter.com/1/urls/count.json?url=' . $post_item['link'] ) );
if ( is_numeric( $twitter->count ) ) {
	$counter += $twitter->count;
}

?>
<div class="share">
	<div class="share__buttons">

		<?php if ( trim( get_theme_mod( 'zero_og_fb_appId' ) ) ) : ?>
		<div class="share__item">
			<div class="fb-like" data-href="<?php echo $post_item['link'] ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		</div>
		<?php endif; ?>

		<?php if ( trim( get_theme_mod( 'zero_og_vk' ) ) ) : ?>
		<div class="share__item">
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

		<div class="share__item">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $post_item['link'] ?>" data-text="<?php echo $post_item['title'] ?>" data-via="<?php echo str_replace( "@", "", get_theme_mod( 'zero_og_twitter' ) ) ?>">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>

	</div>
	<div class="share__caller">
		<div class="share__counter">
			<?php echo ( $counter ? $counter : '' ) ?>
		</div>
		<div class="share__icon">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="18px" height="18px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve">
			<path fill-rule="evenodd" clip-rule="evenodd" fill="#e1e1e1" d="M12.526,11.856c-1.079,1.111-3.205,2.872-3.474,3.148
				c-0.274-0.277-2.441-2.037-3.541-3.148c-1.293-1.307-2.513-2.653-2.513-4.501c0-1.849,1.483-3.347,3.313-3.347
				c1.14,0,2.146,0.582,2.741,1.468c0.585-0.886,1.571-1.468,2.69-1.468c1.795,0,3.25,1.499,3.25,3.347
				C14.992,9.204,13.796,10.549,12.526,11.856z"/>
			</svg>
		</div>
	</div>
</div>