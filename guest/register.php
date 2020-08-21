<?php top("Регистрация"); ?>

<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="form_wrapper">
	<form class="auth_form" action="signup" method="post" enctype="multipart/form-data">
		<label>ФИО</label>
			<input type="text" name="full_name" placeholder="Введите свое ФИО">
		<label>Логин</label>
			<input type="text" name="login" placeholder="Введите свой логин">
		<label>Кошелёк</label>
			<input type="text" name="wallet" placeholder="Введите свой номер кошелька">
		<label>Почта</label>
			<input type="email" name="email" placeholder="Введите адрес своей почты">
		<label>Изображение профиля</label>
			<input type="file" name="avatar">
		<label>Пароль</label>
			<input type="password" name="password" placeholder="Введите ваш пароль">
		<label>Подтверждение пароля</label>
			<input type="password" name="password_confirm" placeholder="Подтвердите пароль">
		<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
		<button type="submit">Войти</button>
		<p>У вас уже есть аккаунт? - <a href="login">Авторизируйтесь</a></p>

		<?php 
			if (isset($_SESSION['message'])) {
				echo '<p class="error_message">'. $_SESSION['message'] . `</p>`;
			}
			unset($_SESSION['message']);
		?>

	</form>
</div>

<?php bottom(); ?>
