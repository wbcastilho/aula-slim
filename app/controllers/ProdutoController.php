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

        $result = [
            'success' => true,
            'message' => 'Listado com sucesso!',
            'data' => $produtos
        ];

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-type', 'application/json');       
    }

    public function show(Request $request, Response $response, array $args): Response 
    {    
        $produtos = [
            '1' => 'Teclado',
            '2' => 'Mouse',
            '3' => 'Monitor'
        ];
        
        $id = $args['id'];
        $produto[$id] = $produtos[$id];

        $result = [
            'success' => true,
            'message' => 'Exibido com sucesso!',
            'data' => $produto
        ];
    
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-type', 'application/json');
    }

    public function save(Request $request, Response $response): Response 
    {     
        $data = $request->getParsedBody();
        $nome = $data["nome"] ?? "teste";

        $result = [
            'success' => true,
            'message' => 'Produto adicionado com sucesso!',
            'data' => $nome
        ];
    
        $response->getBody()->write(json_encode($result));          
        return $response->withStatus(201);    
    }

    public function update(Request $request, Response $response, array $args): Response 
    {            
        $id = $args['id'];   

        $result = [
            'success' => true,
            'message' => "Produto com id={$id} editado com sucesso!",
            'data' => $id
        ];
    
        $response->getBody()->write(json_encode($result));          
        return $response;
    }

    public function delete(Request $request, Response $response, array $args): Response 
    {            
        $id = $args['id'];  
        
        $result = [
            'success' => true,
            'message' => "Produto com id={$id} excluido com sucesso!",
            'data' => $id
        ];
    
        $response->getBody()->write(json_encode($result));          
        return $response;
    }
}