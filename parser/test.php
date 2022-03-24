<?php
include('simple_html_dom.php');
header('Content-Type: text/html; charset=utf-8');

$html = file_get_html('https://www.olx.kz/elektronika/telefony-i-aksesuary/q-iphone-13/');

foreach($html->find('p.price') as $e) 
    echo $e . '<br>';

foreach ($html->find('img.fleft') as $e)
    echo $e . '<br>';



//echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';
//echo $html->plaintext;
?>