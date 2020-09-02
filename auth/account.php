<?php 
	top("Account");
	require_once("config.php");
	require_once("index.php");

	global $dbConnect;
	$bonus = $_POST['bonus'];
	if (isset($bonus)) {
		date_default_timezone_set('Europe/Kiev');
		$today = date("H:i:s"); 
		$dataaa = new DateTime($today);
		print_r($dataaa);
		getRecaptchaSuccess($recaptcha, $link, 'profile');
		$time = time();
		$timeData = $dbConnect->query("SELECT `time` FROM  `bonus_limit` WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
		$limit = strtotime('+10 seconds');
		if ($timeData->num_rows == false) {
			$dbConnect->query("INSERT INTO `bonus_limit` VALUES ('$_SERVER[REMOTE_ADDR]', $limit)");
		} else {
			$row = $timeData->fetch_assoc();
			if ($time < $row['time']) {
				$_SESSION['hahaha'] = "Pozhaluista podozhdite" . ($row['time'] - $time) . "sec";
			}
			$dbConnect->query("UPDATE `bonus_limit` SET `time` = $limit WHERE `ip` = `$_SERVER[REMOTE_ADDR]'");
		}
		$row = $timeData->fetch_assoc();
	}
	//header("Location: profile");


	bottom();
?>
