<?php
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['current_user'] = new Timber\User();
Timber::render( ['account.twig'], $context );