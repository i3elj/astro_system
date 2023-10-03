<?php

require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php';

?>
<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - New Cardapio',
	styles: [
		'/src/views/cardapio/new/new.css',
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
			<a href="/cardapio" class="goBack">
				<?= \Icons\LeftArrow() ?>
				Voltar
			</a>
			<div id='mainContent'>
				<div id='newItemInfoContainer' class='newItemContainer'>
					<div class='inputFieldWrapper'>
						<label>Nome do Item</label>
						<input class='input inputFieldWrapper_input' type='text' name=''>
					</div>
					<div class='inputFieldWrapper'>
						<label>Descrição</label>
						<textarea class='input inputFieldWrapper_input'></textarea>
					</div>
					<button class='button inputFieldWrapper_input'>Adicionar Item</button>
				</div>

				<div class='newItemContainer'>
					<h2>Ingredientes</h2>
					<div id='ingredientsTable' class='tableBorder'>
						<div class='tableRow columnsName'>
							<div class='tableCell'>
								<p>Nome</p>
							</div>
							<div class='tableCell'>
								<p>Quantidade</p>
							</div>
							<div class='tableCell'>
								<p>Preço</p>
							</div>
							<div class='tableCell'>
								<p>Opções</p>
							</div>
						</div>

						<div class='tableRow itemRow'>
							<div class='tableCell'>
								<p class="nameValue">Arroz</p>
							</div>
							<div class='tableCell'>
								<p class="amountValue">1kg</p>
							</div>
							<div class='tableCell'>
								<p>R$ </p>
								<p class="priceValue">5.00</p>
							</div>
							<div class='tableCell'>
								<button class='button' onclick="requestEdition(0)">Editar</button>
								<button class='button'>Excluir</button>
							</div>
						</div>

					</div>
					<div id='addInputWrapper' class='inputWrapper'>
						<input class='input' type="text" name="name" placeholder='Ex: Arroz' />
						<input class='input' type="text" name="amount" placeholder='Ex: 500ml' />
						<input class='input' type="number" min="0" step=".01" name="price" placeholder='Ex: 15,00' />
						<button class="button" onclick="addItem()">Adicionar</button>
					</div>
					<div disabled id='editInputWrapper' class='inputWrapper' style="display: none">
						<input class='input' type="text" name="name" placeholder='Ex: Arroz' />
						<input class='input' type="text" name="amount" placeholder='Ex: 500ml' />
						<input class='input' type="number" min="0" step=".01" name="price" placeholder='Ex: 15,00' />
						<button class="button saveButton">Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

<script type='module' src='/src/views/cardapio/new/new.js'></script>
<script src='/public/lib/resize.js'></script>

</html>
