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
