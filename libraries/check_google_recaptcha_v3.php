<?php 
if (!check_google_recaptcha_v3($config['secret_key'],$_POST['recaptcha_response'])) {
	transfer('Gửi mail thất bại', $url_web);
}