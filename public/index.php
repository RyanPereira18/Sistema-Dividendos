<?php
// public/index.php

// Inicia a sessão para que possamos usar a variável $_SESSION em toda a aplicação
session_start();

// Carrega o arquivo de configuração com as constantes do banco de dados e a URL base
require_once '../config/config.php';

// Carrega as classes do núcleo (Core) da aplicação
require_once '../app/Core/Database.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Router.php';

// Instancia o roteador. O construtor do roteador já analisa a URL
// e define qual controlador e método devem ser chamados.
$router = new Router();

// Executa o método run() do roteador, que efetivamente chama
// o método do controlador apropriado para lidar com a requisição.
$router->run();