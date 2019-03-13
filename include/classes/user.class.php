<?php

class User
{
    private $userId;
    private $brukerNavn;
    private $email;
    private $logged_in = false;

    public function __construct($userID)
    {
        $userId = (int) $userId;
        $get_user = "SELECT `brukernavn`, `email` FROM `brukere` WHERE `id` = :id";

        $statement = Db::getPdo()->prepare($get_user);
        $statement->execute([":id" => $userID]);

        if ($statement->rowCount()) {
            $user = $statement->fetchObject();

            $this->userId = $userID;
            $this->brukerNavn = $user->brukernavn;
            $this->email = $user->email;
            $this->logged_in = true;
        }
    }

    public function getUser()
    {
        
    }
}
