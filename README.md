# Practicle Guide Php Slim Framework 3

Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.

### First Hello World! App

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
