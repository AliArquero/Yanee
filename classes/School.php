<?php
class School {
    public function __construct()
    {
		//Call the databaseconnection
		$this->connection = db::connect();
	}

    public function getSchoolOption( $id = 0)
    {
        $sql = "SELECT * FROM school";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function getSchoolId($naam)
    {
        $sql = "select * from school where naam = :naam";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":naam", $naam);
        $stmt->execute();
        
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["id"];

    }

    public function get($id = null)
    {
        if($id == null){
            $sql = "SELECT * FROM school";
            $stmt = $this->connection->prepare($sql);
		    $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        $sql = "SELECT * FROM school
                WHERE id = $id";
            $stmt = $this->connection->prepare($sql);
		    $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
    }
    
    public function addSchool($naam)
    {
        $sql = "INSERT INTO school (naam) 
                VALUES ('$naam')";
        $stmt = $this->connection->prepare($sql);
		$stmt->execute();
        // return  $this->connection->lastInsertId();

    }
    
    public function updateSchool($id, $naam)
    {
        $sql = "UPDATE school
                SET naam = '$naam'
                WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function deleteSchool($id)
    {
        $sql = "DELETE FROM school WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        if($stmt->execute()){
            return TRUE;
        }
        return FALSE;
    }
}




?>