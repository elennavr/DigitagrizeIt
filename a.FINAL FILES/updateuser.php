<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'connect.php';   
    
    //We also need to have the original information available, so we're going to retrieve the user by the id
    $userid = $_POST["id_edit"];
    $profilepic = $_POST["profilepic_edit"];
    $username = $_POST["username_edit"]; //All fields from the form in the admin panel
    $first_name = $_POST["fn_edit"];
    $last_name = $_POST["ln_edit"];
    $email = $_POST["email_edit"];
    $about = $_POST["about_edit"];
    $address = $_POST["address_edit"];
    $city = $_POST["city_edit"];
    $country = $_POST["country_edit"];
    $post = $_POST["pc_edit"];
    $phone = $_POST["phone_edit"];
    $act = $_POST["activity_edit"];
    
    $sql_original = "Select * from users where userID='$userid'";
    $result = mysqli_query($conn, $sql_original);

    //$result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); //This is the original data for this user; 
    
    $can_update = false;
    if($num == 1)
    {
        
        $old_user = mysqli_fetch_assoc($result);
        $old_username = $old_user["username"];

        //if the new username is the same as the original, ignore
        if($old_username != $username)
        {
            //First, the NEW username should be unique, meaning it should not be the same as any other username in the database

            $sql_username = "Select * from users where username='$username'";
            $num_username = mysqli_num_rows(mysqli_query($conn, $sql_username));

            if($num_username == 0) //it means that there are no users other than the original with the same username in the database, therefore the record can be updated
            {
                $can_update = true;
            }
            else if ($num_username > 0)
            {
                //error alert
                echo 'This username already exists!';
            }
        }
        else
        {
            $can_update = true;
        }
        
        if($can_update = true)
        {
            $sql = "UPDATE users set username='$username',
                                        profilepic = '$profilepic',
                                        first_name= '$first_name',
                                        last_name= '$last_name',
                                        email= '$email',
                                        about= '$about',
                                        address= '$address',
                                        city= '$city',
                                        country= '$country',
                                        post_code= '$post',
                                        phone_num= '$phone',
                                        recent_activity= '$act' where userID='$userid'";

                $updated = mysqli_query($conn, $sql);
                if($updated = true)
                {
                    //message
                    echo "User record updated successfully!";
                }
                else
                {
                    //error alert
                    echo "Something went wrong...";
                }
        }

        header("location: AdminPanel.php");
        
    }
    
}

?>