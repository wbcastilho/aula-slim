<?php

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

// Rota default
$app->get('/', [HomeController::class, 'index']);

// Rotas Produtos
$app->get('/produtos', [ProdutoController::class, 'index']);
$app->get('/produtos/{id}', [ProdutoController::class, 'show']);
$app->post('/produtos', [ProdutoController::class, 'save']);
$app->put('/produtos/{id}', [ProdutoController::class, 'update']);
$app->delete('/produtos/{id}', [ProdutoController::class, 'delete']);

// Rotas Users
$app->get('/users', [UserController::class, 'index']);
$app->get('/users/{id}', [UserController::class, 'show']);
$app->post('/users', [UserController::class, 'save']);
$app->put('/users/{id}', [UserController::class, 'update']);
$app->delete('/users/{id}', [UserController::class, 'delete']);

$app->run();