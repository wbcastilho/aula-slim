<?php

namespace app\routes;

use app\controllers\HomeController;
use app\controllers\ProdutoController;
use app\controllers\UserController;
use app\controllers\TesteController;

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

// Teste Querybuilder
//$app->get('/teste', [UserController::class, 'teste']);
$app->get('/teste2', [UserController::class, 'teste2']);

$app->get('/teste', [TesteController::class, 'getUsers']);