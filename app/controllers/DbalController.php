<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\DBAL\Connection;
use app\models\User;

class DbalController extends BaseController
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request, Response $response, array $args): Response
    {                
        $listUser = $this->user->findAll();

        return $this->ok($response, "Listado Usuários com DBAL", $listUser);        
    }  
    
    public function show(Request $request, Response $response, array $args): Response 
    {       
        // Valor da chave passada como argumento na url    
        $id = $args['id'];               

        $user = $this->user->find($id);

        return $this->ok($response, "Usuário id={$id} exibido com sucesso com DBAL!", $user);
    }

    public function save(Request $request, Response $response): Response
    {
        // Pega dos dados enviados no corpo doa requisição http
        $data = $request->getParsedBody();

        // Pega o campo name
        $name = $data["name"] ?? ""; 

        $this->user->save($name);
        
        return $this->ok($response, "Usuário adicionado com sucesso com DBAL!", $name);
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        // Valor da chave passada como argumento na url 
        $id = $args['id'];  

        // Pega dos dados enviados no corpo doa requisição http
        $data = $request->getParsedBody();

        // Pega o campo name
        $name = $data["name"] ?? "";    

        $this->user->update($id, $name);
        
        return $this->ok($response, "Usuário com id={$id} editado com sucesso!", $name);
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        // Valor da chave passada como argumento na url 
        $id = $args['id'];          

        $this->user->delete($id);
        
        return $this->ok($response, "Usuário com id={$id} excluído com sucesso!", []);
    }
}