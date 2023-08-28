<?php
require_once "views/partials/head.php";
require_once "views/partials/navbar.php"
?>

<!DOCTYPE html>
<html>

<?= Tags\head(
	title: 'Astro System - Mesas',
	styles: ['views/mesas/mesas.style.css']
) ?>

<body>
	<?= \Tags\navbar($auth_token, $this->path) ?>
	<main>
		<div class="searchContainer">
			<h1>Pesquise Por Mesas</h1>
			<div class="horizontal-line"></div>
			<div class="options">
				<div class="optionsContainers">
					<label for="searchBy">Pesquisar Por</label>
					<input type="number" name="searchBy" id="" placeholder="Número">
				</div>
				<div class="optionsContainers">
					<label for="keyWord">Palavras-Chave</label>
					<input type="text" name="keyWord" id="" placeholder="Pesquisar mesa">
				</div>
				<div class="optionsContainers">
					<label for="sortNumber">Ordene Por</label>
					<input type="number" name="sortNumber" id="" placeholder="Número">
				</div>
				<div class="optionsContainers">
					<label for="sortType">Ordenação</label>
					<select name="SortType" id="">
						<option value="crescente">Crescente</option>
						<option value="decrescente">Decrescente</option>
					</select>
				</div>
				<div class="optionsContainers">
					<label for="intensPage">Itens por Página</label>
					<select name="itensPage" id="">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
				</div>
				<input type="submit" value="Pesquisar">
			</div>
		</div>
		<table class="tableList">
			<thead>
				<tr>
					<th>Numero da Mesa</th>
					<th>Descricao</th>
					<th>Ocupada</th>
					<th>Status</th>
					<th>Reservada</th>
					</tr>
			</thead>
			<tbody>
				<tr>
					<td>001</td>
					<td>Praca 2</td>
					<td>Sim</td>
					<td>Aberta</td>
					<td>Nao</td>
				</tr>
				<tr>
					<td>001</td>
					<td>Praca 2</td>
					<td>Sim</td>
					<td>Aberta</td>
					<td>Nao</td>
				</tr>
				<tr>
					<td>001</td>
					<td>Praca 2</td>
					<td>Sim</td>
					<td>Aberta</td>
					<td>Nao</td>
				</tr>
			</tbody>
		</table>
	</main>
</body>

<script type='text/javascript' src='views/mesas/mesas.js'></script>

</html>
