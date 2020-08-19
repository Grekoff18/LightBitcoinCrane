<?php top("Registration"); ?>
<script src="https://www.google.com/recaptcha/api.js"></script>


<h1>Registration</h1>
<p><input type="text" id="wallet" placeholder="Type your wallet"></p>
<p><input type="text" id="name" placeholder="Type your nicname"></p>
<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
<button onclick="send_post('account', 'register', 'wallet.name')">Create new account</button>

<?php bottom(); ?>
