<?php 
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
    <div class="navbar">
    <a class="logo" href="#"> Digitagrize it</a>
    <a class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links">
        <ul class="nav">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li>
            <div class="dropdown">
                <a class="dropbtn">Hello, user!
                <i class="fa fa-caret-down"></i>
                </a>
                <div class="dropdown-content">
                    <a href="UserProfile.html">Profile</a>
                    <a href="addlisting.html">Add Listings</a>
                    <a href="logout.php">Log Out</a>
                </div>
            </div> 
            </li>
        </ul>
    </div>
</div>
<?php } else { ?>
    <div class="navbar">
        <a class="logo" href="#"> Digitagrize it</a>
        <a class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
            <div class="navbar-links">
                <ul class="nav">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
<?php } ?>
