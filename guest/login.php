<?php top("Авторизация"); ?>

<div class="form_wrapper">
	<form class="auth_form" action='' method="">
		<label>Логин</label>
		<input type="text" name="login" placeholder="Введите ваш логин">
		<label>Пароль</label>
		<input type="password" name="password" placeholder="Введите ваш пароль">
		<button>Войти</button>
		<p>У вас нет аккаунта? - <a href="register">Зарегистрируйтесь!</a></p>
	</form>
</div>

<?php bottom(); ?>
