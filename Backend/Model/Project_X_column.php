<?php

class Project_X_column{
    private $id;
    private $project_id;
    private $column_id;
    private $place;
    
    public function __construct($id, $project_id, $column_id, $place) {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->column_id = $column_id;
        $this->place = $place;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function getColumn_id() {
        return $this->column_id;
    }

    public function getPlace() {
        return $this->place;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setProject_id($project_id): void {
        $this->project_id = $project_id;
    }

    public function setColumn_id($column_id): void {
        $this->column_id = $column_id;
    }

    public function setPlace($place): void {
        $this->place = $place;
    }



}

?>
