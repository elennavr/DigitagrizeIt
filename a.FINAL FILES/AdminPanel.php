<?php
  session_start();
  include("connect.php");
  include("connect2.php");

  $sql_users = "SELECT * from users";
  $query_users = mysqli_query($conn, $sql_users);

  $sql_products = "SELECT * from products";
  $query_products = mysqli_query($con, $sql_products);

  $sql_properties = "SELECT * from properties";
  $query_properties = mysqli_query($con, $sql_properties);

  if(!isset($_SESSION["active_tab"]))
  {
      $_SESSION["active_tab"] = "info_tab";
  }

?>

<?php
//php script for activating the correct tab when the admin is editting records

if(isset($_GET["useredit"]) || isset($_GET["userdelete"]))
{
    $_SESSION["active_tab"] = "users_tab";
}

if(isset($_GET["productedit"]) || isset($_GET["productdelete"]))
{
    $_SESSION["active_tab"] = "product_listings_tab";
}

if(isset($_GET["propertyedit"]) || isset($_GET["propertydelete"]))
{
    $_SESSION["active_tab"] = "property_listings_tab";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Digitagrize it - Admin Panel</title>
<link rel="icon" href="images/icons/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel= "stylesheet" href="master.css" type="text/css">
<link rel="stylesheet" href="adminpanel.css" type="text/css">
<link rel="stylesheet" href="alerts.css" type="text/css">
<link rel="stylesheet" href="breadcrumb.css" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
    rel="stylesheet"
/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#uploadpic').change(function(){
        var filename = $(this).val();
       if(filename != "") 
       { 
           $("#upload-pic-container").show(); //shows the upload button 
       } 
    });
});
</script>

<script>
        $(document).ready(function(){
            $("#search-bar-database").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#database tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</head>
<body>
<script src="tabnav.js"></script>
<script src="tablesort.js"></script>
<!--<script src="filtertable.js"></script> -->

<?php

    if(isset($_SESSION["successUpdateInfo"]) && $_SESSION["successUpdateInfo"] == true) {
    
    echo ' <div class="alert alert-success" role="alert">
        <strong>Success! </strong>'.$_SESSION["msg"].' 
    </div> ';
    unset ($_SESSION["successUpdateInfo"]);
    unset($_SESSION["msg"]);

    //when the user info is updated, then we need to fetch the user from the database again to display the updated information
    $id = $_SESSION["user"]["userID"];
    $sql_user = "Select * from users where userID='$id'";
    $get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_user));

    $_SESSION["user"] = $get_user;

    }

    if(isset($_SESSION["errorUpdateInfo"]) && $_SESSION["errorUpdateInfo"] == true) {

        echo ' <div class="alert alert-danger" role="alert"> 
        <strong>Error! </strong> '.$_SESSION["msg"].'
    </div> '; 
    unset($_SESSION["errorUpdateInfo"]);
    unset($_SESSION["msg"]);
    }

    if(isset($_SESSION["successUploadPic"]) && $_SESSION["successUploadPic"] == true) {
    
        echo ' <div class="alert alert-success" role="alert">
            <strong>Success! </strong>'.$_SESSION["msg"].' 
        </div> ';
        unset ($_SESSION["successUploadPic"]);
        unset($_SESSION["msg"]);
        }

    if(isset($_SESSION["errorUploadPic"]) && $_SESSION["errorUploadPic"] == true) {

        echo ' <div class="alert alert-danger" role="alert"> 
        <strong>Error! </strong> '.$_SESSION["msg"].'
    </div> '; 
    unset($_SESSION["errorUploadPic"]);
    unset($_SESSION["msg"]);
    }

  ?>

  <div class="tab">
  <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Admin Panel</li>
      </ul>
        <div class="tab-head">
            <form action="updateprofilepic.php" method="post" enctype="multipart/form-data">
            <div class="profilepiccontainer">
                <img class="profilepic" src="../images/media/<?php
                echo $_SESSION["user"]["profilepic"];
                ?>" 
                alt="profile pic">
                    <!-- The input field for the file upload is hidden for aesthetical reasons. When the pic icon is clicked
                    it will trigger the input field button click with the below javascript code --> 
                    
                    <input type="file" src = "../images/icons/edit-pngrepo-com.png" class="changepic" name="uploadpic" id="uploadpic" value="" />
                    <!--<img src="../images/icons/edit-pngrepo-com.png" alt="change profile pic icon" style="width:40px; height: 40px;"> -->
                    <!--</button> --> 
            </div>
      <div class="tab-buttons" id="upload-pic-container" hidden>
            <button type="submit" class="upload-button" name="upload-pic">Update picture</button>
        </div>
      
    </form>
      
    <h2> 
        <?php
          echo $_SESSION["user"]["username"];
        ?>
    </h2>

    </div>

        <button id="info_tab" class="tablinks" onclick="openTab(event, 'Info')">
            <span class="prof-text">Personal Details</span>
            <span class="tab-icon"><img src="../images/icons/personal-info.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
        </button>
        
        <button id="demo_tab" class="tablinks" onclick="openTab(event, 'Demographics')">
            <span class="prof-text">Demographics</span>
            <span class="tab-icon"><img src="../images/icons/chart.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
        </button>
        
        <button id="users_tab" class="tablinks" onclick="openTab(event, 'Users')">
            <span class="prof-text">Users</span>
                <span class="tab-icon"><img src="../images/icons/users.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
        <button id="property_listings_tab" class="tablinks" onclick="openTab(event, 'Property Listings')">
            <span class="prof-text">Property Listings</span>
                <span class="tab-icon"><img src="../images/icons/farm-land.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
        <button id="product_listings_tab" class="tablinks" onclick="openTab(event, 'Product Listings')">
            <span class="prof-text">Product Listings</span>
                <span class="tab-icon"><img src="../images/icons/fruit-donation.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
        <button id="settings_tab" class="tablinks" onclick="openTab(event, 'Settings')">
            <span class="prof-text">Account Settings</span>
                <span class="tab-icon"><img src="../images/icons/settings-gear.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
    </div>

