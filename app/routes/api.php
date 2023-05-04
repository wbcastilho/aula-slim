<?php

namespace app\routes;

use app\controllers\HomeController;
use app\controllers\OrmController;
use app\controllers\DbalController;
use app\controllers\TesteController;

// Abaixo são adicionadas as rotas da api

// Rota default
$app->get('/', [HomeController::class, 'index']);

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