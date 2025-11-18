<?php
	require_once "../src/Database/Conecta.php";
	require_once "../src/Helpers/Utils.php";
	require_once "../src/Services/AutenticacaoServico.php";
	require_once "../src/Services/NoticiaServico.php";

	AutenticacaoServico::exigirLogin();

	$erro = null;
	$noticias = [];
	$noticiaServico = new NoticiaServico();

	try {
		$noticias = $noticiaServico->buscar();
		Utils::dump($noticias);
	} catch (\Throwable $e) {
		$erro = "Erro ao buscar notícias. <br>".$e->getMessage();
	}

	require_once "../includes/cabecalho-admin.php";
	class Noticia
	{
		private ?int $id;
		private ?string $data;
		private string $titulo;
		private string $texto;
		private string $resumo;
		private string $imagem;
		private int $usuarioId;

		public function __construct(
			string $titulo,
			string $texto,
			string $resumo,
			string $imagem,
			int $usuarioId,
			?int $id = null,
			?string $data = null
		) {
			$this->setTitulo($titulo);
			$this->setTexto($texto);
			$this->setResumo($resumo);
			$this->setImagem($imagem);
			$this->setUsuarioId($usuarioId);
			$this->setId($id);
			$this->setData($data);
		}


		public function setId(?int $id): void
		{
			$this->id = $id;
		}
		public function getId(): ?int
		{
			return $this->id;
		}
		public function setData(?string $data): void
		{

			$this->data = $data;
		}
		public function getData(): ?string
		{
			return $this->data;
		}
		public function setTitulo(string $titulo): void
		{
			$this->titulo = $titulo;
		}
		public function getTitulo(): string
		{
			return $this->titulo;
		}
		public function setTexto(string $texto): void
		{
			$this->texto = $texto;
		}
		public function getTexto(): string
		{
			return $this->texto;
		}
		public function setResumo(string $resumo): void
		{
			$this->resumo = $resumo;
		}
		public function getResumo(): string
		{
			return $this->resumo;
		}
		public function setImagem(string $imagem): void
		{
			$this->imagem = $imagem;
		}
		public function getImagem(): string
		{
			return $this->imagem;
		}

		public function setUsuarioId(int $usuarioId): void
		{
			$this->usuarioId = $usuarioId;
		}
		public function getUsuarioId(): int
		{
			return $this->usuarioId;
		}
	}
?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">Notícias <span class="badge bg-dark">X</span></h2>

		<?php if ($erro): ?>
			<p class="alert alert-danger text-center"> <?= $erro ?> </p>
		<?php endif; ?>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>				
						<th>Autor</th>

						<th class="text-center" colspan="2">Operações</th>
					</tr>
				</thead>

				<tbody>


					<tr>
                        <td> Título... </td>
                        <td> Data... </td>
						<td> Autor... </td>
						

						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						</td>
						<td>
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>

				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../includes/rodape-admin.php";
?>