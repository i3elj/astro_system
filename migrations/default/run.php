<?php

require_once "model/DatabaseModel.php";

class DefaultMigrations extends DatabaseModel
{
    public function InitDatabase()
    {
        $this->CreateTables();
        $this->PopulateTables();
    }

    private function CreateTables()
    {
        $tables = [
            "users" => "CREATE TABLE users (
                cpf             BIGINT PRIMARY KEY,
                nickname        TEXT,
                real_name       TEXT,
                email           VARCHAR,
                password        VARCHAR,
                auth_token      VARCHAR,
                phone_number    TEXT,
                permissions     TEXT,
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
                is_reserved     BOOLEAN,
                is_occupied     BOOLEAN
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

    private function PopulateTables()
    {
        $queries = [
            "users" => "INSERT INTO users VALUES (
                91762124084,
                'jeff',
                'Jeromy Filipe',
                'ad@min',
                'admin',
                '+557728161101',
                'superuser',
                'admin'
            );",
            "dishes" => "INSERT INTO dishes(name, cost, ingredients) VALUES (
                'Hot Chocolate',
                8.99,
                'milk,chocolate,cinnamon,maize starch,sugar,milk cream'
            );",
            "ingredients" => [
                "INSERT INTO ingredients(name) VALUES ('mayonnaise');",
                "INSERT INTO ingredients(name) VALUES ('pickles');",
                "INSERT INTO ingredients(name) VALUES ('onion');",
                "INSERT INTO ingredients(name) VALUES ('chicken breast');",
                "INSERT INTO ingredients(name) VALUES ('tomato');",
                "INSERT INTO ingredients(name) VALUES ('cheese');",
                "INSERT INTO ingredients(name) VALUES ('lettuce');",
                "INSERT INTO ingredients(name) VALUES ('milk');",
                "INSERT INTO ingredients(name) VALUES ('chocolate');",
                "INSERT INTO ingredients(name) VALUES ('cinnamon');",
                "INSERT INTO ingredients(name) VALUES ('sugar');",
                "INSERT INTO ingredients(name) VALUES ('milk cream');",
                "INSERT INTO ingredients(name) VALUES ('maize starch');",
            ],
            "tables" => [
                "INSERT INTO tables VALUES (0,'plaza1',0,false,false);",
                "INSERT INTO tables VALUES (1,'plaza1',0,false,true);",
                "INSERT INTO tables VALUES (2,'plaza2',0,false,true);",
                "INSERT INTO tables VALUES (3,'plaza3',0,true,false);",
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

$migration = new DefaultMigrations();
$migration->InitDatabase();
