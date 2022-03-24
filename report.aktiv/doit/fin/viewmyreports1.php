<? include("../../bd.php");
if (isset($_SESSION['logged_user'])) :
  if ($_SESSION['logged_user']->status == 11) :

  $thisDate = strip_tags(date('Y-m-d'));
  $region = strip_tags(htmlspecialchars($_REQUEST['region']));
  $adress = htmlspecialchars($_REQUEST['adress']);

    if(empty($_REQUEST['today'])){

    $today = date('Y-m-d', strtotime($thisDate. " - 1 day"));
    }else{
      $today = $_REQUEST['today'];
    };


 if((!empty($region)) AND ($adress != 'Все')){
    $result56 = mysqli_query($connect,"SELECT *from tickets WHERE (status = '7' OR status = '10' OR status = '14'OR status = '15') AND  region= '$region' AND  adressfil='$adress' AND dv = '$today' ");
    $cc = 'Входждение не найдено';
  }elseif((!empty($region)) AND ($adress == 'Все')){
    $result56 = mysqli_query($connect,"SELECT *from tickets WHERE (status = '7' OR status = '10' OR status = '14'OR status = '15') AND  region= '$region'  AND dv = '$today' ");
    $cc = 'Входждение найдено';
  }
  else { 
    $result56 = mysqli_query($connect,"SELECT *from tickets WHERE dv = '$today' AND (status = '7' OR status = '10' OR status = '14'OR status = '15') ");
  }
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol>
      </section>
      <br>
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
                    <?if(!empty($region)):?>  <option value="<?= $region;?>"><?= $region;?></option>  <?endif;?>
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
           <div class="col-lg-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                  </span>
                  <input type="date" name="today" value="<?= $today;?>"  class="form-control" >
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
                <h3 class="box-title">Товары на исполнении <?=$adress;?>. Вышедшие на продажу <b><?= date('d.m.Y',strtotime($today));?></b> </h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
              </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                      <p><?= $cc;?></p>

                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr class="info">
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
                                <td style="width:15rem;">
                                <form action="update_cena.php" method="POST">
                                  <input type="text" name="region" value="<?= $region;?>"  hidden >
                                  <input type="text" name="adress" value="<?= $adress;?>"  hidden >
                                  <input type="date" name="today" value="<?= $today;?>"  hidden >
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
