<?php

class Checklist{
    private $id;
    private $task_id;
    private $content;
    private $checked;
    
    public function __construct($id, $task_id, $content, $checked) {
        $this->id = $id;
        $this->task_id = $task_id;
        $this->content = $content;
        $this->checked = $checked;
    }
    
    public static function getById($id){
        
    }

    public function getId() {
        return $this->id;
    }

    public function getTask_id() {
        return $this->task_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getChecked() {
        return $this->checked;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTask_id($task_id): void {
        $this->task_id = $task_id;
    }

    public function setContent($content): void {
        $this->content = $content;
    }

    public function setChecked($checked): void {
        $this->checked = $checked;
    }


}
?>