<?php

namespace public;

use DI\Container;
use Slim\Factory\AppFactory;
use app\controllers\HomeController;
use app\controllers\ProdutoController;
use app\controllers\UserController;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require __DIR__ . '/../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

$container->set(EntityManager::class, fn() => EntityManager::create(
    [
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'doctrine_exemplo',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ],
    ORMSetup::createAnnotationMetadataConfiguration(
        paths: array(__DIR__."/app/entity"),
        isDevMode: true,
    )
));

// Set container to create App with on AppFactory
AppFactory::setContainer($container);

$app = AppFactory::create();

// Adiciona o middleware BodyParsingMiddleware antes do middleware RoutingMiddleware
$app->addBodyParsingMiddleware();

// Mensagens de erro em modo debug
$app->addErrorMiddleware(true, true, true);

// Definindo o caminho base 
$app->setBasePath('/aula-slim');

// Rotas
include __DIR__ . '/../app/routes/api.php';

$app->run();