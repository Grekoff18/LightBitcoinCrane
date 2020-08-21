<?php 
session_start();
require_once("config.php");
$login = $_POST['login'];
$password = md5($_POST['password']);
$user_verification = mysqli_query($dbConnect, "SELECT * FROM `users` WHERE 'login' = '$login' AND 'password' = '$password'");
echo $password;
echo mysqli_num_rows($user_verification);

 ?>
