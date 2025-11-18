<?php

// src/Services/UsuarioServico.php

class UsuarioServico{
    private PDO $conexao;

    public function __construct()
    {
        // Toda vez que criarmos um objeto baseado na classe UsusarioServico, este objeto fará uma chamada ao método de conexão da classe Conecta
        $this->conexao = Conecta::getConexao();
    }

    // Métodos CRUD

    // Insert (CREATE)
    public function inserir(Usuario $dadosDoUsuario):void {
        $sql = "INSERT INTO usuarios(nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $dadosDoUsuario->getNome());
        $consulta->bindValue(":email", $dadosDoUsuario->getEmail());
        $consulta->bindValue(":senha", $dadosDoUsuario->getSenha());
        $consulta->bindValue(":tipo", $dadosDoUsuario->getTipo());

        $consulta->execute();
    }

    // Buscar (SELECT)
    public function buscar():array{
        $sql = "SELECT * FROM usuarios";
        // Quando é um comando sem parâmetros, pode executá-lo direto
        $consulta = $this->conexao->query($sql);
        return $consulta->fetchAll();
    }

    // buscarPorId (SELECT / WHERE)
    public function buscarPorId(int $valorId):?array {
        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $valorId);
        $consulta->execute();
        // Sobre o ?: "Elvis Operator" -> condicional simplificada/abreviada em que, se a condição for válida, ela mesma é retornada, caso contrário retorna null
        return $consulta->fetch() ?: null;
    }
    
    // atualizar (UPDATE/WHERE)
    public function atualizar(Usuario $dadosDoUsuario): void{
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $dadosDoUsuario->getNome());
        $consulta->bindValue(":email", $dadosDoUsuario->getEmail());
        $consulta->bindValue(":senha", $dadosDoUsuario->getSenha());
        $consulta->bindValue(":tipo", $dadosDoUsuario->getTipo());
        $consulta->bindValue(":id", $dadosDoUsuario->getId());

        $consulta->execute();
    }

    public function excluir(int $id):void {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);//Segunda Validação de um parâmetro inteiro -> Boa Prática
        $consulta->execute();
    }

    // buscarPorEmail(SELECT)
    public function buscarPorEmail(string $valorEmail): ?array {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":email", $valorEmail);
        $consulta->execute();
        // O return é TRUE? Então retorne os dados como array (fetch), senão, retorne null
        return $consulta->fetch() ?: null;
    }
}
?>