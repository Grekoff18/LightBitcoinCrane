<?php 
	session_start();
	require_once("config.php");

	$login = $_POST['login'];
	$password = md5($_POST['password']);
	$user_verification = mysqli_query($dbConnect,
	"SELECT * FROM users WHERE login = '".$login."' AND password = '".$password."'");

	if (mysqli_num_rows($user_verification) > 0) {
		$array_user_info = mysqli_fetch_assoc($user_verification);
	} else {
		$_SESSION['message'] = "Не верный логин или пароль";
		header("Location: login");
	}
 ?>
