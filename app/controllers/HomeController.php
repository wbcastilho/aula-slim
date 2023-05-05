<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController 
{
    public function index(Request $request, Response $response): Response
    {
        $response->getBody()->write("Hello world2!");
        return $response;
    }
}