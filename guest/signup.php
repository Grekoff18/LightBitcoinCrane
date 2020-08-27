<?php
top("Signup");
require_once("index.php");
require_once("config.php");

$login = $_POST['login'];
$email = $_POST['email'];
$password = filter_var(trim($_POST['password']));
$password_confirm = filter_var(trim($_POST['password_confirm']));
$wallet = filter_var(trim($_POST['wallet']));

//login validate function
function loginValid($log) {
	if (!preg_match('/^[A-z0-9]{3,15}$/',$log)) {
		header("Location: register");
		ob_get_flush();
		$_SESSION['login_validate'] = "Логин может содержать только латинские буквы и цыфры без пробелов, длинной от 3 до 15 символов";
	}
}
loginValid($login);
// Password compare function
function passwordCompare($pass, $confirm_pass) {
	if (strlen($pass) > 10) {
		if ($pass === $confirm_pass) {
			header("Location: login");
		} else {
			$_SESSION['pass_validate'] = "Пароли не совпадают";
			header("Location: register");
		}
	} else {
		$_SESSION['pass_length_validate'] = "Пароль должен содержать более 10 символов";
		header("Location: register");
	}
}
passwordCompare($password, $password_confirm);

// Wallet validate function
function walletValidate($wall) {
	if (substr($wall, 0,1) !== 'P' || !is_numeric(substr($wall, 1))) {
		$_SESSION['wallet_validate'] = "Кошелёк указан неверно";
		header("Location: register");
	}
}
walletValidate($wallet);

// Check for captcha function
function getCaptcha() {
	$captcha = $_POST['g-recaptcha-response'];
	
	if ($captcha) {
	 	$url = 	'https://www.google.com/recaptcha/api/siteverify?secret='.RECAPTCHA_SITE_SERCRET_KEY.
	 			'&response='.$captcha.
	 			'&remoteip='.$_SERVER['REMOTE_ADDR'];

	 	$data = file_get_contents($url);
	 	$decodeData = json_decode($data);

		if ($decodeData->success == true) {
			// some code
		} else if ($decodeData->success == false) {
			$_SESSION['captcha_validate'] = "Каптча не пройдена((";
			header("Location: register");
		}
	 } else {
		$_SESSION['captcha_validate'] = "Вы не активировали каптчу";
		header("Location: register");
	} 
}
getCaptcha();

$password = md5($password);
$dbConnect->query("INSERT INTO `users` (`login`, `email`, `password`, `payer_wallet`) VALUES('$login', '$email', '$password', '$wallet')");
$dbConnect->close();
bottom();
?>

