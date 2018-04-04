# Google reCaptchaV2 - PHP no extra libraries like cURL

![Screenshot index.html](/assets/img/Google-reCaptchaV2.png?raw=true) 

The idea is to create a PHP script, without use cUrl extension to use reCaptcha's API. In fact may happen that on shared hosting isn't installed by default.
With *stream_context_create()* is possible to generate a POST request through *file_get_contents()* function.

The function that wrap *stream_context_create()* and *file_get_contents()* its pretty straight forward.

```php
// lib/checkCaptchaV2.php
function checkGoogleCaptchaV2($endpoint, array $params)
{
	if (empty($params['g-response'])) {
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
```

### Basic structures for manage forms
1.  Html page, static or generated, where form action point to our [postdata.php](/postdata.php)
2.  PHP script that handle GET/POST data, [postdata.php](/postdata.php), and validates user inputs.

#### Note
Remember that in the [postdata.php](/postdata.php) is implemented only the first step of validation, the captcha. So if you like to use this scaffolding you need to add others validations codes, like check for valid email and so on.

#### License
MIT

#### Disclaimer
I am not a native English speaker, so there are tons of mistakes in the text for sure - I beg your pardon for them. Please, feel free to PR with corrections.