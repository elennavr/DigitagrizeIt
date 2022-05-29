<?php

$showSuccess = false; 
$showError = false; 
$exists=false;
$success = false;

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
    $defaultpic = 'seedling.png';
    $corr_mail = false;

    $sql = "Select * from users where username='$username'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    
    $sql_mail = "Select * from users where email='$email'";
    $mail_exists = mysqli_query($conn, $sql_mail);
    $num_mail = mysqli_num_rows($mail_exists); 

    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
      $msg = 'The email you have entered is invalid, please try again.';
      $corr_mail = false;
      $showError = true;
    }else{
      
        $corr_mail = true;
    } 

    if($corr_mail){
      if($num_mail > 0){
        $msg = 'This email is in use by another user, please try again.';
        $corr_mail = false;
        $exists = true;
      }
    }

    if($num == 0 && $corr_mail) {
        if(($password1 == $password2) && $exists==false) {

            
            $sql = "INSERT INTO users (username, password, email, first_name, last_name, address, phone_num, profilepic) 
                VALUES ('$username', '$password1', '$email','$first_name', '$last_name', '$address', '$phone_num', '$defaultpic');";

            $result = mysqli_query($conn, $sql);

            if ($result) {
              $msg = 'Your account has been made.';
              $showSuccess = true;
              //retreive that user from the database
              $sql_user = "SELECT * FROM users WHERE username='$username'";
              $get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_user));
      
              $_SESSION["loggedin"] = true;
              $_SESSION["user"] = $get_user;
              $_SESSION["username"] = $username;

              header("location: index.php"); 

             }
             
             else { 
              $msg = "Invalid Password.";
              $showError = true; 
            }      
          } 
        }

   if($num>0 && $corr_mail){
      $msg = "Username not available";
      $exists = true; 
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
    <link rel="stylesheet" href="alerts.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>

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
        
    if($exists) {
        echo ' <div class="alert alert-warning" role="alert">
        <strong>Warning! </strong> '.$msg.'
      </div> '; 
    }
    $exists = false;

  ?>
    
    <div class="tab">
      <h2 align="center">Sign Up</h2>
     
      <form action="register.php" method="post">
        <h4 class="centerCrec">Username</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="username"
          name="username"
          id="myUSRNM"
          required
        />
        <br />
        <h4 class="centerCrec">Password</h4>
        <input
          class="centerCrec"
          type="password"
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
          name="password2"
          id="myPSW"
          required
        />
        <br />
        <h4 class="centerCrec">First Name</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="First Name"
          name="first_name"
          id="myFN"
          required
        />
        <br />
        <h4 class="centerCrec">Last Name</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="Last Name"
          name="last_name"
          id="myLN"
          required
        />
        <br />
        <h4 class="centerCrec">Address</h4>
        <input
          class="centerCrec"
          type="text"
          placeholder="Str. no., Region"
          name="address"
          id="myADD"
          required
        />
        <br />
        <h4 class="centerCrec">E-mail</h4>
        <input
          class="centerCrec"
          type="text"
          name="email"
          id="myMAIL"
          required
        />
        <br />
        <h4 class="centerCrec">Phone Number</h4>
        <input
          class="centerCrec"
          type="text"
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
