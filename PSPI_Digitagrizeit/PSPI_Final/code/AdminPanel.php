<?php
  session_start();
  include("connect.php");

  $sql_users = "SELECT * from users";
  $query_users = mysqli_query($conn, $sql_users);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="adminpanel.css" type="text/css">
<link rel= "stylesheet" href="master.css" type="text/css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
    rel="stylesheet"
/>

</head>
<body>

<script src="tabnav.js"></script>

  <div class="tab">
  <div class="tab-head">
      <div class="profilepiccontainer">
        <img class="profilepic" src="../images/media/<?php
          echo $_SESSION["user"]["profilepic"];
        ?>" alt="profile pic">

        <form action="" method="post">
            <input type="file" name="uploadpic" id="uploadpic" value="" hidden/>
            <button class="changepic" type="submit" name="uploadprofpic" id="uploadprofpic">

            <!-- The input field for the file upload is hidden for aesthetical reasons. When the pic icon is clicked
            it will trigger the input field button click with the below javascript code --> 

        </form>
            <img src="../images/icons/edit-pngrepo-com.png" alt="change profile pic icon" style="width:40px; height: 40px;">
        </button>
      </div>     
      <h2> 
        <?php
          echo $_SESSION["user"]["username"];
        ?>
      </h2>
    </div>

        <button class="tablinks" onclick="openTab(event, 'Info')" id="defaultOpen">
            <span class="prof-text">Personal Details</span>
            <span class="tab-icon"><img src="../images/icons/personal-info.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
        </button>
        
        <button class="tablinks" onclick="openTab(event, 'Demographics')">
            <span class="prof-text">Demographics</span>
            <span class="tab-icon"><img src="../images/icons/chart.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
        </button>
        
        <button class="tablinks" onclick="openTab(event, 'Users')">
            <span class="prof-text">Users</span>
                <span class="tab-icon"><img src="../images/icons/users.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
        <button class="tablinks" onclick="openTab(event, 'Listings')">
            <span class="prof-text">Listings</span>
                <span class="tab-icon"><img src="../images/icons/farm-land.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
        <button class="tablinks" onclick="openTab(event, 'Settings')">
            <span class="prof-text">Account Settings</span>
                <span class="tab-icon"><img src="../images/icons/settings-gear.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
            </button>
    </div>

