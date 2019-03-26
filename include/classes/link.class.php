<?php
    

class Link
{
    //Initialiserer variabler
    private $id;
    private $name;
    private $url;

    //Lager en link
    public function __construct($id = 0, $name = "", $url = "")
    {
        $this->name = $name;
        $this->url = $url;
        $this->id = $id;
    }

    //Hente ut navnet til en link
    public function getName()
    {
        return $this->name;
    }

    //Hente ut URL'en til en link
    public function getURL()
    {
        return $this->url;
    }

    //Hente ut Id'en til en link
    public function getId()
    {
        return $this->id;
    }

    //Slette en link ved bruk av brukernavn og id'en til linken
    public static function deleteLink($username, $linkId)
    {
        $query_get_mapId = "SELECT l.linkid FROM links l LEFT JOIN mapper m ON m.mapId = l.mapId LEFT JOIN bibliotek b ON b.bibId = m.bibId LEFT JOIN brukere br ON b.id = br.id WHERE br.brukernavn = :username AND l.linkId = :linkId";

        $stmt = Db::getPdo()->prepare($query_get_mapId);

        $stmt->execute([
            ":linkId" => $linkId,
            ":username" => $username
        ]);

        if ($stmt->rowCount()) {
            $stmt = Db::getPdo()->prepare("DELETE FROM links WHERE linkid = :linkId");
            return $stmt->execute([":linkId" => $linkId]);
        } else {
            return false;
        }
    }
}

