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
			<h1>Cardápio</h1>
		</div>
		<div class="addItems">
			<div class='subheader'>
				<h2>Adicionar Item</h2>
			</div>
			<div id='mainContent'>
				<div class='newItemContainer'>
					<form>
						<div class='newItemTitle'>
							<label></label>
							<input type='text' name=''>
						</div>
						<div class='newItemDescription'>
							<label></label>
							<textarea></textarea>
						</div>
						<input type='submit' name=''>
					</form>
				</div>

				<div class='vertical-line'></div>

				<div class='newItemIngredients'>
					<h2>Ingredientes</h2>
					<div>
						<table>
							<thead>
								<td>Nome do Prato</td>
								<td>Quantidade</td>
								<td>Preco</td>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

<script src='/public/lib/resize.js'></script>

</html>
