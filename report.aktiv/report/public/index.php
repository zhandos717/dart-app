<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__.'/../bootstrap/App.php';
(require __DIR__ . '/../routes/web.php')($app);
$app->run();