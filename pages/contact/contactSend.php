<?php

$fromName   = requestPost('name');
putOld('name', $fromName);

$fromEmail  = requestPost('email');
putOld('email', $fromEmail);

$subject    = requestPost('subject');
putOld('subject', $subject);

$message    = requestPost('message');
putOld('message', $message);

$attachmentPath = null;
$attachmentName = null;

if (!$fromName || !$fromEmail || !filter_var($fromEmail, FILTER_VALIDATE_EMAIL) || !$subject || !$message) {
    $error = 'Please fill in all fields.';
    setFlash('error', $error);
    redirect('/contact');
    die;
}

$body = <<<"HTML"
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <h3>From: {$fromName}</h3>
    <h3>Email: {$fromEmail}</h3>
    <h3>Subject: {$subject}</h3>

    <h4>Message:</h4>
    <p>{$message}</p>
</body>
</html>
HTML;

$logEmail = !!(CONFIG['email']['log']['enabled'] ?? false);

if ($logEmail) {
    $logBody = trim(strip_tags($message, '<br>'));
    $logBody = str_replace('<br>', "\n", $logBody);

    saveLog(
        [
            'Name'      => $fromName,
            'Email'     => $fromEmail,
            'subject'   => $subject,
            'content'   => $logBody,
        ],
        'contact-form'
    );
}

try {
    sendEmail(
        $fromName,
        $fromEmail,
        $subject,
        $body,
        $attachmentPath,
        $attachmentName
    );
} catch (\Throwable $th) {
    saveLog("\n" . __FILE__ . ':' . __LINE__ . "\n" . $th->getMessage(), 'error');

    if (DEBUG) {
        throw $th;
    }

    die('An error occurred. Please try again later.');
}

clearOld();

setFlash('success', 'Your message has been sent.');

redirect('/contact-success');
