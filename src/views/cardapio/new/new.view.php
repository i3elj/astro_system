<?php

require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php';

?>
<!DOCTYPE html>
<html>

<?= \Tags\head('Astro System - New Cardapio')  ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>

	<main>
		<div>
			<h1>Cardápio - <span>Adicionar Item</span></h1>
		</div>
		<div>
			<a href='/cardapio'>
				<?= \Icons\LeftArrow() ?>
				Voltar
			</a>
			<div id='mainContent'>
				<div id='newItemInfoContainer'>
					<div>
						<label>Nome do Item</label>
						<input type='text' name=''>
					</div>
					<div>
						<label>Descrição</label>
						<textarea></textarea>
					</div>
					<button>Adicionar Item</button>
				</div>

				<div>
					<h2>Ingredientes</h2>
					<div id='ingredientsTable'>
						<div>
							<div>
								<p>Nome</p>
							</div>
							<div>
								<p>Quantidade</p>
							</div>
							<div>
								<p>Preço</p>
							</div>
							<div>
								<p>Opções</p>
							</div>
						</div>

						<div>
							<div>
								<p>Arroz</p>
							</div>
							<div>
								<p>1kg</p>
							</div>
							<div>
								<p>R$</p>
								<p>5.00</p>
							</div>
							<div>
								<button onclick='requestEdition(0)'>Editar</button>
								<button>Excluir</button>
							</div>
						</div>

					</div>
					<div id='addInputWrapper'>
						<input type='text' name='name' placeholder='Ex: Arroz' />
						<input type='text' name='amount' placeholder='Ex: 500ml' />
						<input type='number' min='0' step='.01' name='price' placeholder='Ex: 15,00' />
						<button onclick='addItem()'>Adicionar</button>
					</div>
					<div disabled id='editInputWrapper' style='display: none'>
						<input type='text' name='name' placeholder='Ex: Arroz' />
						<input type='text' name='amount' placeholder='Ex: 500ml' />
						<input type='number' min='0' step='.01' name='price' placeholder='Ex: 15,00' />
						<button>Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

<script type='module' src='/src/views/cardapio/new/new.js'></script>
<script src='/public/lib/resize.js'></script>

</html>
