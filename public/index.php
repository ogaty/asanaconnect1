<?php

$ASANA_API_ENDPOINT_URL='https://app.asana.com/api/1.0';
$ASANA_LOGIN_ENDPOINT_URL='https://app.asana.com/-/oauth_authorize';
$ASANA_TOKEN_ENDPOINT_URL='https://app.asana.com/-/oauth_token';
$ASANA_CLIENT_ID='1201073560846677';
$ASANA_CLIENT_SECRET='0666ad5a0cd5e624ab96fc79384941c5';
$ASANA_CALLBACK_URL='https://asanaconnect1.ogatism.com/callback.php';

$query = http_build_query([
	'client_id' => $ASANA_CLIENT_ID,
	'redirect_uri' => $ASANA_CALLBACK_URL,
	'response_type' => 'code',
]);
?>




<a href="<?php echo $ASANA_LOGIN_ENDPOINT_URL . '?' . $query; ?>">Login</a>


