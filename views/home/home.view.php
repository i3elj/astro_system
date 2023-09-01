<?php
require_once 'views/partials/head.php';
require_once 'views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System',
	styles: ['views/home/home.style.css']
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

<script type='text/javascript' src='views/home/home.js'></script>

</html>
<!-- <div id='tableList'>
  <h3>Mesas</h3>
  <ul>
	<?php // foreach ($tables as $table) :
	?>
	  <li>
		<a href='/table/<?php // $table['id']
										?>'>
		  Mesa <?php // $table['id']
						?>
		</a>
	  </li>
	<?php // endforeach
	?>
  </ul>
</div>
<main>
  <?php // if ($params != null) :
	?>
	<div>
	  <h1 class='title'>Mesa <?php // $selected_table['id']
														?></h1>
	  <table id='orderList'>
		<tr>
		  <th>Prato</th>
		  <th>Quantidade</th>
		  <th>Preço</th>
		  <th>Horário</th>
		  <th>Status</th>
		  <th>Mais Ações</th>
		</tr>

		<?php // foreach ($selected_table['orders'] as $order) :
		?>
		  <tr>
			<td class='table-dishName'><?php // $order['dishName']
																	?></td>
			<td class='table-quantity'><?php // $order['quantity']
																	?>x</td>
			<td class='table-price'>R$ <?php // $order['price']
																	?></td>
			<td class='table-hour'><?php // $order['hour']
															?></td>
			<td class='table-status'><?php // $order['status']
																?></td>
		  </tr>
		<?php // endforeach
		?>

		<tr>
		  <?php // $action_url = '/table/' . $selected_table['id'];
			?>
		  <form action=<?php // $action_url
										?> method='POST'>
			<td colspan='2' class='td-input'>
			  <input id='name' type='text' name='dishName' />
			</td>
			<td colspan='2' class='td-input'>
			  <input id='amount' type='number' name='amount' />
			</td>
			<td colspan='2' class='td-input'>
			  <button type='submit'>Adicionar</button>
			</td>
		</tr>
		</form>
	  </table>
	</div>
  <?php // endif
	?>

</main>
</body>
-->
