<?php
header('Content-Type: application/json');
include_once  __DIR__ .'/../../../bd.php';

$input = filter_input_array(INPUT_POST);

$black_list = R::load('blacklist',$_POST['id']); 


if ($input['action'] == 'edit') {

    // $mysqli->query("UPDATE users SET username='" . $input['username'] . "', email='" . $input['email'] . "', avatar='" . $input['avatar'] . "' WHERE id='" . $input['id'] . "'");

} else if ($input['action'] == 'delete') {
    $black_list->deleted = 1;
    R::store($black_list);
} else if ($input['action'] == 'restore') {
    $black_list->deleted = 0;
    R::store($black_list);
}
echo json_encode($input);

echo 'ПРивет';