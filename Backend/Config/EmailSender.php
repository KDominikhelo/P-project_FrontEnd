<?php

require_once 'ErrorLog.php';
require_once 'Dbconfig.php';

Class EmailSender{
    public function sendTestEmail($to, $subject, $message){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        $message = "<html><body><h1>Hello!</h1><p>This is an HTML email.</p></body></html>";
        
        $to = "oliver180903@gmail.com";
        $subject = "HTML email teszt";
        $from = "info@p-project.hu";
        $headers = "From:" . $from . "\r\n" . $headers;

        mail($to, $subject, $message, $headers);
    }
    
    public static function sendNewPasswordEmail($to,$link){
        try{
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $message = "<html><body><h1>Kedves ".$to."!</h1><p>Új jelszavad beállíthatod az alábbi linkre kattintva: http://p-project.hu/Frontend/Landing-page/forgotpw.html#".$link.".</p></body></html>";


            $subject = "Elfelejtett jelszó";
            $from = "info@p-project.hu";
            $headers = "From:" . $from . "\r\n" . $headers;

            mail($to, $subject, $message, $headers);
            return true;
        }
        catch (Exception $ex) {
            ErrorLog::log($ex);
            return false;
        }
    }
}

