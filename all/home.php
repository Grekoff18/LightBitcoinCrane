<?php
    top('Главаная страница');
?>
<div class="form_wrapper">
	<form class="auth_form" action="signin" method="post">
		<label>Логин</label>
			<input type="text" name="login" placeholder="Введите ваш логин">
		<label>Пароль</label>
			<input type="password" name="password" placeholder="Введите ваш пароль">
		<button type="submit">Войти</button>
		<p>У вас нет аккаунта? - <a class="register_link" href="register">Зарегистрируйтесь!</a></p>
		<?php 
			if (isset($_SESSION['unknwon_user'])) { ?>
			    <p class="error_message"><?=$_SESSION['unknwon_user'];?></p>
        <?php }
			unset($_SESSION['unknwon_user']);
		?>

	</form>
</div>

<?php bottom(); ?>
