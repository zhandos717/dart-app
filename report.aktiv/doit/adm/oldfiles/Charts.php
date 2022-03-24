<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :

if (isset($_POST['grafiks'])){
$vybor = $_POST['vybor'];
    if ($vybor=='Нал в залоге'){

  $table = 'reports032021';
  function percent($number) {
  $percent = '20';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  function percent_comiss($number) {
  $percent = '3';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  $result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
  $data = $result[0];
  $pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
  $chistaya = percent($pr);    // чистая прибыль  = за минусом 20 процентов
  $fil = R::findAll($table," GROUP BY adress");
  foreach ($fil as $value){
  $fil = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
  $ss += $fil['auktech'];
  $ss2 += $fil['aukshubs'];
  $ss3 += $fil['nalvzaloge'];
  }


  $table = 'reports042021';
  function percent4($number) {
  $percent = '20';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  function percent_comiss4($number) {
  $percent = '3';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  $result4 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
  $data = $result4[0];
  $pr4 = $data4['SUM(dohod)'] - $data4['SUM(stabrashod)'] - $data4['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
  $chistaya4 = percent4($pr4);    // чистая прибыль  = за минусом 20 процентов
  $fil4 = R::findAll($table," GROUP BY adress");
  foreach ($fil4 as $value){
  $fil4 = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
  $ss_4 += $fil4['auktech'];
  $ss2_4 += $fil4['aukshubs'];
  $ss3_4 += $fil4['nalvzaloge'];
  }


  $table = 'reports';
  function percent5($number) {
  $percent = '20';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  function percent_comiss5($number) {
  $percent = '3';
  $number_percent = $number / 100 * $percent;
  return $number - $number_percent;
  }
  $result5 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
  $data5 = $result5[0];
  $pr5 = $data5['SUM(dohod)'] - $data5['SUM(stabrashod)'] - $data5['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
  $chistaya5 = percent($pr5);    // чистая прибыль  = за минусом 20 процентов
  $fil5 = R::findAll($table," GROUP BY adress");
  foreach ($fil5 as $value){
  $fil5 = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
  $ss_5 += $fil5['auktech'];
  $ss2_5 += $fil5['aukshubs'];
  $ss3_5 += $fil5['nalvzaloge'];
  }

}

if ($vybor=='Аукционист техника'){

$table = 'reports032021';
function percent($number) {
$percent = '20';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
function percent_comiss($number) {
$percent = '3';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
$result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data = $result[0];
$pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya = percent($pr);    // чистая прибыль  = за минусом 20 процентов
$fil = R::findAll($table," GROUP BY adress");
foreach ($fil as $value){
$fil = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
$ss += $fil['auktech'];
$ss2 += $fil['aukshubs'];
$ss3 = $ss;
}


$table = 'reports042021';
function percent4($number) {
$percent = '20';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
function percent_comiss4($number) {
$percent = '3';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
$result4 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data = $result4[0];
$pr4 = $data4['SUM(dohod)'] - $data4['SUM(stabrashod)'] - $data4['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya4 = percent4($pr4);    // чистая прибыль  = за минусом 20 процентов
$fil4 = R::findAll($table," GROUP BY adress");
foreach ($fil4 as $value){
$fil4 = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
$ss_4 += $fil4['auktech'];
$ss2_4 += $fil4['aukshubs'];
$ss3_4 = $ss_4;
}


$table = 'reports';
function percent5($number) {
$percent = '20';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
function percent_comiss5($number) {
$percent = '3';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
$result5 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data5 = $result5[0];
$pr5 = $data5['SUM(dohod)'] - $data5['SUM(stabrashod)'] - $data5['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya5 = percent($pr5);    // чистая прибыль  = за минусом 20 процентов
$fil5 = R::findAll($table," GROUP BY adress");
foreach ($fil5 as $value){
$fil5 = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
$ss_5 += $fil5['auktech'];
$ss2_5 += $fil5['aukshubs'];
$ss3_5 = $ss_5;
}

}

if ($vybor=='Аукционист шуба'){

$table = 'reports032021';
function percent($number) {
$percent = '20';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
function percent_comiss($number) {
$percent = '3';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
$result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data = $result[0];
$pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya = percent($pr);    // чистая прибыль  = за минусом 20 процентов
$fil = R::findAll($table," GROUP BY adress");
foreach ($fil as $value){
$fil = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
$ss += $fil['auktech'];
$ss2 += $fil['aukshubs'];
$ss3 = $ss2;
}


$table = 'reports042021';
function percent4($number) {
$percent = '20';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
function percent_comiss4($number) {
$percent = '3';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
$result4 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data = $result4[0];
$pr4 = $data4['SUM(dohod)'] - $data4['SUM(stabrashod)'] - $data4['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya4 = percent4($pr4);    // чистая прибыль  = за минусом 20 процентов
$fil4 = R::findAll($table," GROUP BY adress");
foreach ($fil4 as $value){
$fil4 = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
$ss_4 += $fil4['auktech'];
$ss2_4 += $fil4['aukshubs'];
$ss3_4 = $ss2_4;
}


$table = 'reports';
function percent5($number) {
$percent = '20';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
function percent_comiss5($number) {
$percent = '3';
$number_percent = $number / 100 * $percent;
return $number - $number_percent;
}
$result5 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data5 = $result5[0];
$pr5 = $data5['SUM(dohod)'] - $data5['SUM(stabrashod)'] - $data5['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya5 = percent($pr5);    // чистая прибыль  = за минусом 20 процентов
$fil5 = R::findAll($table," GROUP BY adress");
foreach ($fil5 as $value){
$fil5 = R::findOne($table,'adress = ? ORDER BY segdata DESC',[$value['adress']]);
$ss_5 += $fil5['auktech'];
$ss2_5 += $fil5['aukshubs'];
$ss3_5 = $ss2_5;
}

}




}
    include "header.php";
    include "menu.php";




?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Диаграммы / Графики <?=$vybor;?> <?=$testpar;?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Диаграммы</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-body">
                          <form class="" action="Charts.php" method="post">
                              <div class="input-group margin">
                                  <select class="form-control select2" name="vybor">
                                    <option value="<?=$vybor;?>"><?=$vybor;?></option>
                                    <option value="Нал в залоге">Нал в залоге</option>
                                    <option value="Аукционист техника">Аукционист техника</option>
                                    <option value="Аукционист шуба">Аукционист шуба</option>
                                    <!-- <option value="Чистая прибыль">Чистая прибыль</option> -->
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit" name="grafiks">Показать график</button>
                                  </span>
                              </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">График</h3>
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
          </section>
    </div><!-- /.content-wrapper -->

       <script>
         $(function () {
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
             labels: ["Март 2021", "Апрель 2021", "Май 2021"],
             datasets: [



               {
                 label: "Расходы",
                 fillColor: "rgba(60,141,188,0.9)",
                 strokeColor: "rgba(60,141,188,0.8)",
                 pointColor: "#3b8bba",
                 pointStrokeColor: "rgba(60,141,188,1)",
                 pointHighlightFill: "#fff",
                 pointHighlightStroke: "rgba(60,141,188,1)",
                 data: [<?=$ss3;?>, <?=$ss3_4;?>, <?=$ss3_5;?>]
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
           var PieData = [
             {
               value: 700,
               color: "#f56954",
               highlight: "#f56954",
               label: "Доходы"
             },
             {
               value: 500,
               color: "#00a65a",
               highlight: "#00a65a",
               label: "Текучие расходы"
             },
             {
               value: 400,
               color: "#f39c12",
               highlight: "#f39c12",
               label: "Нал в залоге"
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

           barChartOptions.datasetFill = true;
           barChart.Bar(barChartData, barChartOptions);
         });
       </script>
<?
    include "footer.php";
else :
    header('Location: ../../index.php');
endif;
?>
