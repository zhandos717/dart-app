<?include ("../../../bd.php");
$tovar = R::load('tovar',$_POST['id']);
?>

<div class="row">
    <input type="text" name="tovar_id" value="<?= $tovar['id']; ?>" hidden>

    <div class="col-md-6">
        <div class="form-group">
            <label for="#get_region">Город</label>
            <select id="get_region" name="region" required class="form-control">
                <?if($user['region']){?>
                <option value="<?= $tovar['region']; ?>"><?= $tovar['region']; ?></option>
                <?}else{?>
                <option value="">Выберите город</option>
                <?}
                    $city = R::findAll('diruser','GROUP BY region');
                    foreach ($city as $key) {
                        echo "<option value='{$key['region']}'>{$key['region']}</option>";
                    }?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="codetovar">Код товара</label>
            <input type="text" class="form-control" id="codetovar" required autocomplete="off" value="<?= $tovar['codetovar']; ?>" name="codetovar" placeholder="39-1">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="tovarname">Наименование товара</label>
            <input type="text" class="form-control" id="tovarname" required autocomplete="off" value="<?= $tovar['tovarname']; ?>" name="tovarname" placeholder="iPhone 11 128 GB">
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="get_category">Категория:</label>
            <select id="get_category" name="category" class="form-control">
                <?if($tovar['category']){?>
                <option value="<?= $tovar['category']; ?>"><?= $tovar['category']; ?></option>
                <?} $category = R::findAll('category','GROUP BY name');
                    foreach ($category as $key) {
                        echo "<option value='{$key['name']}'>{$key['name']}</option>";
                    }?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="podcategory">Подкатегория:</label>
            <select name="podcategory" id="podcategory" class="form-control">
                <?if($tovar['podcategory']){?>
                <option value="<?= $tovar['podcategory']; ?>"><?= $tovar['podcategory']; ?></option>
                <?}
                
                $category = R::findAll('category','GROUP BY name');
                    foreach ($category as $key) {
                        echo "<option value='{$key['name']}'>{$key['name']}</option>";
                    }?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="cena">Цена</label>
            <input type="text" class="form-control" id="cena" required value="<?= $tovar['cena']; ?>" name="cena" placeholder="1 000 000">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group pad">
            <label for="opisanie">Описание</label>
            <textarea class="form-control" id="opisanie" name="opisanie" placeholder="Введите описание товара" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $tovar['opisanie']; ?></textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="file">Фотография</label>
            <input type="file" class="form-control" id="file" required value="<?= $tovar['file']; ?>" name="file">
        </div>
    </div>
</div>
<script src="./js/edit_product.js?<?= uniqid() ?>">  </script>