<?php 
<<<<<<< Updated upstream
require_once "../includes/cabecalho-admin.php";
=======
	require_once "../src/Database/Conecta.php";
	require_once "../src/Models/Usuario.php";
	require_once "../src/Services/UsuarioServico.php";
	require_once "../src/Helpers/Utils.php";

	require_once "../src/Services/AutenticacaoServico.php";
    AutenticacaoServico::exigirLogin();
	AutenticacaoServico::exigirAdmin();


	//Variável que será Usada para montar mensagens de erro personalizado
	$erro = null;

	// Inicializando um objeto de serviço para CRUD dos usuários
	$usuarioServico = new UsuarioServico();




	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		//Validação de preenchimento dos campos 
		if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['tipo'])){
			$erro = "Preencha todos os campos!";
		}else{
			try {
				//cod
				$nome = Utils::sanitizar($_POST['nome']);
				$email = Utils::sanitizar($_POST['email'],'email');
				$tipo = Utils::sanitizar($_POST['tipo']);
				$senha = Utils::codificaSenha($_POST['senha']);

				$novoUsuario = new Usuario($nome,$email,$senha,$tipo);

				// Executar o serviço e passar os novos dados

				$usuarioServico->inserir($novoUsuario);
				
				$pagina = 'usuarios';
				Utils::redirecionarPara($pagina);

			} catch (\Throwable $e) {
				/*  Se alguma ação detro do try falhar, o PHP vai lançar (usando a classe Throwwable) um erro/exceção.
				    Ao usar o parâmero $e (ou outro nome), temos acesso aos detalhes do que aconteceu. */
				$erro= "Erro ao inserir usuário.<br>".$e->getMessage();
			}
		}
	}

	require_once "../includes/cabecalho-admin.php";
>>>>>>> Stashed changes

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir novo usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir" autocomplete="off">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome">
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email">
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo">
					<option value=""></option>
					<option value="editor">Editor</option>
					<option value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../includes/rodape-admin.php";
?>

