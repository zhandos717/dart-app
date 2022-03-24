<? include_once "../../../../bd.php";
if($_POST['model'] OR $_POST['category']){
$price = R::load('pricelist',$_POST['id']);
$price->type = $_POST['type'];
$price->manufacturer = $_POST['manufacturer'];
$price->category = $_POST['category'];
$price->model = $_POST['model'];
$price->description = $_POST['description'];
$price->characteristics = $_POST['characteristics'];
$price->price_a = $_POST['price_a'];
$price->price_b = $_POST['price_b'];
$price->price_c = $_POST['price_c'];
$price->price_d = $_POST['price_d'];
###########################################################
$price->add_user    = $fio;
$price->datareg     = date('Y-m-d H:i:s');
R::store($price);
//var_dump($_POST);
exit;    
}
$list = R::load('pricelist',$_POST['id']);
?>
<div class="box-body">
    <!-- input states -->
    <input type="text" hidden value="<?= $list['id'] ?>">
    <div class="form-group ">
        <label class="control-label" for="type"><i class="fa fa-check"></i> Тип </label>
        <input type="text" class="form-control" value="<?= $list['type'] ?>" required id="type" placeholder="Техника" name="type">
    </div>
    <div class="form-group ">
        <label class="control-label" for="manufacturer"><i class="fa fa-check"></i> Производитель</label>
        <input type="text" class="form-control" value="<?= $list['manufacturer'] ?>" required id="manufacturer" placeholder="Apple" name="manufacturer">
    </div>
    <div class="form-group">
        <label class="control-label" for="category"><i class="fa fa-bell-o"></i> Категория </label>
        <input type="text" class="form-control" value="<?= $list['category'] ?>" required id="category" placeholder="Носимое устройство" name="category">
    </div>
    <div class="form-group">
        <label class="control-label" for="model"><i class="fa fa-times-circle-o"></i> Модель</label>
        <input type="text" class="form-control" value="<?= $list['model'] ?>" required id="model" placeholder="Air Pods 2 Gen." name="model">
    </div>
    <!-- input states -->
    <!-- textarea -->
    <div class="form-group">
        <label class="control-label" for="description">Описание</label>
        <textarea type="text" class="form-control" id="description" placeholder="" name="description"><?= $list['description'] ?></textarea>
    </div>
    <div class="form-group">
        <label class="control-label" for="characteristics">Характеристики</label>
        <textarea class="form-control" rows="3" placeholder="" id="characteristics" name="characteristics"><?= $list['characteristics'] ?></textarea>
    </div>
    <!-- textarea -->
    <div class="row">
        <!-- input states -->
        <div class="col-xs-3">
            <input type="number" class="form-control" required placeholder="А" value="<?= $list['price_a'] ?>" name="price_a">
        </div>
        <div class="col-xs-3">
            <input type="number" class="form-control" required placeholder="B" value="<?= $list['price_b'] ?>" name="price_b">
        </div>
        <div class="col-xs-3">
            <input type="number" class="form-control" required placeholder="C" value="<?= $list['price_c'] ?>" name="price_c">
        </div>
        <div class="col-xs-3">
            <input type="number" class="form-control" required placeholder="D" value="<?= $list['price_d'] ?>" name="price_d">
        </div>
        <!-- input states -->
    </div>
</div>