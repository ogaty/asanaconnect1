<?php

require_once 'params.php';

$query = http_build_query([
	'client_id' => $ASANA_CLIENT_ID,
	'redirect_uri' => $ASANA_CALLBACK_URL,
	'response_type' => 'code',
]);

$url = $ASANA_LOGIN_URL . '?' . $query;

?>

<html>
<head>
</head>
<body>
<a href="<?php echo $url; ?>">Asanaでログイン</a>
</body>
</html>

