<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System',
	styles: ['/src/views/home/home.css']
) ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>
	<main class='main'>
		<div>
			<h1 class='main-title'>Best Restaurant System Ever!</h1>
			<p class='main-p'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>

		<img class='main-img' src='https://wixplosives.github.io/codux-assets-storage/add-panel/image-placeholder.jpg' />
	</main>
</body>

<!-- <script type='text/javascript' src='/src/views/home/home.js'></script> -->

</html>
