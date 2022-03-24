<?php
include("../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $id = (int) $_POST["id"];
  $id = strip_tags($_POST['id']);
  $id = htmlentities($_POST['id'], ENT_QUOTES, "UTF-8");
  $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
  $results = mysqli_query($connect, "SELECT * FROM rashodfillial WHERE id = '$id'  ");
  $datas = mysqli_fetch_array($results);
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
    <section class="content" id="app">
      <!-- v-cloak -->
<!-- <a href="filtrRashod.php" class="btn btn-block btn-primary">Фильтр по расходам</a> -->


      <div class="col-md-6">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#branches" data-toggle="tab">Расходы по филиально</a></li>
            <!-- <li><a href="#regions" data-toggle="tab">Расходы по городам</a></li>
            <li class="active"><a href="#country" data-toggle="tab">За Казахстан</a></li> -->
            <li class="pull-left header"><i class="fa fa-th"></i> Расходы  </li>
          </ul>
          <div class="tab-content">


            <div class="tab-pane active" id="branches">
              <form action="rashody/redakRashod2.php" method="post">
                <input type="text" name="id" value="<?=$datas['id'];?>" hidden="hidden">
                <div class="form-group">
                  <input class="form-control" type="date" name="datarashoda" value="<?=$datas['datarashoda'];?>" required="required">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" readonly="readonly" name="region" value="<?=$datas['region'];?>">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" readonly="readonly" name="adress" value="<?=$datas['adress'];?>">
                </div>



                <div class="form-group">
                  <input class="form-control" required="required" type="number" name="summarf" value="<?=$datas['summarf'];?>">
                </div><!-- /.tab-pane -->
                <div class="form-group">
                  <input class="form-control" type="text" value="<?=$datas['comments'];?>" name="comments" required="required">
                </div>
                <!-- <button class="btn btn-warning btn-block">Подтверить расход</button> -->
                <input class="btn btn-warning btn-block" type="submit" name="rashodfill" value="Подтверить расход для филиала">
              </form>
            </div>

          </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
      </div><!-- /.col -->





    </section>



  </div>

<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>
