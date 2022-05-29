<?php
    session_start();

    if(isset($_POST['deleteid'])){

        $id = $_POST['deleteid'];
        include 'connect.php';
        $sql_delete = "DELETE FROM users WHERE userID='$id'";
        $delete = mysqli_query($conn, $sql_delete);
        echo 1;

        session_destroy();

    }

?>