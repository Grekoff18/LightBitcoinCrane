<?php
top("Регистрация");
require_once("config.php");
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="form_wrapper">
	<form class="auth_form" action="signup" method="post">
		<label>Логин</label>
			<input type="text" name="login" placeholder="Введите свой логин">
		<label>Почта</label>
			<input type="email" name="email" placeholder="Введите адрес своей почты">
		<label>Пароль</label>
			<input type="password" name="password" placeholder="Введите ваш пароль">
		<label>Подтверждение пароля</label>
			<input type="password" name="password_confirm" placeholder="Подтвердите пароль">
		<label>Кошелёк</label>
			<input type="text" name="wallet" placeholder="Введите свой номер кошелька">
		<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
		<button type="submit">Зарегистрироватся</button>
		<p>У вас уже есть аккаунт? - <a href="home">Авторизируйтесь</a></p>

		<?php  
			if (count($_SESSION) > 0) {
				if (isset($_SESSION['login_validate'])) {
					echo '<p class="error_message">'.$_SESSION['login_validate'].'</p>';
				}
				if (isset($_SESSION['pass_length_validate'])) {
					echo '<p class="error_message">'.$_SESSION['pass_length_validate'].'</p>';
				}
				if (isset($_SESSION['pass_validate'])) {
					echo '<p class="error_message">'.$_SESSION['pass_validate'].'</p>';
				}
				if (isset($_SESSION['wallet_validate'])) {
					echo '<p class="error_message">'.$_SESSION['wallet_validate'].'</p>';
				}
				if (isset($_SESSION['captcha_validate'])) {
					echo '<p class="error_message">'.$_SESSION['captcha_validate'].'</p>';
				}
			}
			unset($_SESSION['login_validate']);
			unset($_SESSION['pass_length_validate']);
			unset($_SESSION['pass_validate']);
			unset($_SESSION['wallet_validate']);
			unset($_SESSION['captcha_validate']);
		?>

	</form>
</div>
	
<?php bottom(); ?>
