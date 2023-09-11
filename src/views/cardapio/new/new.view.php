<?php

require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php';

?>
<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - New Cardapio',
	styles: [
		'/src/views/cardapio/new/new.style.css',
		'/src/views/partials/header.css',
	]
) ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>

	<main>
		<div class='header'>
			<h1>Cardápio - <span>Adicionar Item</span></h1>
		</div>
		<div class='addItems'>
			<div id='mainContent'>
				<form class='newItemContainer'>
					<div class='inputFieldWrapper'>
						<label>Nome do Item</label>
						<input type='text' name=''>
					</div>
					<div class='inputFieldWrapper'>
						<label>Descrição</label>
						<textarea></textarea>
					</div>
					<input type='submit' name=''>
				</form>

				<div class='newItemContainer'>
					<h2>Ingredientes</h2>
					<div id='ingredientsTable' class='tableBorder'>
						<div class='tableRow columnsName'>
							<div class='tableCell'>
								<p>Nome do Ingrediente</p>
							</div>
							<div class='tableCell'>
								<p>Quantidade</p>
							</div>
							<div class='tableCell'>
								<p>Preco</p>
							</div>
							<div class='tableCell'>
								<p>Options</p>
							</div>
						</div>
						<div class='tableRow'>
							<div class='tableCell'>
								<p>Arroz</p>
							</div>
							<div class='tableCell'>
								<p>1kg</p>
							</div>
							<div class='tableCell'>
								<p>R$</p>
								<p>5.00</p>
							</div>
							<div class='tableCell'>
								<button class='button input'>Editar</button>
								<button class='button input'>Excluir</button>
							</div>
						</div>
						<div class='tableRow'>
							<div class='tableCell'>
								<p>Macaxeiraaaaaaaaaaaaaaaa</p>
							</div>
							<div class='tableCell'>
								<p>1kg</p>
							</div>
							<div class='tableCell'>
								<p>R$</p>
								<p>5.00</p>
							</div>
							<div class='tableCell'>
								<button class='button input'>Editar</button>
								<button class='button input'>Excluir</button>
							</div>
						</div>
						<div class='tableRow'>
							<div class='tableCell'>
								<p>Arroz</p>
							</div>
							<div class='tableCell'>
								<p>1kg</p>
							</div>
							<div class='tableCell'>
								<p>R$</p>
								<p>150.00</p>
							</div>
							<div class='tableCell'>
								<button class='button input'>Editar</button>
								<button class='button input'>Excluir</button>
							</div>
						</div>
						<div class='tableRow'>
							<div class='tableCell'>
								<p>Arroz</p>
							</div>
							<div class='tableCell'>
								<p>1kg</p>
							</div>
							<div class='tableCell'>
								<p>R$ </p>
								<p>5.00</p>
							</div>
							<div class='tableCell'>
								<button class='button input'>Editar</button>
								<button class='button input'>Excluir</button>
							</div>
						</div>
					</div>
					<div class='inputWrapper'>
						<input class='input' type="text" name="name" placeholder='Ex: Arroz' />
						<input class='input' type="text" name="amount" placeholder='Ex: 500ml' />
						<input class='input' type="number" min="0" step=".01" name="price" placeholder='Ex: 15,00' />
						<button onclick="addItem()">Adicionar</button>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

<script type='module' src='/src/views/cardapio/new/new.js'></script>
<script src='/public/lib/resize.js'></script>

</html>
