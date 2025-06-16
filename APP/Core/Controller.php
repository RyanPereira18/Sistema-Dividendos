<?php
// app/Core/Controller.php

class Controller {

    /**
     * Carrega um arquivo de visão e passa dados para ele.
     *
     * @param string $view O nome do arquivo da visão (ex: 'clientes/index').
     * @param array $data Um array associativo de dados a serem extraídos como variáveis na visão.
     */
    public function view($view, $data = []) {
        // A função extract() transforma as chaves de um array em variáveis.
        // Ex: ['clientes' => $lista] vira a variável $clientes dentro da view.
        extract($data);
        
        // Constrói o caminho para o arquivo de visão e o carrega.
        $viewPath = "../app/Views/{$view}.php";

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Encerra a aplicação se o arquivo de visão não for encontrado
            die("Arquivo de visão não encontrado: " . $viewPath);
        }
    }
}