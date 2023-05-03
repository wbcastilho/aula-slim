<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\DBAL\Connection;

class DbalController extends BaseController
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function index(Request $request, Response $response, $args)
    {        
        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();

        // Consulta SQL
        $queryBuilder->select('*')->from('users');

        // Executa a consulta
        $users = $queryBuilder->execute()->fetchAll();        

        return $this->ok($response, "Listado Usuários com DBAL", $users);        
    }

    public function show(Request $request, Response $response, array $args): Response 
    {       
        // Valor da chave passada como argumento na url    
        $id = $args['id'];
        
        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();
       
        // Consulta SQL
        $queryBuilder
            ->select('id', 'name')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $id);

        // Executa a consulta
        $user = $queryBuilder->execute()->fetchAllAssociative();

        return $this->ok($response, "Usuário id={$id} exibido com sucesso com DBAL!", $user);
    }

    public function save(Request $request, Response $response): Response
    {
        // Pega dos dados enviados no corpo doa requisição http
        $data = $request->getParsedBody();

        // Pega o campo name
        $name = $data["name"] ?? "";    

        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();

        // Consulta SQL
        $queryBuilder
            ->insert('users')
            ->setValue('name', '?')           
            ->setParameter(0, $name);   
           
        // Executa a consulta
        $queryBuilder->execute();        
        
        return $this->ok($response, "Usuário adicionado com sucesso com DBAL!", $name);
    }
}