<?php

use Slim\Factory\AppFactory;
use app\controllers\HomeController;
use app\controllers\ProdutoController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Mensagens de erro em modo debug
$app->addErrorMiddleware(true, true, true);

// Definindo o caminho base 
//$app->setBasePath('/aula-slim');

// Rota default
$app->get('/', [HomeController::class, 'index']);

// Rotas Produtos
$app->get('/produtos', [ProdutoController::class, 'index']);

$app->run();