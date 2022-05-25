<?php
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
        $msg = 'Record updated successfully';
    } else {
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
    </head>
    <body>
        <div class="container" align="center">
            <img class="logo" src="../images/icons/favicon.png">
            <?php 
                if(isset($msg)){  // Check if $msg is not empty
                    echo '<h2 align="center">'.$msg.'</h2>'; // Display our message and wrap it with a div with the class "statusmsg".
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