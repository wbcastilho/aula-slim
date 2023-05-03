<?php

namespace app\routes;

use app\controllers\HomeController;
use app\controllers\ProdutoController;
use app\controllers\UserController;
use app\controllers\TesteController;
use app\controllers\OrmController;
use app\controllers\DbalController;

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

// Teste Querybuilder no Doctrine ORM
//$app->get('/teste', [UserController::class, 'teste']);
//$app->get('/teste2', [UserController::class, 'teste2']);

// Testes no Doctrine DBAL
$app->get('/testes', [TesteController::class, 'index']);
$app->get('/testes/{id}', [TesteController::class, 'show']);
$app->post('/testes', [TesteController::class, 'save']);


// Rotas Users utilizando o Doctrine/ORM
$app->get('/orm', [OrmController::class, 'index']);
$app->get('/orm/{id}', [OrmController::class, 'show']);
$app->post('/orm', [OrmController::class, 'save']);
$app->put('/orm/{id}', [OrmController::class, 'update']);
$app->delete('/orm/{id}', [OrmController::class, 'delete']);

// Rotas Users utilizando o Doctrine/DBAL
$app->get('/dbal', [DbalController::class, 'index']);
$app->get('/dbal/{id}', [DbalController::class, 'show']);
$app->post('/dbal', [DbalController::class, 'save']);
$app->put('/dbal/{id}', [DbalController::class, 'update']);
$app->delete('/dbal/{id}', [DbalController::class, 'delete']);