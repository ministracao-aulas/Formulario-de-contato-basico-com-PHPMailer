<?php

$success = getFlash('success');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email successfully sent</title>
</head>

<body>
    <div>
        <div>
            <h4><a href="/contact">Contact</a></h4>
        </div>

        <div>
            <h1><?= $success ?? 'Email successfully sent' ?></h1>
        </div>
    </div>
</body>

</html>
