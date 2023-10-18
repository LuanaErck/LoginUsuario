<?php

 $servername = "localhost";
 $username = "phpmyadmin";
 $password = "alumno";
 $dbname = "myDB";

 $mysqli = mysqli_connect($servername, $username, $password, $dbname);
 
 if (!$mysqli) 
 {
    die("Connection failed: " . mysqli_connect_error());
 }

?>

