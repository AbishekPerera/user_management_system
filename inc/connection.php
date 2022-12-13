<?php
//$connection = mysqli_connect(dbserver, dbuser, dbpass, dbname);

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'userdb';

$connection = mysqli_connect($dbhost, $dbuser , $dbpass, $dbname);

//checking error 
if(mysqli_connect_errno()){
    die('Database connection failed' . mysqli_connect_error());
}else {
    //echo "Connection Successful.";
}

?>