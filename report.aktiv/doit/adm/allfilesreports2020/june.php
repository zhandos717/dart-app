<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 3) :
    $active_lombard = 'active';
    $active_report = 'active';
    $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                          SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports062020  ");
    $data2 = mysqli_fetch_array($result2);

    $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
    $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов

    $result = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                      from reports062020  GROUP BY region  ");
    $ss = 0;
    $ss2 = 0;
    $ss3 = 0;
    while ($data1 = mysqli_fetch_array($result)) {

      $region =  $data1['region'];

      $result4 = mysqli_query($connect, "SELECT *FROM reports062020 WHERE region='$region' GROUP BY adress ");


      $s = 0;
      $s2 = 0;
      $s3 = 0;

      while ($data4 = mysqli_fetch_array($result4)) {
        $filial =  $data4['adress'];
        $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports062020 WHERE segdata=(SELECT MAX(segdata) FROM reports062020 WHERE region = '$region' AND adress = '$filial' ) ");
        $data5 = mysqli_fetch_array($result5);



        $s += $data5['auktech'];
        $s2 += $data5['aukshubs'];
        $s3 += $data5['nalvzaloge'];
      }

      $ss += $s;   //аукц т
      $ss2 += $s2; //ауц шубы
      $ss3 += $s3;  //нал в залоге

    }

