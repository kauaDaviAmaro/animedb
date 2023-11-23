<?php
foreach ($dados->getAvaliacoes() as $avaliacao) : ?>

    <div class="avaliacaoContainer">
        <div class="avali">
            <div class="titulo">
                Anime:
                <?php
                $anime = new Anime;
                $anime = $anime->buscarPorId($avaliacao['id_anime']);
                ?>
                <a href="/animedbescola/public/anime/visualizar/<?= $anime->getAtributo('id_anime') ?>">
                    <?= $anime->getAtributo('titulo') ?>
                </a>
            </div>
            <div class="rate">
                <i class='bx bxs-star'></i> <?= $avaliacao['nota'] ?>/10
            </div>
            <div class="resenha">
                <?= html_entity_decode($avaliacao['resenha']) ?>
            </div>
            <div class="date">
                Data:
                <?php
                $data = new DateTime($avaliacao['data_registro']);
                $data->format('d/m/Y');
                echo $data->format('d/m/Y') . " as " . $data->format('h:i');
                ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>