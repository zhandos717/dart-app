<?php
include_once __DIR__ . '/../../bd.php';
if (!$_SESSION['logged_user']->status) header('Location: /');
$blacklist = R::findAll('blacklist');
exit(json_encode(['black_list'=> $blacklist]));

