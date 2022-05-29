<?php

    session_start();

    include 'connect.php';
    
    if(isset($_POST['deleteid'])){

        $userid = $_POST['deleteid'];
        $sql_delete = "DELETE FROM users WHERE userID='$userid'";
        $delete = mysqli_query($conn, $sql_delete);
        echo 1;
        
        //header("location: AdminPanel.php");

    }



?>