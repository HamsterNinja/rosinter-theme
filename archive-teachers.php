<?php
$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery();
$templates = ['archive-teachers.twig'];
Timber::render( $templates, $context );
