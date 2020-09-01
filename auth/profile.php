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
	<a href="news">Перейти на главную</a>

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


