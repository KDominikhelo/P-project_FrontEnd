<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class Attachment{
    private $id;
    private $task_id;
    private $comment_id;
    private $value;
    
    public function __construct($id, $task_id, $comment_id, $value) {
        $this->id = $id;
        $this->task_id = $task_id;
        $this->comment_id = $comment_id;
        $this->value = $value;
    }
    
    public static function getById($id){
        
    }

    public function getId() {
        return $this->id;
    }

    public function getTask_id() {
        return $this->task_id;
    }

    public function getComment_id() {
        return $this->comment_id;
    }

    public function getValue() {
        return $this->value;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTask_id($task_id): void {
        $this->task_id = $task_id;
    }

    public function setComment_id($comment_id): void {
        $this->comment_id = $comment_id;
    }

    public function setValue($value): void {
        $this->value = $value;
    }
    
    public static function uploadAttachment($task,$comment,$path, $user){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL uploadAttachment(?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            
            $stmt->bindParam(1, $task, PDO::PARAM_INT);
            $stmt->bindParam(2, $comment, PDO::PARAM_INT);
            $stmt->bindParam(3, $path, PDO::PARAM_STR);
            $stmt->bindParam(4, $user, PDO::PARAM_INT);

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
    
    public static function deleteAttachment($attachment, $user){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteAttachment(?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            
            $stmt->bindParam(1, $attachment, PDO::PARAM_INT);
            $stmt->bindParam(2, $user, PDO::PARAM_INT);

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