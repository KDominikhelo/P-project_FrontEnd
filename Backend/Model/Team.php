<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class Team{
    private $id;
    private $name;
    private $creator_id;
    private $created_at;
    private $deleted_at;
    
    public function __construct($id, $name, $creator_id, $created_at, $deleted_at) {
        $this->id = $id;
        $this->name = $name;
        $this->creator_id = $creator_id;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCreator_id() {
        return $this->creator_id;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function getDeleted_at() {
        return $this->deleted_at;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setCreator_id($creator_id): void {
        $this->creator_id = $creator_id;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }

    
    public static function createTeam($name,$img,$creator){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL createTeam(?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $img, PDO::PARAM_STR);
            $stmt->bindParam(3, $creator, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            return true;
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function updateTeam($name,$img,$creator,$id){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL updateTeam(?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $creator, PDO::PARAM_INT);
            $stmt->bindParam(3, $name, PDO::PARAM_STR);
            $stmt->bindParam(4, $img, PDO::PARAM_STR);

            // Eljárás futtatása
            $stmt->execute();
            return true;
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function deleteTeam($creator,$id){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteTeam(?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $creator, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            return true;
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }

    public static function getUserTeams($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getTeamByUserId(?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            // Visszatérési érték lekérdezése
            $result = [];
            $i=0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[$i] = $row;
                $i++;
            }
            
            return $result;
//            $result = $stmt->fetch(PDO::FETCH_ASSOC);
//            return $result;
          
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function getTeam($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getTeamById(?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            // Visszatérési érték lekérdezése
            $result = [];
            $i=0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[$i] = $row;
                $i++;
            }
            
            return $result;
//            $result = $stmt->fetch(PDO::FETCH_ASSOC);
//            return $result;
          
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function getTeamMembers($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getAllTeamMember(?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            // Visszatérési érték lekérdezése
            $result = [];
            $i=0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[$i] = $row;
                $i++;
            }
            
            return $result;
//            $result = $stmt->fetch(PDO::FETCH_ASSOC);
//            return $result;
          
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }

}

?>
