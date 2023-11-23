<link rel="stylesheet" href="css/perfil.css">
<div class="perfilContainer">
    <div class="edit">
        <a href="/animedbescola/public/editar">
            <i class='bx bx-edit-alt'></i>Editar
        </a>
    </div>
    <div class="nameContainer">
        <div class="name">
            <?= $dados->getAtributo("nome") ?>
        </div>
        <div class="nickname">
            <?= $dados->getAtributo("apelido") ?> <br>
        </div>
        <div class="days">
            <?= $dados->getAtributo("data_registro") ?> <br>
        </div>
    </div>
</div>
<div class="stats">
    <div class="followers">
        <i class='bx bxs-user'></i>
        <?= $dados->getAtributo("numero_seguidores") ?>
    </div>
    <div class="comments">
        <i class='bx bxs-comment'></i>
        <?= $dados->qtdAvaliacoesUsuario() ?>
    </div>
    <div class="animes">
        <i class='bx bxs-movie'></i>
        <?= $dados->getQtdAnimescriados() ?>
    </div>
</div>



<div class="view">
    <div class="rating">
        <div class="title">
            Avaliacoes:
        </div>
        <?php if (count($dados->getAvaliacoes()) > 0) {
            require "../app/views/layouts/avaliacao.php";
        }else {
            echo "Nenhuma avaliacao";
        }
        ?>
    </div>

    <div class="followers">
        <div class="title">
            Seguidores:
        </div>
        <div class="usuarios">
            <div class="usuario">
                <div>
                    <div class="apelido">
                        @ZeGoiaba
                    </div>
                    <div class="totalFollowers">
                        22 Seguidores
                    </div>
                </div>
                <button class="followeBtn">
                    <i class='bx bxs-user-check'></i>Seguir
                </button>
            </div>
            <div class="usuario">
                <div>
                    <div class="apelido">
                        @Baiano12
                    </div>
                    <div class="totalFollowers">
                        69 Seguidores
                    </div>
                </div>
                <button class="followeBtn">
                    <i class='bx bxs-user-check'></i>Seguir
                </button>
            </div>
        </div>
    </div>
</div>

<div class="animes">
    <div class="title">
        Animes Criados:
        
    </div>
    <?php
    $animes = $dados->getAnimesCriados();
    if (count($animes) > 0) {
        require "../app/views/layouts/anime.php";
    }else {
        echo "Nenhum anime criado";
    }
    ?>
</div>