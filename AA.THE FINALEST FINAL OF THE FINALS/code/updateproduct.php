<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'connect2.php';   
    
    //We also need to have the original information available, so we're going to retrieve the product by the id
    $productid = $_POST["productid_edit"];
    $produser = $_POST["product_userid_edit"];
    
    $image1 = $_POST["image1_edit"];
    $image2 = $_POST["image2_edit"];
    $image3 = $_POST["image3_edit"];
    
    $name = mysqli_real_escape_string($con, $_POST["prod_name_edit"]); //All fields from the form in the admin panel
    $category = mysqli_real_escape_string($con, $_POST["prod_cat_edit"]);
    $method = mysqli_real_escape_string ($con, $_POST["cult_edit"]);
    $price = mysqli_real_escape_string ($con, $_POST["price_edit"]);
    $annual = mysqli_real_escape_string ($con, $_POST["annual_edit"]);
    $origin = mysqli_real_escape_string ($con, $_POST["origin_edit"]);
    $state = mysqli_real_escape_string ($con, $_POST["prod_state_edit"]);
    $country = mysqli_real_escape_string ($con, $_POST["prod_country_edit"]);
    $area = mysqli_real_escape_string ($con, $_POST["area_edit"]);
    $minorder = mysqli_real_escape_string ($con, $_POST["minorder_edit"]);
    $packtype = mysqli_real_escape_string ($con, $_POST["packtype_edit"]);
    $description = mysqli_real_escape_string ($con, $_POST["prod_description_edit"]);
    $contact = mysqli_real_escape_string($con, $_POST["prod_contact_edit"]);
    
    $sql_original = "Select * from products where ID='$productid' and UserID='$produser'";
    $result = mysqli_query($con, $sql_original);
    
    $num = mysqli_num_rows($result); //This is the original data for this product; 
    
    $sql = "UPDATE products set image1='$image1',
                                image2 = '$image2',
                                image3= '$image3',
                                product_name= '$name',
                                product_category= '$category',
                                cultivation_method= '$method',
                                price= '$price',
                                annual_production= '$annual',
                                place_of_origin= '$origin',
                                country= '$country',
                                state= '$state',
                                area= '$area',
                                minimum_order= '$minorder',
                                package_type= '$packtype',
                                description= '$description',
                                contact_info= '$contact' where ID='$productid'";

    $updated = mysqli_query($con, $sql);
    if($updated = true)
    {
        //message
        echo "Product record updated successfully!";
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