<div class="blog__item">

	<style>

	<?php if ( $metaboxes['of_color_text'][0] || $metaboxes['of_color_bg'][0] ) : ?>
	#post-<?php echo $id ?> {
		<?php
		echo ( $metaboxes['of_color_text'][0] ? 'color: ' . $metaboxes['of_color_text'][0] . '; ' : '' );
		echo ( $metaboxes['of_color_bg'][0] ? 'background-color: ' . $metaboxes['of_color_bg'][0] . '; ' : '' );
		?>
	}
	<?php endif; ?>

	<?php if ( $metaboxes['of_color_link'][0] ) : ?>
	#post-<?php echo $id ?> a {
		<?php
		echo ( $metaboxes['of_color_link'][0] ? 'color: ' . $metaboxes['of_color_link'][0] . '; ' : '' );
		?>
	}
	<?php endif; ?>

	<?php if ( $metaboxes['of_color_link_hover'][0] ) : ?>
	#post-<?php echo $id ?> a:hover {
		<?php
		echo ( $metaboxes['of_color_link_hover'][0] ? 'color: ' . $metaboxes['of_color_link_hover'][0] . '; ' : '' );
		?>
	}
	<?php endif; ?>

	<?php if ( $metaboxes['of_color_text'][0] || $metaboxes['of_color_header'][0] ) : ?>
	#post-<?php echo $id ?> .post__title {
		<?php
		echo ( $metaboxes['of_color_text'][0] ? 'color: ' . $metaboxes['of_color_text'][0] . ' !important; ' : '' );
		echo ( $metaboxes['of_color_header'][0] ? 'color: ' . $metaboxes['of_color_header'][0] . ' !important; ' : '' );
		?>
	}
	<?php endif; ?>

	<?php if ( $metaboxes['of_color_text'][0] || $metaboxes['of_color_header'][0] ) : ?>
	#post-<?php echo $id ?> .post__title a {
		<?php
		echo ( $metaboxes['of_color_text'][0] ? 'color: ' . $metaboxes['of_color_text'][0] . ' !important; ' : '' );
		echo ( $metaboxes['of_color_header'][0] ? 'color: ' . $metaboxes['of_color_header'][0] . ' !important; ' : '' );
		?>
	}
	<?php endif; ?>

	<?php if ( $metaboxes['of_color_header_hover'][0] ) : ?>
	#post-<?php echo $id ?> .post__title a:hover {
		<?php
		echo ( $metaboxes['of_color_header_hover'][0] ? 'color: ' . $metaboxes['of_color_header_hover'][0] . ' !important; ' : '' );
		?>
	}
	<?php endif; ?>

	<?php if ( $metaboxes['of_color_lead'][0] ) : ?>
	#post-<?php echo $id ?> .post__lead {
		<?php
		echo ( $metaboxes['of_color_lead'][0] ? 'color: ' . $metaboxes['of_color_lead'][0] . '; ' : '' );
		?>
	}
	<?php endif; ?>
	</style>

	<div class="post" id="post-<?php echo $id ?>">

		<div class="post__header <?php echo ( $cover_type == 'cover' ? ' post__header--cover ' : '' ); ?>" <?php echo ( $cover_type == 'cover' ? ' style="background-image: url(' . $cover . ')" ' : '' ); ?>>

			<h1 class="post__title">

				<?php if ( ! is_single() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo strip_tags( $title ) ?>">
					<?php echo ( $hidden_title ? '<br />' : $title )  ?>
				</a>

				<?php else: ?>
				<span>
					<?php echo ( $hidden_title ? '<br />' : $title )  ?>
				</span>
				<?php endif; ?>

			</h1>

			<div class="post__meta">
				<div class="post__share">
					<?php require( 'share.php' ); ?>
				</div>
			</div>

			<?php if ( $lead ) : ?>
			<div class="post__lead" >
				<?php echo $lead ?>
			</div>
			<?php endif; ?>

		</div>

		<?php if ( $cover_type && $cover_type == 'under' ) : ?>
		<div class="post__cover">
			<img src="<?php echo $cover ?>" alt="<?php echo $title ?>" />
		</div>
		<?php endif; ?>

		<?php if ( trim( get_the_content() ) ) : ?>
		<div class="post__body">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>

	</div>
</div>