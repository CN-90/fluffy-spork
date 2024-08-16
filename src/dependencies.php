<?php

use App\Template\MustacheRenderer;
use App\Template\Renderer;
$injector = new Auryn\Injector;

$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/src/templates', [
            'extension' => '.html',
        ]),
    ],
]);


$injector->alias(Renderer::class, MustacheRenderer::class);


return $injector;



