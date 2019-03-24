<?php
    

class Link
{

    private $id;
    private $name;
    private $url;

    public function __construct($id = 0, $name = "", $url = "")
    {
        $this->name = $name;
        $this->url = $url;
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getId()
    {
        return $this->id;
    }

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

