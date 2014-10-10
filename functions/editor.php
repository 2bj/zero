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
      'title' => __( 'Paragraph', 'zero' ),
      'selector' => 'p'
    ),
    // array(
    //  'title' => 'Лидовый абзац',
    //  'selector' => 'p',
    //  'classes' => 'lead'
    // ),
    array(
      'title' => __( 'Header', 'zero' ),
      'block' => 'h2'
    ),
    // array(
    //  'title' => 'Заголовок 2 без полей',
    //  'block' => 'h2',
    //  'classes' => 'no-margins'
    // ),
    array(
      'title' => __( 'Subheader', 'zero' ),
      'block' => 'h3'
    ),
    // array(
    //  'title' => 'Заголовок 3 без полей',
    //  'block' => 'h3',
    //  'classes' => 'no-margins'
    // ),
    // array(
    //  'title' => 'Заголовок 3 светлый',
    //  'block' => 'h3',
    //  'classes' => 'light'
    // ),
    array(
      'title' => __( 'Quote', 'zero' ),
      'block' => 'blockquote'
    ),
    array(
      'title' => __( 'Small text', 'zero' ),
      'block' => 'p',
      'classes' => 'small-text'
    ),
    // array(
    //  'title' => 'Крупный капс',
    //  'block' => 'p',
    //  'classes' => 'large-text'
    // ),
    // array(
    //  'title' => 'Мелкий капс',
    //  'inline' => 'span',
    //  'classes' => 'caps'
    // ),
    array(
      'title' => __( 'Image caption', 'zero' ),
      'block' => 'p',
      'classes' => 'caption'
    ),
    array(
      'title' => __( 'Code snippet', 'zero' ),
      'block' => 'div',
      'classes' => 'code'
    ),
    array(
      'title' => __( 'Image with margins', 'zero'),
      'block' => 'p',
      'classes' => 'with-margins'
    ),
    array(
     'title' => __( 'Left inset', 'zero' ),
     'block' => 'div',
     'classes' => 'inset-left'
    ),
    array(
     'title' => __( 'Right inset', 'zero' ),
     'block' => 'div',
     'classes' => 'inset-right'
    ),
    array(
      'title' => __( 'Ruler', 'zero' ),
      'block' => 'div',
      'classes' => 'hr'
    ),
    array(
      'title' => __( 'Fotorama', 'zero' ),
      'block' => 'div',
      'classes' => 'slider'
    ),
    array(
      'title' => __( 'Photoset grid', 'zero' ),
      'block' => 'div',
      'classes' => 'grid'
    )
  );

  $settings['style_formats'] = json_encode( $style_formats );

  return $settings;
}

// add_filter( "mce_plugins", "extended_editor_mce_plugins", 0);
// function extended_editor_mce_plugins( $plugins ) {
//  array_push( $plugins, 'table' );
//  return $plugins;
// }
//
function my_mce_external_plugins($plugins) {
    $plugins['anchor'] = FRONT . '/assets/scripts/tinymce/js/tinymce/plugins/anchor/plugin.min.js';
    $plugins['table'] = FRONT . '/assets/scripts/tinymce/js/tinymce/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter('mce_external_plugins', 'my_mce_external_plugins');

add_filter("mce_buttons", "extended_editor_mce_buttons", 0);
function extended_editor_mce_buttons( $buttons ) {
  return array(
    'styleselect', 'bold', 'italic','strikethrough', 'bullist', 'numlist', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink', 'anchor', 'superscript', 'subscript', 'charmap', 'wp_more', 'table'
  );
}

add_filter("mce_buttons_2", "extended_editor_mce_buttons_2", 0);
function extended_editor_mce_buttons_2( $buttons ) {
  return array(
    // 'tablecontrols'
  );
}