<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailClient(?bool $debug = null): ?PHPMailer
{
    //Create an instance; passing `true` enables exceptions
    $mail  = new PHPMailer($debug);

    try {
        //Server settings
        if ($debug) {
            $mail->SMTPDebug = (int) (CONFIG['email']['debug']['level'] ?? SMTP::DEBUG_SERVER);
        }

        $mail->isHTML(true);
        $mail->isSMTP();
        $mail->Host       = CONFIG['email']['Host']         ?? null;
        $mail->SMTPAuth   = CONFIG['email']['SMTPAuth']     ?? null;
        $mail->Username   = CONFIG['email']['Username']     ?? null;
        $mail->Password   = CONFIG['email']['Password']     ?? null;
        $mail->SMTPSecure = CONFIG['email']['SMTPSecure']   ?? null;
        $mail->Port       = CONFIG['email']['Port']         ?? null;

        //Recipients
        $addReplyTo = CONFIG['email']['addReplyTo']   ?? [];

        if ($addReplyTo) {
            $email = $addReplyTo[0] ?? null;
            $name  = $addReplyTo[1] ?? null;

            if ($name) {
                $mail->addReplyTo($email, $name);
            } else {
                $mail->addReplyTo($email);
            }
        }

        $addAddress = CONFIG['email']['addAddress']   ?? [];

        foreach ($addAddress as $address) {
            $email = $address[0] ?? null;
            $name  = $address[1] ?? null;

            if ($name) {
                $mail->addAddress($email, $name);
            } else {
                $mail->addAddress($email);
            }
        }

        return $mail ?? null;
    } catch (Exception $e) {
        if ($debug) {
            echo '<pre>';
            echo $e->getMessage();
            echo '<br>';
            echo "Error: {$mail->ErrorInfo}";
            echo '</pre>';
            die;
        }

        return null;
    }
}

function sendEmail(
    string $fromName,
    string $fromEmail,
    string $subject,
    string $body,
    ?string $attachmentPath = null,
    ?string $attachmentName = null
) {
    try {
        $debug = CONFIG['email']['debug']['enabled'] ?? false;
        $mailClient  = mailClient($debug);

        $mailClient->setFrom($fromEmail, $fromName);

        //Attachments
        if ($attachmentPath && file_exists($attachmentPath)) {
            if ($attachmentName) {
                $mailClient->addAttachment($attachmentPath, $attachmentName);
            } else {
                $mailClient->addAttachment($attachmentPath); //Optional name
            }
        }

        //Content
        $mailClient->Subject = $subject;
        $mailClient->Body    = $body;
        $mailClient->AltBody = strip_tags($body);

        $mailClient->setFrom($fromEmail, $fromName);

        $mailClient->send();
        return true;
    } catch (Exception $e) {
        if ($debug) {
            echo '<pre>';
            echo $e->getMessage();
            echo '<br>';
            echo "Error: {$mailClient->ErrorInfo}";
            echo '</pre>';
            die;
        }

        return false;
    }
}
