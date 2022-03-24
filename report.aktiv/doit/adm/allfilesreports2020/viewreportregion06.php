<? //проверка существовании сессии
include("../../../bd.php");
$region = $_GET['region'];
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>


    <?

    $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                        SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports062020 WHERE `region`='$region'  ");
    $data2 = mysqli_fetch_array($result2);
    $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх

    $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов


    $result4 = mysqli_query($connect, "SELECT *FROM reports062020 WHERE region='$region' GROUP BY adress ");
    $ss = 0;
    $ss2 = 0;
    $ss3 = 0;
    while ($data4 = mysqli_fetch_array($result4)) {
      $filial =  $data4['adress'];
      $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports062020 WHERE segdata=(SELECT MAX(segdata) FROM reports062020 WHERE region = '$region' AND adress = '$filial' ) ");
      $data5 = mysqli_fetch_array($result5);




      //echo " * ".$data5['auktech']." * ";

      $ss += $data5['auktech'];
      $ss2 += $data5['aukshubs'];
      $ss3 += $data5['nalvzaloge'];
    }





    ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет за ИЮНЬ 2020, за весь регион - <b><?= $region; ?></b>
          <small><a href="index.php">назад к списку</a></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>

        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= number_format($chistaya, 0, '.', ' '); ?> тг</h3>
                <p>ЧИСТАЯ ПРИБЫЛЬ</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= number_format($ss, 0, '.', ' ');; ?> тг</h3>
                <p>АУКЦИОНИСТ ТЕХНИКА</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= number_format($ss2, 0, '.', ' ');; ?> тг</h3>
                <p>АУКЦИОНИСТ ШУБА</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= number_format($ss3, 0, '.', ' ');; ?> тг</h3>
                <p>НАЛИЧНЫЕ В ЗАЛОГЕ</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->


        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Филиалы <?= $region; ?></h3>
              </div><!-- /.box-header -->
              <div class="box-body">

                <style>
                  .layer {
                    overflow-x: scroll;
                    /* Добавляем полосу прокрутки */
                    width: 100%;
                    /* Ширина блока */
                    height: 100%;
                    /* Высота блока */
                    padding: 5px;
                    /* Поля вокруг текста */
                    //  border: solid 1px black; /* Параметры рамки */
                    white-space: nowrap;
                    /* Запрещаем перенос строк */
                  }
                </style>

                <div class="layer">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr style="background: #398ebd; color: white;">
                        <th>Адрес филиала</th>
                        <th>Доход ломбард</th>
                        <th>Доход магазин</th>
                        <th>Доп доход</th>
                        <th>Доходы</th>
                        <th>Стаб расходы</th>
                        <th>Текущие расходы</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>Чистая прибыль (-20%)</th>
                        <th>Все клиенты</th>
                        <th>Новые клиенты</th>
                        <th>Чистая выдача</th>
                        <th>Аукционист техника</th>
                        <th>Аукционист шубы</th>
                        <th>Нал в залоге</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?





                      $result = mysqli_query($connect, "SELECT adress,id, region, SUM(dl),SUM(dm),SUM(dop), SUM(stabrashod), SUM(dohod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        FROM reports062020 WHERE `region`='$region' GROUP BY `adress` ");

                      while ($data1 = mysqli_fetch_array($result)) {


                        $filial =  $data1['adress'];

                      ?>


                        <tr>
                          <td><a href="viewfilial06.php?region=<?= $region; ?>&adress=<?= $data1['adress']; ?>"><?= $filial; ?></a></td>
                          <td><?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td>

                          <?
                          $pribl = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)'];
                          $pr20 = ($pribl * 20) / 100;
                          $chistpribl = $pribl - $pr20;

                          ?>

                          <td><?= number_format($pribl, 0, '.', ' '); ?></td>
                          <td><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
                          <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>



                          <?
                          $result3 = mysqli_query($connect, " SELECT * FROM reports062020 WHERE segdata=(SELECT MAX(segdata) FROM reports062020 WHERE region = '$region' AND adress = '$filial' ) ");
                          $data12 = mysqli_fetch_array($result3);
                          ?>


                          <td><?= number_format($data12['auktech'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data12['aukshubs'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data12['nalvzaloge'], 0, '.', ' '); ?></td>

                        </tr>
                      <? } ?>



                    </tbody>

                    <tfoot>
                      <tr style="background: #d3d7df; color: black;">
                        <?
                        $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                        from reports062020 WHERE region = '$region' ");

                        $data2 = mysqli_fetch_array($result2);
                        ?>
                        <th>Итого</th>
                        <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
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
                        <th style="background: #00c2f0; color: black;"><?= number_format($summachistpribl, 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>

                        <?
                        $result4 = mysqli_query($connect, "SELECT *FROM reports062020 WHERE region='$region' GROUP BY adress ");
                        $s = 0;
                        $s2 = 0;
                        $s3 = 0;
                        while ($data4 = mysqli_fetch_array($result4)) {
                          $filial =  $data4['adress'];
                          $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports062020 WHERE segdata=(SELECT MAX(segdata) FROM reports062020 WHERE region = '$region' AND adress = '$filial' ) ");
                          $data5 = mysqli_fetch_array($result5);




                          //echo " * ".$data5['auktech']." * ";

                          $s += $data5['auktech'];
                          $s2 += $data5['aukshubs'];
                          $s3 += $data5['nalvzaloge'];
                        }

                        ?>
                        <th style="background: #00a759; color: black;"><?= number_format($s, 0, '.', ' '); ?></th>
                        <th style="background: #f39d0a; color: black;"><?= number_format($s2, 0, '.', ' '); ?></th>
                        <th style="background: #de4936; color: black;"><?= number_format($s3, 0, '.', ' '); ?></th>

                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->


          </div><!-- /.col -->

        </div><!-- /.row -->

      </section><!-- /.content -->


      <!-- Main content -->
      <section class="content">


        <form action="viewreportregion04.php?region=<?= $region; ?>" method="post">
          <select name="prosmotr">
            <option>Выберите</option>
            <option value="pribl">Прибыль</option>
            <option value="auktech">Аукционист техника</option>
            <option value="aukshubs">Аукционист шубы</option>
            <option value="nalvzaloge">Нал в залоге</option>
          </select>

          <button name="gogo">Построить график</button>
        </form>

        <?
        $prosmotr = $_POST['prosmotr'];
        ?>

        <div class="row">



          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
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
          </div><!-- /.col (RIGHT) -->



          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
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
          </div><!-- /.col (LEFT) -->

        </div><!-- /.row -->





      </section><!-- /.content -->













    </div><!-- /.content-wrapper -->





    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
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
          labels: [

            <?

            $result3 = mysqli_query($connect, "SELECT mes,SUM(pribl),SUM(auktech),SUM(aukshubs),SUM(nalvzaloge) FROM svod WHERE region='$region' GROUP BY mes ORDER BY id");

            while ($data3 = mysqli_fetch_array($result3)) { ?>

              "<?= $data3['mes']; ?>",

            <? } ?>


          ],
          datasets: [

            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [


                <?



                $sql = 'SELECT mes,SUM(' . $prosmotr . '),SUM(auktech),SUM(aukshubs),SUM(nalvzaloge) FROM svod WHERE region = "' . $region . '" GROUP BY mes ORDER BY id';
                $result4 = mysqli_query($connect, $sql);
                while ($data4 = mysqli_fetch_array($result4)) { ?>

                  <?= $data4['SUM(' . $prosmotr . ')']; ?>,


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
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Chrome"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "IE"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "FireFox"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Safari"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Opera"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Navigator"
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



    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
