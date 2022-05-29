<?php 
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
    <div class="navbar">
    <img class="logoIMG" src="images/icons/favicon.png" alt="logo">

    <a class="logo" href="#"> Digitagrize it</a>
    <a class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links">
        <ul class="nav">
            <li><a href="index.php#home">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#faq">FAQ</a></li>
            <li><a href="index.php#contact">Contact Us</a></li>
            <li><div class="dropdown">
                <a class="dropbtn">Hello,<?php echo $_SESSION['user']['username']; ?>
                    <i class="fa fa-caret-down"></i>
                </a>
                <div class="dropdown-content"> 
                    <?php
                        if($_SESSION["user"]["is_admin"] == 1)
                        { ?>
                            <a href="AdminPanel.php">Admin Panel</a>
                        <?php } else
                         { ?>
                            <a href="UserProfile.php">Profile</a>
                            <a href="addlisting.html">Add Listings</a>
                        <?php } ?>
                    
                    <a href="logout.php">Log Out</a>
                </div>
            </div> 
            </li>
        </ul>
    </div>
</div>
<?php } else { ?>
    <div class="navbar">
    <img class="logoIMG" src="images/icons/favicon.png" alt="logo">

        <a class="logo" href="#"> Digitagrize it</a>
        <a class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
            <div class="navbar-links">
                <ul class="nav">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#faq">FAQ</a></li>
                    <li><a href="index.php#contact">Contact Us</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
<?php } ?>