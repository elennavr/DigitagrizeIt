<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'connect2.php';   
    
    //We also need to have the original information available, so we're going to retrieve the product by the id
    $propertyid = $_POST["propertyid_edit"];
    $propuser = $_POST["property_userid_edit"];
    
    $image1 = $_POST["prop_image1_edit"];
    $image2 = $_POST["prop_image2_edit"];
    $image3 = $_POST["prop_image3_edit"];
    
    $name = mysqli_real_escape_string($con, $_POST["prop_name_edit"]); //All fields from the form in the admin panel
    $surface = mysqli_real_escape_string($con, $_POST["surface_edit"]);
    $road = mysqli_real_escape_string($con, $_POST["road_edit"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt_edit"]);
    $sun = mysqli_real_escape_string($con, $_POST["sun_edit"]);
    $rain = mysqli_real_escape_string($con, $_POST["rain_edit"]);
    $state = mysqli_real_escape_string($con, $_POST["prop_state_edit"]);
    $country = mysqli_real_escape_string($con, $_POST["prop_country_edit"]);
    $area = mysqli_real_escape_string($con, $_POST["prop_area_edit"]);
    $cult = mysqli_real_escape_string($con, $_POST["recom_cult_edit"]);
    $drill = mysqli_real_escape_string($con, $_POST["drill_edit"]);
    $description = mysqli_real_escape_string($con, $_POST["prop_description_edit"]);
    $contact = mysqli_real_escape_string($con, $_POST["prop_contact_edit"]);
    
    $sql_original = "Select * from properties where ID='$propertyid' and UserID='$propuser'";
    $result = mysqli_query($con, $sql_original);
    
    $num = mysqli_num_rows($result); //This is the original data for this property; 
    
    $sql = "UPDATE properties set image1='$image1',
                                image2 = '$image2',
                                image3= '$image3',
                                property_name= '$name',
                                surface_area= '$surface',
                                facing_road= '$road',
                                altitude= '$alt',
                                average_sunlight= '$sun',
                                average_rainfall= '$rain',
                                country= '$country',
                                state= '$state',
                                area= '$area',
                                recom_cult= '$cult',
                                drill= '$drill',
                                description= '$description',
                                contact_info= '$contact' where ID='$propertyid'";

    $updated = mysqli_query($con, $sql);
    if($updated = true)
    {
        //message
        echo "Property record updated successfully!";
    }
    else
    {
        //error alert
        echo "Something went wrong...";
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