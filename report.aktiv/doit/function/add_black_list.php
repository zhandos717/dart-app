<?php 
include_once __DIR__.'/../../bd.php';
if (!$status) exit;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


if ($region && ($_POST['model'] or $_POST['category'])) {

    $black_list = R::dispense('blacklist');

    // $black_list->type_product = $_POST['type'];
    // $black_list->manufacturer = $_POST['manufacturer'];
    // $black_list->category = $_POST['category'];
    // $black_list->model = $_POST['model'];

    // $black_list->characteristics = $_POST['characteristics'];

    $black_list->description = $_POST['description'];
    $black_list->sn = $_POST['sn'];
    $black_list->imei = $_POST['imei'];
    $black_list->imei2 = $_POST['imei2'];


    $black_list->add_user    = $fio;
    $black_list->datareg     = date('Y-m-d H:i:s');
    $black_list->deleted = 0;
    R::store($black_list);

    exit;
}

?>