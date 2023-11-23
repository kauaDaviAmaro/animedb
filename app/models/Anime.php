<?php

class Anime extends Model {
    protected int $id_anime = 0;
    protected string $titulo = '';
    protected string $categoria = '';
    protected string $produtora = '';
    protected string $diretor = '';
    protected string $ano_lancamento = '';
    protected string $classificacao = '';
    protected string $local_imagem = '';
    protected string $logo_imagem = '';
    protected string $descricao = '';
    protected string $criado = '';
    protected int $total_comentario = 0;


    protected function regrasValidacao(): array {
        return [
            'titulo' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'produtora' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'diretor' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'local_imagem' => [self::REGRA_REQUIRED],
            'categoria' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'ano_lancamento' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'classificacao' => [self::REGRA_REQUIRED, [self::REGRA_MAX => 100]],
            'descricao' => [self::REGRA_REQUIRED],
        ];
    }

    public function labels() : array {
        return [
            "titulo" => "Título",
            "categoria" => "Categoria",
            "produtora" => "Produtora",
            "diretor" => "Diretor",
            "ano_lancamento" => "Ano de Lançamento",
            "classificacao" => "Classificação",
            "local_imagem" => "Url da Imagem",
            "descricao" => "Descrição",
            "logo_imagem" => "Url da Logo"
        ];
    }

    public function adicionarAnime(): bool {
        $sql = "INSERT INTO anime
                (titulo, produtora, categoria, diretor, ano_lancamento,
                classificacao, local_imagem, logo_imagem, descricao, criado)
                VALUES
                (:titulo, :produtora, :categoria, :diretor, :ano_lancamento, :classificacao,
                :local_imagem, :logo_imagem, :descricao, :criado)
                ";

                var_dump($this->criado);

        $parametros = [
            "titulo" => $this->titulo,
            "categoria" => $this->categoria,
            "produtora" => $this->produtora,
            "diretor" => $this->diretor,
            "ano_lancamento" => $this->ano_lancamento,
            "classificacao" => $this->classificacao,
            "local_imagem" => $this->local_imagem,
            "descricao" => $this->descricao,
            "logo_imagem" => $this->logo_imagem,
            "criado" => intVal($this->criado)
        ];

        if ($this->db->query($sql, $parametros)) {
            return true;
        }
        return false;
    }

    public function pesquisarAnimes($pesquisa, $ordem) {
        $sql = "SELECT * FROM anime";

        if (!empty($pesquisa)) {
            $sql .= " WHERE titulo LIKE '%$pesquisa%' OR categoria LIKE '%$pesquisa%' OR diretor LIKE '%$pesquisa%' OR produtora LIKE '%$pesquisa%'";
        }

        switch($ordem) {
            case 'nota':
                $sql .= " ORDER BY nota DESC";
                break;
                
            case 'lancamento':
                $sql .= " ORDER BY ano_lancamento";
                break;
                
            default:
                $sql .= " ORDER BY titulo";
        }

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): Anime {
        $sql = "SELECT * FROM anime WHERE id_anime = :id";
        $parametros = ["id" => $id];
        $resultado = $this->db->query($sql, $parametros);
        return $resultado->fetchObject(self::class);
    }

    public function atualizarNota(): void {
        $sql = "SELECT AVG(nota) FROM avaliacao WHERE id_anime = :id_anime";
        $media = $this->db->query($sql, ["id_anime" => $this->id_anime])->fetchColumn();

        $atualizarNotaQuery = "UPDATE anime SET nota = :media WHERE id_anime = :id_anime";
        $this->db->query($atualizarNotaQuery, ["id_anime" => $this->id_anime, "media" => $media]);
    }
    

    public static function buscarAnimes(array $parametros) {
        $ordenar = $parametros["organizar"];

        $sql = "SELECT * FROM anime";
        if ($ordenar === "nota") {
            $sql .= " ORDER BY nota DESC";
        } elseif ($ordenar === "lancamento") {
            $sql .= " ORDER BY ano_lancamento";
        } elseif ($ordenar === "acao") {
            $sql .= " WHERE categoria = 'acao'";
        }

        return Aplicacao::$app->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarAnimeAleatorio() {
        $sql = "SELECT * FROM anime ORDER BY rand() limit 3";
        return Aplicacao::$app->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function bannerAnime() {
?>
        <swiper-container id='banner' class="bannerSwiper" autoplay-delay="3500" autoplay-disable-on-interaction="false" effect="fade" loop="true">
            <?php foreach (self::buscarAnimeAleatorio() as $anime) : ?>
                <swiper-slide>
                    <?php include '../app/views/layouts/anime_banner.php'; ?>
                </swiper-slide>
            <?php endforeach; ?>
        </swiper-container>
    <?php
    }

    public static function listarAnimes(array $parametros = []) {
        $titulo = $parametros["titulo"];
        $animes = self::buscarAnimes($parametros);
    ?>
        <div class="container-swiper">
            <div class="title">
                <h1><?= $titulo; ?></h1>
            </div>
            <?php include '../app/views/layouts/anime_lista.php'; ?>
        </div>
<?php
    }
}
