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
        
            $property_name = $_POST["property_name"];  
            $surface_area = $_POST["surface_area"];
            $facing_road = $_POST["facing_road"];
            $altitude = $_POST["altitude"];
            $average_sunlight = $_POST["average_sunlight"];
            $average_rainfall = $_POST["average_rainfall"];
            $country = $_POST["country"];
            $state = $_POST["state"];
            $area = $_POST["area"];
            $recom_cult = $_POST["recom_cult"];
            $drill = $_POST["drill"];
            $description = $_POST["description"];

            $sql = "INSERT INTO `properties` (`UserID`, `property_name`, `surface_area`, `facing_road`, `altitude`, `average_sunlight`, `average_rainfall`, `country`, `state`, `area`, `recom_cult`, `drill`, `description`,`contact_info`, `image1`,`image2`,`image3`) 
            VALUES ('$userid', '$property_name', '$surface_area', '$facing_road','$altitude', '$average_sunlight', '$average_rainfall', '$country', '$state', '$area', '$recom_cult', '$drill', '$description', '$contact_info', '$image1','$image2','$image3');";

            $query_run  = mysqli_query($con,$sql);      

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
    <link rel="stylesheet" href="addproperty.css" type="text/css">
    <link rel="stylesheet" href="breadcrumb.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>
   
    <h2>Add Property</h2>
    <form action="addproperty.php" method="post" enctype="multipart/form-data">

        <div class="container">
        <ul class="breadcrumb size">
        <li><a href="index.php">Home</a></li>
        <li>Add Property</li>
        </ul>

            <div class="row">
                <div class="col-50">

                    <h3>Property Characteristics</h3>
                    <label for="propname"><i class="fas fa-tags	"></i> Property Name</label>
                    <input type="text" id="pname" name="property_name" placeholder="No. 173" required>

                    <label for="sarea"><i class="fa fa-area-chart"></i> Surface Area (sq. km.)</label>
                    <input type="number" id="sarea" name="surface_area" step="0.01" placeholder="5.5" required>

                    <label for="froad"><i class="fa fa-road"></i> Facing Road</label>
                    <select name="facing_road" id="facing_road" required>
                        <option value="rural">Rural</option>
                        <option value="provincial">Provincial</option>
                        <option value="national">National</option>
                    </select>

                    <label for="altitude"><i class="fas fa-sort-amount-up-alt"></i> Altitude (m.)</label>
                    <input type="number" id="altitude" name="altitude" placeholder="550" required>

                    <label for="asunlight"><i class="fa fa-sun-o"></i> Average Sunlight (Days/Year)</label>
                    <input type="number" id="asunlight" name="average_sunlight" placeholder="220" required>

                    <label for="arainfall"><i class="fa fa-umbrella"></i> Average Rainfall (mm)</label>
                    <input type="number" id="arainfall" name="average_rainfall" placeholder="45" required>

                    <h3>Media </h3>
                    <p>Select up to 3 images showing your property.</p>
                    <label for="img"><i class="fa fa-photo"></i> Select images:</label>
                    <input type="file" id="image1" name="image1" accept=".jpg, .jpeg, .png"><br>
                    <input type="file" id="image2" name="image2" accept=".jpg, .jpeg, .png"><br>
                    <input type="file" id="image3" name="image3" accept=".jpg, .jpeg, .png">
                                         
                </div>

                <div class="col-50">

                    <h3>Location</h3>
                    <label for="country"><i class="fa fa-flag"></i> Country</label>
                    <input type="text" id="cname" name="country" placeholder="Greece" required>

                    <label for="state"><i class="fa fa-map-pin"></i> State/Province/County</label>
                    <input type="text" id="state" name="state" placeholder="Florina" required>

                    <label for="area"><i class="fa fa-map-marker"></i> Area/Municipality</label>
                    <input type="text" id="area" name="area" placeholder="Amindeo" required>

                    <h3>Extra Information</h3>
                    <label for="rcult"><i class="fa fa-leaf"></i> Recommended Cultivation</label>
                    <input type="text" id="rcult" name="recom_cult" placeholder="Grapes">

                    <label for="water"><i class="fa fa-tint"></i> Water Drilling</label>
                    <div class="row">
                        <div class="col-25">
                            <input type="radio" name="drill" id="drill_yes" value="Yes">
                            <label for="drill_yes">Yes</label>
                        </div>
                        <div class="col-25">
                            <input type="radio" name="drill" id="drill_no" value="No" checked='checked'>
                            <label for="drill_no">No</label>
                        </div>
                        <div class="col-25"></div>
                        <div class="col-25"></div>
                    </div>

                    <h3>Description</h3>
                    <label for="description"><i class="fa fa-info"></i><i class="fa fa-info"></i> Give more information about your property in the following box.</label>
                    <textarea maxlength="255" rows="4" style="width: 100%;" name="description" placeholder="Enter description here..."></textarea>
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
                <input type="checkbox" id="agree" name="terms-agree" required> I agree to the website's terms and conditions.</label>
            <br>
            <button class="btn" name="submit" type="submit" id="publish">Publish</button>
        
        </div>
    </form>

</body>

</html>