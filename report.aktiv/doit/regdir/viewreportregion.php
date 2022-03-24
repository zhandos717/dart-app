<? //проверка существовании сессии
include("../../bd.php");
$region = $_GET['region'];
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 2) :
?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Регионы
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
                <h3 class="box-title">Филиалы <?= $region; ?></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Адрес филиала</th>
                      <th>Доход ломбард</th>
                      <th>Доход магазин</th>
                      <th>Доп доход</th>
                      <th>Доходы</th>
                      <th>Текущие расходы</th>
                      <th>Клиенты за сутки</th>
                      <th>Новые клиенты за сутки</th>
                      <th>Выдача за сутки</th>
                      <th>Возврат</th>
                      <th>Накладные</th>
                      <th>Чистая выдача</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?

                    $result = mysqli_query($connect, "SELECT adress,id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        FROM reports WHERE `region`='$region' GROUP BY `adress` ");

                    while ($data1 = mysqli_fetch_array($result)) { ?>


                      <tr>
                        <td><a href="viewfilial.php?region=<?= $region; ?>&adress=<?= $data1['adress']; ?>"><?= $data1['adress']; ?></a></td>
                        <td><?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(vzs)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(vozvrat)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(nakladnoy)'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>
                      </tr>
                    <? } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <?
                      $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        from reports WHERE region = '$region' ");

                      $data2 = mysqli_fetch_array($result2);


                      ?>
                      <th>Итого</th>
                      <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(vzs)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(vozvrat)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(nakladnoy)'], 0, '.', ' '); ?></th>
                      <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>

                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->


          </div><!-- /.col -->

        </div><!-- /.row -->

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <? include "footer.php"; ?>

  <?php endif; ?>

<? else : ?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>