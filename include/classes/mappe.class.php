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

    public function del_mappe($navn)
    {
        $query_get_mapId = "SELECT mapId FROM mapper WHERE mappeNavn = :mappenavn";

        $getMapId=Db::getPdo()->prepare($query_get_mapId);

        $getMapId -> execute([
            ":mappenavn" => $navn
        ]);

        $resultat = $getMapId ->fetchColumn();

        $query_del_links = "DELETE FROM links WHERE mapId = :mapId";

        $delLink = Db::getPdo()->prepare($query_del_links);

        $delLink -> execute([
            ":mapId" => $resultat
        ]);

        $query_del_filer = "DELETE FROM filer WHERE mapId = :mapId";
        
        $delFiler = Db::getPdo()->prepare($query_del_filer);

        $delFiler -> execute([
            ":mapId" => $resultat
        ]);

        $query_del_bilde = "DELETE FROM bilder WHERE mapId = :mapId";

        $delBilder = Db::getPdo()->prepare($query_del_bilde);

        $delBilder -> execute([
            ":mapId" => $resultat
        ]);

        $query_del_mappe = "DELETE FROM mapper WHERE mappeNavn = :mappenavn";

        $stmt = Db::getPdo()->prepare($query_del_mappe);
        $stmt-> execute([
            ":mappenavn" => $navn
        ]);
    }

    public static function addLink($mappenavn, $linkNavn, $url)
    {
        $query_get_mapId = "SELECT mapId FROM mapper WHERE mappeNavn = :mappenavn";

        $getMapId = Db::getPdo()->prepare($query_get_mapId);

        $getMapId -> execute([
            ":mappenavn" => $mappenavn
        ]);

        $mapId = $getMapId->fetchColumn();

        $query_add_link = "INSERT INTO links(linkNavn, linkUrl, mapId) VALUES(:linkNavn, :linkUrl, :mapId)";

        $statement = Db::getPdo()->prepare($query_add_link);

        $statement -> execute([
            ":linknavn" => $linkNavn,
            ":linkUrl" => $url,
            ":mapId" => $mapId
        ]);

    }
}
