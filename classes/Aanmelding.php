<?php
class Aanmelding {
    public function __construct()
    {
		//Call the databaseconnection
		$this->connection = db::connect();
    }
    
    //meld spelers aanv oor een toernooi
    public function aanmelden($spelerId, $toernooiId) {
        //kijk of er een aanmelding is 

        $sql = "SELECT * FROM aanmelding WHERE spelerId = $spelerId AND toernooiId = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $aantalRijen = $stmt->rowCount();

        if ($aantalRijen == 1) {
            $this->deleteAanmelding($spelerId,$toernooiId);
        } else {
            $this->insertAanmelding($spelerId, $toernooiId);
        }
    }

    //insert player and toernooi in databasetable aanmelding
    public function insertAanmelding($spelerId, $toernooiId)
    {
        $sql = "INSERT INTO aanmelding VALUES ($spelerId, $toernooiId)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    //delete player and toernooi from databasetable aanmelding
    public function deleteAanmelding($spelerId, $toernooiId)
    {
        $sql = "DELETE FROM aanmelding WHERE spelerId = $spelerId AND toernooiId = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function get($toernooiId)
    {
        //haal de huidige aanmeldingen op van het toernooi
        $sql = "SELECT speler.id AS spelerId, roepnaam, achternaam, tussenvoegsels, schoolId, 
                    school.naam AS schoolnaam, 
                    aanmelding.spelerId AS aanmelding,  
                    aanmelding.toernooiId AS toernooiId  
                FROM speler 
                LEFT JOIN school ON school.id = speler.schoolId
                LEFT JOIN aanmelding ON aanmelding.spelerId = speler.id
                WHERE toernooiId = $toernooiId";
        $stmt = $this->connection->prepare($sql);
		$stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //take a xml file and import it. If it fails stop application
    public function importeer($bestandsnaam, $toernooiId)
    {
        //lees het bestand
        $xml = simplexml_load_file(PROJECT_PATH. "/xml/".$bestandsnaam) or die("Error: Cannot create object");

        foreach($xml->aanmelding as $row) {
            //haal schoolId op
            $schoolnaam = $row->schoolnaam;
            $school_object = new School();
            $schoolId = $school_object->getSchoolId($schoolnaam);
            if ($schoolId =="" ) {
                //voeg school toe
                $school_object = new School();
                $schoolId  = $school_object->addSchool($schoolnaam);
            }
            //add speler
            $roepnaam = $row->spelervoornaam;
            $tussenvoegsels = $row->spelertussenvoegsels;
            $achternaam = $row->spelerachternaam;

            //check if speler already exists
            $sql = "SELECT voornaam, tussenvoegsels, achternaam, schoolId 
                        FROM speler 
                        WHERE voornaam = $row->spelervoornaam
                        AND tussenvoegsels = $row->spelertussenvoegsels
                        AND achternaam = $row->spelerachternaam
                        AND schoolId = $schoolId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                $id = $result["id"];//speler bestaat al maar kan wel toegevoegd worden aan dit toernooi
            }else{
                $speler_object  = new Speler();//speler bestaat nog niet. Dus aanmaken en aanmelden! Huppakeeh!!
                $id= $speler_object->add($roepnaam, $tussenvoegsels, $achternaam, $schoolId);
            }
            
            //add aanmelding
            $this->insertAanmelding($id, $toernooiId);
        }
        return TRUE;
    }
}
?>