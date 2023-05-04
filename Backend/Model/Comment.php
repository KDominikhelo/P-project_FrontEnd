<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class comment{
    private $id;
    private $itask_d;
    private $content;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getItask_d() {
        return $this->itask_d;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function getDeleted_at() {
        return $this->deleted_at;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setItask_d($itask_d): void {
        $this->itask_d = $itask_d;
    }

    public function setContent($content): void {
        $this->content = $content;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public function setUpdated_at($updated_at): void {
        $this->updated_at = $updated_at;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }

    public static function addComment($taskId,$comment,$userId,$mentionedUser){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL addComment(?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $taskId, PDO::PARAM_INT);
            $stmt->bindParam(2, $comment, PDO::PARAM_STR);
            $stmt->bindParam(3, $userId, PDO::PARAM_INT);
            $stmt->bindParam(4, $mentionedUser, PDO::PARAM_INT);

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
    
    public static function deleteComment($comment,$user){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteComment(?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $comment, PDO::PARAM_INT);
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
    
    public static function updateComment($comment,$user,$content){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL updateComment(?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $comment, PDO::PARAM_INT);
            $stmt->bindParam(2, $user, PDO::PARAM_INT);
            $stmt->bindParam(3, $content, PDO::PARAM_STR);

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

    public static function getAttachmentByCommentId($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getAttachmentByCommentId(?)";
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
    
    public static function getMentionByComments($id){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getMentionByCommentId(?)";
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

