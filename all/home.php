<?php
    top('Главаная страница');
?>
<div class="form_wrapper">
	<form action="signin" method="post">
		<input type="text" name="login" placeholder="Enter your login here">
		<input type="password" name="password" placeholder="Enter your password here">
		<button type="submit">Login</button>
		<p>Don't have an account?</p>
		<button><a class="register_link" href="register">Register!</a></button>
		<?php 
			if (isset($_SESSION['unknwon_user'])) { ?>
			    <p class="error_message"><?=$_SESSION['unknwon_user'];?></p>
        <?php }
			unset($_SESSION['unknwon_user']);
		?>

	</form>
</div>

<?php bottom(); ?>
