<?php

declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

$environment = 'development';

$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'imagine good error handling here';
    });
}
$whoops->register();

$routes = require __DIR__ . '/../config/routes.php';

// get incoming request, and get URI
$request = Request::createFromGlobals();
$uri = $request->getPathInfo();
$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

// Handles dependency injection
$injector = include('dependencies.php');


// Match the request URI WITH EXISTING ROUTES
$parameters = $matcher->match($uri);

// Get appropriate controller and method and call it
$contoller_name = $parameters['_controller'];
list($class, $method) = explode('::', $contoller_name, 2);
$class = 'App\\Controller\\' . $class;

// $controller = new $class();
$controller = $injector->make($class);  
$controller->$method();


