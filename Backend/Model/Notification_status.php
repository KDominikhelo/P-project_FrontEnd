<?php

class Notification_status{
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



}

?>

