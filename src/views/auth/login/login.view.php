<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head('Astro System - Log In') ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>
	<main id='authContainer'>
		<h1>Login</h1>
		<p id='loginError'>Vazio</p>
		<form id='form' onsubmit='login(); return false'>
			<input type='email' name='email' placeholder='Type your email' required />
			<input type='password' name='password' placeholder='Type your password' required />
			<input id='submitButton' type='submit' value='Authenticate' />
		</form>
	</main>
</body>

<script type='module' src='/src/views/auth/login/login.js'></script>

</html>
