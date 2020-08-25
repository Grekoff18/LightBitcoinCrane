<?php 
top("Регистрация");
require_once("config.php");
?>

<h1>Vxod</h1>
<p><input type="text" id="wallet" name="wallet" placeholder="Введите номер своего кошелька"></p>
<p><input type="text" id="login" name="login" placeholder="Введите свой логин"></p>
<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
<p><button onclick="send_post('account', 'register', 'wallet.login')">Register</button></p>

<script type="text/javascript">
	function send_post(url, name, data) {
	var form = '';
	$.each(data.split('.'), function(k, v) {
		form += '&' + v + '=' + $('#' + v).val();
	});

	$.ajax({
		type: 'POST',
		url: '/' + url,
		data: name + '_f=1' + form,
		cache: false,
		success: function(result) {
			obj = jQuery.parseJSON(result);
			if (obj.go)
				go(obj.go);
			else
				alert(obj.message);
		}
	});
}
function go(url) {
	window.location.href = '/' + url;
}
</script>

<?php bottom(); ?>
