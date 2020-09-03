<?php 
	top('Profile');

	require_once("config.php");
	require_once("index.php");

	$balance = getUserInfo("balance");
	$limit = strtotime("+10 seconds");

?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<p>Ваш баланс - <?=currencyFormatter($balance, "руб.");?></p>
<form action="account" method="post">
	<label>Получи бонус до 1 рубля</label>
	<input type="hidden" name="bonus">
	<input type="hidden" name="limit" value="<?=$limit?>">
	<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
	<button type="submit">Получить</button>
</form>
<p>Vash bonus - <?=$_SESSION['bonus'];?></p>
<p>Ваша реферальная ссылка - <?=MAIN_URL.getUserInfo("id");?></p>

<form action="home" method="post">
	<input type="hidden" name="exit">
	<button type="submit">Выйти из аккаунта</button>
</form>
<a href="news">Перейти на главную</a>
<?php 
	echo $_SESSION['recaptcha_answer']
?>
<p> <?php echo $_SESSION['wait']; ?> </p>

	<!-- Referral table -->
	<div class="referal_box">

		<div class="referal_box_title">
			Список рефералов
		</div>

		<table class="referal_table">
			<tr>
				<th>№</th>
				<th>Login</th>
				<th>Balance</th>
			</tr>

			<?php 
				$userID = getUserInfo("id");
				$res = $dbConnect->query("SELECT `login`, `balance` FROM `users` WHERE `referal` = '$userID' ORDER BY `id` DESC LIMIT 10");
				if (mysqli_num_rows($res)) {
					while ($ref = $res->fetch_assoc()) {
						$count++;
						$refera_login_array = [];
						$refera_balance_array = [];
						$refera_login_array = $ref['login'];
						$refera_balance_array = $ref['balance'];
						echo "<tr>
								<td>".$count."</td>
								<td>".$refera_login_array."</td>
								<td>".currencyFormatter($refera_balance_array, 'rub.')."</td>
						  	</tr>";
					}
				}
			?>

		</table>
	</div>
<?php
	bottom(); 
?>


