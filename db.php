<?php 
session_start();

$path = explode("/", $_SERVER['PHP_SELF']);
$get_path = end($path);
if ($get_path != 'login.php' && $get_path != 'register.php') {
    if(empty($_SESSION['admin'])){
        header('location:login.php');
    }
}
$con = mysqli_connect('localhost', 'root', '', 'practical') or die("Connection Failed");

?>