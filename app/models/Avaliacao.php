<?php

class Avaliacao extends Model {
    protected string $id_avaliacao;
    protected string $id_anime;
    protected string $id_usuario;
    protected string $nota;
    protected string $resenha;

    public function adicionarAvaliacao() {
        $sql = "INSERT INTO avaliacao (id_anime, id_usuario, nota, resenha)
                VALUES (:id_anime, :id_usuario, :nota, :resenha)";
        $parametros = [
            'id_anime' => $this->id_anime,
            'id_usuario' => $this->id_usuario,
            'nota' => $this->nota,
            'resenha' => $this->resenha
        ];

        if ($this->db->query($sql, $parametros)) {
            return true;
        }
        return false;
    }

    public function deletarAvaliacao($id_avaliacao) {
        $sql = "DELETE FROM avaliacao WHERE id_avaliacao = :id_avaliacao";
        $parametros = [
            'id_avaliacao' => $id_avaliacao
        ];
        if ($this->db->query($sql, $parametros)) {
            
            return true;
        }
        return false;
    
    }

    public function buscarPorIdAnimeUsuario($idUsuario, $idAnime) {
        $sql = "SELECT * FROM avaliacao WHERE id_usuario = :idUsuario AND id_anime = :idAnime";
        $parametros = [
            'idUsuario' => $idUsuario,
            'idAnime' => $idAnime
        ];
        $resultado = $this->db->query($sql, $parametros);
        if ($resultado->rowCount() > 0) {
            return $resultado->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public static function listarAvaliacoes($id_anime) {
        $sql = "SELECT * FROM avaliacao WHERE id_anime = :id_anime";
        return Aplicacao::$app->db->query($sql, ['id_anime' => $id_anime])->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTotalLike($id){
        $sql = "SELECT COUNT(*) FROM interacao_avaliacao WHERE id_avaliacao = :id AND tipo_interacao = 'l'";
        $resultado = Aplicacao::$app->db->query($sql, ['id' => $id]);
        return $resultado->fetchColumn();
    }

    public static function getTotalDisLike($id) {
        $sql = "SELECT COUNT(*) FROM interacao_avaliacao WHERE id_avaliacao = :id AND tipo_interacao = 'd'";
        $resultado = Aplicacao::$app->db->query($sql, ['id' => $id]);
        return $resultado->fetchColumn();
    }
}
