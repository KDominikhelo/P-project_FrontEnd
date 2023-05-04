<?php
//require_once 'Backend/Config/Dbconfig.php';
//require_once 'Backend/Config/ErrorLog.php';
require_once '../Config/ErrorLog.php';
require_once '../Config/Dbconfig.php';

class User{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $img;
    private $phone;
    private $reg_time;
    private $gts_accept;
    private $superadmin;
    private $updated_at;
    private $deleted_at;
    
    
    public function __construct($id, $first_name, $last_name, $email, $password, $img, $phone, $reg_time, $gts_accept, $superadmin, $updated_at, $deleted_at) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->img = $img;
        $this->phone = $phone;
        $this->reg_time = $reg_time;
        $this->gts_accept = $gts_accept;
        $this->superadmin = $superadmin;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }
    
//    public static function createUser($id, $first_name, $last_name, $email,$img,$phone,$superadmin){
//        return new User($id, $first_name, $last_name,$email,null,$img,$phone,null,null,$superadmin,null,null);
//    }
    
//    public static function getById($id){
//        
//    }
    
    public function getId() {
        return $this->id;
    }

    public function getFirst_name() {
        return $this->first_name;
    }

    public function getLast_name() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getImg() {
        return $this->img;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getReg_time() {
        return $this->reg_time;
    }

    public function getGts_accept() {
        return $this->gts_accept;
    }

    public function getSuperadmin() {
        return $this->superadmin;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function getDeleted_at() {
        return $this->deleted_at;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setFirst_name($first_name): void {
        $this->first_name = $first_name;
    }

    public function setLast_name($last_name): void {
        $this->last_name = $last_name;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setImg($img): void {
        $this->img = $img;
    }

    public function setPhone($phone): void {
        $this->phone = $phone;
    }

    public function setReg_time($reg_time): void {
        $this->reg_time = $reg_time;
    }

    public function setGts_accept($gts_accept): void {
        $this->gts_accept = $gts_accept;
    }

    public function setSuperadmin($superadmin): void {
        $this->superadmin = $superadmin;
    }

    public function setUpdated_at($updated_at): void {
        $this->updated_at = $updated_at;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }
    
    public static function addNewUser($email,$password,$firstname, $lastname, $phone, $img){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL registerUser(?,?,?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $emailIN = $email;
            $stmt->bindParam(1, $emailIN, PDO::PARAM_STR);
            $passwordIN = $password;
            $stmt->bindParam(2, $passwordIN, PDO::PARAM_STR);
            $firstNameIN = $firstname;
            $stmt->bindParam(3, $firstNameIN, PDO::PARAM_STR);
            $lastNameIN = $lastname;
            $stmt->bindParam(4, $lastNameIN, PDO::PARAM_STR);
            $phoneIN= $phone;
            $stmt->bindParam(5, $phoneIN, PDO::PARAM_STR);
            $stmt->bindParam(6, $img, PDO::PARAM_STR);

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
    
    public static function login($email,$password){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL login(?,?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $emailIN = $email;
            $stmt->bindParam(1, $emailIN, PDO::PARAM_STR);
            $passwordIN = $password;
            $stmt->bindParam(2, $passwordIN, PDO::PARAM_STR);

            // Eljárás futtatása
            $stmt->execute();
            // Visszatérési érték lekérdezése
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
          
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
        finally{
            $conn = null;
        }
    }
    
    public static function logout($userId){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL logout(?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $userIN = $userId;
            $stmt->bindParam(1, $userIN, PDO::PARAM_INT);

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
    
    public static function searchByEmail($email){
        try{
            $conn = Dbconfig::getConn();
            
            $sql = "CALL searchUserByEmail(?)";
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $emailIN = $email;
            $stmt->bindParam(1, $emailIN, PDO::PARAM_STR);

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
          
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
       finally{
            $conn = null;
        }
    }
    
    public static function updateUser($id, $email, $firstname, $lastname, $phone, $img){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL updateUser(?,?,?,?,?,?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $idIN = $id;
            $stmt->bindParam(1, $idIN, PDO::PARAM_INT);
            $emailIN = $email;
            $stmt->bindParam(2, $emailIN, PDO::PARAM_STR);
            $firstNameIN = $firstname;
            $stmt->bindParam(3, $firstNameIN, PDO::PARAM_STR);
            $lastNameIN = $lastname;
            $stmt->bindParam(4, $lastNameIN, PDO::PARAM_STR);
            $phoneIN= $phone;
            $stmt->bindParam(5, $phoneIN, PDO::PARAM_STR);
            $stmt->bindParam(6, $img, PDO::PARAM_STR);

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
    
    public static function deleteUser($id){
        try{
            $conn = Dbconfig::getConn();
            
            // Tárolt eljárás meghívása
            $sql = "CALL deleteUser(?)"; // Eljárás neve és paraméter(ek)
            $stmt = $conn->prepare($sql);

            // Bemenő paraméter megadása
            $idIN = $id;
            $stmt->bindParam(1, $idIN, PDO::PARAM_INT);
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