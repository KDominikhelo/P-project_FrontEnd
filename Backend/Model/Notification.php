<?php

class Notification{
    private $id;
    private $project_id;
    private $user_id;
    private $type_id;
    private $details;
    private $created_at;
    private $deleted_at;
    
    public function __construct($id, $project_id, $user_id, $type_id, $details, $created_at, $deleted_at) {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->user_id = $user_id;
        $this->type_id = $type_id;
        $this->details = $details;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getType_id() {
        return $this->type_id;
    }

    public function getDetails() {
        return $this->details;
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

    public function setProject_id($project_id): void {
        $this->project_id = $project_id;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setType_id($type_id): void {
        $this->type_id = $type_id;
    }

    public function setDetails($details): void {
        $this->details = $details;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }



}

?>

