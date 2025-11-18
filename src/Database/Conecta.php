<?php

class Conecta {
    // Variáveis estáticas para as credenciais
    private static $servidor = "localhost"; 
    private static $banco = "microblog_rodrigo";
    private static $usuario = "root"; 
    private static $senha = ""; 

    // Variável estática para armazenar a instância da conexão PDO
    private static $conexao = null;

    /**
     * Tenta estabelecer e retornar a conexão PDO.
     * Se a conexão já existir, retorna a instância existente.
     * @return PDO A instância da conexão PDO.
     */
    public static function getConexao(): PDO {
        // Verifica se a conexão já foi estabelecida
        if (self::$conexao === null) {
            try {
                // Cria a DSN (Data Source Name)
                $dsn = "mysql:host=" . self::$servidor . ";dbname=" . self::$banco . ";charset=utf8";

                // Estabelece a conexão PDO
                self::$conexao = new PDO(
                    $dsn, 
                    self::$usuario, 
                    self::$senha
                );

                // Configurações do PDO (as mesmas do script original)
                // 1. Lançar exceções em caso de erros
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // 2. Retornar arrays associativos por padrão
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $erro) {
                // Encerra o script e exibe o erro se a conexão falhar
                die("🚨 Erro ao conectar com o banco de dados: " . $erro->getMessage());
            }
        }

        // Retorna a instância da conexão (seja a nova ou a existente)
        return self::$conexao;
    }

}

Conecta::getConexao();