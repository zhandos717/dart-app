<?php
include("../../bd.php");
if (isset($_POST['name'])) {
    $column = $_POST['name'];
    if ($_POST['name'] == 'date') {
        $newValue = strtotime($_POST['value']);
        //echo $newValue;
    } else if ($_POST['name'] == 'address') {
        //var_dump($_POST); die;
        $newValue = $_POST['value']['city'] . ', ул. ' . $_POST['value']['street'] . ', дом. ' . $_POST['value']['building'];
    } else {
        $newValue = $_POST['value'];
    }
    $id = $_POST['pk'];
    $data = R::load('tickets', $id);
    $data->$column = $newValue;
    R::store($data);    
}
 