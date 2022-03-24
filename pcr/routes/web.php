<?php

use App\Core\Router;

Router::Add('GET', '', 'main@error');
Router::Add('GET', 'login', 'authorization@login');

Router::Add('POST', 'authorization', 'authorization@authorization');
Router::Add('GET', 'Account/PcrTestSonucuDogrula/', 'main@PcrTest');

if (isset($_SESSION['admin'])) {


    Router::Add('GET', 'log-out', 'authorization@logout','admin');

    Router::Add('GET', 'admin','main@index', 'admin');
    Router::Add('GET', 'delete_test','main@deleteTest', 'admin');
    Router::Add('GET', 'add_test','main@addPcr', 'admin');
    Router::Add('GET', 'viwe_pdf','main@viewPdf', 'admin');
    Router::Add('GET', 'edit_test','main@editTest', 'admin');
    Router::Add('GET', 'result','main@result', 'admin');
    Router::Add('GET', 'get-pdf-result','main@getResult', 'admin');

    Router::Add('POST', 'add_pcr','main@addTest', 'admin');

    Router::Add('GET', 'edit_user','user@editUser', 'admin');
    Router::Add('GET', 'users','user@users', 'admin');
    Router::Add('GET', 'add-user','user@userAdd', 'admin');
    Router::Add('POST', 'add_user','user@addUser', 'admin');

}