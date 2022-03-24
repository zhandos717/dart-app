    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет в разрезе сотрудников <span class="label label-danger">ONE BILLION SALES</span>
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
            <div class="box box-success">
              <div class="box-body">
                <form action="a_report_commiss.php?id=5" method="post">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group">
                      <input type="date" class="form-control" id="date1" style="width: 16rem;" min="2020-08-19" max="<?= date('Y-m-d'); ?>" value="<?= $data1; ?>" name="date1">
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group">
                      <input type="date" class="form-control" id="date2" style="width: 16rem;" min="2020-08-19" max="<?= date('Y-m-d'); ?>" value="<?= $data2; ?>" name="date2">
                    </div>
                  </div>
                  <div class="input-group input-group-sm">
                    <button type="submit" class="btn-success btn ">Подтвердить!</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="box box-primary">
              <!--<div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div> /.box-header -->
              <div class="box-body">
                <div class="">
                  <!--table-responsive-->
                  <table id="datatable-tabletools" class="table table-hover table-bordered ">
                    <thead>
                      <tr>
                        <th>Сотрудник</th>
                        <th>Сумма выдачи</th>
                        <th>Комиссионный сбор</th>
                        <th>Количество клиентов</th>
                        <th>Сумма прибыли <br> от продажи</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $result = R::getAll("SELECT eo, SUM(summa_vydachy),SUM(cena_pr),SUM(p1), COUNT(*) 
                      FROM tickets 
                      WHERE NOT (status = '1' OR status = '11' ) 
                      AND NOT region = 'Актобе'
                      AND NOT region = 'Актау'
                      AND NOT region = 'Атырау'
                      AND NOT region = 'Шымкент'
                      AND NOT region = 'Тараз'
                      AND NOT region = 'Семей'
                      AND NOT region = 'Талдыкорган'
                      AND NOT region = 'Уральск'
                      AND NOT region = 'Алматы'
                      AND dataseg BETWEEN '$data1' AND '$data2' GROUP BY eo ");
                    foreach($result as $data){
                      $eo = $data['eo'];
                      $result1 = R::getAll("SELECT SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE status = '5'  AND eo = '$eo' AND datesale BETWEEN '$data1' AND '$data2' ");
                      $data11 = $result1[0];
                    ?>  
                      <tr> 
                        <td><?= $data['eo']; ?> </td>
                        <td> <?= $data['SUM(summa_vydachy)']; ?> </td>
                        <td> <?= $data['SUM(p1)']; ?> </td>
                        <td> <?= $data['COUNT(*)']; ?> </td>
                        <td> <?= $data11['SUM(cena_pr)'] - $data11['SUM(summa_vydachy)']; ?> </td>
                      </tr>
                      <?}?>  
                    </tbody>
                  </table> 
                </div><!-- /.table-responsive -->
              </div><!-- /.box-body -->
            </div><!-- /.box box-primary -->
          </div><!-- /.col-md-6 -->
        </div><!-- /.content-wrapper -->
      </section>
    </div>
    <script>
      $(document).ready(function() {
        var date1 = $('#date1').val();
        var date2 = $('#date2').val();
        $('.btn-block').click(function() {
          var eo = $(this).val();
          $.post("report_commiss/eo/report.php", {
              eo: eo,
              date1: date1,
              date2: date2
            })
            .done(function(data) {
              alert("Ответ сервера:  " + data);
            });
          //alert("Data Loaded: " + eo + date1 + date2);
        });
      });
    </script>