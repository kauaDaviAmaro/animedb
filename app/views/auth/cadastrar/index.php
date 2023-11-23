<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forms.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>cadastro</title>
</head>

<body>
    <main>
        <div class="arrow">
            <a href="/animedbescola/public/"><i class='bx bx-chevron-left'></i>Voltar</a>
        </div>
        <div class="container">
            <div class="forms">
                <?= Form::comecar("/animedbescola/public/cadastrar", "POST") ?>

                <h1 class="title">
                    Crie sua conta!
                </h1>
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
                    <?= Form::campo($dados, "senha", "password", ['id' => "password"]) ?>
                    <div class="visu">
                        <input type="checkbox" onclick="show('password')" name="passwVisu" id="passwVisu">
                        <label for="passwVisu">Visualizar senha</label>
                    </div>
                </div>
                <div class="row">
                    <?= Form::campo($dados, "confirmarSenha", "password", ['id' => "conPassword"]) ?>
                    <div class="visu">
                        <input type="checkbox" onclick="show('conPassword')" name="oncPasswVisu" id="oncPasswVisu">
                        <label for="oncPasswVisu">Visualizar senha</label>
                    </div>
                </div>
                <div class="row">
                    <?= Form::submit("Cadastrar") ?>
                </div>
                <?= Form::finalizar() ?>
            </div>
            <div class="image">
                <img src="imgs/anime.webp" alt="anime">
            </div>
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

        let checkPass = () => {
            let password = document.getElementById('password');
            let Conpassword = document.getElementById('conPassword');
            console.log(password.value);
            console.log(Conpassword.value);
            if (password.value === Conpassword.value && password.value !== "") {
                password.classList.add('right');
                Conpassword.classList.add('right');
                password.classList.remove('wrong');
                Conpassword.classList.remove('wrong');
            } else {
                password.classList.add('wrong');
                Conpassword.classList.add('wrong');
                password.classList.remove('right');
                Conpassword.classList.remove('right');
            }
        }
    </script>
</body>

</html>