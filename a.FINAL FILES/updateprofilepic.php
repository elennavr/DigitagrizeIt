<?php

    // PHP Code to change the user's profile picture
    session_start();

    include 'connect.php';

    $target_dir = "../images/media/";
    $target_file = $target_dir . basename($_FILES["uploadpic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["uploadpic"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION["msg"] = "File is not an image.";
        $_SESSION["errorUploadPic"] = true;

        $uploadOk = 0;
    }
    }

    // Check file size
    if ($_FILES["uploadpic"]["size"] > 5000000) {
        
        $_SESSION["errorUploadPic"] = true;
        $_SESSION["msg"] = "Sorry, your file is too large. 5MB is the maximum limit.";
        $uploadOk = 0;
    }

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

    $_SESSION["msg"] = "Sorry, only JPG, JPEG, PNG files are allowed.";
    $_SESSION["errorUploadPic"] = true; 
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {

  if (move_uploaded_file($_FILES["uploadpic"]["tmp_name"], $target_file)) {

    $pic = basename($_FILES["uploadpic"]["name"]);

    $userid = $_SESSION["user"]["userID"];
    
    $sql = "UPDATE users set profilepic= '$pic' where userID='$userid'";

        $updated = mysqli_query($conn, $sql);
        if($updated == true)
        {
            $_SESSION["successUploadPic"] = true;
            //message
            $_SESSION["msg"] = "Profile picture updated successfully!";

            //when the user info is updated, then we need to fetch the user from the database again to display the updated information
            $sql_user = "Select * from users where userID='$userid'";
            $get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_user));

            $_SESSION["user"] = $get_user;

        }
        else
        {
            //error alert
            $_SESSION["errorUploadPic"] = true;
            $_SESSION["msg"] = "Something went wrong...";
        }


  } else {
    $_SESSION["msg"] = "Sorry, there was an error uploading your file.";
    $_SESSION["errorUploadPic"] = true;
  }

  if($_SESSION["user"]["is_admin"] == 1)
  {
      header("location: AdminPanel.php");
  }
  else
  {
      header("location: UserProfile.php");
  }
 

}


?> 