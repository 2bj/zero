		<div class="credits">
			<a href="http://cherenkevich.com/zero/" title="Zero by Cherenkevich">Zero by Cherenkevich</a>
		</div>

		<?php
		wp_footer();

		if ( get_theme_mod( 'zero_footer_code' ) ) {
			echo get_theme_mod( 'zero_footer_code' );
		}
		?>

	</body>
</html>