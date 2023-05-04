<?php

class Login_log{
    private $id;
    private $user_id;
    private $login;
    private $logout;
    
    public function __construct($id, $user_id, $login, $logout) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->login = $login;
        $this->logout = $logout;
    }

    public static function getById($id){
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getLogout() {
        return $this->logout;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }

    public function setLogout($logout): void {
        $this->logout = $logout;
    }


}

?>

