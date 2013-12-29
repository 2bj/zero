<header class="header">
	<div class="header__logo">
		<a href="/" title="На главную" class="logo">
			<?php echo LOGO; ?>
		</a>
	</div>
	<nav class="header__nav">
		<?php
		$defaults = array(
			'menu'				=> 'primary',
			'menu_class'	=> 'nav'
		);
		wp_nav_menu( $defaults );
		?>
	</nav>
</header>