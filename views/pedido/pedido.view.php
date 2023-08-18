<form action="/editar/pedido" method="POST">
	<label for="nome">Prato:</label>
	<input tye="text" name="nome" placeholder="<?= $nome ?>" />
	<label for="quantidade">Quantidade:</label>
	<input tye="text" name="quantidade" placeholder="<?= $quantidade ?>" />
	<button type="submit">Atualizar</button>
</form>
