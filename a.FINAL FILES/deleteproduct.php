<?php

    session_start();

    include 'connect2.php';
    
    if(isset($_POST['deleteid'])){

        $prodid = $_POST['deleteid'];
        $sql_delete = "DELETE FROM products WHERE ID='$prodid'";
        $delete = mysqli_query($con, $sql_delete);
        echo 1;
    }



?>