<?php
    ob_start();
    session_start();

    // If there is just a slash in the url line, then we redirect to the main page
    if ($_SERVER['REQUEST_URI'] == '/') {
        $page = 'home';
    // If not, cut the line and get the first word after the slash
    } else {
        $page = substr($_SERVER['REQUEST_URI'], 1);
    }

    // This file contains important and classified data.
    require_once("config.php");

    // The usual distribution of site pages
    if (file_exists("all/$page.php")) {
        require_once("all/$page.php");
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
          session_destroy();
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

    // Function for generating random numbers for issuing bonuses
    function randomNumber($min = 0, $max = 1) {
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), 2);
    }

    // Captcha validate function
    function getRecaptchaSuccess($captcha_var_name, $url_name, $location) {
        $captcha_var_name = $_POST['g-recaptcha-response'];
        if ($captcha_var_name) {
            $url_name = 'https://www.google.com/recaptcha/api/siteverify?secret='.RECAPTCHA_SITE_SERCRET_KEY.
                    '&response='.$captcha_var_name.
                    '&remoteip='.$_SERVER['REMOTE_ADDR'];
            $answer = file_get_contents($url_name);
            $decodeAnswer = json_decode($answer);
            if ($decodeAnswer->success == true) {
                $_SESSION['recaptcha_answer'] = "Captcha proidena";
            } else if ($decodeAnswer->success == false) {
                $_SESSION['recaptcha_answer'] = "Captcha ne proidena";
                header("Location: $location");
                exit();
            }
        } else {
            $_SESSION['recaptcha_answer'] = "Vu actevirovali captchu?";
            header("Location: $location");
            exit();
        } 
    }

?>
