<?php
if ( class_exists( 'Timber' ) ){
    Timber::$cache = false;
}
//Скрытие версии wp
add_filter('the_generator', '__return_empty_string');

add_image_size( 'blog_image', 438, 257, true ); 
add_image_size( 'catalog_image', 360, 370, true ); 
add_image_size( 'catalog_image_x2', 720, 405, true ); 

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );

function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function true_remove_default_widget() {
	unregister_widget('WP_Widget_Archives'); 
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Categories'); 
	unregister_widget('WP_Widget_Meta'); 
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Recent_Comments'); 
	unregister_widget('WP_Widget_Recent_Posts'); 
	unregister_widget('WP_Widget_RSS'); 
	unregister_widget('WP_Widget_Search'); 
	unregister_widget('WP_Widget_Tag_Cloud'); 
	unregister_widget('WP_Widget_Text'); 
	unregister_widget('WP_Nav_Menu_Widget'); 
}
 
add_action( 'widgets_init', 'true_remove_default_widget', 20 );
add_theme_support('post-thumbnails');

register_nav_menus(array(
    'menu_header' => 'Верхнее меню',
));

function add_async_forscript($url)
{
    if (strpos($url, '#asyncload')===false)
        return $url;
    else if (is_admin())
        return str_replace('#asyncload', '', $url);
    else
        return str_replace('#asyncload', '', $url)."' defer='defer"; 
}

add_filter('clean_url', 'add_async_forscript', 11, 1);
function time_enqueuer($my_handle, $relpath, $type='script', $async='false', $media="all",  $my_deps=array()) {
    if($async == 'true'){
        $uri = get_theme_file_uri($relpath.'#asyncload');
    }
    else{
        $uri = get_theme_file_uri($relpath);
    }
    $vsn = filemtime(get_theme_file_path($relpath));
    if($type == 'script') wp_enqueue_script($my_handle, $uri, $my_deps, $vsn);
    else if($type == 'style') wp_enqueue_style($my_handle, $uri, $my_deps, $vsn, $media);      
}

add_action('wp_footer', 'add_scripts');
function add_scripts() {
    time_enqueuer('jquerylatest', '/assets/js/vendors/jquery-3.4.1.min.js', 'script', true);
    time_enqueuer('slick', '/assets/js/vendors/slick.js', 'script', true);
    time_enqueuer('app', '/assets/js/main.bundle.js', 'script', true);
    time_enqueuer('sliders', '/assets/js/sliders.js', 'script', true);
    wp_enqueue_script('yandex-map-api', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU&load=Map,Placemark#asyncload'); 

    $post = get_post();
    $parent_page_id = $post->post_parent;
    $page_name = $post->post_name;
    $parent_page = get_post($parent_page_id);
    $parent_page_name = $parent_page->post_name;
    $modules = get_field('modules', $parent_page_id);

    wp_localize_script( 'app', 'SITEDATA', array(
        'url' => get_site_url(),
        'themepath' => get_template_directory_uri(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'modules' => $modules,
    ));
}

//wp-embed.min.js remove
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

//remove jquery-migrate
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );

function add_styles() {
        if(is_admin()) return false; 
        time_enqueuer('main', '/assets/css/main.css', 'style', false, 'all');   
}
add_action('wp_print_styles', 'add_styles');

Timber::$dirname = array('templates', 'views');
class StarterSite extends TimberSite {
	function __construct() {
		add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'menus' );
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        parent::__construct();
    }
    
    function add_to_context( $context ) {
        $context['menu_header'] = new TimberMenu('menu_header');  
        $context['site'] = $this;
        $context['user_login'] = get_the_author_meta( 'user_login', wp_get_current_user()->ID );
        $context['is_user_logged_in'] = is_user_logged_in();

        $args = array(
            'post_type' => 'courses',
            'posts_per_page' => 10,
            'post_parent' => 0,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'cat_courses',
                    'field' => 'slug',
                    'terms' => 'bezopasnost-pishhi',
                )
            )
        );	
        $context['safe_courses'] = Timber::get_posts( $args );

        $args = array(
            'post_type' => 'courses',
            'posts_per_page' => 10,
            'post_parent' => 0,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'cat_courses',
                    'field' => 'slug',
                    'terms' => 'dlya-oficiantov',
                )
            )
        );	
        $context['wartness_courses'] = Timber::get_posts( $args );

        $args = array(
            'post_type' => 'courses',
            'posts_per_page' => 10,
            'post_parent' => 0,
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'cat_courses',
                    'field' => 'slug',
                    'terms' => 'dlya-barmenov',
                )
            )   
        );	
        $context['bar_courses'] = Timber::get_posts( $args );

        $args = array(
            'post_type' => 'courses',
            'posts_per_page' => 10,
            'post_parent' => 0,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'cat_courses',
                    'field' => 'slug',
                    'terms' => 'dlya-menedzherov',
                )
            ) 
        );	
        $context['manager_courses'] = Timber::get_posts( $args );
        
        
		return $context;
	}
}
new StarterSite();

//Disable gutenberg style in Front
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );

//remove type js and css for validator
add_action('wp_loaded', 'prefix_output_buffer_start');
function prefix_output_buffer_start() { 
    ob_start("prefix_output_callback"); 
}
add_action('shutdown', 'prefix_output_buffer_end');
function prefix_output_buffer_end() { 
    ob_end_flush(); 
}
function prefix_output_callback($buffer) {
    return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
}

include_once(get_template_directory() .'/include/acf-fields.php');
include_once(get_template_directory() .'/include/rest-api.php');
include_once(get_template_directory() .'/include/theme-settings.php');