<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [__DIR__ . '/../src/Entity'];
$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

// Configurações de conexão com o banco de dados
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => 'senha',
    'dbname'   => 'nome_do_banco_de_dados',
];

$entityManager = EntityManager::create($dbParams, $config);
