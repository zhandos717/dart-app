<?php
include_once 'simple_html_dom.php';

function get_olx($url)
{
    $headers = [
        'cache-control: max-age=0',
        'upgrade-insecure-requests: 1',
        'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
        'sec-fetch-user: ?1',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'x-compress: null',
        'sec-fetch-site: none',
        'sec-fetch-mode: navigate',
        'accept-encoding: deflate, br',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    ];

    $prox = '5.45.64.97:3128';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($val));
    curl_setopt($ch, CURLOPT_HEADER, false);
    //curl_setopt($ch, CURLOPT_PROXY, "$proxy");
    $html = curl_exec($ch);
    curl_close($ch);
    //$data =  json_decode($html,true);
    return $html;
}
$url = 'https://www.olx.kz/ajax/suggest/get/?q=samsung a50]&q=samsung+a50]&page=1';

header('Content-Type: text/html; charset=utf-8');

$c =  get_olx('https://www.olx.kz/ajax/suggest/get/?q='. str_replace(' ', '%20', $_POST['q']).'&q='.str_replace(' ', '+', $_POST['q']));


$reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

if ($num_found = preg_match_all($reg_exUrl, $c, $out)) {
   
    $html = file_get_html($out[0][0]);

    foreach ($html->find('p.price') as $e)
    echo $e . '<br>';

    foreach ($html->find('img.fleft') as $e)
    echo $e . '<br>';

    echo "FOUND " . $num_found . " LINKS: {$out[0][0]} \n";


}



