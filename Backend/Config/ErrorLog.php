<?php

class ErrorLog{
    public static function log(Exception $ex){
        $logmsg = "Time of the exception: " . date("r") . "\n";
        $logmsg.= "Exception at this file: " . $ex->getFile() . "\n";
        $logmsg.= "Exception at this line: " . $ex->getLine() . "\n";
        $logmsg.= "Exception error code: " . $ex->getCode() . "\n";
        $logmsg.= "Exception message: " . $ex->getMessage() . "\n";
        $logmsg.= "--------------------------------------------------------------------------" . "\n";
        file_put_contents('/var/www/customers/vh-63381/web/home/error2.txt', $logmsg . "\n",FILE_APPEND);
    }
    
    public static function log2($a){
        file_put_contents('/var/www/customers/vh-63381/web/home/error2.txt', $a . "\n",FILE_APPEND);
    }
}

