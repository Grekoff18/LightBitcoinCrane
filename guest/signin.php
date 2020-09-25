<?php 
	top("Привет");
	require_once("config.php");
	global $dbConnect;

	$login = $_POST['login'];
	$password = filter_var(trim($_POST['password']));
	$password = md5($password);

		$result = mysqli_query($dbConnect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		$confirm_user_information = mysqli_fetch_assoc($result);

		if (count($confirm_user_information) == 0) {
			$_SESSION['unknwon_user'] = "Такой пользователь не найден)) <br>
									 	Возможно вы ввели не правельный логин или пароль.";
			header("Location: home");
		} else {
			$_SESSION['id'] = 1;
		}
		
		setcookie('usr', $confirm_user_information['login'], time() + 3600, "/");
		mysqli_close($dbConnect);
		header("Location: profile");
	
	bottom();
 ?>
