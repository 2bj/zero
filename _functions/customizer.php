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
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
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
			'title'			=> 'Внешний вид',
			'priority'	=> 200
		)
	);

	/**
	 * Настройка фонового цвета
	 */
	$wp_customize->add_setting(
		'zero_theme_color',
		array(
			'default'	=> '#ed1c24'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'active_color',
			array(
				'label'			=> __( 'Акцидентный цвет', 'zero' ),
				'section'		=> 'zero_theme',
				'settings'	=> 'zero_theme_color'
			)
		)
	);

	/**
	 * Настройка фонового цвета
	 */
	$wp_customize->add_setting(
		'zero_theme_bg',
		array(
			'default'	=> '#e1e1e1'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'bg_color',
			array(
				'label'			=> __( 'Фоновый цвет', 'zero' ),
				'section'		=> 'zero_theme',
				'settings'	=> 'zero_theme_bg'
			)
		)
	);

	/**
	 * Настройка фоновой картинки
	 */
	$wp_customize->add_setting(
		'zero_theme_bg_image',
		array()
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'zero_theme_bg_image',
			array(
				'label'          => __( 'Фоновая картинка', 'zero' ),
				'section'        => 'zero_theme',
				'settings'       => 'zero_theme_bg_image',
			)
		)
	);

	/**
	 * Настройка фоновой картинки
	 */
	$wp_customize->add_setting(
		'zero_theme_bg_image_position',
		array(
			'default'		=> 'center',
		)
	);
	$wp_customize->add_control(
		'zero_theme_bg_image_position',
		array(
			'section'  => 'zero_theme',
			'label'    => 'Выравнивание фоновой картинки',
			'type'     => 'radio',
			'choices'  => array(
				'center'   => 'По центру',
				'topleft'    => 'Сверху слева',
				'topright'   => 'Сверху справа'
			)
		)
	);

	/**
	 * Настройка фоновой картинки
	 */
	$wp_customize->add_setting(
		'zero_theme_bg_image_repeat',
		array(
			'default'		=> 'no-repeat',
		)
	);
	$wp_customize->add_control(
		'zero_theme_bg_image_repeat',
		array(
			'section'  => 'zero_theme',
			'label'    => 'Повторение фоновой картинки',
			'type'     => 'radio',
			'choices'  => array(
				'no-repeat'   => 'Не повторять',
				'repeat-x'    => 'Повторять по горизонтали',
				'repeat-y'    => 'Повторять по вертикали',
				'repeat'    => 'Замостить',
			)
		)
	);

	/**
	 * Настройка фоновой картинки
	 */
	$wp_customize->add_setting(
		'zero_theme_bg_image_fixed',
		array(
			'default'		=> 'no-fixed',
		)
	);
	$wp_customize->add_control(
		'zero_theme_bg_image_fixed',
		array(
			'section'  => 'zero_theme',
			'label'    => 'Фиксирование фоновой картинки',
			'type'     => 'radio',
			'choices'  => array(
				'no-fixed'   => 'Скроллить',
				'fixed'    => 'Фиксировать',
			)
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
			'label'    => 'Выравнивание содержимого',
			'type'     => 'radio',
			'choices'  => array(
				'left'    => 'Влево',
				'center'   => 'По центру'
			)
		)
	);

	/**
	 * Секция «Open Graph»
	 */
	$wp_customize->add_section(
		'zero_og',
		array(
			'title'			=> 'Лайки, комменты и т. д.',
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
			'label'		=> 'Твиттер юзернейм',
			'type'		=> 'text'
		)
	);

	/**
	 * Настройка fb:admins
	 */
	$wp_customize->add_setting(
		'zero_og_fb',
		array()
	);
	$wp_customize->add_control(
		'zero_og_fb',
		array(
			'section'	=> 'zero_og',
			'label'		=> 'Фейсбук ID',
			'type'		=> 'text'
		)
	);

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
				'label'          => __( 'Картинка для расшаривания', 'zero' ),
				'section'        => 'zero_og',
				'settings'       => 'zero_og_image',
			)
		)
	);

	/**
	 * Настройка apiId для ВК-лайков
	 */
	$wp_customize->add_setting(
		'zero_og_vk',
		array(
			'default'	=> ''
		)
	);
	$wp_customize->add_control(
		'zero_og_vk',
		array(
			'section'	=> 'zero_og',
			'label'		=> 'apiId для ВК-лайков',
			'type'		=> 'text'
		)
	);

	/**
	 * Настройка apiId для ВК-лайков
	 */
	$wp_customize->add_setting(
		'zero_og_fb_appId',
		array(
			'default'	=> ''
		)
	);
	$wp_customize->add_control(
		'zero_og_fb_appId',
		array(
			'section'	=> 'zero_og',
			'label'		=> 'appId для FB-лайков',
			'type'		=> 'text'
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
			'label'		=> 'Логин сайта на Disqus',
			'type'		=> 'text'
		)
	);

	/**
	 * Секция «Admin panel»
	 */
	$wp_customize->add_section(
		'zero_admin',
		array(
			'title'			=> 'Админка',
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
			'label'     => 'Убрать в админке лишнее',
			'type'      => 'checkbox',
		)
	);

	/**
	 * Секция кодов аналитики
	 */
	$wp_customize->add_section(
		'zero_footer',
		array(
			'title'			=> 'Код аналитики',
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
				'label'   => 'Код счетчика',
				'section' => 'zero_footer'
			)
		)
	);

	/**
	 * Секция кастомного CSS
	 */
	$wp_customize->add_section(
		'zero_css',
		array(
			'title'			=> 'Кастомный CSS',
			'priority'	=> 200
		)
	);

	/**
	 * Код счетчика
	 */
	$wp_customize->add_setting(
		'zero_css_code',
		array(
			'default'	=> ''
		)
	);

	$wp_customize->add_control(
		new OF_Textarea_Control(
			$wp_customize,
			'zero_css_code',
			array(
				'label'   => 'CSS',
				'section' => 'zero_css'
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
		.jaxtag .howto,
		.misc-pub-visibility {
			display: none !important;
		}
	</style>
	<?php
}