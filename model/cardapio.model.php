<?php

require_once 'services/DatabaseConnection.php';

class CardapioModel
{
	use \Database\Connection;

	/**
	 * Get the Current User menu
	 *
	 * @param string $cpf Unique user's identifier.
	 * @return array
	 */
	protected function getMenu($cpf)
	{
		$rows = $this->queryReturn(
			'SELECT name, cost, ingredients FROM dishes WHERE fk_user = ?',
			[$cpf]
		);

		if (sizeof($rows) == 0)
			return [];

		return $rows[0];
	}
}
