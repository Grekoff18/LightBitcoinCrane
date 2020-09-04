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
			exit();
		}
	}
	loginValid($login);

	// Password compare function
	function passwordCompare($pass, $confirm_pass) {
		if (strlen($pass) > 10) {
			if ($pass === $confirm_pass) {
				header("Location: home");
			} else {
				$_SESSION['pass_validate'] = "Пароли не совпадают";
				header("Location: register");
			}
		} else {
			$_SESSION['pass_length_validate'] = "Пароль должен содержать более 10 символов";
			header("Location: register");
			exit();
		}
	}
	passwordCompare($password, $password_confirm);

	// Wallet validate function
	function walletValidate($wall) {
		if (substr($wall, 0,1) !== 'P' || !is_numeric(substr($wall, 1))) {
			$_SESSION['wallet_validate'] = "Кошелёк указан неверно";
			header("Location: register");
			exit();
		}
	}
	walletValidate($wallet);

	// Captcha validate function
	getRecaptchaSuccess($captcha, $url, "register");


	if ($_SESSION['referal']) {
		$referal = $_SESSION['referal'];
	} else {
		$referal = 0;
	}

	$password = md5($password);
	$dbConnect->query("INSERT INTO `users` (`referal`, `login`, `email`, `password`, `payer_wallet`, `balance`) VALUES ('$referal', '$login', '$email', '$password', '$wallet', '$userBalance')");
	$dbConnect->close();
	bottom();
?>

