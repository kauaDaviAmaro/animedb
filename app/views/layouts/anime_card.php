<?php foreach ($dados['anime'] as $anime) : ?>
    <a href="anime/visualizar/<?= $anime['id_anime'] ?>">
        <div class="card">
            <div class="image" style="background-image: url('<?= $anime['local_imagem'] ?>');">
            </div>
            <div class="titulo">
                <?= $anime["titulo"] ?>
            </div>
            <div class="nota">
                <?= $anime["nota"]; ?>
            </div>
            <div class="descricao">
                <?= html_entity_decode($anime["descricao"]) ?>
            </div>

        </div>
    </a>
<?php endforeach ?>