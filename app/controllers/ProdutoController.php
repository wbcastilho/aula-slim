<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProdutoController 
{
    public function index(Request $request, Response $response): Response 
    {
        $produtos = [
            '1' => 'Teclado',
            '2' => 'Mouse',
            '3' => 'Monitor'
        ];

        $response->getBody()->write(json_encode($produtos));
        return $response->withHeader('Content-type', 'application/json');       
    }

    public function create(Request $request, Response $response): Response 
    {        
        $response->getBody()->write("Adicionar Produto");
        return $response;       
    }
}