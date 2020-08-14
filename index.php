<?php 
if ($_SERVER['REQUEST_URI'] == '/') {
    $page = 'home';
} else {
    $page = substr($_SERVER['REQUEST_URI'], 1);
}

session_start();

if (file_exists('all/$page.php')) {
    include 'all/$page.php';
} else if ($_SESSION['id'] == 1 and file_exists('auth/$page.php')) {
    include 'auth/$page.php';
} else if ($_SESSION['id'] != 1 and file_exists('guest/$page.php')) {
    include 'guest/$page.php';
} else {
    exit('Page not found 404');
}

function db() {
    global $db;
    $db = mysql_connect();
    if ($db) {
        exit('Error database connection((');
    }
}
?>
