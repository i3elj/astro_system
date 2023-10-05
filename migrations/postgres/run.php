<?php

require_once 'src/services/DatabaseConnection.php';
require_once 'lib/extras.php';

class PostgresMigrations
{
	use \Services\Database\Connection;

	public function InitDatabase()
	{
		$this->CreateTables();
		$this->PopulateTables();
	}

	private function CreateTables()
	{
		$tables = [
			'users' => "CREATE TABLE users (
				cpf             VARCHAR(14) PRIMARY KEY UNIQUE,
				nickname        TEXT NOT NULL,
				real_name       TEXT NOT NULL,
				email           VARCHAR NOT NULL,
				password        TEXT NOT NULL,
				auth_token      TEXT NOT NULL,
				phone_number    TEXT,
				permissions     TEXT NOT NULL,
				role            TEXT NOT NULL
			);",
			'dishes' => "CREATE TABLE dishes (
				id              SERIAL PRIMARY KEY UNIQUE,
				fk_user         VARCHAR(14) NOT NULL,
				name            TEXT NOT NULL,
				cost            DECIMAL(10,2),
				ingredients     TEXT NOT NULL,
				FOREIGN KEY (fk_user) REFERENCES users(cpf)
			);",
			'ingredients' => "CREATE TABLE ingredients (
				id 		SERIAL PRIMARY KEY UNIQUE,
				name 	TEXT NOT NULL,
				cost    DECIMAL(1000,2)
			);",
			'tables' => "CREATE TABLE tables (
				id              INTEGER PRIMARY KEY UNIQUE,
				location        TEXT,
				is_occupied     BOOLEAN NOT NULL,
				is_reserved     BOOLEAN NOT NULL,
				status          TEXT NOT NULL,
				bill            DECIMAL(10,2)
			);",
			'orders' => "CREATE TABLE orders (
				id              INT PRIMARY KEY UNIQUE,
				fk_table_id     INT NOT NULL,
				fk_ordered_item INT NOT NULL,
				observations    TEXT,
				created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				expiration_time TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL '2 hours'),
				FOREIGN KEY (fk_table_id) REFERENCES tables(id),
				FOREIGN KEY (fk_ordered_item) REFERENCES dishes(id)
			);"
		];

		foreach ($tables as $table_name => $table) {
			$this->query($table);
			printf("GENERATING $table_name TABLE...\n");
		}
	}

	private function PopulateTables()
	{
		$date = date('m/d/Y h:i:s a', time());
		$dummy_data = [
			'token_key' => '088.136.004-02' . $date,
			'pwd_key' => 'admin' . 'ad@min',
		];
		$auth_token = password_hash($dummy_data['token_key'], PASSWORD_ARGON2I);
		$pwd = password_hash($dummy_data['pwd_key'], PASSWORD_ARGON2I);
		$queries = [
			'users' => "INSERT INTO users
				 VALUES (
					'088.136.004-02',
					'adm',
					'administrator',
					'ad@min',
					:password,
					:authToken,
					'+55 (33)9111-2222',
					'superuser',
					'admin'
			);",
			'tables' => [
				"INSERT INTO tables VALUES (0,'plaza1',true,false,'aberta',0);",
				"INSERT INTO tables VALUES (1,'plaza1',true,false,'aberta',0);",
				"INSERT INTO tables VALUES (2,'plaza2',true,false,'aberta',0);",
				"INSERT INTO tables VALUES (3,'plaza3',false,true,'aberta',0);",
			],
		];

		foreach ($queries as $query_name => $query) {
			if (is_array($query)) {
				foreach ($query as $value) {
					$stmt = $this->connect()->prepare($value);
					$succeeded = $stmt->execute();

					if (!$succeeded) {
						printf("Prepare statement error: " . $stmt);
						$stmt = null;
						exit(1);
					}
				}

				printf("INSERTING VALUE INTO $query_name TABLE...\n");
			} else {
				$stmt = $this->connect()->prepare($query);

				if ($query_name == 'users') {
					$stmt->bindParam(':authToken', $auth_token, PDO::PARAM_STR);
					$stmt->bindParam(':password', $pwd, PDO::PARAM_STR);
				}

				$succeeded = $stmt->execute();

				if (!$succeeded) {
					printf("Prepare statement error: $stmt");
					$stmt = null;
					exit(1);
				}

				printf("INSERTING VALUE INTO $query_name TABLE...\n");
			}
		}
	}
}

$migration = new PostgresMigrations();
$migration->InitDatabase();
