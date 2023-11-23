<?php

class Controller {
    public function view($view, $data = []) : void{
        Aplicacao::$app->view->rederizar($view, $data);
    }

    public function session() : Session {
        return Aplicacao::$app->session;
    }

    public function metodoPost() : bool {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
        }
        return false;
    }

    public function redirecionar($local = "") {
        header("Location: /animedbescola/public/$local");
        exit;
    }

    public function post($nome) {
        return $_POST[$nome] ?? "";
    }

    public function getDados()
    {
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $data;
    }
}