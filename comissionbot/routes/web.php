<?php 

    $app->get('/', MainController::class . ':index');

    $app->get('/user/login', AuthorizationController::class . ':login');
    
    $app->post('/telegram/bot', BotTgController::class . ':bot');

    $app->post('/telegram/report_bot', ReportBotTgController::class . ':bot');

    $app->post('/telegram/mail_reports', MailBotTgController::class . ':mail');