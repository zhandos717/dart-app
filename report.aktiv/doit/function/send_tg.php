<?php
    if($login){
        if (isset($_POST['komu']) and isset($_POST['tema'])) {
            TgBot::send($_POST['komu'], $login, $_POST['tema'], date("Y-m-d"), date("H:i:s"));
        }
    };