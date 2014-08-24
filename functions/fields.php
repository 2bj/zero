<?php

// Field Array
$prefix = 'of_';
$cover_fields = array(

	array (
		'label'=> __( 'HTML is OK. BTW, if you type an external link it will become the teaser link instead of the regulat post permalink', 'zero' ),
		'id'	=> $prefix .'lead',
		'type'	=> 'textarea'
	),

  array (
    'label' => '',
    'id'  => $prefix .'header',
    'type'  => 'checkbox_group',
    'options' => array (
      'title_no' => array (
        'label' => __( 'Hide the post title', 'zero' ),
        'value' => 'title_no'
      )
    )
  ),

);