<?php

/**
 * Загружаем переводы
 */
load_theme_textdomain( 'zero', get_template_directory() . '/languages' );


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
  define( 'SHARE', get_theme_mod( 'zero_og_image' ) );
  define( 'TWITTER', get_theme_mod( 'zero_og_twitter' ) );
}

function merge_meta( $meta ) {
  if ( !isset( $meta ) ) {
    $meta = array();
  }
  $meta_default = array(
    'title'       => trim( wp_title( '', false ) ),
    'description' => LOGO,
    'image'       => SHARE,
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

  wp_register_script( 'scripts', FRONT . '/assets/scripts/scripts.js', array(), 0.91, true );
  wp_register_style( 'styles', FRONT . '/assets/styles/styles.css', null, 0.91, 'screen' );

  wp_enqueue_script( 'scripts' );
  wp_enqueue_style( 'styles' );
}

// add_action( 'admin_enqueue_scripts', 'zero_wp_admin_style' );
// function zero_wp_admin_style() {
//   wp_register_script( 'zero_admin', FRONT . '/assets/scripts/admin.js', array(  ), 1.0, true );
//   wp_enqueue_script( 'zero_admin' );
// }

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

/**
 * Если в результатах поиска только один пост, делаем редирект прямо на него
 */
add_action( 'template_redirect', 'redirect_single_post' );
function redirect_single_post() {
  if ( is_search() ) {
    global $wp_query;
    if ( $wp_query->post_count == 1 ) {
      wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
    }
  }
}

/**
 * Пару опций
 */
add_action( 'init', 'zero_enhancements' );
function zero_enhancements() {

  // Убиваем смайлы
  update_option('use_smilies', 0 );

  // Убираем умные кавычки, потому что от их автоматической расстановки только проблемы
  remove_filter('the_content', 'wptexturize');
}