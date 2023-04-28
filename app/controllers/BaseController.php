<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class BaseController 
{
    protected function base(Response $response, bool $success, string $message, $value)
    {
        $result = [
            'success' => $success,
            'message' => $message,
            'data' => $value
        ];

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-type', 'application/json');  
    }

    protected function ok(Response $response, string $message, $value)
    {
        return $this->base($response, true, $message, $value); 
    }

    protected function created(Response $response, string $message, $value)
    {               
        $response = $this->base($response, true, $message, $value); 
        return $response->withStatus(201); 
    }

    protected function badRequest(Response $response, string $message, $value)
    {               
        $response = $this->base($response, false, $message, $value); 
        return $response->withStatus(400); 
    }
}