<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - Menu',
	styles: ['views/menu/menu.style.css']
) ?>

<body>
	<?= \Tags\navbar($auth_token, $this->path) ?>
	<h1>Hello from Menu</h1>
</body>
<script type='text/javascript' src='views/menu/menu.js'></script>

</html>
