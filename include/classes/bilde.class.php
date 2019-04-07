<?php
    

class Bilde
{
    private $id;
    private $bildelink;

    public function __construct($id = 0, $bildelink = "")
    {
        $this->id = $id;
        $this->bildelink = $bildelink;
    }

    public function getLink()
    {
        return $this->bildelink;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public static function delImg($username, $bildeId)
    {
        $query_get_img = "SELECT b.bildeId FROM bilder b LEFT JOIN mapper m ON m.mapId = b.mapId LEFT JOIN bibliotek bib ON bib.bibId = m.bibId LEFT JOIN brukere br ON bib.id = br.id WHERE br.brukernavn = :username AND b.bildeId = :bildeId";

        $stmt = Db::getPdo()->prepare($query_get_img);

        $stmt -> execute([
        ":username" => $username,
        ":bildeId" => $bildeId
        ]);

        if ($stmt->rowCount()) {
            $stmt = Db::getPdo()->prepare("DELETE FROM bilder WHERE bildeId = :bildeId");
            return $stmt->execute([":bildeId" => $bildeId]);
        } else {
            return false;
        }
    }

}