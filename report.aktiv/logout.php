<?php

    include ("bd.php");
    unset($_SESSION['logged_user']);
    header('Location: /');