<? //проверка существовании сессии
include("../../../bd.php");

  if ($_SESSION['logged_user']->status == 3) :
    $active_lombard = 'active';
    $adress = $_GET['adress'];
    $region = $_GET['region'];

?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->

    <script type="text/javascript" class="init">

        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
            </script>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $region; ?>/<?= $adress; ?>
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
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Отчет за февраль 2021</h3>
              </div><!-- /.box-header -->
              <div class="box-body">

                <div class="table-responsive">
                  <table id="example" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white; white-space:nowrap;">
                        <th style="width: 10px; ">#</th>
                        <th>Дата</th>
                        <th>Доход ломбард</th>
                        <th>Доход магазин</th>
                        <th>ДОХОД КОМИССИОНКИ</th>
                        <th>Доп доход</th>
                        <th>Доход</th>
                        <th>Стабильные расходы</th>
                        <th>Текущие расходы</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Чистая прибыль (-20%)</th>
                        <th>ЕЖЕДНЕВНЫЙ ПЛАН</th>
                        <th>% Выполнения <br> плана</th>
                        <th>% + - </th>
                        <th>Все клиенты</th>
                        <th>Новые клиенты</th>
                        <th>Выдача за сутки</th>
                        <!--  <th>Возврат</th>
                        <th>Накладные</th> -->
                        <th>Чистая выдача</th>
                        <th>Аукционист техника</th>
                        <th>Аукционист шубы</th>
                        <th>Нал в залоге</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?

                      $result = mysqli_query($connect, "SELECT *FROM reports022021 WHERE `region`='$region' AND `adress`='$adress' ORDER BY data ");

                      $resultpl = mysqli_query($connect, "SELECT *FROM planlombard WHERE `region`='$region' AND `adress`='$adress'");
                      $datapl = mysqli_fetch_array($resultpl);
                      $planden = $datapl['plan']/30;    //еждневный план = Ежемесячный план деленная на 30 дней

                      $summaplanvden = 0; $summaprocent = 0; $kolvozap = 0; $q = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $summaplanvden = $summaplanvden + $planden;   //сумма плана в день
                        $procent = ($data1['dohod']*100)/$planden;                // процент выполнения плана
                        $summaprocent = $summaprocent + $procent;   //общая сумма процентов выполнения плана

                        $kolvozap = $kolvozap +1;
                        $sredsummapr = $summaprocent/$kolvozap;  // средняя сумма процента

                        $pm =  $procent - 100;  // +- на сколько отстает от плана или перевыполняет



                        ?>

                        <tr style="white-space:nowrap;">
                          <td><a href="look02.php?id=<?= $data1['id']; ?>"><i class="fa fa-pencil"></i></a></td>
                          <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                          <td><?= number_format($data1['dl'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dm'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dk'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dop'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['dohod'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['stabrashod'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['tekrashod'], 0, '.', ' '); ?>

                            <?
                            if (strlen($data1['comment']) != 0) echo '<font style="color:red">+</font>';

                            ?>



                          </td>

                          <?
                          $pribl = $data1['dohod'] - $data1['stabrashod'] - $data1['tekrashod'];
                          $pr20 = ($pribl * 20) / 100;
                          $chistpribl = $pribl - $pr20;

                          ?>

                          <td><strong><?= number_format($pribl, 0, '.', ' '); ?></strong></td>
                          <td><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
                          <td><?= number_format($planden, 0, '.', ' '); ?></td>
                          <td><?= number_format($procent, 0, '.', ' '); ?> %</td>
                          <td><b><font size="2" color="red" face="Arial"><?= number_format($pm, 0, '.', ' '); ?> %</font></b></td>
                          <td><?= number_format($data1['allclients'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['newclients'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['vzs'], 0, '.', ' '); ?></td>
                          <!--   <td><?= number_format($data1['vozvrat'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['nakladnoy'], 0, '.', ' '); ?></td>-->
                          <td><?= number_format($data1['chv'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['auktech'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['aukshubs'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></td>
                        </tr>
                      <? } ?>

                    </tbody>
                    <tfoot>
                      <tr style="background: #398ebd; color: white;">

                        <?
                        $result2 = mysqli_query($connect, " SELECT id, region, auktech, SUM(dl),SUM(dk) ,SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        from reports022021 WHERE region = '$region'  AND adress ='$adress' ");
                        $data2 = mysqli_fetch_array($result2);
                        ?>
                        <th>*</th>
                        <th>Итого</th>
                        <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dk)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                        <?
                        $summapribl = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];
                        $pr20 = ($summapribl * 20) / 100;
                        $summachistpribl = $summapribl - $pr20;
                        ?>
                        <th><?= number_format($summapribl, 0, '.', ' '); ?></th>
                        <th><?= number_format($summachistpribl, 0, '.', ' '); ?></th>
                        <th><?= number_format($summaplanvden, 0, '.', ' '); ?></th>
                        <th><b><?= number_format($sredsummapr, 0, '.', ' '); ?> %</b></th>
                        <th></th>
                        <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(vzs)'], 0, '.', ' '); ?></th>
                        <!--  <th><?= number_format($data2['SUM(vozvrat)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(nakladnoy)'], 0, '.', ' '); ?></th>-->
                        <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>


                        <th>
                          <?

                          $result3 = mysqli_query($connect, " SELECT * FROM reports022021 WHERE segdata=(SELECT MAX(segdata) FROM reports022021 WHERE region ='$region'  AND adress ='$adress') ");
                          $data3 = mysqli_fetch_array($result3);
                          ?>
                          <?= number_format($data3['auktech'], 0, '.', ' '); ?>

                        </th>
                        <th><?= number_format($data3['aukshubs'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data3['nalvzaloge'], 0, '.', ' '); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->


          </div><!-- /.col -->

      </section>

      <section class="content">
        <?

        $result4 = mysqli_query($connect, " SELECT * FROM planlombard WHERE region = '$region' AND adress='$adress' ");

        $data4 = mysqli_fetch_array($result4);

        ?>

        <form action="functions/rplan.php" method="post">
          <font color="red">Ежемесячный план филиала <?=$region;?>/<?=$adress;?>: </font><input type="number" name="plan" value="<?=$data4['plan'];?>">
          <input type="text" name="region" value="<?=$region;?>" hidden="hidden">
          <input type="text" name="adress" value="<?=$adress;?>" hidden="hidden">
          <input type="submit" name="do_signup" value="Сохранить">

        </form>
        <br>
        <div class="row">

          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Нал в залоге(серая полоса) и Аукционист техника(синяя полоса)</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="areaChart" style="height:250px"></canvas>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- DONUT CHART -->
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Все в одном(наведите курсор)</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <canvas id="pieChart" style="height:250px"></canvas>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

          </div><!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Нал в залоге(серая линия) и Аукционист техника(синяя линия)</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="lineChart" style="height:250px"></canvas>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- BAR CHART -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Bar Chart</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

          </div><!-- /.col (RIGHT) -->


        </div>


    </div><!-- /.row -->

    </section><!-- /.content -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <!-- <script src="dist/js/app.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->

    <script>
      $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels:


            [
              <?

              $result3 = mysqli_query($connect, "SELECT *FROM reports022021 WHERE `region`='$region' AND `adress`='$adress' ORDER BY data ");

              while ($data3 = mysqli_fetch_array($result3)) { ?>

                "<?= date("d.m.Y", strtotime($data3['data'])); ?>",

              <? } ?>

            ],


          datasets: [


            {
              label: "Нал в залоге",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [

                <?

                $result3 = mysqli_query($connect, "SELECT *FROM reports022021 WHERE `region`='$region' AND `adress`='$adress' ");

                while ($data3 = mysqli_fetch_array($result3)) { ?>
                  <?= $data3['nalvzaloge']; ?>,
                <? } ?>

              ]
            },
            {
              label: "Расходы",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [

                <?

                $result3 = mysqli_query($connect, "SELECT *FROM reports022021 WHERE `region`='$region' AND `adress`='$adress' ");

                while ($data3 = mysqli_fetch_array($result3)) { ?>
                  <?= $data3['auktech']; ?>,
                <? } ?>

              ]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        var lineChartOptions = areaChartOptions;
        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData, lineChartOptions);

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [{
            value: <?= $data2['SUM(dohod)']; ?>,
            color: "#f56954",
            highlight: "#f56954",
            label: "Доходы"
          },
          {
            value: <?= $data2['SUM(tekrashod)']; ?>,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Текучие расходы"
          },
          {
            value: <?= $data2['SUM(vozvrat)']; ?>,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Возврат"
          },
          {
            value: <?= $data2['SUM(chv)']; ?>,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Чистая выдача"
          },
          {
            value: <?= $data2['SUM(nakladnoy)']; ?>,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Накладные"
          },
          {
            value: <?= $data2['SUM(vzs)']; ?>,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Выдача за сутки"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
    </script>

    <? include "footer.php";
    else :
header('Location: index.php');
endif; ?>
