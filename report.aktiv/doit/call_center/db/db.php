<?php
    include ("../../../bd.php");
    
    $stmt = $pdo->query('SELECT name FROM users');

?>