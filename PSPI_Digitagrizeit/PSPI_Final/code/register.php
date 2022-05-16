<?php
    
$showAlert = false; 
$showError = false; 
$exists=false;
    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'connect.php';   
    
    $username = $_POST["username"]; 
    $password1 = $_POST["password1"]; 
    $password2 = $_POST["password2"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone_num = $_POST["phone_num"];
    
    $sql = "Select * from users where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
        if(($password1 == $password2) && $exists==false) {
    
            $hash = password_hash($password1, 
                                PASSWORD_DEFAULT);
                
            // Password Hashing is used here. 
            $sql = "INSERT INTO users (username, password, email, first_name, last_name, address, phone_num) 
                VALUES ('$username', '$hash', '$email','$first_name', '$last_name', '$address', '$phone_num');";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                echo 'Account created!'; 
            }
        } 
        else { 
            echo "Wrong password, try again!"; 
        }      
    } 
    
   if($num>0) 
   {
      echo "Username not available"; 
   } 
    
}
    
?>