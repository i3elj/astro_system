<?php

namespace Cardapio;

require_once 'src/services/DatabaseConnection.php';

class Model
{
	use \Services\DatabaseConnection;

	/**
	 * Get the Current User menu
	 *
	 * @param string $cpf Unique user's identifier.
	 * @return array
	 */
	protected function get_menu($cpf)
	{
		$rows = $this->query_return(
			'SELECT name, cost, ingredients FROM dishes WHERE fk_user = ?',
			[$cpf]
		);

		if (sizeof($rows) == 0)
			return [];

		return $rows[0];
	}
}
