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

  $sql = 'SELECT * FROM Products';
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
          <p>Product Listings</p>
          <h1>Agricultural Products from all over Europe</h1>
          <?php 
            while($product = mysqli_fetch_assoc($id)):
              
          ?>

              <div class="product">
                  <div class="product-img">
                      <div class="pic-ctn">
                          
                              <img src='../images/media/<?php echo $product["image1"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="300">
                              <img src='../images/media/<?php echo $product["image2"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="300">
                              <img src='../images/media/<?php echo $product["image3"];?>' alt="IMAGE-NOT-FOUND" class="pic" width="200" height="300">
                  
                      </div>
                  </div>
                  



                  <div class="product-info">
                    <p> <?= $product['product_name'];?>, <?= $product['place_of_origin'];?>/ <?= $product['country'];?></p>
                    <h3>Fresh <?= $product['product_name'];?> for Sale in <?= $product['place_of_origin'];?>/<?= $product['state'];?>/<?= $product['area'];?></h3>
                    <p><?= $product['product_category'];?>/ cultivation: <?= $product['cultivation_method'];?>/ Anual production: <?= $product['annual_production'];?> tons</p>
                    <h5>Sumbitted by:NAME</h5>
                    <h5>Contact info: email, phonenumber, ...</h5>
                    
                    <div class="product-price">
                      <p><?= $product['package_type'];?>, minimum order: <?= $product['minimum_order'];?> kg</p>
                      <h4><?= $product['price'];?>€<span>/ kg</span></h4>
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
