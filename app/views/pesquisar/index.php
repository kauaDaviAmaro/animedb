<link rel="stylesheet" href="css/pesquisa.css">

<main>
<?= Form::comecar("#", "POST") ?>
<div class="containerPesquisa">
    <div class="row">
        <label for="pesquisa">Pesquisar:</label>
        <input type="text" name="pesquisa" id="pesquisa" value="<?= $dados['pesquisa']?>" placeholder="Digite aqui sua pesquisa">

    </div>
    <div class="row">
        <label for="ordem">Ordenar por:</label>
        <select name="ordem" id="ordem">
            <option value="">Selecione</option>
            <option value="titulo" <?= $dados['ordem'] === "titulo" ? "selected" : ''?>>titulo</option>
            <option value="nota" <?= $dados['ordem'] === "nota" ? "selected" : ''?>>nota</option>
            <option value="lancamento" <?= $dados['ordem'] === "lancamento" ? "selected" : ''?>>lancamento</option>
        </select>
    </div>
    <div class="row">
    <?= Form::submit("Pesquisar") ?>
    </div>
</div>
<?= Form::finalizar() ?>
</main>

<div class="cardWrap">
    <?php
    
    if ($dados['anime']) {
        require "../app/views/layouts/anime_card.php";
    }else {
        echo "Nenhum anime encontrado!!!";
    }
    ?>
</div>

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