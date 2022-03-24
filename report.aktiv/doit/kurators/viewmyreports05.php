<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 9) :
    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
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
        <? if($_SESSION['message']){?>

          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-success alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <h4>	<i class="icon fa fa-check"></i> Успех!</h4>
                           <?=$_SESSION['message'];?>
                         </div>
            </div>
          </div>

        <?};
        unset($_SESSION['message']);
        if($_SESSION['errors']){?>

          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-danger alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <h4>	<i class="icon fa fa-ban"></i> Ошибка!</h4>
                           <?=$_SESSION['errors'];?>
                         </div>
            </div>
          </div>
        <?};  unset($_SESSION['errors']);?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
                <h2 class="box-title btn btn-danger">Активные</h2>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>Дата</th>
                        <th>Адрес</th>
                        <th>Код товара</th>
                        <th>Сумма переоценки</th>
                        <th>Комментарий</th>
                        <th>Документ</th>
                        <th>Действие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      if($_SESSION['logged_user']->root == '3'):
                        $result = mysqli_query($connect, "SELECT * FROM kosyak WHERE region = '$region' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар'  ORDER BY id DESC ");
                      else:
                          $result = mysqli_query($connect, "SELECT * FROM kosyak WHERE region='$region' ORDER BY id DESC ");
                    endif;
                      while ($data = mysqli_fetch_array($result)) { ?>
                        <tr>
                          <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                          <td><?= $data['adress']; ?></td>
                          <td><?= $data['codetovar']; ?></td>
                          <td><?= number_format($data['pereoceka'], 0, '.', ' '); ?></td>
                          <td><?= $data['comment']; ?></td>
                          <td><a href="<?= $data['photo']; ?>" target="_blank">Просмотр</a></td>
                          <td>
                            <form action="redact.php" method="post">
                              <input type="text" hidden name="id" value="<?= $data['id']; ?>">
                              <button type="submit" name="button" class="btn btn-success"> Отработать</button>
                            </form>
                          </td>
                        </tr>
                      <? } ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->

          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
                <h2 class="box-title btn btn-success">Отработанные</h2>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>Дата</th>
                        <th>Адрес</th>
                        <th>Код товара</th>
                        <th>Сумма переоценки</th>
                        <th>Комментарий</th>
                        <th>Ведомость</th>
                        <th>Заявление</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      if($_SESSION['logged_user']->root == '3'):
                        $result1 = mysqli_query($connect, "SELECT * FROM kosyak WHERE  status = '2' AND (region = '$region' OR region = 'Кокшетау' OR region = 'Костанай' OR region = 'Павлодар')   ORDER BY id DESC ");
                      else:
                          $result1 = mysqli_query($connect, "SELECT * FROM kosyak WHERE region='$region' AND status = '2'  ORDER BY id DESC ");
                      endif;
                      while ($data1 = mysqli_fetch_array($result1)) { ?>
                        <tr>
                          <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                          <td><?= $data1['adress']; ?></td>
                          <td><?= $data1['codetovar']; ?></td>
                          <td><?= number_format($data1['pereoceka'], 0, '.', ' '); ?></td>
                          <td><?= $data1['comment']; ?></td>
                          <td><a href="<?= $data1['photo']; ?>"  target="_blank" class="btn btn-block bg-info"><i class="fa fa-map-o"></i></a></td>
                          <td><a href="<?= $data1['file']; ?>" target="_blank" class="btn btn-block bg-info"><i class="fa fa-search-plus"></i> </a></td>
                        </tr>
                      <? } ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
      </section>
    </div><!-- /.content-wrapper -->
    <? include "footer.php"; ?>
  <?php endif; ?>
<? else : ?>
  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<?php endif; ?>
