<?php
$context = Timber::get_context();
$templates = ['index.twig'];
if ( is_home() ) {    
	array_unshift( $templates, 'home.twig' );

	$args = [
		'post_type' => 'teachers',
		'posts_per_page' => 4,
	];
	$context['teachers'] = Timber::get_posts( $args );

	$args = [
		'post_type' => 'courses',
		'posts_per_page' => 3,
		'post_parent' => 0
	];
	$context['courses'] = Timber::get_posts( $args );

	$args = [
		'post_type' => 'post',
		'posts_per_page' => 4,
		'category_name' => 'news-events'
	];
	$context['news_items'] = Timber::get_posts( $args );

	$banners = get_field('banners', 'options');
	$context['banners'] = $banners;

	Timber::render( $templates, $context );
}
else{
	Timber::render( $templates, $context );
}
?>