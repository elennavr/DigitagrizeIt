<?php

$showSuccess = false; 
$showError = false; 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the
    // Database Connection.
    include 'connect.php';   

    $password = $_POST["password"];
    $new_password = $_POST["new_password"];
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET password='$new_password' WHERE password='$password'";

    if ($conn->query($sql) === TRUE) {
        $showSuccess = true;
        $msg = 'Record updated successfully';
    } else {
        $showError = true;
        $msg= 'Error updating record: ' . $conn->error;
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Change Username</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
            rel="stylesheet"
        />
        <link rel= "stylesheet" href="changeUsername.css" type="text/css">
        <link rel= "stylesheet" href="alerts.css" type="text/css">
    </head>
    <body>
        <div class="container" align="center">
            <img class="logo" src="../images/icons/favicon.png">
            <?php 
                if($showSuccess) {
    
                    echo ' <div class="alert alert-success" role="alert">
                        <strong>Success! </strong>'.$msg.' 
                    </div> '; 
                    $showSuccess = false;
                    }
                
                    if($showError) {
                
                        echo ' <div class="alert alert-danger" role="alert"> 
                        <strong>Error! </strong> '.$msg.'
                    </div> '; 
                    $showError = false;
                    }
            ?>
            <h2>Change Your Password</h2>
            <form action="changePassword.php" method="post">
                <label for="new_password">New password:</label><br>
                <input type="text" id="new_password" name="new_password"></br>
                <label for="password">Old password:</label><br>
            <input type="text" id="password" name="password"></br></br>
                <button class="button scale">Save</button>
            </form>
            <form action="UserProfile.php">
                <button class="button-red scale1">Back</button>
            </form>
        </div>
    </body>
</html> 