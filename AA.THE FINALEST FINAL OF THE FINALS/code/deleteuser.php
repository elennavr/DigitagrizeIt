<?php

    session_start();

    include 'connect.php';
    include "connect2.php";
    
    if(isset($_POST['deleteid'])){

        $userid = $_POST['deleteid'];

        $sql_delete_properties = "DELETE FROM properties WHERE UserID='$userid'";
        $sql_delete_products = "DELETE FROM products WHERE UserID='$userid'";

        $delete_prop = mysqli_query($con, $sql_delete_properties);
        $delete_prod = mysqli_query($con, $sql_delete_products);

        $sql_delete = "DELETE FROM users WHERE userID='$userid'";
        $delete = mysqli_query($conn, $sql_delete);
        
        echo 1;

    }

?>