<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class Project{
    private $id;
    private $name;
    private $img;
    private $description;
    private $start_date;
    private $created_at;
    private $created_by;
    private $updated_at;
    private $updated_by;
    private $deleted_at;
    private $priority;
    private $extra_time;
    
    public function __construct($id, $name, $img, $description, $start_date, $created_at, $created_by, $updated_at, $updated_by, $deleted_at, $priority, $extra_time) {
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->created_at = $created_at;
        $this->created_by = $created_by;
        $this->updated_at = $updated_at;
        $this->updated_by = $updated_by;
        $this->deleted_at = $deleted_at;
        $this->priority = $priority;
        $this->extra_time = $extra_time;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImg() {
        return $this->img;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStart_date() {
        return $this->start_date;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function getCreated_by() {
        return $this->created_by;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function getUpdated_by() {
        return $this->updated_by;
    }

    public function getDeleted_at() {
        return $this->deleted_at;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getExtra_time() {
        return $this->extra_time;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setImg($img): void {
        $this->img = $img;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setStart_date($start_date): void {
        $this->start_date = $start_date;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public function setCreated_by($created_by): void {
        $this->created_by = $created_by;
    }

    public function setUpdated_at($updated_at): void {
        $this->updated_at = $updated_at;
    }

    public function setUpdated_by($updated_by): void {
        $this->updated_by = $updated_by;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }

    public function setPriority($priority): void {
        $this->priority = $priority;
    }

    public function setExtra_time($extra_time): void {
        $this->extra_time = $extra_time;
    }


    public static function addProject($name,$description,$startDate, $createdBy, $priority,$extraTime, $img){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            // $sql = "CALL addProject(?,?,?,?,?,?,?, @p7);SELECT @p7 AS `outNumber`;"; // Eljárás neve és paraméter(ek)
            $sql = "CALL addProject(?,?,?,?,?,?,?);"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $description, PDO::PARAM_STR);
            $stmt->bindParam(3, $startDate, PDO::PARAM_STR);
            $stmt->bindParam(4, $createdBy, PDO::PARAM_INT);
            $stmt->bindParam(5, $priority, PDO::PARAM_STR);
            $stmt->bindParam(6, $extraTime, PDO::PARAM_INT);
            $stmt->bindParam(7, $img, PDO::PARAM_STR);

            // Eljárás futtatása
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['LAST_INSERT_ID()'];
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function getProjectById($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getProjectById(?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            // Eljárás futtatása
            $stmt->execute();
            // Visszatérési érték lekérdezése
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    
    public static function getUserFromCommentTag($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getProjectUsersForCommentTag(?)";
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
    
    public static function getUsers($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getUserXProject(?)";
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
    
    public static function getProjectByUser($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getProjectByUserId(?)";
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
    
    public static function getUserByProjectId($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getUserByProjectId(?)";
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
    
    public static function updateProject($id,$name,$img,$description, $priority,$startDate,$extraTime,$createdBy){
        try{
            $conn = Dbconfig::getConn();
            $sql = "CALL updateProject(?,?,?,?,?,?,?,?);"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $name, PDO::PARAM_STR);
            $stmt->bindParam(3, $img, PDO::PARAM_STR);
            $stmt->bindParam(4, $description, PDO::PARAM_STR);
            $stmt->bindParam(5, $priority, PDO::PARAM_STR);
            $stmt->bindParam(6, $startDate, PDO::PARAM_STR);
            $stmt->bindParam(7, $extraTime, PDO::PARAM_INT);
            $stmt->bindParam(8, $createdBy, PDO::PARAM_INT);

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
    
    public static function deleteProject($id, $user){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL deleteProject(?,?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
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
    
    public static function restoreProject($project,$user){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL restoreProject(?,?);"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $project, PDO::PARAM_INT);
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
    
    public static function getArchivedProjectByUser($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getUserArchivedProjects(?)";
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
    
    public static function addUserToProject($project,$user,$adderUser, $role, $editor,$reviewer){
        try{
            $conn = Dbconfig::getConn();
            $sql = "CALL addUserToProject(?,?,?,?,?,?);"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $project, PDO::PARAM_INT);
            $stmt->bindParam(2, $user, PDO::PARAM_INT);
            $stmt->bindParam(3, $adderUser, PDO::PARAM_INT);
            $stmt->bindParam(4, $role, PDO::PARAM_INT);
            $stmt->bindParam(5, $editor, PDO::PARAM_BOOL);
            $stmt->bindParam(6, $reviewer, PDO::PARAM_BOOL);

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
