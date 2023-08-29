<?php

require_once 'services/DatabaseConnection.php';

class MesasModel
{
	use \Database\Connection;

	/**
	 * Returns a list of tables based on number number of rows.
	 *
	 * @param int $amount How many rows it will be retrieved.
	 * @return array Consulted rows.
	 */
	protected function getTableList($amount)
	{
		// TODO: use OFFSET clause to make some type of "pagination"
		$rows = $this->queryReturn(
			"SELECT * from tables LIMIT ?",
			[$amount]
		);

		return $rows;
	}
}
