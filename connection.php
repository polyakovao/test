<?php

class Connection
{
    public function setConnection() {
        define ('DB_HOST', 'dbsap');
        define ('DB_USER','MYSQL_USER');
        define ('DB_PASS', 'MYSQL_PASSWORD');
        define ('DB', 'APDB');

        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB,  DB_USER, DB_PASS);
        $dbh->exec("set names utf8");
        return $dbh;
    }
}