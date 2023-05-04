<?php

class Task_moves{
    private $id;
    private $user_id;
    private $project_id;
    private $task_id;
    private $column_id;
    private $moved_in;
    private $moved_out;
    private $spent_time;
    
    public function __construct($id, $user_id, $project_id, $task_id, $column_id, $moved_in, $moved_out, $spent_time) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->project_id = $project_id;
        $this->task_id = $task_id;
        $this->column_id = $column_id;
        $this->moved_in = $moved_in;
        $this->moved_out = $moved_out;
        $this->spent_time = $spent_time;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function getTask_id() {
        return $this->task_id;
    }

    public function getColumn_id() {
        return $this->column_id;
    }

    public function getMoved_in() {
        return $this->moved_in;
    }

    public function getMoved_out() {
        return $this->moved_out;
    }

    public function getSpent_time() {
        return $this->spent_time;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setProject_id($project_id): void {
        $this->project_id = $project_id;
    }

    public function setTask_id($task_id): void {
        $this->task_id = $task_id;
    }

    public function setColumn_id($column_id): void {
        $this->column_id = $column_id;
    }

    public function setMoved_in($moved_in): void {
        $this->moved_in = $moved_in;
    }

    public function setMoved_out($moved_out): void {
        $this->moved_out = $moved_out;
    }

    public function setSpent_time($spent_time): void {
        $this->spent_time = $spent_time;
    }



}

?>

