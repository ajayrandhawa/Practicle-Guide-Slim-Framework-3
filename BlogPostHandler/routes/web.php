<?php

use \App\Controllers\TopicController;

// or use Group

$app->get('/posts', TopicController::class.':index');
$app->get('/posts/{id}', TopicController::class.':show')->setName('posts.show');