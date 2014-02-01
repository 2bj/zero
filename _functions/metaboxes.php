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
$custom_meta_fields = array_merge( $bg_fields, $custom_meta_fields );



// The Callback
function show_custom_meta_box( $custom_meta_fields ) {
	global $post;

	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ( $custom_meta_fields as $field ) {

		// get value of this field if it exists for this post
		$meta = get_post_meta( $post->ID, $field['id'], true );

		// begin a table row with
		echo '<tr>
				<th style="width: 25%;"><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
				<td>';
				switch( $field['type'] ) {

					// text
					case 'text':
						echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
							<br /><span class="description">' . $field['desc'] . '</span>';
						break;

					// textarea
					case 'textarea':
						echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" rows="10" style="width: 100%;">' . $meta . '</textarea>
							<br /><span class="description">' . $field['desc'] . '</span>';
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
						echo '</select><br /><span class="description">' . $field['desc'] . '</span>';
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
						echo '<span class="description">' . $field['desc'] . '</span>';
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
									<span class="description">' . $field['desc'] . '</span>';
						break;


				}
		echo '</td></tr>';
	}
	echo '</table>';
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