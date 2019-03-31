# Practicle Guide Php Slim-Framework 3

Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.

Practical guide Slim3 framework. In these tutorials, we cover up all basic of a slim framework functionality like Routing, Controller, Middleware, API etc. we also Cover Basic form handling, page navigation, database connectivity, and complete CURD operation.

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

### 6. Passing Data

Index.php
```
$app->get('/posts',function($request, $response){
    return $this->view->render($response, 'posts.twig',[
        'Mypost' => 'This is awosome post'
    ]);
});
```

show data to twig template

resources/views/posts.twig
```
{% extends 'layouts/app.twig' %}

{% block title %}Posts{% endblock %}

{% block content %}
    <h2>{{ Mypost }}</h2>
{% endblock %}
```
### 7. Moving between Pages

Index.php
```
$app->get('/posts',function($request, $response){
    return $this->view->render($response, 'posts.twig',[
        'Mypost' => 'This is awosome post'
    ]);
})->setName('posts.show');
```

on Twig Template

```
<a href="{{ path_for('posts.show')}}"> Go To Home</a>
```

### 8. Handling Params with Url

```
$app->get('/posts/{id}',function($request, $response,$args){

    $user = [
        'id' => $args['id'],
        'username' => 'Ajay'
    ];
    
    return $this->view->render($response, 'contact_confirmed.twig', [
        'user' => $user
    ]);
});
```

### 9. Grouping Routing

```
$app->group('/posts',function(){
    $this->get('',function(){
        echo "All Posts";
    });
    $this->get('/{id}',function($request, $response, $args){
        echo "Get Post " . $args['id'];
    });
    $this->post('',function(){
        echo "Create Posts";
    });
});

```
### 10. Database Connection

```
$container = $app->getContainer();

$container['db'] = function(){
    return new PDO('mysql:host=localhost;dbname=ajax;','root','');
};

//FETCH ALL RECORDS

$app->get('/',function($request, $response){

    $users = $this->db->query('select * from users')->fetchAll(PDO::FETCH_OBJ);
    
    return $this->view->render($response, 'home.twig',[
        'users' => $users
    ]);
});

```

### 11. Return JSON

```
return $response->withJson('YOUR DATA',200);
```

### 12. Middleware

```
$autenticated =  function($request, $response, $next) use ($container){

    if(true){
        $response = $response->withRedirect('http://localhost:86/slim/public/posts');
    }
    return $next($request,$response);
};

//use

$app->get('/users', UserController::class.':index')->add($autenticated);

```
