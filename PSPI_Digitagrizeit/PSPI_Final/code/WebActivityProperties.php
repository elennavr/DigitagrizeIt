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
    <link rel="icon" href="favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
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
      <div class="list-container">
        <div class="left">
          <p>Property Listings</p>
          <h1>Available properties from all over Europe</h1>
          <?php 
            while($product = mysqli_fetch_assoc($id)):
              
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
                    <p> <?= $product['property_name'];?>, <?= $product['state'];?>/ <?= $product['country'];?></p>
                    <h3><?= $product['property_name'];?> for Sale/Rent in <?= $product['country'];?>/<?= $product['state'];?>/<?= $product['area'];?></h3>
                    <p>average sunlight:<?= $product['average_sunlight'];?>days, average rainfall:<?= $product['average_rainfall'];?>days/ facing road: <?= $product['facing_road'];?>/ Altitude: <?= $product['altitude'];?>m</p>
                    <h5><?= $product['contact_info'];?></h5>
                    
                    <div class="product-price">
                      <p>surface are:<?= $product['surface_area'];?>m2</p>
                      <h4>recommended cultivation: <?= $product['recom_cult'];?></h4>
            
                    </div>

                    <div class="Description">
                      <textarea maxlength="255" rows="10"  readonly><?= $product['description'];?></textarea></div>
                    
                    
                    
                </div>
              </div>

          <?php endwhile; ?>
        </div>
      </div>
    </div>




  </body>
</html>
