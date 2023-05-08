<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         // use Backend\Model\User;
         require_once 'Backend/Config/ErrorLog.php';
         require_once 'Backend/Model/User.php';
//        try{
//            User::addNewUser("pakesz1@gmail.com", "alma!123", "php", "teszt", "+3620/1234567");
//        }
//        catch (Exception $e) {
//            ErrorLog::log($ex);
//        }
//        
//      
//        try{
//            echo 'Hello';
//            throw new Exception("Ez egy szándékos hibaüzenet");
//            
//        } catch (Exception $ex) {
//            
//        } 
         
        // file_put_contents('error.txt', $e->getMessage() + "\n" + $e->getFile() + "\n" + $e->getLine() +"\n" +  $e->getCode());
        
        
        ?>
        

        <form action="Backend/Upload/uploadFILE.php" method="post" enctype="multipart/form-data">
          Select image to upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
        </form>
   
    </body>
</html>
