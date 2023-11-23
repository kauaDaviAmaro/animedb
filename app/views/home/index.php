
<?php
Anime::bannerAnime();

Anime::listarAnimes(["titulo" => "Animes Novos", "organizar" => "lancamento"]);
Anime::listarAnimes(["titulo" => "Animes com maior nota", "organizar" => "nota"]);
Anime::listarAnimes(["titulo" => "Animes de Ação", "organizar" => "acao"]);
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script defer src="javascript/home.js"></script>