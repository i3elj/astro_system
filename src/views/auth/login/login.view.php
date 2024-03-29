<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - Login',
	styles: ['/src/views/auth/auth.css']
) ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>
	<main id='authContainer'>
		<h1>Login</h1>

		<p id='loginError'></p>

		<form id='form'
			hx-post='/login' hx-trigger='submit'
			hx-target='#loginError' hx-swap='innerHTML'
		>
			<input class='inputField'
				type='email'
				name='email'
				placeholder='Type your email'
				required
			/>

			<input class='inputField'
				type='password'
				name='password'
				placeholder='Type your password'
				required
			/>

			<input id='submitButton' type='submit' value='Authenticate' />
		</form>
	</main>
</body>

<script type='module' src='/src/views/auth/login/login.js'></script>

</html>
