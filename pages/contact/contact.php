<?php

$error = getFlash('error');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <style>
        .container {
            margin: 0.5rem;
            padding: 1rem;
        }

        div>div {
            margin: 0.8rem auto;
        }

        .container div {
            margin-bottom: 0.5rem;
            padding: 0.5rem;
        }

        label {
            display: block;
        }

        .error {
            color: red;
            margin: 5px;
        }
    </style>
</head>

<body>

    <form action="/contact-send" method="POST" class="container">
        <div class="error">
            <strong><?= $error ?? null ?></strong>
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= old('name') ?>" placeholder="name" required>
        </div>

        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="<?= old('email') ?>" placeholder="email" required>
        </div>

        <div>
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value="<?= old('subject') ?>" placeholder="subject" required>
        </div>

        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" placeholder="message" cols="30" rows="10" required><?= old('message') ?></textarea>
        </div>

        <div>
            <button type="submit">Send message</button>
        </div>
    </form>
</body>

</html>
