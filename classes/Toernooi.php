<?php

class Toernooi {
    public function __construct()
    {
		//Call the databaseconnection
		$this->connection = db::connect();
    }

    public function get($id = NULL)
    {
        //get all toernooien
        if($id == NULL){
            $sql = "select * from toernooi";
            $stmt = $this->connection->prepare($sql);
		    $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        else{//get one toernooi
            $sql = "SELECT * FROM toernooi WHERE id = $id";
            $stmt = $this->connection->prepare($sql);
		    $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function add($omschrijving, $datum)
    {
        $sql = "INSERT INTO toernooi (omschrijving, datum, status)
                VALUES ('$omschrijving', '$datum', 0)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function update($id, $omschrijving, $datum)
    {
        $sql = "UPDATE toernooi
                SET omschrijving = '$omschrijving',
                datum = '$datum'
                WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function delete($id) {

        $sql = "DELETE FROM toernooi WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        if($stmt->execute()){
            return TRUE;
        }
        return FALSE;
    }



    //get the current status of the tournament. Open or closed?
    public function getStatus($toernooiId) {
        $sql = "SELECT status FROM toernooi WHERE id = $toernooiId";
        $stmt = $this->connection->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["status"];
    }

    //either close or open a toernooi
    public function setStatus($toernooiId, $status)
    {
        $sql = "UPDATE toernooi SET status = $status WHERE id = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function reset($toernooiId)
    {
        $sql = "UPDATE wedstrijd SET score1 = NULL, score2 = NULL WHERE toernooiId = $toernooiId"; //reset all scores
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        //set current round back to 1
        $sql = "UPDATE toernooi SET actieve_ronde = 1
                    WHERE id = $toernooiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        //delete all data except round 1
        $sql = "DELETE FROM wedstrijd
                    WHERE toernooiId = $toernooiId
                    AND ronde != 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }
}