<div id="Info" class="tabcontent">
  <h2>Account Details</h2>

  <h4> Username </h4>
  <input type="text" id="input-username" placeholder="Username" value= "<?php echo $_SESSION["user"]["username"]; ?>" disabled>
    
  <h4> Email Address</h4>
  <input type="text" id="input-email" placeholder="email@mail.com" value= "<?php echo $_SESSION["user"]["email"]; ?>" disabled>
        
  <h4> First Name</h4>
  <input type="text" id="input-fname" placeholder="First name" value= "<?php echo $_SESSION["user"]["first_name"]; ?>" disabled>
        
  <h4> Last Name</h4>
  <input type="text" id="input-lname" placeholder="Last name" value= "<?php echo $_SESSION["user"]["last_name"]; ?>" disabled>

  <form action="updateuserinfo.php" method="post">
    <h4> About me</h4>
    <textarea rows="4" name="input-aboutme" placeholder="A few words about you ..."><?php echo $_SESSION["user"]["about"]; ?></textarea>

    <h2>Contact Information</h2>

    <h4>Address</h4>
    <input type="text" name="input-address" placeholder="Street, Number, Region" value= "<?php echo $_SESSION["user"]["address"]; ?>">
    
    <h4>City</h4>
    <input type="text" name="input-city" placeholder="City" value= "<?php echo $_SESSION["user"]["city"]; ?>">
          
    <h4>Country</h4>
    <input type="text" name="input-country" placeholder="Country" value= "<?php echo $_SESSION["user"]["country"]; ?>">
          
    <h4>Postal Code</h4>
    <input type="text" name="input-postcode" placeholder="Postcode" value= "<?php echo $_SESSION["user"]["post_code"]; ?>">

    <h4>Phone Number</h4>
    <input type="text" name="input-phone" placeholder="Number" value= "<?php echo $_SESSION["user"]["phone_num"]; ?>">
    <button class="continue-button" type="submit">Save changes</button>  

</form>

</div>

<div id="Demographics" class="tabcontent">
  <h2>Demographics</h2>
  <h4>Daily Visitors: 23</h4>
  <h4>Total listings added today: 15</h4>
  <h5>Product Listings: 12</h5>
  <h5>Property Listings: 3</h5> 
