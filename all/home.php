<?php top("Главная страница"); ?>

<?php
require_once "index.php";
require_once "config.php";

if (USER_PASSWORD === USER_CONFIRM_PASSWORD) {
	//some code
} else {
	$_SESSION['message'] = "Пароли не совпадают";
	header("Location: register");
	ob_end_flush();
}

db();
?>

<?php bottom(); ?>
