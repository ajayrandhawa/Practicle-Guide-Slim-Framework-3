<?php

use \App\Controllers\TopicController;
use \App\Controllers\UserController;

// or use Group

$app->get('/users', UserController::class.':index');
$app->get('/posts', TopicController::class.':index');
$app->get('/posts/{id}', TopicController::class.':show')->setName('posts.show');

$app->get('/topics', TopicController::class.':addTopic')->setName('topic.add');
$app->get('/topics/{id}', TopicController::class.':showTopic')->setName('topic.show');