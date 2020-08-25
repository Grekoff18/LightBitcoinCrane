<?php 
top("Регистрация");
require_once("config.php");
?>

<div class="form_wrapper">
	<form class="register_form" action="register" method="post">
		<label>Логин</label>
			<input type="text" id="login" name="login" placeholder="Придумайте себе логин">
		<label>Пароль</label>
			<input type="password" id="password" name="password" placeholder="Придумайте себе пароль">
		<label>Почта</label>
			<input type="email" id="email" name="email" placeholder="Введите свою почту">
		<label>Кошелёк</label>
			<input type="text" id="wallet" name="wallet" placeholder="Введите номер своего кошелька">
		<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
		<button onclick="send_post('account', 'register', 'wallet.login')">Зарегистрироваться</button>
	</form>
</div>

<?php bottom(); ?>
