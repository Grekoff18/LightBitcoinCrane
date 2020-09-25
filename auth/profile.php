<?php 
	top('Profile');
	require_once("config.php");
	require_once("index.php");
	global $dbConnect, $count;
	$limit = strtotime("+10 seconds");
?>

<script src="https://www.google.com/recaptcha/api.js"></script>
<p>Ваш баланс - <?=currencyFormatter(getUserInfo("balance"), "руб.");?></p>

<form action="account" method="post">
	<label>Получи бонус до 1 рубля</label>
	<input type="hidden" name="bonus" value="<?=$limit?>">
	<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
	<button class="msg" type="submit">Получить</button>
</form>

<p>Vash bonus - <?=$_SESSION['bonus'];?></p>
<p>Ваша реферальная ссылка - <?=MAIN_URL.getUserInfo("id");?></p>
<h1><?=$_SESSION['delay']?></h1>

<form action="home" method="post">
	<input type="hidden" name="exit">
	<button type="submit">Выйти из аккаунта</button>
</form>

<a href="news">Перейти на главную</a>

<?php 
	echo $_SESSION['recaptcha_answer']
?>
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
                $res = mysqli_query($dbConnect, "SELECT `login`, `balance` FROM `users` WHERE `referal` = '$userID' ORDER BY `id` DESC LIMIT 10");
				if (mysqli_num_rows($res)) {
					while ($ref = mysqli_fetch_assoc($res)) {
						$count++;
						$refera_login_array = [];
						$refera_balance_array = [];
						$refera_login_array = $ref['login'];
						$refera_balance_array = $ref['balance'];
						?>
                        <tr>
                            <td><?=$count?></td>
                            <td><?=$refera_login_array?></td>
                            <td><?=currencyFormatter($refera_balance_array, 'rub.')?></td>
                        </tr>
                        <?php
					}
				}
			?>

		</table>
	</div>
<?php
	bottom(); 
?>


