<a href="anime/visualizar/<?= $anime['id_anime'] ?>">
    <img src="<?= $anime["local_imagem"]; ?>" alt="logo">
    <div class="content">
        <div class="header">
            <div class="logo">
                <img src="<?= $anime["logo_imagem"] ?>" alt="[ANIME LOGO]">
            </div>

            <div class="points">
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <?= $anime["nota"]; ?>
                </div>
            </div>
        </div>

        <div class="description">
            <?= html_entity_decode($anime["descricao"]); ?>
        </div>
    </div>
</a>