<?include ("../../../bd.php");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

if(!empty($_POST["value"])){
$data = R::findAll('diruser','region = ? GROUP BY adress',[$_POST["value"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adress']}'>{$key['adress']}</option>";
}
}elseif(!empty($_POST["region"])){
$data = R::findAll('users','region = ? GROUP BY adressfil',[$_POST["region"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adressfil']}'>{$key['adressfil']}</option>";
}}
# База данных продавцов
elseif(!empty($_POST["saler"])){
$salers = R::findAll('sales','region = ? GROUP BY saler',[$_POST["saler"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($salers as $saler) {
    echo "<option value='{$saler['saler']}'>{$saler['saler']}</option>";
}}

elseif(!empty($_POST["reg"])){
$data = R::findAll('sales','regionlombard = ? GROUP BY regionlombard',[$_POST["reg"]]);
echo '<option value="">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adresslombard']}'>{$key['adresslombard']}</option>";
}
}
elseif(!empty($_POST["region_com"])){
$data = R::findAll('tickets','region = ? GROUP BY adressfil',[$_POST["region_com"]]);
echo '<option value="Все">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adressfil']}'>{$key['adressfil']}</option>";
}}
elseif(!empty($_POST["region_shop"])){
$data = R::findAll('sales','region = ? GROUP BY adress',[$_POST["region_shop"]]);
echo '<option value="Все">Выберите адрес</option>';
foreach ($data as $key) {
    echo "<option value='{$key['adress']}'>{$key['adress']}</option>";
}}
# База данных продавцов
}
?>