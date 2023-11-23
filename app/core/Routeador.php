<?php

class Routeador {
    private array $rotas;

    public function __construct() {
        $this->rotas = [];
    }

    public function adicionarRota(string $caminho, array $callback) : void {
        $this->rotas[$caminho] = $callback;
    }

    public function getRota(string $rota) : array | null {
        if (!array_key_exists($rota, $this->rotas)) {
            return null;
        }
        return $this->rotas[$rota];
    }

    public function execute(): void {
        $url = $this->getUrl();
        $parts = explode('/', $url);
    
        $controllerName = $parts[0] ?? '';
        $methodName = $parts[1] ?? '';
        $parameter = $parts[2] ?? '';
        $callback = $this->getRota("$controllerName/$methodName");
    
        if ($callback === null) {
            $callback = $this->getRota($controllerName);
        }
    
        if ($callback === null) {
            echo "Página não encontrada";
            return;
        }
    
        $controller = new $callback[0]();
        $methodToCall = $callback[1] ?? 'index';
        call_user_func([$controller, $methodToCall], $parameter);
    }
    
    
    private function getUrl() : string {
        $url = explode("/", filter_var(trim($_SERVER['REQUEST_URI'], "/"), FILTER_SANITIZE_URL));
        $url = array_values(array_diff($url, ["animedbescola", "public", "a"]));
        if (count($url) === 0) {
            return "";
        }
        return implode("/", $url);
    }
    
}