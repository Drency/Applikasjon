<?php
require_once "db.class.php";

class User{
    private $userId;
    private $brukerNavn;
    private $email;
    private $logged_in = false;

    public function __construct($userID) {
        $userId = (int) $userId;
        $query_get_user = "SELECT `brukernavn`, `email` FROM `brukere` WHERE `id` = :id";

        $statement = Db::getPdo()->prepare($query_get_user);
        $statement->execute([":id" => $userID]);

        if ($statement->rowCount()){

            $user = $statement->fetchObject();

            $this->userId = $userID;
            $this->brukerNavn = $user->brukernavn;
            $this->email = $user->email; 
            $this->logged_in = true;
        }
    }

    public static function authenciate(Array $credentials){
        $this->userId = null;

        if (!array_key_exists("brukernavn", $credentials))
            throw new InvalidArgumentException("A username has not been provided.");

        if (!array_key_exists("passord", $credentials))
            throw new InvalidArgumentException("A password has not been provided.");

        $query_get_user = "SELECT `id` FROM `brukere` WHERE `passord` = :hash AND `brukernavn` = :brukernavn";
        $statement = Db::getPdo()->prepare($query_get_user);

        $statement->execute([
            ":hash" => md5($credentials["passord"]),
            ":brukernavn" => $credentials["brukernavn"]
        ]);

        $user = $statement->fetchObject();

        if ($statement->rowCount())
        {
            return $user->id;
        }
        else
        {
            return -1;
        }
    }

}