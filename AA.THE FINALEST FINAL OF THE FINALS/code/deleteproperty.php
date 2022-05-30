<?php

    session_start();

    include 'connect2.php';
    
    if(isset($_POST['deleteid'])){

        $propid = $_POST['deleteid'];
        $sql_delete = "DELETE FROM properties WHERE ID='$propid'";
        $delete = mysqli_query($con, $sql_delete);
        echo 1;
    }



?>