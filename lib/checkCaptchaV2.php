<?php
function checkGoogleCaptchaV2($endpoint, array $params)
{
	if (empty($params['g-recaptcha'])) {
		return FALSE;
	}

	$opts = [
		'http' => [
			'method' => 'POST',
			'header' => 'Content-type: application/x-www-form-urlencoded',
			// POST data
			'content' => http_build_query($params),
		],
	];

	$context = stream_context_create($opts);

	$check = json_decode(file_get_contents($endpoint, FALSE, $context));

	if ($check->success === TRUE) {
		return TRUE;
	}

	return FALSE;
}