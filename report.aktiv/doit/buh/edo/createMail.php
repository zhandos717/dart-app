<?
include("../../../bd.php");
if ($status == 10) :
    include "header.php";
    include "menu.php";
    $login = $_SESSION['logged_user']->login;

    $resultc = mysqli_query($connect, "SELECT COUNT(id) FROM sluzhebki WHERE komu = '$login' AND statusread = '0'");
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
              <a href="index.php" class="btn btn-primary btn-block margin-bottom">Во входящие</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Папки</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="index.php"><i class="fa fa-inbox"></i> Входящие <span class="label label-primary pull-right"><?=$countid;?></span></a></li>
                    <li><a href="sent.php"><i class="fa fa-envelope-o"></i> Отправленные</a></li>
                    <!-- <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>
                    <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Создать новое сообщение</h3>
                </div><!-- /.box-header -->
                <form action="sendTo.php" method="post" enctype="multipart/form-data">


                <div class="box-body">
                  <div class="form-group">
                    <select name="komu" class="form-control select2" style="width: 100%;" required="required">
                      <option disabled>Выберите контакт кому нужно написать</option>
                      <?
                      $resultu = mysqli_query($connect, "SELECT id,login,fio,doljnost,region,adress FROM diruser WHERE status = 3   ");
                      while ( $datau = mysqli_fetch_array($resultu))
                            {
                              ?>
                              <option value="<?=$datau['login']?>"><?=$datau['fio']?>(<?=$datau['doljnost']?>)</option>
                          <?}?>

                    </select>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="tema" placeholder="Тема:" required="required">
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" name="textSms" class="form-control" style="height: 300px"></textarea>
                  </div>
                  <div class="form-group">
                    <input  multiple="true" type="file" class="form-control" id="file" name="file[]">
                  </div>
                  <!-- <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Вложение
                      <input required="required" multiple="true" type="file" class="form-control" id="file" name="file[]">
                    </div>
                    <p class="help-block">Max. 32MB</p>
                  </div> -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <!-- <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
                    <button type="submit" name="gopismo" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Отправить</button>
                  </div>
                  <!-- <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button> -->
                </div><!-- /.box-footer -->
                </form>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<? include "footer.php";
else :
    header('Location: /index.php');
endif; ?>
