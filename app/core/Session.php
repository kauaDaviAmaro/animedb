<?php


class Session {

    public function __construct() {
        
        session_start();
    }
    public function setMesagem($key, $mesagem) {
        $_SESSION[$key] = $mesagem;
    }

    public function getMessagem($key) {
        $valor = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $valor;
    }

    public function existeMessagem($key) {
        return isset($_SESSION[$key]);
    }

    public function existeUsuario() {
        return isset($_SESSION['usuario']);
    }

    public function getUsuario() {
        return $_SESSION['usuario'];
    }

    public function logout() {
        unset($_SESSION['usuario']);
    }

    public function login(Usuario $usuario) {
        $_SESSION['usuario'] = [
            $usuario->getAtributo("apelido"),
            $usuario->getAtributo("id_usuario"),
        ];
    }
}