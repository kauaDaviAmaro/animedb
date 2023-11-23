<div class="banner" style="background-image: url('<?= $anime["local_imagem"]; ?>');" onclick="window.location.href='anime/visualizar/<?= $anime['id_anime'] ?>';" onmouseover="this.style.cursor='pointer');">
    <div class="shadow"></div>
    <div class="content">
        <div class="logo">
            <img src="<?= $anime["logo_imagem"] ?>" alt="One Piece">
        </div>

        <div class="points">
            <div class="stars">
                <i class='bx bxs-star'></i>
                <?= $anime["nota"]; ?>
            </div>
        </div>
        <div class="description">
            <?= html_entity_decode($anime["descricao"]); ?>
        </div>
    </div>
</div>