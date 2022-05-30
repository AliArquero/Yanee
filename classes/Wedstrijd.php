<?php
class Wedstrijd {
    public function __construct()
    {
		//Call the databaseconnection
		$this->connection = db::connect();
    }
    
    public function machtTweeAantal($spelersEersteRonde)
    {
        $counter = 0 ;
        while(TRUE){
            if ((($spelersEersteRonde - 1) & $spelersEersteRonde) == 0) {
                // power of two!
                break;
            }
            $counter++;
            $spelersEersteRonde += 1;
        }
        return $counter;
    }


    //genereer de eerste Ronde. De eerste ronde moet bestaan uit een bepaald hoeveelheid wedstrijden. Factor 2 is hierbij belangrijk.
    //Met de functie machtTweeAantal wordt bekeken of hieraan voldaan wordt. Is dat niet het geval dan gaan we het verschil gerbruken
    // voor de overige wedstrijden. Bij oneven aantal aanmeldingen wordt er ook een oneven aantal dummies ingezet.
    public function genereerRonde1($toernooiId) 
    {
        $ronde = 1;
        //haal alle aanmeldingen op bij dit toernooi
        $sql = "select * from aanmelding 
                inner join speler on speler.id = aanmelding.spelerId
                where aanmelding.toernooiId = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $aantalAanmeldingen = $stmt->rowCount();

        $counter = $this->machtTweeAantal($aantalAanmeldingen);//is het een factor twee aan aanmeldingen?
       
        shuffle($result);//mix de spelers door elkaar

        if($aantalAanmeldingen % 2 == 0){ //maak spelers voor toernooi aan
            for( $index=0; $index < $aantalAanmeldingen ; $index += 2) {
                $speler1 = $result[$index]["spelerId"];
                $speler2 = $result[$index+1]["spelerId"];
                $this->set($toernooiId, $speler1, $speler2, $ronde);
            } 
            //maak dummies aan
            for($y = 0; $y < $counter; $y+=2){
                $speler1 = 0;
                $speler2 = 0;
                $this->set($toernooiId, $speler1, $speler2, $ronde);
            }
        }elseif($aantalAanmeldingen % 2 != 0){   //maak spelers voor toernooi aan
            
            for( $index=0; $index < $aantalAanmeldingen - 1; $index += 2) {
                $speler1 = $result[$index]["spelerId"];
                $speler2 = $result[$index+1]["spelerId"];
                $this->set($toernooiId, $speler1, $speler2, $ronde);
            } 
           
            $speler1 = $result[$index]["spelerId"];
            $speler2 = 0;
            $this->set($toernooiId, $speler1, $speler2, $ronde);
       
            //maak dummies aan
            for($y = 0; $y < $counter - 1 ; $y+= 2 ){
                $speler1 = 0;
                $speler2 = 0;
                $this->set($toernooiId, $speler1, $speler2, $ronde);
            }
        }
        // var_dump($aantalAanmeldingen);
        // var_dump($counter);
        // die;

    }
    
    // Maak een wedstrijd aan
    public function set($toernooiId, $speler1, $speler2, $ronde)
    {
        $sql =  "INSERT INTO wedstrijd (toernooiId, speler1Id, speler2Id, ronde) 
                    VALUES ($toernooiId, $speler1, $speler2, $ronde)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();  
    }

    //haal wedstrijd gegevens op
    public function get($toernooiId)
    {
        $sql = "SELECT * FROM wedstrijd 
                    WHERE toernooiId = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //haal alle wedstrijd van de huidige ronde op
    public function get_gespeelde_games_huidige_ronde($toernooiId, $ronde)
    {
        $sql = "SELECT * FROM wedstrijd 
                    WHERE toernooiId = $toernooiId 
                    AND score1 is not NULL 
                    AND score2 is not NULL
                    AND ronde = $ronde";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Moeten er nog wedstrijden deze ronde gespeeld worden?
    public function check_games_actieve_ronde($toernooiId, $ronde)
    {
        $sql = "SELECT * FROM wedstrijd 
                    WHERE toernooiId = $toernooiId 
                    AND ronde = $ronde 
                    AND score1 is NULL 
                    AND score2 is NULL";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($result)){
            return TRUE; //alle wedstrijden zijn gespeeld
        }
        return FALSE; // er zijn nog wedstrijden die ingevoerd moeten worden
    }

    //wat is de huidige ronde van het toernooi?
    public function get_actieve_ronde()
    {
        $toernooiId = $_SESSION["toernooiId"];
        $sql = "SELECT actieve_ronde FROM toernooi 
                    WHERE id = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["actieve_ronde"];
    }

    //Update de ronde voor het toernooi als alle wedstrijden gespeeld zijn
    public function set_actieve_ronde($ronde )
    {
        $toernooiId = $_SESSION["toernooiId"];
        $volgende_ronde = $ronde + 1;
        $sql = "UPDATE toernooi SET actieve_ronde = $volgende_ronde 
                    WHERE id = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    //Bepaal wie de winnaar van een wedstrijd is en verplaats de winnaar naar de volgende ronde
    public function moveWinners($current_round)
    {
        $next_round = $current_round + 1;
        // var_dump($current_round);
        $toernooiId = $_SESSION["toernooiId"];
        $result = $this->get_gespeelde_games_huidige_ronde( $toernooiId, $current_round);
        $winners = array();

        //create a winner array
        foreach($result as $game){
            $winners[] = $this->getWinner($game["id"]) ;
        }

        //loop the winner array and store in database
        for($x = 0; $x < count($winners); $x+= 2){
            $winner1 = $winners[$x];
            $key = $x+1;
            if( array_key_exists($key, $winners) ){
                $winner2 = $winners[$key];
            }else{
                return FALSE;
            }
            $sql = "INSERT INTO wedstrijd (toernooiId, speler1Id, speler2Id, ronde) 
                        VALUES ( $toernooiId, $winner1, $winner2, $next_round)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        }
        
    }

    //wie is de winnaar van de pot
    public function getWinner($id)
    {
        $sql = "SELECT speler1Id, speler2Id, score1, score2 
                    FROM wedstrijd 
                    WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result["score1"] > $result["score2"] ){
            //speler1 is winner
            return $result["speler1Id"];
        }
        elseif($result["score1"] < $result["score2"]){
            //speler2 is winner
            return $result["speler2Id"];
        }
        //geen speler is winner
        return "";
    }

    // Toon alle wedstrijden
    public function toon($toernooiId) 
    {
        $sql = "SELECT * FROM wedstrijd 
                    WHERE toernooiId = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    
    //sla een ronde wedstrijden op
    public function update($toernooi, $speler1, $speler2, $score1, $score2)
    {
        if($score1 == $score2){ //there must always be a winner
            return FALSE;
        }

        $sql =  "UPDATE wedstrijd SET score1 = $score1, score2 = $score2 
                    WHERE toernooiId = $toernooi
                    AND speler1Id = $speler1
                    AND speler2Id = $speler2";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();   
    }

    //haal een ENKELE wedstrijd op
    public function getSingle($toernooiId, $speler1Id, $speler2Id, $ronde = 1)
    {
        $sql = "SELECT * FROM wedstrijd 
                    WHERE toernooiId = $toernooiId
                    AND ronde = $ronde
                    AND speler1Id = $speler1Id
                    AND speler2Id = $speler2Id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    

   
  
}

?>