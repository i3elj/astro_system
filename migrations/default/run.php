<?php

require_once "model/DatabaseModel.php";

class DefaultMigrations extends DatabaseModel
{
    public function CreateTables()
    {
        $tables = [
            "users" => "CREATE TABLE users (
                cpf             INT PRIMARY KEY,
                nickname        TEXT,
                real_name       TEXT,
                email           VARCHAR,
                phone_number    TEXT,
                permissions     TEXT[],
                role            TEXT,
                UNIQUE (cpf)
            );",
            "dishes" => "CREATE TABLE dishes (
                id              SERIAL PRIMARY KEY,
                name            TEXT,
                cost            DECIMAL(10,2),
                ingredients     TEXT
            );",
            "ingredients" => "CREATE TABLE ingredients (
                id              SERIAL PRIMARY KEY,
                name            TEXT
            );",
            "tables" => "CREATE TABLE tables (
                id              INT PRIMARY KEY,
                location        TEXT,
                bill            DECIMAL(10,2),
                is_reserved     BIT(1),
                is_occupied     BIT(1)
            );",
            "orders" => "CREATE TABLE orders (
                id              INT PRIMARY KEY,
                fk_table_id     INT,
                fk_ordered_item INT,
                observations    TEXT,
                created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                expiration_time TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL '2 hours'),
                FOREIGN KEY (fk_table_id) REFERENCES tables(id),
                FOREIGN KEY (fk_ordered_item) REFERENCES dishes(id)
            );"
        ];

        foreach ($tables as $table_name => $table) {
            $stmt = $this->connect()->prepare($table);
            $succeeded = $stmt->execute();

            if (!$succeeded) {
                printf("Prepare statement error: " . $stmt);
                $stmt = null;
                exit(1);
            }

            printf("GENERATING $table_name TABLE...\n");
        }
    }
}

$migration = new DefaultMigrations();
$migration->CreateTables();
sleep(1);
