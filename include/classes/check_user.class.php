<?php

class check_user
{

    /*public static function validate(Array $userdata)
    {
        if (!array_key_exists("username", $userdata)) {
            throw new InvalidArgumentException("Brukernavn må oppgis!");
        }

        if (!array_key_exists("passord", $userdata)) {
            throw new InvalidArgumentException("Passord må oppgis!");
        }

        $query_check_user = "SELECT `id`, `brukernavn`, `email`, `passord` FROM brukere WHERE `brukernavn` = :username";       
        $statement = Db::getPDO() ->prepare($query_check_user);
        $statement->execute([
            ":username" => $userdata["username"]
        ]);
        $user = $statement.fetchObject();

        if ($user !== false) {
            $user_id -> $user;
        }
    }*/

    public static function register(Array $userdata)
    {
        if (!array_key_exists("username", $userdata)) {
            throw new InvalidArgumentException("Brukernavn må oppgis!");
        }

        if (!array_key_exists("passord", $userdata)) {
            throw new InvalidArgumentException("Passord må oppgis!");
        }

        if (!array_key_exists("email", $userdata)) {
            throw new InvalidArgumentException("Email må fylles ut!");
        }
        
        $query_reg_user = "INSERT INTO brukere(`brukernavn`, `email`, `passord`) VALUES(:username, :email, :passord)";

        $hash = password_hash($userdata['passord'], PASSWORD_BCRYPT, ["cost" => 12]);

        $db = Db::getPdo();
        $statement = $db->prepare($query_reg_user);
        $statement->execute([
            ":username" => $userdata["username"],
            ":email" => $userdata["email"],
            ":passord" => $hash
        ]);
    }

    public static function username_exists($username)
    {
        $query_is_user = "SELECT `brukernavn` FROM `brukere` WHERE `brukernavn` = :username";

        $statement = Db::getPDO()->prepare($query_is_user);
        $statement->execute([
            ":username" => $username
        ]);
       
        return $statement->rowCount();
    }

    public static function email_exists($email)
    {
        $query_email_exists = "SELECT `brukernavn` FROM `brukere` WHERE `email` = :email";

        $statement = Db::getPDO()->prepare($query_email_exists);
        $statement->execute([
            ":email" => $email
        ]);
        
        return $statement->rowCount();
    }

    public static function is_user($username, $passord)
    {
        $query_get_hashed_pw = "SELECT passord FROM brukere WHERE brukernavn = :brukernavn";

        $get_hashed_pw = Db::getPdo()->prepare($query_get_hashed_pw);

        $get_hashed_pw->execute([
            ":brukernavn" => $username
        ]);

        if (password_verify($passord, $get_hashed_pw->fetchObject()->passord)) {
            session_start();
            $_SESSION['user'] = $username;
            return true;
        } else {
            return false;
        }
    }
}
