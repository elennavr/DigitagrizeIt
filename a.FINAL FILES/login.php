<?php

session_start();
$_SESSION["loggedin"] = false;
$_SESSION["user"] = "";
$_SESSION["username"] = "";
     
$showError = false; 
    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'connect.php';   
    
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 
    
    $sql = "Select * from users where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
        $showError = true;
        $msg = "This account does not exist. Please register.";
    } else if($num==1){
        $sql_info = "Select * from users where username='$username'";
        $result_psw = mysqli_query($conn ,$sql_info);
        $row = mysqli_fetch_assoc($result_psw);
        $pass = $row["password"];

        if($pass == $password){

            $_SESSION["loggedin"] = true;
            $_SESSION["user"] = $row;
            $_SESSION["username"] = $username;

            header("location: index.php");  
        }
        else
        {
            $showError = true;
            $msg = "The password you have entered is incorrect. You can change your password or try again.";
        }
    }
}
    
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Digitagrize it - Log In</title>
    <link rel="icon" href="images/icons/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="breadcrumb.css" />
    <link rel="stylesheet" href="alerts.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
  <?php
  
  if($showError) {

    echo ' <div class="alert alert-danger" role="alert"> 
    <strong>Error! </strong> '.$msg.'
    </div> '; 
  }
    unset($showError);
    unset($msg);
    ?>
    <div class="tab">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>

        <li>Login</li>
      </ul>
      <hr style="background-color: rgb(199, 132, 55)" />
      <img class="logo" src="../images/icons/favicon.png" />
      <h2 align="center">Login</h2>
      <p align="center">Or <a href="register.php">create an account</a>!</p>

      <form action="login.php" method="post">
        <h4 class="centerCrec">Username</h4>
        <input
          class="centerCrec"
          type="text"
          id="username"
          name="username"
          required
        />
        <br />
        <h4 class="centerCrec">Password</h4>
        <input
          class="centerCrec"
          type="password"
          id="myPSW"
          name="password"
          required
        /><br />
        <input class="centerCrec" type="checkbox" onclick="showPSW()" />Show
        Password <br /><br />
        <button class="button center" type="submit">Login</button><br /><br />
      </form>

      <p id="nextTo2" class="centerPSW">
        Forgot <a href="forgotPSW.php">password</a>?
      </p>
    </div>

    <script>
      function showPSW() {
        var x = document.getElementById("myPSW");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </body>
</html>
