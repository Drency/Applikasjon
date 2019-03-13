<?php

class mappe
{

    public function __construct($mappenavn, $userID)
    {
        $query_set_mappenavn = "INSERT INTO `mapper`(`mappenavn`, `bibId`) VALUES(:mappenavn, :bibId)";

        $query_get_bibId = "SELECT `bibId` FROM `bibliotek` WHERE `bibId` = :userId";

        $db = Db::getPdo();


        $bibId = $db -> prepare($query_get_bibId);


        $statement = $db->prepare($query_set_mappenavn);
        $statement->execute([
            ":mappenavn" => $mappenavn,
            ":bibId" => $bibId
        ]);
    }
}
