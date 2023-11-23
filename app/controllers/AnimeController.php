<?php

class AnimeController extends Controller{
    public function adicionarAnime() {
        $anime = new Anime();
        if ($this->metodoPost()) {
            $anime->carregarDados($this->getDados());
    
            if ($anime->validar() && $anime->adicionarAnime()) {
                $this->session()->setMesagem("sucesso", "Anime adicionado com sucesso!");
                $this->redirecionar();
            }
        } 
        $this->view("layouts/navbar", ["titulo" => "Adicionar Anime"]);
        $this->view("anime/adicionar/index", $anime);
    }

    public function visualizarAnime($id) {
        $anime = new Anime();
        $avaliacao = new Avaliacao();
        $anime = $anime->buscarPorId($id);
        if($this->metodoPost()) {
            $avaliacao->carregarDados($this->getDados());
            if ($avaliacao->adicionarAvaliacao()) {
                $this->session()->setMesagem("sucesso", "Avaliação adicionada com sucesso!");
                $anime->atualizarNota();
                $anime = $anime->buscarPorId($id);
            }
        }
        $this->view("layouts/navbar", ["titulo" => $anime->getAtributo("titulo")]);
        $this->view("anime/visualizar/index", $anime);
    }

    public function deletarAvaliacao($id) {
        $avaliacao = new Avaliacao();
        $avaliacao->deletarAvaliacao($id);
        $this->redirecionar('perfil');
    }
}