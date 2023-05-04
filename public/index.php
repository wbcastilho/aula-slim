<?php

namespace public;

use Symfony\Component\Dotenv\Dotenv;
use DI\Container;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

require __DIR__ . '/../vendor/autoload.php';

// Lê as informações do arquivo .env e salva na variável superglobal $_ENV
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

// Crie o contêiner PHP-DI 
$containerBuilder = new ContainerBuilder();

// Definições das classes que serão adicionadas no container builder para a injeção de dependência
$containerBuilder->addDefinitions(__DIR__ . '/../app/config/definitions.php');

// Constroi o contêiner
$container = $containerBuilder->build();

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