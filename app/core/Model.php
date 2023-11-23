<?php

class Model {
    protected const REGRA_REQUIRED = "required";
    protected const REGRA_EMAIL = "email";
    protected const REGRA_MIN = "min";
    protected const REGRA_MAX = "max";
    protected const REGRA_COMBINAR = "match";
    protected const REGRA_UNICO = "unico";

    protected Database $db;
    protected array $erros;

    public function __construct() {
        $this->erros = [];
        $this->db = Aplicacao::$app->db;
    }

    public function carregarDados($data): void {
        foreach ($data as $chave => $valor) {
            if (property_exists($this, $chave)) {
                $this->{$chave} = filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

    public function getAtributo($atributo) {
        return $this->$atributo;
    }

    public function validar(): bool {
        $regras = $this->regrasValidacao();
        foreach ($regras as $nomeAtributo => $regra) {
            foreach ($regra as $value) {
                $nomeRegra = $value;
                if (is_array($value)) {
                    $nomeRegra = array_keys($value)[0];
                }
                if ($nomeRegra == self::REGRA_REQUIRED && empty($this->$nomeAtributo)) {
                    $this->erros[$nomeAtributo] = "Campo obrigatório";
                } elseif ($nomeRegra == self::REGRA_EMAIL && !filter_var($this->$nomeAtributo, FILTER_VALIDATE_EMAIL)) {
                    $this->erros[$nomeAtributo] = "Email inválido";
                } elseif ($nomeRegra == self::REGRA_MIN && strlen($this->$nomeAtributo) < $value[$nomeRegra]) {
                    $this->erros[$nomeAtributo] = "Campo deve ter pelo menos " . $value[$nomeRegra] . " caracteres";
                } elseif ($nomeRegra == self::REGRA_MAX && strlen($this->$nomeAtributo) > $value[$nomeRegra]) {
                    $this->erros[$nomeAtributo] = "Campo deve ter no máximo " . $value[$nomeRegra] . " caracteres";
                } elseif ($nomeRegra == self::REGRA_COMBINAR && $this->$nomeAtributo != $this->{$value[$nomeRegra]}) {
                    $this->erros[$nomeAtributo] = "Os campos não combinam";
                } elseif ($nomeRegra == self::REGRA_UNICO) {
                    $nomeTabela = strtolower(get_class($this));
                    $sql = "SELECT * FROM {$nomeTabela} WHERE {$nomeAtributo} = :atributo";

                    $stmt = Aplicacao::$app->db->query($sql, ["atributo" => $this->$nomeAtributo]);
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        $this->erros[$nomeAtributo] = "Já existe um registro com este valor";
                    }
                }
            }
        }
        return empty($this->erros);
    }

    protected function regrasValidacao(): array {
        return [];
    }
    
    public function labels(): array {
        return [];
    }

    public function contemErro($atributo): string {
        if (isset($this->erros[$atributo])) {
            return 'invalido';
        }
        return '';
    }

    public function getErro($atributo): string {
        if (isset($this->erros[$atributo])) {
            return $this->erros[$atributo] . '<br>';
        }
        return '';
    }

    protected static function getHtml($nomeArquivo) {
        return require "../app/views/layouts/$nomeArquivo.php";
    }
}
