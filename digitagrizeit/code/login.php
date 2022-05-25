<?php

session_start();
$_SESSION["loggedin"] = false;
$_SESSION["user"] = "";
$_SESSION["username"] = "";
    
$showAlert = false; 
$showError = false; 
$exists=false;
    
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
        echo "This account does not exist. Please register.";
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
            echo "failed.";
    }
}
    
?>