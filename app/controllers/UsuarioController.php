<?php

class UsuarioController extends Controller {
    public function login() {
        $usuario = new Usuario();
        if ($this->metodoPost()) {
            $usuario->carregarDados($this->getDados());

            if ($user = $usuario->login()) {
                $this->session()->setMesagem("sucesso", "Bem vindo ao sistema!");
                $this->session()->login($user);
                $this->redirecionar();
            }
        }
        $this->view('auth/login/index', $usuario);
    }

    public function cadastrar() {
        $usuario = new Usuario();
        if ($this->metodoPost()) {
            $usuario->carregarDados($this->getDados());

            if ($usuario->validar() && $usuario->adicionarUsuario()) {
                $this->session()->setMesagem("sucesso", "Cadastro realizado com sucesso!");
                $this->redirecionar();
            }
        }

        $this->view("auth/cadastrar/index", $usuario);
    }

    public function perfil() {
        $usuario = new Usuario();
        $this->view('layouts/navbar', ["titulo" => "Perfil"]);
        $this->view("auth/perfil/index",  $usuario->buscarPorId(Aplicacao::$app->session->getUsuario()[1]));
    }

    public function editar() {
        $usuario = new Usuario();
        $usuario = $usuario->buscarPorId(Aplicacao::$app->session->getUsuario()[1]);
        if ($this->metodoPost()) {
            $usuario->carregarDados($this->getDados());

            if ($usuario->editarUsuario()) {
                $this->redirecionar('perfil');
            }
        }
        $this->view('layouts/navbar', ["titulo" => "Editar Perfil"]);
        $this->view("auth/perfil/editar", $usuario);
    }

    public function sair() {
        Aplicacao::$app->session->logout();
        $this->redirecionar();
    }

    public function seguir($id) {
        $usuario = new Usuario();
        $idUsuarioLogado = Aplicacao::$app->session->getUsuario()[1];
        $usuario->seguirUsuario($id, $idUsuarioLogado);
        $this->redirecionar('/perfil');
    }
}