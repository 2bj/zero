<?php

/**
 * Медиабраузер. Нет ссылки, нет выравнивания
 */
update_option('image_default_align', 'none' );
update_option('image_default_link_type', 'none' );
update_option('image_default_size', 'large' );


add_filter( 'media_view_strings', 'custom_media_uploader' );
function custom_media_uploader( $strings ) {
    // unset( $strings['selected'] ); //Removes Upload Files & Media Library links in Insert Media tab
    // unset( $strings['insertMediaTitle'] ); //Insert Media
    // unset( $strings['uploadFilesTitle'] ); //Upload Files
    // unset( $strings['mediaLibraryTitle'] ); //Media Library
    unset( $strings['createGalleryTitle'] ); //Create Gallery
    // unset( $strings['setFeaturedImageTitle'] ); //Set Featured Image
    // unset( $strings['insertFromUrlTitle'] ); //Insert from URL
    return $strings;
}


/**
 * Добавить поддержку миниатюр в тип контента
 */
add_theme_support( 'post-thumbnails', array( 'post' ) );

/**
 * Качество генерируемых картинок
 */
add_filter( 'jpeg_quality', 'zero_jpeg_quality' );
function zero_jpeg_quality() {
  return 80;
}

/**
 * Кастомные пресеты для превьюшек
 */
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( '960x', '1920', '99999', false );
  add_image_size( '640x', '1280', '99999', false );
  add_image_size( '240x', '480', '99999', false );
}

/**
 * Показываем кастомные пресеты картинок в медиабраузере
 */
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
  $custom_sizes = array(
    '960x' => __( '960 by width', 'zero' ),
    '640x' => __( '640 by width', 'zero' ),
    '240x' => __( '240 by width', 'zero' )
  );
  return array_merge( $sizes, $custom_sizes );
}

/**
  * Searches for the first occurence of an html <img> element in a string
  * and extracts the src if it finds it. Returns boolean false in case an
  * <img> element is not found.
  * @param    string  $str    An HTML string
  * @return   mixed           The contents of the src attribute in the
  *                           found <img> or boolean false if no <img>
  *                           is found
  */
function str_img_src( $html ) {
  if (stripos($html, '<img') !== false) {
    $imgsrc_regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
    preg_match($imgsrc_regex, $html, $matches);
    unset($imgsrc_regex);
    unset($html);
    if (is_array($matches) && !empty($matches)) {
      return $matches[2];
    } else {
      return false;
    }
  } else {
    return false;
  }
}