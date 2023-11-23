<?php


class Form {
    public static function label($dados, $nome) {
        return sprintf('<label for="%s">%s:</label>', $nome, $dados->labels()[$nome] ?? $nome);
    }

    private static function erro($dados, $nome) {
        return sprintf('<div class="erro">%s</div>', $dados->getErro($nome));
    }

    public static function comecar($action, $method) {
        return sprintf('<form action="%s" method="%s">', $action, $method);
    }

    public static function campo($dados, $nome, $tipo = "text", array $params = array()) {
        $label = self::label($dados, $nome);

        $campo = sprintf(
            '<input type="%s" name="%s" class="%s" value="%s" id="%s" required>',
            $tipo,
            $nome,
            $dados->contemErro($nome),
            $dados->getAtributo($nome),
            $params['id'] ?? ''
        );

        return $label . $campo . self::erro($dados, $nome);
    }

    public static function select($dados, $nome, $opcoes) {
        $label = self::label($dados, $nome);

        $select = sprintf(
            '<select name="%s">',
            $nome
        );
        foreach ($opcoes as $valor => $opcao) {
            $select .= sprintf(
                '<option value="%s">%s</option>',
                $valor,
                $opcao
            );
        }
        $select .= '</select>';
        return $label . $select . self::erro($dados, $nome);
    }

    public static function hidden($nome, $opcoes = []) {
        return sprintf(
            '<input type="hidden" name="%s" id="%s" value="%s">',
            $nome,
            $opcoes['id'] ?? '',
            $opcoes['value'] ?? ''
        );
    }

    public static function textArea($nome, $dados = ""){
        if (is_object($dados)) {
            $atributo = $dados->getAtributo($nome);
            
        } else {
            $atributo = $dados;
        }
        
        return sprintf(
            '<textarea name="%s" class="textArea" id="%s" value="%s" required></textarea>',
            $nome,
            $nome,
            $atributo,
        );
    }

    public static function submit($nome) {
        return sprintf('<input type="submit" name="%s" value="%s">', $nome, $nome);
    }

    public static function finalizar() {
        return '</form>';
    }
}