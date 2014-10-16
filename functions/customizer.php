<?php

/**
 * Кастомайзер
 */

add_action( 'customize_register', 'zero_register_theme_customizer' );
function zero_register_theme_customizer( $wp_customize ) {


	class OF_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo $this->label; ?></span>
			<textarea rows="10" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_control( 'blogdescription' );

	/**
	 * Секция «Внешний вид»
	 */
	$wp_customize->add_section(
		'zero_theme',
		array(
			'title'			=> __( 'Layout', 'zero'),
			'priority'	=> 200
		)
	);

	/**
	 * Настройка лейаута
	 */
	$wp_customize->add_setting(
		'zero_theme_layout',
		array(
			'default'		=> 'left',
		)
	);

	$wp_customize->add_control(
		'zero_theme_layout',
		array(
			'section'  => 'zero_theme',
			'label'    => __( 'Layout alignment', 'zero'),
			'type'     => 'radio',
			'choices'  => array(
				'left'    => __( 'To left', 'zero' ),
				'center'   => __( 'To center', 'zero' )
			)
		)
	);

  /**
   * Матричный вид
   */
  $wp_customize->add_setting(
    'zero_theme_mosaic',
    array(
      'default'   => 'Photo, Live',
    )
  );

  $wp_customize->add_control(
    'zero_theme_mosaic',
    array(
      'section'  => 'zero_theme',
      'label'    => __( 'Comma separated list of tags with matrix layout on its archive page', 'zero'),
      'type'     => 'text'
    )
  );

	/**
	 * Секция «Open Graph»
	 */
	$wp_customize->add_section(
		'zero_og',
		array(
			'title'			=> __( 'Likes, comments, etc.', 'zero' ),
			'priority'	=> 200
		)
	);

	/**
	 * Настройка twitter:card
	 */
	$wp_customize->add_setting(
		'zero_og_twitter',
		array(
			'default'	=> '@'
		)
	);
	$wp_customize->add_control(
		'zero_og_twitter',
		array(
			'section'	=> 'zero_og',
			'label'		=> __( 'Twitter username', 'zero' ),
			'type'		=> 'text'
		)
	);

	/**
	 * Настройка fb:admins
	 */
	// $wp_customize->add_setting(
	// 	'zero_og_fb',
	// 	array()
	// );
	// $wp_customize->add_control(
	// 	'zero_og_fb',
	// 	array(
	// 		'section'	=> 'zero_og',
	// 		'label'		=> __( 'Your Facebook ID', 'zero' ),
	// 		'type'		=> 'text'
	// 	)
	// );

	/**
	 * Настройка og:image
	 */
	$wp_customize->add_setting(
		'zero_og_image',
		array()
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zero_og_image',
			array(
				'label'          => __( 'Share picture', 'zero' ),
				'section'        => 'zero_og',
				'settings'       => 'zero_og_image',
			)
		)
	);

	/**
	 * Настройка apiId для ВК-лайков
	 */
	$wp_customize->add_setting(
		'zero_og_vk_like',
		array(
			'default'	=> ''
		)
	);
	$wp_customize->add_control(
    new OF_Textarea_Control(
      $wp_customize,
      'zero_og_vk_like',
      array(
        'label'   => __( 'VK.com Like widget. Paste code <a href="http://vk.com/dev/Like">from here</a>', 'zero' ),
        'section' => 'zero_og'
      )
    )
	);

  $wp_customize->add_setting(
    'zero_og_fb_like',
    array(
      'default' => ''
    )
  );
  $wp_customize->add_control(
    new OF_Textarea_Control(
      $wp_customize,
      'zero_og_fb_like',
      array(
        'label'   => __( 'Facebook Like widget. Paste first part of code <a href="https://developers.facebook.com/docs/plugins/like-button/">from here</a>', 'zero' ),
        'section' => 'zero_og'
      )
    )
  );

	/**
	 * Настройка Disqus
	 */
	$wp_customize->add_setting(
		'zero_og_disqus',
		array(
			'default'	=> ''
		)
	);
	$wp_customize->add_control(
		'zero_og_disqus',
		array(
			'section'	=> 'zero_og',
			'label'		=> __( 'Disqus username', 'zero' ),
			'type'		=> 'text'
		)
	);

	/**
	 * Секция «Admin panel»
	 */
	$wp_customize->add_section(
		'zero_admin',
		array(
			'title'			=> __( 'Admin panel', 'zero' ),
			'priority'	=> 200
		)
	);

	$wp_customize->add_setting(
		'zero_admin_simplify',
		array(
			'default'	=> ''
		)
	);
	$wp_customize->add_control(
		'zero_admin_simplify',
		array(
			'section'   => 'zero_admin',
			'label'     => __( 'Simplify admin panel', 'zero' ),
			'type'      => 'checkbox',
		)
	);

	/**
	 * Секция кодов аналитики
	 */
	$wp_customize->add_section(
		'zero_footer',
		array(
			'title'			=> __( 'Counters code', 'zero' ),
			'priority'	=> 200
		)
	);

	/**
	 * Код счетчика
	 */
	$wp_customize->add_setting(
		'zero_footer_code',
		array(
			'default'	=> ''
		)
	);

	$wp_customize->add_control(
		new OF_Textarea_Control(
			$wp_customize,
			'zero_footer_code',
			array(
				'label'   => __( 'Counters code', 'zero' ),
				'section' => 'zero_footer'
			)
		)
	);

}


