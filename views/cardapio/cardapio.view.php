<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - Cardapio',
	styles: ['views/cardapio/cardapio.style.css']
) ?>

<body>
	<?= \Tags\navbar($auth_token, $this->path) ?>
	<h1>Hello from Cardapio</h1>
</body>

<script type='text/javascript' src='views/cardapio/cardapio.js'></script>

</html>
