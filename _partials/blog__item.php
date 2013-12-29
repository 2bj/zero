<div class="blog__item">
	<div class="post">

		<div class="post__header <?php echo ( $cover_type == 'cover' ? ' post__header--cover ' : '' ); ?>" <?php echo ( $cover_type == 'cover' ? ' style="background-image: url(' . $cover . ')" ' : '' ); ?>>

			<h1 class="post__title <?php echo ( in_array( 'title_white', unserialize( $metaboxes['of_color'][0] ) ) ? ' post__title--white ' : '' ) ?>">
				<?php if ( ! is_single() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo strip_tags( $title ) ?>">
					<?php echo ( $hidden_title ? '<br />' : $title )  ?>
				</a>
				<?php else: ?>
				<?php echo ( $hidden_title ? '<br />' : $title )  ?>
				<?php endif; ?>
			</h1>

			<div class="post__meta">
				<div class="post__share post__share--<?php echo $metaboxes['of_shares'][0] ?>">
					<?php require( 'share.php' ); ?>
				</div>
			</div>

			<?php if ( $lead ) : ?>
			<div class="post__lead <?php echo ( in_array( 'lead_white', unserialize( $metaboxes['of_color'][0] ) ) ? ' post__lead--white ' : '' ) ?>">
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