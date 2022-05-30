<?php

include 'connect2.php'; 

if(isset($_POST['submit'])) {
    
    session_start();
    $userid =  $_SESSION["user"]["userID"];
    $c1 = $_SESSION["user"]["first_name"];
    $c2 = $_SESSION["user"]["last_name"];
    $c3 = $_SESSION["user"]["phone_num"];
    $c4 = $_SESSION["user"]["email"];
    $contact_info = $c1 . ',' . $c2 . ',' . $c3 . ',' . $c4;

    $image1 = $_FILES["image1"]["name"];
    $image2 = $_FILES["image2"]["name"];
    $image3 = $_FILES["image3"]["name"];

    $target_dir = "../images/media/";
    $target_file1 = $target_dir . basename($_FILES["image1"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["image2"]["name"]);
    $target_file3 = $target_dir . basename($_FILES["image3"]["name"]);
    $uploadOk = 1;

    // Check file size
    if ($_FILES["image1"]["size"] > 5000000 || $_FILES["image2"]["size"] > 5000000 || $_FILES["image3"]["size"] > 5000000) {
        
        echo '<script type="text/javascript"> alert ("Sorry, one of your files is too large. 5MB is the maximum limit.")</script>';
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {

        if (move_uploaded_file($_FILES["image1"]["tmp_name"],$target_file1) && move_uploaded_file($_FILES["image2"]["tmp_name"],$target_file2) && move_uploaded_file($_FILES["image3"]["tmp_name"],$target_file3)){            
        
            $product_name = $_POST["product_name"]; 
            $product_category = $_POST["product_category"]; 
            $cultivation_method = $_POST["cultivation_method"];
            $price = $_POST["price"];
            $annual_production = $_POST["annual_production"];
            $place_of_origin = $_POST["place_of_origin"];
            $country = $_POST["country"];
            $state = $_POST["state"];
            $area = $_POST["area"];
            $minimum_order = $_POST["minimum_order"];
            $package_type = $_POST["package_type"];
            $description = $_POST["description"];

            

            $sql = "INSERT INTO products (UserID, product_name, product_category, cultivation_method, price, annual_production, place_of_origin, country, state, area, minimum_order, package_type, description, contact_info, image1, image2, image3) 
                VALUES ('$userid', '$product_name', '$product_category', '$cultivation_method', '$price', '$annual_production', '$place_of_origin', '$country', '$state', '$area', '$minimum_order', '$package_type','$description','$contact_info', '$image1','$image2','$image3');";

            $query_run= mysqli_query($con,$sql);
            
            if($query_run){
                echo '<script type="text/javascript"> alert ("Property uploaded")</script>';
            }
            else{
                echo '<script type="text/javascript"> alert ("Property not uploaded")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" />
    <link rel="stylesheet" href="master.css" type="text/css">
    <link rel="stylesheet" href="gradient.css" type="text/css">
    <link rel="stylesheet" href="addproduct.css" type="text/css">
    <link rel="stylesheet" href="breadcrumb.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <h2>Add Product</h2>
    <form action="addproduct.php" method="post" enctype="multipart/form-data">
        
        <div class="container">
        <ul class="breadcrumb size">
        <li><a href="index.php">Home</a></li>
        <li>Add Product</li>
        </ul>

        <div class="row">
            <div class="col-50">

                <h3>Product Characteristics</h3><br>
                <label for="prodname"><i class="fas fa-tags	"></i> Product Name</label>
                <input type="text" id="pname" name="product_name" placeholder="Red Apples" required><br>

                <br><label for="prodcategory"><i class="fas fa-pepper-hot"></i> Product Category</label>
                <select name="product_category" id="prod_category" required>
                    <option value="fruit">Fruit</option>
                    <option value="vegetables">Vegetables</option>
                    <option value="herbs">Herbs</option>
                    <option value="spices">Spices</option>
                    <option value="other">Other</option>
                </select><br>

                <br><label for="cmethod"><i class="fas fa-seedling"></i> Cultivation Method</label>
                <select name="cultivation_method" id="prod_method" required>
                    <option value="bio">Biological</option>
                    <option value="conventional">Conventional</option>
                </select><br>

                <br><label for="price"><i class="fas fa-money-bill-wave"></i> Price (€/Kg)</label>
                <input type="number" id="price" name="price" placeholder="2.5" step="0.01" required><br>

                <br><label for="aproduction"><i class="fas fa-dolly-flatbed"></i> Annual Production (Tons)</label>
                <input type="number" id="aproduction" name="annual_production" placeholder="50" step="0.01"
                    required><br>

                <br><label for="origin"><i class="fas fa-map-marked-alt"></i> Place Of Origin</label>
                <input type="text" id="origin" name="place_of_origin" placeholder="Pilio"><br>

                <h3>Media </h3>
                <p>Select up to 3 images showing your product.</p>
                <label for="img"><i class="fa fa-photo"></i> Select images:</label>
                <input type="file" id="image1" name="image1" accept=".jpg, .jpeg, .png"><br>
                <input type="file" id="image2" name="image2" accept=".jpg, .jpeg, .png"><br>
                <input type="file" id="image3" name="image3" accept=".jpg, .jpeg, .png">
                                         
            </div>

            <div class="col-50">

                <h3>Location</h3><br>
                <label for="country"><i class="fa fa-flag"></i> Country</label>
                <input type="text" id="cname" name="country" placeholder="Greece" required><br>

                <br><label for="state"><i class="fa fa-map-pin"></i> State/Province/County</label>
                <input type="text" id="state" name="state" placeholder="Florina" required><br>

                <br><label for="area"><i class="fa fa-map-marker"></i> Area/Municipality</label>
                <input type="text" id="area" name="area" placeholder="Amindeo" required><br>

                <h3>Extra Information</h3>
                <label for="minorder"><i class="fas fa-pallet"></i> Minimum Order Amount (Kg)</label>
                <input type="number" id="minorder" name="minimum_order" placeholder="20"><br>

                <br><label for="package"><i class="fas fa-shopping-bag"></i> Type Of Package</label>
                <input type="text" id="package" name="package_type" placeholder="5 Kg sacks">


                <h3>Description</h3>
                <label for="description"><i class="fa fa-info"></i><i class="fa fa-info"></i> Give more information
                    about your product in the following box.</label>
                <textarea maxlength="255" rows="4" style="width: 100%;" placeholder="Enter description here..." name="description"
                    required></textarea>
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-50">
                <h3>Publish</h3>
            </div>
        </div>
        <p>Your listing should comply with the website's terms and conditions.</p>
        <br>
        <label>
            <input type="checkbox" id="agree" name="terms-agree" required> I agree to the website's terms and
            conditions.
        </label>
        <br>
        <button class="btn" name="submit" type="submit" id="publish">Publish</button>
        
        </div>
    </form>
</body>

</html>