<?
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5dfb5d6e942d0',
	'title' => 'Модули',
	'fields' => array(
		array(
			'key' => 'field_5dfb5fd34124b',
			'label' => 'Модули',
			'name' => 'modules',
			'type' => 'repeater',
			'layout' => 'block',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5dfb5ff54124c',
					'label' => 'Название модуля',
					'name' => 'title',
					'type' => 'text',
				),
				array(
					'key' => 'field_5dfb60094124d',
					'label' => 'Тест 1 модуля',
					'name' => 'text_1',
					'type' => 'wysiwyg',
				),
				array(
					'key' => 'field_5dfb628e3f4e8',
					'label' => 'Тест 2 модуля',
					'name' => 'text_2',
					'type' => 'wysiwyg',
				),
				array(
					'key' => 'field_5dfb60274124e',
					'label' => 'Цена',
					'name' => 'price',
					'type' => 'number',
				),
				array(
					'key' => 'field_5dfb60274124e_link',
					'label' => 'Ссылка на модуль',
					'name' => 'link_module',
					'type' => 'text',
				),
				array(
					'key' => 'field_5e0072122391a',
					'label' => 'Дата (начало)',
					'name' => 'time_start',
					'type' => 'date_time_picker',
					'display_format' => 'Y-m-d H:i:s',
					'return_format' => 'Y-m-d H:i:s',
					'first_day' => 1,
				),
				array(
					'key' => 'field_5e0072852391b',
					'label' => 'Дата (конец)',
					'name' => 'time_end',
					'type' => 'date_time_picker',
					'display_format' => 'Y-m-d H:i:s',
					'return_format' => 'Y-m-d H:i:s',
					'first_day' => 1,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'courses',
			),
		),
	),
));

endif;