<? //проверка существовании сессии
include("../../../bd.php");

$region = $_GET['region'];
$shop = $_GET['shop'];

if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за АПРЕЛЬ 2020
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php"><?= $region; ?></a></li>
          <li class="active"><?= $shop; ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="box">

              <div class="box-body">

                <style>
                  .layer {
                    overflow-x: scroll;
                    /* Добавляем полосу прокрутки */
                    width: 100%;
                    /* Ширина блока */
                    height: 100%;
                    /* Высота блока */
                    padding: 5px;
                    /* Поля вокруг текста */
                    //  border: solid 1px black; /* Параметры рамки */
                    white-space: nowrap;
                    /* Запрещаем перенос строк */
                  }
                </style>
                <div class="layer">


                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>ДАТА</th>
                        <th>ВЫРУЧКА</th>
                        <th>Приход <br /> Сумма</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Кол/во <br />проданных<br />товаров</p>
                        </th>
                        <th>АУКЦИОНИСТ +/-</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?

                      $result = mysqli_query($connect, "SELECT COUNT(*),id, region, data, summazaden, SUM(summazaden), SUM(summaprihod),SUM(summakredit),SUM(summareal),SUM(pribl)
                                        from sales04  WHERE region = '$region' AND adress = '$shop' GROUP BY data ");

                      $sc = 0;

                      while ($data1 = mysqli_fetch_array($result)) {
                        $sc = $sc + $data1['COUNT(*)'];

                      ?>




                        <tr>

                          <td><a href="detail04.php?region=<?= $region; ?>&shop=<?= $shop; ?>&data_z=<?= $data1['data']; ?>"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
                          <th><?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></th>
                          <th><?= number_format($data1['SUM(summazaden)'], 0, '.', ' '); ?></th>
                          <th><?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></th>
                          <th><?= $data1['COUNT(*)']; ?></th>

                        </tr>
                      <? } ?>

                    </tbody>
                    <tfoot>
                      <tr style="background: #398ebd; color: white;">

                        <?
                        $result2 = mysqli_query($connect, " SELECT id, region, SUM(summazaden), SUM(summaprihod),SUM(summakredit),SUM(summareal),SUM(pribl)
                                        from sales04  WHERE region = '$region' AND adress = '$shop' ");

                        $data2 = mysqli_fetch_array($result2);
                        $aukminus = $data2['SUM(summareal)'] - $data2['SUM(summazaden)'];


                        ?>


                        <th><strong>ИТОГО </strong></th>
                        <th><strong><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['SUM(summazaden)'], 0, '.', ' '); ?></strong></th>
                        <th><strong><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></strong></th>
                        <th><?= $sc; ?></th>
                        <th style="background: #00a759; color: white;"><strong><?= number_format($aukminus, 0, '.', ' '); ?></strong></th>

                      </tr>
                    </tfoot>
                  </table>
                </div>

              </div><!-- /.box-body -->




            </div><!-- /.box -->


          </div><!-- /.col -->

        </div><!-- /.row -->

      </section><!-- /.content -->




    </div><!-- /.content-wrapper -->

    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
