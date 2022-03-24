<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
    $active_lombard = 'active';
    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region; ?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Сличительная ведомость
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
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h2 class="box-title btn btn-danger">Активные</h2>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>Дата</th>
                        <th>Город</th>
                        <th>Адрес</th>
                        <th>Код товара</th>
                        <th>Сумма переоценки</th>
                        <th>Комментарий</th>
                        <th>Документ</th>
                        <th>act</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, "SELECT * FROM kosyak  ORDER BY id DESC ");
                      while ($data = mysqli_fetch_array($result))
                      { ?>
                        <tr>
                          <td><?= date("d.m.Y", strtotime($data['data'])); ?></td>
                          <td><?= $data['region']; ?></td>
                          <td><?= $data['adress']; ?></td>
                          <td><?= $data['codetovar']; ?></td>
                          <td><b><?= number_format($data['pereoceka'], 0, '.', ' '); ?></b></td>
                          <td><?= $data['comment']; ?></td>
                          <td><a href="/doit/kurators/<?= $data['photo']; ?>" target="_blank">Просмотр</a></td>
                          <td> <a href="updsl.php?id=<?= $data['id']; ?>">Редактировать</a> </td>
                        </tr>
                      <? } ?>
                    </tbody>
                    <tfoot>
                      <?
                      $result2 = mysqli_query($connect, " SELECT SUM(pereoceka) from kosyak  ");
                      $data2 = mysqli_fetch_array($result2);
                      ?>
                      <tr style="background: #d3d7df; color: black;">
                        <th colspan="4">Итого (СУММА ПЕРЕОЦЕНКИ)</th>
                        <th><em><b><font size="3" color="red" face="Arial"><?= number_format($data2['SUM(pereoceka)'], 0, '.', ' '); ?></font></b></em></th>
                        <th colspan="3"></th>
                      </tr>
                    </tfoot>
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
                        $result1 = mysqli_query($connect, "SELECT * FROM kosyak WHERE  status = '2'   ORDER BY id DESC ");
                        while ($data1 = mysqli_fetch_array($result1)) { ?>
                        <tr>
                          <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                          <td><?= $data1['adress']; ?></td>
                          <td><?= $data1['codetovar']; ?></td>
                          <td><?= number_format($data1['pereoceka'], 0, '.', ' '); ?></td>
                          <td><?= $data1['comment']; ?></td>
                          <td><a href="/doit/kurators/<?= $data1['photo']; ?>"  target="_blank" class="btn btn-block bg-info"><i class="fa fa-map-o"></i></a></td>
                          <td><a href="/doit/kurators/<?= $data1['file']; ?>" target="_blank" class="btn btn-block bg-info"><i class="fa fa-search-plus"></i> </a></td>
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
