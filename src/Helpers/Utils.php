<?php
// src/Helpers/Utils.php

class Utils {

    /* Usamos mixed para sinalizar que o método aceita/retorna
    tipos de dados variados (string, int, array, float etc) */
    public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'):mixed {
        switch($tipoDeSanitizacao){
            case 'inteiro':
                return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
            
            case 'email':
                return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));
            
            default:
                return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }


    public static function codificarSenha(string $valorSenha):string {
        return password_hash($valorSenha, PASSWORD_DEFAULT);
    }


    /* Ao chamar o método verificarSenha, passamos pra ele
    a senha digitada no formulário e a senha existente no banco. */
    public static function verificarSenha(
        string $senhaDigitadaNoFormulario, string $senhaArmazenadaNoBanco
    ):string {
        /* Usamos o password_verify para COMPARAR as duas senhas. */
        if( password_verify($senhaDigitadaNoFormulario, $senhaArmazenadaNoBanco) ){
            // São iguais? Então retorne a mesma senha já existente no banco
            return $senhaArmazenadaNoBanco;
        } else {
            // São diferentes? Então pega a senha digitada e faça um novo hash
            return self::codificarSenha($senhaDigitadaNoFormulario);
        }
    }


    /* Exercício: crie um método chamado dump, faça ele receber
    um parâmetro chamado $dados, e faça aparecer o var_dump dentro da tag <pre> */
    public static function dump(mixed $dados):void {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }

    public static function redirecionarPara(string $destino):void {
        header("location:".$destino);
		exit;
    }

    public static function formatarData(string $valorData):string {
        return date("d/m/Y H:i", strtotime($valorData));
    }
}