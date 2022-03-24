
<? //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_POST['region'];
          $adress = $_POST['adress'];
          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];
  if($_POST['date1'] AND $_POST['date2']){
                                      $data1 = $_POST['date1'];
                                      $data2 = $_POST['date2'];
                                    } else {
                                      $data1 = '2020-08-19';
                                      $data2 = $today;
                                    };


    $result12 = mysqli_query($connect,"SELECT *FROM tickets WHERE dataseg BETWEEN '$data1' AND '$data2' AND NOT status = '11' OR status = '1'");

?>
    <script type="text/javascript" src="linkedselect.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет по договорам комиссии (ДК)
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
          <div class="col-md-12">
             <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title">Выберите период</h3>

                   <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                     <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                   </div>
                 </div>
                 <div class="box-body">
                   <form action="a_report.php?id=3" method="POST">
                     <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?=$today;?>" value="<?=$data1;?>" name="date1">
                        </div>
                        <!-- /input-group -->
                     </div>

                      <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?=$today;?>" value="<?=$data2;?>" name="date2">
                        </div>
                        <!-- /input-group -->
                     </div>
                                       <div class="input-group input-group-sm">
                                           <!-- <span class="input-group-btn">     </span> -->
                                             <button type="submit" class="btn-success btn ">Подтвердить!</button>
                                     </div>
                                     </form>
                      </div><!--.box-body -->
                   </div> <!--.box -->
                 </div>
          <!--------------------------------------------------------------------------->
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title text-center"><b> Отчет комисcионного магазина c <?= date("d.m.Y", strtotime($data1)); ?> по  <?= date("d.m.Y", strtotime($data2)); ?>  </b></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                          <th rowspan="2">№</th>
                          <th rowspan="2">дата</th>
                          <th rowspan="2" style="width:20rem;">касса (склад)</th>
                          <th colspan="7">Комитент</th>
                          <th  colspan="3">Расторжение договора комитентом</th>
                          <th  colspan="4">Реализация Физическому лицу</th>
                        </tr>
                        <tr>
                          <th>ФИО</th>
                          <th>Осн номенклатурная группа</th>
                          <th>количество</th>
                          <th>сумма кредита</th>
                          <th>Сумма выдачи</th>
                          <th>0,5% комиссия</th>
                          <th>дата возврата</th>
                          <th>Сумма возврата</th>
                          <th> вознагр 1%</th>
                          <th>дата продажи</th>
                          <th>сумма продажи</th>
                          <th>прибыль</th>
                          <th>убыток</th>
                        </tr>
