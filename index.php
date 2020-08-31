<?php
ob_start();
session_start();
if ($_SERVER['REQUEST_URI'] == '/') {
    $page = 'home';
} else {
    $page = substr($_SERVER['REQUEST_URI'], 1);
}

require_once("config.php");

// The usual distribution of site pages
if (file_exists("all/$page.php")) {
    require_once("all/$page.php");
} else if ($_SESSION['id'] == 1 and file_exists("auth/$page.php")) {
    require_once("auth/$page.php");
} else if ($_SESSION['id'] !== 1 and file_exists("guest/$page.php")) {
    require_once("guest/$page.php");
} else if (is_numeric($page)) {
    $_SESSION['referal'] = $page;
    header("Location: register");
} else {
    exit('Page not found 404');
}
// Connecting to database
if (!$dbConnect) {
    die('Error connect to DataBase');
} 
// This is not a header because the header is already taken by the standard php function 
function top($title) {
    require_once("sections/top.php");
};
//Then I decided to continue to call parts of the site by common names.
function bottom() {
    require_once("sections/bottom.php");
};
// function exit from profile
function exitFromProfile() {
	if (isset($_POST['exit'])) {
		setcookie('usr', $confirm_user_information['login'], time() - 3600, "/");
		$_SESSION['id'] = 0;
	}	
}
// A function that translates our balance into the desired form
function currencyFormatter($num, $currency = "$") {
	return number_format((float) $num, 2, ".", "") . ' ' . $currency;
}
// This is the function that receives the necessary information about the user. 
function getUserInfo($info) {
    global $arr_usr_info;
    return $arr_usr_info[$info];
}
?>
