<?php

/**
 * Убираем мусор из <head>
 */
remove_action( 'wp_head', 'rsd_link' ); // Removes link to RSD + XML
remove_action( 'wp_head', 'wlwmanifest_link' ); // Removes the link to Windows manifest
remove_action( 'wp_head', 'index_rel_link' ); // Removes the index link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Remove relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Remove the XHTML generator link
remove_action( 'wp_head', 'feed_links_extra', 3 ); // This is the main code that removes unwanted RSS Feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Removes Post and Comment Feeds
remove_action( 'wp_head', 'rel_canonical' );

/**
 * Убираем ненужные виджеты
 */
add_action( 'widgets_init', 'remove_unneeded_widgets' );
function remove_unneeded_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}

/**
 * Константы для темы + дефолтные мета-теги
 */
add_action( 'init', 'init_const' );
function init_const() {
	define( 'FRONT', get_template_directory_uri() );
	define( 'LOGO', get_bloginfo( 'name' ) );
}

function merge_meta( $meta ) {
	if ( !isset( $meta ) ) {
		$meta = array();
	}
	$meta_default = array(
		'title'				=> trim( wp_title( '', false ) ),
		'description'	=> LOGO,
		'image'				=> get_theme_mod( 'zero_og_image' ),
	);
	return array_merge( $meta_default, $meta );
}

/**
 * Регистрируем и подключаем стили и скрипты
 */
add_action( 'wp_enqueue_scripts', 'zero_scripts_and_styles' );
function zero_scripts_and_styles() {

	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
	}

	wp_register_script( 'modernizer', FRONT . '/_assets/scripts/vendor/modernizr-2.6.2.min.js', array(  ), 1.0, false );
	wp_register_script( 'jquery', FRONT . '/_assets/scripts/vendor/jquery-1.10.2.min.js', array(  ), 1.0, true );
	wp_register_script( 'fotorama', FRONT . '/_assets/scripts/vendor/fotorama.js', array(  ), 1.0, true );
	wp_register_script( 'social', FRONT . '/_assets/scripts/vendor/social-likes.min.js', array(  ), 1.0, true );
	wp_register_script( 'scripts', FRONT . '/_assets/scripts/scripts.js', array( 'jquery', 'fotorama', 'social'  ), 1.0, true );

	wp_register_style( 'styles', FRONT . '/_assets/styles/styles.css', null, 1.0, 'screen' );

	wp_enqueue_script( 'modernizer' );
	wp_enqueue_script( 'scripts' );
	wp_enqueue_style( 'styles' );
}

add_action( 'admin_enqueue_scripts', 'zero_wp_admin_style' );
function zero_wp_admin_style() {
	wp_register_script( 'zero_admin', FRONT . '/_assets/scripts/admin.js', array(  ), 1.0, true );
	wp_enqueue_script( 'zero_admin' );
}

/**
 * Чистим форму добавления поста
 */
add_action( 'init', 'clear_edit_form' );
function clear_edit_form() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'post', 'excerpt' );
	remove_post_type_support( 'post', 'trackbacks' );
	remove_post_type_support( 'post', 'custom-fields' );
	remove_post_type_support( 'post', 'revisions' );

	// register_taxonomy('post_tag', array());
	register_taxonomy('category', array());
}