<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 9) :
    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;
?>
    <? include "header.php"; ?>
    <? include "menu.php";

      $id = $_POST['id'];
      $id = (int)$id;

      $result = mysqli_query($connect, "SELECT * FROM kosyak WHERE id = '$id' ");
      $data = mysqli_fetch_array($result);?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Сличительная ведомость по региону <?= $region; ?>
          <small><a href="index.php">назад к списку</a></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">

        <? if($_SESSION['message'] OR $_SESSION['errors']){
            if($_SESSION['message']){
              $color = 'success';
              $ico = 'check';
              $message = $_SESSION['message'];
            }else {
              $color = 'danger';
              $ico = 'ban';
              $message = $_SESSION['errors'];
            }?>
          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-<?=$color;?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-<?=$ico;?>"></i> Успех!</h4>
                  <?=$message;?>
              </div>
            </div>
          </div>
        <?};
        unset($_SESSION['message']); unset($_SESSION['errors']); ?>

        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
                <h2 class="box-title btn btn-warning">Для отработки сличительной ведомости нужно загрузить заявление на покупку</h2>
              </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr class="info">
                          <th>Дата</th>
                          <th>Адрес</th>
                          <th>Код товара</th>
                          <th>Сумма переоценки</th>
                          <th>Комментарий</th>
                          <th>Ведомость</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                            <td><?= $data['adress']; ?></td>
                            <td><?= $data['codetovar']; ?></td>
                            <td><?= number_format($data['pereoceka'], 0, '.', ' '); ?></td>
                            <td><?= $data['comment']; ?></td>
                            <td><a href="<?= $data['photo']; ?>" target="_blank">Просмотр</a></td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div><!-- /.box -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="col-xs-12">
              <div class="box">
                  <div class="box-body">
                    <form  action="functions\add_vedomost.php" method="POST" enctype="multipart/form-data">
                      <input style="display:inline;" type="file" multiple name="file">
                      <input type="text" hidden name="token" value="65465465">
                      <input type="text" hidden name="id" value="<?=$data['id'];?>">
                      <button type="submit"  class="btn btn-primary"> Загрузить</button>
                    </form>
              </div>
            </div>
          </div><!-- /.col -->
      </section>
    </div><!-- /.content-wrapper -->
    <? include "footer.php"; ?>
  <?php endif; ?>
<? else : ?>
  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<?php endif; ?>
