<?php

/**
 * Делаем палитру стилей в визивиге на всю катушку
 */
add_action('admin_head', 'custom_styles');
function custom_styles() {
	?>
	<style type="text/css">
		.wp_themeSkin .mceListBoxMenu {
			overflow: visible !important;
			overflow-x: visible !important;
		}
	</style>
	<?php
}

/**
 * Стили редактора брать из editor-style.css
 */
add_action( 'init', 'zero_add_editor_styles' );
function zero_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}

/**
 * Добавляем стили и классы в палитру пресетов
 */
add_filter( 'tiny_mce_before_init', 'zero_mce_before_init' );
function zero_mce_before_init( $settings ) {

	$style_formats = array(
		array(
			'title' => 'Абзац',
			'selector' => 'p'
		),
		array(
			'title' => 'Лидовый абзац',
			'selector' => 'p',
			'classes' => 'lead'
		),
		array(
			'title' => 'Цитата',
			'block' => 'blockquote'
		),
		array(
			'title' => 'Заголовок 2',
			'block' => 'h2'
		),
		array(
			'title' => 'Заголовок 2 без полей',
			'block' => 'h2',
			'classes' => 'no-margins'
		),
		array(
			'title' => 'Заголовок 3',
			'block' => 'h3'
		),
		array(
			'title' => 'Заголовок 3 без полей',
			'block' => 'h3',
			'classes' => 'no-margins'
		),
		array(
			'title' => 'Заголовок 3 светлый',
			'block' => 'h3',
			'classes' => 'light'
		),
		array(
			'title' => 'Мелкий кегль',
			'block' => 'p',
			'classes' => 'small-text'
		),
		array(
			'title' => 'Крупный капс',
			'block' => 'p',
			'classes' => 'large-text'
		),
		array(
			'title' => 'Мелкий капс',
			'inline' => 'span',
			'classes' => 'caps'
		),
		array(
			'title' => 'Подпись к картинке',
			'block' => 'p',
			'classes' => 'caption'
		),
		array(
			'title' => 'Код',
			'block' => 'div',
			'classes' => 'code'
		),
		array(
			'title' => 'Медиа с полями',
			'block' => 'p',
			'classes' => 'with-margins'
		),
		array(
			'title' => 'Врезка слева',
			'block' => 'div',
			'classes' => 'inset-left'
		),
		array(
			'title' => 'Врезка справа',
			'block' => 'div',
			'classes' => 'inset-right'
		),
		array(
			'title' => 'Линейка',
			'block' => 'div',
			'classes' => 'hr'
		),
		array(
			'title' => 'Фоторама',
			'block' => 'div',
			'classes' => 'slider'
		)
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}

// add_filter( "mce_plugins", "extended_editor_mce_plugins", 0);
// function extended_editor_mce_plugins( $plugins ) {
// 	array_push( $plugins, 'table' );
// 	return $plugins;
// }

add_filter("mce_buttons", "extended_editor_mce_buttons", 0);
function extended_editor_mce_buttons( $buttons ) {
	return array(
		'styleselect', 'bold', 'italic', 'bullist', 'numlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'unlink', 'anchor', 'sup', 'sub', 'charmap'
	);
}

add_filter("mce_buttons_2", "extended_editor_mce_buttons_2", 0);
function extended_editor_mce_buttons_2( $buttons ) {
	return array(
		// 'tablecontrols'
	);
}