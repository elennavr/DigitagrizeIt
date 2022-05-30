<?php
  session_start();
  $servername = "localhost"; 
  $username = "root"; 
  $pswd = "";
  $database = "listingsdb";


  $con = mysqli_connect($servername, $username, $pswd, $database);
  if($con) {
    //echo "success"; 
             } 
  else {
    die("Error". mysqli_connect_error()); 
         }

  $sql = 'SELECT * FROM Properties';
  $id = $con->query($sql);

  
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Digitagrize It - Cultivation</title>
    <link rel="icon" href="../images/icons/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <link rel="stylesheet" href="navigation.css" />
    <link rel="stylesheet" href="breadcrumb.css" />
    <link
      rel="stylesheet" type="text/css" href="WebActivity.css"
    />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap"
      rel="stylesheet"
    />
    <script src="script.js" defer></script>
  </head>
  <body>
  <?php include("navigation_NOT_HOME.php"); ?>

    <div class="container">
      <div class="container-search">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Cultivations</li>
      </ul>
        </div>
      <hr>
      <div class="search-container">
      
      <form method="post">
        <input type="text" placeholder="Search.." name="search">
        <button name="submit" type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="list-container">
        <div class="left">
          <p>Property Listings</p>
          <h1>Available properties from all over Europe</h1>

          <?php
          if(isset($_POST['search'])):
            $searchq = $_POST['search'];
            $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
            $query= mysqli_query($con, "SELECT * FROM properties WHERE property_name LIKE '%$searchq%' OR country LIKE '%$searchq%' OR surface_area LIKE '%$searchq%' OR altitude LIKE '%$searchq%' OR average_sunlight LIKE '%$searchq%' OR area LIKE '%$searchq%'");
            $count = mysqli_num_rows($query);
            if($count ==0){
              $out = "No results!";
            }
            if($count>0):
              while($properties = mysqli_fetch_array($query)): ?>
                   <div class="product">
                  <div class="product-img">
                      <div class="pic-ctn">
                          
                              <img src='../images/media/<?php echo $properties["image1"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="250">
                              <img src='../images/media/<?php echo $properties["image2"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="250">
                              <img src='../images/media/<?php echo $properties["image3"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="250">
                  
                      </div>
                  </div>
                  



                  <div class="product-info">
                    <p> <?= $properties['property_name'];?>, <?= $properties['state'];?>/ <?= $properties['country'];?></p>
                    <h3><?= $properties['property_name'];?> for Sale/Rent in <?= $properties['country'];?>/<?= $properties['state'];?>/<?= $properties['area'];?></h3>
                    <p>average sunlight:<?= $properties['average_sunlight'];?>days, average rainfall:<?= $properties['average_rainfall'];?>days/ facing road: <?= $properties['facing_road'];?>/ Altitude: <?= $properties['altitude'];?>m</p>
                    <h5><?= $properties['contact_info'];?></h5>
                    
                    <div class="product-price">
                      <p>surface are:<?= $properties['surface_area'];?>m2</p>
                      <h4>recommended cultivation: <?= $properties['recom_cult'];?></h4>
            
                    </div>

                    <div class="Description">
                      <textarea maxlength="255" rows="10"  readonly><?= $properties['description'];?></textarea></div>
                    
                    
                    
                </div>
              </div>

              <?php  endwhile; endif; endif;
              if(!isset($_POST['search'])):
          ?>
          <?php 
            while($properties = mysqli_fetch_assoc($id)):
              
          ?>

              <div class="product">
                  <div class="product-img">
                      <div class="pic-ctn">
                          
                              <img src='../images/media/<?php echo $properties["image1"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="250">
                              <img src='../images/media/<?php echo $properties["image2"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="250">
                              <img src='../images/media/<?php echo $properties["image3"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="250">
                  
                      </div>
                  </div>
                  



                  <div class="product-info">
                    <p> <?= $properties['property_name'];?>, <?= $properties['state'];?>/ <?= $properties['country'];?></p>
                    <h3><?= $properties['property_name'];?> for Sale/Rent in <?= $properties['country'];?>/<?= $properties['state'];?>/<?= $properties['area'];?></h3>
                    <p>average sunlight:<?= $properties['average_sunlight'];?>days, average rainfall:<?= $properties['average_rainfall'];?>days/ facing road: <?= $properties['facing_road'];?>/ Altitude: <?= $properties['altitude'];?>m</p>
                    <h5><?= $properties['contact_info'];?></h5>
                    
                    <div class="product-price">
                      <p>surface are:<?= $properties['surface_area'];?>m2</p>
                      <h4>recommended cultivation: <?= $properties['recom_cult'];?></h4>
            
                    </div>

                    <div class="Description">
                      <textarea maxlength="255" rows="10"  readonly><?= $properties['description'];?></textarea></div>
                    
                    
                    
                </div>
              </div>

          <?php endwhile; endif; ?>
        </div>
      </div>
    </div>




  </body>
</html>
