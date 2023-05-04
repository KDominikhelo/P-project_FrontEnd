<?php

require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class Token{
    private $id;
    private $value;
    private $email;
    private $expire;
    private $used;
    private $type;
    private $is_deleted;
    
    public function __construct($id, $value, $email, $expire, $used, $type, $is_deleted) {
        $this->id = $id;
        $this->value = $value;
        $this->email = $email;
        $this->expire = $expire;
        $this->used = $used;
        $this->type = $type;
        $this->is_deleted = $is_deleted;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getValue() {
        return $this->value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getExpire() {
        return $this->expire;
    }

    public function getUsed() {
        return $this->used;
    }

    public function getType() {
        return $this->type;
    }

    public function getIs_deleted() {
        return $this->is_deleted;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setValue($value): void {
        $this->value = $value;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setExpire($expire): void {
        $this->expire = $expire;
    }

    public function setUsed($used): void {
        $this->used = $used;
    }

    public function setType($type): void {
        $this->type = $type;
    }

    public function setIs_deleted($is_deleted): void {
        $this->is_deleted = $is_deleted;
    }
    
    public static function addToken($email){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL addPasswordReplacementToken(?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $email, PDO::PARAM_STR);

            // Eljárás futtatása
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['value'];
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function resetPassword($pw, $email, $token){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL resetPassword(?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $stmt->bindParam(1, $pw, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $token, PDO::PARAM_STR);

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
