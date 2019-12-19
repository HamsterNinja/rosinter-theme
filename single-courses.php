<?php
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$templates = ['single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'];


$parent_page_id = $post->post_parent;
$page_name = $post->post_name;
$parent_page = get_post($parent_page_id);
$parent_page_name = $parent_page->post_name;


$modules = get_field('modules', $parent_page_id); 
$context['modules'] = $modules;

if ($parent_page_name !== $page_name) {
    if (strpos($page_name, 'fulltime') !== false) {
        array_unshift( $templates, 'courses/single-courses-fulltime.twig' );
    }
    if (strpos($page_name, 'online') !== false) {
        array_unshift( $templates, 'courses/single-courses-online.twig' );
    }
    if (strpos($page_name, 'webinar') !== false) {
        array_unshift( $templates, 'courses/single-courses-webinar.twig' );
    }
}


Timber::render( $templates, $context );
