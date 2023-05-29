<?php 

include("db.php");

session_destroy();

header("location:login.php");

?>