<?
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5dfb5d6e942d0',
	'title' => 'Модули',
	'fields' => array(
		array(
			'key' => 'field_5e27ffc6bdfae_timecourse',
			'label' => 'Время обучения',
			'name' => 'timecourse',
			'type' => 'text',
		),
		array(
			'key' => 'field_5e27ffc6bdfae_countmodules',
			'label' => 'Количество занятий',
			'name' => 'countmodules',
			'type' => 'text',
		),
		array(
			'key' => 'field_5e27ffc6bdfae_difficult',
			'label' => 'Сложность',
			'name' => 'difficult',
			'type' => 'text',
		),
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
					'key' => 'field_5dfb60274124e_link',
					'label' => 'Ссылка на модуль',
					'name' => 'link_module',
					'type' => 'text',
				),
				array(
					'key' => 'field_5dfb60274124e',
					'label' => 'Цена',
					'name' => 'price',
					'type' => 'number',
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

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5e27ff90ccbf8',
		'title' => 'Учитель',
		'fields' => array(
			array(
				'key' => 'field_5e27ffc6bdfae',
				'label' => 'Должность',
				'name' => 'position',
				'type' => 'text',
			),
			array(
				'key' => 'field_5e27ffe6bdfaf',
				'label' => 'Галерея',
				'name' => 'gallery',
				'type' => 'gallery',
			),
			array(
				'key' => 'field_8c88f8f845922_links',
				'label' => 'Ссылки',
				'name' => 'links',
				'type' => 'wysiwyg'
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'teachers',
				),
			),
		),
	));
	
endif;

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_5aa5652c21fba',
        'title' => 'Основные настройки',
        'fields' => array (
            array (
                'key' => 'field_5aa784697e3cc',
                'label' => 'Номер телефон',
                'name' => 'phone',
                'type' => 'text',   
            ),
            array (
                'key' => 'field_5aa7847d7e3cd',
                'label' => 'Почта',
                'name' => 'mail',
                'type' => 'text',          
			),
			array(
				'key' => 'field_8c88f8f845922_hometext',
				'label' => 'Текст на главной',
				'name' => 'hometext',
				'type' => 'wysiwyg'
			),
			array(
				'key' => 'field_5c87a86bdb0fb',
				'label' => 'Баннеры',
				'name' => 'banners',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_3c47a6cedb0ff_title',
						'label' => 'Заголовок',
						'name' => 'title',
						'type' => 'text',
					),
					array(
						'key' => 'field_3c47a6cedb0ff_text',
						'label' => 'Текст',
						'name' => 'text',
						'type' => 'text',
					),
					array(
						'key' => 'field_3c47a6cedb0ff',
						'label' => 'Ссылка',
						'name' => 'button_link',
						'type' => 'text',
					)
				),
			),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'options',
                ),
            ),
        ),
    ));

endif;

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5e285aa0bd605',
		'title' => 'О нас',
		'fields' => array(
			array(
				'key' => 'field_5e285ab118c5a',
				'label' => 'Текст над баннером',
				'name' => 'banner_text',
				'type' => 'wysiwyg',
			),
			array(
				'key' => 'field_3c47a6cedb0ff_about_us_title',
				'label' => 'О нас заголовок',
				'name' => 'about_us_title',
				'type' => 'text',
			),
			array(
				'key' => 'field_3c47a6cedb0ff_about_us_text',
				'label' => 'О нас',
				'name' => 'about_us_text',
				'type' => 'text',
			),
			array(
				'key' => 'field_5e285ae218c5b',
				'label' => 'Тригеры 1',
				'name' => 'triggers_1',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'field_5e285b5418c5c',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
					),
					array(
						'key' => 'field_5e285b6218c5d',
						'label' => 'Название',
						'name' => 'text',
						'type' => 'text',
					),
				),
			),
			array(
				'key' => 'field_5e285b9818c61',
				'label' => 'Тест на синем',
				'name' => 'test_blue',
				'type' => 'wysiwyg',
			),
			array(
				'key' => 'field_5e285b9518c5e',
				'label' => 'Тригеры 2',
				'name' => 'triggers_2',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'field_5e285b9518c5f',
						'label' => 'Иконка',
						'name' => 'icon',
						'type' => 'image',
					),
					array(
						'key' => 'field_5e285b9518c60',
						'label' => 'Название',
						'name' => 'text',
						'type' => 'text',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '10',
				),
			),
		),
	));
	
endif;

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5e2ac172e1660',
		'title' => 'Преподаватель – эксперт',
		'fields' => array(
			array(
				'key' => 'field_5e2ac17d0d43e',
				'label' => 'Преподаватель – эксперт',
				'name' => 'expert',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'teachers',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
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
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
endif;