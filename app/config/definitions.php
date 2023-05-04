<?php

namespace app\config;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use DI\autowire;
use app\models\User;

return [
    Connection::class => function () {
        $connectionParams = [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => $_ENV['DB_CHARSET']
        ];
        return DriverManager::getConnection($connectionParams);
    },
    EntityManager::class => function() {
        return EntityManager::create(
            [
                'driver' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'dbname' => $_ENV['DB_DATABASE'],
                'user' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'charset' => $_ENV['DB_CHARSET']
            ],
            ORMSetup::createAnnotationMetadataConfiguration(
                paths: array(__DIR__."/app/entity"),
                isDevMode: true,
            )
        ); 
    },
    User::class => \DI\autowire(User::class)
];