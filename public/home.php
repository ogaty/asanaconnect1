<?php
$ASANA_API_ENDPOINT_URL='https://app.asana.com/api/1.0';
$ASANA_LOGIN_ENDPOINT_URL='https://app.asana.com/-/oauth_authorize';
$ASANA_TOKEN_ENDPOINT_URL='https://app.asana.com/-/oauth_token';
$ASANA_CLIENT_ID='1201073560846677';
$ASANA_CLIENT_SECRET='0666ad5a0cd5e624ab96fc79384941c5';
$ASANA_CALLBACK_URL='https://asanaconnect1.ogatism.com/callback.php';

        session_start();
$access_token = $_SESSION['token'];

// me
$me_url = $ASANA_API_ENDPOINT_URL . '/users/me'; 
$headers = [
    'Accept: application/json',
    'Authorization: Bearer ' . $access_token,
];

$curl = curl_init();
curl_setopt_array($curl, [
            CURLOPT_URL => $me_url,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
]);
        $response = curl_exec($curl);
        $me = json_decode($response, true);
        curl_close($curl);
	$workspaces = $me['data']['workspaces'];

	$gid = '1126733236472822';


	// projects
$me_url = $ASANA_API_ENDPOINT_URL . '/projects?workspace=' . $gid;
$headers = [
    'Accept: application/json',
    'Authorization: Bearer ' . $access_token,
];

$curl = curl_init();
curl_setopt_array($curl, [
            CURLOPT_URL => $me_url,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
]);
        $response = curl_exec($curl);
        $projects = json_decode($response, true);
        curl_close($curl);

?>
<html>
<head></head>
<body>
<table>

<?php
	foreach ($workspaces as $workspace) {
		echo '<tr>';
		echo '<td>' . $workspace['name'] . '</td>';
		echo '<td>' . $workspace['gid'] . '</td>';
		echo '</tr>';
	}
?>
</table>
<h1>Projects</h1>
<table>

<?php
	foreach ($projects['data'] as $project) {
		echo '<tr>';
		echo '<td>' . $project['name'] . '</td>';
		echo '<td>' . $project['gid'] . '</td>';
		echo '</tr>';
	}
?>
</table>
</body>
</html>
