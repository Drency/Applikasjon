<?php

class Db
{
    public static function getMysqli()
    {
        $link = @new mysqli("localhost", "root", "", "app");

        if (!$link->ping()) {
            echo "Error: Connection to database failed";
            die();
        }
    }

    public static function getPdo()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=app;charset=utf8", "root", "");

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            return $pdo;
        } catch (Exception $e) {
            echo "Error: connection to database failed";
            die();
        }
    }
}
