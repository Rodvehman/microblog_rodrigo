<?php 
    class Utils{
        public static function sanitizar(mixed $valor, string $tipoSanitizacao = 'texto'):mixed{
            
            switch($tipoSanitizacao){
                case 'inteiro':
                    return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
                case 'email':
                    return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));
                default:
                    return trim(filter_var($valor,FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }
        }

        // Ao chamar o método verificarSenha, passamos para ele a senha digitada no formulário e a senha existente no banco
        public static function verificarSenha(string $senhaDigitadaNoFormulario, string $senhaArmazenadaNoBanco){
            // Usamos o password_verify para comparar as duas senhas.
            if (password_verify($senhaDigitadaNoFormulario, $senhaArmazenadaNoBanco)){
                // São iguai? Então retorne a mesma senha já existente no banco.
                return $senhaArmazenadaNoBanco;
            } else {
                // self é para acessar recursos estáticos na mesma classe (Utils)
                // São diferentes? Então pegue a senha digitada e forneça um novo hash
                return self::codificaSenha($senhaDigitadaNoFormulario);
            }
        }

        public static function codificaSenha(string $valorSenhha): string{
            return password_hash($valorSenhha, PASSWORD_DEFAULT);

        }

        public static function mostrarVardump(mixed $novoUsuario): void{
            echo '<pre>';
            var_dump($novoUsuario);
            echo '</pre>';
            
        }

        // Redireciona para a página desejada.
        public static function redirecionarPara(string $pagina):void {
            header("location:$pagina");
            exit;
        }

        // 

    };    
?>