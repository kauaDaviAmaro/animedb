<link rel="stylesheet" href="/animedbescola/public/css/addAnime.css">
<div class="forms">
    <h1>Anime Adicionar:</h1>
    <?= Form::comecar("/animedbescola/public/anime/adicionar", "POST") ?>
    <?= Form::hidden("criado", ["value" => Aplicacao::$app->session->getUsuario()[1]]) ?>
    <div class="row">
        <div class="col">
            <?= Form::campo($dados, "titulo") ?>
        </div>
        <div class="col">
            <?= Form::campo($dados, "produtora") ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Form::campo($dados, "diretor") ?>
        </div>
        <div class="col">
            <?= Form::campo($dados, "ano_lancamento", "date") ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Form::select(
                $dados,
                "classificacao",
                ["LI" => "Livre", "10" => "10", "12" =>  "12", "14" => "14", "16" =>  "16", "18" => "18"]
            ) ?>
        </div>
        <div class="col">
            <?= Form::select(
                $dados,
                "categoria",
                [
                    "" => "Selecione", "Acao" => "Ação", "Aventura" => "Aventura", "Comedia" => "Comédia",
                    "Drama" => "Drama", "Esporte" => "Esporte", "Fantasia" => "Fantasia",
                    "Ficcao_Cientifica" => "Ficcao Cientifica", "Horror" => "Horror",
                    "Misterio" => "Misterio", "Musical" => "Musical", "Romance" => "Romance",
                    "Shounen" => "Shounen", "Slice_of_Life" => "Slice of Life", "Suspense" => "Suspense"
                ]
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Form::campo($dados, "local_imagem", "text", ["id" => "urlImage"]) ?>
            <img src="" alt="" width="20%" id="imgImage">
        </div>
        <div class="col">
            <?= Form::campo($dados, "logo_imagem", "text", ["id" => "urlLogo"]) ?>
            <img src="" alt="" width="20%" id="imgLogo">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Form::label($dados, "descricao") ?>
            <?= Form::textArea("descricao", $dados) ?>
        </div>
    </div>
    <?= Form::submit("Enviar") ?>
    <?= Form::finalizar() ?>
</div>

<script>
    const urlImage = document.getElementById("urlImage");
    const urlLogo = document.getElementById("urlLogo");

    urlImage.addEventListener("change", () => {
        const img = document.getElementById("imgImage");
        img.src = urlImage.value;
        img.style.margin = "10px";
    });
    urlLogo.addEventListener("change", () => {
        const img = document.getElementById("imgLogo");
        img.src = urlLogo.value;
        img.style.margin = "10px";
    });

</script>