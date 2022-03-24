<? //проверка существовании сессии
include("../../bd.php");

  if ($_SESSION['logged_user']->status == 11) :


    include "header.php";
    include "menu.php";


      if($_GET['idupd']){

        $idB = $_GET['idupd'];
        $result = mysqli_query($connect, "SELECT * FROM torgitable WHERE id = '$idB'");
        $data8 = mysqli_fetch_array($result);
      };
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет по торгам
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">

        <? if($_SESSION['message']){?>

          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-success alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <h4>	<i class="icon fa fa-check"></i> Успех!</h4>
                           <?=$_SESSION['message'];?>
                         </div>
            </div>
          </div>

        <?};
        unset($_SESSION['message']);
        if($_SESSION['errors']){?>

          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-danger alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <h4>	<i class="icon fa fa-ban"></i> Ошибка!</h4>
                           <?=$_SESSION['errors'];?>
                         </div>
            </div>
          </div>
        <?};  unset($_SESSION['errors']);?>


        <div class="row">
          <div class="col-xs-12">
            <!-- TO DO List -->
         <div class="box box-primary">
           <div class="box-header">
             <i class="ion ion-clipboard"></i>
             <h3 class="box-title">Таблица торгов</h3>
             <div class="box-tools pull-right">
               <!-- <ul class="pagination pagination-sm inline">
                 <li><a href="#">&laquo;</a></li>
                 <li><a href="#">1</a></li>
                 <li><a href="#">2</a></li>
                 <li><a href="#">3</a></li>
                 <li><a href="#">&raquo;</a></li>
               </ul> -->
             </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive" > <!--->  <!-->
                <table class="table table-bordered table-hover" id='example1'>
                  <thead>
                    <tr>
                      <th>№</th>
                      <th>Дата</th>
                      <th>Сумма</th>
                      <th>Количество товаров</th>
                      <th>Примечание</th>
                      <th>Файлы</th>
                      <!-- <th>Cтатус</th> -->
                      <th>Пользователь</th>
                      <th>Действие</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $result = mysqli_query($connect, "SELECT * FROM torgitable WHERE NOT status='3' ORDER BY id ASC ");

                    $result1 = mysqli_query($connect, "SELECT SUM(summatorg), COUNT(*),SUM(koltorg) FROM torgitable WHERE NOT status='3' ORDER BY id ASC ");
                    $data1 = mysqli_fetch_array($result1);
                    $i = 1;
                    while ($data = mysqli_fetch_array($result)) {?>
                      <tr>
                        <td><?=$i++;?>.</td>
                        <td><?=$data['datetorg'];?></td>
                        <td><?=$data['summatorg'];?></td>
                        <td><?=$data['koltorg'];?></td>
                        <td>  <?=$data['comment'];?></td>
                        <td>

                          <?php
                          // разбиваем имя файла по точке и получаем массив
                          $getMime = explode('.', $data['filename']);
                          // нас интересует последний элемент массива - расширение
                          $mime = strtolower(end($getMime));
                          // объявим массив допустимых расширений
                          $images = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
                          $doc = array('docx', 'dotm','dotx','docx','doc','dot');
                          $pdf = array('pdf', 'psd','DjVu');
                          $exel = array('xlam','xlsb','xltm','xltx','xlsm','xlsx','xlx','xlt','xla');
                          $types = array('xlam','xlsb','xltm','xltx','xlsm','pdf', 'psd','DjVu','docx', 'dotm','dotx','docx','doc','dot','jpg', 'png', 'gif', 'bmp', 'jpeg');

                          if(in_array($mime, $images))
                          { $type ='camera';
                            $color = 'default';
                          }
                          elseif (in_array($mime, $doc)) {
                            $type ='file-word-o';
                            $color = 'info';
                          }
                          elseif (in_array($mime, $pdf)) {
                            $type ='file-pdf-o';
                            $color = 'danger';
                          }
                          elseif (in_array($mime, $exel)) {
                            $type ='file-excel-o';
                            $color = 'success';
                          }
                          elseif (in_array($mime, $types)) {
                            $type ='file';
                            $color = 'warning';
                          };

                          if($data['filename']){?>
                            <a class='btn btn-<?=$color;?>' title="<?=$data['filename']?>"  href="<?=$data['file']?>" download > <i class='fa fa-<?=$type;?>'></i> </a>
                        <?};?>

                        </td>
                        <td><?=$data['user'];?></td>
                        <td>
                          <a class="btn btn-social-icon btn-vk" href="report_fin.php?idupd=<?=$data['id'];?>"  ><i class="fa fa-wrench"></i></i></a>
                          <a class="btn btn-social-icon btn-google" href="functions/add_torgi.php?iddeleted=<?=$data['id'];?>"  title="Удалить" ><i class="fa fa-times-circle"></i></a>
                        </td>
                      </tr>
                    <?}?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="2" class="text-center">Итог:</th>
                      <td ><?=$data1['SUM(summatorg)'];?></td>
                      <td > <?=$data1['SUM(koltorg)'];?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
             </div>
           </div>
           <!-- /.box-body -->
           <div class="box-footer clearfix no-border">
             <!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button> -->
           </div>
         </div>
         <!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.content-wrapper -->

        <div class="row">
          <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"> Форма отчета</h3>
            </div>
            <div class="box-body">
            <form role="form" action="functions/add_torgi.php" enctype="multipart/form-data" method="POST">

              <div class="row">

                <?if($data8['datetorg']){
                echo '<input type="text" hidden name="idupd" value="'.$data8['id'].'">';
                }else {
                echo '<input type="number" name="token" hidden value="65465465">';
                }?>

                <div class="col-xs-12 col-md-4 col-lg-4 col-4">
                    <label for="exampleInputEmail1">Дата проведения торгов</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Иванов Иван" required value="<?=$data8['datetorg'];?>" name="date_torg">
                </div>

                <div class="col-xs-12 col-md-4 col-lg-4 col-4">
                  <label for="exampleInputEmail1">Сумма</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="1 000 000 $" value="<?=$data8['summatorg'];?>" name="summa_torg">
                </div>

                <div class="col-xs-12 col-md-4 col-lg-4 col-4">
                  <label for="exampleInputEmail1">Количество товаров </label>
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="99" value="<?=$data8['koltorg'];?>" name="kol_torg">
                </div>

              </div>
              <br>
              <div class="row">
                <div class="col-md-9 col-lg-6 col-6">
                  <label for="exampleInputEmail1">Примечение </label>
                    <textarea name="text" class="form-control" ><?=$data8['comment'];;?></textarea>
                  </div>

                  <div class="col-xs-3 col-md-6 col-lg-6 col-6">
                    <label for="exampleInputEmail1">Файл для отправки </label>
                    <input type="file" multiple name="file">
                  </div>
                </div>
              <br>
              <div class="row">
              <div class="col-xs-12 col-md-6 col-lg-6 col-6">
                <button type="submit" class="btn bg-olive " name="do_signup"> <i class="fa fa-check"></i> Отправить</button>
              </div>
              </div>
              <br>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
        </div>
      </section>
    </div>
    <? include "footer.php";
    
    else :
header('location: /');
endif; ?>
