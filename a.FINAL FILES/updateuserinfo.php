<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the
    // Database Connection.
    include 'connect.php';   
    
    $userid = $_SESSION["user"]["userID"];

    $about = mysqli_real_escape_string($conn, $_POST["input-aboutme"]);
    $address = mysqli_real_escape_string($conn, $_POST["input-address"]);
    $city = mysqli_real_escape_string($conn, $_POST["input-city"]);
    $country = mysqli_real_escape_string($conn, $_POST["input-country"]);
    $post = $_POST["input-postcode"];
    $phone = $_POST["input-phone"];
    
    $sql = "UPDATE users set about= '$about',
                             address= '$address',
                             city= '$city',
                             country= '$country',
                             post_code= '$post',
                             phone_num= '$phone' where userID='$userid'";

                $updated = mysqli_query($conn, $sql);
                if($updated = true)
                {
                    $_SESSION["successUpdateInfo"] = true;
                    //message
                    $_SESSION["msg"] = "Information updated successfully!";

                                //when the user info is updated, then we need to fetch the user from the database again to display the updated information
                    $id = $_SESSION["user"]["userID"];
                    $sql_user = "Select * from users where userID='$id'";
                    $get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_user));
                
                    $_SESSION["user"] = $get_user;

                }
                else
                {
                    //error alert
                    $_SESSION["errorUpdateInfo"] = true;
                    $_SESSION["msg"] = "Something went wrong...";
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