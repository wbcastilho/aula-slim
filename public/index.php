<?php

namespace public;

use Symfony\Component\Dotenv\Dotenv;
use DI\Container;
use Slim\Factory\AppFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

// Create Container using PHP-DI
$container = new Container();

$container->set(EntityManager::class, fn() => EntityManager::create(
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
));

// Set container to create App with on AppFactory
AppFactory::setContainer($container);

$app = AppFactory::create();

// Adiciona o middleware BodyParsingMiddleware antes do middleware RoutingMiddleware
$app->addBodyParsingMiddleware();

// Mensagens de erro em modo debug
$app->addErrorMiddleware(
    $_ENV['DISPLAY_ERROR_DETAILS'],
    $_ENV['LOG_ERRORS'],
    $_ENV['LOG_ERROR_DETAILS']
);

// Definindo o caminho base 
$app->setBasePath('/aula-slim');

// Rotas
include __DIR__ . '/../app/routes/api.php';

$app->run();