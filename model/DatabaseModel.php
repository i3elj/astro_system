<?php

class DatabaseModel
{
	/**
	 * Connects to a database
	 *
	 * @return PDO | PDOException
	 */
	protected function connect()
	{
		$pdo = new PDO('sqlite:database.db');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	}

	/**
	 * Runs a query in the database.
	 *
	 * @param string $query_string The query you want to run
	 * @param array $values All the values the query needs
	 * @return void
	 */
	protected function query($query_string, $values = [])
	{
		$stmt = $this->connect()->prepare($query_string);

		$succeeded = $stmt->execute($values);

		if (!$succeeded) {
			printf("Prepare statement error: " . $stmt);
			$stmt = null;
			exit(1);
		}
	}

	/**
	 * Runs a query in the database and return the affected rows.
	 *
	 * @param string $query_string The query you want to run
	 * @param array $values All the values the query needs
	 * @return array
	 */
	protected function queryReturn($query_string, $values = [])
	{
		$stmt = $this->connect()->prepare($query_string);

		$succeeded = $stmt->execute($values);

		if (!$succeeded) {
			printf("Prepare statement error: " . $stmt);
			$stmt = null;
			exit(1);
		}

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
}
