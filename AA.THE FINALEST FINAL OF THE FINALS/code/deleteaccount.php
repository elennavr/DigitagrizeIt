<?php
    session_start();

    if(isset($_POST['deleteid'])){

        $id = $_POST['deleteid'];
        include 'connect.php';
        include 'connect2.php';

        $sql_delete_properties = "DELETE FROM properties WHERE UserID='$id'";
        $sql_delete_products = "DELETE FROM products WHERE UserID='$id'";

        $delete_prop = mysqli_query($con, $sql_delete_properties);
        $delete_prod = mysqli_query($con, $sql_delete_products);

        $sql_delete = "DELETE FROM users WHERE userID='$id'";
        $delete = mysqli_query($conn, $sql_delete);
        echo 1;

        session_destroy();

    }

?>