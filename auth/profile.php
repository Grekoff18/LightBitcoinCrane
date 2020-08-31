<?php 
top('Profile');
require_once("config.php");
require_once("index.php");

$money = $dbConnect->query("SELECT `balance` FROM `users`");
$balance = $money->fetch_assoc();
$balance = $balance['balance'];
?>
<p>Tvoi balance - <?=currencyFormatter($balance, "руб.");?></p>

<form action="home" method="post">
	<input type="hidden" name="exit">
	<button type="submit">Выйти из аккаунта</button>
</form>
<a href="news">Перейти на главную</a>
<?php
bottom(); 
?>


