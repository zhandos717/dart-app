<? //проверка существовании сессии
include("../../../bd.php");

$region = $_GET['region'];
$shop = $_GET['shop'];
$fromtovar = $_GET['from'];

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
          Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за Сентябрь 2020
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
          <div class="col-md-12">
             <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title">Фильтрация</h3>

                   <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                   </div>
                 </div>

                 <div class="box-body">
                   <div class="row">
                   <form action="filtr_shop.php" method="POST">
                     <input type="text" name="regionshop" value="<?=$region;?>" hidden>
                     <input type="text" name="shopadres" value="<?=$shop;?>" hidden>
                     <input type="text" name="fromtovar" value="<?=$fromtovar;?>" hidden>
                     <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;"  name="date1" min="2020-09-01" max="2020-09-30" required>
                        </div>
                        <!-- /input-group -->
                     </div>

                      <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;" name="date2"  min="2020-09-01" max="2020-09-30">
                        </div>
                        <!-- /input-group -->
                     </div>

                                       <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-bank"></i>
                                               </span>
                                               <select name="saler" class="form-control" required>
                                                 <option value="">Выберите продавца</option>
                                                   <?

                           //     $result = mysqli_query($connect, "SELECT *FROM saler WHERE region = '$region' AND shop = '$shop'");
                               $result = mysqli_query($connect, "SELECT *FROM sales09 WHERE region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar'  GROUP BY saler");

                               while ($data = mysqli_fetch_array($result)) { ?>

                                                   <option value="<?= $data['saler']; ?>"><?= $data['saler']; ?></option>
                                                   <? } ?>
                                               </select>
                                         </div>
                                       </div>

                                       <!-- <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-building"></i>
                                               </span>
                                               <select name="vid" class="form-control" >
                                                   <option value="">Все виды оплаты</option>
                                                   <option value="наличные">Наличные</option>
                                                   <option value="безналичные">Безналичные</option>
                                                   <option value="смешанные">Смешанные</option>
                                                   <option value="Каспий банк">Каспий банк</option>
                                                   <option value="Альфа банк">Альфа банк</option>
                                                   <option value="Нурбанк">Нурбанк</option>
                                                   <option value="иные переводы">Иные переводы</option>

                                               </select>
                                         </div>
                                       </div> -->


                                       <div class="input-group input-group-sm">
                                           <span class="input-group-btn">
                                             <button type="submit" class="btn btn-info btn-flat">Фильтровать</button>
                                           </span>
                                     </div>
                                     </form>
                                 </div><!-- /.row -->
                      </div><!--.box-body -->
                   </div> <!--.box -->
                 </div> <!--.col-md-12 -->

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

                  <?

                  $result = mysqli_query($connect, " SELECT * FROM magazin WHERE region = '$region' AND adress ='$shop' ");

                  $data = mysqli_fetch_array($result);

                  ?>

                  <!-- <form action="functions/rplanmag.php" method="post">
                    <font color="red">Ежемесячный план магазина <?=$region;?>/<?=$shop;?>: </font><input type="number" name="plan" value="<?=$data['plan'];?>">
                    <input type="text" name="region" value="<?=$region;?>" hidden="hidden">
                    <input type="text" name="adress" value="<?=$shop;?>" hidden="hidden">
                    <input type="submit" name="do_signup" value="Сохранить">

                  </form> -->
                  <br>



                  <table class="table table-bordered table-hover">
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

                      $result = mysqli_query($connect, "SELECT data, SUM(summareal), SUM(summazaden), SUM(pribl), COUNT(*)
                                        from sales09  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' GROUP BY data ");

                      $sc = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $sc = $sc + $data1['COUNT(*)'];
                      ?>




                        <tr>

                          <td><a href="detail09.php?region=<?= $region; ?>&shop=<?= $shop; ?>&data_z=<?= $data1['data']; ?>&from=<?=$fromtovar;?>"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
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
                        $result2 = mysqli_query($connect, " SELECT SUM(summareal), SUM(summazaden), SUM(pribl)
                                        from sales09  WHERE region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' ");

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
