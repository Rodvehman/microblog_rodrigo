<?php
// src/Helpers/Utils.php

class Utils
{

    /* Usamos mixed para sinalizar que o método aceita/retorna
    tipos de dados variados (string, int, array, float etc) */
    public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'): mixed
    {
        switch ($tipoDeSanitizacao) {
            case 'inteiro':
                return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);

            case 'email':
                return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));

            default:
                return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }


    public static function codificarSenha(string $valorSenha): string
    {
        return password_hash($valorSenha, PASSWORD_DEFAULT);
    }


    /* Ao chamar o método verificarSenha, passamos pra ele
    a senha digitada no formulário e a senha existente no banco. */
    public static function verificarSenha(
        string $senhaDigitadaNoFormulario,
        string $senhaArmazenadaNoBanco
    ): string {
        /* Usamos o password_verify para COMPARAR as duas senhas. */
        if (password_verify($senhaDigitadaNoFormulario, $senhaArmazenadaNoBanco)) {
            // São iguais? Então retorne a mesma senha já existente no banco
            return $senhaArmazenadaNoBanco;
        } else {
            // São diferentes? Então pega a senha digitada e faça um novo hash
            return self::codificarSenha($senhaDigitadaNoFormulario);
        }
    }


    /* Exercício: crie um método chamado dump, faça ele receber
    um parâmetro chamado $dados, e faça aparecer o var_dump dentro da tag <pre> */
    public static function dump(mixed $dados): void
    {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }

    public static function redirecionarPara(string $destino): void
    {
        header("location:" . $destino);
        exit;
    }

    public static function formatarData(string $valorData): string
    {
        return date("d/m/Y H:i", strtotime($valorData));
    }

    public static function upload(?array $arquivo): void
    {

        // Validação inicial. Verifica se:
            // - Não tem arquivo;
            // - Não existe alguma referência na área temporária;
            // - Não for um arquivo que possa/permita envio/upload.
        if (
            !$arquivo ||
            !isset($arquivo["tmp_name"]) ||
            !is_uploaded_file($arquivo["tmp_name"])
        ) {
            throw new Exception("Nenhum arquivo válido foi enviado.");
        }

        // Pasta no Servidor/Site para receber o arquivo
        $pastaDeDestino = "../images/";
        // Validação dos formatos de imagem, sendo o double check, além do HTML
        $formatosPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
        // Definindo tamanho máximo do arquivo. O file só visualiza em bytes
        $tamanhoMaximo = 2 * 1024 * 1024; // 2MB

        // Detectando o formato REAL do arquivo
        $formatoDoArquivoEnviado = mime_content_type($arquivo["tmp_name"]);

        // Se o formato não estiver na lista de formatos permitidos
        if (!in_array($formatoDoArquivoEnviado, $formatosPermitidos)) {
            throw new Exception("Apenas arquivos JPG, PNG, GIF e SVG são permitidos.");
        }

        // Se o tamanho do arquivo for acima do total permitido, irá enviar a mensagem de erro
        if ($arquivo["size"] > $tamanhoMaximo) {
            throw new Exception("O arquivo é muito grande. Tamanho máximo: 2MB.");
        }

        // Montando o nome/caminho do arquivo que será guardado na pasta imagens
        $nomeDoArquivo = $pastaDeDestino . basename($arquivo["name"]);

        // Se não conseguir executar a função move_upload_file, dispara a mensagem de exceção
        if (!move_uploaded_file($arquivo["tmp_name"], $nomeDoArquivo)) {
            throw new Exception("Erro ao mover o arquivo. Código de erro: " . $arquivo["error"]);
        }
    }
}