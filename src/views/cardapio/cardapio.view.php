<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php'
?>

<!DOCTYPE html>
<html lang='pt-BR'>

<?= \Tags\head('Astro System - Cardapio') ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>
	<main>
		<div>
			<h1>Cardápio</h1>
		</div>

		<?php if (sizeof($menu_items) == 0) : ?>

			<div>
				<h2>Adicione items no seu cardápio ou importe um arquivo json</h2>
				<div>
					<a href='/cardapio/new'>Adicionar Items</a>
					<form>
						<input id='files' type='file' required />
						<input type='submit' value='Importar Arquivo' />
					</form>
				</div>
			</div>

		<?php else : ?>

			<table>
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



<script type='text/javascript' src='/src/views/cardapio/cardapio.js'></script>

</html>
