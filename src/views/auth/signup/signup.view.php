<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head('Astro System - Sign Up') ?>

<body>
	<?= \Tags\navbar(false, $this->path) ?>
	<div id='authContainer'>
		<h1>Sign Up</h1>
		<p id='loginError'>Vazio</p>
		<form id='form' method='POST' onsubmit='signup(); return false'>
			<input
				type='text'
				name='nickname'
				placeholder='Choose a nickname'
				required
			/>
			<input
				type='text'
				name='realname'
				placeholder='Real (full) name'
				required
			/>
			<div >
				<input
					type='text'
					name='cpf'
					placeholder='CPF ex.000.111.222-33'
					pattern='[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}'
					maxlength='14'
					onfocus='this.select()'
					required
				/>
				<input
					type='tel'
					name='phonenumber'
					placeholder='+55 (33)91111-2222'
					pattern='\+[0-9]{2} \([0-9]{2}\)[0-9]{5}-[0-9]{4}'
					onfocus='this.select()'
					required
				/>
			</div>
			<div >
				<input
					type='email'
					name='email'
					placeholder='Type your email'
					required
				/>
				<input
					type='email'
					placeholder='Confirm your email'
					required
				/>
			</div>
			<div >
				<input
					type='password'
					name='password'
					placeholder='Type your password'
					required
				/>
				<input
					type='password'
					placeholder='Confirm your password'
					required
				/>
			</div>

			<div id='termsOfServiceContainer'>
				<input id='tos' type='checkbox' name='tos' value='yes' />
				<label for='tos'>I agree with the Terms of Service</label>
			</div>

			<input
				id='submitButton'
				type='submit'
				value='Sign'
				disabled
			/>
		</form>
	</div>

	<script type='module' src='/src/views/auth/signup/signup.js'></script>

</body>

</html>
