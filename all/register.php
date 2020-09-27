<?php
    top("Регистрация");
    require_once("config.php");
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="form_wrapper">
	<form action="signup" method="post">
		<input type="text" name="login" placeholder="Type your login here">
		<input type="email" name="email" placeholder="Type your email here">
		<input type="password" name="password" placeholder="Type your password here">
		<input type="password" name="password_confirm" placeholder="Retype your password">
		<input type="text" name="wallet" placeholder="Type your wallet">
		<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
		<button type="submit">Register</button>
		<p>Already have an account?</p>
		<button><a class="register_link" href="home">Sign in</a></button>

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
				if (isset($_SESSION['recaptcha_answer'])) {
					echo '<p class="error_message">'.$_SESSION['recaptcha_answer'].'</p>';
				}
			}
			unset($_SESSION['login_validate']);
			unset($_SESSION['pass_length_validate']);
			unset($_SESSION['pass_validate']);
			unset($_SESSION['wallet_validate']);
			unset($_SESSION['recaptcha_answer']);
		?>

	</form>
</div>
	
<?php bottom(); ?>
