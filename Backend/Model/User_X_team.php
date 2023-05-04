<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class User_X_team{
    private $id;
    private $user_id;
    private $role_id;
    private $team_id;
    private $editor;
    private $created_at;
    
    public function __construct($id, $user_id, $role_id, $team_id, $editor, $created_at) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->role_id = $role_id;
        $this->team_id = $team_id;
        $this->editor = $editor;
        $this->created_at = $created_at;
    }

    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getRole_id() {
        return $this->role_id;
    }

    public function getTeam_id() {
        return $this->team_id;
    }

    public function getEditor() {
        return $this->editor;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setRole_id($role_id): void {
        $this->role_id = $role_id;
    }

    public function setTeam_id($team_id): void {
        $this->team_id = $team_id;
    }

    public function setEditor($editor): void {
        $this->editor = $editor;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public static function addToTeam($user, $role, $team, $editor){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL addUserXTeam(?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $user, PDO::PARAM_INT);
            $stmt->bindParam(2, $role, PDO::PARAM_INT);
            $stmt->bindParam(3, $team, PDO::PARAM_INT);
            $stmt->bindParam(4, $editor, PDO::PARAM_BOOL);

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
    
    public static function updateTeamMember($toUpdate, $role, $team,$editor,$updater){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL updateTeamMember(?,?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $team, PDO::PARAM_INT);
            $stmt->bindParam(2, $updater, PDO::PARAM_INT);
            $stmt->bindParam(3, $role, PDO::PARAM_INT);
            $stmt->bindParam(4, $editor, PDO::PARAM_BOOL);
            $stmt->bindParam(5, $toUpdate, PDO::PARAM_INT);
            
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
    
    public static function deleteTeam($team,$deleter,$toDelete){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteTeamMember(?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $team, PDO::PARAM_INT);
            $stmt->bindParam(2, $deleter, PDO::PARAM_INT);
            $stmt->bindParam(3, $toDelete, PDO::PARAM_INT);
            
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

}

?>

