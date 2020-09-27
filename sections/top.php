<?php 
	ob_start();
	session_start();
	require_once "index.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="../style.css">

</head>
<body>
	<div class="wrapper">
		<div class="slide">
			<div><img src='../img/slide.jpg'></div>
			<div><img src='../img/slide.jpg'></div>
			<div><img src='../img/slide.jpg'></div>
		</div>
		<div class="content">


