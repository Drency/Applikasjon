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

        return $db->lastInsertId();
    }

    public static function del_mappe($brukerNavn, $mappeId)
    {
        $query_del_links = "DELETE FROM links WHERE mapId = :mapId";

        $delLink = Db::getPdo()->prepare($query_del_links);

        $delLink -> execute([
            ":mapId" => $mappeId
        ]);

        $query_del_filer = "DELETE FROM filer WHERE mapId = :mapId";
        
        $delFiler = Db::getPdo()->prepare($query_del_filer);

        $delFiler -> execute([
            ":mapId" => $mappeId
        ]);

        $query_del_bilde = "DELETE FROM bilder WHERE mapId = :mapId";

        $delBilder = Db::getPdo()->prepare($query_del_bilde);

        $delBilder -> execute([
            ":mapId" => $mappeId
        ]);

        $query_del_mappe = "DELETE FROM mapper WHERE mapId = :mapId";

        $stmt = Db::getPdo()->prepare($query_del_mappe);
        $stmt-> execute([
            ":mapId" => $mappeId
        ]);
    }

    public static function getLinks($mapId)
    {
        $id = (int) $mapId;
        $links = array();
        $query_get_links = "SELECT linkId, linkNavn, linkUrl FROM links WHERE mapId = :id";

        $stmt = Db::getPdo()->prepare($query_get_links);

        $stmt->execute([
            ":id" => $id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $links[] = new Link($row['linkId'], $row['linkNavn'], $row['linkUrl']);
        }
        return $links;
    }

    public static function addLink($mapId, $linkNavn, $url)
    {
        $query_link_exists = "SELECT linkNavn FROM links WHERE linkNavn = :linkNavn";

        $checkLink = Db::getPdo()->prepare($query_link_exists);

        $checkLink -> execute([
            ":linkNavn" => $linkNavn
        ]);
        
        if (!$checkLink->rowCount()) {
            $query_add_link = "INSERT INTO links(`linkNavn`, `linkUrl`, `mapId`) VALUES(:linkNavn, :linkUrl, :mapId)";

            $stmt = Db::getPdo()->prepare($query_add_link);

            $stmt-> execute([
                ":linkNavn" => $linkNavn,
                ":linkUrl" => $url,
                ":mapId" => $mapId
            ]);
        }
    }
}
