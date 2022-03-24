<? //проверка существовании сессии
include("../../bd.php");

if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 11) :

$id = (int) $_GET["id"];
$id = strip_tags($_GET['id']);
$id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);

$result = mysqli_query($connect,"SELECT summa_vydachy,cena_pr from tickets WHERE id = '$id'");
$data = mysqli_fetch_array($result);
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
                <h3 class="box-title">Товары на реализации</h3>
              </div><!-- /.box-header -->
             <div class="box-body">

               <form class="form-horizontal" action="xqrtgmjskdgftrhs.php" method="POST">


                           <div class="box-body">

                             <div class="form-group">
                               <label for="inputPassword3" class="col-sm-2 control-label">Сумма выдачи:</label>
                               <div class="col-sm-10">
                                 <input class="form-control" id="inputPassword3" type="number" name="summa_vydachy" value="<?=$data['summa_vydachy'];?>" readonly>
                               </div>
                             </div>
                                      <input type="text" name="id" value="<?=$id;?>" hidden >

                             <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label">
                                 <font color="red">Сумма на продажу</font>
                               </label>
                               <div class="col-sm-10">
                                 <input class="form-control" id="inputPassword3" type="number" name="cena_pr" >
                               </div>
                             </div>


                           </div><!-- /.box-body -->
                           <div class="box-footer">

                             <button name="do_signup" type="submit" class="btn btn-info pull-right">Сменить</button>
                           </div><!-- /.box-footer -->
                         </form>
              </div><!-- /.box-body -->
            </div><!-- /.box -->


          </div><!-- /.col -->



    </div><!-- /.content-wrapper -->
</section>
</div>
    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :

  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
