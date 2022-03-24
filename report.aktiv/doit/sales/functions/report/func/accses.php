<? include_once '../../../../../bd.php';
//print_r($_POST);
if(!empty($_POST['id_prod'])):
$data = R::load('product',$_POST['id_prod']);
elseif($_POST['name']):
if(empty($_POST['id'])){
$update = R::dispense('product');
$update->dateadd = date('Y-m-d H:i:s');
$update->user = $fio;
$update->region = $region;
}else{
$update = R::load('product',$_POST['id']);
$update->date_update = date('Y-m-d H:i:s');
$update->user_update = $fio;
}
$update->category = $_POST['category'];
$update->name = $_POST['name'];
$update->price = $_POST['price'];
$update->purchaseamount = $_POST['purchaseamount'];
$update->status = 1;
$update->message = $_POST['message'];
$update->counttovar = $_POST['count'];
R::store($update); 
exit;
endif;?>
<div class="row">
    <input type="number" name="id" value="<?= $data['id'] ?>" hidden>
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon bg-red">Категория</span>
            <input type="text" class="form-control" name="category" value="<?= $data['category'] ?>" autocomplete="off" placeholder="Носимое устройство">
        </div>
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon bg-red">Наименование</span>
            <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>" autocomplete="off" placeholder="Наушники Air Pods MAX">
        </div>
    </div>
    <br>
    <div class="col-xs-6">
        <div class="input-group">
            <label for="purchaseamount"> Сумма прихода </label>
            <input type="number" class="form-control" name="purchaseamount" value="<?= $data['purchaseamount'] ?>" id="purchaseamount" autocomplete="off" placeholder="260.000">
        </div>
    </div>
    <div class="col-xs-6">
        <div class="input-group">
            <label for="price"> Сумма продажи </label>
            <input type="number" class="form-control" name="price" value="<?= $data['price'] ?>" id="price" autocomplete="off" placeholder="300.000">
        </div>
    </div>
    <br>
    <br>
    <div class="col-xs-6">
        <div class="input-group">
            <label for="count">Количество</label>
            <input type="number" id="count" name="count" value="<?= $data['counttovar'] ?>" autocomplete="off" class=" form-control">
        </div>
    </div>
    <div class="col-xs-6">
        <div class="input-group">
            <label for="message">Примечание</label>
            <input type="text" id="message" name="message" value="<?= $data['message'] ?>" autocomplete="off" class="form-control" placeholder="Оригинальное устройство">
        </div>
    </div>
</div>