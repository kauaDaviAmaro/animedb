<?php


class View {
    private const VIEW_DIR = "../app/views/";
    public function rederizar($view, $dados = []) {
        require_once self::VIEW_DIR . "$view.php";
    }
}


?>