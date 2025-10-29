<?php

    // src/Helpers/Utils.php

    class Utils{
        // Usamos mixed para sinalizar que o método aceita/retorna tipos de dados variados
        public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'):mixed {
            switch ($tipoDeSanitizacao){
                case 'inteiro':
                    return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
                        
                case 'email':
                    return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));

                default:
                    return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }
    }
?>