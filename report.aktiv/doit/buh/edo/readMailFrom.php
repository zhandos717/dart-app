<?
include("../../../bd.php");
if ($status == 10) :
    include "header.php";
    include "menu.php";
    $id = $_POST['id'];

    $result = mysqli_query($connect, "SELECT * FROM sluzhebki WHERE id = '$id'");
    $data = mysqli_fetch_array($result);

    $otkovoLogin = $data['otkovo'];
    $result3 = mysqli_query($connect, "SELECT * FROM diruser WHERE login = '$otkovoLogin'");
    $data3 = mysqli_fetch_array($result3);
    $fioOtkovo = $data3['fio'];
    $loginotkovo = $data3['login'];

    $resultupd = mysqli_query($connect, "UPDATE sluzhebki SET statusread = 1 WHERE id = '$id'");
    $dataupd = mysqli_fetch_array($resultupd);

    $komu = $_SESSION['logged_user']->login;
    $resultc = mysqli_query($connect, "SELECT COUNT(id) FROM sluzhebki WHERE komu = '$komu' AND statusread = '0'");
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
                    <li><a href="index.php"><i class="fa fa-inbox"></i> Входящие <span class="label label-primary pull-right"><?=$countid;?></span></a></li>
                    <li><a href="sent.php"><i class="fa fa-envelope-o"></i> Отправленные</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->

            </div><!-- /.col -->
            <div class="col-md-9">
             <div class="box box-primary">
               <div class="box-header with-border">
                 <h3 class="box-title">Входящая Служебка</h3>
                 <div class="box-tools pull-right">
                   <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                   <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                 </div>
               </div><!-- /.box-header -->
               <div class="box-body no-padding">
                 <div class="mailbox-read-info">
                   <h3><?=$data['tema'];?></h3>
                   <h5>От: <?=$fioOtkovo;?> <span class="mailbox-read-time pull-right"><?=date("d.m.Y", strtotime($data['date']));?> в <?=$data['time'];?></span></h5>
                 </div><!-- /.mailbox-read-info -->
                 <div class="mailbox-controls with-border text-center">
                   <div class="btn-group">
                     <!-- <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button> -->
                     <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Ответить"><i class="fa fa-reply"></i></button>
                     <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Переслать"><i class="fa fa-share"></i></button>
                   </div><!-- /.btn-group -->
                   <!-- <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button> -->
                 </div><!-- /.mailbox-controls -->
                 <div class="mailbox-read-message">
                   <?=$data['text_sms'];?>
                 </div><!-- /.mailbox-read-message -->
               </div><!-- /.box-body -->
               <div class="box-footer">
                 <ul class="mailbox-attachments clearfix">
                   <?
                   $docs = $data['files'];

                             $c   = str_word_count($docs); //колличество docs
                             $pieces = explode(" ", $docs);
                             for ($i=0; $i <$c ; $i++){
                             ?>
                   <li>
                     <a href="https://report.aktiv-market.kz/docs/<?=$pieces[$i];?>" download=""><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span></a>
                     <div class="mailbox-attachment-info">
                       <a href="https://report.aktiv-market.kz/docs/<?=$pieces[$i];?>" class="mailbox-attachment-name" download=""><i class="fa fa-paperclip"></i> <?=$pieces[$i];?></a>
                       <span class="mailbox-attachment-size">
                         1,245 KB
                         <a href="https://report.aktiv-market.kz/docs/<?=$pieces[$i];?>" download="" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                       </span>
                     </div>
                   </li>
                   <?}?>
                 </ul>
               </div><!-- /.box-footer -->
               <div class="box-footer">
                 <div class="pull-right">


                   <table>

                     <tr>
                       <td>
                         <form class="" action="oplacheno.php" method="post">
                           <input type="text" hidden="hidden" name="id" value="<?=$id;?>">
                           <button name="resend" value="true" class="btn btn-danger"><i class="fa fa-reply"></i> Оплачено</button>
                         </form>
                       </td>
                       <td>&nbsp;</td>
                       <td><form class="" action="reSend.php" method="post">
                         <input type="text" hidden="hidden" name="id" value="<?=$id;?>">
                         <input type="text" hidden="hidden" name="fioOtkovo" value="<?=$fioOtkovo;?>">
                         <button name="resend" value="true" class="btn btn-default"><i class="fa fa-reply"></i> Переслать</button>
                         <!-- <button name="answerto" value="true" class="btn btn-default"><i class="fa fa-share"></i> Ответить</button> -->
                       </form>
                     </td>
                     <td>&nbsp;</td>
                     <td><form class="" action="answerto.php" method="post">
                         <input type="text" hidden="hidden" name="id" value="<?=$id;?>">
                         <input type="text" hidden="hidden" name="fioOtkovo" value="<?=$fioOtkovo;?>">
                         <input type="text" hidden="hidden" name="loginotkovo" value="<?=$loginotkovo;?>">
                         <!-- <button name="resend" value="true" class="btn btn-default"><i class="fa fa-reply"></i> Переслать</button> -->
                         <button name="answerto" value="true" class="btn btn-default"><i class="fa fa-share"></i> Ответить</button>
                       </form>
                     </td>
                     </tr>
                   </table>
                   <!-- <button class="btn btn-default"><i class="fa fa-reply"></i> Переслать</button> -->
                   <!-- <button class="btn btn-default"><i class="fa fa-share"></i> Ответить</button> -->
                 </div>
                 <!-- <button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                 <button class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->
               </div><!-- /.box-footer -->
             </div><!-- /. box -->
           </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<? include "footer.php";
else :
    header('Location: /index.php');
endif; ?>