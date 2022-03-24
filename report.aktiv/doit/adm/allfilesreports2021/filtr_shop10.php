<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
    $id = $_GET['id'];
    $data = $_GET['data'];
    $adress = $_SESSION['logged_user']->adress;
    $region = $_SESSION['logged_user']->region;
 
   $date1 =$_POST['date1'];
   $date2 =$_POST['date2'];
   $saler =$_POST['saler'];
   $vid =$_POST['vid'];
   $regionshop =$_POST['regionshop'];
   $shopadres =$_POST['shopadres'];
   $fromtovar = $_POST['fromtovar'];
?>

<? include "header.php"; ?>
<? include "menu.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Отчет продавца <?= $saler; ?>, магазин: <?= $regionshop; ?> / <?= $shopadres; ?> за период с <?=date("d.m.Y", strtotime($date1));?> по <?=date("d.m.Y", strtotime($date2));?>,
            <a href="viewshop10.php?region=<?=$regionshop;?>&shop=<?=$shopadres;?>&from=<?=$fromtovar?>">Идем назад</a>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr style="background: #398ebd; color: white;">
                                        <th>Дата</th>
                                        <th>Код товара</th>
                                        <th>Наименование</th>
                                        <th>Приходная сумма</th>
                                        <th>Предоплата</th>
                                        <th>Сумма реализации</th>
                                        <th>Прибыль</th>
                                        <th>Вид</th>
                                        <th>Продавец</th>
                                        <th>Ф.И.О. покупателя</th>
                                    </tr>
                                </thead>
                                <tbody>
                  <?
                      $result = mysqli_query($connect, "SELECT *FROM sales10 WHERE saler ='$saler'  AND fromtovar = '$fromtovar' AND `data` BETWEEN '$date1' AND '$date2'  ");
                      while ($data1 = mysqli_fetch_array($result)) { ?>
                                    <tr>
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
                                    <tr>
                    <?
                        $result2 = mysqli_query($connect, " SELECT SUM(summaprihod), SUM(predoplata), SUM(summareal), SUM(pribl) from sales10 WHERE  saler ='$saler' AND fromtovar = '$fromtovar' AND `data` BETWEEN '$date1' AND '$date2' ");

                        $data2 = mysqli_fetch_array($result2);


                        ?>


                                        <th colspan="3" style="background: #398ebd; color: white;">Итого</th>
                                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(predoplata)'], 0, '.', ' '); ?></th>
                                        <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></th>
                                        <th style="background: #398ebd; color: white;"><em><b><font size="3" color="red" face="Arial"><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></font></b></em></th>

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

<? else : ?>

чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
