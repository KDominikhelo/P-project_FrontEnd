<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class Task{
    private $id;
    private $project_id;
    private $title;
    private $content;
    private $estimated_dev_time;
    private $estimated_review_time;
    private $task_id;
    private $priority;
    private $column_id;
    private $deadline;
    private $developer_id;
    private $reviewer_id;
    
    public function __construct($id, $project_id, $title, $content, $estimated_dev_time, $estimated_review_time, $task_id, $priority, $column_id, $deadline, $developer_id, $reviewer_id) {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->title = $title;
        $this->content = $content;
        $this->estimated_dev_time = $estimated_dev_time;
        $this->estimated_review_time = $estimated_review_time;
        $this->task_id = $task_id;
        $this->priority = $priority;
        $this->column_id = $column_id;
        $this->deadline = $deadline;
        $this->developer_id = $developer_id;
        $this->reviewer_id = $reviewer_id;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getEstimated_dev_time() {
        return $this->estimated_dev_time;
    }

    public function getEstimated_review_time() {
        return $this->estimated_review_time;
    }

    public function getTask_id() {
        return $this->task_id;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getColumn_id() {
        return $this->column_id;
    }

    public function getDeadline() {
        return $this->deadline;
    }

    public function getDeveloper_id() {
        return $this->developer_id;
    }

    public function getReviewer_id() {
        return $this->reviewer_id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setProject_id($project_id): void {
        $this->project_id = $project_id;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setContent($content): void {
        $this->content = $content;
    }

    public function setEstimated_dev_time($estimated_dev_time): void {
        $this->estimated_dev_time = $estimated_dev_time;
    }

    public function setEstimated_review_time($estimated_review_time): void {
        $this->estimated_review_time = $estimated_review_time;
    }

    public function setTask_id($task_id): void {
        $this->task_id = $task_id;
    }

    public function setPriority($priority): void {
        $this->priority = $priority;
    }

    public function setColumn_id($column_id): void {
        $this->column_id = $column_id;
    }

    public function setDeadline($deadline): void {
        $this->deadline = $deadline;
    }

    public function setDeveloper_id($developer_id): void {
        $this->developer_id = $developer_id;
    }

    public function setReviewer_id($reviewer_id): void {
        $this->reviewer_id = $reviewer_id;
    }

    public static function addTask($projectId,$title,$userId){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL createTask(?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $projectId, PDO::PARAM_INT);
            $stmt->bindParam(2, $title, PDO::PARAM_STR);
            $stmt->bindParam(3, $userId, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['taskId'];
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function fillTask($id,$contect,$devTime,$revTime,$priority,$deadline,$devId,$revId){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL fillTask(?,?,?,?,?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $contect, PDO::PARAM_STR);
            $stmt->bindParam(3, $devTime, PDO::PARAM_STR);
            $stmt->bindParam(4, $revTime, PDO::PARAM_STR);
            $stmt->bindParam(5, $priority, PDO::PARAM_STR);
            $stmt->bindParam(6, $deadline, PDO::PARAM_STR);
            $stmt->bindParam(7, $devId, PDO::PARAM_INT);
            $stmt->bindParam(8, $revId, PDO::PARAM_INT);

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
    
    public static function getTaskChecklist($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getTaskChecklist(?)";
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
    
    public static function getTaskMilestone($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getMilestoneByTaskId(?)";
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
    
    public static function getTaskAttachment($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getAttachmentByTaskId(?)";
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
    
    public static function getTaskComment($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getCommentByTaskId(?)";
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
    
    public static function getTaskByProjectId($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getTaskByProjectId(?)";
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
    
    public static function getTaskById($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getTaskById(?)";
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
    
    public static function deleteTask($user, $task){   
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteTask(?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $user, PDO::PARAM_INT);
            $stmt->bindParam(2, $task, PDO::PARAM_INT);

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
    
    public static function moveTask($user,$column, $task){   
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL moveTask(?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $task, PDO::PARAM_INT);
            $stmt->bindParam(2, $column, PDO::PARAM_INT);
            $stmt->bindParam(3, $user, PDO::PARAM_INT);

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
    
    public static function updateTask($id,$title,$contect,$milestone,$priority,$deadline,$devId,$revId){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL updateTask(?,?,?,?,?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $title, PDO::PARAM_STR);
            $stmt->bindParam(3, $contect, PDO::PARAM_STR);
            $stmt->bindParam(4, $milestone, PDO::PARAM_INT);
            $stmt->bindParam(5, $priority, PDO::PARAM_STR);
            $stmt->bindParam(6, $deadline, PDO::PARAM_STR);
            $stmt->bindParam(7, $devId, PDO::PARAM_INT);
            $stmt->bindParam(8, $revId, PDO::PARAM_INT);

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
    
    public static function getMentionByTask($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getMentionByTaskId(?)";
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

