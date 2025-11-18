<?php
	require_once "../src/Database/Conecta.php";
	require_once "../src/Models/Usuario.php";
	require_once "../src/Services/UsuarioServico.php";
	require_once "../src/Helpers/Utils.php";
	require_once "../src/Services/AutenticacaoServico.php";
    AutenticacaoServico::exigirLogin();
	AutenticacaoServico::exigirAdmin();
	
	// Captura o valor do ID e sanitiza, garantindo o inteiro
	$id = Utils::sanitizar($_GET['id']);
	
	// Ao tentar abrir usuario-exclui.php sem o parâmetro id, redirecionamos
	if (!$id) Utils::redirecionarPara('usuarios.php');
	
	// Inicialização de variável de erro e do objeto do serviço
	$erro = null;
	$usuarioServico = new UsuarioServico();
	
	// Se o id passado via URL for o mesmo id do usuário que está logado
	if ($id === $_SESSION['id']){
		// Neste caso, não vamos possibilitar a exclusão e vamos avisar o usuário
		$erro = "Você não pode excluir o seu próprio usuário!";
	} else {
		// Caso contrário, siga em frente (carregue os dados e exclua)
		try {
			$dadosDoUsuario = $usuarioServico->buscarPorId($id);

			// Tente executar o método excluir passando o id de quem será excluído
			$usuarioServico->excluir($id);
			$sucesso = "Usuário excluído com sucesso!";
		} catch (\Throwable $e) {
			// Deu errado? Dispare um erro r monte uma mensagem com detalhes
			$erro = "Erro ao excluir o usuário.<br>".$e->getMessage();
		}	
	}
		
	require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center" href="../admin/usuario-exclui.php?id=<?=$usuario['id']?>">
			Excluir usuário
		</h2>

	<?php if($erro): ?>
		<p class="alert alert-danger text-center"><?=$erro?></p>
	<?php endif;?>

	<?php if($sucesso): ?>
		<p class="alert alert-danger text-center"><?=$sucesso?></p>
	<?php endif;?>
	
	<div class="d-grid gap-2 d-md-block text-center">
		<a href="usuarios.php" class="btn btn-light btn-lg">Voltar</a>
	
	</div>
	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>