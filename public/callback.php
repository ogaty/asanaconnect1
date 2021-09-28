<?php

$ASANA_API_ENDPOINT_URL='https://app.asana.com/api/1.0';
$ASANA_LOGIN_ENDPOINT_URL='https://app.asana.com/-/oauth_authorize';
$ASANA_TOKEN_ENDPOINT_URL='https://app.asana.com/-/oauth_token';
$ASANA_CLIENT_ID='1201073560846677';
$ASANA_CLIENT_SECRET='0666ad5a0cd5e624ab96fc79384941c5';
$ASANA_CALLBACK_URL='https://asanaconnect1.ogatism.com/callback.php';
$code = $_GET['code'];

// token

$data = [
	'grant_type' => 'authorization_code',
	'client_id' => $ASANA_CLIENT_ID,
	'client_secret' => $ASANA_CLIENT_SECRET,
	'redirect_uri' => $ASANA_CALLBACK_URL,
	'code' => $code
];

$curl = curl_init();
curl_setopt_array($curl, [
            CURLOPT_URL => $ASANA_TOKEN_ENDPOINT_URL,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
]);
        $response = curl_exec($curl);
        $token = json_decode($response, true);

        curl_close($curl);

	session_start();
	$_SESSION['token'] = $token['access_token'];

	Header('Location: ' . 'home.php');

