<?php
  session_start();

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="userprofile.css" type="text/css">
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
        <button class="changepic">
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
  <button class="tablinks" onclick="openTab(event, 'Products')">
    <span class="prof-text">Products</span>
    <span class="tab-icon"><img src="../images/icons/fruit-donation.png" alt="profile info icon" style="width: 20px; height: 20px;"/></span>
  </button>
  
  <button class="tablinks" onclick="openTab(event, 'Land')">
    <span class="prof-text">Land/Property</span>
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

<div id="Products" class="tabcontent">
  <h2>Product Listings</h2>
  
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
                <h4>Image</h4>
              </th>
                <th>Date Listed<button class="header-button">
                  <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                </button></th>
                <th>
                    <h4>Name<button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></h4>    
                </th>
                <th>
                    <h4>Category<button class="header-button">
                        <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                    </button></h4>
                </th>
                <th>
                  <h4>Sub-category<button class="header-button">
                      <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                  </button></h4>
              </th>
                <th>
                  <h4>Description</h4>
                </th>
                <th>
                    <h4>Cultivation Method</h4>
                </th>
                <th>Price per weight<button class="header-button">
                    <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                </button></th>
                <th>Annual Production<button class="header-button">
                  <img src = "../images/icons/sort.png" style="width: 15px; height: 15px;"></img>
                </button></th>

                <th>Origin<button class="header-button">
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
                <td>
                  <img class="table-image" src="../images/SearchResultsImg/shelley-pauls-I58f47LRQYM-unsplash.jpg" alt="listing image" style="width: 50px; height: 50px;">
                </td>
                <td>20/03/2022</td>
                <td>Fresh Red Apples</td>
                <td>Fruit</td>
                <td>Red Apples</td>
                <td>Coated with wax</td>
                <td>Conventional</td>
                <td>1.5 euro/kilo</td>
                <td>20 tons</td>
                <td>Argos</td>
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
              <td>
                <img class="table-image" src="../images/SearchResultsImg/rajesh-rajput-y2MeW00BdBo-unsplash.jpg" alt="listing image" style="width: 50px; height: 50px;">
              </td>
              <td>22/04/2022</td>
              <td>Fresh Grapes</td>
              <td>Fruit</td>
              <td>Grapes</td>
              <td>Merlot</td>
              <td>Biological</td>
              <td>3 euro/kilo</td>
              <td>10 tons</td>
              <td>Espere</td>
              <td>...</td>
            </tr>
            <tr>
                
            </tr>
        </table>
    </div>
</div>

<div class="add-button">
  <img src="../images/icons/add.png" alt="add listing" style="width: 50px; height: 50px;"></img>
</div>

</div>

<div id="Land" class="tabcontent">
  <h2>Land/Property Listings</h2>
  <p>You have not created any land or property listings yet.</p>

  <div class="add-button">
    <img src="../images/icons/add.png" alt="add listing" style="width: 50px; height: 50px;"></img>
  </div>
    
</div>

<div id="Settings" class="tabcontent">
    <h2>Account Settings</h2>
    <div class="buttonGroup">
      <button type="button" class="settingbutton"> <h4> <a href="changeUsername.php">Change username </a></h4> </button>        
      <button type="button" class="settingbutton" href="changePassword.php"> <h4> <a href="changePassword.php">Change password </a></h4> </button>
      <button type="button" class="settingbutton" href="changeEmail.php"> <h4><a href="changeEmail.php"> Change email </a></h4> </button>
      <button type="button" class="settingbutton"> <h4 style="color: red;"> Delete account </h4> </button>
    </div> 
  </div>

<script>  // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
   
</body>
</html> 
