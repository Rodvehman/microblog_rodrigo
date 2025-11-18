<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Models/Usuario.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";

require_once "../src/Services/AutenticacaoServico.php";
    AutenticacaoServico::exigirLogin();
	AutenticacaoServico::exigirAdmin();

require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir notícia
		</h2>

			

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>