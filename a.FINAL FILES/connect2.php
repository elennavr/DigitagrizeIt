<?php

    $servername = "localhost"; 
    $username = "root"; 
    $pswd = "";
    $database = "listingsdb";
    
    $con= mysqli_connect($servername, $username, $pswd, $database);
      

    if($con) {
        //echo "success"; 
    } 
    else {
        die("Error". mysqli_connect_error()); 
    }
    
?>
