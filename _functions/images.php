<?php

/**
 * Медиабраузер. Нет ссылки, нет выравнивания
 */
update_option('image_default_align', 'none' );
update_option('image_default_link_type', 'none' );
update_option('image_default_size', 'large' );

/**
 * Добавить поддержку миниатюр в тип контента
 */
add_theme_support( 'post-thumbnails', array( 'post' ) );

/**
 * Качество генерируемых картинок
 */
add_filter( 'jpeg_quality', 'zero_jpeg_quality' );
function zero_jpeg_quality() {
	return 100;
}

/**
 * Кастомные пресеты для превьюшек
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( '960x', '1920', '99999', false );
	add_image_size( '240x', '480', '99999', false );
}

/**
 * Показываем кастомные пресеты картинок в медиабраузере
 */
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
	$custom_sizes = array(
		'960x' => '960 по ширине',
		'240x' => '240 по ширине'
	);
	return array_merge( $sizes, $custom_sizes );
}