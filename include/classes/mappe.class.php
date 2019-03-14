<?php

class Mappe
{

    public static function add_mappe($mappenavn)
    {
        $query_get_bibId = "SELECT bibId FROM bibliotek, brukere WHERE brukere.brukernavn = :username AND brukere.id = bibId;";
        $db = Db::getPdo();
            
        $getBib = $db -> prepare($query_get_bibId);
        $getBib->execute([
            ":username" => $_SESSION['user']
        ]);
        
        $bibId = $getBib->fetchColumn();

        $query_set_mappenavn = "INSERT INTO mapper(`mappeNavn`, `bibID`) VALUES(:mappenavn, :bibId);";
            
        $statement = $db->prepare($query_set_mappenavn);
        $statement->execute([
            ":mappenavn" => $mappenavn,
            ":bibId" => $bibId
        ]);
    }
}
