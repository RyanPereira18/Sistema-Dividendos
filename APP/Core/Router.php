<?php
// app/Core/Router.php

class Router {
    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Verifica se o controlador existe
        if (isset($url[0]) && file_exists('../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once '../app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Verifica se o método existe no controlador
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Obtém os parâmetros da URL
        $this->params = $url ? array_values($url) : [];
    }

    /**
     * Executa o controlador e o método com os parâmetros.
     */
    public function run() {
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Analisa a URL para obter controlador, método e parâmetros.
     * @return array
     */
    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}