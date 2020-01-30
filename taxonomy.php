<?php
$templates = [
    'taxonomy-' . get_query_var( 'taxonomy' ) .'-'.get_query_var( 'term' ). '.twig',
    'taxonomy-' . get_query_var( 'taxonomy' ) . '.twig', 'taxonomy.twig'
];

$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery();
$context['term_page'] = new TimberTerm();

Timber::render( $templates, $context );