<?php

class check_user
{

    private static $user = null;

    public static function validate(Array $userdata)
    {
        if (!array_key_exists("brukernavn", $userdata)) {
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
            return true;
            $hash = $user->passord;

            if (passord_check($userdata["passord"], $hash)) {
                return $user->id;
            }
        }
    }

    public static function loggedIn()
    {
        if (self::$user !== null) {
            return true;
        }
    }

    public static function logout()
    {
        User::$logged_in == false;
    }

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

        $db = Db::getPdo();
        $statement = $db->prepare($query_reg_user);
        $statement->execute([
            ":username" => $userdata["username"],
            ":email" => $userdata["email"],
            ":passord" => $userdata["passord"] //Bytte med hash når pw blir hashet
        ]);

        $return_id = $db->lastInsertId();
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

        $query_is_user = "SELECT `brukernavn`, `passord` FROM `brukere` WHERE `brukernavn` = :brukernavn AND `passord` = :passord";

        $statement = Db::getPDO()->prepare($query_is_user);
        $statement->execute([
            ":brukernavn" => $username,
            ":passord" => $passord
        ]);

        $query_get_id = "SELECT `id` FROM `brukere` WHERE `brukernavn` = :username";

        $get_id = Db::getPdo()->prepare($query_get_id);
        $get_id->execute([
            ":username" => $username
        ]);

        $id = $get_id->fetchColumn();
        

        if ($statement->rowCount()) {
            setcookie($username, $_SERVER['HTTP_USER_AGENT'], time() + (86400 * 30), "/");
            $query_insert_cookies = "INSERT INTO `cookies`(`cookieSession`, `userAgent`, `id`) VALUES(:username, :user_agent, :id)";
            $stmt = Db::getPdo()->prepare($query_insert_cookies);
            $stmt->execute([
                ":username" => $username,
                ":user_agent" => $_SERVER['HTTP_USER_AGENT'],
                ":id" => $id
            ]);
            return $statement->rowCount();
        } else {
            return false;
        }
    }
}
