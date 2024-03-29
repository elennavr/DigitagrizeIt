<?php

$showSuccess = false; 
$showError = false; 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the
    // Database Connection.
    include 'connect.php';

    $password = $_POST["password"];
    $email = $_POST["email"];
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql_m = mysqli_query($conn, "SELECT * from users WHERE email = '$email'");
    $email_num = mysqli_num_rows($sql_m);

    $sql_mail = "Select * from users where password='$password'";
    $mail_exists = mysqli_query($conn, $sql_mail);
    $num_mail = mysqli_num_rows($mail_exists); 
    if($email_num > 0 && $_SESSION["user"]["email"] != $email) //if the email already exists in the database
    {
        $showError = true;
        $msg = 'This email already exists!';
    }
    else{
        if($num_mail==1){
            $sql = "UPDATE users SET email='$email' WHERE password='$password'";

        if ($conn->query($sql) === TRUE) {
            $showSuccess = true;
            $msg = 'Record updated successfully';

            //when the user info is updated, then we need to fetch the user from the database again to display the updated information
            $id = $_SESSION["user"]["userID"];
            $sql_user = "Select * from users where userID='$id'";
            $get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_user));

            $_SESSION["user"] = $get_user;

        } else {
            $showError = true;
            $msg= 'Error updating record: ' . $conn->error;
        }
        }
        if($num_mail==0){
            $msg='Invalid Password';
        }
        
    }


}
?>


<!DOCTYPE HTML>
<html>
    <head>
        <title>Change Email</title>
        <link rel="icon" href="../images/icons/favicon.png" />
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
            <h2>Change Your Email</h2>
            <form action="changeEmail.php" method="post">
                <label for="email">New E-mail:</label><br>
                <input type="text" id="email" name="email"></br>
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