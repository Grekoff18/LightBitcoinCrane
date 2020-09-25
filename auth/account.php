<?php 
	top("Account");
	require_once("config.php");
	require_once("index.php");
    global $dbConnect;
	$bonus = $_POST['bonus'];
	$_SESSION['identificator'] = getUserInfo("id");
	
	if (isset($bonus)) {
		$time = time();
		$data_time = mysqli_query($dbConnect, "SELECT `time` FROM `bonus_limit` WHERE `ip` = '$_SERVER[REMOTE_ADDR]'")
		if (!mysqli_num_rows($data_time)) {
			mysqli_query($dbConnect, "INSERT INTO `bonus_limit` VALUES ('$_SERVER[REMOTE_ADDR]', $bonus)");
		} else {
			$time_info = mysqli_fetch_assoc($data_time);
			if ($time < $time_info['time']) {
				$_SESSION['delay'] = "Следующий бонус будет активирован через " . ($time_info['time'] - $time) . "секунд";
				header("Location: profile");
				exit();
			} else if ($time == $time_info['time'] || $time > $time_info['time']) {
				$_SESSION['delay'] = "Поздравляем! Вы активировали бонус";
				$_SESSION['bonus'] = randomNumber();
				mysqli_query($dbConnect, "UPDATE `users` SET `balance` = `balance` + $_SESSION[bonus] WHERE `id` = $_SESSION[identificator]");
				mysqli_query($dbConnect, "UPDATE `bonus_limit` SET `time` = $bonus WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
			}
			$userBalance += $_SESSION['bonus'];
			header("Location: profile");
		}
	}
	bottom();
?>
