<?
  include "mainsql.php";
  include "bisql.php";
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Отчет за ФЕВРАЛЬ 2022
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li><a href="index.php">Регионы</a></li>
      <li class="active">Филиалы</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= number_format($chistaya, 0, '.', ' '); ?> тг</h3>
            <p>ЧИСТАЯ ПРИБЫЛЬ</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= number_format($auktech, 0, '.', ' ');; ?> тг</h3>
            <p>АУКЦИОНИСТ ТЕХНИКА</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?= number_format($aukshuba, 0, '.', ' ');; ?> тг</h3>
            <p>АУКЦИОНИСТ ШУБА</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
          <div class="inner">
            <h3><?= number_format($nalvzaloge, 0, '.', ' ');; ?> тг</h3>
            <p>НАЛИЧНЫЕ В ЗАЛОГЕ</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  <!-- </section> -->
  <!-- <section class="content"> -->
             <div class="row">
               <div class="col-md-6">
                 <!-- <? echo " auktech3 = ".$auktech3;?>
                 <? echo " aukshuba3= ".$aukshuba3;?>
                 <? echo " nalvzaloge3= ".$nalvzaloge3;?>
                 <? echo " chistaya3= ".$chistaya3;?><br>


                 <? echo " auktech4 = ".$auktech4;?>
                 <? echo " aukshuba4= ".$aukshuba4;?>
                 <? echo " nalvzaloge4= ".$nalvzaloge4;?>
                 <? echo " chistaya4= ".$chistaya4;?><br>


                 <? echo " auktech5 = ".$auktech5;?>
                 <? echo " aukshuba5= ".$aukshuba5;?>
                 <? echo " nalvzaloge5= ".$nalvzaloge5;?>
                 <? echo " chistaya5= ".$chistaya5;?><br> -->


                 <div class="box box-primary">
                   <div class="box-header with-border">
                     <h3 class="box-title">Аукционист техники</h3>
                   </div>
                   <div class="box-body">
                     <div class="chart">
                       <canvas id="areaChart" style="height:250px"></canvas>
                     </div>
                   </div>
                 </div>


                 <div class="box box-primary">
                   <div class="box-header with-border">
                     <h3 class="box-title">Чистая прибыль</h3>
                   </div>
                   <div class="box-body">
                     <div class="chart4">
                       <canvas id="areaChart4" style="height:250px"></canvas>
                     </div>
                   </div>
                 </div>




               </div><!-- end class="col-md-6" -->

               <div class="col-md-6">
                 <div class="box box-primary">
                   <div class="box-header with-border">
                     <h3 class="box-title">Аукционист шубы</h3>
                   </div>
                   <div class="box-body">
                     <div class="chart2">
                       <canvas id="areaChart2" style="height:250px"></canvas>
                     </div>
                   </div>
                 </div>

                 <div class="box box-primary">
                   <div class="box-header with-border">
                     <h3 class="box-title">Нал в залоге</h3>

                   </div>
                   <div class="box-body">
                     <div class="chart3">
                       <canvas id="areaChart3" style="height:250px"></canvas>
                     </div>
                   </div>
                 </div>


               </div><!-- end div="col-md-6" -->
             </div><!--class="row"-->
  </section>
</div><!-- /.content-wrapper -->
<? include "bianalize.php"; ?>
