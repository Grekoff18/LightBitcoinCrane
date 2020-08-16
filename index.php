<?php 
if ($_SERVER['REQUEST_URI'] == '/') {
    $page = 'home';
} else {
    $page = substr($_SERVER['REQUEST_URI'], 1);
}

session_start();
require_once("config.php");

// The usual distribution of site pages
if (file_exists("all/$page.php")) {
    require_once("all/$page.php");
} else if ($_SESSION['id'] == 1 and file_exists("auth/$page.php")) {
    require_once("auth/$page.php");
} else if ($_SESSION['id'] != 1 and file_exists("guest/$page.php")) {
    require_once("guest/$page.php");
} else {
    exit('Page not found 404');
}
// Connecting to database
function db() {
    global $db;
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$db) {
        exit('Error database connection');
    }
}
db();
// This is not a header because the header is already taken by the standard php function 
function top($title) {
    require_once("sections/top.php");
};
//Then I decided to continue to call parts of the site by common names.
function bottom() {
    require_once("sections/bottom.php");
};

?>