<?php
//Updates the recent activity column -> The user's visit time
//On the session's user
$_SESSION["user"]["recent_activity"] = date("d/m/Y H:i");

//On the database

include("connect.php");

$sql = "UPDATE users SET recent_activity=".$_SESSION["user"]["recent_activity"]." WHERE userID=".$_SESSION["user"]["userID"].";"

?>