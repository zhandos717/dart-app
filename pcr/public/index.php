<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use App\Core\View;
    include __DIR__ . '/../vendor/autoload.php';

try {
    if (!session_id()) session_start();
    include __DIR__ . '/../routes/web.php';
    
} catch (Throwable $ex) {
    View::errorCode($ex->getCode(), $ex->getMessage());
}
