
<?php
$DBhost = "localhost";
$DBuser = "pproject";
$DBpassword ="D3v3L0p3R*";
$DBname="pproject";

$conn = new PDO("mysql:host=$DBhost;dbname=$DBname", $DBuser, $DBpassword); 
$conn->exec("set names utf8mb4");

if(!$conn){
    print "szar a conn";
    //die("Connection failed: " . mysqli_connect_error());
}
else{
    print "jó a conn";
}

?> 