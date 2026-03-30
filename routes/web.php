<?php

$routes = [];

// Página inicial (pode redirecionar pro login)
$routes[''] = ['controller' => 'AuthController', 'method' => 'login'];

// Cadastro
$routes['register'] = ['controller' => 'AuthController', 'method' => 'register'];

// Login
$routes['login'] = ['controller' => 'AuthController', 'method' => 'login'];

// Dashboard
$routes['dashboard'] = ['controller' => 'DashboardController', 'method' => 'index'];

// Logout
$routes['logout'] = ['controller' => 'AuthController', 'method' => 'logout'];
$routes['transacao/store'] = ['controller' => 'TransacaoController', 'method' => 'store'];
$routes['transacao/delete'] = ['controller' => 'TransacaoController', 'method' => 'delete'];
$routes['transacao/edit'] = ['controller' => 'TransacaoController', 'method' => 'edit'];
$routes['transacao/update'] = ['controller' => 'TransacaoController', 'method' => 'update'];