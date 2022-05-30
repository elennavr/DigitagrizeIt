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
  $result = $con->query($sql); 




  $out= "";
  $i= 0;

?>




<!DOCTYPE html>
<html>
  <head>
    <title>Digitagrize It - Products</title>
    <link rel="icon" href="../images/icons/favicon.png" />
    <link rel="stylesheet" href="navigation.css" />
    <link rel="stylesheet" href="breadcrumb.css" />
    <link rel="stylesheet" href="footer.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <link rel="stylesheet" type="text/css" href="WebActivity.css" />
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
        <li>Products</li>
      </ul>
        </div>  <hr>
      <div class="search-container">

    <form action="" enctype="multipart/form-data" method="POST">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit"><i class="fa fa-search"></i></button>
    </form>


  </div>
      <div class="list-container">
        <div class="left">
          <p>Product Listings</p>
          <h1>Agricultural Products from all over Europe</h1>

          
          <?php
          if(isset($_POST['search'])):
            $searchq = $_POST['search'];
            $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
            $query= mysqli_query($con, "SELECT * FROM products WHERE product_name LIKE '%$searchq%' OR product_category LIKE '%$searchq%' OR cultivation_method LIKE '%$searchq%' OR place_of_origin LIKE '%$searchq%' OR country LIKE '%$searchq%' OR area LIKE '%$searchq%'");
            $count = mysqli_num_rows($query);
            if($count ==0){
              $out = "No results!";
            }
            if($count>0):
              while($product = mysqli_fetch_array($query)): ?>
                <div class="product">
                  <div class="product-img">
                    <div class="pic-ctn">
                      <img
                        src='../images/media/<?php echo $product["image1"];?>'
                        alt="IMAGE-NOT-FOUND"
                        class="pic"
                        width="200"
                        height="300"
                      />
                      <img
                        src='../images/media/<?php echo $product["image2"];?>'
                        alt="IMAGE-NOT-FOUND"
                        class="pic"
                        width="200"
                        height="300"
                      />
                      <img
                        src='../images/media/<?php echo $product["image3"];?>'
                        alt="IMAGE-NOT-FOUND"
                        class="pic"
                        width="200"
                        height="300"
                      />
                    </div>
                  </div>

                  <div class="product-info">
                    <p>
                      <?= $product['product_name'];?>,
                      <?= $product['place_of_origin'];?>/
                      <?= $product['country'];?>
                    </p>
                    <h3>
                      Fresh
                      <?= $product['product_name'];?>
                      for Sale in
                      <?= $product['place_of_origin'];?>/<?= $product['state'];?>/<?= $product['area'];?>
                    </h3>
                    <p>
                      <?= $product['product_category'];?>/ cultivation:
                      <?= $product['cultivation_method'];?>/ Anual production:
                      <?= $product['annual_production'];?>
                      tons
                    </p>
                    <h5>
                      Contact info:
                      <?= $product['contact_info'];?>
                    </h5>

                    <div class="product-price">
                      <p>
                        <?= $product['package_type'];?>, minimum order:
                        <?= $product['minimum_order'];?>
                        kg
                      </p>
                      <h4><?= $product['price'];?>€<span>/ kg</span></h4>
                    </div>

                    <div class="Description">
                      <textarea maxlength="255" rows="10" readonly>
                      <?= $product['description'];?></textarea
                      >
                    </div>
                  </div>
                </div>

          <?php  endwhile; endif; endif;
              if(!isset($_POST['search'])):
          ?>
            <?php 
              while($product = mysqli_fetch_assoc($result)):

            ?>

            <div class="product">
              <div class="product-img">
                <div class="pic-ctn">
                  <img
                    src='../images/media/<?php echo $product["image1"];?>'
                    alt="IMAGE-NOT-FOUND"
                    class="pic"
                    width="200"
                    height="300"
                  />
                  <img
                    src='../images/media/<?php echo $product["image2"];?>'
                    alt="IMAGE-NOT-FOUND"
                    class="pic"
                    width="200"
                    height="300"
                  />
                  <img
                    src='../images/media/<?php echo $product["image3"];?>'
                    alt="IMAGE-NOT-FOUND"
                    class="pic"
                    width="200"
                    height="300"
                  />
                </div>
              </div>

              <div class="product-info">
                <p>
                  <?= $product['product_name'];?>,
                  <?= $product['place_of_origin'];?>/
                  <?= $product['country'];?>
                </p>
                <h3>
                  Fresh
                  <?= $product['product_name'];?>
                  for Sale in
                  <?= $product['place_of_origin'];?>/<?= $product['state'];?>/<?= $product['area'];?>
                </h3>
                <p>
                  <?= $product['product_category'];?>/ cultivation:
                  <?= $product['cultivation_method'];?>/ Anual production:
                  <?= $product['annual_production'];?>
                  tons
                </p>
                <h5>
                  Contact info:
                  <?= $product['contact_info'];?>
                </h5>

                <div class="product-price">
                  <p>
                    <?= $product['package_type'];?>, minimum order:
                    <?= $product['minimum_order'];?>
                    kg
                  </p>
                  <h4><?= $product['price'];?>€<span>/ kg</span></h4>
                </div>

                <div class="Description">
                  <textarea maxlength="255" rows="10" readonly>
                  <?= $product['description'];?></textarea
                  >
                </div>
              </div>
            </div>

          <?php endwhile; endif;?>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Find Us On:</p>
      <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
      <a href="https://www.twitter.com/" class="fa fa-twitter"></a>
      <a href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
      <p>@digitagrize.it.eu 2022<br /></p>
    </div>

  </body>
</html>
