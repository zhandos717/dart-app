<? include "pages/layouts/header.php";
    require_once  './function/thumbs.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Фотографии
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Фото в базе</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <?php
            $dir = '../../../httpdocs/imgs'; // Папка с изображениями
            $cols = 3; // Количество столбцов в будущей таблице с картинками
            $files = scandir($dir); // Берём всё содержимое директории
            $patch = 'https://aktiv-market.kz/imgs/';

            ?>
            <table class="table">
              <?$i = 0;
              foreach ($files as $key){
                if(strlen($key) > 2){
              if($i % 3 == 0){ echo '<tr>';}
              $i++ ; 
              ?>
              <th> <img src="./pages/preview.php?src=<?= $patch.$key;?>" width="150px" alt=""> </th>
              <?if($i % 3 === 0){ echo '</tr>';}
              }}?>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<? include "pages/layouts/footer.php"; ?>