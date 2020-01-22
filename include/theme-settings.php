<?php
add_action( 'init', 'create_my_post_types' );
function create_my_post_types() {
    register_post_type(
        'courses',
         array(
            'labels' => [
                'name' => __( 'Курсы' ),
                'singular_name' => __( 'Курс' ),
                'parent_item_colon' => ''
            ],
            'supports'      => array( 'title', 'editor', 'thumbnail','excerpt', 'page-attributes'),
            'has_archive' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'public' => true, ) );   
               
    register_post_type(
        'reviews',
         array(
            'labels' => array( 'name' => __( 'Отзывы' ),
            'singular_name' => __( 'Отзыв' ) ),
            'supports'      => array( 'title', 'editor', 'thumbnail'),
            'has_archive' => true,
            'show_in_rest' => true,
            'public' => true, ) );  
    
    register_post_type(
        'teachers',
         array(
            'labels' => array( 'name' => __( 'Учителя' ),
            'singular_name' => __( 'Учитель' ) ),
            'supports'      => array( 'title','editor', 'thumbnail'),
            'has_archive' => true,
            'show_in_rest' => true,
            'public' => true, ) );              
}

include_once(get_template_directory() . '/include/generate_featured_image.php');

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_reviews") {
        
    if (isset ($_POST['title'])) {
        $title =  $_POST['title'];
    } 
    if (isset ($_POST['description'])) {
        $description = $_POST['description'];
    } 
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    $uploadedfile = $_FILES['file'];
    $upload_overrides = array( 'test_form' => false );
    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    $movefile = $movefile['url'];
    
    
    $new_post = array(
        'post_title'    => $title,
        'post_content'  => $description,
        'post_status'   => 'draft',           // Choose: publish, preview, future, draft, etc.
        'post_type' => 'reviews' //'post',page' or use a custom post type if you want to
    );
    $pid = wp_insert_post($new_post); 
    
    Generate_Featured_Image( $movefile, $pid );
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Основные настройки',
        'menu_title'    => 'Основные настройки',
        'menu_slug'     => 'options',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}