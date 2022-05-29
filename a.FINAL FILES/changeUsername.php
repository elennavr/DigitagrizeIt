<?php

$showSuccess = false; 
$showError = false; 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the
    // Database Connection.
    include 'connect.php';   

    $password = $_POST["password"];
    $username = $_POST["username"];
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET username='$username' WHERE password='$password'";

    if ($conn->query($sql) === TRUE) {
        $showSuccess = true;
        $msg = 'Record updated successfully';

        //when the user info is updated, then we need to fetch the user from the database again to display the updated information
        $sql_user = "Select * from users where username='$username'";
        $get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_user));

        $_SESSION["user"] = $get_user;

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
            <form action="changeUsername.php" method="post">
            <h2>Change Your Username</h2>
            <label for="username">New username:</label><br>
            <input type="text" id="username" name="username"></br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password"></br></br>
            <button class="button scale">Save</button>
            </form>

            <?php
            if($_SESSION["user"]["is_admin"] == 1)
            {
                echo '<form action="AdminPanel.php">
                        <button class="button-red scale1">Back</button>
                    </form>';
            }
            else
            {
                echo '<form action="UserProfile.php">
                        <button class="button-red scale1">Back</button>
                    </form>';
            }
            ?>
            
        </div>
    </body>
</html> 