<?
include("../../../bd.php");
if ($status == 10) :
    include "header.php";
    include "menu.php";
    $otkovo = $_SESSION['logged_user']->login;
    $resultc = mysqli_query($connect, "SELECT COUNT(id) FROM sluzhebki WHERE komu = '$otkovo' AND statusread = '0'");
    $datac = mysqli_fetch_array($resultc);
    $countid = $datac['COUNT(id)'];
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Почтовый ящик
            <small><?=$countid;?> новых писем</small>
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
                    <li><a href="index.php"><i class="fa fa-inbox"></i> Согласованные <span class="label label-primary pull-right"><?=$countid;?></span></a></li>
                    <li><a href="oplachennyie.php"><i class="fa fa-file-text-o"></i> Оплаченные <span class="label label-primary pull-right"><?=$countido;?></span></a></li>

                    <li class="active"><a href="sent.php"><i class="fa fa-envelope-o"></i> Отправленные</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Отправленные служебки</h3>
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
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
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
                        <?
                        $result2 = mysqli_query($connect, "SELECT * FROM sluzhebki WHERE otkovo = '$otkovo' ORDER BY id DESC ");
                        while ( $data2 = mysqli_fetch_array($result2))
                              {
                                $komuLogin = $data2['komu'];
                                $result3 = mysqli_query($connect, "SELECT * FROM diruser WHERE login = '$komuLogin'");
                                $data3 = mysqli_fetch_array($result3);
                                $fio = $data3['fio'];

                                ?>
                        <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-star"><i class="fa fa-star "></i></td>
                          <td class="mailbox-name"><?=$fio;?></td>
                          <td class="mailbox-subject"><b>
                            <form class="" action="readMail.php" method="post">
                              <input type="text" name="id" hidden="hidden" value="<?=$data2['id'];?>">
                              <input type="submit" name="readtext" class="btn btn-block btn-warning btn-xs" value="<?=$data2['tema'];?>">
                            </form>

                          </b></td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date"><?=date("d.m.Y", strtotime($data2['date']));?> в <?=$data2['time'];?></td>
                        </tr>
                        <?}?>
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
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
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


<? include "footer.php";
else :
    header('Location: /index.php');
endif; ?>
