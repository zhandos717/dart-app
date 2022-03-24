<?php 
include ("../../bd.php");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {



if(!empty($_POST["value"])){
$data = R::findAll('diruser','region = ? GROUP BY adress',[$_POST["value"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adress']}'>{$key['adress']}</option>";
}
}elseif(is_array($_POST["regions_shop"])){

$data = R::findLike('saler', ['region'=>$_POST["regions_shop"]] ,'GROUP BY shop');
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option>{$key['shop']}</option>";
}

}elseif(!empty($_POST["region"])){
$data = R::findAll('kassa', 'region = ? GROUP BY filial',[$_POST["region"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['filial']}'>{$key['filial']}</option>";
}
}elseif(!empty($_POST["shop"])){
$data = R::findAll('saler', 'region = ? GROUP BY shop',[$_POST["shop"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option>{$key['shop']}</option>";
}
} elseif (!empty($_POST["get_shop"])) {
        $data = R::findAll('sales', 'region = ? GROUP BY adress', [$_POST["get_shop"]]);
        echo '<option value="">Выберите адрес</option>';
        foreach ($data as $key) {
            echo "<option>{$key['adress']}</option>";
        }
    }
}