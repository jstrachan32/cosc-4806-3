<?php
if (isset($_SESSION['auth']) == 1) {
    header('Location: /home');
    die;
}

// check if lockout exists and if current path is not lockout
// prevents redirect to /login or /create when lockout is active
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (isset($_SESSION['lockout_time']) && $path != '/lockout') {
    header('Location: /lockout');
    die;
}


?>

<!DOCTYPE html>
<html lang="en">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="/favicon.png">
    <title>COSC 4806</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>