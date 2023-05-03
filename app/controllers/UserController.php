<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;
use app\entity\User;

class UserController extends BaseController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request, Response $response): Response 
    {               
        $userRepository = $this->entityManager->getRepository(User::class);
        $userObj = $userRepository->findAll(); 

        $users = array_map(function($obj) {
            return array(
                'id' => $obj->getId(),
                'name' => $obj->getName()
            );
        }, $userObj);            
        
        return $this->ok($response, "Listado Usuários", $users);
    }

    public function show(Request $request, Response $response, array $args): Response 
    {           
        $id = $args['id'];
       
        $userObj = $this->entityManager->find(User::class, (int)$id);
        $user = [];

        if (is_null($userObj)) {
            $message = "O usuário selecionado não existe";            
        } else {
            $message = "Usuário id={$id} exibido com sucesso!";
            $user = $userObj->toArray();
        }

        return $this->ok($response, $message, $user);
    }

    public function save(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $name = $data["name"] ?? "";    

        $newUser = new User();
        $newUser->setName($name);

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();                  
        
        return $this->ok($response, "Usuário adicionado com sucesso!", $newUser->toArray());
    }

    public function update(Request $request, Response $response, array $args): Response 
    {    
        $message = "";        
        $id = $args['id'];  
        
        $data = $request->getParsedBody();
        $name = $data["name"] ?? "";
      
        $userObj = $this->entityManager->find(User::class, $id);
        $user = [];
       
        if ($userObj !== null) {                       
            $userObj->setName($name);
            $this->entityManager->flush();
            $user = $userObj->toArray();
            $message = "Usuário com id={$id} editado com sucesso!";
        } else {
            $message = "User {$id} não existe."; 
        }
       
        return $this->ok($response, $message, $user);
    }

    public function delete(Request $request, Response $response, array $args): Response 
    {           
        $message = ""; 
        $id = $args['id'];   
        
        $userObj = $this->entityManager->find(User::class, $id);
        $user = [];
        
        if (!is_null($userObj)) {
            $user = $userObj->toArray();
            $this->entityManager->remove($userObj);
            $this->entityManager->flush();
            $message = "Usuário com id={$id} excluído com sucesso!";
        } else {
            $message = "User {$id} não existe."; 
        }

        return $this->ok($response, $message, $user);
    }

    public function teste(Request $request, Response $response): Response 
    {               
        $qb = $this->entityManager->createQueryBuilder();                

        $qb->select('u')
        ->from(User::class, 'u') 
        ->orderBy('u.name', 'ASC');

        $resultado = $qb->getQuery()->getResult();
       
        echo "<pre>";
        print_r($resultado);
        exit();
        
        return $this->ok($response, "Listado Usuários", $listUser);
    }

    public function teste2(Request $request, Response $response): Response 
    {                      
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('name', 'name');

        $query = $this->entityManager->createNativeQuery('SELECT id, name FROM users', $rsm);               
        $users = $query->getResult();               
        
        return $this->ok($response, "Listado Usuários", $users);
    }
}