<div id="Info" class="tabcontent">
  <h2>Account Details</h2>

  <h4> Username </h4>
  <input type="text" id="input-username" placeholder="Username" value= <?php echo $_SESSION["user"]["username"]; ?> disabled>
    
  <h4> Email Address</h4>
  <input type="text" id="input-email" placeholder="email@mail.com" value= <?php echo $_SESSION["user"]["email"]; ?> disabled>
        
  <h4> First Name</h4>
  <input type="text" id="input-fname" placeholder="First name" value= <?php echo $_SESSION["user"]["first_name"]; ?> disabled>
        
  <h4> Last Name</h4>
  <input type="text" id="input-lname" placeholder="Last name" value= <?php echo $_SESSION["user"]["last_name"]; ?> disabled>

  <form action="updateuser.php">
    <h4> About me</h4>
    <textarea rows="4" id="input-aboutme" placeholder="A few words about you ..."> <?php echo $_SESSION["user"]["about"]; ?></textarea>

    <h2>Contact Information</h2>

    <h4>Address</h4>
    <input type="text" id="input-address" placeholder="Street, Number, Region" value= <?php echo $_SESSION["user"]["address"]; ?>>
    
    <h4>City</h4>
    <input type="text" id="input-city" placeholder="City" value= <?php echo $_SESSION["user"]["city"]; ?>>
          
    <h4>Country</h4>
    <input type="text" id="input-country" placeholder="Country" value= <?php echo $_SESSION["user"]["country"]; ?>>
          
    <h4>Postal Code</h4>
    <input type="text" id="input-postcode" placeholder="Postcode" value= <?php echo $_SESSION["user"]["post_code"]; ?>>

    <h4>Phone Number</h4>
    <input type="text" id="input-phone" placeholder="Number" value= <?php echo $_SESSION["user"]["phone_num"]; ?>>
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
  
  <div class="databasecontainer">
        <div class="database-toolbar">
            <input type="input" type="text" placeholder="Search.." id="search-bar-database">
            <button class="filter_button">
                <img src="../images/icons/filter-2-fill.png" alt="filter button" style="width: 20px; height: 20px;">
            </button>
        </div>
        
        <div style="overflow-x:auto; overflow-y: auto; width: 100%; padding: 0; margin: 0;">
            <table id="database">
                <tr> 
                    <th>Actions</th>
                    <th>Profile Image</th>
                    <th>
                        <h4>UserID<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>
                    </th>
                    <th>
                        <h4>Username<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>    
                    </th>
                    <th>
                        <h4>First Name<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>
                    </th>
                    <th>
                        <h4>Last Name<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>
                    </th>

                    <th>Email</th>
                    <th>About</th>
                    <th>Address</th>
                    <th>City <button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>
                    <th>Country <button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>
                    <th>Postal Code <button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>
                    <th>Phone Number <button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>
                    <th>Recent Activity <button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>

                </tr>

                <?php
                    while ($row = mysqli_fetch_array($query_users)) {
                        echo "<tr>";
                        echo '<td>
                                <div class="action-buttons">
                                    <button>
                                        <img src="../images/icons/edit-pen.png" alt = "edit button" style="width: 20px; height: 20px;"></img>
                                    </button>
                                    <button>
                                        <img src="../images/icons/delete.png" alt = "delete button" style="width: 20px; height: 20px;"></img>
                                    </button>
                                </div> 
                            </td>';
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
                ?>
            </table>
        </div>
    </div>
</div>

<div id="Listings" class="tabcontent">
    <h2>Listings</h2>
    
    <div class="databasecontainer">
        <div class="database-toolbar">
            <input type="input" type="text" placeholder="Search.." id="search-bar-database">
            <button class="filter_button">
                <img src="../images/icons/filter-2-fill.png" alt="filter button" style="width: 20px; height: 20px;">
            </button>
        </div>
        
        <div style="overflow-x:auto; overflow-y: auto; width: 100%; padding: 0; margin: 0;">
            <table id="database">
                <tr> 
                    <th>Actions</th>
                    <th>
                        <h4>ListingID<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>
                    </th>
                    <th>
                        <h4>Creator<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>    
                    </th>
                    <th>
                        <h4>Category<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>
                    </th>
                    <th>
                        <h4>Listing Name<button class="header-button">
                            <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                        </button></h4>
                        
                    </th>
                    <th>Date Listed<button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>
                    <th>Country<button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></th>
                    <th>More columns...</th>
                </tr>
                <tr>
                    <td>
                        <div class="action-buttons">
                            <button>
                                <img src="../images/icons/edit-pen.png" alt = "edit button" style="width: 20px; height: 20px;"></img>
                            </button>
                            <button>
                                <img src="../images/icons/delete.png" alt = "delete button" style="width: 20px; height: 20px;"></img>
                            </button>
                        </div>
                    </td>
                    <td>0</td>
                    <td>johnfarmer</td>
                    <td>Land/Property</td>
                    <td>Olive Field</td>
                    <td>12/04/2022</td>
                    <td>France</td>
                    <td>...</td>
                    
                </tr>
                <tr>
                    <td>
                        <div class="action-buttons">
                            <button>
                                <img src="../images/icons/edit-pen.png" alt = "edit button" style="width: 20px; height: 20px;"></img>
                            </button>
                            <button>
                                <img src="../images/icons/delete.png" alt = "delete button" style="width: 20px; height: 20px;"></img>
                            </button>
                        </div>
                    </td>
                    <td>1</td>
                    <td>applejack</td>
                    <td>Products</td>
                    <td>Apples</td>
                    <td>24/04/2022</td>
                    <td>Romania</td>
                    <td>...</td>
                </tr>
                <tr>
                    <td>
                        <div class="action-buttons">
                            <button>
                                <img src="../images/icons/edit-pen.png" alt = "edit button" style="width: 20px; height: 20px;"></img>
                            </button>
                            <button>
                                <img src="../images/icons/delete.png" alt = "delete button" style="width: 20px; height: 20px;"></img>
                            </button>
                        </div>
                    </td>
                    <td>2</td>
                    <td>manthos</td>
                    <td>Land/Property</td>
                    <td>Tobacco</td>
                    <td>30/04/2022</td>
                    <td>Greece</td>
                    <td>...</td>
                </tr>
            </table>
        </div>
    </div>

  </div>

<div id="Settings" class="tabcontent">
    <h2>Account Settings</h2>

    <div class="buttonGroup">
      <button type="button" class="settingbutton"> <h4> Change username </h4> </button>
      <button type="button" class="settingbutton"> <h4> Change password </h4> </button>
      <button type="button" class="settingbutton"> <h4> Change email </h4> </button>
      <button type="button" class="settingbutton"> <h4 style="color: red;"> Delete account </h4> </button>
    </div> 
  </div>


<script>  // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script>
    document.getElementById("uploadprofpic").addEventListener('click', clickUpload);

    function clickUpload() {
        document.getElementById("uploadpic").click();
    }
</script>

</body>
</html> 
