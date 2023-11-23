<?php

class SiteControler extends Controller {
    public function home() {
        $this->view('layouts/navbar', ["titulo" => "Pagina Principal"]);
        $this->view('home/index');
    }

    public function pesquisar() {
        $anime = new Anime();
        $pesquisa = '';
        $ordem = '';
        if($this->metodoPost()) {
            $pesquisa = $this->post('pesquisa');
            $ordem = $this->post('ordem');
        }
        $dados['anime'] = $anime->pesquisarAnimes($pesquisa, $ordem);
        $dados['pesquisa'] = $pesquisa ?? "";
        $dados['ordem'] = $ordem;
        $this->view('layouts/navbar', ["titulo" => $pesquisa ?? 'pesquisar anime']);
        $this->view('pesquisar/index', $dados);
    }

}
