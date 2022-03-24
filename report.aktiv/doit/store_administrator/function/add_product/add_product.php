<?include ("../../../../bd.php");

if(!empty($_POST['manufacturer'])){
    $productList = R::load('productlist',$_POST['user_id']);    
    $productList->type = $_POST['type'];
    $productList->manufacturer = $_POST['manufacturer'];
    $productList->category = $_POST['category'];
    $productList->model = $_POST['model'];
    $productList->description = $_POST['description'];
    $productList->characteristics = $_POST['characteristics'];
    ###########################################################
    $productList->add_user    = $fio;
    $productList->datareg     = date('Y-m-d H:i:s');
    R::store($productList);


               $result = [
        'code'=> 2,
        'type'=>'Успех',
        'class'=>'success',
        'icon'=>'check',
        'message'=>'Товар добавлен!'
    ];

    header('Content-type: application/json');
    echo json_encode( $result );

 exit;
}
$list = R::load('productList',$_POST['id']);
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
</div>