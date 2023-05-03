<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\DBAL\Connection;

class TesteController extends BaseController
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function index(Request $request, Response $response, $args)
    {        
        $queryBuilder = $this->db->createQueryBuilder();

        $queryBuilder->select('*')->from('users');

        $stmt = $queryBuilder->execute();
        $users = $stmt->fetchAll();

        return $this->ok($response, "Listado Usuários com DBAL", $users);        
    }

    public function show(Request $request, Response $response, array $args): Response 
    {           
        $id = $args['id'];
        
        $queryBuilder = $this->db->createQueryBuilder();
       
        $queryBuilder
            ->select('id', 'name')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $id);

        $user = $queryBuilder->execute()->fetchAllAssociative();

        // echo "<pre>";
        // print_r($user);
        // exit();

        return $this->ok($response, "Usuário id={$id} exibido com sucesso com DBAL!", $user);
    }

    public function save(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $name = $data["name"] ?? "";    

        $queryBuilder = $this->db->createQueryBuilder();

        $queryBuilder
            ->insert('users')
            ->setValue('name', ':name')           
            ->setParameter(':name', $name);   
            
        $queryBuilder->execute();
        
        return $this->ok($response, "Usuário adicionado com sucesso com DBAL!", $name);
    }
}