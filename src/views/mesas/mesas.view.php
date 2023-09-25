<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php';
?>

<!DOCTYPE html>
<html>

<?= \Tags\head('Astro System - Mesas') ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>
	<main>
		<div>
			<h1>Pesquise Por Mesas</h1>
			<div></div>
			<form>
				<div>
					<label for='sortBy'>Pesquise Por</label>
					<select name='sortBy' id='sortBy'>
						<option value='number'>Número</option>
						<option value='description'>Descrição</option>
						<option value='occupied'>Ocupação</option>
						<option value='status'>Status</option>
						<option value='reserved'>Reserva</option>
						<option value='bill'>Valor</option>
					</select>
				</div>
				<div>
					<label for='keywords'>Palavras-Chave</label>
					<input type='text' name='keywords' id='keywords' placeholder='Pesquisar mesa' autofocus>
				</div>
				<div>
					<label for='orderType'>Ordenação</label>
					<select name='orderType' id='orderType'>
						<option value='ascending'>Crescente</option>
						<option value='descending'>Decrescente</option>
					</select>
				</div>
				<div>
					<label for='itemsPerPage'>Itens por Página</label>
					<select name='itemsPerPage' id='itemsPerPage'>
						<option value='10'>10</option>
						<option value='20'>20</option>
						<option value='50'>50</option>
						<option value='100'>100</option>
					</select>
				</div>
				<input submit' value='Pesquisar'>
			</form>
		</div>
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
	</main>
</body>

<script type='text/javascript' src='/src/views/mesas/mesas.js'></script>

</html>
