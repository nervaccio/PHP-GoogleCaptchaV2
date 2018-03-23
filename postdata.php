<?php
if (!isset($_POST) || empty($_POST)) {
    return FALSE;
}

include __DIR__.'/config/reCaptchaV2.php';
include __DIR__.'/lib/checkCaptchaV2.php';

$check = checkGoogleCaptchaV2($endpoint, [
        // These parameters can not be altered by users.
        'secret'   => $secretKey,
        'remoteip' => $_SERVER['REMOTE_ADDR'],
        // At moment there no info how to validate this response.
        'response' => $_POST['g-recaptcha-response'],
    ]);
    
if ($check === FALSE) {
    echo "FALSE";
    return FALSE;
}

// Other stuff to-do