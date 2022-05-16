<?php

    $servername = "localhost"; 
    $username = "root"; 
    $pswd = "";
   
    $database = "users_database";
   
     // Create a connection 
     $conn = mysqli_connect($servername, 
         $username, $pswd, $database);
   
    if($conn) {
        echo "success"; 
    } 
    else {
        die("Error". mysqli_connect_error()); 
    }
    
?>