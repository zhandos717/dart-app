<?include "pages/layouts/header.php";
  $products = R::findAll('tovar','ORDER BY id DESC')
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Товары на витрине
      <!-- <button class="btn btn-success fa fa-edit" title="Добавить товар" data-toggle="modal" data-target="#modal-default"></button> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li class="active">Товары на витрине </li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <div class="col-md-12">
        <div class="answer">
        </div>
      </div>

      <div class="col-md-12">

        <div class="box">

          <div class="box-body">
            <table class="table table-bordered" id="example1">
              <thead>
                <tr>
                  <th>№</th>
                  <th>Код товара</th>
                  <th>Категория</th>
                  <th>Производитель</th>
                  <th>Модель</th>
                  <th>Цена</th>
                  <th>Файлы</th>
                </tr>
              </thead>
              <tbody>
                <? 
                $i = 1;
                foreach ($products as $row) : ?>
                <tr>
                  <td> <?= $i++ ?>.</td>
                  <td><a href="edit_product?id=<?= $row['id']; ?>" class="btn bg-olive btn-block"><?= $row['codetovar']; ?></a></td>
                  <td><?= $row['category']; ?></td>
                  <td><?= $row['manufacturer']; ?></td>
                  <td><?= $row['model']; ?></td>
                  <td><?= $row['cena']; ?></td>
                  <td>

                    <? $photos = explode(' ', $row['photo']);
                    if(count($photos)>1){
                    foreach ($photos as $key => $value) {?>
                    <a target="_blank" href="https://aktiv-market.kz/imgtovar/<?= $value ?>"><?= $value; ?></a> <br>
                    <?}}else{?>
                    <a target="_blank" href="https://aktiv-market.kz/imgtovar/<?= $row['photo'] ?>"><?= $row['photo'] ?> </a>
                    <?}?>

                  </td>
                </tr>
                <? endforeach; ?>

              </tbody>

            </table>
          </div>

        </div>

      </div>



      <!-- 
                   <div class="col-sm-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  Код товара: <?= $row['codetovar']; ?>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool bg-olive fa fa-edit" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#modal-default"></button>
                    <button class="btn btn-box-tool bg-red fa fa-trash" data-id="<?= $row['id']; ?>"></button>
                  </div>
                </div>
                <div class="box-body">
                  <?
                  $photos = explode(' ', $row['photo']);
                  if(count($photos)>1){?>
                  <img class="img-thumbnail" width="250px" src="https://aktiv-market.kz/imgtovar/<?= $photos[0]; ?>" alt="<?= $row['photo']; ?>">
                  <?}else{?>
                  <img class="img-thumbnail" width="250px" src="https://aktiv-market.kz/imgtovar/<?= $row['photo']; ?>" alt="<?= $row['photo']; ?>">
                  <?}?>
                </div>
                <div class="box-footer">
                  <?= $row['tovarname']; ?>
                </div>
              </div>
            </div><div id="showmore-triger" class="col-md-12" data-page="1" data-max="<?= $row['id']; ?>">
        <div class="text-center"><img src="./img/ajax-loader.gif" alt=""></div>
      </div> -->


    </div><!-- /.row (main row) -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="./function/edit_product.php" enctype="multipart/form-data" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Окно редактирования товара</h4>
        </div>
        <div class="modal-body">
          <p>Подождите идет загрузка&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- <script src="./js/lazy_loading.js"></script> -->
<script src="./js/product_add.js?<?= time(); ?>"></script>

<?include "pages/layouts/footer.php"; ?>