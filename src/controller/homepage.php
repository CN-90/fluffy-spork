<?php

namespace App\Controller;

use App\Template\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Homepage {
    private $response;
    private $request;
    private $renderer;

    public function __construct(Response $response, Request $request, Renderer $renderer) {
    	$this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }
    
    public function show() {
        $data = ['name' => 'PANCHITO'];
        $html = $this->renderer->render('homepage', $data);
        $this->response->setContent($html);
        $this->response->send();
    }

}