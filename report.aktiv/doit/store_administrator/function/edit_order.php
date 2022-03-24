<?include ("../../../bd.php");
$zakaz = R::load('zakaz',$_POST['id']);


if(!empty($_POST['description'])){
    $zakaz->description = $_POST['description'];
    $zakaz->status = $_POST['status'];
    R::store($zakaz);
    header('Location: ../orders');
    exit;
}
?>

<div class="row">
    <input type="text" name="id" value="<?= $zakaz['id']; ?>" hidden>


    <div class="col-md-12">
        <div class="form-group">
            <label for="status">Категория:</label>
            <select id="status" name="status" class="form-control">
                <?if($zakaz['status']){?>
                <option><?= $zakaz['status']; ?></option>
                <?}?>
                <option>В обработке</option>
                <option>Выполнен</option>
                <option>Создан</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Примечание</label>
            <textarea name="description" required id="description" rows="5" class="form-control"><?= $zakaz['description']; ?></textarea>
        </div>
    </div>

</div>
<script src="./js/edit_order.js?<?= uniqid() ?>"> </script>