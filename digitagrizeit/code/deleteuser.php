<?php

    session_start();

    include 'connect.php';
    
    $sql_delete = "DELETE FROM users WHERE userID='$userid'";
    $delete = mysqli_query($conn, $sql_delete);

    $_GET['deleteok'] = "";
    header("location: AdminPanel.php");

?>