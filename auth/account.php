<?php 
	top("Account");
	require_once("config.php");
	require_once("index.php");
    global $dbConnect;
	$bonus = $_POST['bonus'];

	if (isset($bonus)) {
		getRecaptchaSuccess($recaptcha, $link, 'profile');
		$time = time();
		$_SESSION['bonus'] = randomNumber();
		if (isset($_POST['limit'])) {
			if ($time < $_POST['limit']) {
				$timerActive = 1;
				$_SESSION['wait'] = "Vam ostalos shdat:" . ($_POST['limit'] - $time) . "sec";
			} else if ($time == $_POST['limit'] || $time > $_POST['limit']) {
				$timerActive = 2;
				$_SESSION['wait'] = "VI activirovali bonus";
			}
			header("Location: profile");
		}
	}
	bottom();
?>
