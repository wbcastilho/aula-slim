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

    public function getUsers(Request $request, Response $response, $args)
    {        
        $qb = $this->db->createQueryBuilder();

        $qb->select('*')->from('users');

        $stmt = $qb->execute();
        $users = $stmt->fetchAll();

        return $this->ok($response, "Listado Usuários", $users);        
    }
}