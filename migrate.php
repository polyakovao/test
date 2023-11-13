<?php
require_once 'connection.php';

class Migrations extends Connection
{
    public function migrate()
    {
        $dbh = $this->setConnection();

        //part 1 migrations
        $sql = "
            CREATE TABLE IF NOT EXISTS users
            (
                id          SERIAL,
                firstname   VARCHAR(64)      NOT NULL,
                lastname    VARCHAR(64)      NOT NULL,
                position    VARCHAR(64)      NOT NULL,
                PRIMARY KEY (id)
            );
        ";
        $dbh->query($sql);

        $sql = "
            INSERT INTO users (firstname, lastname, position)
            VALUES
              ('John', 'Doe', 'Менеджер'),
              ('Jane', 'Smith', 'Программист'),
              ('Alice', 'Johnson', 'Тестировщик'),
              ('Bob', 'Brown', 'Программист');
        ";
        $dbh->query($sql);
    }
}

$migrations = new Migrations();
$migrations->migrate();
echo('migrated');