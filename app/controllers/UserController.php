<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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
        $users = $userRepository->findAll(); 

        $listUser = array_map(function($obj) {
            return array(
                'id' => $obj->getId(),
                'name' => $obj->getName()
            );
        }, $users);            
        
        return $this->ok($response, "Listado Usuários", $listUser);
    }

    public function show(Request $request, Response $response, array $args): Response 
    {           
        $id = $args['id'];
       
        $user = $this->entityManager->find(User::class, (int)$id);

        return $this->ok($response, "Usuário id={$id} exibido com sucesso!", $user->toArray());
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
      
        $user = $this->entityManager->find(User::class, $id);
       
        if ($user !== null) {                       
            $user->setName($name);
            $this->entityManager->flush();
            $message = "Usuário com id={$id} editado com sucesso!";
        } else {
            $message = "User {$id} não existe."; 
        }
       
        return $this->ok($response, $message, $user->toArray());
    }

    public function delete(Request $request, Response $response, array $args): Response 
    {           
        $message = ""; 
        $id = $args['id'];   
        
        $user = $this->entityManager->find(User::class, $id);

        if ($user !== null) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
            $message = "Usuário com id={$id} excluído com sucesso!";
        } else {
            $message = "User {$id} não existe."; 
        }

        return $this->ok($response, $message, $id);
    }
}