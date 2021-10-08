<?php
require_once 'params.php';

$code = $_GET['code'];
$data = [
	'grant_type' => 'authorization_code',
	'client_id' => $ASANA_CLIENT_ID,
	'client_secret' => $ASANA_CLIENT_SECRET,
	'redirect_uri' => $ASANA_CALLBACK_URL,
	'code' => $code,
];

        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $ASANA_TOEKN_URL,
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
