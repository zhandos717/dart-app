<?include ("../../../bd.php");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

if(!empty($_POST["type"])){
    $category = R::findAll('productlist','type = ? GROUP BY category',[$_POST["type"]]);
     echo "<option value=''>Выберите тип</option>";
    foreach ($category as $key) {
        echo "<option value='{$key['category']}'>{$key['category']}</option>";
    }
}else if($_POST["manufacturer"] && $_POST["category"]){

        $category = R::findAll('productlist','manufacturer = :manufacturer AND category = :category  GROUP BY model',[':manufacturer'=>$_POST["manufacturer"],':category'=>$_POST["category"]]); // 
    echo "<option value=''>Выберите производителя</option>";
    foreach ($category as $key) {
        echo "<option value='{$key['model']}'>{$key['model']}</option>";
    }

}else if($_POST["category"]){
    $category = R::findAll('productlist','category = ? GROUP BY manufacturer',[$_POST["category"]]);
        echo "<option value=''>Выберите категорию</option>";
    foreach ($category as $key) {
        echo "<option value='{$key['manufacturer']}'>{$key['manufacturer']}</option>";
    }
}





}?>