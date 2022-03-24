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
      Магазин <?= $region; ?>-<?= $shop; ?>, ОТЧЕТ за <?= date('d.m.Y'); ?>
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
      <?if($_SESSION['message']):?>
      <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Успех!</h4>
          <?= $_SESSION['message']; ?>
        </div>
      </div>
      <? unset($_SESSION['message']); endif;?>
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr style="background: #398ebd; color: white;">
                    <th>№</th>

                    <th>ДАТА</th>
                    <th>КОД ТОВАРА</th>
                    <th>Адрес филиала</th>
                    <th>ТОВАР</th>
                    <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                    <th>ПРЕДОПЛАТА</th>
                    <th>СУММА РЕАЛИЗАЦИИ</th>
                    <th>ПРИБЫЛЬ</th>
                    <th>ВИД</th>
                    <th>ПРОДАВЕЦ</th>
                    <th>ПОКУПАТЕЛЬ</th>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <?
                      $i = 1;
                      $result = mysqli_query($connect, "SELECT *FROM sales12 WHERE data = '$data_z'  AND region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' AND statustovar IS NULL ");
                      while ($data1 = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <td><?= $i++; ?>.</td>

                    <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                    <td><?= $data1['codetovar']; ?></td>
                    <td>
                      <? echo  $data1['regionlombard'].'/'.$data1['adresslombard']; ?>
                    </td>
                    <td><?= $data1['tovarname']; ?></td>
                    <td><?= number_format($data1['summaprihod'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['predoplata'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['summareal'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data1['pribl'], 0, '.', ' '); ?></td>
                    <td><?= $data1['vid']; ?></td>
                    <td><?= $data1['saler']; ?></td>
                    <td><?= $data1['pokupatel']; ?></td>
                    <td style="white-space: nowrap;">
                      <?if(($_SESSION['logged_user']->root == '23') OR ($_SESSION['logged_user']->root == '33') ):?>

                      <form action="upd_sales12.php" method="post" style="display: inline;">
                        <input type="number" name="id" value="<?= $data1['id']; ?>" hidden>
                        <button name="goup" type="submit" value="RW" class="btn btn-warning" title="Редактировать"> <i class="fa fa-pencil"></i> </button>
                      </form>

                      
                      <?endif;?>
                    </td>
                  </tr>
                  <? } ?>
                </tbody>
                <tfoot>
                  <tr style="background: #d3d7df; color: black;">
                    <?
                        $result2 = mysqli_query($connect, " SELECT id, region, SUM(summaprihod),SUM(predoplata),SUM(summareal),SUM(pribl)
                                        from sales12 WHERE data = '$data_z' AND region = '$region' AND adress = '$shop' AND fromtovar = '$fromtovar' AND statustovar IS NULL ");
                        $data2 = mysqli_fetch_array($result2);
                        ?>
                    <th colspan="5">ИТОГО </th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summaprihod)'], 0, '.', ' '); ?></th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(predoplata)'], 0, '.', ' '); ?></th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(summareal)'], 0, '.', ' '); ?></th>
                    <th style="background: #398ebd; color: white;"><?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?></th>
                    <td colspan="5"></td>
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
<? endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>
чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<? endif; ?>
