<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProdutoController extends BaseController
{
    public function index(Request $request, Response $response): Response 
    {
        $produtos = [
            '1' => 'Teclado',
            '2' => 'Mouse',
            '3' => 'Monitor'
        ];        
        
        return $this->ok($response, "Listado com sucesso!", $produtos);
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

        return $this->ok($response, "Produto id={$id} exibido com sucesso!", $produto);
    }

    public function save(Request $request, Response $response): Response 
    {     
        $data = $request->getParsedBody();
        $nome = $data["nome"] ?? "teste";       

        return $this->created($response, "Produto adicionado com sucesso!", $nome);
    }

    public function update(Request $request, Response $response, array $args): Response 
    {            
        $id = $args['id'];  
        
        $data = $request->getParsedBody();
        $nome = $data["nome"] ?? "teste";

        return $this->ok($response, "Produto com id={$id} editado com sucesso!", $nome);
    }

    public function delete(Request $request, Response $response, array $args): Response 
    {            
        $id = $args['id'];          

        return $this->ok($response, "Produto com id={$id} excluido com sucesso!", $id);
    }
}