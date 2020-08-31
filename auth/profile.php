<?php 
top('Profile');

require_once("config.php");
require_once("index.php");

$balance = getUserInfo("balance");
?>

<p>Ваш баланс - <?=currencyFormatter($balance, "руб.");?></p>
<p>Ваша реферальная ссылка - <?=MAIN_URL.getUserInfo("id");?></p>

<form action="home" method="post">
	<input type="hidden" name="exit">
	<button type="submit">Выйти из аккаунта</button>
</form>
<a class="news-butn" href="news">Перейти на главную</a>
<table class="referal_table">
	<tr>
		<th>Login</th>
		<th>Balance</th>
	</tr>
	<tr>
		<td>log</td>
		<td>bal</td>
	</tr>
</table>
<?php
bottom(); 
?>


