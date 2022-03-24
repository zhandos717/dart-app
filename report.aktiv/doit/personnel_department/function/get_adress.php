<?php
include ("../../../bd.php");
if(!isset($fio)) header('Location: /');

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

if(!empty($_POST["value"])){
$data = R::findAll('kassa','region = ? GROUP BY adress',[$_POST["value"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adress']}'>{$key['adress']}</option>";
}
}elseif(!empty($_POST["region"])){
$data = R::findAll('kassa', 'region = ? GROUP BY filial',[$_POST["region"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['filial']}'>{$key['filial']}</option>";
}
}
}?>
