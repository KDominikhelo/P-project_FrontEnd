<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class User_X_Mention{
    private $id;
    private $comment_id;
    private $task_id;
    private $mentioned_by;
    private $mentioned;
    private $created_at;
    private $deleted_at;
    
    public function __construct($id, $comment_id, $task_id, $mentioned_by, $mentioned, $created_at, $deleted_at) {
        $this->id = $id;
        $this->comment_id = $comment_id;
        $this->task_id = $task_id;
        $this->mentioned_by = $mentioned_by;
        $this->mentioned = $mentioned;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getComment_id() {
        return $this->comment_id;
    }

    public function getTask_id() {
        return $this->task_id;
    }

    public function getMentioned_by() {
        return $this->mentioned_by;
    }

    public function getMentioned() {
        return $this->mentioned;
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

    public function setComment_id($comment_id): void {
        $this->comment_id = $comment_id;
    }

    public function setTask_id($task_id): void {
        $this->task_id = $task_id;
    }

    public function setMentioned_by($mentioned_by): void {
        $this->mentioned_by = $mentioned_by;
    }

    public function setMentioned($mentioned): void {
        $this->mentioned = $mentioned;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }

    public static function mentionUser($mentioned, $mentionedBy, $comment, $task){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL mentionUser(?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $mentioned, PDO::PARAM_INT);
            $stmt->bindParam(2, $mentionedBy, PDO::PARAM_INT);
            $stmt->bindParam(3, $comment, PDO::PARAM_INT);
            $stmt->bindParam(4, $task, PDO::PARAM_INT);

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
    
    public static function deleteMention($id){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteMention(?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

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

