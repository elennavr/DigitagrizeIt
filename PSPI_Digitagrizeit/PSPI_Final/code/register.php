<?php
    
$showAlert = false; 
$showError = false; 
$exists=false;
$flag_user = false;
$flag_psd= false;

    
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
    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
      $msg = 'The email you have entered is invalid, please try again.';
      $corr_mail = false;
    }else{
      if(!$flag_user){
        $corr_mail = true;
      }  
    } 

    if($num == 0 && $corr_mail) {
        if(($password1 == $password2) && $exists==false) {
    
            $hash = password_hash($password1, 
                                PASSWORD_DEFAULT);
            
            // Password Hashing is used here. 
            $sql = "INSERT INTO users (username, password, email, first_name, last_name, address, phone_num) 
                VALUES ('$username', '$hash', '$email','$first_name', '$last_name', '$address', '$phone_num');";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
              $msg = 'Your account has been made.'; 
              
             }else { 
              $msg = "Invalid Password."; 
            }      
          } 
        }
    
   if($num>0 && $corr_mail){
      $msg = "Username not available"; 
   } 

  
}
    
    
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Digitagrize it - Register</title>
    <link rel="icon" href="favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="register.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="tab">
      <h2 align="center">Sign Up</h2>
      <?php 
      if(isset($msg)){  // Check if $msg is not empty
          echo '<h2 align="center">'.$msg.'</h2>'; // Display our message and wrap it with a div with the class "statusmsg".
      } 
      ?>
      <form action="register.php" method="post">
        <h4 class="centerCrec">Username</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="none"
          value="supercool_username"
          name="username"
          id="myUSRNM"
          required
        />
        <br />
        <h4 class="centerCrec">Password</h4>
        <input
          class="centerCrec"
          type="password"
          placeholder="none"
          value="password"
          name="password1"
          id="myPSW"
          required
        />
        <input class="centerCrec" type="checkbox" onclick="showPSW()" />Show
          Password
        <br />
        <h4 class="centerCrec">Password (again)</h4>
        <input
          class="centerCrec"
          type="password"
          placeholder="none"
          value="password"
          name="password2"
          id="myPSW"
          required
        />
        <br />
        <h4 class="centerCrec">First Name</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="none"
          value="John"
          name="first_name"
          id="myFN"
          required
        />
        <br />
        <h4 class="centerCrec">Last Name</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="none"
          value="Farmer"
          name="last_name"
          id="myLN"
          required
        />
        <br />
        <h4 class="centerCrec">Address</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="none"
          value="address 1"
          name="address"
          id="myADD"
          required
        />
        <br />
        <h4 class="centerCrec">E-mail</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="none"
          value="john@farmer.com"
          name="email"
          id="myMAIL"
          required
        />
        <br />
        <h4 class="centerCrec">Phone Number</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="none"
          value="6912345678"
          name="phone_num"
          id="myPN"
          required
        />
        <br /><bR><bR>
        <button class="button" href="#" type="submit">Sign Up</button>
      </form>
      
      </div>
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
    </div>
  </body>
</html>