</div>

<div id="Users" class="tabcontent">
  <h2>Users</h2>
  
  <form action="updateuser.php" method="post">
        <div class="databasecontainer">
            <div class="database-toolbar">
                <input type="input" type="text" placeholder="Search.." id="search-bar-database">
            </div>
            
            <div style="overflow-x:auto; overflow-y: auto; width: 100%; padding: 0; margin: 0;">
                <table id="database" name="users_database">
                    <tr> 
                        <th>Actions</th>
                        <th>Profile Image</th>
                        <th>
                            <h4>UserID
                                <button class="header-button" type="button" onclick="sortNumerical(2)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>Username<button class="header-button" type="button" onclick="sortAlphabetical(3)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>    
                        </th>
                        <th>
                            <h4>First Name<button class="header-button" type="button" onclick="sortAlphabetical(4)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>Last Name<button class="header-button" type="button" onclick="sortAlphabetical(5)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>

                        <th>
                        <h4>Email<button class="header-button" type="button" onclick="sortAlphabetical(6)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                        <h4>About<button class="header-button" type="button" onclick="sortAlphabetical(7)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                        <h4>Address<button class="header-button" type="button" onclick="sortAlphabetical(8)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>City <button class="header-button" type="button" onclick="sortAlphabetical(9)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Country <button class="header-button" type="button" onclick="sortAlphabetical(10)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Postal Code <button class="header-button" type="button" onclick="sortAlphabetical(11)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Phone Number <button class="header-button" type="button" onclick="sortAlphabetical(12)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Recent Activity <button class="header-button" type="button" onclick="sortAlphabetical(13)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>

                    </tr>

                    <?php

                        while ($row = mysqli_fetch_array($query_users)) {
                            if($row['userID'] != $_SESSION["user"]["userID"]) //Display all other users in the table except the connected user
                            { 
                                echo "<tr>";
                                echo "<td>
                                        <a name = '". $row['userID']. "'"." class="."delete_user_record"." id = '". $row['userID']. "' href= AdminPanel.php?useredit=".$row["userID"].">Edit</a>

                                        <a name = '". $row['username']. "' id =  '". $row['username']. "' href= AdminPanel.php?userdelete=".$row["userID"].">Delete</a>
                                    </td>";
                                
                                //If the edit button was pressed, then all of the fields below will be an input field ONLY on the row we want to change
                                if(isset($_GET["useredit"]) && $_GET["useredit"] == $row['userID'])
                                {
                                    echo "<td>
                                            <input type = 'text' name = 'profilepic_edit' value = '". $row['profilepic']. "' style='width: fit-content'> 
                                          </td>";
                                    echo "<td>
                                            <input type = 'text' name = 'id_edit' value = '". $row['userID']. "' style='width: fit-content' readonly> 
                                          </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'username_edit' value = '". $row['username']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'fn_edit' value = '". $row['first_name']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'ln_edit' value = '". $row['last_name']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'email_edit' value = '". $row['email']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'about_edit' value = '". $row['about']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'address_edit' value = '". $row['address']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'city_edit' value = '". $row['city']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'country_edit' value = '". $row['country']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'pc_edit' value = '". $row['post_code']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'phone_edit' value = '". $row['phone_num']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'activity_edit' value = '". $row['recent_activity']. "' style='width: fit-content'>
                                        </td>";
                                    echo "</tr>";  
                                }
                                else
                                {
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$row['profilepic']." alt="."profile image"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>" . $row['userID'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['first_name'] . "</td>";
                                    echo "<td>" . $row['last_name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['about'] . "</td>";
                                    echo "<td>" . $row['address'] . "</td>";
                                    echo "<td>" . $row['city'] . "</td>";
                                    echo "<td>" . $row['country'] . "</td>";
                                    echo "<td>" . $row['post_code'] . "</td>";
                                    echo "<td>" . $row['phone_num'] . "</td>";
                                    echo "<td>" . $row['recent_activity'] . "</td>";
                                    echo "</tr>";   
                                }
                            }
                        }
                    ?>
                </table>

                <p id = "no_results" style="display:none;">No records found<p>

            </div>
        </div>

        <?php 

            //These buttons only appear if the admin has chosen to edit a record.
            if(isset($_GET["useredit"]))
            {
                echo "<button name='save_changes' class='continue-button' type='submit'>Save changes</button>";
                echo "<button name='discard_changes' class='continue-button' type='submit' style='background-color: red'>Discard changes</button>";  
            }
        ?>

    </form>

</div>

<div id="Property Listings" class="tabcontent">
    <h2>Property Listings</h2>
    
    <form action="updateproperty.php" method="post">
        <div class="databasecontainer">
            <div class="database-toolbar">
                <input type="input" type="text" placeholder="Search.." id="search-bar-database">
            </div>
            
            <div style="overflow-x:auto; overflow-y: auto; width: 100%; padding: 0; margin: 0;">
                <table id="database" name="property_database">
                    <tr> 
                        <th>Actions</th>
                        <th>Image1</th>
                        <th>Image2</th>
                        <th>Image3</th>
                        <th>
                            <h4>ListingID
                                <button class="header-button" type="button" onclick="sortNumerical(4)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>CreatorID
                                <button class="header-button" type="button" onclick="sortNumerical(5)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>Property Name<button class="header-button" type="button" onclick="sortAlphabetical(6)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>    
                        </th>
                        <th>
                            <h4>Surface Area<button class="header-button" type="button" onclick="sortNumerical(7)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>Facing Road<button class="header-button" type="button" onclick="sortAlphabetical(8)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>

                        <th>
                        <h4>Altitude<button class="header-button" type="button" onclick="sortNumerical(9)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                        <h4>Average Sunlight<button class="header-button" type="button" onclick="sortNumerical(10)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                        <h4>Average Rainfall<button class="header-button" type="button" onclick="sortNumerical(11)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>Country <button class="header-button" type="button" onclick="sortAlphabetical(12)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>State <button class="header-button" type="button" onclick="sortAlphabetical(13)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Area <button class="header-button" type="button" onclick="sortAlphabetical(14)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Recom. Cultivation <button class="header-button" type="button" onclick="sortAlphabetical(15)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Drilling <button class="header-button" type="button" onclick="sortNumerical(16)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>
                        <h4>Description <button class="header-button" type="button" onclick="sortAlphabetical(17)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th> Contact Info <button class="header-button" type="button" onclick="sortAlphabetical(18)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                    </tr>

                    <?php

                        while ($property = mysqli_fetch_array($query_properties)) {
                                echo "<tr>";
                                echo "<td>
                                        <a name = '". $property['ID']. "' id = '". $property['ID']. "' href= AdminPanel.php?propertyedit=".$property["ID"].">Edit</a>

                                        <a name = '". $property['ID']. "' id =  '". $property['ID']. "' href= AdminPanel.php?propertydelete=".$property["ID"].">Delete</a>
                                    </td>";
                                
                                //If the edit button was pressed, then all of the fields below will be an input field ONLY on the row we want to change
                                if(isset($_GET["propertyedit"]) && $_GET["propertyedit"] == $property['ID'])
                                {
                                    echo "<td>
                                            <input type = 'text' name = 'prop_image1_edit' value = '". $property['image1']. "' style='width: fit-content'> 
                                          </td>";
                                    echo "<td>
                                          <input type = 'text' name = 'prop_image2_edit' value = '". $property['image2']. "' style='width: fit-content'> 
                                        </td>";
                                    echo "<td>
                                        <input type = 'text' name = 'prop_image3_edit' value = '". $property['image3']. "' style='width: fit-content'> 
                                      </td>";
                                    echo "<td>
                                            <input type = 'text' name = 'propertyid_edit' value = '". $property['ID']. "' style='width: fit-content' readonly> 
                                          </td>";
                                    echo "<td>
                                          <input type = 'text' name = 'property_userid_edit' value = '". $property['UserID']. "' style='width: fit-content' readonly> 
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'prop_name_edit' value = '". $property['property_name']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'surface_edit' value = '". $property['surface_area']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'road_edit' value = '". $property['facing_road']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'alt_edit' value = '". $property['altitude']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'sun_edit' value = '". $property['average_sunlight']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'rain_edit' value = '". $property['average_rainfall']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'prop_country_edit' value = '". $property['country']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'prop_state_edit' value = '". $property['state']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'prop_area_edit' value = '". $property['area']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'recom_cult_edit' value = '". $property['recom_cult']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'drill_edit' value = '". $property['drill']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                        <input type = 'text' name = 'prop_description_edit' value = '". $property['description']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'prop_contact_edit' value = '". $property['contact_info']. "' style='width: fit-content'>
                                    </td>";
                                    echo "</tr>";  
                                }
                                else
                                {
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$property['image1']." alt="."image1"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$property['image2']." alt="."image1"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$property['image3']." alt="."image1"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>" . $property['ID'] . "</td>";
                                    echo "<td>" . $property['UserID'] . "</td>";
                                    echo "<td>" . $property['property_name'] . "</td>";
                                    echo "<td>" . $property['surface_area'] . "</td>";
                                    echo "<td>" . $property['facing_road'] . "</td>";
                                    echo "<td>" . $property['altitude'] . "</td>";
                                    echo "<td>" . $property['average_sunlight'] . "</td>";
                                    echo "<td>" . $property['average_rainfall'] . "</td>";
                                    echo "<td>" . $property['country'] . "</td>";
                                    echo "<td>" . $property['state'] . "</td>";
                                    echo "<td>" . $property['area'] . "</td>";
                                    echo "<td>" . $property['recom_cult'] . "</td>";
                                    echo "<td>" . $property['drill'] . "</td>";
                                    echo "<td>" . $property['description'] . "</td>";
                                    echo "<td>" . $property['contact_info'] . "</td>";
                                    echo "</tr>";   
                                }
                            }
                    ?>

                </table>

                <p id = "no_results" style="display:none;">No records found<p>

            </div>
        </div>

        <?php 

            //These buttons only appear if the admin has chosen to edit a record.
            if(isset($_GET["propertyedit"]))
            {
                echo "<button name='save_changes' class='continue-button' type='submit'>Save changes</button>";
                echo "<button name='discard_changes' class='continue-button' type='submit' style='background-color: red'>Discard changes</button>";  
            }
        ?>

    </form>

  </div>

  <div id="Product Listings" class="tabcontent">
    <h2>Product Listings</h2>
    
    <form action="updateproduct.php" method="post">
        <div class="databasecontainer">
            <div class="database-toolbar">
                <input type="input" type="text" placeholder="Search.." id="search-bar-database">
            </div>
            
            <div style="overflow-x:auto; overflow-y: auto; width: 100%; padding: 0; margin: 0;">
                <table id="database" name="products_database">
                    <tr> 
                        <th>Actions</th>
                        <th>Image1</th>
                        <th>Image2</th>
                        <th>Image3</th>
                        <th>
                            <h4>ListingID
                                <button class="header-button" type="button" onclick="sortNumerical(4)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>CreatorID
                                <button class="header-button" type="button" onclick="sortNumerical(5)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>Product Name <button class="header-button" type="button" onclick="sortAlphabetical(6)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>    
                        </th>
                        <th>
                            <h4>Product Category <button class="header-button" type="button" onclick="sortNumerical(7)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                            <h4>Cultivation Method <button class="header-button" type="button" onclick="sortAlphabetical(8)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>

                        <th>
                        <h4>Price<button class="header-button" type="button" onclick="sortNumerical(9)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                        <h4>Annual Production <button class="header-button" type="button" onclick="sortNumerical(10)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>
                        <h4>Origin <button class="header-button" type="button" onclick="sortNumerical(11)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th>Country <button class="header-button" type="button" onclick="sortAlphabetical(12)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>State <button class="header-button" type="button" onclick="sortAlphabetical(13)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Area <button class="header-button" type="button" onclick="sortAlphabetical(14)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Minimum Order <button class="header-button" type="button" onclick="sortAlphabetical(15)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>Package Type <button class="header-button" type="button" onclick="sortNumerical(16)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                        <th>
                        <h4>Description <button class="header-button" type="button" onclick="sortAlphabetical(17)">
                                <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                            </button></h4>
                        </th>
                        <th> Contact Info <button class="header-button" type="button" onclick="sortAlphabetical(18)">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></th>
                    </tr>
                <?php

                        while ($product = mysqli_fetch_array($query_products)) {
                                echo "<tr>";
                                echo "<td>
                                        <a name = '". $product['ID']. "' id = '". $product['ID']. "' href= AdminPanel.php?productedit=".$product["ID"].">Edit</a>

                                        <a name = '". $product['ID']. "' id =  '". $product['ID']. "' href= AdminPanel.php?productdelete=".$product["ID"].">Delete</a>
                                    </td>";
                                
                                //If the edit button was pressed, then all of the fields below will be an input field ONLY on the row we want to change
                                if(isset($_GET["productedit"]) && $_GET["productedit"] == $product['ID'])
                                {
                                    echo "<td>
                                            <input type = 'text' name = 'image1_edit' value = '". $product['image1']. "' style='width: fit-content'> 
                                          </td>";
                                    echo "<td>
                                          <input type = 'text' name = 'image2_edit' value = '". $product['image2']. "' style='width: fit-content'> 
                                        </td>";
                                    echo "<td>
                                        <input type = 'text' name = 'image3_edit' value = '". $product['image3']. "' style='width: fit-content'> 
                                      </td>";
                                    echo "<td>
                                            <input type = 'text' name = 'productid_edit' value = '". $product['ID']. "' style='width: fit-content' readonly> 
                                          </td>";
                                    echo "<td>
                                          <input type = 'text' name = 'product_userid_edit' value = '". $product['UserID']. "' style='width: fit-content' readonly> 
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'prod_name_edit' value = '". $product['product_name']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'prod_cat_edit' value = '". $product['product_category']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'cult_edit' value = '". $product['cultivation_method']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'price_edit' value = '". $product['price']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'annual_edit' value = '". $product['annual_production']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'origin_edit' value = '". $product['place_of_origin']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'prod_country_edit' value = '". $product['country']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'prod_state_edit' value = '". $product['state']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'area_edit' value = '". $product['area']. "' style='width: fit-content'>
                                </td>";
                                        echo "<td> 
                                        <input type = 'text' name = 'minorder_edit' value = '". $product['minimum_order']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                            <input type = 'text' name = 'packtype_edit' value = '". $product['package_type']. "' style='width: fit-content'>
                                        </td>";
                                    echo "<td> 
                                        <input type = 'text' name = 'prod_description_edit' value = '". $product['description']. "' style='width: fit-content'>
                                    </td>";
                                    echo "<td> 
                                    <input type = 'text' name = 'prod_contact_edit' value = '". $product['contact_info']. "' style='width: fit-content'>
                                    </td>";
                                    echo "</tr>";  
                                }
                                else
                                {
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$product['image1']." alt="."image1"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$product['image2']." alt="."image1"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>
                                        <img class="."table-image"." src=../images/media/".$product['image3']." alt="."image1"." style="."width: 50px; height: 50px;".">
                                    </td>";
                                    echo "<td>" . $product['ID'] . "</td>";
                                    echo "<td>" . $product['UserID'] . "</td>";
                                    echo "<td>" . $product['product_name'] . "</td>";
                                    echo "<td>" . $product['product_category'] . "</td>";
                                    echo "<td>" . $product['cultivation_method'] . "</td>";
                                    echo "<td>" . $product['price'] . "</td>";
                                    echo "<td>" . $product['annual_production'] . "</td>";
                                    echo "<td>" . $product['place_of_origin'] . "</td>";
                                    echo "<td>" . $product['country'] . "</td>";
                                    echo "<td>" . $product['state'] . "</td>";
                                    echo "<td>" . $product['area'] . "</td>";
                                    echo "<td>" . $product['minimum_order'] . "</td>";
                                    echo "<td>" . $product['package_type'] . "</td>";
                                    echo "<td>" . $product['description'] . "</td>";
                                    echo "<td>" . $product['contact_info'] . "</td>";
                                    echo "</tr>";   
                                }
                            }
                    ?>

                    </table>

                <p id = "no_results" style="display:none;">No records found<p>

            </div>
        </div>

        <?php 

            //These buttons only appear if the admin has chosen to edit a record.
            if(isset($_GET["productedit"]))
            {
                echo "<button name='save_changes' class='continue-button' type='submit'>Save changes</button>";
                echo "<button name='discard_changes' class='continue-button' type='submit' style='background-color: red'>Discard changes</button>";  
            }
        ?>

    </form>

  </div>

  <div id="Settings" class="tabcontent">
    <h2>Account Settings</h2>
    <div class="buttonGroup">
      <button type="button" class="settingbutton"> <h4> <a href="changeUsername.php">Change username </a></h4> </button>        
      <button type="button" class="settingbutton" href="changePassword.php"> <h4> <a href="changePassword.php">Change password </a></h4> </button>
      <button type="button" class="settingbutton" href="changeEmail.php"> <h4><a href="changeEmail.php"> Change email </a></h4> </button>
    </div> 
  </div>

  <script type="text/Javascript"> //This script is using AJAX to ask for permission from the admin to delete a user record via alert
      $(document).ready(function()
      {
          var deleteid = <?php if(isset($_GET["userdelete"])) 
                                    {echo $_GET["userdelete"];} else {echo 0;} ?>;
            if(deleteid > 0)
            {
                if(confirm('Are you sure to delete the user with id = ' + deleteid + '? You cannot undo this action!')) {
                $.ajax({
                    url: 'deleteuser.php',
                    type: 'POST',
                    data: {deleteid: deleteid}, 
                    success: function(response)
                    {
                      if(response == 1)
                      {
                          window.location = "AdminPanel.php"; //reload the page to update the database table
                      }
                    },
                    error: function()
                    {
                        window.location = "AdminPanel.php"; //reload the page to update the database table
                    }
                });
            }
            }
            
        });
    </script>

<script type="text/Javascript"> //This script is using AJAX to ask for permission from the admin to delete a product record via alert
      $(document).ready(function()
      {
          var deleteid = <?php if(isset($_GET["productdelete"])) 
                                    {echo $_GET["productdelete"];} else {echo -1;} ?>;
            if(deleteid > 0)
            {
                if(confirm('Are you sure to delete the product with id = ' + deleteid + '? You cannot undo this action!')) {
                $.ajax({
                    url: 'deleteproduct.php',
                    type: 'POST',
                    data: {deleteid: deleteid}, 
                    success: function(response)
                    {
                      if(response == 1)
                      {
                          window.location = "AdminPanel.php"; //reload the page to update the database table
                      }
                    },
                    error: function()
                    {
                        window.location = "AdminPanel.php"; //reload the page to update the database table
                    }
                });
            }
            }
            
        });
    </script>

<script type="text/Javascript"> //This script is using AJAX to ask for permission from the admin to delete a property record via alert
      $(document).ready(function()
      {
          var deleteid = <?php if(isset($_GET["propertydelete"])) 
                                    {echo $_GET["propertydelete"];} else {echo -1;} ?>;
            if(deleteid > 0)
            {
                if(confirm('Are you sure to delete the property with id = ' + deleteid + '? You cannot undo this action!')) {
                $.ajax({
                    url: 'deleteproperty.php',
                    type: 'POST',
                    data: {deleteid: deleteid}, 
                    success: function(response)
                    {
                      if(response == 1)
                      {
                          window.location = "AdminPanel.php"; //reload the page to update the database table
                      }
                    },
                    error: function()
                    {
                        window.location = "AdminPanel.php"; //reload the page to update the database table
                    }
                });
            }
            }
            
        });
    </script>

<script>  // Get the element with id="defaultOpen" and click on it
    document.getElementById("info_tab").click();
</script>

<script> //click on the current set active tab
    var active = '<?=$_SESSION["active_tab"]?>';
    //if(editmode) //if the number is a positive integer (a user's id)
        document.getElementById(active).click();
</script>

</body>
</html> 
