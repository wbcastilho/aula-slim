<?php

namespace app\models;

use Doctrine\DBAL\Connection;

class User
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();

        // Consulta SQL
        $queryBuilder->select('*')->from('users');
 
        // Executa a consulta
        $users = $queryBuilder->execute()->fetchAll(); 

        return $users;
    }

    public function find(int $id): array
    {        
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

        return $user;
    }

    public function save(string $name): void
    {
        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();

        // Consulta SQL
        $queryBuilder
             ->insert('users')
             ->setValue('name', '?')           
             ->setParameter(0, $name);   
            
        // Executa a consulta
        $queryBuilder->execute();     
    }

    public function update(int $id, string $name): void
    {
        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();

        // Consulta SQL       
        $queryBuilder
            ->update('users')            
            ->set('name', '?')
            ->where('id = ?')
            ->setParameter(0, $name)
            ->setParameter(1, $id);
            
        // Executa a consulta
        $queryBuilder->execute();     
    }

    public function delete(int $id): void
    {
        // Retorna um objeto QueryBuilder, que possui métodos para adicionar partes a uma instrução SQL
        $queryBuilder = $this->db->createQueryBuilder();

        // Consulta SQL
        $queryBuilder
            ->delete('users')
            ->where('id = ?')
            ->setParameter(0, $id);
            
        // Executa a consulta
        $queryBuilder->execute();     
    }
}