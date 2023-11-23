</html>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forms.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>

<body>
    <main>
        <div class="arrow">
            <a href="/animedbescola/public/"><i class='bx bx-chevron-left'></i>Voltar</a>
        </div>
        <div class="container">
            <div class="forms">
                <?= Form::comecar("/animedbescola/public/login", "POST") ?>
                <h1 class="title">
                    Faça o seu Login!
                </h1>
                <div class="row">
                    <?= Form::campo($dados, "email", "email") ?>
                </div>
                <div class="row">
                    <?= Form::campo($dados, "senha", "password", ["id" => "senha", "autocomplete" => "off"]) ?>
                    <div class="visu">
                        <input type="checkbox" onclick="show('senha')" name="passwVisu" id="passwVisu">
                        <label for="passwVisu">Visualizar senha</label>
                    </div>
                </div>
                <div class="row">
                    <?= Form::submit("logar") ?>
                </div>
                <?= Form::finalizar() ?>
            </div>
            <div class="image">
                <img src="imgs/anime.webp" alt="anime">
            </div>
        </div>
    </main>

    <script>
        let show = (inputPassword) => {
            inputPassword = document.getElementById(inputPassword);
            if (inputPassword.type === "text") {
                inputPassword.type = "password";
            } else {
                inputPassword.type = "text";
            }
        }
    </script>
</body>

</html>