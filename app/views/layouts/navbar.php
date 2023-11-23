<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/animedbescola/public/css/homePage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title><?= $dados["titulo"] ?></title>
</head>

<body>
    <?php
    if (Aplicacao::$app->session->existeMessagem('sucesso')) {
    ?>
        <div class="tooltip">
            <div class="body">
                <div id="fechar">
                    <i class='bx bx-x-circle'></i>
                </div>
                <div class="mensage">
                    <?= Aplicacao::$app->session->getMessagem('sucesso') ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <nav class="navbar shadow" id="navbar">
        <div class="links">
            <a href="/animedbescola/public/">Home</a>
        </div>

        <div class="logo">
            AnimeDB
        </div>

        <div class="links">
            <a href="/animedbescola/public/pesquisar"><i class='bx bx-search-alt-2'></i></a>
            <i id="darkSwitch" class='bx bx-sun'></i>

            <?php
            if (Aplicacao::$app->session->existeUsuario()) {
                $usuario = Aplicacao::$app->session->getUsuario();
            ?>
                <a href="/animedbescola/public/perfil" class="perfil">
                    <?= array_values($usuario)[0] ?>
                </a>
                <a href="/animedbescola/public/sair" class="sair">
                    Sair
                </a>
            <?php
            } else {
            ?>
                <a href="/animedbescola/public/login" class="log">Entrar</a>
                <a href="/animedbescola/public/cadastrar" class="sign">Cadastrar-se</a>
            <?php
            }
            ?>

        </div>
    </nav>

    <script>
        const tooltip = document.querySelector(".tooltip");
        fechar.onclick = function() {
            tooltip.style.display = "none";
        }
    </script>

    <?php

if (Aplicacao::$app->session->existeUsuario()) {
    ?>
    <div class="addAnime">
        <a href="/animedbescola/public/anime/adicionar">
            + Adicionar anime
        </a>
    </div>
    <?php
}

?>