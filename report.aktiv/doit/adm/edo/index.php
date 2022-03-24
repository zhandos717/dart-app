<?php
include("../../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $count = R::count('sluzhebki', 'komu = :to_whom  AND statusread = 0',[':to_whom'=> $login]);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Почтовый ящик
        <small><?= $count; ?> новых писем</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Почтовый ящик</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="createMail.php" class="btn btn-primary btn-block margin-bottom">Создать Служебку</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Папки</h3>
              <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">

                <li class="active"><a href="index.php">
                    <i class='fa fa-inbox'></i> Входящие
                    <?= $count  ? " <span class='label label-danger pull-right'> $count </span>" : ''; ?>
                  </a></li>
                <li><a href="sent.php"><i class="fa fa-envelope-o"></i> Отправленные</a></li>
                <?
                $kto = $_SESSION['logged_user']->login;
                if ($kto == 'superadmin') {
                ?>
                  <li><a href="oplachennyie.php"><i class="fa fa-inbox"></i> Оплаченные СЗ </a></li>
                  <li><a href="soglasovannyyie.php"><i class="fa fa-envelope-o"></i> Согласованные СЗ</a></li>
                  <li><a href="otkazannyie.php"><i class="fa fa-envelope-o"></i> Отказанные СЗ</a></li>
                <? } ?>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /. box -->

        </div><!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Входящие служебки</h3>
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                <div class="btn-group">
                  <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div><!-- /.btn-group -->
                <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div><!-- /.btn-group -->
                </div><!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php
                    $komu = $_SESSION['logged_user']->login;
                    $result2 = mysqli_query($connect, "SELECT * FROM sluzhebki WHERE komu = '$komu' AND statusz='1' ORDER BY id DESC");
                    while ($data2 = mysqli_fetch_array($result2)) {
                      $otkovoLogin = $data2['otkovo'];
                      $statusread = $data2['statusread'];
                      if ($statusread == 0) {
                        $tclas = 'fa fa-star text-yellow';
                      } else {
                        $tclas = 'fa fa-star-o text-yellow';
                      }

                      $result3 = mysqli_query($connect, "SELECT * FROM diruser WHERE login = '$otkovoLogin'");
                      $data3 = mysqli_fetch_array($result3);
                      $fio = $data3['fio'];

                    ?>
                      <tr class='<?= $statusread == '0' ? 'bg-red' : ''; ?>'>
                        <td><input type="checkbox"></td>
                        <td class="mailbox-star"><a href="#"><i class="<?= $tclas; ?>"></i></a></td>
                        <td class="mailbox-name">
                          <a style='<?= $statusread == 0 ? 'color:white' : 'color:black'; ?>' href="readMailFrom.php?id=<?= $data2['id']; ?>">
                            <?= $fio; ?>
                          </a>
                        </td>
                        <th class="mailbox-subject">
                          <a title='Открыть' style='<?= $statusread == 0 ? 'color:white' : 'color:black'; ?>' href="readMailFrom.php?id=<?= $data2['id']; ?>">
                            <?= $data2['tema']; ?>
                          </a>
                        </th>
                        <td class="mailbox-attachment">
                          <?= $data2['files'] ? '<i class="fa fa-paperclip"></i>' : ''; ?>
                        </td>
                        <td class="mailbox-date"><i><?= date("d.m.Y", strtotime($data2['date'])); ?> в <?= $data2['time']; ?></i></td>
                      </tr>
                    <? } ?>
                    <!-- <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                          <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                          <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                          <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                          <td class="mailbox-date">28 mins ago</td>
                        </tr> -->
                  </tbody>
                </table><!-- /.table -->
              </div><!-- /.mail-box-messages -->
            </div><!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                <div class="btn-group">
                  <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div><!-- /.btn-group -->
                <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div><!-- /.btn-group -->
                </div><!-- /.pull-right -->
              </div>
            </div>
          </div><!-- /. box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->


<?php include "footer.php";
else :
  header('Location: /index.php');
endif; ?>
