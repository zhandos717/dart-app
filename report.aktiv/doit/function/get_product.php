<?php
include_once __DIR__ . '/../../bd.php';
if ($status != 5) exit;

$output = json_decode(file_get_contents('php://input'), true);
if (!isset($_POST['code']) && !isset($output['code']))
    exit(json_encode(['message' => 'Нет данных для проверки', 'status' =>
    'error']));


$code = $_POST['code']?? $output['code'];

function get_product(string $nomerzb)
{

    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://report.commission2.kz/doit/api/get_product.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query([
            'nomerzb' => $nomerzb,
            'token' => '#&*Dfa8w2ahjk'
        ])
    ));
    $response = json_decode(curl_exec($myCurl), true);
    curl_close($myCurl);
    return $response;
}
$ticket = R::getRow('SELECT region,adressfil,summa_vydachy,category,tovarname,status FROM tickets WHERE nomerzb = :nomerzb LIMIT 1', [':nomerzb' => $code]);
if ($ticket) {
    exit(json_encode(['ticket' => $ticket, 'status' =>
    'success']));
} else {
    exit(json_encode(get_product($code)));
}
