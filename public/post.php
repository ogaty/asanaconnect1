<?php
require_once 'params.php';

session_start();
$token = $_SESSION['token'];

if (is_null($token)) {
	Header('Location: index.php');
}

$postUrl = $ASANA_ENDPOINT_URL . '/tasks';

$headers = [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer ' . $token,
    ];

$data = [
    'data' => [
        'projects' => '1200940239792522',
    	'name' => 'test task',
    ],
];


        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $postUrl,
          CURLOPT_SSL_VERIFYPEER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
    	$result = json_decode($response, true);
        curl_close($curl);

        var_dump($result);
?>
<html>
    <body>
        タスクを追加しました。
    </body>
</html>
