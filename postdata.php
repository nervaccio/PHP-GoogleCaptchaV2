<?php
if (!isset($_POST) || empty($_POST)) {
    return FALSE;
}
include __DIR__.'/lib/checkCaptchaV2.php';

$params = include __DIR__.'/config/reCaptchaV2.php';

// First step of validation
$check = checkGoogleCaptchaV2($params['endpoint'], [
        // These parameters can not be altered by users.
        'secret'      => $params['secretKey'],
        'remoteip'    => $_SERVER['REMOTE_ADDR'],
        // At moment there is no info how to validate this response.
        'g-recaptcha' => $_POST['g-recaptcha-response'],
    ]);
    
if ($check === FALSE) {
    return FALSE;
}

// Other stuff to-do