<?php

require_once "../app/init.php";

$app = new Aplicacao();


$app->routeador->adicionarRota('', [SiteControler::class, 'home']);
$app->routeador->adicionarRota('pesquisar', [SiteControler::class, 'pesquisar']);

$app->routeador->adicionarRota('login', [UsuarioController::class, 'login']);
$app->routeador->adicionarRota('cadastrar', [UsuarioController::class, 'cadastrar']);
$app->routeador->adicionarRota('perfil', [UsuarioController::class, 'perfil']);
$app->routeador->adicionarRota('editar', [UsuarioController::class, 'editar']);
$app->routeador->adicionarRota('sair', [UsuarioController::class, 'sair']);

$app->routeador->adicionarRota('usuario/seguir', [UsuarioController::class, 'seguir']);


$app->routeador->adicionarRota('anime/adicionar', [AnimeController::class, 'adicionarAnime']);
$app->routeador->adicionarRota('anime/visualizar', [AnimeController::class, 'visualizarAnime']);

$app->routeador->adicionarRota('avaliacao/deletar', [AnimeController::class, 'deletarAvaliacao']);

$app->run();