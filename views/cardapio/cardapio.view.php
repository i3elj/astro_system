<?php
require_once 'views/partials/head.php';
require_once 'views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - Cardapio',
	styles: [
		'/views/cardapio/cardapio.style.css',
		'/views/partials/searchContainer/searchContainer.css',
	]
) ?>

<?= \Tags\navbar($is_logged, $this->path) ?>

<body>
	<main>
		<div class='header'>
			<h1>Cardápio</h1>
		</div>

		<?php if (sizeof($menu_items) == 0) : ?>

			<div class='mainContent'>
				<h2>Adicione items no seu cardápio ou importe um arquivo json</h2>
				<div>
					<button class='button'>Adicionar Items</button>
					<button class='button'>Importar Arquivo</button>
				</div>
			</div>

		<?php else : ?>

			<table class='tableList'>
				<thead>
					<tr>
						<th>Numero da Mesa</th>
						<th>Descrição</th>
						<th>Ocupada</th>
						<th>Reservada</th>
						<th>Status</th>
						<th>Valor</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($table_list as $row) : ?>
						<tr>
							<td><?= $row['id'] ?></td>
							<td><?= $row['location'] ?></td>
							<td><?= $row['is_occupied'] ? 'Sim' : 'Não' ?></td>
							<td><?= $row['is_reserved'] ? 'Sim' : 'Não' ?></td>
							<td><?= $row['status'] ?></td>
							<td><?= $row['bill'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

		<?php endif ?>

	</main>
</body>



<script type='text/javascript' src='/views/cardapio/cardapio.js'></script>

</html>