?>

    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Отчет за ИЮНЬ 2020
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
                        <th style="width: 10px">id</th>
                        <th>РЕГИОНЫ</th>
                        <th>ДОХОД ЛОМБАРДА</th>
                        <th>ДОХОД МАГАЗИНА</th>
                        <th>ДОП ДОХОДЫ</th>
                        <th>ДОХОДЫ</th>
                        <th>СТАБ.РАСХОДЫ</th>
                        <th>ТЕК.РАСХОДЫ</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>ЧИСТАЯ ПРИБЫЛЬ (-20%)</th>
                        <th>ВСЕ КЛИЕНТЫ</th>
                        <th>НОВЫЕ КЛИЕНТЫ</th>
                        <th>ЧИСТАЯ ВЫДАЧА</th>
                        <th>АУКЦИОНИСТ ТЕХНИКА</th>
                        <th>АУКЦИОНИСТ ШУБА</th>
                        <th>НАЛ В ЗАЛОГЕ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $result = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                       from reports062020  GROUP BY region  ");

                      $ss = 0;
                      $ss2 = 0;
                      $ss3 = 0;
                      while ($data1 = mysqli_fetch_array($result)) {
                        $region =  $data1['region'];
                      ?>

                        <tr>
                          <td>*</td>
                          <td><a href="viewreportregion06.php?region=<?= $data1['region']; ?>"><?= $data1['region']; ?></a></td>
                          <td>
                            <?= number_format($data1['SUM(dl)'], 0, '.', ' '); ?>
                          </td>
                          <td>
                            <?= number_format($data1['SUM(dm)'], 0, '.', ' '); ?>
                          </td>
                          <td>
                            <?= number_format($data1['SUM(dop)'], 0, '.', ' '); ?>
                          </td>
                          <td>
                            <?= number_format($data1['SUM(dohod)'], 0, '.', ' '); ?>
                          </td>
                          <td><?= number_format($data1['SUM(stabrashod)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(tekrashod)'], 0, '.', ' '); ?></td>
                          <?
                          $pr = $data1['SUM(dohod)'] - $data1['SUM(stabrashod)'] - $data1['SUM(tekrashod)']; //прибыль = доход - стабиль расх - тек расх
                          $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                          ?>
                          <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td>
                          <td><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                          <td><?= number_format($data1['SUM(allclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(newclients)'], 0, '.', ' '); ?></td>
                          <td><?= number_format($data1['SUM(chv)'], 0, '.', ' '); ?></td>



                          <?
                          $result4 = mysqli_query($connect, "SELECT *FROM reports062020 WHERE region='$region' GROUP BY adress ");


                          $s = 0;
                          $s2 = 0;
                          $s3 = 0;

                          while ($data4 = mysqli_fetch_array($result4)) {
                            $filial =  $data4['adress'];
                            $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM reports062020 WHERE segdata=(SELECT MAX(segdata) FROM reports062020 WHERE region = '$region' AND adress = '$filial' ) ");
                            $data5 = mysqli_fetch_array($result5);



                            $s += $data5['auktech'];
                            $s2 += $data5['aukshubs'];
                            $s3 += $data5['nalvzaloge'];
                          }

                          $ss += $s;
                          $ss2 += $s2;
                          $ss3 += $s3;
                          ?>


                          <td><?= number_format($s, 0, '.', ' ');; ?></td>
                          <td><?= number_format($s2, 0, '.', ' ');; ?></td>
                          <td><?= number_format($s3, 0, '.', ' ');; ?></td>


                        </tr>

                      <? } ?>


                    </tbody>
                    <tfoot>
                      <?
                      $result2 = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from reports062020  ");
                      $data2 = mysqli_fetch_array($result2);
                      ?>

                      <tr style="background: #d3d7df; color: black;">
                        <th></th>
                        <th>Итого (СУММА)</th>
                        <th><?= number_format($data2['SUM(dl)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dm)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dop)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(dohod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(stabrashod)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(tekrashod)'], 0, '.', ' '); ?></th>
                        <?
                        $pr = $data2['SUM(dohod)'] - $data2['SUM(stabrashod)'] - $data2['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
                        $chistaya = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов
                        ?>
                        <td><strong><?= number_format($pr, 0, '.', ' '); ?></strong></td>
                        <td style="background: #00c2f0; color: white;"><strong><?= number_format($chistaya, 0, '.', ' '); ?></strong></td>
                        <th><?= number_format($data2['SUM(allclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(newclients)'], 0, '.', ' '); ?></th>
                        <th><?= number_format($data2['SUM(chv)'], 0, '.', ' '); ?></th>
                        <th style="background: #00a759; color: white;"><?= number_format($ss, 0, '.', ' '); ?></th>
                        <th style="background: #f39d0a; color: white;"><?= number_format($ss2, 0, '.', ' '); ?></th>
                        <th style="background: #de4936; color: white;"><?= number_format($ss3, 0, '.', ' '); ?></th>

                      </tr>

                    </tfoot>


                  </table>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">

              </div>
            </div><!-- /.box -->


          </div><!-- /.col -->

        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Нал в залоге(серая), Ауционист (синяя полоска)</h3>
                <div class="box-tools pull-right">

                  <div class="btn-group">
                    <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>

                  </div>
                </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Нал в залоге, Аукционист</strong>
                    </p>
                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" style="height: 180px;"></canvas>
                    </div><!-- /.chart-responsive -->
                  </div><!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>
                    <div class="progress-group">
                      <span class="progress-text">Доход ломбарда</span>
                      <span class="progress-number"><b>160</b>/200</span>
                      <div class="progress sm">
                        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                      </div>
                    </div><!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Доход магазина</span>
                      <span class="progress-number"><b>310</b>/400</span>
                      <div class="progress sm">
                        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                      </div>
                    </div><!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Стаб.расходы</span>
                      <span class="progress-number"><b>480</b>/800</span>
                      <div class="progress sm">
                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                      </div>
                    </div><!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Все клиенты</span>
                      <span class="progress-number"><b>250</b>/500</span>
                      <div class="progress sm">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                      </div>
                    </div><!-- /.progress-group -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- ./box-body -->
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div><!-- /.description-block -->
                  </div><!-- /.col -->
                  <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div><!-- /.description-block -->
                  </div><!-- /.col -->
                  <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div><!-- /.description-block -->
                  </div><!-- /.col -->
                  <div class="col-sm-3 col-xs-6">
                    <div class="description-block">
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div><!-- /.description-block -->
                  </div>
                </div><!-- /.row -->
              </div><!-- /.box-footer -->
            </div><!-- /.box -->
          </div><!-- /.col -->
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
      <script src="dist/js/app.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="dist/js/demo.js"></script>


      <script>
        $(function() {

          'use strict';

          /* ChartJS
           * -------
           * Here we will create a few charts using ChartJS
           */

          //-----------------------
          //- MONTHLY SALES CHART -
          //-----------------------

          // Get context with jQuery - using jQuery's .get() method.
          var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
          // This will get the first returned node in the jQuery collection.
          var salesChart = new Chart(salesChartCanvas);

          var salesChartData = {
            labels: [

              <?

              $result3 = mysqli_query($connect, "SELECT mes FROM svod GROUP BY mes ORDER BY id");

              while ($data3 = mysqli_fetch_array($result3)) { ?>

                "<?= $data3['mes']; ?>",

              <? } ?>

            ],
            datasets: [{
                label: "Electronics",
                fillColor: "rgb(210, 214, 222)",
                strokeColor: "rgb(210, 214, 222)",
                pointColor: "rgb(210, 214, 222)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgb(220,220,220)",
                data: [


                  <?



                  $sql = 'SELECT mes,SUM(pribl),SUM(auktech),SUM(aukshubs),SUM(nalvzaloge) FROM svod WHERE region = "' . $region . '" GROUP BY mes ORDER BY id';
                  $result4 = mysqli_query($connect, $sql);
                  while ($data4 = mysqli_fetch_array($result4)) {


                  ?>

                    <?= $data4['SUM(nalvzaloge)']; ?>,


                  <? } ?>

                ]
              },
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



                  $sql = 'SELECT mes,SUM(pribl),SUM(auktech),SUM(aukshubs),SUM(nalvzaloge) FROM svod WHERE region = "' . $region . '" GROUP BY mes ORDER BY id';
                  $result4 = mysqli_query($connect, $sql);
                  while ($data4 = mysqli_fetch_array($result4)) {
                    $auk = $data4['SUM(auktech)'] + $data4['SUM(aukshubs)'];
                  ?>

                    <?= $auk; ?>,


                  <? } ?>



                ]
              }
            ]
          };

          var salesChartOptions = {
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
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
          };

          //Create the line chart
          salesChart.Line(salesChartData, salesChartOptions);

          //---------------------------
          //- END MONTHLY SALES CHART -
          //---------------------------

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
            segmentStrokeWidth: 1,
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
            maintainAspectRatio: false,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
            //String - A tooltip template
            tooltipTemplate: "<%=value %> <%=label%> users"
          };
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          pieChart.Doughnut(PieData, pieOptions);
          //-----------------
          //- END PIE CHART -
          //-----------------

          /* jVector Maps
           * ------------
           * Create a world map with markers
           */
          $('#world-map-markers').vectorMap({
            map: 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity: 0.7,
            hoverColor: false,
            backgroundColor: 'transparent',
            regionStyle: {
              initial: {
                fill: 'rgba(210, 214, 222, 1)',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
              },
              hover: {
                "fill-opacity": 0.7,
                cursor: 'pointer'
              },
              selected: {
                fill: 'yellow'
              },
              selectedHover: {}
            },
            markerStyle: {
              initial: {
                fill: '#00a65a',
                stroke: '#111'
              }
            },
            markers: [{
                latLng: [41.90, 12.45],
                name: 'Vatican City'
              },
              {
                latLng: [43.73, 7.41],
                name: 'Monaco'
              },
              {
                latLng: [-0.52, 166.93],
                name: 'Nauru'
              },
              {
                latLng: [-8.51, 179.21],
                name: 'Tuvalu'
              },
              {
                latLng: [43.93, 12.46],
                name: 'San Marino'
              },
              {
                latLng: [47.14, 9.52],
                name: 'Liechtenstein'
              },
              {
                latLng: [7.11, 171.06],
                name: 'Marshall Islands'
              },
              {
                latLng: [17.3, -62.73],
                name: 'Saint Kitts and Nevis'
              },
              {
                latLng: [3.2, 73.22],
                name: 'Maldives'
              },
              {
                latLng: [35.88, 14.5],
                name: 'Malta'
              },
              {
                latLng: [12.05, -61.75],
                name: 'Grenada'
              },
              {
                latLng: [13.16, -61.23],
                name: 'Saint Vincent and the Grenadines'
              },
              {
                latLng: [13.16, -59.55],
                name: 'Barbados'
              },
              {
                latLng: [17.11, -61.85],
                name: 'Antigua and Barbuda'
              },
              {
                latLng: [-4.61, 55.45],
                name: 'Seychelles'
              },
              {
                latLng: [7.35, 134.46],
                name: 'Palau'
              },
              {
                latLng: [42.5, 1.51],
                name: 'Andorra'
              },
              {
                latLng: [14.01, -60.98],
                name: 'Saint Lucia'
              },
              {
                latLng: [6.91, 158.18],
                name: 'Federated States of Micronesia'
              },
              {
                latLng: [1.3, 103.8],
                name: 'Singapore'
              },
              {
                latLng: [1.46, 173.03],
                name: 'Kiribati'
              },
              {
                latLng: [-21.13, -175.2],
                name: 'Tonga'
              },
              {
                latLng: [15.3, -61.38],
                name: 'Dominica'
              },
              {
                latLng: [-20.2, 57.5],
                name: 'Mauritius'
              },
              {
                latLng: [26.02, 50.55],
                name: 'Bahrain'
              },
              {
                latLng: [0.33, 6.73],
                name: 'São Tomé and Príncipe'
              }
            ]
          });

          /* SPARKLINE CHARTS
           * ----------------
           * Create a inline charts with spark line
           */

          //-----------------
          //- SPARKLINE BAR -
          //-----------------
          $('.sparkbar').each(function() {
            var $this = $(this);
            $this.sparkline('html', {
              type: 'bar',
              height: $this.data('height') ? $this.data('height') : '30',
              barColor: $this.data('color')
            });
          });

          //-----------------
          //- SPARKLINE PIE -
          //-----------------
          $('.sparkpie').each(function() {
            var $this = $(this);
            $this.sparkline('html', {
              type: 'pie',
              height: $this.data('height') ? $this.data('height') : '90',
              sliceColors: $this.data('color')
            });
          });

          //------------------
          //- SPARKLINE LINE -
          //------------------
          $('.sparkline').each(function() {
            var $this = $(this);
            $this.sparkline('html', {
              type: 'line',
              height: $this.data('height') ? $this.data('height') : '90',
              width: '100%',
              lineColor: $this.data('linecolor'),
              fillColor: $this.data('fillcolor'),
              spotColor: $this.data('spotcolor')
            });
          });
        });
      </script>





    </div><!-- /.content-wrapper -->

    <? include "footer.php"; ?>

  <?php endif; ?>

<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
