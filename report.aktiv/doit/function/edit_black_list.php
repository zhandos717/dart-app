<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../../bd.php';

$input = filter_input_array(INPUT_POST);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (!$status) exit;

$black_list = R::load('blacklist', $input['id']);

if ($input['action'] == 'edit') {

    // if($input['type_product']){
    //     $black_list->type_product = $input['type_product'];
    // } elseif ($input['manufacturer']) {
    //     $black_list->manufacturer = $input['manufacturer'];
    // }elseif($input['category']){
    //     $black_list->category = $input['category'];
    // }elseif($input['model']){
    //     $black_list->model = $input['model'];
    // }elseif($input['characteristics']){
    //     $black_list->characteristics = $input['characteristics'];
    // }


    if($input['description']){
        $black_list->description = $input['description'];
    }elseif($input['imei']){
        $black_list->imei = $input['imei'];
    }elseif($input['imei2']){
        $black_list->imei2 = $input['imei2'];
    }

    $black_list->deleted = 0;
    $black_list->add_user    = $fio;
    $black_list->datareg     = date('Y-m-d H:i:s');

} else if ($input['action'] == 'delete') {
    $black_list->deleted = 1;
} else if ($input['action'] == 'restore') {
    $black_list->deleted = 0;
}

R::store($black_list);

echo json_encode($input);
// echo 'ПРивет';