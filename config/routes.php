<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


// Create a new RouteCollection instance
$routes = new RouteCollection();

// Define your routes
$routes->add('home', new Route('/', [
    '_controller' => 'Homepage::show'
]));


return $routes;