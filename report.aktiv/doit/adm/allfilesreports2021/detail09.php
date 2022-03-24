<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
    $data_z = $_GET['data_z'];
    $region = $_GET['region'];
    $shop = $_GET['shop'];
    $fromtovar = $_GET['from'];
?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за сентябрь 2020
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
          <div class="col-xs-12">
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
                        <th>#</th>

                        <th>ДАТА</th>
                        <th>КОД ТОВАРА</th>
                        <th>ТОВАР</th>
                        <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                        <th>ПРЕДОПЛАТА</th>
                        <th>СУММА РЕАЛИЗАЦИИ</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>ВИД</th>
                        <th>ПРОДАВЕЦ</th>
                        <th>ПОКУПАТЕЛЬ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?

                      $result = mysqli_query($connect, "SELECT *FROM sales09 WHERE data = '$data_z'  AND region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' ");

                      while ($data1 = mysqli_fetch_array($result)) { ?>




                        <tr>
                          <td>
                            <form action="upd_sales09.php" method="post">
                              <input type="number" name="id" value="<?= $data1['id']; ?>" hidden="" />
                              <input type="submit" value="RW" name="goup">
                            </form>

                          </td>
                          <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                          <td><?= $data1['codetovar']; ?></td>
                          <td><?= $data1['tovarname']; ?></td>
                          <td><?= number_format($data1['summaprihod'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['predoplata'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['summareal'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['pribl'], 0, '.', ' '); ?></td>
                          <td><?= $data1['vid']; ?></td>
                          <td><?= $data1['saler']; ?></td>
                          <td><?= $data1['pokupatel']; ?></td>


                        </tr>
                      <? } ?>

                    </tbody>
                    <tfoot>
                      <tr style="background: #d3d7df; color: black;">

                        <?
                        $result2 = mysqli_query($connect, " SELECT id, region, SUM(summaprihod),SUM(predoplata),SUM(summareal),SUM(pribl)
                                        from sales09 WHERE data = '$data_z' AND region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' ");

                        $data2 = mysqli_fetch_array($result2);


                        ?>


                        <th colspan="4">ИТОГО </th>
                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(predoplata)'], 0, '.', ' '); ?></th>
                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></th>
                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></th>


                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">

              </div>
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
