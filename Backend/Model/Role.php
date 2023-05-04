<?php

class Role{
    private $id;
    private $name;
    private $is_deleted;
    
    public function __construct($id, $name, $is_deleted) {
        $this->id = $id;
        $this->name = $name;
        $this->is_deleted = $is_deleted;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIs_deleted() {
        return $this->is_deleted;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setIs_deleted($is_deleted): void {
        $this->is_deleted = $is_deleted;
    }

    public static function getRole(){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL getAllRole()";
            $stmt = $conn->prepare($sql);

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

