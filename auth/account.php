<?php 
	top("Account");
	require_once("config.php");
	require_once("index.php");
    global $dbConnect;
	$bonus = $_POST['bonus'];

	if (isset($bonus)) {
		getRecaptchaSuccess($recaptcha, $link, 'profile');
		$time = time();
		$timeData = $dbConnect->query("SELECT `time` FROM `bonus_limit` WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
		$limit = strtotime('+10 seconds');
		if ($timeData->num_rows == false) {
			$dbConnect->query("INSERT INTO `bonus_limit` VALUES ('$_SERVER[REMOTE_ADDR]', $limit)");
		} else {
			$row = $timeData->fetch_assoc();
			if ($time < $row['time']) {
				echo "Zhdi:" . ($row['time'] - $time) . "sec.";
			}
			$dbConnect->query("UPDATE `bonus_limit` SET `time` = $limit WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
		}
		$row = $timeData->fetch_assoc();
	}
	bottom();
?>
