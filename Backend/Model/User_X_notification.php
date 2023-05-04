<?php

class User_X_notification{
    private $id;
    private $user_id;
    private $notification_id;
    private $status_id;
    private $is_admin;
    
    public function __construct($id, $user_id, $notification_id, $status_id, $is_admin) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->notification_id = $notification_id;
        $this->status_id = $status_id;
        $this->is_admin = $is_admin;
    }
    
    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getNotification_id() {
        return $this->notification_id;
    }

    public function getStatus_id() {
        return $this->status_id;
    }

    public function getIs_admin() {
        return $this->is_admin;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setNotification_id($notification_id): void {
        $this->notification_id = $notification_id;
    }

    public function setStatus_id($status_id): void {
        $this->status_id = $status_id;
    }

    public function setIs_admin($is_admin): void {
        $this->is_admin = $is_admin;
    }



}

?>