if ( get_theme_mod( 'zero_admin_simplify' ) ) {

	/**
	 * Чистим меню от левака
	 */
	add_action( 'admin_menu', 'zero_admin_links' );
	function zero_admin_links() {

		global $menu;
		global $submenu;

		remove_menu_page( 'index.php' );
		remove_menu_page( 'upload.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'users.php' );

		unset($submenu['themes.php'][5]);
	}

	/**
	 * Убираем ненужные колонки у списка постов
	 */
	add_filter( 'manage_edit-post_columns', 'zero_posts_table_columns', 10, 1 );
	function zero_posts_table_columns( $columns ) {
		unset( $columns['author'] );
		unset( $columns['tags'] );
		unset( $columns['categories'] );
		unset( $columns['tags'] );
		return $columns;
	}

	/**
	 * Убираем ненужные колонки у списка страниц
	 */
	add_filter( 'manage_pages_columns', 'zero_pages_table_columns' );
	function zero_pages_table_columns( $columns ) {
		unset( $columns['author'] );
		unset( $columns['comments'] );
		return $columns;
	}

	/**
	 * Чистим страницу редактирования профиля
	 */
	if( is_admin() ) {
		remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
		add_action( 'personal_options', 'zero_hide_personal_options' );
	}
	function zero_hide_personal_options() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function( $ ){
			$( '#your-profile .form-table:first, #your-profile h3').remove();
			$( '#your-profile textarea#description' ).parents( 'tr' ).remove();
			$( '#your-profile input#url' ).parents( 'tr' ).remove();
		});
	</script>
	<?php
	}

	/**
	 * Показываем список постов вместо дашборда
	 */
	if( is_admin() ) {
		if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) ) {
			wp_redirect( 'edit.php' );
		}
	}

	/**
	 * Убираем мусор
	 */
	if ( user_can( wp_get_current_user(), 'administrator' ) ) {
		add_action( 'wp_head', 'zero_remove_separators' );
	}
	add_action( 'admin_head', 'zero_remove_separators' );
	function zero_remove_separators() {
		?>
		<style type="text/css">
			#screen-meta-links,
			.wp-menu-separator,
			#wp-admin-bar-wp-logo,
			#wp-admin-bar-comments,
			#wp-admin-bar-site-name .ab-sub-wrapper,
			#wp-admin-bar-new-content .ab-sub-wrapper {
				display: none !important;
			}
		</style>
		<?php
	}
}

/**
 * Кое-что в админке
 */
add_action( 'admin_head', 'zero_admin_styles' );
function zero_admin_styles() {
	?>
	<style type="text/css">
		.jaxtag input[type="text"] {
			width: 166px;
		}
		#screen-meta-links,
		.autosave-info,
		input#shortlink + a.button,
		.jaxtag .howto {
			display: none !important;
		}
		.metabox-form {

		}
		.metabox-form__item {
			margin-bottom: 15px;
		}
		.metabox-form__label {
			font-weight: bold;
			margin-bottom: 8px;
		}
	</style>
	<?php
}