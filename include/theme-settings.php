<?php
add_action( 'init', 'create_my_post_types' );
function create_my_post_types() {
    register_post_type(
        'courses',
         array(
            'labels' => array( 'name' => __( 'Курсы' ),
            'singular_name' => __( 'Курс' ) ),
            'supports'      => array( 'title', 'editor', 'thumbnail','excerpt'),
            'has_archive' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'public' => true, ) );   
               
    register_post_type(
        'reviews',
         array(
            'labels' => array( 'name' => __( 'Отзывы' ),
            'singular_name' => __( 'Отзыв' ) ),
            'supports'      => array( 'title', 'editor', 'thumbnail','excerpt'),
            'has_archive' => true,
            'show_in_rest' => true,
            'public' => true, ) );  
    
    register_post_type(
        'teachers',
         array(
            'labels' => array( 'name' => __( 'Учителя' ),
            'singular_name' => __( 'Учитель' ) ),
            'supports'      => array( 'title','editor', 'thumbnail','excerpt'),
            'has_archive' => true,
            'show_in_rest' => true,
            'public' => true, ) );              
}

