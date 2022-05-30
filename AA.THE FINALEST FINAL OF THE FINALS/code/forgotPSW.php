<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'connect.php';   
    
    $email = $_POST["email"];
    $new_password = $_POST["new_password"];
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
    $sql_mail = "Select * from users where email='$email'";
    $mail_exists = mysqli_query($conn, $sql_mail);
    $num_mail = mysqli_num_rows($mail_exists); 

    if ($conn->query($sql) === TRUE) {
        if($num_mail == 1)  
         $msg = 'Record updated successfully';
         if($num_mail ==0)
            $msg = 'Email does not exist.';
    } else {
        $msg = 'Error updating record: ' . $conn->error;
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Forgot Password</title>
        <link rel="icon" href="../images/icons/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="breadcrumb.css" />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
            rel="stylesheet"
        />
        <link rel= "stylesheet" href="changeUsername.css" type="text/css">
    </head>
    <body>
        
        <div class="container" align="center">
            <ul class="breadcrumb size" align="left">
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li>Forgot Password</li>
            </ul>
            <img class="logo" src="../images/icons/favicon.png">
            <?php 
                if(isset($msg)){  // Check if $msg is not empty
                    echo '<h2 align="center">'.$msg.'</h2>'; // Display our message and wrap it with a div with the class "statusmsg".
                } 
            ?>
            <h2>Forgot Password?</h2>
            <form action="forgotPSW.php" method="post">
                <label for="email">Enter your email address:</label><br>
                <input type="text" id="email" name="email"></br>
                <label for="new_password">New password:</label><br>
            <input type="text" id="new_password" name="new_password"></br></br>
                <button class="button scale">Save</button>
            </form>
        </div>
    </body>
</html>