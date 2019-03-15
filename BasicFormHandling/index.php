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

$app->post('/contact',function($request, $response){
    return $response->withRedirect('http://localhost:86/slim/confirm');
})->setName('contact');

$app->get('/confirm',function($request, $response){
    return $this->view->render($response, 'contact_confirmed.twig');
});

$app->run();
?>