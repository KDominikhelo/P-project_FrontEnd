<?php

class User_X_project{
    private $id;
    private $project_id;
    private $user_id;
    private $role_id;
    private $editor;
    private $reviewer;
    
    public function __construct($id, $project_id, $user_id, $role_id, $editor, $reviewer) {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->user_id = $user_id;
        $this->role_id = $role_id;
        $this->editor = $editor;
        $this->reviewer = $reviewer;
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

    public function getRole_id() {
        return $this->role_id;
    }

    public function getEditor() {
        return $this->editor;
    }

    public function getReviewer() {
        return $this->reviewer;
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

    public function setRole_id($role_id): void {
        $this->role_id = $role_id;
    }

    public function setEditor($editor): void {
        $this->editor = $editor;
    }

    public function setReviewer($reviewer): void {
        $this->reviewer = $reviewer;
    }



}

?>
