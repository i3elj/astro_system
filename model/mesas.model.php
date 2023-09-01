<?php

require_once 'services/DatabaseConnection.php';

class MesasModel
{
	use \Database\Connection;

	/**
	 * Returns a list of tables based on specific paremeters.
	 *
	 * @param string $keywords Search query.
	 * @param string $sortBy Field to be searched for.
	 * @param string $orderType Ascending or Descending order.
	 * @param string $itemsPerPage How many rows it will be retrieved.
	 * @return array|null Consulted rows.
	 */
	protected function getTableList(
		$keywords,
		$sortBy,
		$orderType,
		$itemsPerPage
	) {
		// TODO: use OFFSET clause to make some type of 'pagination'
		if ($keywords != null) {
			$rows = match ($sortBy) {
				'number' => $this->queryReturn(
					'SELECT * from tables WHERE id = ? LIMIT ?',
					[(int)$keywords, $itemsPerPage]
				),
				'description' => $this->queryReturn(
					'SELECT * from tables WHERE location = ? LIMIT ?',
					[$keywords, $itemsPerPage]
				),
				'occupied' => $this->queryReturn(
					'SELECT * from tables WHERE is_occupied = ? LIMIT ?',
					[$keywords == 'Sim', $itemsPerPage]
				),
				'status' => $this->queryReturn(
					'SELECT * from tables WHERE status = ? LIMIT ?',
					[$keywords, $itemsPerPage]
				),
				'reserved' => $this->queryReturn(
					'SELECT * from tables WHERE is_reserved = ? LIMIT ?',
					[$keywords == 'Sim', $itemsPerPage]
				),
				'bill' => $this->queryReturn(
					'SELECT * from tables WHERE bill = ? LIMIT ?',
					[(float)$keywords, $itemsPerPage]
				),
				default => null,
			};
		} else {
			$rows = $this->queryReturn(
				'SELECT * from tables LIMIT ?',
				[$itemsPerPage]
			);
		}

		return $rows;
	}
}
