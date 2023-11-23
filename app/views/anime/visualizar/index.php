<link rel="stylesheet" href="/animedbescola/public/css/visuAnime.css">
<div class="top">
    <div class="container">
        <div class="logo">
            <img src="<?= $dados->getAtributo('logo_imagem') ?>" alt="<?= $dados->getAtributo('titulo') ?>">
            <div class="info">
                <?= $dados->getAtributo('categoria') ?> °
                <?= $dados->getAtributo('diretor') ?> °
                <?= $dados->getAtributo('ano_lancamento') ?>
            </div>
        </div>
        <div class="imagem">
            <img src="<?= $dados->getAtributo('local_imagem') ?>" alt="<?= $dados->getAtributo('titulo') ?>">
        </div>
    </div>

    <div class="details">
        <div class="rating">
            <h2>Avaliação:</h2>
            <div class="star">
                <i class='bx bxs-star'></i><?= $dados->getAtributo('nota') ?>/10
            </div>
        </div>

        <div class="comments">
            <h2>Comentários:</h2>
            <div class="total">
                <?= $dados->getAtributo('total_comentario') ?> <span>Comentários</span>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="description">
        <h3>Descrição:</h3>

        <div class="text">
            <?= html_entity_decode($dados->getAtributo('descricao')) ?>
        </div>
    </div>

    <div class="userContainer">
        <div class="userReview">
            <?php

            if (Aplicacao::$app->session->existeUsuario()) {
                $usuario = new Usuario();
                $usuario = $usuario->buscarPorId(Aplicacao::$app->session->getUsuario()[1]);
                if (!$usuario->comentouAnime($dados->getAtributo('id_anime'))) {
            ?>

                    <h3>Faça uma Avaliação:</h3>
                    <?= Form::comecar("#", "POST") ?>
                    <div class="stars">
                        <div class="star-rating">
                            <i class='bx bxs-star active'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <span id="nota">
                            Nota: 1
                        </span>
                        <?= Form::hidden("nota", ["id" => "nota_anime", "value" => 1]); ?>
                    </div>
                    <?= Form::hidden("id_anime", ["value" => $dados->getAtributo('id_anime')]); ?>
                    <?= Form::hidden("id_usuario", ["value" => Aplicacao::$app->session->getUsuario()[1]]); ?>
                    <?= Form::textArea("resenha"); ?>
                    <?= Form::submit("Enviar"); ?>
                    <?= Form::finalizar() ?>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const stars = document.querySelectorAll('.star-rating i');
                            const notaElement = document.getElementById('nota');

                            stars.forEach((star, index) => {
                                star.addEventListener('click', function() {
                                    for (let i = 0; i <= index; i++) {
                                        stars[i].classList.add('active');
                                    }
                                    for (let i = index + 1; i < stars.length; i++) {
                                        stars[i].classList.remove('active');
                                    }
                                    notaElement.textContent = `Nota: ${index + 1}`;
                                    nota_anime.value = index + 1;
                                });
                            });
                        });
                    </script>
                <?php
                } else {
                    $avaliacao = new Avaliacao();
                    $avaliacao = $avaliacao->buscarPorIdAnimeUsuario(Aplicacao::$app->session->getUsuario()[1], $dados->getAtributo('id_anime'));                   ?>
                    <h3>Sua avaliação:</h3>
                    <div class="nota">
                        Nota: <?= $avaliacao['nota'] ?> <i class='bx bxs-star'></i>
                    </div>
                    <div class="resenha">
                        Comentário: <br>
                        <?= html_entity_decode($avaliacao['resenha']) ?>
                    </div>
                    <div class="data">
                        <?= $avaliacao['data_registro'] ?>
                    </div>
                    <div class="delete">
                        <a href="/avaliacao/deletar/<?= $avaliacao['id_avaliacao'] ?>">
                            <i class='bx bx-trash'></i>Deletar</a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="otherReviews">
            <h3>Avaliações de outros usuários:</h3>
            <?php
            $avaliacoes = Avaliacao::listarAvaliacoes($dados->getAtributo('id_anime'));
            if (count($avaliacoes) === 0) {
                echo "Nenhuma avaliacao";
            }
            foreach ($avaliacoes as $avalia) {
                $nomeUsuario = new Usuario();
                $nomeUsuario = $nomeUsuario->buscarPorId($avalia['id_usuario'])->getAtributo('nome');
            ?>
                <div class="review">
                    <div class="userName">
                        <a href=""><?= $nomeUsuario ?></a>
                        <div class="rate">
                            <?= $avalia['nota'] ?>/10 <i class='bx bxs-star'></i>
                        </div>
                    </div>
                    <div class="text">
                        <?= html_entity_decode($avalia['resenha']) ?>
                    </div>
                    <div class="date">
                        <?= $avalia['data_registro'] ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>
<script>
var r = document.querySelector(':root');

let navbar = document.querySelector("#navbar");

document.addEventListener('scroll', () => {
    if (this.scrollY > 0) {
        navbar.classList.add("bg");
        navbar.classList.remove("shadow");
        navbar.style.color = 'white';
    } else {
        navbar.classList.remove("bg")
        navbar.classList.add("shadow");
    }
})

let darkSwitch = document.getElementById('darkSwitch');

darkSwitch.addEventListener('click', () => {
    if (darkSwitch.className === 'bx bx-sun') {
        darkSwitch.className = 'bx bx-moon';
        r.style.setProperty('--bg-color', '#fff');
        r.style.setProperty('--navbar-color', '#111');
        r.style.setProperty('--navbar-bg', '#fff');
        r.style.setProperty('--color', '#111');
        r.style.setProperty('--shadow-banner', 'linear-gradient(#11111100 80%, #fff)');
        r.style.setProperty('--shadow-navbar', 'linear-gradient(#fff 100%, #fff)');
    } else {
        darkSwitch.className = 'bx bx-sun';
        r.style.setProperty('--bg-color', '#141414');
        r.style.setProperty('--navbar-color', '#fff');
        r.style.setProperty('--navbar-bg', '#111');
        r.style.setProperty('--color', '#fff');
        r.style.setProperty('--shadow-banner', 'linear-gradient(#11111100 80%, #141414)');
        r.style.setProperty('--shadow-navbar', 'linear-gradient(#111111b0, #111111b0,#11111100)');
    }
})
</script>