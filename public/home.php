<?php
require_once 'params.php';

session_start();
$token = $_SESSION['token'];

if (is_null($token)) {
	Header('Location: index.php');
}


$meUrl = $ASANA_ENDPOINT_URL . '/users/me';
$headers = [
    'Authorization: Bearer ' . $token
];

        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $meUrl,
          CURLOPT_SSL_VERIFYPEER => true,
          CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        $me = json_decode($response, true);
        curl_close($curl);

	$gid = '1126733236472822';

	$ProjectUrl = $ASANA_ENDPOINT_URL . '/projects?archived=false&workspace=' . $gid;
	$headers = [
    'Authorization: Bearer ' . $token
	];

        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $ProjectUrl,
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
	foreach ($me['data']['workspaces'] as $workspace) {
?>
		<tr>
			<td><?php echo $workspace['gid']; ?></td>
			<td><?php echo $workspace['name']; ?></td>
		</tr>
<?php
	}
?>
</table>
<table style="margin-top: 40px;">
<?php 
	foreach ($projects['data'] as $project) {
?>
		<tr>
			<td><?php echo $project['gid']; ?></td>
			<td><?php echo $project['name']; ?></td>
		</tr>
<?php
	}
?>
</table>
</body>
</html>

