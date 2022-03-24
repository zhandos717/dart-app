<?php
include("../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $region = $_GET['region'];
  $result = mysqli_query($connect, "SELECT * FROM rashodregion WHERE region = '$region'");
  $data = mysqli_fetch_array($result);
  ?>
<script type="text/javascript" src="linkedselect.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Расходы
      </h1>
    </section>
    <!-- Main content -->




    <section class="content">
              <div class="row">
                <div class="col-md-6">
                  <div class="box">
                    <form class="" action="rashody/reRashodRegion.php" method="post">
                      <input type="text" name="region" value="<?=$region;?>">
                    <div class="box-header with-border">
                      <h3 class="box-title">Расходы г. <?=$region;?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <input type="text" name="summarg" value="<?=$data['summarg']?>" class="form-control">
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <ul class="pagination pagination-sm no-margin pull-right">
                        <input type="submit" name="" value="Сохранить" class="btn btn-block btn-primary">
                      </ul>
                    </div>
                    </form>
                  </div><!-- /.box -->


                </div><!-- /.col -->

              </div><!-- /.row -->

            </section><!-- /.content -->


  </div>

<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>
