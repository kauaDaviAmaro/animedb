<link rel="stylesheet" href="css/perfil.css">


<div class="forms">
    <?= Form::comecar("/animedbescola/public/editar", "POST") ?>
        <div class="title">
        <i class='bx bx-edit-alt' ></i> Editar perfil!
        </div>
        <div class="row">
            <?= Form::campo($dados, "nome", "text") ?>
        </div>
        <div class="row">
            <?= Form::campo($dados, "apelido", "text") ?>
        </div>
        <div class="row">
            <?= Form::campo($dados, "email", "email") ?>
        </div>
        <div class="row">
            <?= Form::submit("Confirmar") ?>
        </div>
    <?= Form::finalizar() ?>
</div>