<?php
$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery();
$templates = ['archive-reviews.twig'];
Timber::render( $templates, $context );
