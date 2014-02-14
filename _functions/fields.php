<?php

// Field Array
$prefix = 'of_';
$cover_fields = array(

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

	array (
		'label'=> 'Лид',
		'id'	=> $prefix .'lead',
		'type'	=> 'textarea'
	),

	array (
		'label'	=> '',
		'id'	=> $prefix .'header',
		'type'	=> 'checkbox_group',
		'options' => array (
			'title_no' => array (
				'label' => 'Скрыть заголовок',
				'value'	=> 'title_no'
			)
		)
	),

);

$color_fields = array(

	array(
		'label'=> 'Фон',
		'id'	=> $prefix .'color_bg',
		'type'	=> 'color',
		'default' => '#ffffff'
	),

	array(
		'label'=> 'Текст',
		'id'	=> $prefix .'color_text',
		'type'	=> 'color',
		'default' => '#000000'
	),

	array(
		'label'=> 'Ссылки',
		'id'	=> $prefix .'color_link',
		'type'	=> 'color',
		'default' => get_theme_mod( 'zero_theme_color' )
	),

	array(
		'label'=> 'Ссылки (ховер)',
		'id'	=> $prefix .'color_link_hover',
		'type'	=> 'color',
		'default' => '#000000'
	),

	array(
		'label'=> 'Заголовок',
		'id'	=> $prefix .'color_header',
		'type'	=> 'color',
		'default' => '#000000'
	),

	array(
		'label'=> 'Заголовок (ховер)',
		'id'	=> $prefix .'color_header_hover',
		'type'	=> 'color',
		'default' => get_theme_mod( 'zero_theme_color' )
	),

	array(
		'label'=> 'Лайки',
		'id'	=> $prefix .'color_likes',
		'type'	=> 'color',
		'default' => '#E1E1E1'
	),

	array(
		'label'=> 'Лид',
		'id'	=> $prefix .'color_lead',
		'type'	=> 'color',
		'default' => '#000000'
	),

	// array (
	// 	'label'	=> 'Цвета',
	// 	'id'	=> $prefix .'color',
	// 	'type'	=> 'checkbox_group',
	// 	'options' => array (
	// 		'title_white' => array (
	// 			'label' => 'Белый заголовок',
	// 			'value'	=> 'title_white'
	// 		),
	// 		'lead_white' => array (
	// 			'label' => 'Белый лид',
	// 			'value'	=> 'lead_white'
	// 		)
	// 	)
	// ),

	// array (
	// 	'label' => 'Лайки',
	// 	'id'	=> $prefix .'shares',
	// 	'type'	=> 'radio',
	// 	'default' => 'grey',
	// 	'options' => array (
	// 		'grey' => array (
	// 			'label' => 'Серые',
	// 			'value'	=> 'grey'
	// 		),
	// 		'white' => array (
	// 			'label' => 'Белые',
	// 			'value'	=> 'white'
	// 		),
	// 		'black' => array (
	// 			'label' => 'Черные',
	// 			'value'	=> 'black'
	// 		),
	// 		'color' => array (
	// 			'label' => 'Цветные',
	// 			'value'	=> 'color'
	// 		),
	// 	)
	// ),
);

$bg_fields = array(

	array(
		'name'	=> 'Image',
		'desc'	=> '',
		'id'		=> $prefix . 'bg_image',
		'type'	=> 'image'
	),

	array (
		'label' => 'Выравнивание',
		'id'	=> $prefix .'bg_position',
		'type'	=> 'radio',
		'default' => 'center',
		'options' => array (
			'center' => array (
				'label' => 'По центру',
				'value'	=> 'center'
			),
			'topleft' => array (
				'label' => 'Сверху слева',
				'value'	=> 'topleft'
			),
			'topright' => array (
				'label' => 'Сверху справа',
				'value'	=> 'topright'
			)
		)
	),

	array (
		'label' => 'Фиксирование',
		'id'	=> $prefix .'bg_attachment',
		'type'	=> 'radio',
		'default' => 'scroll',
		'options' => array (
			'scroll' => array (
				'label' => 'Скроллить',
				'value'	=> 'scroll'
			),
			'fixed' => array (
				'label' => 'Фиксировать',
				'value'	=> 'fixed'
			)
		)
	),

	array (
		'label' => 'Повторение',
		'id'	=> $prefix .'bg_repeat',
		'type'	=> 'radio',
		'default' => 'norepeat',
		'options' => array (
			'norepeat' => array (
				'label' => 'Не повторять',
				'value'	=> 'norepeat'
			),
			'repeatx' => array (
				'label' => 'По горизонтали',
				'value'	=> 'repeatx'
			),
			'repeaty' => array (
				'label' => 'По вертикали',
				'value'	=> 'repeaty'
			),
			'repeat' => array (
				'label' => 'Замостить',
				'value'	=> 'repeat'
			)
		)
	),
);