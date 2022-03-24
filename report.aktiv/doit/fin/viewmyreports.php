<? //проверка существовании сессии
include("../../bd.php");

if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 11) :


    // $client  = @$_SERVER['HTTP_CLIENT_IP'];
    // $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    // $remote  = @$_SERVER['REMOTE_ADDR'];
    //
    // if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    // elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    // else $ip = $remote;
    //
    // $id = $_POST['id'];
    // $cena_prod = R::load('tickets',$id);
    // $cena_prod->cena_old = $cena_prod['cena_pr'];
    // $cena_prod->cena_update =date('Y-m-d H:i:s');
    // $cena_prod->cena_updateuser = $_SESSION['logged_user']->fio;
    // $cena_prod->cena_ip=$ip;
    // $cena_prod->cena_pr =$_POST['cena_pr'];
    // R::store($cena_prod);
    // $result = mysqli_query($connect," UPDATE tickets SET cena_pr = '$cena_pr'  WHERE id = '$id' ");
    // $data = mysqli_fetch_array($result);
    /*********************************************************************/
    $today = date("Y-m-d");
    $region = $_POST['region'];
    $adress = $_POST['adress'];
  if($region AND $adress){
    $result56 = mysqli_query($connect,"SELECT *from tickets WHERE (status = '7' OR status = '10' OR status = '14'OR status = '15') AND  region= '$region' AND  adressfil='$adress'");
    $result = mysqli_query($connect,"SELECT *from tickets WHERE status = '5' AND  region= '$region' AND  adressfil='$adress'");
  }else {
    $result56 = mysqli_query($connect,"SELECT *from tickets WHERE (status = '7' OR status = '10' OR status = '14'OR status = '15')");
    $result = mysqli_query($connect,"SELECT *from tickets WHERE status = '5'");
  }
 
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
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
                <h3 class="box-title">Выберите филиал </h3>
                <div class="box-tools pull-right">
              </div>
              </div><!-- /.box-header -->
              <div class="box-body">

                <form action="viewmyreports.php" method="POST">
                  <div class="col-lg-3">
                    <div class="input-group">
                  <span class="input-group-addon">
                  <i class="fa fa-bank"></i>
                  </span>
                  <select class="form-control"  id="List1" name="region">
                    <option value="">Все</option>
                    <option value="Нур-султан">Нур-султан</option>
                    <option value="Актау">Актау</option>
                    <option value="Актобе">Актобе</option>
                    <option value="Алматы">Алматы</option>
                    <option value="Атырау">Атырау</option>
                    <option value="Караганда">Караганда</option>
                    <option value="Кокшетау">Кокшетау</option>
                    <option value="Костанай">Костанай</option>
                    <option value="Павлодар">Павлодар</option>
                    <option value="Семей">Семей</option>
                    <option value="Талдыкорган">Талдыкорган</option>
                    <option value="Тараз">Тараз</option>
                    <option value="Шымкент">Шымкент</option>
                  </select>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                  </span>
                  <select class="form-control"  id="List2" name="adress"></select>
            </div>
            <!-- /input-group -->
          </div>
          <div class="col-lg-2">
            <div class="input-group">
                  <button type="submit" class="btn btn-block btn-primary btn-sm">Подтвердить</button>
            </div>
            <!-- /input-group -->
          </div>

               </form>

              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->


        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Товары на исполнении <?=$adress;?></h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
              </div>
              </div><!-- /.box-header -->
              <div class="box-body">

                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style="background: #398ebd; color: white;">
                                <th>№ЗБ</th>
                                <th style="width:10rem;">Клиент</th>
                                <th>Контакты</th>
                                <th style="width:35rem;">Залог</th>
                                <th style="width:15rem;">Сумма выдачи</th>
                                <th style="width:10rem;">Сумма продажи</th>
                                <th style="width:10rem;">Остаточная стоимость</th>
                                <th style="width:10rem;">Прибыль</th>
                                <th style="width:5rem;">Дата выдачи</th>
                                <th style="width:8rem;">Дата выхода на реализацию</th>
                                <th style="width:8rem;">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                while ($data_zb = mysqli_fetch_array($result56)) {
                                    $stzb = $data_zb['status'];
                                    $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
                                    $data_st = mysqli_fetch_array($result2);
                                    $statuszb = $data_st['name'];
                                ?>
                            <tr>
                                <td > <a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= $data_zb['nomerzb']; ?></a> </td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= $data_zb['fio']; ?></td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= $data_zb['phones']; ?></td>
                                  <td>  <?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['opisanie']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['sostoyanie_bu']; ?>  <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?>
                                     SN: <?= $data_zb['sn']; ?>, IMEI:<?= $data_zb['imei']; ?>, <?= $data_zb['complect']; ?>
                                   </td>


                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                                <td>
                                <form action="update_cena.php" method="POST">
                                  <div class="input-group input-group-sm">
                                    <input type="number" name="id" hidden value="<?=$data_zb['id'];?>">
                                  <input type="text" class="form-control" name="cena_pr" value="<?=$data_zb['cena_pr'];?>">
                                  <span class="input-group-btn">
                                    <button class="btn btn-danger btn-flat" type="submit"><i class="fa fa-check"></i></button>
                                  </span>
                                  </div><!-- /input-group -->
                                </form>
                                </td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= number_format($data_zb['zadatok'], 0, '.', ' '); ?></td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= number_format($data_zb['cena_pr']-$data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                                <td><a style="color:black;" href="view_ticket.php?id=<?= $data_zb['id']; ?>"> <?= $statuszb; ?></td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                  </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->


      </section>
    </div><!-- /.content-wrapper -->
    <? unset($region, $adress); include "footer.php"; ?>

  <?php endif; ?>

<? else :

  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
