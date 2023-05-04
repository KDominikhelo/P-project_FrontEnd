<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class Milestone{
    private $id;
    private $task_id;
    private $milestone_task_id;
    private $is_deleted;
    
    public function __construct($id, $task_id, $milestone_task_id, $is_deleted) {
        $this->id = $id;
        $this->task_id = $task_id;
        $this->milestone_task_id = $milestone_task_id;
        $this->is_deleted = $is_deleted;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTask_id() {
        return $this->task_id;
    }

    public function getMilestone_task_id() {
        return $this->milestone_task_id;
    }

    public function getIs_deleted() {
        return $this->is_deleted;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTask_id($task_id): void {
        $this->task_id = $task_id;
    }

    public function setMilestone_task_id($milestone_task_id): void {
        $this->milestone_task_id = $milestone_task_id;
    }

    public function setIs_deleted($is_deleted): void {
        $this->is_deleted = $is_deleted;
    }

    public static function addMilestone($taskId,$milestone){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL addMilestone(?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $taskId, PDO::PARAM_INT);
            $stmt->bindParam(2, $milestone, PDO::PARAM_INT);

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
    
    public static function deleteMilestone($taskId){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteMilestone(?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $taskId, PDO::PARAM_INT);

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
    
    public static function getMilestoneStatus($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getMilestoneStatus(?)";
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

