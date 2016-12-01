<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/
if (strtolower($_SERVER['REQUEST_URI']) == '/rae' && $_SERVER['REQUEST_URI'] != '/rae') {
    $skipUrl = ($_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . '/rae';
    Header("Location: $skipUrl");
    exit;
} elseif (strtolower($_SERVER['REQUEST_URI']) == '/cassandra' && $_SERVER['REQUEST_URI'] != '/cassandra') {
    $skipUrl = ($_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . '/cassandra';
    Header("Location: $skipUrl");
    exit;
}elseif (strtolower($_SERVER['REQUEST_URI']) == '/melodee' && $_SERVER['REQUEST_URI'] != '/melodee') {
    $skipUrl = ($_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . '/melodee';
    Header("Location: $skipUrl");
    exit;
}
$app = require __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();
