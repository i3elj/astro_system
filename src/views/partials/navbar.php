<?php

namespace Tags;

require_once 'src/views/partials/icons.php';

function navbar($is_logged, $path)
{ ?>
	<nav class="container20 row center spread navbar">
		<a href='/home'>
			<h1>Astro</h1>
		</a>

		<div class="container4 row center">

			<?php if ($is_logged) : ?>

				<div class='link-container <?= $path == '/dashboard' ? 'active' : null ?>'>
					<a href='/dashboard'>
						<p>Painel de Controle</p>
					</a>
				</div>

				<div class='link-container <?= $path == '/caixa' ? 'active' : null ?>'>
					<a href='/caixa'>Caixa</a>
				</div>

				<div class='link-container <?= $path == '/contabilidade' ? 'active' : null ?>'>
					<a href='/contabilidade'>Contabilidade</a>
				</div>

				<div class='link-container <?= $path == '/mesas' ? 'active' : null ?>'>
					<a href='/mesas'>Mesas</a>
				</div>

				<div class='link-container <?= $path == '/cardapio' ? 'active' : null ?>'>
					<a href='/cardapio'>Cardápio</a>
				</div>
				<div class='vertical-line'></div>

				<button onclick='logout()'>
					Log Out
				</button>

				<a href='/profile' title='Profile Settings'>
					<?= \Icons\Profile() ?>
				</a>

			<?php else : ?>

				<a href='/signup'>Sign Up</a>
				<a href='/login'>Log In</a>

			<?php endif; ?>
		</div>
	</nav>

	<script type='module' src='/src/views/partials/navbar.js'></script>
<?php }
