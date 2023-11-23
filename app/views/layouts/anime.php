<?php 
foreach ($animes as $anime) : ?>
    <div class="animeCard">
        <div class="titulo">
            <a href="/animedbescola/public/anime/visualizar/<?= $anime['id_anime'] ?>">
                <?= $anime['titulo'] ?>
            </a>
            <div class="nota">
                <i class="bx bxs-star"></i> <?= $anime['nota'] ?>/10
            </div>
        </div>
        <div class="imagem">
            <img src="<?= $anime['local_imagem'] ?>" alt="<?= $anime['titulo'] ?>">
        </div>
    </div>
<?php endforeach ?>