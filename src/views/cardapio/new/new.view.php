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
		<div id='main_container' class='container20'>
			<a href='/cardapio' id='go_back'>
				<?= \Icons\LeftArrow() ?>
				Voltar
			</a>
			<div id='content_wrapper'>
				<div id='new_item_container' class='flex'>
					<div class='input_field_wrapper'>
						<label>Nome do Item</label>
						<input
							class='input new_item_input'
							type='text'
							name=''
						/>
					</div>
					<div class='input_field_wrapper'>
						<label>Descrição</label>
						<textarea id='item_description' class='input'></textarea>
					</div>
					<button class='button new_item_input'>
						Salvar</button>
				</div>

				<div id='ingredients_container' class='flex'>
					<h2>Ingredientes</h2>
					<div id='ingredients_table' class='table_border'>
						<div class='table_row columns_name'>
							<div class='table_cell'><p>Nome</p></div>
							<div class='table_cell'><p>Quantidade</p></div>
							<div class='table_cell'><p>Preço</p></div>
							<div class='table_cell'><p>Opções</p></div>
						</div>

						<div class='table_row item_row'>
							<div class='table_cell'>
								<input class='name_value' value='Arroz'/></div>
							<div class='table_cell'>
								<input class='amount_value' value='1kg'/></div>
							<div class='table_cell'>
								<input class='price_value' value='5.00'/></div>
							<div class='table_cell'>
								<button class='button'>Excluir</button></div>
						</div>
					</div>

					<div id='add_input_wrapper' class='input_wrapper'
						hx-post='/api/cardapio/new' hx-trigger='submit'
						hx-target='#ingredients_table' hx-swap='beforeend'
					>
						<input
							class='input'
							type='text'
							name='name'
							placeholder='Ex: Arroz'
						/>
						<input
							class='input'
							type='text'
							name='amount'
							placeholder='Ex: 500ml'
						/>
						<input
							class='input'
							type='number'
							min='0'
							step='.01'
							name='price'
							placeholder='Ex: 15,00'
						/>
						<button class='button add_button'
							onclick='addItem()'>Adicionar</button>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

<script type='module' src='/src/views/cardapio/new/new.js'></script>
<script src='/public/lib/resize.js'></script>

</html>
