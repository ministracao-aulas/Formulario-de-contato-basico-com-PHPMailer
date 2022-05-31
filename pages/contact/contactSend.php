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

sendEmail(
    $fromName,
    $fromEmail,
    $subject,
    $body,
    $attachmentPath,
    $attachmentName
);

clearOld();

setFlash('success', 'Your message has been sent.');

redirect('/contact-success');
