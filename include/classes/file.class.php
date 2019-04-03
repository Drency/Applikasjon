<?php

class File{

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

    public function getUrl()
    {
        return $this->url;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function deleteFile($username, $filId)
    {
        $query_get_fil = "SELECT f.filId FROM filer f LEFT JOIN mapper m ON m.mapId = f.mapId LEFT JOIN bibliotek b ON b.bibId = m.bibId LEFT JOIN brukere br ON b.id = br.id WHERE br.brukernavn = :username AND f.filId = :filId";

        $stmt = Db::getPdo()->prepare($query_get_fil);

        $stmt -> execute([
        ":username" => $username,
        ":filId" => $filId
        ]);

        if ($stmt->rowCount()) {
            $stmt = Db::getPdo()->prepare("DELETE FROM filer WHERE filId = :filId");
            return $stmt->execute([":filId" => $filId]);
        } else {
            return false;
        }
    }
}
