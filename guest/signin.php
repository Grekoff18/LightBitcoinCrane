<?php 
	top("Привет");
	session_start();
	require_once("config.php");

	$login = $_POST['login'];
	$password = filter_var(trim($_POST['password']));
	$password = md5($password);

	$result = $dbConnect->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
	$array_user_information = $result->fetch_assoc();
	if(count($array_user_information) == 0) {
		$_SESSION['unknwon_user'] = "Такой пользователь не найден)) <br>
									 Возможно вы ввели не правельный логин или пароль.";
		header("Location: login");
	}
	setcookie('user', $array_user_information->login, time() + 3600 *24, '/');
	$dbConnect->close();
	echo $_COOKIE['user'];

	bottom();
 ?>
