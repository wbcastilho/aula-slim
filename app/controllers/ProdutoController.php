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

    public function show(Request $request, Response $response, array $args): Response 
    {    
        $produtos = [
            '1' => 'Teclado',
            '2' => 'Mouse',
            '3' => 'Monitor'
        ];
        
        $id = $args['id'];
        $produto[$id] = $produtos[$id];
    
        $response->getBody()->write(json_encode($produto));
        return $response->withHeader('Content-type', 'application/json');
    }

    public function save(Request $request, Response $response): Response 
    {     
        $data = $request->getParsedBody();
        $nome = $data["nome"] ?? "teste";
    
        $response->getBody()->write("Adicionar Produto {$nome}");          
        return $response;    
    }

    public function update(Request $request, Response $response, array $args): Response 
    {            
        $id = $args['id'];   
    
        $response->getBody()->write("Editar Produto com id={$id}");          
        return $response;
    }

    public function delete(Request $request, Response $response, array $args): Response 
    {            
        $id = $args['id'];   
    
        $response->getBody()->write("Deletar Produto com id={$id}");          
        return $response;
    }
}