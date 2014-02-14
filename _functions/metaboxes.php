<?php

require 'fields.php';

// Add the Meta Box
function of_cover_add() {
	add_meta_box(
		'of_post_cover', // $id
		'Cover options', // $title
		'of_render_cover', // $callback
		'post', // $page
		'side', // $context
		'default'); // $priority
}
add_action('add_meta_boxes', 'of_cover_add');

function of_render_cover() {
	global $cover_fields;
	show_custom_meta_box( $cover_fields );
}

// Add the Meta Box
function of_color_add() {
	add_meta_box(
		'of_post_color', // $id
		'Color options', // $title
		'of_render_color', // $callback
		'post', // $page
		'side', // $context
		'low'); // $priority
}
add_action('add_meta_boxes', 'of_color_add');

function of_render_color() {
	global $color_fields;
	show_custom_meta_box( $color_fields );
}

// // Add the Meta Box
// function of_bg_add() {
// 	add_meta_box(
// 		'of_post_bg', // $id
// 		'BG options', // $title
// 		'of_render_bg', // $callback
// 		'post', // $page
// 		'side', // $context
// 		'default'); // $priority
// }
// add_action('add_meta_boxes', 'of_bg_add');

// function of_render_bg() {
// 	global $bg_fields;
// 	show_custom_meta_box( $bg_fields );
// }

$custom_meta_fields = array();
$custom_meta_fields = array_merge( $cover_fields, $custom_meta_fields );
$custom_meta_fields = array_merge( $color_fields, $custom_meta_fields );
$custom_meta_fields = array_merge( $bg_fields, $custom_meta_fields );



// The Callback
function show_custom_meta_box( $custom_meta_fields ) {
	global $post;

	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

	// Begin the field table and loop
	echo '<div class="metabox-form">';
	foreach ( $custom_meta_fields as $field ) {

		// get value of this field if it exists for this post
		$meta = get_post_meta( $post->ID, $field['id'], true );

		// begin a table row with
		echo '<div class="metabox-form__item">
				<div class="metabox-form__label"><label for="' . $field['id'] . '">' . $field['label'] . '</label></div>
				<div class="metabox-form__value">';
				switch( $field['type'] ) {

					// text
					case 'text':
						echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" style="width: 100%;" />
									<div class="metabox-form__description">' . $field['desc'] . '</div>';
						break;

					// textarea
					case 'textarea':
						echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" rows="10" style="width: 100%;">' . $meta . '</textarea>
									<div class="metabox-form__description">' . $field['desc'] . '</div>';
						break;

					// checkbox
					case 'checkbox':
						echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" ', $meta ? ' checked="checked"' : '','/>
									<label for="' . $field['id'] . '">' . $field['desc'] . '</label>';
						break;

					// select
					case 'select':
						echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
						foreach ( $field['options'] as $option ) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . $option['value'] . '">' . $option['label'] .'</option>';
						}
						echo '</select>
									<div class="metabox-form__description">' . $field['desc'] . '</div>';
						break;

					// radio
					case 'radio':
						foreach ( $field['options'] as $option ) {
							echo '<input
											type="radio"
											name="' . $field['id'] . '"
											id="' . $option['value'] . '"
											value="' . $option['value'] . '" ';
							if ( $meta ) {
								echo $meta == $option['value'] ? ' checked="checked"' : '';
							} else {
								echo $field['default'] == $option['value'] ? ' checked="checked"' : '';
							}
							echo ' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
						break;

					// checkbox_group
					case 'checkbox_group':
						foreach ( $field['options'] as $option ) {
							echo '<input type="checkbox" value="' . $option['value'] . '" name="' . $field['id'] . '[]" id="' . $option['value'] . '"', $meta && in_array( $option['value'], $meta ) ? ' checked="checked"' : '',' />
									<label for="' . $option['value'] . '">' . $option['label'] . '</label><br />';
						}
						echo '<div class="metabox-form__description">' . $field['desc'] . '</div>';
						break;

					// image
					case 'image':
						$image = get_template_directory_uri() . '/_assets/images/blank.gif';
						echo '<span class="custom_default_image" style="display:none">' . $image . '</span>';
						if ( $meta ) {
							$image = wp_get_attachment_image_src( $meta, 'medium' );
							$image = $image[0];
						}
						echo '<input name="' . $field['id'] . '" type="hidden" class="custom_upload_image" value="' . $meta . '" />
									<img src="' . $image . '" class="custom_preview_image" alt="" style="max-width: 100%; height: auto !important; " /><br />
									<input class="custom_upload_image_button button" type="button" value="Choose Image" />
									<small>
										<a href="#" class="custom_clear_image_button">Remove Image</a>
									</small>
									<br clear="all" />
									<div class="metabox-form__description">' . $field['desc'] . '</div>';
						break;

					// text
					case 'color':
						wp_enqueue_script('wp-color-picker');
					  wp_enqueue_style( 'wp-color-picker' );

						echo '<input class="colorpicker" type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" style="width: 100%;" data-default-color="' . $field['default'] . '" />
									<div class="metabox-form__description">' . $field['desc'] . '</div>';
						break;


				}
		echo '</div></div>';
	}
	echo '</div>';
}

// Save the Data
function save_custom_meta( $post_id ) {
	global $custom_meta_fields;

	// verify nonce
	if ( !wp_verify_nonce( $_POST['custom_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// loop through fields and save the data
	foreach ( $custom_meta_fields as $field ) {
		$old = get_post_meta( $post_id, $field['id'], true );
		$new = $_POST[$field['id']];
		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $field['id'], $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		}
	}
}
add_action( 'save_post', 'save_custom_meta' );