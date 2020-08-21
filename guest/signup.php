<?php top("Signup"); ?>
<?php
session_start();
require_once("index.php");
require_once("config.php");

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$wallet = $_POST['wallet'];
$password_confirm = $_POST['password_confirm'];


if ($password === $password_confirm) {
	$path = 'uploads\\' . time() . $_FILES['avatar']['name'];
	if (!move_uploaded_file($_FILES['avatar']['tmp_name'], dirname(__DIR__) . '\\' . $path)) {
		$_SESSION['message'] = "Возникла ошибка при загрузке изображения";
		header("Location: register");
	}
	$password = md5($password);
	mysqli_query($dbConnect,
    "INSERT INTO `users` 
    (`id`, `full_name`, `login`, `email`, `password`, `avatar`, `payer_wallet`)
    VALUES
    (NULL, '$full_name', '$login', '$email', '$password', '$path', '$wallet')");
	header("Location: login");
} else {
	$_SESSION['message'] = "Пароли не совпадают";
	header("Location: register");
	ob_end_flush();
}

?>
<?php bottom(); ?>
