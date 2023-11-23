<?php

class Usuario extends Model {
    protected int $id_usuario = 0;
    protected int $numero_seguidores = 0;
    protected string $data_registro = '';
    protected string $nome = '';
    protected string $email = '';
    protected string $senha = '';
    protected string $apelido = '';
    protected string $confirmarSenha = '';

    public function login(): bool | Usuario {
        $usuario = $this->buscarPorEmail($this->email);

        if ($usuario && password_verify($this->senha, $usuario->getAtributo('senha'))) {
            return $usuario;
        }
        $this->erros['email'] = 'Email ou senha inválido';
        $this->erros['senha'] = 'Email ou senha inválido';

        return false;
    }

    public function buscarPorEmail(string $email): Usuario | bool {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $resultado = $this->db->query($sql, ["email" => $email]);
        return $resultado->fetchObject(self::class);
    }

    public function buscarPorId(int $id): Usuario | bool {
        $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetchObject(self::class);
    }

    public function adicionarUsuario(): bool {
        $sql = "INSERT INTO usuario (nome, apelido, email, senha) VALUES (:nome, :apelido, :email, :senha)";
        $parametros = [
            "nome" => $this->nome,
            "apelido" => $this->apelido,
            "email" => $this->email,
            "senha" => password_hash($this->senha, PASSWORD_DEFAULT)
        ];

        if ($this->db->query($sql, $parametros)) {
            return true;
        }
        return false;
    }

    public function editarUsuario(): bool {
        $sql = "UPDATE usuario SET nome = :nome, apelido = :apelido, email = :email WHERE id_usuario = :idUsuario";
        $parametros = [
            "nome" => $this->nome,
            "apelido" => $this->apelido,
            "email" => $this->email,
            "idUsuario" => $this->id_usuario
        ];
        if ($this->db->query($sql, $parametros)) {
            Aplicacao::$app->session->login($this);
            return true;
        }
        return false;
    }

    public function qtdSeguidoresUsuario(): int {
        $sql = "SELECT COUNT(*) FROM seguidor WHERE id_usuario = :id_usuario";
        return Aplicacao::$app->db->query($sql, ['id_usuario' => $this->id_usuario])->fetchColumn();
    }

    public function qtdAvaliacoesUsuario(): int {
        $sql = "SELECT COUNT(*) FROM avaliacao WHERE id_usuario = :id_usuario";
        return Aplicacao::$app->db->query($sql, ['id_usuario' => $this->id_usuario])->fetchColumn();
    }

    public function getAvaliacoes(): array {
        $sql = "SELECT * FROM avaliacao WHERE id_usuario = :id_usuario";
        return Aplicacao::$app->db->query($sql, ['id_usuario' => $this->id_usuario])->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQtdAnimescriados(): int {
        $sql = "SELECT COUNT(*) FROM anime WHERE criado = :id_usuario";
        return Aplicacao::$app->db->query($sql, ['id_usuario' => $this->id_usuario])->fetchColumn();
    }

    public function getAnimesCriados(): array {
        $sql = "SELECT * FROM anime WHERE criado = :id_usuario";
        return Aplicacao::$app->db->query($sql, ['id_usuario' => $this->id_usuario])->fetchAll(PDO::FETCH_ASSOC);
    }

    public function comentouAnime($idAnime): bool {
        $sql = "SELECT * FROM avaliacao WHERE id_usuario = :id_usuario AND id_anime = :id_anime";
        $resultado = Aplicacao::$app->db->query($sql, ['id_usuario' => $this->id_usuario, 'id_anime' => $idAnime]);
        return $resultado->rowCount() > 0;
    }

    public function seguirUsuario($id, $idSeguidor) : bool {
        $sql = "INSERT INTO seguidores (id_usuario_seguido, id_usuario_seguidor)
                VALUES (:id_usuario_seguido, :id_usuario_seguidor)";
        $parametros = [
            "id_usuario_seguido" => $id,
            "id_usuario_seguidor" => $idSeguidor
        ];
        if ($this->db->query($sql, $parametros)) {
            return true;
        }
        return false;
    }


    public function labels(): array {
        return [
            "nome" => "Nome",
            "apelido" => "Apelido",
            "email" => "E-mail",
            "senha" => "Senha",
            "confirmarSenha" => "Confirmar Senha"
        ];
    }

    protected function regrasValidacao(): array {
        return [
            'nome' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'apelido' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'email' => [
                self::REGRA_REQUIRED, [self::REGRA_UNICO => self::class],
                self::REGRA_EMAIL, [self::REGRA_MAX => 100]
            ],
            'senha' => [
                self::REGRA_REQUIRED, [self::REGRA_COMBINAR],
                [self::REGRA_MIN => 8], [self::REGRA_MAX => 100]
            ],
            'confirmarSenha' => [
                self::REGRA_REQUIRED, [self::REGRA_COMBINAR => 'senha'],
                [self::REGRA_MIN => 8], [self::REGRA_MAX => 100]
            ]
        ];
    }
}
