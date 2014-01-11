<?php

// Add the Meta Box
function of_post_cover_mb_add() {
	add_meta_box(
		'of_post_cover', // $id
		'Cover options', // $title
		'show_custom_meta_box', // $callback
		'post', // $page
		'side', // $context
		'default'); // $priority
}
add_action('add_meta_boxes', 'of_post_cover_mb_add');

function of_post_cover_mb_show() {

}

// Field Array
$prefix = 'of_';
$custom_meta_fields = array(

	array (
		'label' => 'Обложка',
		'id'	=> $prefix .'cover_type',
		'type'	=> 'radio',
		'default' => 'none',
		'options' => array (
			'none' => array (
				'label' => 'Нет',
				'value'	=> 'none'
			),
			'under' => array (
				'label' => 'Под заголовком',
				'value'	=> 'under'
			),
			'cover' => array (
				'label' => 'Подложка',
				'value'	=> 'cover'
			)
		)
	),

	array(
		'label'=> 'Лид',
		'id'	=> $prefix .'lead',
		'type'	=> 'textarea'
	),


	array (
		'label'	=> 'Цвета',
		'id'	=> $prefix .'color',
		'type'	=> 'checkbox_group',
		'options' => array (
			'title_white' => array (
				'label' => 'Белый заголовок',
				'value'	=> 'title_white'
			),
			'lead_white' => array (
				'label' => 'Белый лид',
				'value'	=> 'lead_white'
			)
		)
	),

	array (
		'label'	=> 'Заголовок',
		'id'	=> $prefix .'header',
		'type'	=> 'checkbox_group',
		'options' => array (
			'title_no' => array (
				'label' => 'Скрыть',
				'value'	=> 'title_no'
			)
		)
	),

	array (
		'label' => 'Лайки',
		'id'	=> $prefix .'shares',
		'type'	=> 'radio',
		'default' => 'grey',
		'options' => array (
			'grey' => array (
				'label' => 'Серые',
				'value'	=> 'grey'
			),
			'white' => array (
				'label' => 'Белые',
				'value'	=> 'white'
			),
			'black' => array (
				'label' => 'Черные',
				'value'	=> 'black'
			),
			'color' => array (
				'label' => 'Цветные',
				'value'	=> 'color'
			),
		)
	),
);

// The Callback
function show_custom_meta_box() {
global $custom_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);

		// begin a table row with
		echo '<tr>
				<th style="width: 25%;"><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
				switch($field['type']) {

					// text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
							<br /><span class="description">'.$field['desc'].'</span>';
					break;

					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" rows="10" style="width: 100%;">'.$meta.'</textarea>
							<br /><span class="description">'.$field['desc'].'</span>';
					break;

					// checkbox
					case 'checkbox':
						echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label>';
					break;

					// select
					case 'select':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><br /><span class="description">'.$field['desc'].'</span>';
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
						foreach ($field['options'] as $option) {
							echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
						echo '<span class="description">'.$field['desc'].'</span>';
					break;



				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields;

	// verify nonce
	if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}

	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach
}
add_action('save_post', 'save_custom_meta');