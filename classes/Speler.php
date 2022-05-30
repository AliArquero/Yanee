<?php

class Speler {
	public function __construct() {
		//Call the databaseconnection
		$this->connection = db::connect();
	}

    public function get($id = null)
    {
        if($id == null){
            $sql = "SELECT speler.id AS spelerId, roepnaam, achternaam, tussenvoegsels, school.naam as schoolnaam, naam 
                        FROM speler 
                        INNER JOIN school ON speler.schoolId = school.id";
            $stmt = $this->connection->prepare($sql);
		    $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        $sql = "SELECT speler.id AS spelerId, roepnaam, achternaam, tussenvoegsels, school.naam as school, naam 
                    FROM speler 
                    INNER JOIN school ON speler.schoolId = school.id
                    WHERE speler.id = $id";
            $stmt = $this->connection->prepare($sql);
		    $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
    }

    public function add($roepnaam, $tussenvoegsels, $achternaam, $schoolId) 
    {
        $sql = "INSERT INTO speler (roepnaam, tussenvoegsels, achternaam, schoolId) 
                    VALUES ('$roepnaam', '$tussenvoegsels', '$achternaam', $schoolId)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }
    
    public function getAllSpeler()
    {
        $sql = "select speler.id as spelerId, roepnaam, achternaam, tussenvoegsels, schoolId, naam from speler 
                inner join school on speler.schoolId = school.id";
        $stmt = $this->connection->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $txt = "";
        $txt .= "<table><tr><th>Naam</th><th>Tussenvoegsels</th><th>Achternaam</th><th>School</th></tr>";
        foreach ($result as $row) {
            $txt .= "<tr>";    
            $txt .= "<td>" . $row["roepnaam"] . "</td>";
            $txt .= "<td>" . $row["tussenvoegsels"] . "</td>";
            $txt .= "<td>" . $row["achternaam"] . "</td>";
            $txt .= "<td>" . $row["naam"] . "</td>";
            
            $txt .= "<td><form method=POST><input type=hidden name=spelerId value=" . $row["spelerId"] . ">";
            $txt .= "<input type=submit name=editSpeler value=&#10000>";
            $txt .= "<input type=submit name=deleteSpeler value=&#10060>";
            $txt .= "</form></tr>";
        }
        $txt .= "</table>";

        $txt .= "<form method=post action = 'spelerToevoegen.php'><input type=submit name='insertSpeler' value=&#10133></form>";

        return $txt;

    
    }
    public function getSpeler($id) {
        $sql = "select speler.id as spelerId, roepnaam, achternaam, tussenvoegsels, school.naam from speler
                inner join school on speler.schoolId = school.id
                where speler.id=" . $id;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function toonSpeler($id)
    {
     
        $sql = "select speler.id as spelerId, roepnaam, achternaam, tussenvoegsels, schoolId  from speler
                inner join school on speler.schoolId = school.id
                where speler.id=" . $id;
        $stmt = $this->connection->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        $roepnaam = $row["roepnaam"];   
        $tussenvoegsels = $row["tussenvoegsels"];
        $achternaam = $row["achternaam"];
        $txt = "<input type=hidden name=speler_id value=$id>";
        $txt .= "<label>Roepnaam</label>";
        $txt .= "<input type=text name=roepnaam  value= '$roepnaam'>";
        $txt .= "<label>Tussenvoegsels</label>";
        $txt .= "<input type=text name=tussenvoegsels  value= '$tussenvoegsels'>";
        $txt .= "<label>Achternaam</label>";
        $txt .= "<input type=text name=achternaam  value= '$achternaam'>";
        $txt .= "<label>School</label>";
        $school = new school();
        $txt .= $school->getSchoolOption($row["schoolId"]);
        return $txt;
    }
    
   

    public function updateSpeler($id, $roepnaam, $tussenvoegsels, $achternaam, $schoolId )
    {
        $sql = "update speler
                set roepnaam = '$roepnaam', 
                tussenvoegsels = '$tussenvoegsels',
                achternaam  = '$achternaam',
                schoolId = $schoolId
                where id= $id";
        
        $this->connection->exec($sql);
    }

    public function deleteSpeler($id)
    {
        $sql = "DELETE FROM speler WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        if($stmt->execute()){
            return TRUE;
        }
        return FALSE;
    }
}