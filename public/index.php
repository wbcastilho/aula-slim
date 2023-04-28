<?php

use Slim\Factory\AppFactory;
use app\controllers\HomeController;
use app\controllers\ProdutoController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

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

$app->run();