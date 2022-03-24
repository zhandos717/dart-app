<?php

try {
    require_once __DIR__ . '/../../bd.php';
    require_once __DIR__ . '/src/Router.php';

    if (!$status)
        throw new Exception('Доступ запрешен');

    Router::Add('GET', '',             'main@index');
    Router::Add('POST', 'add-message',    'main@addMessage');

    Router::Add('POST', 'get-messages',    'main@getMessageAll');

    if (!in_array($_REQUEST['routes'], Router::$routes))
        throw new Exception('Нет такой страницы');
} catch (Throwable $ex) {
    echo $ex->getMessage();
}
