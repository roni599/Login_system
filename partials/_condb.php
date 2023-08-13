<?php
try {  
    $serverName="localhost";
    $userName="root";
    $password="";
    $databaseName="login";
    $con=mysqli_connect($serverName,$userName,$password,$databaseName);
} 
catch (Throwable $th) {
    die("<h1>Database Connection is Failed</h1>");
}
?>