<?php


class Database {
    private PDO | null $conexao;
    
    public function __construct() {
        $this->conexao = $this->getConexao();
    }
    
    private function getConexao() : PDO | null{
        $this->conexao = null;

        try{
            $this->conexao = new PDO(
                "mysql:host=" . Config::DB_HOST .
                ";dbname=" . Config::DB_NOME,
                Config::DB_USUARIO,
                Config::DB_SENHA
            );
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conexao;
    }

    public function query(string $sql, array $parametros = []) : bool | PDOStatement{
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($parametros);
        return $stmt;
    }
}