# Practicle Guide Php Slim Framework 3

Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.

### 1. First Hello World! App

```
<?php
// All required dependency 
require('vendor/autoload.php');

// Create instance of slim app
$app = new \Slim\App;

// Basic Routing
$app->get('/',function(){
    echo 'Hello World!';
});

// Run Instance of Slim App.
$app->run();
?>
```

### 2. Create Routes

```
<?php
// All required dependency 
require('vendor/autoload.php');

// Create instance of slim app
$app = new \Slim\App;

// Basic Routing
$app->get('/',function(){
    echo 'Hello World!';
});

// Create Middleware to handle user request
$app->get('/users',function(){
    echo 'users';
});

// Create Middleware to handle posts request
$app->get('/posts',function(){
    echo 'posts';
});

// Run Instance of Slim App.
$app->run();
?>
```
### 3. Container

Slim uses a dependency container to prepare, manage, and inject application dependencies.

```
<?php
require('vendor/autoload.php');

$app = new \Slim\App;
$container = $app->getContainer();

$container['myapp'] = function(){
    return 'Hello World! from the Container';
};

$app->get('/',function(){
    echo $this->myapp;
});

$app->run();
?>
```
### 4. Working with View or Templates

```
<?php
require('vendor/autoload.php');

$app = new \Slim\App;
$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ .'/resourses/views', [
        'cache' => 'false'
    ]);

    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    return $view;
};

$app->get('/',function($request, $response){
    return $this->view->render($response, 'home.twig');
});

$app->run();
?>
```
### 5. Extends App layouts with help of Twig
Index.php
```
<?php
require('vendor/autoload.php');

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
    ]);
$container = $app->getContainer();



$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ .'/resourses/views', [
        'cache' => false,
    ]);

    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    return $view;
};

$app->get('/',function($request, $response){
    return $this->view->render($response, 'home.twig');
});

$app->get('/posts',function($request, $response){
    return $this->view->render($response, 'posts.twig');
});

$app->run();
?>
```
resources/views/layouts/app.twig

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{% block title %}{% endblock %}</title>
</head>
<body>
    {% block content %}
    {% endblock %}
</body>
</html>
```
