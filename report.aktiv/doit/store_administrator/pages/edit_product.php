<? include "pages/layouts/header.php"; 
$id=intval($_GET['id']);
$product = R::load('tovar',$id);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Редактирование товара </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Редактирование товара</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="./function/add_tovar/add_tovar.php" enctype="multipart/form-data">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <input type="text" name="tovar_id" value="<?= $product['id']; ?>" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="#get_region">Город</label>
                                <select id="get_region" name="region" required class="form-control">
                                    <?if($product['region']){?>
                                    <option value="<?= $product['region']; ?>"><?= $product['region']; ?></option>
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
                                <input type="text" class="form-control" id="codetovar" required autocomplete="off" value="<?= $product['codetovar']; ?>" name="codetovar" placeholder="39-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="get_type">Тип:</label>
                                <select id="get_type" name="type" class="form-control">
                                    <?if($product['type']){?>
                                    <option value="<?= $product['type']; ?>"><?= $product['type']; ?></option>
                                    <?}else{?>
                                    <option value="">Выберите город</option>
                                    <?} $category = R::findAll('productlist','GROUP BY type');
                                foreach ($category as $key) {
                                    echo "<option value='{$key['type']}'>{$key['type']}</option>";
                                }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="get_category">Категория:</label>
                                <select id="get_category" name="category" class="form-control">
                                    <?if($product['category']){?>
                                    <option value="<?= $product['category']; ?>"><?= $product['category']; ?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="manufacturer">Производитель:</label>
                                <select name="manufacturer" id="manufacturer" class="form-control">
                                    <?if($product['manufacturer']){?>
                                    <option value="<?= $product['manufacturer']; ?>"><?= $product['manufacturer']; ?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model">Модель:</label>
                                <select name="model" id="model" class="form-control">
                                    <?if($product['model']){?>
                                    <option value="<?= $product['model']; ?>"><?= $product['model']; ?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cena">Цена</label>
                                <input type="number" class="form-control" id="cena" required value="<?= $product['cena']; ?>" name="cena" placeholder="1 000 000">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Фотография</label>
                                <input multiple="true" type="file" class="form-control" id="file" value="<?= $product['file']; ?>" name="file[]">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="opisanie">Описание</label>
                                <textarea class="form-control" id="opisanie" name="opisanie" placeholder="Введите описание товара" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $product['opisanie']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="url">Ссылка вместо фото</label>
                                <input type="text" class="form-control" id="url" autocomplete="off" value="<?= $product['url']; ?>" placeholder="https://aktiv-market.kz/" name="url">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-info pull-right" type="submit"> Добавить на витрину </button>
                </div>
            </div>
        </form>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="./js/edit_product.js?<?= uniqid() ?>"> </script>
<? include "pages/layouts/footer.php"; ?>