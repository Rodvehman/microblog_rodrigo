<?php
     class AutenticacaoServico{
        // Verificando se nã há a sessão ativa. 
        public static function iniciarSessao():void {
            if (session_status() !== PHP_SESSION_ACTIVE){
                // Não havendo, inicializa a sessão
                session_start();
            }
        }

        public static function exigirLogin():void {
            // O self é pelo fato de ser método estático (pode ser usado o nome da classe). Não usar o this
            // Verificar se tem sessão
            self::iniciarSessao();
            // $_SESSION -> Array global Associativo
            // Se não existir uma variável de sessão para o Id de um usuário, na prática, é porque não tem ninguém logado.
            if (!isset($_SESSION['id'])){
                Utils::redirecionarPara("../login.php?acesso_proibido");
            }
        }

        public static function login(int $valorId, string $valorNome, string $valorTipo):void {
            self::iniciarSessao();
            // Criando variáveis de sessão com os dados informados
            $_SESSION['id'] = $valorId;
            $_SESSION['nome'] = $valorNome;
            $_SESSION['tipo'] = $valorTipo;

            // Após logar, vá para admin/index.php
            Utils::redirecionarPara('admin/');//já vai automaticamente para index.php
        }

        public static function logout(){
            self::iniciarSessao();
            session_destroy();
            Utils::redirecionarPara("../login.php?saiu");
        }

        public static function exigirAdmin():void {
            self::iniciarSessao();
            
            if ($_SESSION['tipo'] !== 'admin'){
                Utils::redirecionarPara('nao-autorizado.php');
            }
        }
    }

?>